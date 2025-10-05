Лабораторная работа №1: Nginx + Docker
👩‍💻 Автор
ФИО: Любанская Ангелина Валерьевна
Группа: 3МО-1

📌 Описание задания
Создать веб-сервер в Docker с использованием Nginx и подключить HTML-страницу.
Результат доступен по адресу http://localhost:8080.

⚙️ Как запустить проект
Клонировать репозиторий:
git clone <https://github.com/Angelina22102005/web__laba.git>
cd nginx-lab
Запустить контейнеры:

docker-compose up -d --build
Открыть в браузере: http://localhost:8080 📂 Содержимое проекта

docker-compose.yml — описание сервиса Nginx

code/index.html — главная HTML-страница

screenshots/ — все скриншоты

Этап 1
![stage1-docker-check](https://github.com/user-attachments/assets/dc89007a-47e3-46ea-aa0f-ac3c3a75bdd8)

Этап 2
![stage2-nginx-welcome](https://github.com/user-attachments/assets/50dcbdaf-a79e-4570-84b8-2443f92f974a)

Этап 3
![stage3-custom-page png](https://github.com/user-attachments/assets/177b3967-ccc1-47bf-9162-18960e05bab1)

Этап 4
<img width="1861" height="987" alt="stage4-experiment1-auto-update" src="https://github.com/user-attachments/assets/ce8adbbc-2457-468a-b82c-419e5625198d" />

![stage4-experiment2-about-page](https://github.com/user-attachments/assets/1fd1d7b6-3675-4fad-8ac7-78b1ae7a431e)

![stage4-experiment3-port-9000](https://github.com/user-attachments/assets/0018d9af-4035-406d-9221-b7ce66c82ca2)
