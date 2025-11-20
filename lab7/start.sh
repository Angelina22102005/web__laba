#!/bin/bash
echo \"🔮 Запуск Lab 7 - Apache Kafka\"
echo \"===============================\"

# Проверяем что мы в правильной директории
if [ ! -f \"docker-compose.yml\" ]; then
    echo \"❌ Ошибка: docker-compose.yml не найден\"
    echo \"Запустите скрипт из директории lab7/\"
    exit 1
fi

echo \"🐳 Запускаем Docker контейнеры...\"
docker-compose up -d

echo \"⏳ Ожидаем запуск сервисов...\"
sleep 15

echo \"📦 Устанавливаем зависимости PHP...\"
docker-compose exec php composer install

echo \"✅ Готово!\"
echo \"🌐 Доступные URL:\"
echo \"   Главная страница: http://localhost:8080\"
echo \"   Отправка сообщений: http://localhost:8080/send.php\"
echo \"   Статус системы: http://localhost:8080/status.php\"
echo \"   Adminer (БД): http://localhost:8081\"
echo \"\"
echo \"👷 Для запуска воркера выполните:\"
echo \"   docker-compose exec php php worker.php\"
echo \"\" 
echo \"📊 Для проверки контейнеров:\"
echo \"   docker-compose ps\"
