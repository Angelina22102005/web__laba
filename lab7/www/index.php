<?php
require 'vendor/autoload.php';
use App\QueueManager;

// Проверяем статус Kafka
\ = 'unknown';
try {
    \ = new QueueManager();
    \ = \->testConnection() ? 'connected' : 'disconnected';
} catch (Exception \) {
    \ = 'error';
}

// Читаем лог файл
\ = '';
\ = 'processed_kafka.log';
if (file_exists(\)) {
    \ = file_get_contents(\);
    \ = array_slice(array_filter(explode(\"\\n\", \)), -10); // Последние 10 строк
} else {
    \ = ['Лог файл пока пуст'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - Apache Kafka</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #2c3e50; color: white; padding: 30px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .status-connected { color: #28a745; font-weight: bold; }
        .status-disconnected { color: #dc3545; font-weight: bold; }
        .status-unknown { color: #ffc107; font-weight: bold; }
        .nav-links { display: flex; gap: 15px; margin: 20px 0; flex-wrap: wrap; }
        .nav-links a { padding: 12px 25px; background: #3498db; color: white; text-decoration: none; border-radius: 25px; transition: all 0.3s; }
        .nav-links a:hover { background: #2980b9; transform: translateY(-2px); }
        .log-container { background: #2d3436; color: #dfe6e9; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto; font-family: monospace; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🔮 Лабораторная работа №7</h1>
            <h2>Apache Kafka - Асинхронная обработка сообщений</h2>
            <p><strong>👩‍🎓 Студент:</strong> Любанская Ангелина Валерьевна | <strong>🎯 Группа:</strong> 3МО-1</p>
        </div>

        <div class='nav-links'>
            <a href='/send.php'>📤 Отправить сообщение</a>
            <a href='/worker.php' target='_blank'>👷 Запустить Worker</a>
            <a href='/status.php'>📊 Статус системы</a>
            <a href='http://localhost:8081' target='_blank'>🗄️ Adminer</a>
        </div>

        <div class='card'>
            <h3>📊 Статус системы</h3>
            <p><strong>Kafka:</strong> 
                <span class='status-<?= \ ?>'>
                    <?php 
                    switch(\) {
                        case 'connected': echo '✅ Подключен'; break;
                        case 'disconnected': echo '❌ Отключен'; break;
                        default: echo '⚠️ Неизвестно';
                    }
                    ?>
                </span>
            </p>
            <p><strong>PHP Version:</strong> <?= phpversion() ?></p>
            <p><strong>Server Time:</strong> <?= date('Y-m-d H:i:s') ?></p>
        </div>

        <div class='card'>
            <h3>📝 Последние обработанные сообщения</h3>
            <div class='log-container'>
                <?php foreach (array_reverse(\) as \): ?>
                    <?= htmlspecialchars(\) ?><br>
                <?php endforeach; ?>
            </div>
        </div>

        <div class='card'>
            <h3>🎯 Цели лабораторной работы</h3>
            <ul>
                <li>Изучение работы с очередями сообщений (Apache Kafka)</li>
                <li>Реализация producers (отправителей) и consumers (обработчиков)</li>
                <li>Настройка асинхронной обработки данных</li>
                <li>Интеграция Kafka с PHP через Docker</li>
            </ul>
        </div>

        <div class='card'>
            <h3>🔧 Используемые технологии</h3>
            <ul>
                <li>🐳 Docker & Docker Compose</li>
                <li>🔮 Apache Kafka</li>
                <li>🐘 PHP 8.2 с rdkafka extension</li>
                <li>🌐 Nginx + PHP-FPM</li>
                <li>📚 Kafka-PHP библиотека</li>
            </ul>
        </div>
    </div>
</body>
</html>
