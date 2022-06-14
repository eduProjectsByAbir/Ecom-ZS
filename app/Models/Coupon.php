<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'expired', 'has_limit', 'validity'
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

    public function getHasLimitAttribute()
    {
        if ($this->coupon_limit == null) {
            return true;
        }
        if($this->coupon_limit !== "0"){
            return true;
        }
        return false;
    }

    public function getValidityAttribute()
    {
        if ($this->status == 1) {
            return true;
        }
        return false;
    }
}
