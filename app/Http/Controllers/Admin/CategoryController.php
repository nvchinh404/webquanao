<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:categories,name|max:255',
            'description' => 'nullable',
        ]);
        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Danh mục được tạo thành công.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:categories,name,'.$category->id.'|max:255',
            'description' => 'nullable',
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Danh mục được cập nhật thành công.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa.');
    }
}
