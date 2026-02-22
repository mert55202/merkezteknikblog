@extends('admin.layout')

@section('title', 'Yeni Kategori')

@section('content')
@php $category = $category ?? null; @endphp
<h1 class="h3 mb-4">Yeni Kategori</h1>
<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.categories._form', ['category' => $category])
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
