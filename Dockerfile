FROM php:7.4-apache
COPY php.ini /usr/local/etc/php/

RUN a2enmod rewrite
RUN a2enmod expires
RUN a2enmod headers

RUN apt-get update
RUN apt-get install -y zlib1g-dev libxml2-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng12.0 imagemagick
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install gd

# Install opcache
RUN docker-php-ext-install opcache