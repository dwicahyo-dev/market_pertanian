@extends('layouts.app')
@section('title', 'Review Produk')
@section('css')
<style>
    .product-item {
        text-align: justify !important;
    }
</style>
@endsection
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
            <div class="breadcrumb-item">Review Produk</div>
        </div>
    </div>

    <div class="section-body">

        @include('stores.partials.header')

        <div class="row">
            <div class="col-12">
                @forelse ($rev as $item)
                <div class="card">
                    <div class="card-header">
                        <figure class="avatar mr-2 avatar-lg bg-info text-white"
                            data-initial="{{ substr($item->user->name, 0, 2)  }}">
                        </figure>
                        <h4>{{ $item->user->name }}</h4> <span class="badge badge-primary">Pembeli</span>
                        <div class="ml-auto">
                            <span class="font-italic">{{ $item->created_at->format('l, d F Y H:i ') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <a href="{{ route('products.show', $item->product->product_real_id) }}">
                                    <article class="article article-style-c">
                                        <div class="article-header">
                                            <div class="article-image"
                                                data-background="{{ Storage::url('products/'. $item->product->thumbnail) }}">
                                            </div>
                                            <div class="article-badge">
                                                <div class="article-badge-item bg-primary"><i class="fas fa-fire"></i>
                                                    {{ $item->product->quality->quality_name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="article-details">
                                            <div class="article-title">
                                                <h2>
                                                    <a
                                                        href="{{ route('products.show', $item->product->product_real_id) }}">{{ $item->product->product_name }}</a>
                                                </h2>
                                                <p class="text-danger">
                                                    {{ RupiahHelper::format($item->product->price) }} /Kg</p>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-9 col-lg-9">
                                <div class="product-item">
                                    <div class="product-details">
                                        <div class="product-review">
                                            @for ($i = 0; $i < $item->stars; $i++)
                                                <i class="fas fa-star"></i>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                <h5>{{ $item->body_review }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                        alt="image">
                                    <h2 class="mt-0">
                                        Oops, Belum ada ulasan produk
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse

                {{ $rev->links() }}

            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection