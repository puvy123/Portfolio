#!/bin/sh
set -e

# Clear any cached provider/service files from host machine
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php bootstrap/cache/routes-*.php

mkdir -p database storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 777 database storage bootstrap/cache

# Only seed if database is empty
if [ ! -s database/database.sqlite ]; then
  touch database/database.sqlite
  php artisan package:discover --ansi || true
  php artisan migrate --force --seed || true
else
  php artisan package:discover --ansi || true
  php artisan migrate --force || true
fi

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

PORT="${PORT:-8000}"
echo "Laravel API server listening on 0.0.0.0:$PORT"
exec php artisan serve --host=0.0.0.0 --port="$PORT"
