# Merkez Teknik Blog

Laravel tabanlı teknik blog uygulaması.

## Gereksinimler

- Docker & Docker Compose
- Git

## Kurulum

```bash
# Projeyi klonla
git clone https://github.com/mert55202/merkezteknikblog.git
cd merkezteknikblog

# .env dosyasını oluştur
cp .env.example .env

# Docker ile başlat
docker compose up -d

# Uygulama anahtarı oluştur
docker compose exec web php artisan key:generate

# Migration çalıştır
docker compose exec web php artisan migrate --force

# Storage link
docker compose exec web php artisan storage:link
```

Uygulama: **http://localhost:8000**

## Kullanışlı Komutlar

```bash
# Migration
docker compose exec web php artisan migrate --force

# Cache temizleme
docker compose exec web php artisan route:clear
docker compose exec web php artisan view:clear
docker compose exec web php artisan config:clear

# Composer
docker compose exec web composer install
```

## Opsiyonel: phpMyAdmin

```bash
docker compose --profile phpmyadmin up -d
```

phpMyAdmin: **http://localhost:8080**  
(MySQL: host `mysql`, user `merkezteknikblog`, pass `secret`)
