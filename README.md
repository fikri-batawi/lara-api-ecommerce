## Installation Instructions

**Git clone**
```
git clone https://github.com/fikri-batawi/lara-api-ecommerce.git
cd lara-api-ecommerce
```

**Git package**
```
composer install
```

**Setup .ENV**
```
cp .env.example .env
```

**Create & Setup Database**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-api-ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

**Migrate Database**
```
php artisan migrate
```

**Running Seeder User Admin**
```
php artisan db:seed --class=UserAdminSeeder
```

**Generate Key & JWT**
```
php artisan key:generate
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```

**Running App**
```
php artisan serve --port=8000
```

## Create Product

**Login Admin**
```
email : admin@gmail.com
password : admin123
```