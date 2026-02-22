# Denizli Teknik Blog – Docker ile Çalıştırma

## Gereksinim
- Docker ve Docker Compose kurulu olmalı.

## Hızlı başlangıç

1. **Proje klasörüne girin**
   ```bash
   cd laravel-app
   ```

2. **Docker için .env hazırlayın**  
   İlk seferde `.env` yoksa container içinde `.env.docker` kopyalanır ve `APP_KEY` üretilir.  
   İsterseniz önceden kendiniz oluşturabilirsiniz:
   ```bash
   copy .env.docker .env
   ```
   (Windows PowerShell: `Copy-Item .env.docker .env`)

3. **Container’ları build edip başlatın**
   ```bash
   docker compose up -d --build
   ```
   İlk açılışta MySQL hazır olana kadar uygulama birkaç deneme yapar (~20–30 sn). Log: `docker compose logs -f app`.

4. **Tarayıcıdan açın**
   - Site: http://localhost:8000  
   - Admin: http://localhost:8000/admin  
   - Giriş: `mert55202@gmail.com` / `MmMm5520`
   - **phpMyAdmin:** http://localhost:8080 (kullanıcı: `merkezteknikblog` / şifre: `secret` veya root / `rootsecret`)

## Servisler

| Container | Port  | Açıklama           |
|-----------|--------|---------------------|
| merkezteknikblog_nginx | 8000   | Web arayüzü         |
| merkezteknikblog_phpmyadmin | 8080 | phpMyAdmin          |
| merkezteknikblog_mysql | 3306   | MySQL               |
| merkezteknikblog_app   | (iç)   | PHP-FPM (Laravel)   |

## Performans (otomatik)

PHP OPcache, realpath cache, Nginx gzip + statik önbellek, Laravel config/route/view cache, cache/session için file driver. .env veya route değişince: `docker compose exec app php artisan config:clear route:clear view:clear` sonra `docker compose restart app`.

## Yararlı komutlar

```bash
# Logları izle
docker compose logs -f

# Laravel komutları (migrate, seed, cache temizleme vb.)
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
docker compose exec app php artisan cache:clear

# Container içine shell
docker compose exec app sh
```

## Durdurma

```bash
docker compose down
```

Veritabanı verisi `merkezteknikblog_mysql_data` volume’unda kalır. Tamamen silmek için:

```bash
docker compose down -v
```
