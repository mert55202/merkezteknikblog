<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ContentHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category')->latest();
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $posts = $query->paginate(15);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Yazı ekleyebilmek için önce en az bir kategori oluşturmalısınız.');
        }
        $post = null;
        return view('admin.posts.create', compact('categories', 'post'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['published_at'] ?? now();
        if ($request->hasFile('image')) {
            $data['image'] = ContentHelper::saveToPublicUploads($request->file('image'));
        }
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Yazı eklendi.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get(); // silinmiş kategoriye taşınmış post için tüm kategoriler
        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Yazı düzenleyebilmek için en az bir kategori gerekli.');
        }
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);
        $data['is_published'] = $request->boolean('is_published');
        if ($request->hasFile('image')) {
            $data['image'] = ContentHelper::saveToPublicUploads($request->file('image'));
        }
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Yazı güncellendi.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Yazı silindi.');
    }
}
