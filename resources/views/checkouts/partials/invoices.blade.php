<div class="col-12">
    <div class="row mt-4">
        @forelse ($invoices as $invoice)
        <div class="col-12">
            <div class="card {{ Helpers::cardCheckout($invoice) }} ">
                <div class="card-header bg-whitesmoke">
                    <div class="table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>No. Tagihan</b></td>
                                    <td style="width: 200px"><b>Total Tagihan</b></td>
                                    <td><b>Status Tagihan</b></td>
                                    <td><b>Kuantitas Produk</b></td>
                                    <td>
                                        @can('view', $invoice)
                                        <a href="{{ route('checkout.show', $invoice->id) }}"
                                            class="btn btn-block btn-outline-primary">Lihat Detail
                                        </a>
                                        @endcan
                                        @can('store', $invoice)
                                        <a href="{{ route('checkout.transaction.show', $invoice->id) }}"
                                            class="btn btn-block btn-outline-primary">Lihat Detail
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @can('view', $invoice)
                                        <a href="{{ route('checkout.show', $invoice->id) }}">
                                            {{ $invoice->order_detail->order_id }}
                                        </a>
                                        @endcan
                                        @can('store', $invoice)
                                        <a href="{{ route('checkout.transaction.show', $invoice->id) }}">
                                            {{ $invoice->order_detail->order_id }}
                                        </a>
                                        @endcan

                                        <br>
                                        <span
                                            class="badge badge-primary">{{ $invoice->order_detail->created_at->format('l, d F Y H:i ') }}
                                            WIB</span>

                                    </td>
                                    <td>{{ RupiahHelper::format($invoice->total_price) }}</td>
                                    <td>
                                        <span class="badge {{ Helpers::invoiceStatusBadge($invoice->order_detail) }}">
                                            {{ Helpers::invoiceStatusText($invoice->order_detail) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">{{ $invoice->qty }} Kg</span>
                                    </td>
                                    <td>
                                        @can('view', $invoice)
                                        @if ($invoice->is_approved == TRUE && $invoice->is_arrived == FALSE)

                                        <a href="javascript:void(0)" onclick="arrived({{ $invoice->id }})"
                                            class="btn btn-block btn-dark">
                                            Terima Barang
                                        </a>
                                        @endif

                                        @if ($invoice->is_approved == TRUE && $invoice->is_arrived == TRUE &&
                                        $invoice->review == NULL)
                                        <a href="{{ route('checkout.review', $invoice->id) }}"
                                            class="btn btn-block btn-dark">
                                            Berikan Ulasan Produk
                                        </a>
                                        @endif
                                        @endcan

                                        @can('view', $invoice->product->store)
                                        @if ($invoice->is_approved == FALSE && $invoice->is_rejected == FALSE)
                                        <a href="javascript:void(0)" onclick="approvedTransaction({{ $invoice->id }})"
                                            class="btn btn-block btn-primary">
                                            Terima Transaksi
                                        </a>

                                        <a href="javascript:void(0)" onclick="rejected({{ $invoice->id }})"
                                            class="btn btn-block btn-danger">Tolak Transaksi
                                        </a>
                                        @endif

                                        @if ($invoice->is_approved == TRUE && $invoice->is_rejected == FALSE)
                                        <a href="{{ route('checkout.transaction.print.invoice', $invoice->id) }}"
                                            class="btn btn-block btn-dark">Cetak Invoice
                                        </a>

                                        @if ($invoice->is_sented == FALSE)
                                        <a href="javascript:void(0)" onclick="sented({{ $invoice->id }})"
                                            class="btn btn-block btn-primary mt-1">Set Produk Di Kirim</a>
                                        @endif

                                        @endif

                                        @endcan
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Produk</b></td>
                                    <td><b>Toko</b></td>
                                    <td><b>Status Pembelian</b></td>
                                    @if ($invoice->is_rejected == true)
                                    <td><b>Alasan Penolakan</b></td>
                                    @endif
                                    @can('view', $invoice)
                                    @if ($invoice->order_detail->pdf_url)
                                    <td>
                                        <a href="{{ $invoice->order_detail->pdf_url }}" class="btn btn-primary">Download
                                            Panduan Pembayaran</a>
                                    </td>
                                    @endif
                                    @endcan

                                </tr>
                                <tr>
                                    <td>
                                        <div class="gallery">
                                            <div class="gallery-item"
                                                data-image="{{ Storage::url('products/'.$invoice->product->thumbnail) }}"
                                                data-title="Image 1">
                                            </div>
                                        </div>

                                        <a
                                            href="{{ route('products.show', $invoice->product->product_real_id) }}">{{ $invoice->product->product_name }}</a>
                                        <span class="badge badge-pill badge-primary">Kualitas
                                            {{ $invoice->product->quality->quality_name }}</span>
                                        <span class="badge badge-pill badge-secondary">Komoditas
                                            {{ $invoice->product->agriculture->commodity->commodity_name }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('stores.show', $invoice->product->store->id) }}">
                                            {{ $invoice->product->store->store_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ Helpers::setCardCheckoutStatus($invoice) }}
                                    </td>
                                    @if ($invoice->is_rejected == true)
                                    <td class="text-center">
                                        {{ empty($invoice->rejected_reason) ? '-' : $invoice->rejected_reason }}
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
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
                        <h2 class="mt-0">
                            @if (Helpers::ifSegmentTwo('invoices'))
                            Oops, Belum ada transaksi pembelian
                            @elseif(Helpers::ifSegmentTwo('transactions'))
                            Oops, Belum ada transaksi penjualan
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
        <div class="col-12">
            {{ $invoices->links() }}
        </div>

    </div>
</div>

@section('script')
<script>
    function arrived(order_id){
        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Telah Menerima Barang ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Telah Menerima!'
		}).then( result => {
			if (result.value) {
				axios.put(`invoices/arrived/${order_id}`)
				.then( response => {
                    // console.log(response.data);
                    if(response.data.success == true){
                        Swal('Sukses!', `${response.data.message}`,'success')
                        .then(() => {
                            location.reload();
                        });
                    } else {
                    Swal('Oops...', `${response.data.message}`,'error')
                        .then(() => {
                            location.reload();
                        });
                    }
				});
			}
		});
    }

    function sented(order_id){
        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Telah Mengirim Barang ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Telah Mengirim!'
		}).then( result => {
			if (result.value) {
				axios.put(`invoices/sented/${order_id}`)
				.then( response => {
                    if(response.data.success == true){
                        Swal('Sukses!', `${response.data.message}`,'success')
                        .then(() => {
                            location.reload();
                        });
                    } else {
                    Swal('Oops...', `${response.data.message}`,'error')
                        .then(() => {
                            location.reload();
                        });
                    }
				});
			}
		});
    }

    function approvedTransaction(order_id){
        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Menerima Transaksi ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Terima!'
		}).then( result => {
			if (result.value) {
				axios.put(`invoices/approved/${order_id}`)
				.then( response => {
                    // console.log(response.data);
                    if(response.data.success == true){
                        Swal('Sukses!', `${response.data.message}`,'success')
                        .then(() => {
                            location.reload();
                        });
                    } else {
                        Swal('Oops...', `${response.data.message}`,'error')
                            .then(() => {
                                location.reload();
                        });
                    }
				}).catch(err => {
                    Swal('Oops...', 'Terdapat Kesalahan','error')
                        .then(() => {
                            location.reload();
                    });
                });
			}
		});
    }

    function rejected(order_id){
        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Menolak Transaksi ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Tolak!',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            inputPlaceholder: 'Alasan Ditolak'
		}).then( result => {
			if (result.value || result.value == '') {
				axios.put(`invoices/rejected/${order_id}`, {
                    rejected_reason: result.value
                })
				.then( response => {
                    // console.log(response.data);
                    if(response.data.success == true){
                        Swal('Sukses!', `${response.data.message}`,'success')
                        .then(() => {
                            location.reload();
                        });
                    } else {
                        Swal('Oops...', `${response.data.message}`,'error')
                            .then(() => {
                                location.reload();
                        });
                    }
				});
			}
		});
    }

</script>
@endsection