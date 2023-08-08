FROM php:8.1-fpm

ARG user=marco
ARG uid=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

RUN apt-get update -y \
    && apt-get install cron -y \
    && echo "0 19 * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" >> /etc/cron.d/scheduler \
    && chmod 644 /etc/cron.d/scheduler \
    && crontab /etc/cron.d/scheduler

USER $user
