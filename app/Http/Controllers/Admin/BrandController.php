<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:brands,name|max:255',
            'description' => 'nullable',
        ]);
        Brand::create($validated);
        return redirect()->route('brands.index')->with('success', 'Nhãn hiệu được tạo thành công.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:brands,name,'.$brand->id.'|max:255',
            'description' => 'nullable',
        ]);
        $brand->update($validated);
        return redirect()->route('brands.index')->with('success', 'Nhãn hiệu được cập nhật thành công.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Nhãn hiệu đã được xóa.');
    }
}
