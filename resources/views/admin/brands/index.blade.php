@extends('admin.layout')

@section('title', 'Markalar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Markalar</h1>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Yeni Marka</a>
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
                @forelse($brands as $b)
                <tr>
                    <td>{{ $b->name }}</td>
                    <td><code>{{ $b->slug }}</code></td>
                    <td>{{ $b->order }}</td>
                    <td>{{ $b->is_active ? 'Aktif' : 'Pasif' }}</td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $b) }}" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                        <form action="{{ route('admin.brands.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Henüz marka yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $brands->links() }}</div>
@endsection
