#!/bin/sh
set -e

# Ensure SQLite file exists
mkdir -p database
touch database/database.sqlite
chmod -R 777 database storage bootstrap/cache

# Ensure app key exists
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

# Run database migrations and seeders
php artisan migrate --force --seed || true

# Start Laravel server on Render's assigned port
PORT="${PORT:-8000}"
echo "Starting Laravel Backend API on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port="$PORT"
