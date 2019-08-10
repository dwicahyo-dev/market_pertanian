@extends('layouts.app')
@section('title', 'Product Review')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('checkout.show', $checkout->id) }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Ulasan Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('checkout.invoice') }}">Daftar Transaksi</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('checkout.show', $checkout->id) }}">Detail
                    Transaksi</a></div>
            <div class="breadcrumb-item active">Ulasan Produk</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Ulasan Produk</h2>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        @include('partials.error_alert')

                        <form method="POST" action="{{ route('checkout.review.store', $checkout->id) }}">
                            @csrf

                            <div class="form-group ">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" value="{{ $checkout->product->product_name }}"
                                    disabled>
                            </div>

                            <div class="form-group ">
                                <label>Isi Ulasan</label>
                                <textarea name="body_review" placeholder="Isi Ulasan"
                                    class="form-control {{ $errors->has('body_review') ? ' is-invalid' : '' }}">{{ old('body_review') }}</textarea>
                            </div>

                            <div class="form-group ">
                                <label>Bintang</label>
                                <select name="stars" class="form-control selectric">
                                    <option value="">-- Pilih Jumlah Bintang --</option>
                                    <option value="1" {{ old('stars') ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ old('stars') ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ old('stars') ? 'selected' : ''}}>3</option>
                                    <option value="4" {{ old('stars') ? 'selected' : ''}}>4</option>
                                    <option value="5" {{ old('stars') ? 'selected' : ''}}>5</option>
                                </select>
                            </div>

                            <div class="div mt-5">
                                <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                                <a href="{{ route('checkout.show', $checkout->id) }}" role="button"
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

@section('script')

@endsection