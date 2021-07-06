#!/bin/bash
php artisan optimize &&
php artisan route:clear &&  
php artisan view:clear && 
php artisan config:clear &&
php artisan cache:clear && 
php artisan clear-compiled &&
php artisan serve --host 0.0.0.0