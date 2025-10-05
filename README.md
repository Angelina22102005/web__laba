# Лабораторная работа № 1: Nginx + Docker
# 👩‍💻 Автор
ФИО: Любанская Ангелина Валерьевна
Группа: 3МО-3

# 📌 Описание задания
Создать веб-сервер в Docker с использованием Nginx и подключить HTML-страницу.
Результат доступен по адресу http://localhost:8080.

# ⚙️ Как запустить проект
Клонировать репозиторий:
git clone <https://github.com/Angelina22102005/web__laba.git>
cd nginx-lab
Запустить контейнеры:

docker-compose up -d -сборка
Открыть в браузере: http://localhost:8080 📂 Содержимое проекта

docker-compose.yml — описание сервиса Nginx

code/index.html — главная HTML-страница

screenshots/ — все скриншоты

# Скриншоты:

Этап 1
![stage1-docker-check](https://github.com/user-attachments/assets/e663dac5-cbd5-4691-9e0d-d9b02ee31fdd)

Этап 2
![stage2-nginx-welcome](https://github.com/user-attachments/assets/d2ece4d1-99a2-4ed7-a917-d060017181b0)

Этап 3
![stage3-custom-page png](https://github.com/user-attachments/assets/a8fcad63-c90f-41dc-a3dc-2e9bf21879a2)

Этап 4
<img width="1861" height="987" alt="stage4-experiment1-auto-update" src="https://github.com/user-attachments/assets/162a3148-2a9c-4a8c-bc01-82dc99ef683a" />

![stage4-experiment2-about-page](https://github.com/user-attachments/assets/fbc25a22-45bb-4dd1-86d7-a0c2258a7189)


![stage4-experiment3-port-9000](https://github.com/user-attachments/assets/83b98c92-8343-4503-a2e0-6d1598cdce94)


✅ Результат Сервер в Docker успешно запущен, Nginx отдаёт мою HTML-страницу.


# Лабораторная работа №2 — Nginx + PHP-FPM, HTML-формы и JavaScript

## 📁 Содержимое проекта

- **📄 docker-compose.yml** - конфигурация Docker Compose для nginx и php-fpm контейнеров
- **📁 nginx/** - папка с конфигурациями Nginx
  - **📄 default.conf** - конфигурационный файл Nginx для обработки PHP файлов через FastCGI
- **📁 www/** - корневая папка веб-сервера
  - **📄 index.php** - главная страница с базовой информацией и навигацией
  - **📄 phpinfo.php** - страница с выводом phpinfo() для проверки работы PHP
  - **📄 form.html** - базовая HTML форма для тестирования
  - **📄 hackathon-form.html** - основная форма регистрации на хакатон (вариант 7)
  - **📄 hackathon-form.js** - JavaScript файл с обработкой и валидацией формы
- **📁 screenshots/lab2/** - папка со скриншотами выполнения лабораторной работы

## 🚀 Быстрый старт (локально)

### Предварительные требования
- Установленный Docker (Docker Engine / Docker Desktop)

### Запуск проекта
Из корня проекта выполните:

\`\`\`bash
docker-compose up -d --build
\`\`\`

### Проверка работы
Откройте в браузере:

- **http://localhost:8080/index.php** - главная страница с PHP
- **http://localhost:8080/phpinfo.php** - информация о PHP
- **http://localhost:8080/hackathon-form.html** - форма регистрации на хакатон

### Полезные команды
\`\`\`bash
# Перезагрузка конфигурации nginx без остановки контейнеров
docker-compose exec nginx nginx -s reload

# Просмотр логов nginx
docker-compose logs nginx

# Остановка проекта
docker-compose down
\`\`\`
# Скриншоты:

Этап 3
![stage3-main-php](https://github.com/user-attachments/assets/64a59191-631b-4fd2-ba55-89a88c8cd8cc)

<img width="1860" height="990" alt="stage3-phpinfo" src="https://github.com/user-attachments/assets/b1f17859-1397-416a-8df8-7d0f5dcce7a5" />

Этап 4
![stage4-hackathon-form](https://github.com/user-attachments/assets/a91c9e16-d892-429c-8ab0-2ae8a277882d)
