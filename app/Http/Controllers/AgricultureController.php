<?php

namespace App\Http\Controllers;

use App\Agriculture;
use Illuminate\Http\Request;
use App\Quality;
use App\Store;

class AgricultureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agricultures = Agriculture::paginate(12);

        return view('agricultures.index', compact('agricultures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getProductsStandarized($agriculture)
    {
        $standardPrice = $this->getStandardPrice($agriculture);

        return $agriculture->products()
            ->where('agriculture_id', $agriculture->id)
            ->whereBetween('price', [
                $standardPrice['lowestPrice'],
                $standardPrice['highestPrice']
            ]);
    }

    public function getStandardPrice($agriculture)
    {
        $standardPrice = $agriculture->standardPrice;

        if (!$standardPrice) {
            return null;
        }

        return [
            'lowestPrice' => $standardPrice->lowest_price,
            'highestPrice' => $standardPrice->highest_price
        ];
    }

    public function getProductsNotStandarized($agriculture)
    {
        $standardPrice = $this->getStandardPrice($agriculture);

        return $agriculture->products()
            ->whereNotBetween('price', [
                $standardPrice['lowestPrice'],
                $standardPrice['highestPrice']
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agriculture  $agriculture
     * @return \Illuminate\Http\Response
     */
    public function show(Agriculture $agriculture)
    {
        $qualities = Quality::all();
        $productO = $this->getProductsStandarized($agriculture);
        $productNotStandardized = $this->getProductsNotStandarized($agriculture);

        $productF = $productO->get();
        $inStock = $productF->where('product_status', true)->count();
        $outStock = $productF->where('product_status', false)->count();

        $products = $productO->paginate(12);

        return view(
            'agricultures.show',
            compact(
                'agriculture',
                'products',
                'qualities',
                'productNotStandardized',
                'inStock',
                'outStock'
            )
        );
    }

    public function filter(Request $request, Agriculture $agriculture)
    {
        $qualities = Quality::all();

        $productsO = $this->getProductsStandarized($agriculture);

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

        $prs =  $productsO->paginate(12)->appends([
            'quality' => $request->quality,
            'price' => $request->price,
        ]);

        return view('agricultures.filter', compact(
            'agriculture',
            'prs',
            'qualities',
            'productNotStandardized',
            'inStock',
            'outStock'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agriculture  $agriculture
     * @return \Illuminate\Http\Response
     */
    public function edit(Agriculture $agriculture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agriculture  $agriculture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agriculture $agriculture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agriculture  $agriculture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agriculture $agriculture)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->q ?? abort(404);

        $agri = Agriculture::where('agriculture_name', 'like', '%' . $request->q . '%');
        $store = Store::where('store_name', 'like', '%' . $request->q . '%');

        $countAgri = $agri->get()->count();
        $countStore = $store->get()->count();


        if ($request->st == 'agriculture') {
            $searchAgri = $agri->paginate(12)->appends([
                'st' => 'agriculture',
                'q' => $request->q,
            ]);

            return view('partials.search_agri', compact('searchAgri', 'countAgri', 'countStore', 'query'));
        }

        if ($request->st == 'store') {
            $searchStore = $store->paginate(12)->appends([
                'st' => 'store',
                'q' => $request->q,
            ]);

            return view('partials.search_store', compact('searchStore', 'countAgri', 'countStore', 'query'));
        }
    }
}
