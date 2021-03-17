FROM php:7.4-fpm-alpine
WORKDIR /var/www
# Install extensions
RUN docker-php-ext-install pdo pdo_mysql


