#!/bin/sh

cp .env.example .env
cp phpunit.example.xml phpunit.xml
php artisan cache:clear
php artisan config:clear
php artisan key:generate
