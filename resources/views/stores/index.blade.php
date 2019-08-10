@extends('layouts.app')
@section('title', 'Toko')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Toko</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Toko</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Toko Yang Tersedia</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>
        <div class="row">
            @forelse($stores as $store)

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <a href="{{ route('stores.show', $store->id) }}">
                    <article class="article article-style-b">
                        <div class="article-header">
                            @isset($store->thumbnail)
                            <div class="article-image"
                                data-background="{{ Storage::url('stores/'. $store->thumbnail) }}">
                            </div>
                            @else
                            <div class="article-image" data-background="{{ asset('assets/img/example-image.jpg') }}">
                            </div>
                            @endisset
                        </div>
                        <div class="article-details">
                            <div class="article-title">
                                <h2><a href="{{ route('stores.show', $store->id) }}">{{ $store->store_name }}</a></h2>
                            </div>
                            <p>
                                <i class="fas fa-map-marker-alt"></i> {{ $store->city->type }}
                                {{ $store->city->city_name }}
                            </p>
                            <div class="article-cta">
                                <a href="{{ route('stores.show', $store->id) }}">Lihat Toko <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <img class="img-fluid" src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                alt="image">
                            <h2 class="mt-0">Oops, toko kosong</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{ $stores->links() }}
    </div>
</section>
@endsection

@section('script')
@endsection