FROM php:8.1-cli-alpine

RUN apk --no-cache add \
    postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /srv/www

COPY ./src/ ./