<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart'; // Đảm bảo tên bảng đúng với migration
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Quan hệ: Cart thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Cart thuộc về một product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}