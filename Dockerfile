FROM php:7.4-apache

EXPOSE 80/tcp

ENV APP_ENV prod
ARG APP_SECRET
ARG DATABASE_URL
ARG MAILER_URL
ARG SITE_NAME
ARG SHORT_NAME
ARG REUNION_YEAR
ARG FROM_ADDR
ARG RECIPIENT_ADDR

RUN apt-get update -y && \
    apt-get install -y \
    wget \
    zip \
    unzip \
    git \
    vim \
    zlib1g-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libzip-dev \
    libmagickwand-dev \
    libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', '/root/composer-setup.php');" && \
    php /root/composer-setup.php --install-dir=/usr/local/bin  --filename=composer && \
    php -r "unlink('/root/composer-setup.php');"

RUN docker-php-ext-configure gd \
    --with-jpeg \
    --with-freetype && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    gd \
    opcache \
    intl && \
    pecl install apcu && \
    echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini && \
    pecl install imagick && \
    docker-php-ext-enable imagick
    
RUN a2enmod -q rewrite && \
    a2enmod -q expires && \
    a2enmod -q headers && \
    ln -sfT /dev/stdout "/var/log/apache2/php.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/error.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/access.log" && \
    chown -R www-data:www-data "/var/log/apache2/"

RUN mkdir /var/www/.composer/ && chown -R www-data:www-data /var/www/

WORKDIR /var/www/html

ADD --chown=www-data:www-data . /var/www/html

ADD ./apache/apache2.conf /etc/apache2/apache2.conf
ADD ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD ./apache/reunion.php.ini /usr/local/etc/php/conf.d/reunion.php.ini

USER www-data:www-data

RUN mkdir -p /var/www/html/var/cache

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --apcu-autoloader

RUN php bin/console cache:clear && php bin/console cache:warmup

CMD ["bash", "/var/www/html/bin/startup.sh"]