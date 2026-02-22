@extends('front.layout')

@section('title', (isset($metaTitle) && $metaTitle !== '' ? $metaTitle : $title) . ' - Denizli Teknik')
@section('meta_description', (isset($metaDescription) && $metaDescription !== '' ? $metaDescription : \Illuminate\Support\Str::limit(strip_tags($content ?? ''), 160)))
@section('meta_keywords', $metaKeywords ?? '')
@section('og_title', isset($metaTitle) && $metaTitle !== '' ? $metaTitle : $title)
@section('og_description', (isset($metaDescription) && $metaDescription !== '' ? $metaDescription : \Illuminate\Support\Str::limit(strip_tags($content ?? ''), 160)))
@push('json-ld')
@php
$aboutBreadcrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => route('home')], ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => route('page.about')]]];
@endphp
<script type="application/ld+json">@json($aboutBreadcrumb)</script>
@endpush

@section('content')
<section class="page-header page-header-modern bg-color-grey page-header-md">
    <div class="container">
        <div class="row">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-dark font-weight-bold text-8">{{ $title }}</h1>
            </div>
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row align-items-center">
        @if($image)
        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="{{ \App\Helpers\ContentHelper::imageUrl($image) }}" class="img-fluid rounded" alt="{{ $title }}">
        </div>
        @endif
        <div class="{{ $image ? 'col-lg-8' : 'col-12' }}">
            <div class="entry-content">
                {!! nl2br(e($content ?? '')) !!}
            </div>
        </div>
    </div>
</div>
@endsection
