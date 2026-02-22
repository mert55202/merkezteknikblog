<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SiteContent;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->latest('published_at')->paginate(9);
        return view('front.blog.index', [
            'posts' => $posts,
            'category' => null,
            'pageTitle' => SiteContent::getValue('blog_baslik', 'Blog'),
            'pageSubtitle' => SiteContent::getValue('blog_alt_baslik', 'Son Yazılar'),
            'readMoreText' => SiteContent::getValue('blog_read_more', 'Devamını Oku'),
            'metaTitle' => SiteContent::getValue('blog_meta_title', 'Blog - Denizli Teknik'),
            'metaDescription' => SiteContent::getValue('blog_meta_description', ''),
            'metaKeywords' => SiteContent::getValue('blog_meta_keywords', ''),
            'sidebarKategoriler' => SiteContent::getValue('blog_sidebar_kategoriler', 'Kategoriler'),
            'sidebarTumu' => SiteContent::getValue('blog_sidebar_tumu', 'Tümü'),
            'hicYaziYok' => SiteContent::getValue('blog_hic_yazi_yok', 'Henüz yazı bulunmuyor.'),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function category(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }
        $posts = $category->posts()->where('is_published', true)->latest('published_at')->paginate(9);
        return view('front.blog.index', [
            'posts' => $posts,
            'category' => $category,
            'pageTitle' => $category->name,
            'pageSubtitle' => $category->description ?? 'Yazılar',
            'readMoreText' => SiteContent::getValue('blog_read_more', 'Devamını Oku'),
            'metaTitle' => $category->meta_title ?: $category->name,
            'metaDescription' => $category->meta_description ?? '',
            'sidebarKategoriler' => SiteContent::getValue('blog_sidebar_kategoriler', 'Kategoriler'),
            'sidebarTumu' => SiteContent::getValue('blog_sidebar_tumu', 'Tümü'),
            'hicYaziYok' => SiteContent::getValue('blog_hic_yazi_yok', 'Henüz yazı bulunmuyor.'),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }

    public function show(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }
        $post->increment('view_count');
        return view('front.blog.show', [
            'post' => $post,
            'shareText' => SiteContent::getValue('blog_share_text', 'Bu yazıyı paylaş'),
            'categories' => Category::where('is_active', true)->orderBy('order')->orderBy('name')->get(),
        ]);
    }
}
