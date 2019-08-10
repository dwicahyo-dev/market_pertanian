@extends('layouts.app')
@section('title', 'Situs Belanja Online Hasil Pertanian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Mau Beli Apa Hari Ini?</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item ">Dashboard</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Temukan produk segar yang Anda butuhkan di sini.</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>
        <div class="card card-primary">
            <div class="card-header ">
                <h4>Hasil Pertanian</h4>
                <div class="card-header-action">
                    <a href="{{ route('agricultures.index') }}" class="btn btn-primary btn-icon icon-right">Lihat Lebih
                        Banyak <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="owl-carousel owl-theme" id="products-carousel">
                    @foreach ($agricultures as $agriculture)
                    <div class="product-item pb-3">
                        @if ($agriculture->thumbnail)
                        <div class="product-image">
                            <img alt="image" src="{{ env('APP_AGRICULTURE_IMAGE_LOCATION'). $agriculture->thumbnail }}"
                                class="img-fluid">
                        </div>
                        @else
                        <div class="product-image">
                            <img alt="image" src="{{ asset('assets/img/products/product-1.jpg') }}"
                                class="img-fluid">
                        </div>
                        @endif
                        <div class="product-details">
                            <div class="product-name">{{ $agriculture->agriculture_name }}</div>
                            <div class="text-muted text-small">{{ $agriculture->commodity->commodity_name }}</div>
                            <div class="product-cta">
                                <a href="{{ route('agricultures.show', $agriculture->id) }}"
                                    class="btn btn-primary">Lihat Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

<script>
    $("#products-carousel").owlCarousel({
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
            items: 2
            },
            578: {
            items: 4
            },
            768: {
            items: 4
            }
        }
    });

</script>
@endsection