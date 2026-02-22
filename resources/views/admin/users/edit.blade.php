@extends('admin.layout')

@section('title', 'Kullanıcı Rolü Düzenle')

@section('content')
<h1 class="h3 mb-4">Kullanıcı Rolü Düzenle</h1>
<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Ad</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">E-posta</label>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                <small class="text-muted">E-posta değiştirilemez.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    @foreach($roles as $key => $label)
                        <option value="{{ $key }}" {{ old('role', $user->role) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">Süper Admin: tüm yetkiler. Admin: içerik + sayfa metinleri. Editör: kategoriler + yazılar. Görüntüleyici: sadece dashboard.</small>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">İptal</a>
</form>
@endsection
