FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    libpq-dev \
    && /usr/local/bin/docker-php-ext-install pgsql pdo_pgsql

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis