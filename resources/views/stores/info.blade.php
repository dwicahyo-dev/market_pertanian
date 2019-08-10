@extends('layouts.app')
@section('title', 'Informasi Toko')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('stores.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $store->store_name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('stores.index') }}">Toko</a></div>
            <div class="breadcrumb-item active"><a
                    href="{{ route('stores.show', $store->id) }}">{{ $store->store_name }}</a></div>
            <div class="breadcrumb-item">Informasi Toko</div>
        </div>
    </div>

    <div class="section-body">

        @include('stores.partials.header')

        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Store Owner</h4>
                    </div>
                    <div class="card-body">
                        <div class="gallery gallery-fw d-flex justify-content-center" data-item-height="500">
                            <figure class="avatar avatar-xl bg-info text-white"
                                data-initial="{{ substr($store->store_name, 0, 2)  }}">
                            </figure>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-center">
                            {{ $store->user->name }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <h5>{{ $countTransactions }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Produk</h4>
                        </div>
                        <div class="card-body">
                            {{ $store->products->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection