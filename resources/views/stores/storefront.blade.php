@extends('layouts.app')
@section('title', 'Toko')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('stores.show', $store->id) }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Etalase Hasil Pertanian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('stores.index') }}">Toko</a></div>
            <div class="breadcrumb-item active"><a
                    href="{{ route('stores.show', $store->id) }}">{{ $store->store_name }}</a></div>
            <div class="breadcrumb-item">Etalase Hasil Pertanian</div>
            <div class="breadcrumb-item">{{ $agriculture->agriculture_name }}</div>
        </div>
    </div>

    <div class="section-body">
        @include('stores.partials.header')

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                @include('stores.partials.storefront')

                @include('stores.partials.product_filter')

                <div class="card">
                    <div class="card-header">
                        <h4>Status Produk</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Stok tersedia
                                <span class="badge badge-primary badge-pill">{{ $inStock }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Stok tidak tersedia
                                <span class="badge badge-primary badge-pill">{{ $outStock }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tidak berdasarkan standar harga
                                <span
                                    class="badge badge-primary badge-pill">{{ $productNotStandardized->count() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <h2 class="section-title mt-0">Daftar Produk</h2>
                <p class="section-lead">Daftar produk berdasarkan etalase hasil pertanian
                    "<b>{{ $agriculture->agriculture_name }}</b>"
                </p>

                @include('partials.products_store')
            </div>
        </div>

    </div>
</section>
@endsection

@section('script')
@endsection