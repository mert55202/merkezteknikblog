@extends('admin.layout')

@section('title', 'Yeni Yazı')

@section('content')
<h1 class="h3 mb-4">Yeni Yazı</h1>
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.posts._form')
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
