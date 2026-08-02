#!/bin/bash
set -e

cat > /var/www/html/.env << EOF
APP_NAME=HotelHub
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL}

DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

MAIL_MAILER=log
LOG_CHANNEL=stack
CACHE_DRIVER=file
SESSION_DRIVER=file
EOF

echo ".env created!"
php artisan config:clear
php artisan migrate:fresh --force || echo "Migration error, continuing..."
php artisan db:seed --class=RoomSeeder --force || echo "Seeding error, continuing..."
php artisan config:cache
php artisan route:cache
echo "Starting Apache..."
apache2-foreground