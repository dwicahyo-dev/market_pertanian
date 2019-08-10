<?php

namespace App\Http\Controllers;

use App\ProductDiscussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;

class ProductDiscussionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    protected function rules()
    {
        return [
            'body' => 'required',
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
        $this->validate($request, $this->rules());

        $discussion = ProductDiscussion::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'body' => $request->body
        ]);

        $request->session()->flash('success', 'Berhasil Menambahkan Diskusi Produk');

        return redirect()->route('products.discussions', $discussion->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDiscussion $productDiscussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, ProductDiscussion $productDiscussion)
    {
        $this->authorize('update', $productDiscussion);

        return view('products.edit_discussion', compact('product', 'productDiscussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, ProductDiscussion $productDiscussion)
    { 
        $productDiscussion->update([
            'body' => $request->body
        ]);
        
        $request->session()->flash('success', 'Berhasil Mengubah Diskusi Produk');

        return redirect()->route('products.discussions', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductDiscussion $productDiscussion)
    {
        $this->authorize('delete', $productDiscussion);

        $productDiscussion->delete();

        $response = [
            'success' => TRUE,
            'message' => 'Diskusi Produk Berhasil Dihapus'
        ];

        return json_encode($response);
    }
}
