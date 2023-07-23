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

**Generate Key**
```
php artisan key:generate
```

**Running App**
```
php artisan serve
```

## Create Product

**Login Admin**
```
email : admin@gmail.com
password : admin123
```