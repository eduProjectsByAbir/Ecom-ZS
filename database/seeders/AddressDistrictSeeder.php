<?php

namespace Database\Seeders;

use App\Models\AddressDistrict;
use App\Models\AddressDivision;
use Illuminate\Database\Seeder;

class AddressDistrictSeeder extends Seeder
{
    public function run()
    {
        $districts = array(
            "Dhaka", "Gazipur", "Narsingdi", "Manikganj", "Munshiganj", "Narayanganj", "Mymensingh", "Sherpur", "Jamalpur", "Netrokona", "Kishoreganj", "Tangail", "Faridpur", "Maradipur", "Shariatpur", "Rajbari", "Gopalganj"
        );

        foreach($districts as $district){
            AddressDistrict::create([
                'name' => $district,
                'address_division_id' => 3
            ]);
        }
    }
}
