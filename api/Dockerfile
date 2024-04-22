# Base image
FROM php:8.3-fpm

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip && \
    docker-php-ext-install zip pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/storage && \
    chmod -R 775 /var/www/html/storage

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]