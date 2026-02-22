@extends('admin.layout')

@section('title', 'Kullanıcılar')

@section('content')
<h1 class="h3 mb-4">Kullanıcılar</h1>
<p class="text-muted">Admin kullanıcıları ve rollerini buradan yönetebilirsiniz. Rol, menü ve erişim yetkilerini otomatik belirler.</p>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>E-posta</th>
                    <th>Rol</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge bg-secondary">{{ $u->getRoleLabel() }}</span></td>
                    <td>
                        <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary">Rol Düzenle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
