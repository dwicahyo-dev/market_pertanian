@extends('layouts.app')
@section('title', 'Store Dashboard')
@section('content')

<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Dashboard Toko</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('setting.index') }}">Pengaturan</a></div>
      <div class="breadcrumb-item">Dashboard Toko</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{ Auth::user()->store->store_name }}</h2>
    <p class="section-lead">
      You can adjust all general settings here
    </p>

    <div class="row">
      <div class="col-12">
        <div class="card mb-0">
          <div class="card-body">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" href="http://mp.test/manage-products/stocked">Produk Tersedia
                  <span class="badge badge-danger">0</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="http://mp.test/manage-products/stockless">Produk Tidak Tersedia
                  <span class="badge badge-danger">0</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="row"> --}}
    {{-- <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h4>{{ Auth::user()->store->store_name }}</h4>
  </div>
  <div class="card-body">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item"><a href="{{ route('settings.store') }}"
          class="nav-link {{ Helpers::setSelectedSegmentThree('my_store') }}">Ringkasan Toko</a></li>
      <li class="nav-item"><a href="{{ route('settings.order') }}"
          class="nav-link {{ Helpers::setSelectedSegmentThree('pesanan') }}">Pesanan</a></li>
    </ul>
  </div>
  </div>
  </div>

  <div class="col-md-8">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Title</h5>
          <p class="card-text">Content</p>
        </div>
      </div>
    </div>
  </div> --}}

  </div>

  <div class="col-md-8">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Produk</h4>
          </div>
          <div class="card-body">
            {{ $store->products->count() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- </div> --}}

  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-archive"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Produk</h4>
        </div>
        <div class="card-body">
          {{ $store->products->count() }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="far fa-newspaper"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Produk Tersedia</h4>
        </div>
        <div class="card-body">
          {{ $store->products->where('product_status', true)->count() }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="far fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Produk Tidak Tersedia</h4>
        </div>
        <div class="card-body">
          {{ $store->products->where('product_status', false)->count() }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Produk Terjual</h4>
        </div>
        <div class="card-body">
          47
        </div>
      </div>
    </div>
  </div>

  </div>

  <div class="row">
    <div class="col-12 col-md-6 col-lg-6">
      <div class="card card-primary">
        <div class="card-header">
          <h4>Ringkasan Akun</h4>
        </div>
        <div class="card-body">

        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6">
      <div class="card card-primary">
        <div class="card-header">
          <h4>Ringkasan Toko</h4>
        </div>
        <div class="card-body">

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Line Chart</h4>
        </div>
        <div class="card-body">
          <canvas id="myChart" height="85"></canvas>
        </div>
      </div>
    </div>
  </div>


</section>

@endsection