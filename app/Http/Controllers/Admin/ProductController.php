<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'           => 'required|max:255',
        'description'    => 'nullable',
        'price'          => 'required|numeric',
        'category_id'    => 'required|exists:categories,id',
        'brand_id'       => 'required|exists:brands,id',
        'stock_quantity' => 'nullable|integer|min:0',
        'image_url'      => 'nullable|url', // Validate URL hợp lệ
    ]);

    // Nếu không nhập gì, gán null
    $validated['image_url'] = $validated['image_url'] ?? null;

    Product::create($validated);
    return redirect()->route('products.index')->with('success', 'Sản phẩm được tạo thành công.');
}


    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name'           => 'required|max:255',
        'description'    => 'nullable',
        'price'          => 'required|numeric',
        'category_id'    => 'required|exists:categories,id',
        'brand_id'       => 'required|exists:brands,id',
        'stock_quantity' => 'nullable|integer|min:0',
        'image_url'      => 'nullable|url',
    ]);

    // Nếu không có giá trị mới, giữ nguyên giá trị cũ
    $validated['image_url'] = $validated['image_url'] ?? $product->image_url;

    $product->update($validated);
    return redirect()->route('products.index')->with('success', 'Sản phẩm được cập nhật thành công.');
}


    public function destroy(Product $product)
    {
        // (Tùy chọn: Xóa file ảnh nếu cần)
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa.');
    }
}
