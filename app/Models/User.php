<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use App\Models\Order;
use App\Models\Review;
use App\Models\Cart;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role'];

    // Quan hệ: Một user có nhiều orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Quan hệ: Một user có nhiều reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Quan hệ: Một user có nhiều cart items (nên dùng tên này thay vì carts)
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
}