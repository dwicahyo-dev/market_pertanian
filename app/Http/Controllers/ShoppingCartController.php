<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Illuminate\Http\Request;
use App\Address;

// use App\Http\Controllers\RajaOngkir\Costs;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('verified')->only(['store']);
    }

    private $redirectTo = 'carts';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = ShoppingCart::with(['user', 'product.store.city', 'product.quality'])
            ->where('user_id', auth()->id())
            ->get();

        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $product_id = $request->product_id;
        $qty = $request->qty;

        $product = Product::find($product_id);

        $cart = ShoppingCart::where([
            'product_id' => $product_id,
            'user_id' => auth()->id()
        ])->get()->first();

        if ($cart) {
            $total_qty = $cart->qty + $qty;

            if ($total_qty > $product->stock) {
                $request->session()->flash('error', 'Tidak dapat melebihi stok produk. Harap kurangi jumlah kuantitas produk');

                return redirect()->route('products.show', $product_id);
            } else {
                $cart->update([
                    'qty' => $total_qty
                ]);

                $request->session()->flash('success', 'Keranjang Belanja #' . $cart->id . ' berhasil diubah.');
            }
        } else {
            $cart = ShoppingCart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'seller_note' => $request->seller_note
            ]);

            $request->session()->flash('success', 'Keranjang Belanja #' . $cart->id . ' berhasil ditambahkan.');
        }

        return redirect()->route('carts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $cart)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $cart)
    {
        $this->authorize('update', $cart);

        return view('carts.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $cart)
    {
        $cart->update([
            'qty' => $request->quantity,
            'seller_note' => $request->seller_note,
        ]);

        $request->session()->flash('success', 'Keranjang Belanja #' . $cart->id . ' berhasil diubah.');

        return redirect($this->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $cart)
    {
        $cart->delete();

        $response = [
            'success' => TRUE,
            'message' => 'Keranjang Belanja Berhasil Dihapus'
        ];

        return json_encode($response);
    }

    public function checkOut(ShoppingCart $cart)
    {
        $this->authorize('checkOut', $cart);

        $addresses = Address::with(['city'])->where('user_id', Auth::id())->get();
        $product = $cart->product;
        $qualityProduct = $cart->product->quality;
        $agricultureProduct = $cart->product->agriculture;
        $agricultureCommodityProduct = $cart->product->agriculture->commodity;
        $store = $cart->product->store;
        $store_city = $cart->product->store->city;
        $storeUser = $cart->product->store->user;
        $user = $cart->user;

        return view(
            'carts.checkout',
            compact(
                'cart',
                'addresses',
                'product'
            )
        );
    }

    protected function rulesShipping()
    {
        return [
            'address' => 'required',
            'courier' => 'required',
        ];
    }
}
