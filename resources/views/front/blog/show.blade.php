@extends('front.layout')

@section('title', ($post->meta_title ?: $post->title) . ' - Denizli Teknik')
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?? $post->content), 160))
@section('og_title', $post->meta_title ?: $post->title)
@section('og_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?? $post->content), 160))
@section('og_type', 'article')
@if($post->meta_keywords)@section('meta_keywords', $post->meta_keywords)@endif
@if($post->image)
@push('meta')
<meta property="og:image" content="{{ \App\Helpers\ContentHelper::imageUrl($post->image) }}">
<meta property="og:image:secure_url" content="{{ \App\Helpers\ContentHelper::imageUrl($post->image) }}">
<meta name="twitter:image" content="{{ \App\Helpers\ContentHelper::imageUrl($post->image) }}">
@endpush
@endif
@push('meta')
<meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
<meta property="article:section" content="{{ $post->category->name }}">
<meta property="article:author" content="{{ config('seo.site_name') }}">
@endpush
@push('json-ld')
@php
    $articleImage = $post->image ? json_encode(['@type' => 'ImageObject', 'url' => \App\Helpers\ContentHelper::imageUrl($post->image)]) : 'null';
@endphp
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "headline": {{ json_encode($post->meta_title ?: $post->title) }},
    "description": {{ json_encode($post->meta_description ?: Str::limit(strip_tags($post->excerpt ?? $post->content), 160)) }},
    "url": {{ json_encode(route('blog.show', $post)) }},
    "datePublished": "{{ $post->published_at?->toIso8601String() }}",
    "dateModified": "{{ $post->updated_at->toIso8601String() }}",
    "author": { "@@type": "Organization", "name": {{ json_encode(config('seo.site_name')) }} },
    "publisher": { "@@type": "Organization", "@@id": {{ json_encode(url('/') . '#organization') }}, "name": {{ json_encode(config('seo.site_name')) }} },
    "image": {!! $articleImage !!},
    "mainEntityOfPage": { "@@type": "WebPage", "@@id": {{ json_encode(route('blog.show', $post)) }} }
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Anasayfa", "item": {{ json_encode(route('home')) }} },
        { "@@type": "ListItem", "position": 2, "name": "Blog", "item": {{ json_encode(route('blog.index')) }} },
        { "@@type": "ListItem", "position": 3, "name": {{ json_encode($post->category->name) }}, "item": {{ json_encode(route('blog.category', $post->category)) }} },
        { "@@type": "ListItem", "position": 4, "name": {{ json_encode(Str::limit($post->title, 50)) }}, "item": {{ json_encode(route('blog.show', $post)) }} }
    ]
}
</script>
@endpush

@section('content')
<section class="page-header page-header-modern bg-color-grey page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-dark font-weight-bold text-8">{{ $post->title }}</h1>
                <span class="sub-title text-dark">{{ $post->category->name }} · {{ $post->published_at?->format('d.m.Y') }}</span>
            </div>
        </div>
    </div>
</section>
<div class="container py-4">
    <div class="row">
        <div class="col">
            <article class="post post-large blog-single-post border-0 m-0 p-0">
                @if($post->image)
                <div class="post-image ms-0">
                    <img src="{{ \App\Helpers\ContentHelper::imageUrl($post->image) }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="{{ $post->title }}" />
                </div>
                @endif
                <div class="post-content ms-0 pt-4">
                    <div class="post-meta mb-3">
                        <span><i class="far fa-folder"></i> <a href="{{ route('blog.category', $post->category) }}">{{ $post->category->name }}</a></span>
                        <span><i class="far fa-calendar"></i> {{ $post->published_at?->format('d.m.Y') }}</span>
                    </div>
                    <div class="entry-content">
                        {!! $post->content !!}
                    </div>
                    <div class="post-block mt-5 post-share">
                        <h4 class="mb-3">{{ $shareText }}</h4>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm btn-info"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post)) }}" target="_blank" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
