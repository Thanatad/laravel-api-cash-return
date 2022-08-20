A Docker-based LARAVEL 9 CASH RERURN APP for web api development using Docker Compose.

## What's Included

This setup comes with eight services out of the box.

* Nginx
* PHP
* MySQL
* PHPMyadmin
* Node.js
* Scheduler  - based on [mcuadros/ofelia](https://github.com/mcuadros/ofelia)
* Redis
* Memcached
* Mailhog

Software available within `php` service:

* Composer
* WP-CLI

## Installation

* Clone the repository to your local computer
* Copy `.env.sample` to `.env`
* Configure the setup (see **Configuration** section for a more detailed information)
* Run `docker-compose up -d` (see **Usage** section for a more detailed information)
* Add new entry in your OS host file

## Usage

Once the configuration is done, all of standard Docker Compose commands can be used for the project.

* To start all services in detached mode, run `docker-compose up -d`.
* To stop all services, run `docker-compose down`.
* To inspect all runing services, run `docker-compose ps`.
* You can also start/stop each services manually, by running `docker-compose start <service>` and `docker-compose stop <service>`.
* To run a specific command inside the service, use `docker-compose exec <service> <command>`. For example, to check the PHP version inside the `php` service, run `docker-compose exec php php -v`.
* If the service is not running (for example `nodejs`), use `docker-compose run --rm <service> <command>` instead. For example, to check the installed Node.js version in the `nodejs` service, run `docker-compose run --rm nodejs node -v`.

See [Overview of Docker Compose](https://docs.docker.com/compose/) for more information.
