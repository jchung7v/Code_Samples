FROM php:7.3-apache

RUN apt-get update && apt-get install -y libsqlite3-dev
RUN docker-php-ext-install pdo pdo_sqlite
RUN a2enmod rewrite

COPY src /var/www/html/
EXPOSE 80/tcp
EXPOSE 443/tcp