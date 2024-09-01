FROM php:8.2-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

# Install dependencies and PHP extensions
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk add --no-cache libzip-dev zip freetype-dev libjpeg-turbo-dev libpng-dev nodejs npm nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql opcache zip mysqli gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# PHP Configuration
RUN echo "file_uploads = On" >> /usr/local/etc/php/php.ini \
    && echo "max_file_uploads = 20" >> /usr/local/etc/php/php.ini \
    && echo "upload_max_filesize = 128M" >> /usr/local/etc/php/php.ini \
    && echo "post_max_size = 128M" >> /usr/local/etc/php/php.ini \
    && echo "allow_url_fopen = On" >> /usr/local/etc/php/php.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/php.ini \
    && echo "max_input_time = 120" >> /usr/local/etc/php/php.ini \
    && echo "max_input_vars = 1000" >> /usr/local/etc/php/php.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/php.ini \
    && echo "request_terminate_timeout = 300" >> /usr/local/etc/php-fpm.d/www.conf

#COPY . /var/www/html
#RUN chmod -R 755 /var/www/html
