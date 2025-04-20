<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class subCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'category_id'
    ];

    public function category():BelongsTo {
        return $this->belongsTo(Category::class);
    }
    // public function products(){
    //     return $this->hasMany(Product::class);
    // }
}
