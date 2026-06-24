#!/bin/sh
set -e

cd /var/www/html

# Make runtime dirs writable (volumes may reset ownership)
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Only the main web container runs migrations & primes caches,
# so queue/scheduler containers don't race on startup.
if [ "${CONTAINER_ROLE:-app}" = "app" ]; then
    echo "[entrypoint] waiting for database..."
    until php -r "exit(@fsockopen(getenv('DB_HOST')?:'db', (int)(getenv('DB_PORT')?:3306)) ? 0 : 1);" 2>/dev/null; do
        sleep 2
    done

    php artisan storage:link --force || true
    php artisan migrate --force || true

    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

exec "$@"
