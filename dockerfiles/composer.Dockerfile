FROM composer:latest

WORKDIR /var/www/ecoApp

ENTRYPOINT ["composer", "--ignore-platform-reqs"]