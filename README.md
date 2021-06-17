# Tareas de instalación inicial
## Establecer config de bd en .env
## Build del proyecto
```docker build -t laravel-app .```
## Cargar contenedor docker
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Actualizar dependencia y actualizar librerías en composer
- ```"laravel/ui": "3.1"```
- ```composer update```
- ```composer install```
## Crear tablas usuario
-```php artisan migrate --seed```
## Crear symlinks
```php artisan storage:link```

# Tareas cuando descargamos el proyecto en un pc nuevo
## Build del proyecto
```docker build -t laravel-app .```
## Cargar contenedor docker
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Actualizar librerías en composer
- ```composer update```
- ```composer install```
## Crear symlinks
```php artisan storage:link```

# Iniciar servidor
## Cargar contenedor docker
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Iniciar servidor php
```php artisan serve --host 0.0.0.0```
## Acceder a la ruta
[http://localhost:3000/home](http://localhost:3000/home)


# Generar vistas/crud (debemos tener la tabla en BD)
## Cargar contenedor docker
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Generamos la vista/crud desde tabla
```php artisan infyom:scaffold {Nombre de vista} --fromTable --tableName={tabla}```


# Notes
## Por defecto viene soft delete
- Disable softDelete (by default enabled) -> ```laravel-app/config/infyom/laravel_generator.php``` -> ```'softDelete' => false```
## Por defecto viene con timestamps para create, update y delete
- Disable timestamps_action_dates (by default enabled) -> ```laravel-app/config/infyom/laravel_generator.php``` -> ```'enabled' => false```