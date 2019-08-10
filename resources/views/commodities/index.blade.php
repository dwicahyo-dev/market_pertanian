@extends('layouts.app')
@section('title', 'Komoditas')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Komoditas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Komoditas</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Komoditas Yang Tersedia</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>
        <div class="row">
            @forelse($commodities as $commodity)
            <div class="col-12 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="200">
                            <h2>{{ $commodity->commodity_name }}</h2>
                            <a href="{{ route('commodity.show', $commodity->id) }}"
                                class="btn btn-outline-primary mt-4 btn-block">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <img class="img-fluid" src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                alt="image">
                            <h2 class="mt-0">Oops, data komoditas kosong</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        {{ $commodities->links() }}
    </div>
</section>
@endsection

@section('script')

@endsection