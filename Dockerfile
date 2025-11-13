FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Устанавливаем Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем все файлы
COPY ./www ./

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]
