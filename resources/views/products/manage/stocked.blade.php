@extends('layouts.app')
@section('title', 'Daftar Produk Tersedia')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Produk</h1>
        <div class="section-header-button">
            <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Produk</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Daftar Produk</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Daftar Produk Yang Tersedia</h2>
        <p class="section-lead">Jangan Sampai Kehabisan</p>
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ Helpers::setSelectedSegmentTwo('stocked') }}"
                                    href="{{ route('products.manage-product.stocked') }}">Produk Tersedia
                                    <span class="badge badge-danger">{{ $countStockedProduct }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Helpers::setSelectedSegmentTwo('stockless') }}"
                                    href="{{ route('products.manage-product.stockless') }}">Produk Tidak Tersedia
                                    <span class="badge badge-danger">{{ $countStocklessProduct }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="mt-4">
                    @include('partials.alert_success')
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Foto Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Hasil Pertanian</th>
                                        <th>Kualitas Produk</th>
                                        <th>Jumlah Stock</th>
                                        <th>Harga Produk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stockedProducts as $product)
                                    <tr>
                                        <td>
                                            <div class="gallery gallery-md">
                                                <div class="gallery-item"
                                                    data-image="{{ Storage::url('products/'. $product->thumbnail) }}"
                                                    data-title="{{ $product->product_name }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->agriculture->agriculture_name }}</td>
                                        <td>{{ $product->quality->quality_name }}</td>
                                        <td>{{ RupiahHelper::formatProduct($product->stock) }} kg</td>
                                        <td>Rp.{{ RupiahHelper::formatProduct($product->price) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                    class="btn btn-warning dropdown-toggle"><i class="fas fa-cog"></i>
                                                    Pengaturan</a>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                                                        Lihat</a>
                                                    <a href="{{ route('products.set-stockless', $product->id) }}"
                                                        onclick="event.preventDefault();
                                                    document.getElementById('set-stockless').submit();"
                                                        class="dropdown-item has-icon">
                                                        <i class="far fa-times-circle"></i> Set Tidak Tersedia
                                                    </a>

                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                        Edit</a>

                                                    <form id="set-stockless"
                                                        action="{{ route('products.set-stockless', $product->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf @method('PUT')
                                                    </form>

                                                    <div class="dropdown-divider"></div>

                                                    <a href="javascript:void(0)"
                                                        onclick="deleteDataProduct({{ $product->id }})"
                                                        class="dropdown-item has-icon text-danger">
                                                        <i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
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
    $("#table-1").dataTable();

    function deleteDataProduct(id_product){
        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Menghapus Data Ini?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus Saja!'
		}).then( result => {
			if (result.value) {
				axios.delete(`delete/${id_product}`)
				.then( response => {
					Swal('Terhapus!', `${response.data.message}`,'success')
					.then(() => {
						location.reload();
					})
				})
				.catch( error => {
					console.log(error);
					Swal({
						type: 'error',
						title: 'Oops...',
						text: 'Gagal Menghapus Data',
					})
				});
			}
		});
    }

</script>
@endsection