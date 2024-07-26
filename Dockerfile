FROM php:8.2-apache-bullseye

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

COPY app/ /var/www/html/

RUN mkdir -p /var/www/html/public/img/uploads 

RUN composer install --no-scripts --no-autoloader

RUN composer dump-autoload --optimize

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY apache-site.conf /etc/apache2/sites-available/000-default.conf

COPY php.ini /usr/local/etc/php/

RUN chown -R www-data:www-data /var/www/html/public/img/uploads 

RUN chmod -R 755 /var/www/html/public/img/uploads

RUN service apache2 restart

EXPOSE 80