@extends('front.layout')

@section('title', (isset($category) && $category ? ($category->meta_title ?: $pageTitle) : (isset($brand) && $brand ? $pageTitle : ($metaTitle ?? $pageTitle))) . ' - Denizli Teknik')
@section('meta_description', isset($category) && $category ? ($category->meta_description ?? $pageSubtitle ?? '') : (isset($brand) && $brand ? ($brand->description ?? '') : ($metaDescription ?? $pageSubtitle ?? '')))
@section('og_title', $pageTitle)
@section('og_description', $metaDescription ?? $pageSubtitle ?? '')

@push('styles')
<style>
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
<div class="container py-4 servis-liste-container">
    <div class="row">
        <div class="{{ (isset($brand) && $brand) ? 'col-12' : 'col-lg-9' }}">
            <div class="blog-posts">
                @forelse($services as $service)
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
                            @if($service->phone)<p class="text-2 mb-1">{{ \App\Helpers\ContentHelper::formatPhone($service->phone) }}</p>@endif
                            @if($service->brands->isNotEmpty())<p class="text-2 mb-1"><i class="bi bi-tag"></i> {{ $service->brands->pluck('name')->join(', ') }}</p>@endif
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
                    <p class="text-muted">Henüz servis bulunmuyor.</p>
                </div>
                @endforelse
            </div>
            @if($services->hasPages())
            <div class="row">
                <div class="col">
                    {{ $services->links() }}
                </div>
            </div>
            @endif
        </div>
        @if(!isset($brand) || !$brand)
        <div class="col-lg-3">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title">Kategoriler</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ route('servis.index') }}">Tümü</a></li>
                        @foreach($categories as $cat)
                            <li class="mb-2"><a href="{{ route('servis.category', $cat) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
