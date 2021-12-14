FROM nginx:1.20-alpine

COPY ./docker/production/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /srv/www

COPY ./app/dist/Satushem ./
