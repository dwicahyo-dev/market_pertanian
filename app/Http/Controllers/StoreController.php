<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Product;
use App\Agriculture;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;
use File;

use App\City;
use App\Quality;
use App\Checkout;
use App\Review;

class StoreController extends Controller
{
    protected $path;
    protected $coverPath;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'front', 'storeInformation', 'storeReview', 'filter']);
        $this->middleware('check.having.store')->only(['create']);

        $this->path = storage_path('app/public/stores');
        $this->coverPath = storage_path('app/public/stores_cover');

        $this->middleware('verified')->only(['create']);
    }

    protected $filePath = 'public/stores/';
    protected $fileCoverPath = 'public/store_covers/';
    protected $redirectTo = '/stores';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with(['user'])->paginate('10');

        return view('stores.index', compact('stores'));
    }

    public function products()
    {
        $user = Auth::id();
        $store = Store::where('user_id', $user)->get()->first();
        $products = Product::with(['agriculture', 'quality'])->where('store_id', $store->id)->get();

        return view('stores.products', compact('products'));
    }

    protected function rules()
    {
        return [
            'store_name' => 'required|unique:stores',
            'city_id' => 'required',
        ];
    }

    public function rulesUpdateStoreInformation()
    {
        return [
            'city_id' => 'required',
        ];
    }

    protected function rulesUpdateThumbnail()
    {
        return [
            'thumbnail' => 'required|image:jpeg,png,jpg|max:5000',
        ];
    }

    protected function rulesUpdateCover()
    {
        return [
            'cover' => 'required|image:jpeg,png,jpg|max:5000',
        ];
    }

    public function getStandardPrice($agriculture)
    {
        $standardPrice = $agriculture->standardPrice;

        if (empty($standardPrice)) {
            return abort(500);
        }

        return [
            'lowestPrice' => $standardPrice->lowest_price,
            'highestPrice' => $standardPrice->highest_price
        ];
    }

    public function getProductsStandarized($store, $agriculture)
    {
        $standardPrice = $this->getStandardPrice($agriculture);

        return  $agriculture->products()
            ->where('store_id', $store->id)
            ->where('agriculture_id', $agriculture->id)
            ->whereBetween('price', [
                $standardPrice['lowestPrice'],
                $standardPrice['highestPrice']
            ]);
    }

    public function getProductsNotStandarized($agriculture)
    {
        $standardPrice = $this->getStandardPrice($agriculture);

        return  $agriculture->products()
            ->whereNotBetween('price', [
                $standardPrice['lowestPrice'],
                $standardPrice['highestPrice']
            ]);
    }

    public function getAgriculturesFront($store)
    {
        return $store->products()->groupBy('agriculture_id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('stores.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());

        $store = Store::create([
            'user_id' => Auth::id(),
            'store_name' => $request->store_name,
            'slogan' => $request->slogan,
            'city_id' => $request->city_id,
        ]);

        $request->session()->flash('success', 'Data Berhasil Disimpan');

        return redirect()->route('stores.show', $store->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $agriculturesFront = $this->getAgriculturesFront($store)->get();

        $revOri = $this->getReviews($store);
        $countRev = $revOri->count();

        return view('stores.show', compact('store', 'agriculturesFront', 'countRev'));
    }

    public function front(Store $store, Agriculture $agriculture)
    {
        $qualities = Quality::all();
        $agriculturesFront = $this->getAgriculturesFront($store)->get();
        $products = $this->getProductsStandarized($store, $agriculture)->paginate(12);
        $inStock = $this->getProductsStandarized($store, $agriculture)->where('product_status', true)->count();
        $outStock = $this->getProductsStandarized($store, $agriculture)->where('product_status', false)->count();
        $productNotStandardized = $this->getProductsNotStandarized($agriculture);

        $revOri = $this->getReviews($store);
        $countRev = $revOri->count();

        return view('stores.storefront', compact(
            'qualities',
            'store',
            'agriculture',
            'agriculturesFront',
            'products',
            'inStock',
            'outStock',
            'productNotStandardized',
            'countRev'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $this->authorize('update', $store);

        $cities = City::all();

        return view('stores.edit', compact('store', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $this->validate($request, $this->rulesUpdateStoreInformation());

        $store->update([
            'slogan' => $request->slogan,
            'city_id' => $request->city_id,
        ]);

        $request->session()->flash('success', 'Anda telah berhasil memperbaharui info toko Anda.');

        return redirect()->route('stores.edit', $store->id);
    }

    public function doUploadUpdateThumbnail(array $dataUpload, $store)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }

        if (Storage::exists($this->filePath . $store->thumbnail)) {
            Storage::delete($this->filePath . $store->thumbnail);
        }

        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.png';

        $canvas = Image::canvas(640, 709);

        $resizeImage  = Image::make($dataUpload['file_thumbnail'])->resize(640, 709, function ($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');
        $canvas->save($this->path . '/' . $fileName);

        return $fileName;
    }

    public function doUploadUpdateCover(array $dataUpload, $store)
    {
        if (!File::isDirectory($this->coverPath)) {
            File::makeDirectory($this->coverPath);
        }

        if (Storage::exists($this->fileCoverPath . $store->cover)) {
            Storage::delete($this->fileCoverPath . $store->cover);
        }

        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.png';

        $canvas = Image::canvas(640, 709);

        $resizeImage  = Image::make($dataUpload['file_cover'])->resize(640, 709, function ($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');
        $canvas->save($this->coverPath . '/' . $fileName);

        return $fileName;
    }

    public function updateThumbnail(Request $request, Store $store)
    {
        $this->validate($request, $this->rulesUpdateThumbnail());

        $dataUpload = [
            'file_thumbnail' => $request->file('thumbnail'),
        ];

        $uploadedFile = $this->doUploadUpdateThumbnail($dataUpload, $store);

        $store->update([
            'thumbnail' => $uploadedFile,
        ]);

        $request->session()->flash('success', 'Anda telah berhasil memperbaharui gambar toko Anda.');

        return redirect()->route('stores.edit', $store->id);
    }

    public function updateCover(Request $request, Store $store)
    {
        $this->validate($request, $this->rulesUpdateCover());

        $dataUpload = [
            'file_cover' => $request->file('cover'),
        ];

        $uploadedFile = $this->doUploadUpdateCover($dataUpload, $store);

        $store->update([
            'cover' => $uploadedFile,
        ]);

        $request->session()->flash('success', 'Anda telah berhasil memperbaharui sampul toko Anda.');

        return redirect()->route('stores.edit', $store->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    public function storeInformation(Store $store)
    {
        $revOri = $this->getReviews($store);
        $countRev = $revOri->count();

        $countTransactions = Checkout::with(['product.store'])
            ->whereHas('product.store', function ($query) use ($store) {
                $query->where('id', $store->id);
            })->count();

        return view('stores.info', compact('store', 'countTransactions', 'countRev'));
    }

    public function storeReview(Store $store)
    {
        $revOri = $this->getReviews($store);
        $countRev = $revOri->count();
        $rev =  $revOri->paginate(10);

        return view('stores.review', compact('store', 'rev', 'countRev'));
    }

    public function getReviews($store)
    {
        return Review::with(['user', 'product.productReal'])
            ->whereHas('product.store', function ($query) use ($store) {
                $query->where('id', $store->id);
            });
    }

    public function filter(Request $request, Store $store, Agriculture $agriculture)
    {
        $qualities = Quality::all();

        $revOri = $this->getReviews($store);
        $countRev = $revOri->count();

        $agriculturesFront = $this->getAgriculturesFront($store)->get();
        $productsO = $this->getProductsStandarized($store, $agriculture);


        if ($request->has('quality')) {
            $productsO->where('quality_id', $request->quality);
        }

        if ($request->has('price')) {
            if ($request->price == 'lowest') {
                $productsO->orderBy('price', 'ASC');
            }

            $productsO->orderBy('price', 'DESC');
        }

        $productF = $productsO->get();
        $inStock = $productF->where('product_status', true)->count();
        $outStock = $productF->where('product_status', false)->count();
        $productNotStandardized = $this->getProductsNotStandarized($agriculture)->where('quality_id', $request->quality);

        $products =  $productsO->paginate(12)->appends([
            'quality' => $request->quality,
            'price' => $request->price,
        ]);

        return view('stores.storefront', compact(
            'qualities',
            'store',
            'agriculture',
            'agriculturesFront',
            'products',
            'inStock',
            'outStock',
            'productNotStandardized',
            'countRev'
        ));
    }
}
