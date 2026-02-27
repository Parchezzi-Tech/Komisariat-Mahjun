#!/bin/bash
set -e

echo "Starting Railway deployment..."

# Create necessary directories if they don't exist
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chmod -R 775 storage bootstrap/cache

# Run migrations (if database is configured)
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Running migrations..."
  php artisan migrate --force
fi

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Start the application
echo "Starting Laravel..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
