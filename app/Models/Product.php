<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'image',
        'title',
        'slug',
        'brand',
        'description',
        'price',
        'discount_price',
        'stock',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
