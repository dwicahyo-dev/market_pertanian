<?php

use Illuminate\Database\Seeder;
use App\City;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $result = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => ['key' =>'8505bcebcbc3d07691087f4f78d7469d']
        ]);

        $json = $result->getBody()->getContents();

        $array_result = json_decode($json, true);

        $cities =  $array_result['rajaongkir']['results'];
        
        foreach($cities as $city){
            City::create([
                'city_id' => $city['city_id'],
                // 'province_id' => $city['province_id'],
                'province' => $city['province'],
                'type' => $city['type'],
                'city_name' => $city['city_name'],
                'postal_code' => $city['postal_code'],
            ]);
        }
    }
}
