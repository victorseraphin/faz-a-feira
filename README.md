<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation Instructions

1. Run `git clone https://github.com/victorseraphin/faz-a-feira.git faz-a-feira && cd faz-a-feira`
### Dentro do Container 
2. From the projects root run `cp .env.example .env` in Linux
3. From the projects root run `copy .env.example .env` in Windows

4. Configures the database of the .env file
```
DB_CONNECTION=
DB_HOST=
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
5. Run `composer install` from the projects root folder
6. Run `composer update` from the projects root folder
7. Run `npm install` from the projects root folder
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `php artisan serve`


