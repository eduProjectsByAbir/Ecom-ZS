<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    protected $appends = [
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });

        static::updating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('backend/images/default-image.jpg');
        }

        return asset($this->image);
    }
}
