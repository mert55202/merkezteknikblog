@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="h3 mb-4">Dashboard</h1>
<div class="row">
    @if(auth()->user()->hasPermission('services'))
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Toplam Servis</h5>
                <p class="display-6">{{ $servicesCount }}</p>
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-primary">Servisler</a>
            </div>
        </div>
    </div>
    @endif
    @if(auth()->user()->hasPermission('brands'))
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Markalar</h5>
                <p class="display-6">{{ $brandsCount }}</p>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-sm btn-outline-primary">Markalar</a>
            </div>
        </div>
    </div>
    @endif
    @if(auth()->user()->hasPermission('categories'))
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kategoriler</h5>
                <p class="display-6">{{ $categoriesCount }}</p>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary">Kategoriler</a>
            </div>
        </div>
    </div>
    @endif
    @if(auth()->user()->hasPermission('site_contents'))
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">İçerik Yönetimi</h5>
                <p class="text-muted">Metin ve görseller</p>
                <a href="{{ route('admin.site-contents.index') }}" class="btn btn-sm btn-outline-primary">Düzenle</a>
            </div>
        </div>
    </div>
    @endif
    @if(!auth()->user()->hasPermission('services') && !auth()->user()->hasPermission('brands') && !auth()->user()->hasPermission('categories') && !auth()->user()->hasPermission('site_contents'))
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">Hoş geldiniz, {{ auth()->user()->name }}. Yetkinize uygun yönetim sayfaları sol menüde listelenir.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
