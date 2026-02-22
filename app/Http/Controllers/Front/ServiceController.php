<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Service;
use App\Models\SiteContent;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_published', true)->with(['brands', 'categories'])->orderBy('order')->latest('published_at')->paginate(10);
        return view('front.servis.index', [
            'services' => $services,
            'brand' => null,
            'category' => null,
            'pageTitle' => SiteContent::getValue('servis_baslik', 'Servisler'),
            'pageSubtitle' => SiteContent::getValue('servis_alt_baslik', 'Teknik servis listesi'),
            'readMoreText' => SiteContent::getValue('servis_read_more', 'Detay'),
            'metaTitle' => SiteContent::getValue('servis_meta_title', 'Servisler - Denizli Teknik'),
            'metaDescription' => SiteContent::getValue('servis_meta_description', ''),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function brand(Brand $brand)
    {
        if (!$brand->is_active) {
            abort(404);
        }
        $services = $brand->services()->where('is_published', true)->orderBy('order')->latest('published_at')->paginate(10);
        return view('front.servis.index', [
            'services' => $services,
            'brand' => $brand,
            'category' => null,
            'pageTitle' => $brand->name,
            'pageSubtitle' => $brand->description ?? 'Servisler',
            'readMoreText' => SiteContent::getValue('servis_read_more', 'Detay'),
            'metaTitle' => $brand->name . ' - Servisler',
            'metaDescription' => $brand->description ?? '',
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function category(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }
        $services = $category->services()->where('is_published', true)->orderBy('order')->latest('published_at')->paginate(10);
        return view('front.servis.index', [
            'services' => $services,
            'brand' => null,
            'category' => $category,
            'pageTitle' => $category->name,
            'pageSubtitle' => $category->description ?? 'Servisler',
            'readMoreText' => SiteContent::getValue('servis_read_more', 'Detay'),
            'metaTitle' => $category->meta_title ?: $category->name,
            'metaDescription' => $category->meta_description ?? '',
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function show(Service $service)
    {
        if (!$service->is_published) {
            abort(404);
        }
        $service->increment('view_count');
        return view('front.servis.show', [
            'service' => $service,
            'shareText' => SiteContent::getValue('servis_share_text', 'Bu servisi paylaş'),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }
}
