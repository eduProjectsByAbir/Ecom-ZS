<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $appends = [
        'expired'
    ];
    
    public function getExpiredAttribute()
    {
        $today = strtotime(date("Y-m-d"));
        $expireDate = strtotime($this->coupon_expire);
        if ($expireDate < $today) {
            return true;
        }
        return false;
    }
}
