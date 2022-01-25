FROM php:8.1-fpm-alpine

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /srv/www

RUN apk --no-cache add postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_mysql pdo_pgsql