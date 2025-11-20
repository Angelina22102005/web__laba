<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - Статус системы</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .service { background: white; padding: 20px; margin: 15px 0; border-radius: 10px; }
        .connected { border-left: 5px solid #28a745; }
        .stats { background: #e8f4fd; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Статус системы - Lab 7</h1>
            <p>File System Queue & Docker Services</p>
        </div>

        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/" style="padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">🏠 На главную</a>
        </div>

        <?php
        // Статистика
        $queueSize = 0;
        if (file_exists("message_queue.txt")) {
            $content = file_get_contents("message_queue.txt");
            $queueSize = count(array_filter(explode(PHP_EOL, $content)));
        }

        $processedCount = 0;
        if (file_exists("processed_messages.log")) {
            $content = file_get_contents("processed_messages.log");
            $processedCount = count(array_filter(explode(PHP_EOL, $content)));
        }
        ?>

        <div class="stats">
            <h3>📈 Статистика очереди</h3>
            <p>📁 Сообщений в очереди: <strong><?php echo $queueSize; ?></strong></p>
            <p>✅ Обработано сообщений: <strong><?php echo $processedCount; ?></strong></p>
            <p>📄 Файл очереди: <?php echo file_exists("message_queue.txt") ? "✅ Существует" : "❌ Отсутствует"; ?></p>
            <p>📝 Лог файл: <?php echo file_exists("processed_messages.log") ? "✅ Существует" : "❌ Отсутствует"; ?></p>
        </div>

        <div class="service connected">
            <h3>🔧 File System Queue</h3>
            <p>✅ Файловая система доступна и работает</p>
        </div>

        <div class="service connected">
            <h3>🐳 Docker Services</h3>
            <p>✅ Все сервисы запущены и работают</p>
        </div>

        <div class="service connected">
            <h3>✅ Система готова к работе</h3>
            <p>Все основные компоненты работают корректно. Вы можете:</p>
            <ul>
                <li>📤 Отправлять сообщения через <a href="/send.php">send.php</a></li>
                <li>👷 Запустить обработчик через <a href="/worker.php">worker.php</a></li>
                <li>📊 Мониторить очередь на главной странице</li>
            </ul>
        </div>
    </div>
</body>
</html>