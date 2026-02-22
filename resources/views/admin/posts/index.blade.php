@extends('admin.layout')

@section('title', 'Yazılar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Yazılar</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Yeni Yazı</a>
</div>
<form class="mb-3" method="GET">
    <select name="category_id" class="form-select form-select-sm w-auto d-inline-block" onchange="this.form.submit()">
        <option value="">Tüm kategoriler</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
</form>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ Str::limit($post->title, 40) }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->published_at?->format('d.m.Y') }}</td>
                    <td>{{ $post->is_published ? 'Yayında' : 'Taslak' }}</td>
                    <td>
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Görüntüle</a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Düzenle</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Henüz yazı yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $posts->links() }}</div>
@endsection
