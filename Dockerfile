FROM php:8.2-fpm-alpine
WORKDIR /var/www
EXPOSE 80
USER root

# Update Alpine and install necessary tools
RUN apk update && apk add --no-cache \
    git \
    curl \
    libzip-dev \
    zlib-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    freetype-dev

# Install PHP extensions
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
