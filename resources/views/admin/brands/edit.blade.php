@extends('admin.layout')

@section('title', 'Marka Düzenle')

@section('content')
<h1 class="h3 mb-4">Marka Düzenle</h1>
<form action="{{ route('admin.brands.update', $brand) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.brands._form', ['brand' => $brand])
    <button type="submit" class="btn btn-primary">Güncelle</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
