# Highfive API

#### Dockerの起動

1. copy .env.example to .env 
2. docker exec highfive_app composer install
3. docker exec highfive_app php artisan key:generate
4. docker exec highfive_app php artisan migrate

Access: http://localhost:8080/

