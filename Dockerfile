FROM php:8.3-cli-alpine

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    sqlite \
    sqlite-dev \
    libzip-dev \
    oniguruma-dev \
    bash \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Set permissions
RUN chmod -R 775 storage bootstrap/cache \
    && cp .env.example .env \
    && composer install --no-interaction --prefer-dist --optimize-autoloader \
    && php artisan key:generate --force \
    && touch database/database.sqlite \
    && php artisan migrate --force \
    && php artisan db:seed --force \
    && php artisan storage:link

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
