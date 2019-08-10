@extends('layouts.app')
@section('title', 'Tambah Alamat Baru')
@section('css') @if ($errors->has('city_id'))
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
            <a href="{{ route('addresses.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Alamat Baru</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('setting.index') }}">Pengaturan</a></div>
            <div class="breadcrumb-item">Tambah Alamat Baru</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Tambah Alamat Baru</h2>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        @include('partials.error_alert')
                        
                        <form method="POST" action="{{ route('addresses.store') }}">
                            @csrf

                            <div class="form-group ">
                                <label>Nama Penerima</label>
                                <input type="text" name="name_of_recipient"
                                    class="form-control {{ $errors->has('name_of_recipient') ? ' is-invalid' : '' }}"
                                    value="{{ old('name_of_recipient') }}" placeholder="Nama Penerima" autofocus>
                            </div>

                            <div class="form-group ">
                                <label>Nomor HP</label>
                                <input type="text" name="phonenumber"
                                    class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                    value="{{ old('phonenumber') }}" placeholder="Nomor HP">
                            </div>

                            <div class="form-group ">
                                <label>Kota</label>
                                <select name="city_id" class="form-control" style="width: 100%">
                                    <option value="">-- Pilih Kota --</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ (old('city_id') == $city->id ? 'selected' : '' ) }}>{{ $city->province }},
                                        {{ $city->type }} {{ $city->city_name }} : {{ $city->postal_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label>Alamat Lengkap</label>
                                <textarea name="full_address" placeholder="Alamat Lengkap"
                                    class="form-control {{ $errors->has('full_address') ? ' is-invalid' : '' }}">{{ old('full_address') }}</textarea>
                            </div>

                            <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                            <a href="{{ route('addresses.index') }}" role="button" class="btn btn-danger">Batal</a>
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