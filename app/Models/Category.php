<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    protected $appends = [
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->icon) {
            return asset('backend/images/default-image.jpg');
        }

        return asset($this->icon);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
