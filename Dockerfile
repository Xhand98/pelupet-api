FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies (keep dev for package discovery)
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Copy application files
COPY . .

# Generate optimized autoload files and cache before removing dev packages
RUN composer dump-autoload --optimize && \
    composer install --optimize-autoloader --no-dev --no-scripts && \
    php artisan package:discover --ansi

# Create SQLite database
RUN mkdir -p /var/www/database && \
    touch /var/www/database/database.sqlite

# Set permissions
RUN chown -R www-data:www-data /var/www && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Copy nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port
EXPOSE 8000

# Start supervisord
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
