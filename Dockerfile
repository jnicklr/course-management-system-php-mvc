FROM php:8.2-apache-bullseye

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV NODE_VERSION=20.16.0

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

ENV NVM_DIR=/root/.nvm

RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}

ENV PATH="$NVM_DIR/versions/node/v${NODE_VERSION}/bin/:${PATH}"

RUN npm install -g npm

RUN a2enmod rewrite

COPY app/ /var/www/html/

RUN mkdir -p /var/www/html/public/img/uploads 

RUN composer install --no-scripts --no-autoloader
RUN composer dump-autoload --optimize

RUN npm install

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY apache-site.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/

RUN chown -R www-data:www-data /var/www/html/public/img/uploads 
RUN chmod -R 755 /var/www/html/public/img/uploads

RUN service apache2 restart

EXPOSE 80