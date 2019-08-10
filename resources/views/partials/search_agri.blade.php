@extends('layouts.app')
@section('title', 'Pencarian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pencarian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Pencarian</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ Helpers::setSelectedSegmentOne('search') }}"
                                    href="{{ route('search', ['st' => 'agriculture', 'q'=> $query]) }}">Hasil Pertanian
                                    <span class="badge badge-danger">{{ $countAgri }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Helpers::setSelectedSegmentTwo('stockless') }}"
                                    href="{{ route('search', ['st' => 'store', 'q'=> $query]) }}">Toko
                                    <span class="badge badge-danger">{{ $countStore }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Daftar Hasil Pencarian | Hasil Pertanian</h2>
            </div>

            @forelse($searchAgri as $agriculture)
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
                                    <a href="{{ route('agricultures.show', $agriculture->id) }}">
                                        {{ $agriculture->agriculture_name }}
                                    </a>
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
                            <h2 class="mt-0">Oops, pencarian hasil pertanian kosong</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{ $searchAgri->links() }}
    </div>
</section>
@endsection

@section('script')

@endsection