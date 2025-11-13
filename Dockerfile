FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Устанавливаем Composer вручную (без копирования)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Копируем composer.json и composer.lock сначала для кэширования
COPY www/composer.* ./

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Копируем остальные файлы
COPY www/ ./

CMD ["php-fpm"]
