<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    // Quan hệ: Review thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Review thuộc về một product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}