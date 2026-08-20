#!/bin/sh
set -e

mkdir -p database

# Only seed if database is new
if [ ! -s database/database.sqlite ]; then
  touch database/database.sqlite
  chmod -R 777 database storage bootstrap/cache
  php artisan migrate --force --seed || true
else
  chmod -R 777 database storage bootstrap/cache
  php artisan migrate --force || true
fi

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

PORT="${PORT:-8000}"
echo "Laravel API server listening on 0.0.0.0:$PORT"
exec php artisan serve --host=0.0.0.0 --port="$PORT"
