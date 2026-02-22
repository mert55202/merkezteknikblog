# SEO Kontrol Listesi – Eksiksiz Uygulama

Bu dosya, sitede uygulanan tüm SEO öğelerini listeler. ChatGPT veya bir denetçiye “SEO’da ne eksik?” diye sorduğunuzda referans olarak kullanabilirsiniz.

---

## 1. Temel meta etiketleri
- [x] `<title>` – Her sayfa/yazı için benzersiz, admin’den düzenlenebilir
- [x] `<meta name="description">` – Max ~160 karakter, tüm sayfalarda
- [x] `<meta name="keywords">` – Yazı/kategori için isteğe bağlı
- [x] `<meta name="robots">` – Varsayılan `index, follow`; 404/500’de `noindex, nofollow`
- [x] `<meta name="author">` – Site adı
- [x] `<meta name="referrer">` – `strict-origin-when-cross-origin`
- [x] `<meta name="theme-color">` – Mobil tarayıcı rengi (config’den)

## 2. Teknik
- [x] `<meta charset="utf-8">`
- [x] `<meta name="viewport" content="width=device-width, initial-scale=1">`
- [x] `<html lang="tr">` – Dil bildirimi
- [x] Canonical URL – Her sayfada `<link rel="canonical">`
- [x] Hreflang – `tr` ve `x-default` (tek dil)
- [x] Favicon – `<link rel="icon">` (logo veya varsayılan)

## 3. Open Graph (Facebook, LinkedIn, vb.)
- [x] `og:locale` (tr_TR)
- [x] `og:type` (website / article yazı sayfasında)
- [x] `og:title`
- [x] `og:description`
- [x] `og:url`
- [x] `og:site_name`
- [x] `og:image` + `og:image:secure_url` + `og:image:alt`
- [x] Yazı sayfasında: `article:published_time`, `article:modified_time`, `article:section`, `article:author`

## 4. Twitter Card
- [x] `twitter:card` (summary_large_image)
- [x] `twitter:title`
- [x] `twitter:description`
- [x] `twitter:image` (varsayılan + yazı görseli)
- [x] `twitter:site` (config’den, isteğe bağlı)

## 5. Yapısal veri (JSON-LD)
- [x] **Organization** – Ad, URL, logo, @id
- [x] **WebSite** – Ad, URL, açıklama, publisher, inLanguage
- [x] **Article** (yazı sayfası) – headline, description, url, datePublished, dateModified, author, publisher, image, mainEntityOfPage
- [x] **BreadcrumbList** – Anasayfa, Hakkımızda, İletişim, Blog, Kategori, Yazı sayfalarında

## 6. İçerik ve URL
- [x] Her sayfa ve yazı için admin’den meta title / description
- [x] Kategoriler için meta title / description
- [x] Anlamlı, sabit URL’ler (slug)
- [x] Tek H1 per sayfa (başlık)

## 7. Sitemap ve dizin
- [x] `/sitemap.xml` – Tüm sayfalar, kategoriler, yazılar; `route()` ile doğru domain
- [x] `lastmod` ve `changefreq`, `priority`
- [x] `/robots.txt` – Dinamik; Sitemap URL’i domain’e göre; `Disallow: /admin`

## 8. RSS
- [x] `/feed.xml` – RSS 2.0, son 50 yazı
- [x] Layout’ta `<link rel="alternate" type="application/rss+xml">`

## 9. Hata sayfaları
- [x] 404 ve 500’de `noindex, nofollow`

## 10. Görseller
- [x] Anlamlı `alt` metinleri (başlık/bağlam)
- [x] Paylaşım görselleri tam URL (asset / uploads)

## 11. Yapılandırma
- [x] `config/seo.php` – site_name, default_description, twitter_handle, theme_color, default_image
- [x] `.env` örnekleri: `SEO_SITE_NAME`, `SEO_DEFAULT_DESCRIPTION`, `SEO_TWITTER_HANDLE`, `SEO_FACEBOOK_APP_ID`, `SEO_THEME_COLOR`

## İsteğe bağlı (ileride eklenebilir)
- Google / Bing site doğrulama meta etiketi (site sahibi kendi ekler)
- Çok dilli sitede ek `hreflang` değerleri
- WebSite schema’da `potentialAction` (arama kutusu)
- LocalBusiness / Place (yerel SEO için)

---

**Özet:** Yukarıdaki maddeler projede uygulanmıştır. “SEO’da şu eksik” denmesi için yaygın checklist’lerdeki temel ve orta düzey öğeler tamamlanmış durumdadır.
