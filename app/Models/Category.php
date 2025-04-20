<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /*protected $fillable = [
        'name',
        'slug',
    ];*/
    protected $guarded = ['id'];

    public function subCategories():HasMany
    {
        return $this->hasMany(subCategory::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
