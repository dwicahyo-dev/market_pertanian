@extends('layouts.app')
@section('title', 'Edit Produk')
@section('css')
@if ($errors->has('thumbnail'))
<style>
    .img-thumbnail {
        border-color: #dc3545 !important;
    }
</style>
@endif
@endsection

@section('content')
<section class="section">
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input type="hidden" name="has_standard_price">

        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('products.manage-product.stocked') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Edit Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('products.manage-product.stocked') }}">Daftar
                        Produk</a></div>
                <div class="breadcrumb-item">Edit Produk</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Produk</h2>

            <div id="output-status"></div>
            <div class="row">
                <div class="col-12 col-sm-5 col-md-5 col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Gambar Produk</h4>
                        </div>
                        <div class="card-body">

                            <img class="img-fluid img-thumbnail" id='img-upload' style="width: 100%"
                                src="{{ Storage::url('products/'. $product->thumbnail) }}">
                            <div class="form-group mt-3">
                                <label>Foto Produk (Thumbnail)</label>
                                <p>Besar file: maksimum 5.000.000 bytes (5 Megabytes) <br>
                                    Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                                </p>
                                <input type="file" name="thumbnail" class="btn-file" id="imgInp"
                                    accept="image/x-png,image/jpg,image/jpeg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-7 col-md-7 col-lg-8">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Produk</h4>
                        </div>
                        <div class="card-body">
                            @include('partials.error_alert')
                            @include('partials.session_error_alert')

                            <div class="form-group ">
                                <label>Nama Produk</label>
                                <input type="text" name="product_name"
                                    class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}"
                                    value="{{ $product->product_name }}" placeholder="Nama Produk" autofocus="">
                            </div>

                            <div class="form-group ">
                                <label>Hasil Pertanian</label>
                                <select name="agriculture_id" class="form-control" style="width: 100%">
                                    <option value="">-- Pilih Hasil Pertanian --</option>
                                    @foreach ($agricultures as $agriculture)
                                    <option value="{{ $agriculture->id }}"
                                        {{ ($product->agriculture->id == $agriculture->id) ? 'selected' : ''  }}>
                                        {{ $agriculture->agriculture_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label>Kualitas Produk</label>
                                <select name="quality_id" class="form-control" style="width: 100%">
                                    <option value="">-- Pilih Kualitas Produk --</option>
                                    @foreach ($qualities as $quality)
                                    <option value="{{ $quality->id }}"
                                        {{ ($product->quality->id == $quality->id) ? 'selected' : '' }}>
                                        {{ $quality->quality_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Jumlah Stok</label>
                                    <div class="input-group mb-2">
                                        <input type="text"
                                            class="form-control text-left num {{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                            name="stock" value="{{ $product->stock }}" id="inlineFormInputGroup2"
                                            placeholder="Stok Produk">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kilogram</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Harga Produk</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" name="price"
                                            class="form-control text-left num {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                            value="{{ str_replace('.00', '', $product->price)  }}"
                                            id="inlineFormInputGroup2" placeholder="Harga Produk">
                                        <div class="input-group-append">
                                            <div class="input-group-text">/Kilogram</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label>Deskripsi Produk</label>
                                <textarea name="description" placeholder="Deskripsi Produk"
                                    class="form-control summernote-simple {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $product->description }}</textarea>
                            </div>

                            <button class="btn btn-primary mr-1" type="submit">Update</button>
                            <a href="{{ route('products.manage-product.stocked') }}" role="button"
                                class="btn btn-danger">Batal</a>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </form>

</section>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        $("select").select2();

        // $('.num').mask('000.000.000', {reverse: true});
    });

</script>
@endsection