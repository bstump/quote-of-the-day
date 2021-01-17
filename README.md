## Quote of the Day
This is a web application that delivers random quotes as well as a quote of the day for your viewing and reading pleasure.

## Local Development Installation
- `npm i`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan db:seed` (this seeds quotes in the config file)
- `php artisan serve` (`http://localhost:8000`)
- `npm run watch` (for local front-end development)