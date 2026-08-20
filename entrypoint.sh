#!/bin/sh
set -e

mkdir -p database
touch database/database.sqlite
chmod -R 777 database storage bootstrap/cache

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

php artisan migrate --force --seed || true

PORT="${PORT:-8000}"
echo "Laravel API server listening on 0.0.0.0:$PORT"
exec php artisan serve --host=0.0.0.0 --port="$PORT"
