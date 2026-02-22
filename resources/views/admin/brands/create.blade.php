@extends('admin.layout')

@section('title', 'Yeni Marka')

@section('content')
@php $brand = $brand ?? null; @endphp
<h1 class="h3 mb-4">Yeni Marka</h1>
<form action="{{ route('admin.brands.store') }}" method="POST">
    @csrf
    @include('admin.brands._form', ['brand' => $brand])
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
