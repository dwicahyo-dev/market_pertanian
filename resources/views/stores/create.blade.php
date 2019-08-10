@extends('layouts.app')
@section('title', 'Buka Toko')
@section('css')
@if ($errors->has('city_id'))
<style>
    .select2-selection--single {
        border-color: #dc3545 !important;
    }
</style>
@endif
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('stores.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Buka Toko</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('stores.index') }}">Toko</a></div>
            <div class="breadcrumb-item">Buka Toko</div>
        </div>
    </div>

    <div class="section-body">


        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <img class="img-fluid  mt-0" src="{{ asset('assets/img/drawkit/storefront-colour.svg') }}" alt="image">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <div class="card card-primary">

                    <div class="card-body">
                        <h2 class="section-title mt-0">Hi, {{ Auth::user()->name }}</h2>
                        <p class="section-lead">Selamat datang di Market Pertanian, ayo buka toko sekarang!</p>

                        @include('partials.error_alert')

                        <form method="POST" action="{{ route('stores.store') }}">
                            @csrf

                            <div class="form-group ">
                                <label>Nama Toko</label>
                                <input type="text" name="store_name"
                                    class="form-control {{ $errors->has('store_name') ? ' is-invalid' : '' }}"
                                    value="{{ old('store_name') }}" placeholder="Nama Toko" autofocus>
                            </div>

                            <div class="form-group ">
                                <label>Slogan (Optional)</label>
                                <input type="text" name="slogan"
                                    class="form-control {{ $errors->has('slogan') ? ' is-invalid' : '' }}"
                                    value="{{ old('slogan') }}" placeholder="Slogan">
                            </div>

                            <div class="form-group ">
                                <label>Alamat Toko (Kota)</label>
                                <select name="city_id" class="form-control" style="width: 100%">
                                    <option value="">-- Pilih Kota --</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ (old('city_id') == $city->id ? 'selected' : '' ) }}>
                                        {{ $city->province }},
                                        {{ $city->type }} {{ $city->city_name }} : {{ $city->postal_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block mr-1" type="submit">Buka Toko
                                        Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("select").select2();
    });

</script>
@endsection