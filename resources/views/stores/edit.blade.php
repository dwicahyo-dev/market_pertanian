@extends('layouts.app')
@section('title', 'Edit Toko')
@section('css')
@if ($errors->has('city_id'))
<style>
    .select2-selection--single {
        border-color: #dc3545 !important;
    }
</style>
@endif

@if ($errors->has('thumbnail'))
<style>
    .img-thumbnail {
        border-color: #dc3545 !important;
    }
</style>
@endif
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('stores.show', $store->id) }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ Auth::user()->store->store_name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('stores.index') }}">Toko</a></div>
            <div class="breadcrumb-item active"><a
                    href="{{ route('stores.show', $store->id) }}">{{ $store->store_name }}</a></div>
            <div class="breadcrumb-item">Edit Toko</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Toko</h2>

        @if(session()->has('success'))
        <div class="alert alert-primary alert-has-icon">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                {{ session()->get('success') }}

            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-body">

                        @include('partials.error_alert')

                        <div class="section-title mt-0">Informasi Toko</div>
                        <form method="POST" action="{{ route('stores.update', $store->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group ">
                                <label>Nama Toko</label>
                                <input type="text" name="store_name"
                                    class="form-control {{ $errors->has('store_name') ? ' is-invalid' : '' }}"
                                    value="{{ $store->store_name }}" placeholder="Nama Toko" disabled>
                            </div>

                            <div class="form-group ">
                                <label>Slogan (Optional)</label>
                                <input type="text" name="slogan"
                                    class="form-control {{ $errors->has('slogan') ? ' is-invalid' : '' }}"
                                    value="{{ $store->slogan }}" placeholder="Slogan">
                            </div>

                            <div class="form-group ">
                                <label>Alamat Toko (Kota)</label>
                                <select name="city_id" class="form-control" style="width: 100%">
                                    <option value="">-- Pilih Kota --</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ ($store->city_id == $city->id ? 'selected' : '' ) }}>
                                        {{ $city->province }},
                                        {{ $city->type }} {{ $city->city_name }} : {{ $city->postal_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>

                        <div class="section-title mt-5">Gambar Toko</div>
                        <form action="{{ route('store.update.thumbnail', $store->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-4">
                                    @isset($store->thumbnail)
                                    <img class="mt-3 img-fluid img-thumbnail" id='img-upload' style="width: 400px"
                                        src="{{ Storage::url('stores/'. $store->thumbnail) }}">
                                    @else
                                    <img class="img-fluid img-thumbnail" id='img-upload' style="width: 100%"
                                        src="{{ asset('assets/img/example-image.jpg') }}">
                                    @endisset
                                </div>

                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Gambar Toko</label>
                                        <p>Besar file: maksimum 5.000.000 bytes (5 Megabytes) <br>
                                            Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                                        </p>
                                        <input type="file" name="thumbnail" class="btn-file" id="imgInp"
                                            accept="image/x-png,image/jpg,image/jpeg">
                                        <br>
                                        <button class="btn btn-primary mt-3" type="submit">Simpan</button>

                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="section-title mt-5">Sampul Toko</div>
                        <p class="section-lead">Jadikan halaman toko Anda lebih menarik dengan kreasi foto Anda sendiri
                        </p>

                        <form action="{{ route('store.update.cover', $store->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    @isset($store->cover)

                                    <div class="hero text-white hero-bg-image" data-height="350" 
                                        data-background="{{ Storage::url('stores_cover/'. $store->cover) }}">
                                    </div>
                                    @else
                                    <div class="hero text-white hero-bg-image" data-height="350"
                                        data-background="{{ asset('assets/img/example-image.jpg') }}">
                                    </div>
                                    @endisset
                                </div>

                                <div class="col-8">
                                    <div class="form-group mt-4">
                                        <label>Sampul Toko</label>
                                        <p>Besar file: maksimum 5.000.000 bytes (5 Megabytes) <br>
                                            Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                                        </p>
                                        <input type="file" name="cover" class="btn-file"
                                            accept="image/x-png,image/jpg,image/jpeg">
                                        <br>
                                        <button class="btn btn-primary mt-3" type="submit">Simpan</button>
                                    </div>
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