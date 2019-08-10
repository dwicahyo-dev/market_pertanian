<?php

namespace App\Http\Controllers;

use App\Product;
use App\Quality;
use App\Agriculture;
use App\StandardPrice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;
use File;
use App\Review;

class ProductController extends Controller
{
    protected $path;
    protected $filePath = 'public/products/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'edit', 'update', 'destroy', 'listStockedProducts', 'listStocklessProducts', 'getStore'
        ]);
        $this->middleware('create.store')->only(['create', 'store']);

        $this->path = storage_path('app/public/products');

        // $this->middleware('verified')->only(['store']);
    }

    protected $redirectTo = '/manage-products/stocked';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Get List of the Stocked Products
     *
     * @return void
     */
    public function listStockedProducts()
    {
        $stockedProducts = $this->getStokedProducts();
        $countStockedProduct = $this->countStokedProduct();
        $countStocklessProduct = $this->countStocklessProduct();

        return view('products.manage.stocked', compact('stockedProducts', 'countStockedProduct', 'countStocklessProduct'));
    }

    /**
     * Get List of the Stockless Products
     *
     * @return void
     */
    public function listStocklessProducts()
    {
        $stocklessProducts = $this->getStocklessProduct();
        $countStockedProduct = $this->countStokedProduct();
        $countStocklessProduct = $this->countStocklessProduct();

        return view('products.manage.stockless', compact('stocklessProducts', 'countStockedProduct', 'countStocklessProduct'));
    }

    /**
     * Get Store data
     *
     * @return void
     */
    public function getStore()
    {
        $store = Auth::user()->store;

        return Product::with(['quality', 'agriculture'])->where('store_id', $store->id);
    }

    protected function getStokedProducts()
    {
        return $this->getStore()->where('product_status', true)->get();
    }

    protected function getStocklessProduct()
    {
        return $this->getStore()->where('product_status', false)->get();
    }

    protected function countStokedProduct()
    {
        return $this->getStore()->where('product_status', true)->count();
    }

    protected function countStocklessProduct()
    {
        return $this->getStore()->where('product_status', false)->count();
    }

    public function setStocklessProduct(Request $request, Product $product)
    {
        $product->update([
            'product_status' => false
        ]);

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo);
    }

    public function setStockedProduct(Request $request, Product $product)
    {
        $product->update([
            'product_status' => true
        ]);

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agricultures = Agriculture::all();
        $qualities = Quality::all();

        return view('products.create', compact('agricultures', 'qualities'));
    }

    protected function rulesCreate()
    {
        return [
            'agriculture_id' => 'required',
            'quality_id' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rulesCreate());

        $dataPrice = [
            'agriculture_id' => $request->agriculture_id,
            'has_standard_price' => $request->only('has_standard_price'),
        ];

        $standardPrice = $this->getStandardPrice($dataPrice);

        if (empty($standardPrice)) {
            $request->session()->flash(
                'error',
                'Standar Harga Hasil Pertanian belum ada'
            );

            return back()->withInput();
        }

        if ($request->hasFile('thumbnail')) {
            $validator = Validator::make($request->only(['price', 'thumbnail']), [
                'price' => 'integer|between:' . $standardPrice->lowest_price . ',' . $standardPrice->highest_price,
                'thumbnail' => 'required|image:jpeg,png,jpg|max:5000',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dataUpload = [
            'file_thumbnail' => $request->file('thumbnail'),
        ];

        $uploadedFile = $this->doUpload($dataUpload);

        Product::create([
            'agriculture_id' => $request->input('agriculture_id'),
            'quality_id' => $request->input('quality_id'),
            'product_name' => $request->input('product_name'),
            'store_id' => Auth::user()->store->id,
            'thumbnail' => $uploadedFile,
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'product_status' => $request->input('product_status'),
        ]);

        $request->session()->flash('success', 'Data Berhasil Disimpan');

        return redirect($this->redirectTo);
    }

    /**
     * Do Uploading the Product Photo
     *
     * @param object $data
     * @return void
     */
    public function doUpload(array $dataUpload)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
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

    /**
     * Do Uploading the Product Photo
     *
     * @param object $data
     * @return void
     */
    public function doUploadUpdate(array $dataUpload, $product)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }

        if (Storage::exists($this->filePath . $product->thumbnail)) {
            Storage::delete($this->filePath . $product->thumbnail);
        }

        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.png';

        $canvas = Image::canvas(640, 709);

        $resizeImage  = Image::make($dataUpload['file_thumbnail'])->resize(640, 709, function ($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');
        $canvas->save($this->path . '/' . $fileName);

        $product->update([
            'thumbnail' => $fileName,
        ]);
    }

    public function getStandardPrice(array $data)
    {
        $price = StandardPrice::where('agriculture_id', $data['agriculture_id'])->get()->first();

        return $price;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $prodRev = $this->getProductReviews($product);
        $reviewsCount = $prodRev->count();

        return view('products.show', compact('product', 'reviewsCount'));
    }

    public function showDiscussionsProduct(Product $product)
    {
        $productDiscussions = $product->productDiscussions()->paginate(10);

        $prodRev = $this->getProductReviews($product);
        $reviewsCount = $prodRev->count();

        return view('products.show', compact('product', 'productDiscussions', 'reviewsCount'));
    }

    public function showReviewsProduct(Product $product)
    {
        $prodRev = $this->getProductReviews($product);
        $reviewsCount = $prodRev->count();
        $reviewList = $prodRev->paginate(10);

        return view('products.show', compact('product', 'reviewList', 'reviewsCount'));
    }

    public function getProductReviews($product)
    {
        return Review::with(['product', 'user'])
            ->whereHas('product', function ($query) use ($product) {
                $query->where('product_real_id', $product->id);
            });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update_product', $product);

        $agricultures = Agriculture::all();
        $qualities = Quality::all();

        return view('products.edit', compact('product', 'agricultures', 'qualities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $dataPrice = [
            'agriculture_id' => $request->agriculture_id,
            'has_standard_price' => $request->only('has_standard_price'),
        ];

        $standardPrice = $this->getStandardPrice($dataPrice);

        if (empty($standardPrice)) {
            $request->session()->flash('error', 'Standar Harga Hasil Pertanian belum ada');

            return back()->withInput();
        }

        if (!$request->hasFile('thumbnail')) {
            $validator = Validator::make($request->only([
                'product_name', 'agriculture_id', 'quality_id', 'stock', 'price', 'description'
            ]), [
                'product_name' => 'required',
                'agriculture_id' => 'required',
                'quality_id' => 'required',
                'stock' => 'required',
                'price' => 'required|integer|between:' . $standardPrice->lowest_price . ',' . $standardPrice->highest_price,
                'description' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(['thumbnail']), [
                'thumbnail' => 'required|image:jpeg,png,jpg|max:5000',
            ]);
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpload = [
            'file_thumbnail' => $request->file('thumbnail'),
        ];

        if ($request->hasFile('thumbnail')) {
            $this->doUploadUpdate($dataUpload, $product);
        }

        $product->update([
            'agriculture_id' => $request->input('agriculture_id'),
            'quality_id' => $request->input('quality_id'),
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
        ]);

        $request->session()->flash('success', 'Data Berhasil Diubah');

        return redirect($this->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $response = [
            'success' => TRUE,
            'message' => 'Data Produk Berhasil Dihapus'
        ];

        return json_encode($response);
    }
}
