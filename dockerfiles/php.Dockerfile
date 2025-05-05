FROM php:8.2-fpm-alpine

WORKDIR /var/www/ecoApp

RUN docker-php-ext-install pdo pdo_mysql

ADD . /var/www/ecoApp/

RUN chown -R www-data:www-data /var/www/ecoApp