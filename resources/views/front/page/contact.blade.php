@extends('front.layout')

@section('title', ($metaTitle ?: $title) . ' - Denizli Teknik')
@section('meta_description', $metaDescription ?: $subtitle)
@section('meta_keywords', $metaKeywords ?? '')
@section('og_title', $metaTitle ?: $title)
@section('og_description', $metaDescription ?: $subtitle)
@push('json-ld')
@php
$contactBreadcrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => route('home')], ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => route('page.contact')]]];
@endphp
<script type="application/ld+json">@json($contactBreadcrumb)</script>
@endpush

@push('styles')
<style>
.page-hero { min-height: 280px; }
.page-hero-bg { position: absolute; inset: 0; background-size: cover; background-position: center; background-repeat: no-repeat; }
.page-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,.4), rgba(0,0,0,.5)); }
.page-hero-content { min-height: 280px; display: flex; align-items: center; color: #fff !important; }
.page-hero-content h1, .page-hero-content p { color: #fff !important; }
.page-hero-content h1 { text-shadow: 0 1px 3px rgba(0,0,0,.5); }
.page-hero-content p { text-shadow: 0 1px 2px rgba(0,0,0,.5); opacity: 1; }
.page-hero-content .hero-tel-btn {
    display: inline-block; padding: 0.6rem 1.5rem; font-size: inherit; font-weight: bold; color: #fff !important;
    background-color: #0d6efd; border: none; border-radius: 0.375rem; text-decoration: none;
    box-shadow: 0 2px 4px rgba(0,0,0,.2); transition: background-color .2s, transform .05s;
}
.page-hero-content .hero-tel-btn:hover { background-color: #0b5ed7; color: #fff !important; }
.page-hero-content .hero-tel-btn:active { transform: scale(0.98); }
@media (min-width: 992px) { .page-hero { min-height: 360px; } .page-hero-content { min-height: 360px; } }
</style>
@endpush

@section('content')
@php
    $heroGorsel = \App\Models\SiteContent::getValue('hero_gorsel', 'img/landing/header_bg.jpg');
    $heroBaslik = \App\Models\SiteContent::getValue('hero_baslik', 'Denizli Servis Hizmetleri');
    $heroAltBaslik = \App\Models\SiteContent::getValue('hero_alt_baslik', 'Tüm marka beyaz eşyaların tamir bakım ve onarımını yapan servislerin listesini sizin için Paylaştık.');
    $heroTel = \App\Models\SiteContent::getValue('footer_tel', '');
@endphp
<section class="page-hero position-relative overflow-hidden">
    <div class="page-hero-bg" style="background-image: url('{{ \App\Helpers\ContentHelper::imageUrl($heroGorsel) }}');"></div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content position-relative text-center text-white">
        <div class="container container-xl-custom py-5">
            <h1 class="font-weight-bold text-7 text-8-lg mb-3">{{ $heroBaslik }}</h1>
            <p class="text-4 text-5-lg opacity-90 mb-0">{{ $heroAltBaslik }}</p>
            @if($heroTel)
            <p class="font-weight-bold text-7 text-8-lg mb-0 mt-3">
                <a href="#" class="hero-tel-btn" onclick="var el = document.getElementById(document.documentElement.clientWidth < 768 ? 'fabMobile' : 'fabDesktop'); if(el) el.click(); return false;">{{ \App\Helpers\ContentHelper::formatPhone($heroTel) }}</a>
            </p>
            @endif
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <p class="mb-3 text-dark">Herhangi bir sorunuz için bu numaradan bize ulaşabilirsiniz.</p>
            @if($footerTel)
            <p class="mb-0"><a href="tel:{{ preg_replace('/\D/', '', $footerTel) }}" class="btn btn-primary btn-lg">{{ \App\Helpers\ContentHelper::formatPhone($footerTel) }}</a></p>
            @else
            <p class="text-muted mb-0">İletişim numarası tanımlanmamış.</p>
            @endif
        </div>
    </div>
</div>
@endsection
