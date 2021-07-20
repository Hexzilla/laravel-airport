# Tasks for initial installation
## Configured db settings in .env file
## Build the project
```docker build -t laravel-app .```
## Run the docker container
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Update libraries and dependencies in Composer
- ```"laravel/ui": "3.1"```
- ```composer update```
- ```composer install```
## Create the users tables
-```php artisan migrate --seed```
## Create the symlinks
```php artisan storage:link```

# Tareas cuando descargamos el proyecto en un pc nuevo
## Build the project
```docker build -t laravel-app .```
## Run the docker container
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Update libraries and dependencies in Composer
- ```composer update```
- ```composer install```
## Create the symlinks
```php artisan storage:link```

# Start the server
## Run the docker container
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Start the development server
```php artisan serve --host 0.0.0.0```
## Access the development page
[http://localhost:3000/admin](http://localhost:3000/admin)


# Generate views and crud using admin lte generator
## Run the docker container
```docker run -it --rm -p 3000:8000 -v C:\app\git\aena-som-laravel\laravel-app:/var/www/html/laravel-app laravel-app bash```
## Generate views and crud using admin lte generator
```php artisan infyom:scaffold {Nombre de vista} --fromTable --tableName={tabla}```


# Notes
## By default we use soft-delete
- Disable softDelete (by default enabled) -> ```laravel-app/config/infyom/laravel_generator.php``` -> ```'softDelete' => false```
## By default turn off timestamps
- Disable timestamps_action_dates (by default enabled) -> ```laravel-app/config/infyom/laravel_generator.php``` -> ```'enabled' => false```