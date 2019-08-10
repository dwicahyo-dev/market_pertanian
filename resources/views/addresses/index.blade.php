@extends('layouts.app')
@section('title', 'Daftar Alamat')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Alamat</h1>
        <div class="section-header-button">
            <a href="{{ route('addresses.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data
                Alamat Baru</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('setting.index') }}">Pengaturan</a></div>
            <div class="breadcrumb-item">Pengaturan Alamat Pengiriman</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Pengaturan Alamat Pengiriman</h2>
        <p class="section-lead">Atur dan sesuaikan semua alamat disini.</p>
        <div class="row">
            <div class="col-12 col-lg-12">
                @include('partials.alert_success')

                <div class="card card-primary">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Penerima</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat Pengiriman</th>
                                        <th>Daerah Pengiriman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($addresses as $address)
                                    <tr>
                                        <td style="width: ">{{ $address->name_of_recipient }}</td>
                                        <td>{{ $address->phonenumber }}</td>
                                        <td>{{ $address->full_address }}</td>
                                        <td>{{ $address->city->province }}, {{ $address->city->type }} {{ $address->city->city_name
                                            }} : {{ $address->city->postal_code }}</td>
                                        <td>
                                            <a href="{{ route('addresses.edit', $address->id) }}"
                                                class="btn btn-primary"><i class="far fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" model="addresses" id="btnDelete"
                                                onclick="deleteData({{ $address->id }})" class="btn btn-danger"><i
                                                    class="far fa-trash-alt"></i>
                                                Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#table-1").dataTable();
    });

</script>
@endsection