FROM php:7.2-apache

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
    libpng-dev

RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure \
    gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2

RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    zip \
    gd \
    opcache \
    intl

RUN pecl install apcu && \
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

RUN composer install --apcu-autoloader

ADD ./apache/apache2.conf /etc/apache2/apache2.conf
ADD ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD ./apache/reunion.php.ini /usr/local/etc/php/conf.d/reunion.php.ini

RUN ln -sfT /dev/stdout "/var/log/apache2/php.log"
RUN ln -sfT /dev/stdout "/var/log/apache2/error.log"
RUN ln -sfT /dev/stdout "/var/log/apache2/access.log"

RUN openssl genrsa -out /etc/ssl/reunion.local.key 3072
RUN openssl req -new -out /etc/ssl/reunion.local.csr -sha256 -key /etc/ssl/reunion.local.key -subj "/C=US/ST=Minnesota/L=Minneapolis/O=Reunion/CN=reunion.local"
RUN openssl x509 -req -in /etc/ssl/reunion.local.csr -days 365 -signkey /etc/ssl/reunion.local.key -out /etc/ssl/reunion.local.crt
RUN rm /etc/ssl/reunion.local.csr

RUN chown www-data:www-data "/var/log/apache2/"
RUN chown www-data:www-data "/etc/ssl/reunion.local.crt"
RUN chown www-data:www-data "/etc/ssl/reunion.local.key"

CMD ["bash", "/var/www/html/startup.sh"]