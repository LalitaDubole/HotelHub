#!/bin/bash

cat > /var/www/html/.env << EOF
APP_NAME=HotelHub
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=true
APP_URL=${APP_URL}

DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

MAIL_MAILER=log
LOG_CHANNEL=stderr
CACHE_DRIVER=array
SESSION_DRIVER=cookie
EOF

echo ".env created!"

chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

php artisan config:clear
php artisan migrate:fresh --force || true
php artisan db:seed --class=RoomSeeder --force || true
php artisan config:cache || true
php artisan route:cache || true

echo "Starting Apache..."
apache2-foreground