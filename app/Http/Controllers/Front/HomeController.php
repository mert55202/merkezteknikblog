<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Service;
use App\Models\SiteContent;

class HomeController extends Controller
{
    public function index()
    {
        $base = Service::where('is_published', true)->with(['brands', 'categories'])->orderBy('order')->latest('published_at');
        $listServices = (clone $base)->take(5)->get();
        return view('front.home', [
            'metaTitle' => SiteContent::getValue('home_meta_title', 'Denizli Teknik Servis - Beyaz Eşya, Kombi, Klima Servisi'),
            'metaDescription' => SiteContent::getValue('home_meta_description', '') ?: 'Denizli teknik servis listesi.',
            'metaKeywords' => SiteContent::getValue('home_meta_keywords', ''),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
            'listServices' => $listServices,
            'readMoreText' => SiteContent::getValue('servis_read_more', 'Detay'),
        ]);
    }
}
