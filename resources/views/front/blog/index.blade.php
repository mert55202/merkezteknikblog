@extends('front.layout')

@section('title', (isset($category) && $category ? ($category->meta_title ?: $pageTitle) : ($metaTitle ?? $pageTitle)) . ' - Denizli Teknik')
@section('meta_description', isset($category) && $category ? ($category->meta_description ?? $pageSubtitle ?? '') : ($metaDescription ?? $pageSubtitle ?? ''))
@section('meta_keywords', isset($category) && $category ? ($category->meta_keywords ?? '') : ($metaKeywords ?? ''))
@section('og_title', isset($category) && $category ? ($category->meta_title ?: $pageTitle) : ($metaTitle ?? $pageTitle))
@section('og_description', isset($category) && $category ? ($category->meta_description ?? $pageSubtitle ?? '') : ($metaDescription ?? $pageSubtitle ?? ''))

@push('json-ld')
@php
$blogIndexItems = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => route('home')], ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')]];
if (isset($category) && $category) { $blogIndexItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $category->name, 'item' => route('blog.category', $category)]; }
$blogIndexBreadcrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $blogIndexItems];
@endphp
<script type="application/ld+json">@json($blogIndexBreadcrumb)</script>
@endpush

@section('content')
<section class="page-header page-header-modern bg-color-grey page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-dark font-weight-bold text-8">{{ $pageTitle }}</h1>
                <span class="sub-title text-dark">{{ $pageSubtitle }}</span>
            </div>
        </div>
    </div>
</section>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-9">
            <div class="blog-posts">
                <div class="row">
                    @forelse($posts as $post)
                    <div class="col-md-4 mb-5">
                        <article class="post post-medium border-0 pb-0">
                            <div class="post-image">
                                <a href="{{ route('blog.show', $post) }}">
                                    @if($post->image)
                                        <img src="{{ \App\Helpers\ContentHelper::imageUrl($post->image) }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="{{ $post->title }}">
                                    @else
                                        <img src="{{ asset('front/img/blog/square/blog-1.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="{{ $post->title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="post-content">
                                <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
                                <p>{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 120) }}</p>
                                <div class="post-meta">
                                    <span><i class="far fa-folder"></i> <a href="{{ route('blog.category', $post->category) }}">{{ $post->category->name }}</a></span>
                                    <span class="d-block mt-2"><a href="{{ route('blog.show', $post) }}" class="btn btn-xs btn-light text-1 text-uppercase">{{ $readMoreText }}</a></span>
                                </div>
                            </div>
                        </article>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">{{ $hicYaziYok }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @if($posts->hasPages())
            <div class="row">
                <div class="col">
                    {{ $posts->links() }}
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-3">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{ $sidebarKategoriler }}</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ route('blog.index') }}">{{ $sidebarTumu }}</a></li>
                        @foreach($categories as $cat)
                            <li class="mb-2"><a href="{{ route('blog.category', $cat) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
