FROM php:7.2-apache

EXPOSE 8080/tcp
EXPOSE 8443/tcp

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
    sqlite3 \
    zlib1g-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmagickwand-dev \
    libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    php -r "copy('https://getcomposer.org/installer', '/root/composer-setup.php');" && \
    php /root/composer-setup.php --install-dir=/usr/local/bin  --filename=composer && \
    php -r "unlink('/root/composer-setup.php');" && \
    docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install \
    zip \
    gd \
    opcache \
    intl && \
    pecl install apcu && \
    echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    echo "SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH" >> /etc/apache2/conf-available/ssl-params.conf && \
    echo "SSLProtocol All -SSLv2 -SSLv3" >> /etc/apache2/conf-available/ssl-params.conf && \
    echo "SSLHonorCipherOrder On" >> /etc/apache2/conf-available/ssl-params.conf && \
    a2enmod -q rewrite && \
    a2enmod -q expires && \
    a2enmod -q ssl && \
    a2enmod -q headers && \
    a2enconf -q ssl-params && \
    ln -sfT /dev/stdout "/var/log/apache2/php.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/error.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/access.log" && \
    mkdir /var/www/.composer/ && chown -R www-data:www-data /var/www/

WORKDIR /var/www/html

ADD --chown=www-data:www-data . /var/www/html

ADD ./apache/apache2.conf /etc/apache2/apache2.conf
ADD ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD ./apache/reunion.php.ini /usr/local/etc/php/conf.d/reunion.php.ini
USER www-data:www-data

RUN ln -sf /var/www/data/images /var/www/html/public/images && \
    COMPOSER_MEMORY_LIMIT=-1 composer install --apcu-autoloader

CMD ["bash", "/var/www/html/bin/startup.sh"]