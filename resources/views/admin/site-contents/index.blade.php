@extends('admin.layout')

@section('title', 'Sayfa İçerikleri')

@section('content')
<h1 class="h3 mb-4">Sayfa İçerikleri</h1>
<p class="text-muted">Tüm metin ve görselleri buradan düzenleyebilirsiniz. Her metin ve her görsel için ayrı alan vardır.</p>

<form method="get" class="mb-4">
    <label class="form-label">Sayfa / Bölüm seçin</label>
    <select name="page" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
        @php
            $pageLabels = [
                'header' => 'Header (Logo & Menü)',
                'home' => 'Ana Sayfa',
                'footer' => 'Footer',
                'blog_list' => 'Blog Liste Sayfası',
                'blog_post' => 'Blog Yazı Sayfası',
                'about' => 'Hakkımızda',
                'contact' => 'İletişim',
            ];
        @endphp
        @foreach($pages as $p)
            <option value="{{ $p }}" {{ $page == $p ? 'selected' : '' }}>{{ $pageLabels[$p] ?? $p }}</option>
        @endforeach
    </select>
</form>

<form action="{{ route('admin.site-contents.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            @forelse($contents as $content)
                <div class="mb-4 pb-4 border-bottom">
                    <label class="form-label fw-bold">{{ $content->label }}</label>
                    @if($content->type === 'image')
                        @php
                            $imgUrl = \App\Helpers\ContentHelper::imageUrl($content->value);
                        @endphp
                        @if($content->value)
                            <div class="mb-2"><img src="{{ $imgUrl }}" alt="" style="max-height:100px;" onerror="this.style.display='none'"></div>
                        @endif
                        <input type="file" name="{{ $content->key }}" class="form-control" accept="image/*">
                        <small class="text-muted">Yeni yüklemezseniz mevcut görsel kalır.</small>
                    @elseif($content->type === 'textarea')
                        <textarea name="{{ $content->key }}" class="form-control" rows="4">{{ $content->value }}</textarea>
                    @else
                        <input type="text" name="{{ $content->key }}" class="form-control" value="{{ $content->value }}">
                    @endif
                </div>
            @empty
                <p class="text-muted">Bu sayfa için tanımlı içerik yok. Veritabanında site_contents tablosuna kayıt ekleyebilir veya seed çalıştırabilirsiniz.</p>
            @endforelse
        </div>
    </div>
    @if($contents->isNotEmpty())
        <button type="submit" class="btn btn-primary mt-3">Tümünü Kaydet</button>
    @endif
</form>
@endsection
