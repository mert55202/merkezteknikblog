<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('order')->orderBy('name')->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $brand = null;
        return view('admin.brands.create', compact('brand'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        Brand::create($data);
        return redirect()->route('admin.brands.index')->with('success', 'Marka eklendi.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brand->id,
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $brand->update($data);
        return redirect()->route('admin.brands.index')->with('success', 'Marka güncellendi.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->services()->exists()) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Bu markaya bağlı servisler var. Önce ilişkiyi kaldırın.');
        }
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Marka silindi.');
    }
}
