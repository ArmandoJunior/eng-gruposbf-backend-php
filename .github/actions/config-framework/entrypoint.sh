#!/bin/sh

cp .env.example .env
cp phpunit.example.xml phpunit.xml
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan key:generate
chmod -R 777 storage bootstrap/cache

#cp /.docker/app/.env .env
#cp /.docker/app/.env.testing .env.testing
#php artisan cache:clear
#php artisan config:clear
#php artisan route:clear
#php artisan key:generate
#chmod -R 777 storage bootstrap/cache
