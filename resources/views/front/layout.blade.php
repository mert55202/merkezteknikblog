<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <meta name="author" content="{{ config('seo.site_name') }}">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="theme-color" content="{{ config('seo.theme_color', '#1e3a5f') }}">
    @php $faviconUrl = \App\Helpers\ContentHelper::imageUrl(\App\Models\SiteContent::getValue('header_logo')); @endphp
    <link rel="icon" type="image/png" href="{{ $faviconUrl ?: asset('front/img/logo-default-slim.png') }}">
    <title>@yield('title', config('seo.site_name'))</title>
    @php
        $metaDesc = trim((string) $__env->yieldContent('meta_description'));
        if ($metaDesc === '') { $metaDesc = config('seo.default_description') ?? config('seo.site_name') ?? ''; }
        $metaDesc = e(Str::limit(strip_tags($metaDesc ?? ''), 160));
    @endphp
    <meta name="description" content="{{ $metaDesc }}">
    @if($__env->yieldContent('meta_keywords'))
    <meta name="keywords" content="{{ e($__env->yieldContent('meta_keywords')) }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="tr" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    <meta property="og:locale" content="tr_TR">
    <meta property="og:type" content="@yield('og_type', 'website')">
    @php
        $ogTitle = trim((string) $__env->yieldContent('og_title'));
        if ($ogTitle === '') { $ogTitle = config('seo.site_name') ?? 'Site'; }
        $ogDesc = trim((string) $__env->yieldContent('og_description'));
        if ($ogDesc === '') { $ogDesc = config('seo.default_description') ?? config('seo.site_name') ?? ''; }
        $ogDesc = e(Str::limit(strip_tags($ogDesc ?? ''), 200));
    @endphp
    <meta property="og:title" content="{{ e($ogTitle) }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('seo.site_name') }}">
    @php
        $defaultOgImage = config('seo.default_image') ? \App\Helpers\ContentHelper::imageUrl(config('seo.default_image')) : \App\Helpers\ContentHelper::imageUrl(\App\Models\SiteContent::getValue('header_logo') ?? '');
    @endphp
    @if($defaultOgImage)
    <meta property="og:image" content="{{ $defaultOgImage }}">
    <meta property="og:image:secure_url" content="{{ $defaultOgImage }}">
    <meta property="og:image:alt" content="{{ config('seo.site_name') }}">
    @endif
    @stack('meta')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ e($ogTitle) }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    @if($defaultOgImage)
    <meta name="twitter:image" content="{{ $defaultOgImage }}">
    @endif
    @if(config('seo.twitter_handle'))
    <meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
    @endif
    <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="{{ route('feed') }}">
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "Organization",
                "@@id": {{ json_encode(url('/') . '#organization') }},
                "name": {{ json_encode(config('seo.site_name')) }},
                "url": {{ json_encode(url('/')) }},
                "logo": { "@@type": "ImageObject", "url": {{ json_encode($defaultOgImage ?? url('/')) }} }
            },
            {
                "@@type": "WebSite",
                "name": {{ json_encode(config('seo.site_name')) }},
                "url": {{ json_encode(url('/')) }},
                "description": {{ json_encode(config('seo.default_description')) }},
                "publisher": { "@@id": {{ json_encode(url('/') . '#organization') }} },
                "inLanguage": "tr-TR"
            }
        ]
    }
    </script>
    @stack('json-ld')
    <link rel="stylesheet" href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/theme-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/theme-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/skins/default.css') }}">
    @stack('styles')
    <style>
        html, body { height: 100%; }
        .body { min-height: 100%; display: flex; flex-direction: column; }
        .main { flex: 1 0 auto; }
        #footer { flex-shrink: 0; }
        @media (max-width: 767px) {
            article.post-large { margin-left: 0 !important; }
        }
        .dropdown-menu-markalar { min-width: auto; padding: 0; }
        .dropdown-mega-content .col-auto { min-width: 120px; }
    </style>
