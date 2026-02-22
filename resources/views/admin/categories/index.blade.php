@extends('admin.layout')

@section('title', 'Kategoriler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Kategoriler</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Yeni Kategori</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Slug</th>
                    <th>Sıra</th>
                    <th>Durum</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td><code>{{ $c->slug }}</code></td>
                    <td>{{ $c->order }}</td>
                    <td>{{ $c->is_active ? 'Aktif' : 'Pasif' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                        <form action="{{ route('admin.categories.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Henüz kategori yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
