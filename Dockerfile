FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN composer install --optimize-autoloader --no-dev --no-interaction

RUN npm ci && npm run build && rm -rf node_modules

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 8080

HEALTHCHECK --interval=10s --timeout=3s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

# Install npm dependencies and build assets
RUN npm ci && npm run build

# Create necessary directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Cache Laravel configuration
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# Expose port
EXPOSE 8080

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
