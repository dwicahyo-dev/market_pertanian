@extends('layouts.app') 
@section('title', 'Pengaturan') 
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengaturan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Pengaturan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Overview</h2>
        <p class="section-lead">Atur dan sesuaikan semua pengaturan tentang situs ini.</p>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="card-body">
                        <h4>Daftar Alamat</h4>
                        <p>Ubah daftar alamat pengiriman barang anda di halaman ini.</p>
                        <a href="{{ route('addresses.index') }}" class="card-cta">Ubah Pengaturan <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="card-body">
                        <h4>Toko</h4>
                        <p>Ubah pengaturan mengenai Toko anda pada halaman ini.</p>
                        <a href="features-setting-detail.html" class="card-cta">Ubah Pengaturan <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
</section>
@endsection
 
@section('script')
@endsection