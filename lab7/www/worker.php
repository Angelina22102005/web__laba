<?php
require 'vendor/autoload.php';
use App\QueueManager;

// Создаем лог файл если не существует
\ = 'processed_kafka.log';
if (!file_exists(\)) {
    file_put_contents(\, '');
}

echo \"<pre>\";
echo \"🔮 Lab 7 - Kafka Worker\\n\";
echo \"========================\\n\";
echo \"👷 Worker запущен и ожидает сообщения...\\n\";
echo \"📝 Лог файл: \\\n\";
echo \"⏰ Время запуска: \" . date('Y-m-d H:i:s') . \"\\n\";
echo \"========================\\n\";

\ = new QueueManager();

// Обработчик сообщений
\ = function(\) use (\) {
    \ = date('Y-m-d H:i:s');
    \ = \"[\] 📥 Получено сообщение: \" . json_encode(\, JSON_UNESCAPED_UNICODE) . \"\\n\";
    
    echo \;
    flush();
    
    // Имитация обработки
    sleep(2);
    
    // Сохраняем в лог
    \ = \"[\] ✅ Обработано: ID {\['id']} - {\['name']}\\n\";
    file_put_contents(\, \, FILE_APPEND);
    
    echo \"✅ Обработано сообщение ID: {\['id']}\\n\";
    flush();
};

try {
    \->consume(\);
} catch (Exception \) {
    echo \"❌ Ошибка: \" . \->getMessage() . \"\\n\";
    echo \"🔄 Перезапуск через 5 секунд...\\n\";
    sleep(5);
}
