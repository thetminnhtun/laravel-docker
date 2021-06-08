# Laravel Blog

A site that is blog for sample.

## Installation

- `docker-compose up -d --build`
- `docker-compose run --rm composer install`
- `cp .env.example .env`
- `docker-compose run --rm php artisan key:generate`
- Setup database
- `docker-compose run --rm php artisan migrate --seed`

## Testing

- `docker-compose run --rm php artisan test`
