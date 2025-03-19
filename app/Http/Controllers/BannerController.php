<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        Banner::create($request->all());
        return redirect()->route('banners.index')->with('success', 'Banner created successfully');
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image_url' => 'required',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $banner->update($request->all());
        return redirect()->route('banners.index')->with('success', 'Banner updated successfully');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully');
    }
}