FROM php:8.3-cli-alpine

# Install system dependencies and required PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev \
    oniguruma-dev

RUN docker-php-ext-install pdo pdo_sqlite pcntl bcmath mbstring

# Copy Composer from official image
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy backend files
COPY . /app/

# Create required Laravel directory structure and dummy .env
RUN mkdir -p storage/framework/sessions \
             storage/framework/views \
             storage/framework/cache/data \
             storage/logs \
             bootstrap/cache \
             database \
    && chmod -R 777 storage bootstrap/cache database \
    && touch database/database.sqlite \
    && chmod +x /app/entrypoint.sh

# Install composer packages without triggering boot scripts during build
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

ENV PORT=8000
EXPOSE 8000

ENTRYPOINT ["/app/entrypoint.sh"]
