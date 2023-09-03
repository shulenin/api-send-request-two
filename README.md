Installation
------------

1. Копировать ``.env.example`` в корне, создав ``.env``
2. Настроить окружение в .env файле
3. Установить зависимости Composer
``` bash
composer install
```
4. Накатить миграции с заполненными данными
```bash
php artisan migrate:fresh --seed
```
5. Сгенерировать ключ приложения
```bash
php artisan key:generate
```
5. Создать администратора
```bash
php artisan orchid:admin admin <email> <password>
```