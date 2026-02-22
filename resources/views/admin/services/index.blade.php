@extends('admin.layout')

@section('title', 'Servisler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Servisler</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Yeni Servis</a>
</div>
<form method="get" class="row g-2 mb-3">
    <div class="col-auto">
        <select name="brand_id" class="form-select form-select-sm">
            <option value="">Tüm markalar</option>
            @foreach($brands as $b)
                <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <select name="category_id" class="form-select form-select-sm">
            <option value="">Tüm kategoriler</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-sm btn-secondary">Filtrele</button>
    </div>
</form>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">Sıra</th>
                    <th>Başlık</th>
                    <th>Markalar</th>
                    <th>Kategoriler</th>
                    <th>Telefon</th>
                    <th>Durum</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $s)
                <tr>
                    <td>{{ $s->order }}</td>
                    <td>{{ $s->title }}</td>
                    <td>{{ $s->brands->pluck('name')->join(', ') ?: '—' }}</td>
                    <td>{{ $s->categories->pluck('name')->join(', ') ?: '—' }}</td>
                    <td>{{ $s->phone ?? '—' }}</td>
                    <td>{{ $s->is_published ? 'Yayında' : 'Taslak' }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                        <form action="{{ route('admin.services.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Henüz servis yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $services->links() }}</div>
@endsection
