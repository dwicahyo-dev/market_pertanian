<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice &mdash; Market Pertanian</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        table {
            font-size: 14px;
        }

        .dear>p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="col-md-12">
        <h5 class="text-center">Bukti Pembayaran</h5>

        <div class="dear">
            <p>Dear {{ $checkout->user->name }},</p>
            <p>Terimakasih atas kepercayaan Anda bertransaksi melalui Market-pertanian.com.</p>
        </div>

        <div class="mb-1">Detail Transaksi</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Nomor Transaksi</td>
                    <td>{{ $checkout->order_id }}</td>
                </tr>
                <tr>
                    <td>Waktu Transaksi</td>
                    <td>{{ $checkout->created_at->format('d M Y H:i') }} WIB</td>
                </tr>
                <tr>
                    <td>Catatan Untuk Penjual</td>
                    <td>
                        {{ empty($checkout->seller_note) ? '-' : $checkout->seller_note }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="mb-1">Detail Pembeli & Penjual</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center" colspan="2">Pembeli</th>
                    <th class="text-center" colspan="2">Penjual</th>
                </tr>
                <tr>
                    <td>Pembeli</td>
                    <td>{{ $checkout->user->name }}</td>
                    <td>Penjual</td>
                    <td>{{ $checkout->product->store->store_name }}</td>
                </tr>
                <tr>
                    <td>Tujuan Pengiriman</td>
                    <td>{{ $checkout->address->name_of_recipient }} <br>
                        {{ $checkout->address->full_address }} <br>
                        {{ $checkout->address->city->type }} {{ $checkout->address->city->city_name }} -
                        {{ $checkout->address->city->postal_code }} <br>
                        No. Telp: {{ $checkout->address->phonenumber }}
                    </td>
                    <td>Alamat Toko</td>
                    <td>
                        {{ $checkout->product->store->city->type }} {{ $checkout->product->store->city->city_name }} -
                        {{ $checkout->product->store->city->postal_code }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="mb-1">Detail Produk</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>Nama Produk</th>
                    <th>Kualitas Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
                <tr>
                    <td>{{ $checkout->product->product_name }}</td>
                    <td class="text-center">{{ $checkout->product->quality->quality_name }}</td>
                    <td class="text-center">{{ $checkout->qty }} Kg</td>
                    <td class="text-center">{{ RupiahHelper::format($checkout->product->price) }}</td>
                    <td class="text-right">{{ RupiahHelper::format(($checkout->product->price * $checkout->qty)) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Total Harga Barang</td>
                    <td class="text-right">{{ RupiahHelper::format(($checkout->product->price * $checkout->qty)) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Total Biaya Kirim</td>
                    <td class="text-right">{{ RupiahHelper::format($checkout->service_value) }}</td>
                </tr>
                <tr>
                    <td colspan="4">TOTAL PEMBAYARAN</td>
                    <th class="text-right">{{ RupiahHelper::format($checkout->total_price) }}</th>
                </tr>
            </table>
        </div>

        <div class="dear">
            <p>Yuk jangan lupa ulas barang setelah barang sampai untuk membantu pembeli lain mengetahui kualitasnya.</p>
        </div>
    </div>

</body>

</html>