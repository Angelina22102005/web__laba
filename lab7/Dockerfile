FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    librdkafka-dev \
    && docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем Kafka extension
RUN pecl install rdkafka && docker-php-ext-enable rdkafka

WORKDIR /var/www/html

CMD [\"php-fpm\"]
