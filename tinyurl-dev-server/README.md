# tinyurl-dev-server

## Project setup
```
composer install
```

* Create a database and add fields in the *.env* file.
    - DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

### Create and populate tables
```
php artisan migrate
```

### Start the app on http://localhost:8000/
```
php artisan serve
```
