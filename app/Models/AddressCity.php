<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCity extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function district()
    {
        return $this->belongsTo(AddressDistrict::class, 'address_district_id');
    }
}
