<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);

    }
    public function subCategory(){
        return $this->belongsTo(subCategory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
    public function scopeActive($query) {
        return $query->where('status', true);
    }
}
