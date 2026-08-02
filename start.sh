#!/bin/bash
set -e

# .env file banao environment variables se
cat > /var/www/html/.env << EOF
APP_NAME=HotelHub
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL}

DB_CONNECTION=mysql
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
php artisan migrate --force
echo "Migration done!"

php artisan db:seed --class=RoomSeeder --force
echo "Seeding done!"

php artisan config:cache
php artisan route:cache

echo "Starting Apache..."
apache2-foreground