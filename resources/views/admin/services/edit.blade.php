@extends('admin.layout')

@section('title', 'Servis Düzenle')

@section('content')
<h1 class="h3 mb-4">Servis Düzenle</h1>
<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.services._form', ['service' => $service, 'brands' => $brands, 'categories' => $categories])
    <button type="submit" class="btn btn-primary">Güncelle</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
