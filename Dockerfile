FROM php:7.2-apache

ENV APP_ENV prod
ARG APP_SECRET
ARG DATABASE_URL
ARG MAILER_URL
ARG SITE_NAME
ARG SHORT_NAME
ARG REUNION_YEAR
ARG FROM_ADDR
ARG RECIPIENT_ADDR
ARG AWS_KEY
ARG AWS_SECRET_KEY
ARG AWS_BUCKET_NAME
ARG AWS_BASE_URL
ARG AWS_REGION

RUN apt-get update -y && \
    apt-get install -y \
    zip \
    unzip \
    git \
    vim \
    mysql-client \
    zlib1g-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure \
    gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install \
    pdo_mysql \
    mysqli \
    zip \
    gd \
    opcache \
    intl && \
    pecl install apcu && \
    echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

RUN echo "SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH" >> /etc/apache2/conf-available/ssl-params.conf && \
    echo "SSLProtocol All -SSLv2 -SSLv3" >> /etc/apache2/conf-available/ssl-params.conf && \
    echo "SSLHonorCipherOrder On" >> /etc/apache2/conf-available/ssl-params.conf

RUN a2enmod -q rewrite && \
    a2enmod -q expires && \
    a2enmod -q ssl && \
    a2enmod -q headers && \
    a2enconf -q ssl-params

RUN php -r "copy('https://getcomposer.org/installer', '/root/composer-setup.php');" && \
    php /root/composer-setup.php --install-dir=/usr/local/bin  --filename=composer && \
    php -r "unlink('/root/composer-setup.php');"

RUN mkdir /var/www/.composer/ && chown -R www-data:www-data /var/www/

WORKDIR /var/www/html

ADD --chown=www-data:www-data . /var/www/html

ADD ./apache/apache2.conf /etc/apache2/apache2.conf
ADD ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD ./apache/reunion.php.ini /usr/local/etc/php/conf.d/reunion.php.ini

RUN ln -sfT /dev/stdout "/var/log/apache2/php.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/error.log" && \
    ln -sfT /dev/stdout "/var/log/apache2/access.log"

RUN openssl genrsa -out /etc/ssl/reunion.local.key 3072 && \
    openssl req -new -out /etc/ssl/reunion.local.csr -sha256 -key /etc/ssl/reunion.local.key -subj "/C=US/ST=Minnesota/L=Minneapolis/O=Reunion/CN=reunion.local" && \
    openssl x509 -req -in /etc/ssl/reunion.local.csr -days 365 -signkey /etc/ssl/reunion.local.key -out /etc/ssl/reunion.local.crt && \
    rm /etc/ssl/reunion.local.csr

RUN chown -R www-data:www-data "/var/log/apache2/" && \
    chown www-data:www-data "/etc/ssl/reunion.local.crt" && \
    chown www-data:www-data "/etc/ssl/reunion.local.key"

USER www-data:www-data

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --apcu-autoloader

CMD ["bash", "/var/www/html/startup.sh"]