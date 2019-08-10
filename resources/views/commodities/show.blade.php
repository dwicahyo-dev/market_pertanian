@extends('layouts.app')
@section('title', 'Komoditas')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('commodity.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $commodity->commodity_name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('commodity.index') }}">Komoditas</a></div>
            <div class="breadcrumb-item">{{ $commodity->commodity_name }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Komoditas</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>

        <div id="output-status"></div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Nama Komoditas</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link active">{{ $commodity->commodity_name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <h2 class="section-title mt-0">Daftar Hasil Pertanian</h2>
                <p class="section-lead">Daftar hasil pertanian yang berasosiasi dengan komoditas
                    "{{ $commodity->commodity_name }}"</p>

                <div class="row">
                    @forelse($agricultures as $agriculture)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <a href="{{ route('agricultures.show', $agriculture->id) }}">
                            <article class="article article-style-b">
                                <div class="article-header">
                                    @if ($agriculture->thumbnail)
                                    <div class="article-image"
                                        data-background="{{ env('APP_AGRICULTURE_IMAGE_LOCATION'). $agriculture->thumbnail }}">
                                    </div>
                                    @else
                                    <div class="article-image"
                                        data-background="{{ asset('assets/img/news/img13.jpg') }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h2>
                                            <a
                                                href="{{ route('agricultures.show', $agriculture->id) }}">{{ $agriculture->agriculture_name }}</a>
                                        </h2>
                                    </div>
                                    <div class="article-cta">
                                        <a href="{{ route('agricultures.show', $agriculture->id) }}">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
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
                                    <img class="img-fluid"
                                        src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                        alt="image">
                                    <h2 class="mt-0">Oops, hasil pertanian kosong</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="float-right">
                    {{ $agricultures->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection