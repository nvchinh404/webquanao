<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\Discount;
use App\Models\Banner;
use App\Models\Size;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Bảo vệ route bằng middleware auth
    }

    // Dashboard Admin
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        return view('admin.dashboard', compact('usersCount', 'productsCount', 'ordersCount'));
    }

    // CRUD cho Users
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:customer,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:customer,admin',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'address', 'role'));
        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    // CRUD cho Categories
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->only('name'));
        return redirect()->route('admin.categories')->with('success', 'Category created successfully');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required']);
        $category->update($request->only('name'));
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }

    // CRUD cho Brands
    public function brands()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function createBrand(Request $request)
    {
        $request->validate(['name' => 'required']);
        Brand::create($request->only('name'));
        return redirect()->route('admin.brands')->with('success', 'Brand created successfully');
    }

    public function updateBrand(Request $request, Brand $brand)
    {
        $request->validate(['name' => 'required']);
        $brand->update($request->only('name'));
        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully');
    }

    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully');
    }

    // CRUD cho Products
    public function products()
    {
        $products = Product::with('category', 'brand')->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image_url' => 'required',
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image_url' => 'required',
        ]);

        $product->update($request->all());
        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    // CRUD cho Orders
    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,shipping,completed,cancelled']);
        $order->update($request->only('status'));
        return redirect()->route('admin.orders')->with('success', 'Order updated successfully');
    }

    // CRUD cho Discounts
    public function discounts()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function createDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discounts',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after:valid_from',
        ]);

        Discount::create($request->all());
        return redirect()->route('admin.discounts')->with('success', 'Discount created successfully');
    }

    public function updateDiscount(Request $request, Discount $discount)
    {
        $request->validate([
            'code' => 'required|unique:discounts,code,' . $discount->id,
            'discount_percent' => 'required|numeric|min:0|max:100',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after:valid_from',
        ]);

        $discount->update($request->all());
        return redirect()->route('admin.discounts')->with('success', 'Discount updated successfully');
    }

    public function deleteDiscount(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts')->with('success', 'Discount deleted successfully');
    }

    // CRUD cho Banners
    public function banners()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function createBanner(Request $request)
    {
        $request->validate([
            'image_url' => 'required',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        Banner::create($request->all());
        return redirect()->route('admin.banners')->with('success', 'Banner created successfully');
    }

    public function updateBanner(Request $request, Banner $banner)
    {
        $request->validate([
            'image_url' => 'required',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $banner->update($request->all());
        return redirect()->route('admin.banners')->with('success', 'Banner updated successfully');
    }

    public function deleteBanner(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners')->with('success', 'Banner deleted successfully');
    }

    // CRUD cho Sizes
    public function sizes()
    {
        $sizes = Size::with('product')->get();
        $products = Product::all();
        return view('admin.sizes.index', compact('sizes', 'products'));
    }

    public function createSize(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Size::create($request->all());
        return redirect()->route('admin.sizes')->with('success', 'Size created successfully');
    }

    public function updateSize(Request $request, Size $size)
    {
        $request->validate([
            'size' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $size->update($request->only('size', 'stock_quantity'));
        return redirect()->route('admin.sizes')->with('success', 'Size updated successfully');
    }

    public function deleteSize(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes')->with('success', 'Size deleted successfully');
    }
}