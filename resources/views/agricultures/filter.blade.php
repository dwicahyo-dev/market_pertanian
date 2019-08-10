@extends('layouts.app')
@section('title', 'Hasil Pertanian')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('agricultures.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $agriculture->agriculture_name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('agricultures.index') }}">Hasil Pertanian</a></div>
            <div class="breadcrumb-item">{{ $agriculture->agriculture_name }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hasil Pertanian</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>

        <div id="output-status"></div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Nama Hasil Pertanian</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="javascript:void(0)"
                                    class="nav-link active">{{ $agriculture->agriculture_name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                @include('agricultures.partials.product_filter')
                @include('agricultures.partials.product_status')

            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <h2 class="section-title mt-0">Daftar Produk</h2>
                <p class="section-lead">Daftar produk yang berasosiasi dengan hasil pertanian
                    "{{ $agriculture->agriculture_name }}"</p>

                @include('partials.products_filter')
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection