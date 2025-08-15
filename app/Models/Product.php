<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'category_id',
        'add_to_card',
        'wishlist'
    ];

    protected $casts = [
        'add_to_card' => 'boolean',
        'wishlist' => 'boolean',
        'price' => 'decimal:0'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
