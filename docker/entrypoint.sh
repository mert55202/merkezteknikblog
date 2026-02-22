#!/bin/sh
set -e

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo "vendor eksik, composer install calistiriliyor..."
  composer install --no-dev --no-interaction --prefer-dist 2>/dev/null || true
  chown -R www-data:www-data /var/www/html/vendor 2>/dev/null || true
fi

if [ ! -f .env ]; then
  cp .env.docker .env 2>/dev/null || true
fi
php artisan key:generate --no-interaction --force 2>/dev/null || true

# View'ları önceden derle (her istekte Blade derleme yavaşlığını önler)
php artisan view:cache 2>/dev/null || true

# PHP-FPM once (ayni container icinde 127.0.0.1:9000)
php-fpm &
for i in 1 2 3 4 5 6 7 8 9 10; do
  if php -r "exit(@fsockopen('127.0.0.1', 9000) ? 0 : 1);" 2>/dev/null; then break; fi
  sleep 1
done

# Migrate/seed/link arka planda; nginx hemen baslasin (502 onlenir)
(
  for i in 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15; do
    if php artisan migrate --force --no-interaction 2>/dev/null; then
      php artisan db:seed --force --no-interaction 2>/dev/null || true
      php artisan storage:link --force 2>/dev/null || true
      break
    fi
    sleep 2
  done
) &

# Nginx on planda (container ayakta kalsin)
exec nginx -g "daemon off;"
