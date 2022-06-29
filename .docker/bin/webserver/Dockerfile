FROM php:7.4-apache

RUN apt-get -y update && apt-get upgrade -y

# Install tools && libraries
RUN apt-get -y install --fix-missing apt-utils iputils-ping nano wget dialog \
    build-essential git curl libzip-dev libmcrypt-dev libcurl3-dev zip libc-client2007e-dev \
    libmcrypt-dev libsqlite3-dev libsqlite3-0  libonig-dev \
    zlib1g-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    libkrb5-dev npm nodejs \
    && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

RUN pecl install mcrypt-1.0.3

# PHP5 Extensions
RUN docker-php-ext-enable mcrypt \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install json \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install mbstring

COPY apache2.conf /etc/apache2/apache2.conf

WORKDIR "/home/samu/public_html"

RUN echo 'alias pf="clear && vendor/bin/phpunit --stop-on-failure --filter="' >> ~/.bashrc

RUN a2enmod rewrite headers proxy proxy_http
EXPOSE 80
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
