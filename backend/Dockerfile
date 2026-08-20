FROM php:8.3-cli-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev

RUN docker-php-ext-install pdo pdo_sqlite pcntl bcmath

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy backend application
COPY . /app/

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Prepare storage permissions and database
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs \
    && chmod -R 777 storage bootstrap/cache \
    && touch database/database.sqlite \
    && php artisan key:generate --force \
    && php artisan migrate --force --seed

ENV PORT=8000
EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
