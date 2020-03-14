# AMS - Project

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [composer](https://getcomposer.org/)
- [wamp](http://www.wampserver.com/en/) or [xampp](https://www.apachefriends.org/index.html)

## Installation

1. Clone [this repository](git@github.com:mashemaru/ams.git) to a location on your file system.
2. `cd` into the directoy.
3. Run `composer install`.
4. Run `npm install`.
5. Run `cp .env.example .env`.
6. Create and setup database, open .env file and fill in the details for DB settings
7. Run `php artisan key:generate`.
8. Run `php artisan storage:link`.
9. Run `php artisan serve` to start the server.
10. Navigate to `localhost:8000` in your browser.
