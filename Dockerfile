FROM php:8.2-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Очищаем кэш
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем расширения PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring exif pcntl bcmath gd

# Создаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY ./www /var/www/html

# Меняем владельца файлов
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
