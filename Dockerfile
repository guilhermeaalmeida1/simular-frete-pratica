FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev

RUN docker-php-ext-install mbstring bcmath

RUN pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY . /var/www
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www