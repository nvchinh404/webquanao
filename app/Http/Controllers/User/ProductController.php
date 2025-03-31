<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('user.pages.categories.show', compact('category')); // Không truyền categories
    }

    public function new_product()
    {
        $products = Product::all();
        return view('user.pages.categories.new' , compact('products'));
    }

    public function all_product()
    {
        $products = Product::all();
        return view('user.pages.products.allproduct' , compact('products'));
    }

    public function product_detail($id)
    {
        $products = Product::findOrFail($id);
        return view('user.pages.products.productdetail' , compact('products'));
    }
}
