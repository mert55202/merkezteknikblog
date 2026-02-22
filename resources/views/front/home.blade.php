@extends('front.layout')

@section('title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords ?? '')
@section('og_title', $metaTitle)
@section('og_description', $metaDescription)

@push('styles')
<style>
.home-hero { min-height: 280px; }
.home-hero-bg {
    position: absolute; inset: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.home-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,.4), rgba(0,0,0,.5));
}
.home-hero-content { min-height: 280px; display: flex; align-items: center; color: #fff !important; }
.home-hero-content h1,
.home-hero-content p { color: #fff !important; }
.home-hero-content h1 { text-shadow: 0 1px 3px rgba(0,0,0,.5); }
.home-hero-content p { text-shadow: 0 1px 2px rgba(0,0,0,.5); opacity: 1; }
.home-hero-content .hero-tel-btn {
    display: inline-block;
    padding: 0.6rem 1.5rem;
    font-size: inherit;
    font-weight: bold;
    color: #fff !important;
    background-color: #0d6efd;
    border: none;
    border-radius: 0.375rem;
    text-decoration: none;
    box-shadow: 0 2px 4px rgba(0,0,0,.2);
    transition: background-color .2s, transform .05s;
}
.home-hero-content .hero-tel-btn:hover { background-color: #0b5ed7; color: #fff !important; }
.home-hero-content .hero-tel-btn:active { transform: scale(0.98); }
@media (min-width: 992px) {
    .home-hero { min-height: 360px; }
    .home-hero-content { min-height: 360px; }
}
.servis-liste-satir .ratio-1x1 { --bs-aspect-ratio: 100%; }
@media (max-width: 767px) {
    .servis-liste-container .container { padding-left: 0.5rem; padding-right: 0.5rem; }
    .servis-liste-satir .d-flex { gap: 0.5rem !important; }
    .servis-liste-satir .servis-liste-resim { flex: 0 0 18% !important; }
    .servis-liste-satir .servis-liste-icerik { flex: 1 1 auto !important; min-width: 0 !important; }
    .servis-liste-satir .servis-liste-buton { flex: 0 0 auto !important; }
    .servis-liste-satir .servis-liste-buton .btn { white-space: nowrap; padding-left: 0.5rem; padding-right: 0.5rem; font-size: 0.875rem; }
}
</style>
@endpush
@section('content')
@php
    $heroGorsel = \App\Models\SiteContent::getValue('hero_gorsel', 'img/landing/header_bg.jpg');
    $heroBaslik = \App\Models\SiteContent::getValue('hero_baslik', 'Denizli Servis Hizmetleri');
    $heroAltBaslik = \App\Models\SiteContent::getValue('hero_alt_baslik', 'Tüm marka beyaz eşyaların tamir bakım ve onarımını yapan servislerin listesini sizin için Paylaştık.');
    $heroTel = \App\Models\SiteContent::getValue('footer_tel', '');
@endphp
<section class="home-hero position-relative overflow-hidden">
    <div class="home-hero-bg" style="background-image: url('{{ \App\Helpers\ContentHelper::imageUrl($heroGorsel) }}');"></div>
    <div class="home-hero-overlay"></div>
    <div class="home-hero-content position-relative text-center text-white">
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

@if($brands->isNotEmpty())
<section class="section border-0 m-0 py-4">
    <div class="container container-xl-custom">
        <h2 class="font-weight-bold text-5 mb-4">Markalar</h2>
        <div class="row">
            @foreach($brands as $brand)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('servis.brand', $brand) }}" class="d-block text-center p-3 border rounded text-dark text-decoration-none bg-hover-light">
                    <span class="font-weight-semibold text-2 text-uppercase">{{ $brand->name }}</span>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-2">
            <a href="{{ route('servis.index') }}" class="btn btn-outline-dark btn-sm">Tüm servisleri görüntüle</a>
        </div>
    </div>
</section>
@endif

@if($categories->isNotEmpty())
<section class="section bg-color-primary border-0 m-0">
    <div class="container container-xl-custom">
        <div class="row">
            <div class="col text-center">
                <div class="owl-carousel owl-theme nav-dark stage-margin nav-style-1 m-0" data-plugin-options="{'items': 6, 'margin': 5, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
                    @foreach($categories as $cat)
                    <div class="px-3">
                        <a href="{{ route('servis.category', $cat) }}" class="btn btn-dark w-100 py-3 rounded-0 text-2 text-uppercase font-weight-bold">{{ $cat->name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div class="container container-xl-custom py-4 servis-liste-container">
    <div class="row mt-5 pt-3">
        <div class="col-lg-9">
            <div class="blog-posts">
                @forelse($listServices as $service)
                @php $servisTel = preg_replace('/\D/', '', $service->phone ?: \App\Models\SiteContent::getValue('footer_tel', '')); @endphp
                <article class="post post-large border-bottom pb-4 mb-4 servis-liste-satir">
                    <div class="d-flex flex-row align-items-center gap-3">
                        @if($service->image)
                        <div class="servis-liste-resim flex-shrink-0" style="flex: 0 0 20%;">
                            <a href="{{ route('servis.show', $service) }}" class="d-block ratio ratio-1x1 overflow-hidden bg-light">
                                <img src="{{ \App\Helpers\ContentHelper::imageUrl($service->image) }}" class="object-fit-cover w-100 h-100" alt="{{ $service->title }}">
                            </a>
                        </div>
                        @endif
                        <div class="servis-liste-icerik flex-grow-1" style="flex: 0 0 60%; min-width: 0;">
                            <h2 class="font-weight-semibold text-5 line-height-6 mb-2"><a href="{{ route('servis.show', $service) }}" class="text-dark">{{ $service->title }}</a></h2>
                            @if($service->phone)<p class="text-2 mb-1"><a href="tel:{{ $servisTel }}">{{ \App\Helpers\ContentHelper::formatPhone($service->phone) }}</a></p>@endif
                            @if($service->brands->isNotEmpty())<p class="text-2 mb-1"><i class="fas fa-tag"></i> {{ $service->brands->pluck('name')->join(', ') }}</p>@endif
                            @if($service->categories->isNotEmpty())<p class="text-2 mb-0"><i class="far fa-folder"></i> {{ $service->categories->pluck('name')->join(', ') }}</p>@endif
                        </div>
                        <div class="servis-liste-buton d-flex align-items-center justify-content-center flex-shrink-0" style="flex: 0 0 20%;">
                            <a href="{{ $servisTel ? 'tel:' . $servisTel : route('servis.show', $service) }}" class="d-md-none btn btn-primary rounded-0 js-track-service-click" data-service-id="{{ $service->id }}" data-button-type="ara">Ara</a>
                            <a href="{{ route('servis.show', $service) }}" class="d-none d-md-inline-flex btn btn-primary rounded-0 js-track-service-click" data-service-id="{{ $service->id }}" data-button-type="detay">{{ $readMoreText }}</a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="text-center py-5">
                    <p class="text-muted">Henüz servis eklenmemiş.</p>
                </div>
                @endforelse
                @if($listServices->isNotEmpty())
                <div class="text-center mt-4 pt-2">
                    <a href="{{ route('servis.index') }}" class="btn btn-outline-primary">Tüm servisleri göster</a>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <aside class="sidebar pb-4" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 110}}">
                <h5 class="font-weight-semi-bold pt-4 mb-2">Kategoriler</h5>
                <div class="mb-3 pb-1">
                    @foreach($categories as $cat)
                    <a href="{{ route('servis.category', $cat) }}"><span class="badge badge-dark badge-sm rounded-pill text-uppercase px-2 py-1 me-1 mb-1">{{ $cat->name }}</span></a>
                    @endforeach
                </div>
                <h5 class="font-weight-semi-bold pt-4 mb-2">Markalar</h5>
                <div class="mb-3 pb-1">
                    @foreach($brands as $b)
                    <a href="{{ route('servis.brand', $b) }}"><span class="badge badge-dark badge-sm rounded-pill text-uppercase px-2 py-1 me-1 mb-1">{{ $b->name }}</span></a>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
