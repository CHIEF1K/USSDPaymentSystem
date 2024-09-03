FROM php:8.1-fpm

LABEL authors="Quayson"

WORKDIR /var/app/

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

COPY . /var/app/

RUN composer install


CMD ["php" , "artisan" , "serve" , "--host=0.0.0.0" ,"--port=9000"]
