@extends('layouts.app')
@section('title', 'Toko')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="#" onclick="history.go(-1);return false;" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Edit Diskusi Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('home') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item active">
                <a href="{{ route('stores.index') }}">Toko</a>
            </div>
            <div class="breadcrumb-item active">
                <a href="{{ route('stores.show', $product->store->id) }}">{{ $product->store->store_name }}</a>
            </div>
            <div class="breadcrumb-item active">
                <a href="{{ route('products.discussions', $product->id) }}">{{ $product->product_name }}</a>
            </div>
            <div class="breadcrumb-item">Edit Diskusi Produk</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Edit Diskusi Produk</h2>

        <div class="row">
            {{-- <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>

                    <div class="card-body">
                    </div>
                </div>
            </div> --}}

            <div class="mt-2 col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Isi Diskusi</h4>
                    </div>
                    <div class="card-body">

                        <form
                            action="{{ route('products.discussions.update', ['product' => $product->id, 'product_discussion' => $productDiscussion->id]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group ">
                                <input type="text" name="body" value="{{ $productDiscussion->body }}"
                                    class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
                                    placeholder="Apa yang ingin Anda tanyakan mengenai produk ini ?">

                                @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                                @endif
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary mr-1" type="submit">Update</button>
                                <a href="{{ route('products.discussions', $product->id) }}"
                                    class="btn btn-danger">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection