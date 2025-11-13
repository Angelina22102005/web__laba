FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Устанавливаем Redis extension
RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www/html

# Просто копируем все файлы
COPY www/ ./

CMD ["php-fpm"]
