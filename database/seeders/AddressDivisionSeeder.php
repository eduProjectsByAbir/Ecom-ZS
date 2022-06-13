<?php

namespace Database\Seeders;

use App\Models\AddressDivision;
use Illuminate\Database\Seeder;

class AddressDivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = array(
            "Barisal",
            'Chittagong',
            'Dhaka',
            'Khulna',
            'Mymensingh',
            'Rajshahi',
            'Rangpur',
            'Sylhet'
        );

        foreach($divisions as $division){
            AddressDivision::create([
                'name' => $division,
                'address_country_id' => 18
            ]);
        }
    }
}
