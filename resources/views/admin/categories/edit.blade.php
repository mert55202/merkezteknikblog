@extends('admin.layout')

@section('title', 'Kategori Düzenle')

@section('content')
<h1 class="h3 mb-4">Kategori Düzenle</h1>
<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.categories._form', ['category' => $category])
    <button type="submit" class="btn btn-primary">Güncelle</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
