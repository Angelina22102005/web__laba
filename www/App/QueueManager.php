<?php

namespace App;

class QueueManager 
{
    private $queueFile = "message_queue.txt";
    private $processedFile = "processed_messages.log";

    public function publish($data) 
    {
        try {
            $message = [
                "id" => uniqid(),
                "timestamp" => date("Y-m-d H:i:s"),
                "data" => $data
            ];
            
            $queueEntry = json_encode($message, JSON_UNESCAPED_UNICODE) . PHP_EOL;
            file_put_contents($this->queueFile, $queueEntry, FILE_APPEND);
            
            return true;
        } catch (\Exception $e) {
            error_log("Queue publish error: " . $e->getMessage());
            return false;
        }
    }

    public function consume($callback) 
    {
        echo "🔮 File System Queue Worker Started\n";
        echo "📁 Reading from: {$this->queueFile}\n";
        
        while (true) {
            if (file_exists($this->queueFile) && filesize($this->queueFile) > 0) {
                $content = file_get_contents($this->queueFile);
                $lines = explode(PHP_EOL, trim($content));
                
                foreach ($lines as $line) {
                    if (!empty(trim($line))) {
                        $message = json_decode($line, true);
                        if ($message) {
                            echo "📥 Received message: " . json_encode($message["data"]) . "\n";
                            
                            // Вызываем callback для обработки
                            $callback($message["data"]);
                            
                            // Сохраняем в лог обработанных
                            $logEntry = "[" . date("Y-m-d H:i:s") . "] ✅ Processed: " . 
                                       $message["data"]["name"] . " - " . $message["data"]["message"] . PHP_EOL;
                            file_put_contents($this->processedFile, $logEntry, FILE_APPEND);
                            
                            echo "✅ Processed message ID: {$message["id"]}\n";
                        }
                    }
                }
                
                // Очищаем файл очереди после обработки
                file_put_contents($this->queueFile, "");
            }
            
            sleep(2); // Проверяем каждые 2 секунды
        }
    }

    public function testConnection()
    {
        return true; // Файловая система всегда доступна
    }

    public function getQueueStats()
    {
        $stats = [
            "queue_size" => 0,
            "processed_count" => 0,
            "queue_file_exists" => file_exists($this->queueFile),
            "processed_file_exists" => file_exists($this->processedFile)
        ];
        
        if ($stats["queue_file_exists"]) {
            $content = file_get_contents($this->queueFile);
            $stats["queue_size"] = count(array_filter(explode(PHP_EOL, $content)));
        }
        
        if ($stats["processed_file_exists"]) {
            $content = file_get_contents($this->processedFile);
            $stats["processed_count"] = count(array_filter(explode(PHP_EOL, $content)));
        }
        
        return $stats;
    }
}
