# dockerProject
```
docker compose up -d
```
```
docker compose run composer install
```
```
docker compose exec php chmod -R 775 storage bootstrap/cache
```
OR
```
docker compose exec php chown -R www-data:www-data /var/www/laravel/storage
```
```
docker compose exec php php artisan migrate:fresh --seed
```

