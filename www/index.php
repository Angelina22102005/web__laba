<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - File System Queue</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .header { background: #2c3e50; color: white; padding: 30px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .stats { display: flex; gap: 20px; margin: 20px 0; }
        .stat { flex: 1; background: #e8f4fd; padding: 20px; border-radius: 8px; text-align: center; }
        .stat-number { font-size: 2em; font-weight: bold; color: #2c3e50; }
        .nav-links { display: flex; gap: 15px; margin: 20px 0; }
        .nav-links a { padding: 12px 25px; background: #3498db; color: white; text-decoration: none; border-radius: 25px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📨 Лабораторная работа №7</h1>
            <p>File System Queue - Асинхронная обработка</p>
            <p><strong>👩‍🎓 Студент:</strong> Любанская Ангелина Валерьевна | <strong>🎯 Группа:</strong> 3МО-1</p>
        </div>

        <?php
        // Простая статистика
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
            <div class="stat">
                <div class="stat-number"><?php echo $queueSize; ?></div>
                <div>Сообщений в очереди</div>
            </div>
            <div class="stat">
                <div class="stat-number"><?php echo $processedCount; ?></div>
                <div>Обработано сообщений</div>
            </div>
        </div>

        <div class="nav-links">
            <a href="/send.php">📤 Отправить сообщение</a>
            <a href="/worker.php" target="_blank">👷 Запустить Worker</a>
            <a href="/status.php">📊 Статус системы</a>
        </div>

        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
            <h3>🎯 Как работает система:</h3>
            <ol>
                <li>📤 Отправьте сообщение через форму</li>
                <li>📁 Сообщение сохраняется в файл очереди</li>
                <li>👷 Worker читает сообщения из файла</li>
                <li>✅ Сообщения обрабатываются и сохраняются в лог</li>
            </ol>
        </div>

        <div style="background: #e8f4fd; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <h3>📝 Последние обработанные сообщения:</h3>
            <pre style="background: #2d3436; color: white; padding: 15px; border-radius: 5px; max-height: 200px; overflow-y: auto;">
<?php
if (file_exists("processed_messages.log")) {
    $logContent = file_get_contents("processed_messages.log");
    $lines = array_slice(array_filter(explode(PHP_EOL, $logContent)), -10);
    foreach (array_reverse($lines) as $line) {
        echo htmlspecialchars($line) . "\n";
    }
} else {
    echo "Лог файл пока пуст";
}
?>
            </pre>
        </div>
    </div>
</body>
</html>