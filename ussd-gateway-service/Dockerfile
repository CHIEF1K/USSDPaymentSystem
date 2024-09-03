FROM php:8.3.10-fpm

WORKDIR /var/www/

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql


COPY . /var/www/


RUN composer install

#RUN php artisan key:generate

EXPOSE 5000

CMD ["php" , "artisan" , "serve" , "--host=0.0.0.0" ,"--port=5000"]
