<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['product_id', 'size', 'stock_quantity'];

    // Quan hệ: Size thuộc về một Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}