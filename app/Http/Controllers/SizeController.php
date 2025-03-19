<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::with('product')->get();
        return view('sizes.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Size::create($request->all());
        return redirect()->route('sizes.index')->with('success', 'Size added successfully');
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'size' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $size->update($request->only('size', 'stock_quantity'));
        return redirect()->route('sizes.index')->with('success', 'Size updated successfully');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('sizes.index')->with('success', 'Size deleted successfully');
    }
}