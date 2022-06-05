<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'product_thumbnail_url', 'full_status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getProductThumbnailUrlAttribute()
    {
        if (!$this->product_thumbnail) {
            return asset('backend/images/default-image.jpg');
        }

        return asset($this->product_thumbnail);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function sub_subcategory()
    {
        return $this->belongsTo(SubSubcategory::class, 'sub_subcategory_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function getFullStatusAttribute()
    {
        if (!$this->status) {
            return 'Inactive';
        }

        return 'Active';
    }
}
