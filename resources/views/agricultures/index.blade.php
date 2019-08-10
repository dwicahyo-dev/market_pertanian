@extends('layouts.app')
@section('title', 'Hasil Pertanian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Hasil Pertanian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Hasil Pertanian</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hasil Pertanian Yang Tersedia</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>
        <div class="row">
            @forelse($agricultures as $agriculture)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <a href="{{ route('agricultures.show', $agriculture->id) }}">
                    <article class="article article-style-b">
                        <div class="article-header">
                            @if ($agriculture->thumbnail)
                            <div class="article-image"
                                data-background="{{ env('APP_AGRICULTURE_IMAGE_LOCATION'). $agriculture->thumbnail }}">
                            </div>
                            @else
                            <div class="article-image" data-background="{{ asset('assets/img/news/img13.jpg') }}">
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
                            <img class="img-fluid" src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                alt="image">
                            <h2 class="mt-0">Oops, data hasil pertanian kosong</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{ $agricultures->links() }}
    </div>
</section>
@endsection

@section('script')
@endsection