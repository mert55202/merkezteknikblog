@extends('front.layout')

@section('title', ($service->meta_title ?: $service->title) . ' - Denizli Teknik')
@section('meta_description', $service->meta_description ?: Str::limit(strip_tags($service->excerpt ?? $service->content), 160))
@section('og_title', $service->meta_title ?: $service->title)
@section('og_description', $service->meta_description ?: Str::limit(strip_tags($service->excerpt ?? $service->content), 160))
@section('og_type', 'website')
@if($service->meta_keywords)@section('meta_keywords', $service->meta_keywords)@endif
@if($service->image)
@push('meta')
<meta property="og:image" content="{{ \App\Helpers\ContentHelper::imageUrl($service->image) }}">
<meta property="og:image:secure_url" content="{{ \App\Helpers\ContentHelper::imageUrl($service->image) }}">
@endpush
@endif

@push('styles')
<style>
.text-preserve-whitespace { white-space: pre-wrap; word-wrap: break-word; }
.servis-detail-hero { min-height: 340px; position: relative; overflow: hidden; }
.servis-detail-hero-bg { position: absolute; inset: 0; background-size: cover; background-position: center; background-repeat: no-repeat; }
.servis-detail-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,.25), rgba(0,0,0,.4)); }
@media (min-width: 992px) { .servis-detail-hero { min-height: 900px; } }
</style>
@endpush

@section('content')
<section class="page-header page-header-modern bg-color-grey page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-dark font-weight-bold text-8">{{ $service->title }}</h1>
                <span class="sub-title text-dark">
                    @if($service->brands->isNotEmpty()){{ $service->brands->pluck('name')->join(', ') }}@endif
                    @if($service->categories->isNotEmpty()) · {{ $service->categories->pluck('name')->join(', ') }}@endif
                    @if($service->published_at) · {{ $service->published_at->format('d.m.Y') }}@endif
                </span>
            </div>
        </div>
    </div>
</section>
@if($service->image)
<section class="servis-detail-hero position-relative">
    <div class="servis-detail-hero-bg" style="background-image: url('{{ \App\Helpers\ContentHelper::imageUrl($service->image) }}');"></div>
    <div class="servis-detail-hero-overlay"></div>
</section>
@endif
<div class="container py-4">
    <div class="row">
        <div class="col">
            <article class="post post-large blog-single-post border-0 m-0 p-0">
                <div class="post-content ms-0 pt-4">
                    <div class="post-meta mb-3">
                        @if($service->phone)<span><a href="tel:{{ preg_replace('/\D/', '', $service->phone) }}" class="js-track-service-click" data-service-id="{{ $service->id }}" data-button-type="ara">{{ \App\Helpers\ContentHelper::formatPhone($service->phone) }}</a></span>@endif
                        @if($service->address)<span><i class="fas fa-map-marker-alt"></i> {{ $service->address }}</span>@endif
                        @if($service->brands->isNotEmpty())<span><i class="bi bi-tag"></i> @foreach($service->brands as $b)<a href="{{ route('servis.brand', $b) }}">{{ $b->name }}</a>@if(!$loop->last), @endif @endforeach</span>@endif
                        @if($service->categories->isNotEmpty())<span><i class="far fa-folder"></i> @foreach($service->categories as $c)<a href="{{ route('servis.category', $c) }}">{{ $c->name }}</a>@if(!$loop->last), @endif @endforeach</span>@endif
                    </div>
                    <div class="entry-content text-preserve-whitespace">
                        {!! nl2br(e($service->content)) !!}
                    </div>
                    <div class="post-block mt-5 post-share">
                        <h4 class="mb-3">{{ $shareText }}</h4>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('servis.show', $service)) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($service->title . ' ' . $service->phone . ' ' . route('servis.show', $service)) }}" target="_blank" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
