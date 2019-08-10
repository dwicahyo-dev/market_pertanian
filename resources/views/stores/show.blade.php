@extends('layouts.app')
@section('title', 'Toko')
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
            <div class="breadcrumb-item">{{ $store->store_name }}</div>
        </div>
    </div>

    <div class="section-body">

        @include('stores.partials.header')

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                @include('stores.partials.storefront')
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="600">
                            <img class="img-fluid " width="500"
                                src="{{ asset('assets/img/drawkit/drawkit-full-stack-man-colour.svg') }}" alt="image">
                            <h2 class="mt-0">Oops, pilih etalase terlebih dahulu</h2>
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