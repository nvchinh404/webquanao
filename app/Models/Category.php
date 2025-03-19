<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Quan hệ: Một category có nhiều products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}