@extends('admin.layout')

@section('title', 'Yeni Servis')

@section('content')
@php $service = $service ?? null; @endphp
<h1 class="h3 mb-4">Yeni Servis</h1>
<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.services._form', ['service' => $service, 'brands' => $brands, 'categories' => $categories])
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
