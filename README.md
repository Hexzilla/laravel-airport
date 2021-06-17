# Build del proyecto
docker build -t laravel-app .
# Cargar contenedor docker
docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash
# Establecer config de bd en .env
# Update library in composer
"laravel/ui": "3.1",
composer update
composer install
php artisan migrate --seed
php artisan storage:link
# Iniciar servidor
php artisan serve --host 0.0.0.0
http://localhost:3000/



# Start once installed
docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash
php artisan serve --host 0.0.0.0
http://localhost:3000/home


# Generate view/crud
php artisan infyom:scaffold News --fromTable --tableName=som_news

## Notes
- Disable softDelete (by default enabled) -> laravel-app/config/infyom/laravel_generator.php -> 'softDelete' => false
- Disable timestamps_action_dates (by default enabled) -> laravel-app/config/infyom/laravel_generator.php -> 'enabled' => false