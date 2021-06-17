# Build del proyecto
docker build -t laravel-app .
# Cargar contenedor docker
docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash
# Establecer config de bd en .env
# Update library in composer
"laravel/ui": "3.1",
composer update
composer install
# Autoload
# composer dump-autoload
# Iniciar servidor
php artisan serve --host 0.0.0.0
