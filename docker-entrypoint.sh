#!/bin/bash
set -e

# Wait a moment for any services to be ready
sleep 2

# Discover packages first (this will cache properly without dev packages)
php artisan package:discover --ansi

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
