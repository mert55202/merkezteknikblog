<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ContentHelper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with(['brands', 'categories'])->orderBy('order')->latest('published_at');
        if ($request->filled('brand_id')) {
            $query->whereHas('brands', fn ($q) => $q->where('brands.id', $request->brand_id));
        }
        if ($request->filled('category_id')) {
            $query->whereHas('categories', fn ($q) => $q->where('categories.id', $request->category_id));
        }
        $services = $query->paginate(15);
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.index', compact('services', 'brands', 'categories'));
    }

    public function create()
    {
        $service = null;
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.create', compact('service', 'brands', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'order' => 'nullable|integer|min:0',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'meta_title' => 'nullable|string|max:512',
            'meta_description' => 'nullable|string|max:2000',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['order'] = (int) ($data['order'] ?? 0);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : now();
        $data['meta_title'] = $request->input('meta_title');
        $data['meta_description'] = $request->input('meta_description');
        $data['meta_keywords'] = $request->input('meta_keywords');
        if ($request->hasFile('image')) {
            $data['image'] = ContentHelper::saveToPublicUploads($request->file('image'));
        }
        $brandIds = $data['brand_ids'] ?? [];
        $categoryIds = $data['category_ids'] ?? [];
        unset($data['brand_ids'], $data['category_ids']);
        $service = Service::create($data);
        $service->brands()->sync($brandIds);
        $service->categories()->sync($categoryIds);
        return redirect()->route('admin.services.index')->with('success', 'Servis eklendi.');
    }

    public function edit(Service $service)
    {
        $service->load(['brands', 'categories']);
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.edit', compact('service', 'brands', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'order' => 'nullable|integer|min:0',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'meta_title' => 'nullable|string|max:512',
            'meta_description' => 'nullable|string|max:2000',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $data['order'] = (int) ($request->input('order', $service->order ?? 0));
        $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : $service->published_at;
        $data['meta_title'] = $request->input('meta_title');
        $data['meta_description'] = $request->input('meta_description');
        $data['meta_keywords'] = $request->input('meta_keywords');
        if ($request->hasFile('image')) {
            $data['image'] = ContentHelper::saveToPublicUploads($request->file('image'));
        }
        $brandIds = $data['brand_ids'] ?? [];
        $categoryIds = $data['category_ids'] ?? [];
        unset($data['brand_ids'], $data['category_ids']);
        $service->update($data);
        $service->brands()->sync($brandIds);
        $service->categories()->sync($categoryIds);
        return redirect()->route('admin.services.index')->with('success', 'Servis güncellendi.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Servis silindi.');
    }
}
