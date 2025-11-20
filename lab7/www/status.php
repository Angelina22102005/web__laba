<?php
require 'vendor/autoload.php';
use App\QueueManager;

// Проверяем соединения
\ = [
    'Kafka' => ['host' => 'kafka', 'port' => 9092],
    'Zookeeper' => ['host' => 'zookeeper', 'port' => 2181],
];

\ = [];
foreach (\ as \ => \) {
    \ = @fsockopen(\['host'], \['port'], \, \, 3);
    if (\) {
        \[\] = ['status' => 'connected', 'message' => '✅ Подключено'];
        fclose(\);
    } else {
        \[\] = ['status' => 'disconnected', 'message' => \"❌ Ошибка: \\"];
    }
}

// Проверяем Kafka через библиотеку
try {
    \ = new QueueManager();
    if (\->testConnection()) {
        \['Kafka Library'] = ['status' => 'connected', 'message' => '✅ Библиотека работает'];
    } else {
        \['Kafka Library'] = ['status' => 'disconnected', 'message' => '❌ Ошибка библиотеки'];
    }
} catch (Exception \) {
    \['Kafka Library'] = ['status' => 'error', 'message' => '❌ Исключение: ' . \->getMessage()];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - Статус системы</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .service { background: white; padding: 20px; margin: 15px 0; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .connected { border-left: 5px solid #28a745; }
        .disconnected { border-left: 5px solid #dc3545; }
        .error { border-left: 5px solid #ffc107; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>📊 Статус системы - Lab 7</h1>
            <p>Apache Kafka & Docker Services</p>
        </div>

        <div style='text-align: center; margin-bottom: 20px;'>
            <a href='/' style='padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;'>🏠 На главную</a>
        </div>

        <?php foreach (\ as \ => \): ?>
            <div class='service <?= \['status'] ?>'>
                <h3>🔧 <?= \ ?></h3>
                <p><?= \['message'] ?></p>
            </div>
        <?php endforeach; ?>

        <div class='service'>
            <h3>🐳 Docker Контейнеры</h3>
            <p>Запустите для проверки: <code>docker-compose ps</code></p>
            <p><strong>Ожидаемые сервисы:</strong></p>
            <ul>
                <li>lab7-nginx (порт 8080)</li>
                <li>lab7-php (PHP-FPM)</li>
                <li>lab7-kafka (порт 9092, 9093)</li>
                <li>lab7-zookeeper (порт 2181)</li>
                <li>lab7-adminer (порт 8081)</li>
            </ul>
        </div>
    </div>
</body>
</html>
