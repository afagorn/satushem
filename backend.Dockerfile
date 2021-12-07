FROM php:7.4-fpm-alpine

WORKDIR /srv/www/backend

RUN docker-php-ext-install -j$(nproc) pdo  \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install mysqli