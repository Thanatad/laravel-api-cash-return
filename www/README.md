<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About CASH RETURN APP
......

## Installation

* Run `git clone https://github.com/Thanatad/laravel-api-cash-return.git`
* Run `cd laravel-api-cash-return/www/`
* Run `composer install` or `php composer.phar install`
* Create `.env` in application root `cp .env.example .env`
* Create a database name `cashreturn` and optional inform *.env*
* Run `php artisan key:generate` to generate key
* Run `php artisan migrate` to install the database
* Run `php artisan serve` to start the app on http://localhost:8000/

## Installation with Docker-based

* Run `git clone https://github.com/Thanatad/laravel-api-cash-return.git`
* Run `cd laravel-api-cash-return`
* Installation docker then next step
* Run `docker-compose exec php sh`
* Run `composer install` or `php composer.phar install`
* Create `.env` in application root `cp .env.example .env`
* Add database `cashreturn` optional inform *.env*
* Run `php artisan key:generate` to generate key
* Run `php artisan migrate --seed` to install the database
* Run `exit` return
