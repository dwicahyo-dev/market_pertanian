<?php

namespace App\Http\Controllers\RajaOngkir;

use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\RequestException;

class Costs extends Controller
{
    public function init(int $origin, int $destination, int $weight, string $courier)
    {
        $client = new Client();

        try {
            $result = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
                'headers' => [
                    'key' => '8505bcebcbc3d07691087f4f78d7469d',
                    'content-type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier
                ]
            ]);
        } catch (RequestException $e) {
            $error_json = $e->getResponse()->getBody()->getContents();
            $error_array_result = json_decode($error_json, true);

            return [
                'error_description' => 'Kuantitas Produk tidak boleh lebih dari 30KG atau 30.000 gram. Silahkan ubah terlebih dahulu. '
            ];
        }

        $json = $result->getBody()->getContents();

        $array_result = json_decode($json, true);

        return [
            'query' => $array_result['rajaongkir']['query'],
            'origin_details' => $array_result['rajaongkir']['origin_details'],
            'destination_details' => $array_result['rajaongkir']['destination_details'],
            'results' => $array_result['rajaongkir']['results'][0],
        ];
    }

}
