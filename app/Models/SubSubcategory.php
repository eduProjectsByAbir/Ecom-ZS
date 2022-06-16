<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubSubcategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'sub_category_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($subSubcategory) {
            $subSubcategory->slug = Str::slug($subSubcategory->name);
        });

        static::updating(function ($subSubcategory) {
            $subSubcategory->slug = Str::slug($subSubcategory->name);
        });
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
