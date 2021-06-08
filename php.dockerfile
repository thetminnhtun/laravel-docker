FROM php:8-fpm-alpine

ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php/php.ini /usr/local/etc/php/conf.d/php.ini

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN chown laravel:laravel /var/www/html
