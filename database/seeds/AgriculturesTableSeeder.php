<?php

use Illuminate\Database\Seeder;
use App\Agriculture;
use App\Commodity;
use App\Quality;
use App\StandardPrice;

use App\Store;
use App\Product;
use App\Address;
use App\User;
use App\CheckoutProcess;

class AgriculturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commodities = [
            [
                'commodity_name' => 'Sayuran'
            ],
            [
                'commodity_name' => 'Buah - Buahan'
            ],
            [
                'commodity_name' => 'Pangan'
            ],
        ];

        $qualities = [
            [
                'quality_name' => 'Biasa'
            ],
            [
                'quality_name' => 'Khusus'
            ],
            [
                'quality_name' => 'Organik'
            ],
            [
                'quality_name' => 'Non-Organik'
            ],
            [
                'quality_name' => 'KW Medium'
            ],
            [
                'quality_name' => 'KW Premium'
            ],
        ];

        $agricultures = [
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Bawang Merah'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Bawang Putih'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Bawang Daun'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kentang'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kubis'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kembang Kol'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Petsai/Sawi'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Wortel'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Lobak'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kacang Merah'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kacang Panjang'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Cabe Besar'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Cabe Rawit'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Paprika'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Jamur'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Tomat'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Terong'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Buncis'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Ketimun'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Labu Siam'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Kangkung'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Bayam'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Melinjo'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Petai'
            ],
            [
                'commodity_id' => 1,
                'agriculture_name' => 'Jengkol'
            ],
            [ // Buah-buahan
                'commodity_id' => 2,
                'agriculture_name' => 'Alpukat'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Belimbing'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Duku/Langsat'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Jambu Biji'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Jambu Air'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Jeruk Siam/Keprok'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Jeruk Besar'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Mangga'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Manggis'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Nangka/Cempedak'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Nenas'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Pepaya'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Pisang'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Rambutan'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Salak'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Sawo'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Markisa'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Sirsak'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Sukun'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Apel'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Anggur'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Melon'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Semangka'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Blewah'
            ],
            [
                'commodity_id' => 2,
                'agriculture_name' => 'Stroberi'
            ],
            [ // Tanaman Pangan
                'commodity_id' => 3,
                'agriculture_name' => 'Gabah Kering Panen'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Gabah Kering Giling'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Beras Medium'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Beras Premium'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Jagung Pipilan Kering'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Kedelai Lokal Biji Kering'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Kacang Tanah Lokal Polong Basah'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Kacang Hijau Biji Kering'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Ubi Kayu Basah'
            ],
            [
                'commodity_id' => 3,
                'agriculture_name' => 'Ubi Jalar Basah'
            ],
        ];

        $standardPrices = [
            [
                'agriculture_id' => 1,
                'user_id' => 1,
                'lowest_price' => 10000,
                'highest_price' => 20000
            ],
            [
                'agriculture_id' => 2,
                'user_id' => 1,
                'lowest_price' => 20000,
                'highest_price' => 50000
            ],
            [
                'agriculture_id' => 3,
                'user_id' => 1,
                'lowest_price' => 1000,
                'highest_price' => 5000
            ],
            [
                'agriculture_id' => 4,
                'user_id' => 1,
                'lowest_price' => 4000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 5,
                'user_id' => 1,
                'lowest_price' => 11000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 6,
                'user_id' => 1,
                'lowest_price' => 6000,
                'highest_price' => 10000
            ],
            [
                'agriculture_id' => 7,
                'user_id' => 1,
                'lowest_price' => 12000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 8,
                'user_id' => 1,
                'lowest_price' => 15000,
                'highest_price' => 25000
            ],
            [
                'agriculture_id' => 9,
                'user_id' => 1,
                'lowest_price' => 6000,
                'highest_price' => 10000
            ],
            [
                'agriculture_id' => 10,
                'user_id' => 1,
                'lowest_price' => 25000,
                'highest_price' => 30000
            ],
            [
                'agriculture_id' => 11,
                'user_id' => 1,
                'lowest_price' => 50000,
                'highest_price' => 55000
            ],
            [
                'agriculture_id' => 12,
                'user_id' => 1,
                'lowest_price' => 32000,
                'highest_price' => 40000
            ],
            [
                'agriculture_id' => 13,
                'user_id' => 1,
                'lowest_price' => 45000,
                'highest_price' => 55000
            ],
            [
                'agriculture_id' => 14,
                'user_id' => 1,
                'lowest_price' => 32000,
                'highest_price' => 40000
            ],
            [
                'agriculture_id' => 15,
                'user_id' => 1,
                'lowest_price' => 12000,
                'highest_price' => 30000
            ],
            [
                'agriculture_id' => 16,
                'user_id' => 1,
                'lowest_price' => 15000,
                'highest_price' => 25000
            ],
            [
                'agriculture_id' => 17,
                'user_id' => 1,
                'lowest_price' => 9000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 18,
                'user_id' => 1,
                'lowest_price' => 8000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 19,
                'user_id' => 1,
                'lowest_price' => 8000,
                'highest_price' => 13000
            ],
            [
                'agriculture_id' => 20,
                'user_id' => 1,
                'lowest_price' => 13000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 21,
                'user_id' => 1,
                'lowest_price' => 10000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 22,
                'user_id' => 1,
                'lowest_price' => 30000,
                'highest_price' => 40000
            ],
            [
                'agriculture_id' => 23,
                'user_id' => 2,
                'lowest_price' => 3000,
                'highest_price' => 10000
            ],
            [
                'agriculture_id' => 24,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 8000
            ],
            [
                'agriculture_id' => 25,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 8000
            ],
            [
                'agriculture_id' => 26,
                'user_id' => 2,
                'lowest_price' => 8000,
                'highest_price' => 12000
            ],
            [
                'agriculture_id' => 27,
                'user_id' => 2,
                'lowest_price' => 8000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 28,
                'user_id' => 2,
                'lowest_price' => 7000,
                'highest_price' => 8000
            ],
            [
                'agriculture_id' => 33,
                'user_id' => 2,
                'lowest_price' => 1000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 37,
                'user_id' => 2,
                'lowest_price' => 3000,
                'highest_price' => 10000
            ],
            [
                'agriculture_id' => 38,
                'user_id' => 2,
                'lowest_price' => 10000,
                'highest_price' => 15000
            ],
            [
                'agriculture_id' => 45,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 18000
            ],
            [
                'agriculture_id' => 46,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 9500
            ],
            [
                'agriculture_id' => 47,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 9000
            ],
            [
                'agriculture_id' => 48,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 11500
            ],
            [
                'agriculture_id' => 50,
                'user_id' => 2,
                'lowest_price' => 5000,
                'highest_price' => 9900
            ],
            [
                'agriculture_id' => 53,
                'user_id' => 2,
                'lowest_price' => 15000,
                'highest_price' => 23000
            ],
            [
                'agriculture_id' => 54,
                'user_id' => 2,
                'lowest_price' => 18000,
                'highest_price' => 30000
            ],
            [
                'agriculture_id' => 55,
                'user_id' => 2,
                'lowest_price' => 2500,
                'highest_price' => 8000
            ],
        ];

        $products = [
            [
                'agriculture_id' => 1,
                'quality_id' => 1,
                'product_name' => 'Bawang Merah Biasa',
                'store_id' => 1,
                'thumbnail' => 'bawang_merah.jpg',
                'price' => 11000,
                'stock' => 100,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
            ],
            [
                'agriculture_id' => 4,
                'quality_id' => 2,
                'product_name' => 'Kentang Khusus',
                'store_id' => 1,
                'thumbnail' => 'bawang_merah.jpg',
                'price' => 11000,
                'stock' => 59,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
            ],
            [
                'agriculture_id' => 8,
                'quality_id' => 1,
                'product_name' => 'Wortel Biasa',
                'store_id' => 1,
                'thumbnail' => 'bawang_merah.jpg',
                'price' => 11000,
                'stock' => 30,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
            ],
            [
                'agriculture_id' => 15,
                'quality_id' => 1,
                'product_name' => 'Jamur Putih Biasa',
                'store_id' => 1,
                'thumbnail' => 'bawang_merah.jpg',
                'price' => 13000,
                'stock' => 25,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
            ],
            [
                'agriculture_id' => 15,
                'quality_id' => 2,
                'product_name' => 'Jamur Putih Khusus',
                'store_id' => 1,
                'thumbnail' => 'bawang_merah.jpg',
                'price' => 15000,
                'stock' => 25,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            ],
        ];

        $shoppingCarts = [
            [
                'user_id' => 2,
                'product_id' => 1,
                'qty' => 10,
                'seller_note' => 'Segera proses'
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'qty' => 20,
                'seller_note' => 'Segera proses'
            ],
        ];

        $addresses = [
            [
                'user_id' => 1,
                'name_of_recipient' => 'Douglas J. Priest',
                'phonenumber' => '08999001123',
                'city_id' => 49,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 1,
                'name_of_recipient' => 'Charles R. Kim',
                'phonenumber' => '08999001124',
                'city_id' => 23,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 1,
                'name_of_recipient' => 'Sheryl R. Lawerence',
                'phonenumber' => '08999001125',
                'city_id' => 32,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 2,
                'name_of_recipient' => 'Sandra R. James',
                'phonenumber' => '08999002125',
                'city_id' => 32,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 2,
                'name_of_recipient' => 'James A. Rentas',
                'phonenumber' => '08999002125',
                'city_id' => 49,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 2,
                'name_of_recipient' => 'Luke K. Green',
                'phonenumber' => '08999002126',
                'city_id' => 49,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 5,
                'name_of_recipient' => 'Julia D. Remley',
                'phonenumber' => '08999004126',
                'city_id' => 344,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'user_id' => 5,
                'name_of_recipient' => 'Cayla L. Bailey',
                'phonenumber' => '08999004127',
                'city_id' => 349,
                'full_address' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
        ];

        $users = [
            [
                'name' => 'Ari Suhendra Budiaman',
                'email' => 'user1@market-pertanian.com',
                'phonenumber' => '089999900000',
                'gender' => 'male',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Raharjo Putra Sumadi',
                'email' => 'user2@market-pertanian.com',
                'phonenumber' => '089999911111',
                'gender' => 'male',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Hartanti Shinta Rachman',
                'email' => 'user3@market-pertanian.com',
                'phonenumber' => '089999911100',
                'gender' => 'female',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Buana Iman Budiman',
                'email' => 'user4@market-pertanian.com',
                'phonenumber' => '089999911199',
                'gender' => 'male',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Wira Eka Hardja',
                'email' => 'user5@market-pertanian.com',
                'phonenumber' => '089999911188',
                'gender' => 'male',
                'password' => bcrypt('password')
            ],
        ];

        $stores = [
            [
                'user_id' => 1,
                'store_name' => "Superadministrator's Store",
                'city_id' => 349,
            ],
            [
                'user_id' => 4,
                'store_name' => "Raharjo's Store",
                'city_id' => 501,
            ],
            [
                'user_id' => 7,
                'store_name' => "Wira's Store",
                'city_id' => 54,
            ],
        ];

        $checkoutProcesses = [
            [ // 1
                'status' => 'Menunggu konfirmasi pembayaran.',
                'type' => 'system'
            ],
            [ // 2
                'status' => 'Menunggu proses pembayaran dan verifikasi pihak ketiga.',
                'type' => 'system'
            ],
            [ // 3
                'status' => 'Pembayaran sudah Diverifikasi. Pembayaran telah diterima Market-Pertanian dan pesanan Anda sudah diteruskan ke penjual.',
                'type' => 'market'
            ],
            [ // 4
                'status' => 'Transaksi telah diterima oleh Penjual.',
                'type' => 'seller'
            ],
            [ // 5
                'status' => 'Pesanan telah dikirim Penjual. Pesanan Anda dalam proses pengiriman oleh kurir.',
                'type' => 'seller'
            ],
            [ // 6
                'status' => 'Transaksi dikonfirmasi. Transaksi telah dikonfirmasi pembeli dan menunggu review Market-Pertanian.',
                'type' => 'arrived'
            ],
            [ // 7
                'status' => 'Transaksi selesai.',
                'type' => 'done'
            ],
            [ // 8
                'status' => 'Transaksi dibatalkan. Keterangan: Ditolak oleh Penjual.',
                'type' => 'rejected'
            ],
            [ // 9
                'status' => 'Transaksi dibatalkan. Keterangan: Pembayaran ditolak oleh Bank atau FDS.',
                'type' => 'rejected'
            ],
            [ // 10
                'status' => 'Transaksi dibatalkan. Keterangan: Pembeli telah melebihi batas waktu proses pembayaran.',
                'type' => 'rejected'
            ],
            [ // 11
                'status' => 'Transaksi dibatalkan. Keterangan: Pembeli telah membatalkan proses pembayaran.',
                'type' => 'rejected'
            ],
            [ // 12
                'status' => 'Transaksi dikonfirmasi secara Otomatis oleh Sistem.',
                'type' => 'arrived'
            ],
            [ // 13
                'status' => 'Transaksi ditolak oleh System. Keterangan: Penjual telah melebihi batas waktu proses konfirmasi penerimaan transaksi penjualan.',
                'type' => 'rejected'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'phonenumber' => $user['phonenumber'],
                'gender' => $user['gender'],
                'password' => $user['password'],
            ]);
        }

        foreach ($commodities as $commodity) {
            Commodity::create([
                'commodity_name' => $commodity['commodity_name']
            ]);
        }

        foreach ($qualities as $quality) {
            Quality::create([
                'quality_name' => $quality['quality_name']
            ]);
        }

        foreach ($agricultures as $agriculture) {
            Agriculture::create([
                'commodity_id' => $agriculture['commodity_id'],
                'agriculture_name' => $agriculture['agriculture_name'],
            ]);
        }

        foreach ($standardPrices as $standardPrice) {
            StandardPrice::create([
                'agriculture_id' => $standardPrice['agriculture_id'],
                'user_id' => $standardPrice['user_id'],
                'lowest_price' => $standardPrice['lowest_price'],
                'highest_price' => $standardPrice['highest_price'],
            ]);
        }

        foreach ($stores as $store) {
            Store::create([
                'user_id' => $store['user_id'],
                'store_name' => $store['store_name'],
                'city_id' => $store['city_id'],
            ]);
        }

        foreach ($addresses as $address) {
            Address::create([
                'user_id' => $address['user_id'],
                'name_of_recipient' => $address['name_of_recipient'],
                'phonenumber' => $address['phonenumber'],
                'city_id' => $address['city_id'],
                'full_address' => $address['full_address']
            ]);
        }

        foreach ($products as $product) {
            Product::create([
                'agriculture_id' => $product['agriculture_id'],
                'quality_id' => $product['quality_id'],
                'product_name' => $product['product_name'],
                'store_id' => $product['store_id'],
                'thumbnail' => $product['thumbnail'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'description' => $product['description'],
            ]);
        }

        foreach ($checkoutProcesses as $checkoutProcess) {
            CheckoutProcess::create([
                'status' => $checkoutProcess['status'],
                'type' => $checkoutProcess['type'],
            ]);
        }
    }
}
