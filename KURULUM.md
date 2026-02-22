# Denizli Teknik Blog - Kurulum

## Gereksinimler
- PHP 8.2+
- Composer
- MySQL veya SQLite

## 1. Bağımlılıklar
```bash
cd laravel-app
composer install
cp .env.example .env
php artisan key:generate
```

## 2. Veritabanı
`.env` dosyasında veritabanı ayarlarını yapın. SQLite için:
```
DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite (varsayılan)
```
SQLite kullanıyorsanız:
```bash
touch database/database.sqlite
```
Ardından:
```bash
php artisan migrate
php artisan db:seed
```

## 3. Storage link (yüklenen görseller için)
```bash
php artisan storage:link
```

## 4. Porto tema (ön yüz)
Ön yüzün görünmesi için Porto HTML temasının dosyalarını `public/front` klasörüne kopyalayın:

**Kaynak:** `themeforest-dn8eXlxw-porto-responsive-html5-template/HTML/`  
**Hedef:** `laravel-app/public/front/`

Kopyalanacak klasörler: `css`, `img`, `js`, `vendor`

Örnek (Windows PowerShell, proje kökünden):
```powershell
$porto = "themeforest-dn8eXlxw-porto-responsive-html5-template\HTML"
$dest = "laravel-app\public\front"
New-Item -ItemType Directory -Force -Path $dest
Copy-Item "$porto\css" "$dest\css" -Recurse -Force
Copy-Item "$porto\img" "$dest\img" -Recurse -Force
Copy-Item "$porto\js" "$dest\js" -Recurse -Force
Copy-Item "$porto\vendor" "$dest\vendor" -Recurse -Force
```

## 5. Limitless tema (admin - isteğe bağlı)
Admin paneli varsayılan olarak Bootstrap 5 kullanır. Limitless temasını kullanmak için:
- `limitless_v3/Template/layout_1/LTR/default/full/` içeriğini (assets vb.) `public/admin/` altına kopyalayabilirsiniz.
- Görünümü değiştirmek için `resources/views/admin/layout.blade.php` içindeki CSS/JS yollarını güncelleyin.

## 6. Çalıştırma
```bash
php artisan serve
```
- Site: http://localhost:8000
- Admin: http://localhost:8000/admin  
  - E-posta: admin@denizliteknik.com  
  - Şifre: password

## Admin paneli
- **Kategoriler:** Beyaz eşya, kombi, klima vb. kategorileri ekleyin.
- **Yazılar:** Blog yazılarını ekleyin/düzenleyin (her yazıda başlık, içerik, görsel, SEO alanları).
- **Sayfa İçerikleri:** Sitedeki tüm metin ve görselleri düzenleyin (header logo, ana sayfa hero, footer, hakkımızda, iletişim metinleri vb.). Her metin ve her görsel için ayrı input vardır.

## SEO
- Kategoriler ve yazılar için meta başlık, meta açıklama ve slug alanları kullanılır.
- Sayfa başlıkları ve açıklamaları otomatik olarak ilgili alanlardan alınır.
