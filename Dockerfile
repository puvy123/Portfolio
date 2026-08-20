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
    sqlite-dev \
    oniguruma-dev \
    sed

RUN docker-php-ext-install pdo pdo_sqlite pcntl bcmath mbstring

# Copy Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy backend files
COPY backend/ /app/

# Setup directories and permissions, ensure LF line endings
RUN mkdir -p storage/framework/sessions \
             storage/framework/views \
             storage/framework/cache/data \
             storage/logs \
             bootstrap/cache \
             database \
    && chmod -R 777 storage bootstrap/cache database \
    && touch database/database.sqlite \
    && sed -i 's/\r$//' entrypoint.sh \
    && chmod +x entrypoint.sh

# Install composer packages
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

ENV PORT=8000
EXPOSE 8000

CMD ["/bin/sh", "/app/entrypoint.sh"]