</head>
<body data-plugin-page-transition>
    <div class="body">
        {{-- index-blog.html header birebir --}}
        <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false}">
            <div class="header-body border-0">
                <div class="header-nav-bar header-nav-bar-top-border bg-light">
                    <div class="header-container container container-xl-custom">
                        <div class="header-row align-items-center">
                            <div class="header-column flex-shrink-0 me-4">
                                <h1 class="header-logo mb-0">
                                    <a href="{{ route('home') }}">
                                        <img alt="{{ \App\Models\SiteContent::getValue('header_logo_alt', config('seo.site_name')) }}" width="100" height="48" src="{{ \App\Helpers\ContentHelper::imageUrl(\App\Models\SiteContent::getValue('header_logo')) }}" onerror="this.src='{{ asset('front/img/logo-default-slim.png') }}'">
                                        <span class="hide-text">{{ config('seo.site_name') }}</span>
                                    </a>
                                </h1>
                            </div>
                            <div class="header-column flex-grow-1">
                                <div class="header-row justify-content-end justify-content-lg-start">
                                    <div class="header-nav p-0">
                                        <div class="header-nav header-nav-links header-nav-spaced header-nav-first-item-no-padding justify-content-start">
                                            <div class="header-nav-main header-nav-main-square header-nav-main-font-lg-upper header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                                <nav class="collapse">
                                                    <ul class="nav nav-pills flex-column flex-lg-row" id="mainNav">
                                                        <li class="dropdown ms-0">
                                                            <a class="dropdown-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ \App\Models\SiteContent::getValue('nav_anasayfa', 'Anasayfa') }}</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item {{ request()->routeIs('servis.*') ? 'active' : '' }}" href="{{ route('servis.index') }}">Servisler</a>
                                                        </li>
                                                        @if(isset($brands) && $brands->isNotEmpty())
                                                        <li class="dropdown">
                                                            <a class="dropdown-item dropdown-toggle {{ request()->routeIs('servis.brand') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Markalar</a>
                                                            <ul class="dropdown-menu dropdown-menu-markalar">
                                                                <li>
                                                                    <div class="dropdown-mega-content px-3 py-2">
                                                                        <div class="row gx-3">
                                                                            @foreach(($brands ?? collect())->chunk(5) as $brandChunk)
                                                                            <div class="col-auto">
                                                                                <ul class="list-unstyled mb-0">
                                                                                    @foreach($brandChunk as $brand)
                                                                                    <li><a class="dropdown-item py-1" href="{{ route('servis.brand', $brand) }}">{{ $brand->name }}</a></li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        @endif
                                                        <li><a class="dropdown-item {{ request()->routeIs('page.contact') ? 'active' : '' }}" href="{{ route('page.contact') }}">{{ \App\Models\SiteContent::getValue('nav_iletisim', 'İletişim') }}</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                        </div>
                                        <div class="header-nav-features">
                                            <div class="header-nav-features-search-reveal-container">
                                                <div class="header-nav-feature header-nav-features-search header-nav-features-search-reveal d-inline-flex">
                                                    <a href="#" class="header-nav-features-search-show-icon d-inline-flex text-decoration-none"><i class="fas fa-search header-nav-top-icon"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-nav-features header-nav-features-no-border p-static">
                    <div class="header-nav-feature header-nav-features-search header-nav-features-search-reveal header-nav-features-search-reveal-big-search header-nav-features-search-reveal-big-search-full">
                        <div class="container">
                            <div class="row h-100 d-flex">
                                <div class="col h-100 d-flex">
                                    <form role="search" class="d-flex h-100 w-100" action="{{ route('servis.index') }}" method="get">
                                        <div class="big-search-header input-group">
                                            <input class="form-control text-1" name="q" type="search" value="{{ request('q') }}" placeholder="Ara...">
                                            <a href="#" class="header-nav-features-search-hide-icon"><i class="fas fa-times header-nav-top-icon"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div role="main" class="main">
            @if(session('success'))
                <div class="container container-xl-custom py-2"><div class="alert alert-success alert-dismissible fade show mb-0" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button></div></div>
            @endif
            @if(session('error'))
                <div class="container container-xl-custom py-2"><div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button></div></div>
            @endif
            @yield('content')
        </div>

        <footer id="footer">
            <div class="footer-copyright">
                <div class="container container-xl-custom py-2">
                    <div class="row py-4">
                        <div class="col-12 text-center">
                            <p class="mb-0">{{ \App\Models\SiteContent::getValue('footer_copyright', '© '.date('Y').' Tüm hakları saklıdır.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @php $fabTel = preg_replace('/\D/', '', \App\Models\SiteContent::getValue('footer_tel', '')); @endphp
    <a href="{{ $fabTel ? 'tel:' . $fabTel : route('page.contact') }}" class="d-md-none fab-iletisim" id="fabMobile" title="Ara" aria-label="Ara" onclick="navigator.sendBeacon('{{ url('/track-search-click') }}?t='+Date.now());">
        <i class="fas fa-phone"></i>
    </a>
    <a href="{{ route('page.contact') }}" class="d-none d-md-flex fab-iletisim" id="fabDesktop" title="İletişim" aria-label="İletişim" onclick="navigator.sendBeacon('{{ url('/track-search-click') }}?t='+Date.now());">
        <i class="fas fa-phone"></i>
    </a>
    <style>
        .fab-iletisim {
            position: fixed;
            top: 50%;
            right: 24px;
            transform: translateY(-50%);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #1e3a5f;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.25);
            z-index: 9999;
            text-decoration: none;
            transition: background .2s, transform .2s;
        }
        .fab-iletisim:hover { color: #fff; background: #152a45; transform: translateY(-50%) scale(1.05); }
    </style>

    <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/theme.js') }}"></script>
    <script>
    (function(){
        var t=document.querySelector('meta[name="csrf-token"]');
        var tok=t?t.getAttribute('content'):'';
        var serviceUrl='{{ route("track.service.click") }}';
        document.addEventListener('click',function(e){
            var el=e.target.closest('.js-track-service-click');
            if(el&&el.dataset.serviceId){
                var fd=new FormData();
                fd.append('_token',tok||'');
                fd.append('service_id',el.dataset.serviceId);
                fd.append('button_type',el.dataset.buttonType||'ara');
                fetch(serviceUrl,{method:'POST',headers:{'X-CSRF-TOKEN':tok||'','Accept':'application/json','X-Requested-With':'XMLHttpRequest'},body:fd,credentials:'same-origin'}).catch(function(){});
            }
        },true);
    })();
    </script>
    @stack('scripts')
</body>
</html>
