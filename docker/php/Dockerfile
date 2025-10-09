FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y default-mysql-client zlib1g-dev libzip-dev unzip libicu-dev g++ \
  && docker-php-ext-install pdo_mysql zip intl \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www

