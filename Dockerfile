FROM php:8.2-fpm-alpine

# PHP-MySQL Erweiterung installieren
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY app /var/www/html
EXPOSE 9000
