<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCountry extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function divisions()
    {
        return $this->hasMany(AddressDivision::class, 'address_country_id', 'id');
    }
}
