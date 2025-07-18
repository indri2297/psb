FROM php:8.2.28-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/