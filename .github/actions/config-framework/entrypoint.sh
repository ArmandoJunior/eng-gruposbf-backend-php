#!/bin/sh

cp .env.example .env
cp phpunit.example.xml phpunit.xml
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan key:generate
chmod -R 777 storage bootstrap/cache
