<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SiteContent;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function about()
    {
        $content = SiteContent::getValue('about_icerik', '');
        return view('front.page.about', [
            'title' => SiteContent::getValue('about_baslik', 'Hakkımızda'),
            'content' => $content,
            'image' => SiteContent::getValue('about_gorsel', ''),
            'metaTitle' => SiteContent::getValue('about_meta_title', ''),
            'metaDescription' => SiteContent::getValue('about_meta_description', '') ?: Str::limit(strip_tags($content), 160),
            'metaKeywords' => SiteContent::getValue('about_meta_keywords', ''),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function contact()
    {
        return view('front.page.contact', [
            'title' => SiteContent::getValue('contact_baslik', 'İletişim'),
            'subtitle' => SiteContent::getValue('contact_alt_baslik', 'Bize ulaşın'),
            'footerTel' => SiteContent::getValue('footer_tel', ''),
            'metaTitle' => SiteContent::getValue('contact_meta_title', ''),
            'metaDescription' => SiteContent::getValue('contact_meta_description', ''),
            'metaKeywords' => SiteContent::getValue('contact_meta_keywords', ''),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }
}
