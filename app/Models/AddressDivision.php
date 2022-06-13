<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDivision extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(AddressCountry::class, 'address_country_id');
    }
}
