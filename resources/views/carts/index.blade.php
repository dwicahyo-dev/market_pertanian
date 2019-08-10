@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Keranjang Belanja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Daftar Keranjang Belanja</div>
        </div>
    </div>

    <div class="section-body">

        @include('partials.alert_success')

        <div class="row">
            @forelse ($carts as $cart)
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <span class="text-small text-muted">
                            #{{ $cart->id }} &ensp;
                        </span>
                        <a href="{{ route('stores.show', $cart->product->store->id) }}" class="font-weight-600">
                            @isset($cart->product->store->thumbnail)
                            <img src="{{ Storage::url('stores/'. $cart->product->store->thumbnail) }}" alt="avatar"
                                width="30" class="rounded-circle mr-1">{{ $cart->product->store->store_name }}
                            @else
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="avatar" width="30"
                                class="rounded-circle mr-1">{{ $cart->product->store->store_name }}
                            @endisset
                        </a>
                        &ensp; &mdash; &ensp;
                        <span class="text-small text-muted">
                            {{ $cart->product->store->city->type }}
                            {{ $cart->product->store->city->city_name }},
                            {{ $cart->product->store->city->province }}
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Produk</th>
                                        <th>Kualitas Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>
                                            <a href="{{ route('products.show', $cart->product->id) }}"
                                                class="font-weight-600">
                                                <img src="{{ Storage::url('products/'. $cart->product->thumbnail) }}"
                                                    alt="avatar" width="45" class="rounded-circle mr-1">
                                                {{ $cart->product->product_name }}</a>
                                        </td>
                                        <td>
                                            {{ $cart->product->quality->quality_name }}
                                        </td>
                                        <td>
                                            {{ $cart->qty }} Kg
                                        </td>
                                        <td>
                                            {{ RupiahHelper::format($cart->product->price)  }} /Kg
                                        </td>
                                        <td>
                                            {{ Helpers::totalPrice($cart->qty, $cart->product->price) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5">
                                            <hr>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <a href="{{ route('carts.edit', $cart->id) }}" class="btn btn-outline-info">
                                <i class="far fa-edit"></i> Ubah
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger" model="carts" id="btnDelete"
                                onclick="deleteData({{ $cart->id }})">
                                <i class="far fa-trash-alt"></i> Hapus
                            </a>

                        </div>
                        <div class="float-right">
                            <a href="{{ route('carts.checkout', $cart->id) }}" class="btn btn-primary">Lanjut Pembayaran
                                <i class="fas fa-arrow-right"></i></a>
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
                            <h2 class="mt-0">Oops, keranjang belanja kosong</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</section>
@endsection

@section('script')
@endsection