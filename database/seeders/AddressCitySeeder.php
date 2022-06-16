<?php

namespace Database\Seeders;

use App\Models\AddressCity;
use Illuminate\Database\Seeder;

class AddressCitySeeder extends Seeder
{
    public function run()
    {
        $cities = array(
            "Narshingdi",
            'Velenagor',
            'Shibpur',
            'Raipura',
            'Belabo',
            'Baroicha'
        );

        foreach($cities as $city){
            AddressCity::create([
                'name' => $city,
                'address_district_id' => 3
            ]);
        }
    }
}
