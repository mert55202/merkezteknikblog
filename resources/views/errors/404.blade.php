<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>404 - Sayfa Bulunamadı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center py-5">
        <h1 class="display-1 text-muted">404</h1>
        <h2 class="mb-3">Sayfa Bulunamadı</h2>
        <p class="text-muted mb-4">Aradığınız sayfa mevcut değil veya taşınmış olabilir.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Anasayfaya Dön</a>
        <a href="{{ url('/blog') }}" class="btn btn-outline-secondary ms-2">Blog</a>
    </div>
</body>
</html>
