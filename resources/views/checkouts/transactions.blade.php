@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('checkout.invoice') }}">Daftar Transaksi</a></div>
            <div class="breadcrumb-item active">Transaksi Penjualan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Daftar Transaksi</h2>

        <div class="row">
            @include('checkouts.partials.menu')

            @include('checkouts.partials.invoices')
        </div>
    </div>
</section>
@endsection

