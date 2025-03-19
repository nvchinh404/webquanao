<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'category_id', 'brand_id', 'image_url'];

    // Quan hệ: Product thuộc về một category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ: Product thuộc về một brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Quan hệ: Product có nhiều order_details
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Quan hệ: Product có nhiều reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Quan hệ: Product có nhiều carts
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Quan hệ: Product có nhiều sizes
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}