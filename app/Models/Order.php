<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status', 'payment_method'];

    // Quan hệ: Order thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Order có nhiều order_details
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Quan hệ: Order có một payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}