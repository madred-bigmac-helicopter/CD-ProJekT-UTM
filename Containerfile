FROM composer:2.2.6 as build

COPY . /app
RUN composer install


FROM php:8.1.3-apache

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
EXPOSE 80
WORKDIR /app
COPY --from=build /app /app
COPY devops/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN sed -i 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini \
     && sed -i 's/;extension=pdo_sqlite/extension=pdo_sqlite/' /usr/local/etc/php/php.ini \
     && sed -i 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini \
     && sed -i 's/;extension=pdo_sqlite/extension=pgsql.so/' /usr/local/etc/php/php.ini
# Uncomment when deploying to prod
# RUN sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
RUN php artisan key:generate
RUN php artisan migrate
RUN chown -R www-data:www-data /app \
    && a2enmod rewrite