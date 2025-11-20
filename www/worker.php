<?php
echo "<pre>";
echo "🔮 Lab 7 - File System Queue Worker\n";
echo "===================================\n";
echo "👷 Worker запущен и мониторит файловую очередь...\n";
echo "📁 Файл очереди: message_queue.txt\n";
echo "📝 Лог файл: processed_messages.log\n";
echo "⏰ Время запуска: " . date("Y-m-d H:i:s") . "\n";
echo "🔍 Проверка каждые 2 секунды...\n";
echo "===================================\n";

while (true) {
    if (file_exists("message_queue.txt") && filesize("message_queue.txt") > 0) {
        $content = file_get_contents("message_queue.txt");
        $lines = explode(PHP_EOL, trim($content));
        
        foreach ($lines as $line) {
            if (!empty(trim($line))) {
                $message = json_decode($line, true);
                if ($message) {
                    $timestamp = date("Y-m-d H:i:s");
                    echo "[$timestamp] 📥 Получено сообщение: " . json_encode($message, JSON_UNESCAPED_UNICODE) . "\n";
                    
                    // Имитация обработки (2 секунды)
                    echo "⏳ Обрабатываю...\n";
                    sleep(2);
                    
                    // Сохраняем в лог
                    $logEntry = "[$timestamp] ✅ Обработано: {$message["name"]} - {$message["message"]}\n";
                    file_put_contents("processed_messages.log", $logEntry, FILE_APPEND);
                    
                    echo "✅ Обработано: {$message["name"]} - {$message["message"]}\n";
                    echo "---\n";
                }
            }
        }
        
        // Очищаем файл очереди после обработки
        file_put_contents("message_queue.txt", "");
    }
    
    sleep(2);
}
?>