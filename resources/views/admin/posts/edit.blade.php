@extends('admin.layout')

@section('title', 'Yazı Düzenle')

@section('content')
<h1 class="h3 mb-4">Yazı Düzenle</h1>
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.posts._form')
    <button type="submit" class="btn btn-primary">Güncelle</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
