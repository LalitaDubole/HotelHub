#!/bin/bash
php artisan config:cache
php artisan route:cache
php artisan migrate --force
php artisan db:seed --class=RoomSeeder --force
apache2-foreground