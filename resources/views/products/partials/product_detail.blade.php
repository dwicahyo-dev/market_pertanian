<div class="card card-primary">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="gallery gallery-fw" data-item-height="500">
                    <div class="gallery-item" data-image="{{ Storage::url('products/'. $product->thumbnail) }}"
                        data-title="{{ $product->product_name }}"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="m-auto text-justify">
                    <h2>{{ $product->product_name }}</h2>
                    @can('update', $product)
                    <a href="{{ route('products.edit', $product->id) }}" class="badge badge-primary"><i
                            class="far fa-edit"></i> Edit Produk</a>
                    @endcan
                </div>

                <hr>

                <div class="form-group col-md-12">
                    @if ($product->product_status == true)
                    <label for="inputEmail4">Jumlah Stok Tersedia</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control text-left" disabled value="{{ $product->stock }}"
                            id="inlineFormInputGroup2">
                        <div class="input-group-append">
                            <div class="input-group-text">Kilogram</div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Harga Produk</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="text" disabled class="form-control text-left num"
                            value="{{ RupiahHelper::formatProduct($product->price)  }}" id="inlineFormInputGroup2">
                        <div class="input-group-append">
                            <div class="input-group-text">/ Kilogram</div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="inputEmail4">Kualitas Produk</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control text-left" disabled
                            value="{{ $product->quality->quality_name }}">
                    </div>
                </div>

                <hr>

                <form action="{{ route('carts.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Quantitiy --}}
                    @if ($product->product_status == true)
                    <div class="col-12">
                        <div class="form-group">
                            <label for="inputEmail4">Kuantitas Produk (dalam Kilogram)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="quantity-left-minus btn btn-primary btn-number"
                                        data-type="minus" data-field="">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" id="quantity" name="qty" min="1" max="{{ $product->stock }}"
                                    class="form-control text-center" value="1" id="inlineFormInputGroup2">
                                <div class="input-group-prepend">
                                    <button type="button" class="quantity-right-plus btn btn-primary btn-number"
                                        data-type="plus" data-field="">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail4">Catatan untuk Penjual (Opsional)</label>
                            <div class="input-group">
                                <textarea name="seller_note"
                                    class="form-control {{ $errors->has('notes') ? ' is-invalid' : '' }}"
                                    placeholder="Catatan untuk Penjual"></textarea>
                            </div>
                        </div>
                    </div>
                    @endif


                    <div class="col-12">
                        {{-- Checking product status is false --}}
                        @if ($product->product_status == false || $product->stock == 0)
                        <a href="javascript:void(0)" class="btn btn-primary btn-block disabled">Beli
                            Sekarang</a>
                        @else
                        {{-- Product Status is true --}}
                        {{-- Authorization Product --}}
                        @can('buy_product', $product)
                        <button type="submit" class="btn btn-outline-primary btn-block">Beli Sekarang</button>
                        @endcan

                        @guest
                        <button type="submit" class="btn btn-outline-primary btn-block">Beli Sekarang</button>
                        @endguest
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="card-footer bg-whitesmoke">
        {{-- Product Navbar --}}
        @include('products.partials.product_navbar')

        {{-- Product Nav --}}
        @if (Helpers::ifSegmentThree('discussions'))
        @include('products.partials.body-discussions')
        @elseif (Helpers::ifSegmentThree('reviews'))
        @include('products.partials.product_review')
        @else
        @include('products.partials.body') @endif
    </div>
</div>