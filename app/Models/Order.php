<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(AddressCountry::class, 'address_country_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(AddressDivision::class, 'address_division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(AddressDistrict::class, 'address_district_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(AddressCity::class, 'address_city_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
