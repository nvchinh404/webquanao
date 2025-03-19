<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Quan hệ: OrderDetail thuộc về một order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ: OrderDetail thuộc về một product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}