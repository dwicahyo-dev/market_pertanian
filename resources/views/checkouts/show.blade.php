@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('checkout.invoice') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Detail Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('checkout.invoice') }}">Daftar Transaksi</a></div>
            <div class="breadcrumb-item active">Detail Transaksi</div>
            <div class="breadcrumb-item active">{{ $checkout->id }}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Detail Transaksi</h2>

        <div class="row">
            <div class="col-12">
                @if (session()->has('transaction_cancelled'))
                <div class="alert alert-primary alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        {{ session()->get('transaction_cancelled') }}
                    </div>
                </div>
                @endif

                @if(session()->has('success'))
                <div class="alert alert-primary alert-dismissible alert-has-icon show fade">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button> {{ session()->get('success') }}
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pembelian</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="bg-whitesmoke">
                                    <td scope="row"><b>No. Transaksi</b></td>
                                    <td colspan="2">{{ $checkout->order_detail->transaction_id }}</td>
                                </tr>
                                <tr class="bg-whitesmoke">
                                    @can('view', $checkout)
                                    <td scope="row"><b>Nama Toko</b></td>
                                    <td colspan="2">{{ $checkout->product->store->store_name }}</td>
                                    @endcan
                                    @can('store', $checkout)
                                    <td scope="row"><b>Nama Pembeli</b></td>
                                    <td colspan="2">{{ $checkout->user->name }}</td>
                                    @endcan
                                </tr>
                                <tr class="bg-whitesmoke">
                                    <td scope="row"><b>Catatan Untuk Penjual</b></td>
                                    <td colspan="2">
                                        {{ empty($checkout->seller_note) ? '-' : $checkout->seller_note }}
                                    </td>
                                </tr>
                                <tr class="bg-whitesmoke">
                                    <td scope="row">
                                        {{ $checkout->product->product_name }}
                                        <span class="badge badge-pill badge-primary">Kualitas
                                            {{ $checkout->product->quality->quality_name }}</span>
                                        <span class="badge badge-pill badge-secondary">Komoditas
                                            {{ $checkout->product->agriculture->commodity->commodity_name }}</span>
                                        <span
                                            class="badge badge-pill badge-danger">{{ RupiahHelper::format($checkout->product->price)  }}</span>
                                    </td>
                                    <td colspan="2"><b>{{ RupiahHelper::format($checkout->total_price) }}</b></td>
                                </tr>
                                <tr>
                                    <td scope="row"><b>Status Pembelian</b></td>
                                    <td colspan="2">
                                        {{ Helpers::setCardCheckoutStatus($checkout) }}
                                    </td>
                                </tr>
                                @if ($checkout->order_detail->transaction_status == 'pending')
                                <tr>
                                    <td scope="row"><b>Batas pembayaran sampai</b></td>
                                    <td colspan="2">
                                        {{ $checkout->order_detail->transaction_expired->format('l, d F Y H:i ') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td scope="row"><b>Jasa Pengiriman</b></td>
                                    <td colspan="2">
                                        <span
                                            class="badge badge-pill badge-primary">{{ $checkout->courrier_name }}</span>
                                        <span class="badge badge-pill badge-secondary">{{ $checkout->service }}</span>
                                        <span
                                            class="badge badge-pill badge-danger">{{ $checkout->service_description }}</span>
                                        <span class="badge badge-pill badge-warning">{{ $checkout->etd }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @can('cancelled', $checkout)
                    @if ($checkout->order_detail->transaction_status == 'pending')
                    <div class="card-footer bg-whitesmoke">
                        <button class="btn btn-block btn-primary" id="btnCancel"
                            order_id="{{ $checkout->order_id }}">Batalkan Pembayaran
                            Transaksi</button>
                    </div>
                    @endif
                    @endcan
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Tagihan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table col-12">
                            <tbody>
                                <tr>
                                    <td>No. Tagihan</td>
                                    <td>{{ $checkout->order_id }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Tagihan</td>
                                    <td>
                                        <span class="badge {{ Helpers::invoiceStatusBadge($checkout->order_detail) }}">
                                            {{ Helpers::invoiceStatusText($checkout->order_detail) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>
                                        <h5>{{ Helpers::invoicePaymentMethod($checkout) }}</h5>
                                    </td>
                                </tr>
                                @can('view', $checkout)
                                @if ($checkout->order_detail->pdf_url)
                                <tr>
                                    <td>Download Panduan</td>
                                    <td>
                                        <a href="{{ $checkout->order_detail->pdf_url }}"
                                            class="btn btn-primary">Download Panduan Pembayaran
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endcan

                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3"><b>Rincian Pembayaran</b></td>
                                </tr>
                                <tr>
                                    <td>Harga Produk ({{ $checkout->qty }} kg) @
                                        {{ RupiahHelper::format($checkout->product->price) }}</td>
                                    <td>
                                        {{ Helpers::totalPrice($checkout->qty, $checkout->product->price) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Biaya Pengiriman</td>
                                    <td>
                                        {{ RupiahHelper::format($checkout->service_value) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Total Pembayaran</b></td>
                                    <td>{{ RupiahHelper::format($checkout->total_price) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Pengiriman</td>
                                    <td>
                                        <b>{{ $checkout->address->name_of_recipient }}</b>,
                                        {{ $checkout->address->phonenumber }}, {{ $checkout->address->full_address }},
                                        {{ $checkout->address->city->type }} {{ $checkout->address->city->city_name }},
                                        {{ $checkout->address->city->province }},
                                        {{ $checkout->address->city->postal_code }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Status Pesanan Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="activities">
                            @forelse ($checkout->checkout_processes as $item)
                            <div class="activity">
                                <div
                                    class="activity-icon {{ Helpers::cardActivity($item->checkoutProcess->type) }} text-white shadow-primary">
                                    {{ Helpers::activityIcon($item->checkoutProcess->type) }}
                                </div>
                                <div class="activity-detail {{ Helpers::cardActivity($item->checkoutProcess->type) }}">
                                    <div class="mb-2">
                                        <span class="text-job text-white">
                                            @if ($item->checkoutProcess->type == 'market')
                                            Market-Pertanian
                                            @elseif ($item->checkoutProcess->type == 'arrived')
                                            Buyer
                                            @elseif ($item->checkoutProcess->type == 'done')
                                            System
                                            @else
                                            {{ $item->checkoutProcess->type }}
                                            @endif
                                        </span>
                                        <span class="bullet"></span>
                                        <span class="text-job text-white">
                                            {{ $item->created_at->format('l, d F Y H:i') }}
                                        </span>
                                    </div>
                                    <p class="text-white">{{ $item->checkoutProcess->status }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="empty-state" data-height="400">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                                        alt="image">
                                    <h2 class="mt-0">
                                        Oops, belum ada status pesanan produk
                                    </h2>
                                </div>
                            </div>
                            @endforelse
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
    $('#btnCancel').click(function(){
        let order_id = $(this).attr('order_id');

        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Membatalkan Pembayaran Transaksi Ini?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Batalkan!'
		}).then( result => {
			if (result.value) {
				axios.post(`cancel/${order_id}`)
				.then( response => {
                    // console.log(response.data);
                    if(response.data.success == true){
                        Swal('Sukses!', `${response.data.message}`,'success')
                        .then(() => {
                            location.reload();
                        });
                    }

                    if(response.data.success == false){
                    Swal('Oops...', `${response.data.message}`,'error')
                        .then(() => {
                            location.reload();
                        });
                    }
				});
			}
		});
    });

</script>
@endsection