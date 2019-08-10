@extends('layouts.app')
@section('title', 'Ubah Keranjang Belanja')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('carts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Ubah Keranjang Belanja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('carts.index') }}">Keranjang Belanja</a></div>
            <div class="breadcrumb-item">Ubah Keranjang Belanja</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Ubah Keranjang Belanja</h2>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="gallery gallery-fw" data-item-height="500">
                                    <div class="gallery-item"
                                        data-image="{{ Storage::url('products/'. $cart->product->thumbnail) }}"
                                        data-title="{{ $cart->product->product_name }}"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-auto text-justify">
                                    <h2>{{ $cart->product->product_name }}</h2>
                                </div>

                                <hr>

                                <div class="form-group col-md-12">
                                    @if ($cart->product->product_status == true)
                                    <label for="inputEmail4">Jumlah Stok Tersedia</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control text-left" disabled
                                            value="{{ $cart->product->stock }}" id="inlineFormInputGroup2">
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
                                            value="{{ RupiahHelper::formatProduct($cart->product->price)  }}"
                                            id="inlineFormInputGroup2">
                                        <div class="input-group-append">
                                            <div class="input-group-text">/ Kilogram</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Kualitas Produk</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control text-left" disabled
                                            value="{{ $cart->product->quality->quality_name }}">
                                    </div>
                                </div>

                                <hr>

                                <form method="POST" action="{{ route('carts.update', $cart->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail4">Kuantitas Produk (dalam Kilogram)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button"
                                                        class="quantity-left-minus btn btn-primary btn-number"
                                                        data-type="minus" data-field="">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="number" id="quantity" name="quantity" min="1"
                                                    max="{{ $cart->product->stock }}" class="form-control text-center"
                                                    value="{{ $cart->qty }}" id="inlineFormInputGroup2">
                                                <div class="input-group-prepend">
                                                    <button type="button"
                                                        class="quantity-right-plus btn btn-primary btn-number"
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
                                                    placeholder="Catatan untuk Penjual">{{ $cart->seller_note }}</textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

</section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        let quantitiy=0;
        let max;

        $('.quantity-right-plus').click(function(e){
            e.preventDefault();

            let quantity = parseInt($('#quantity').val());

            $("#quantity").attr("max", function(index, currentvalue){
                max = parseInt(currentvalue);
            });

            if (quantity < max) {
                $('#quantity').val(quantity + 1);
            }

        });

        $('.quantity-left-minus').click(function(e){
            e.preventDefault();

            let quantity = parseInt($('#quantity').val());

            if(quantity > 1){
                $('#quantity').val(quantity - 1);
            }
        });
    });

</script>
@endsection