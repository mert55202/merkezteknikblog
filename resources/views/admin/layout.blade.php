<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Denizli Teknik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: #1e293b; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <div class="sidebar w-25 py-3" style="min-width: 220px;">
            <div class="px-3 mb-3">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-bold">Denizli Teknik Admin</a>
            </div>
            <ul class="nav flex-column">
                @if(auth()->user()->hasPermission('dashboard'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                @endif
                @if(auth()->user()->hasPermission('categories'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="bi bi-folder me-2"></i>Kategoriler</a></li>
                @endif
                @if(auth()->user()->hasPermission('brands'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.brands.index') }}"><i class="bi bi-tag me-2"></i>Markalar</a></li>
                @endif
                @if(auth()->user()->hasPermission('services'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.services.index') }}"><i class="bi bi-tools me-2"></i>Servisler</a></li>
                @endif
                @if(auth()->user()->hasPermission('site_contents'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.site-contents.index') }}"><i class="bi bi-pencil-square me-2"></i>Sayfa İçerikleri</a></li>
                @endif
                @if(auth()->user()->hasPermission('users'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i>Kullanıcılar</a></li>
                @endif
                @if(auth()->user()->hasPermission('reports'))
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.index') }}"><i class="bi bi-graph-up me-2"></i>Raporlama</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right me-2"></i>Siteyi Görüntüle</a></li>
                <li class="nav-item mt-2"><span class="nav-link text-muted small"><i class="bi bi-person-badge me-2"></i>{{ auth()->user()->getRoleLabel() }}</span></li>
                <li class="nav-item mt-3"><a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>Çıkış</a></li>
            </ul>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
        <div class="flex-grow-1 p-4 bg-light">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
