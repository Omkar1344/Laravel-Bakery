# Use PHP 8.2 FPM Alpine as base image
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    postgresql-dev \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install and build Node.js dependencies
RUN npm install && npm run build

# Configure Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Create storage directory and set permissions
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/html/storage/logs \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy .env file and generate key
COPY .env.example .env
RUN sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/g' .env \
    && sed -i 's/DB_HOST=127.0.0.1/DB_HOST=${DB_HOST}/g' .env \
    && sed -i 's/DB_PORT=3306/DB_PORT=${DB_PORT}/g' .env \
    && sed -i 's/DB_DATABASE=laravel/DB_DATABASE=${DB_DATABASE}/g' .env \
    && sed -i 's/DB_USERNAME=root/DB_USERNAME=${DB_USERNAME}/g' .env \
    && sed -i 's/DB_PASSWORD=/DB_PASSWORD=${DB_PASSWORD}/g' .env \
    && php artisan key:generate --force

# Set production environment
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Expose port 80
EXPOSE 80

# Start Nginx & PHP-FPM
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'" 