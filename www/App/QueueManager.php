<?php

namespace App;

use Kafka\Producer;
use Kafka\ProducerConfig;
use Kafka\Consumer;
use Kafka\ConsumerConfig;

class QueueManager 
{
    private \ = 'lab7_topic';

    public function publish(\) 
    {
        try {
            \ = ProducerConfig::getInstance();
            \->setMetadataBrokerList('kafka:9092');

            \ = new Producer(function() use (\) {
                return [[
                    'topic' => \->topic,
                    'value' => json_encode(\),
                    'key' => '',
                ]];
            });

            \->send(true);
            return true;
        } catch (\\Exception \) {
            // Fallback: сохраняем в файл если Kafka недоступен
            \->saveToFile(\);
            return false;
        }
    }

    public function consume(callable \) 
    {
        try {
            \ = ConsumerConfig::getInstance();
            \->setMetadataBrokerList('kafka:9092');
            \->setGroupId('lab7_group');
            \->setTopics([\->topic]);
            \->setOffsetReset('earliest');

            \ = new Consumer();
            \->start(function(\, \, \) use (\) {
                if (isset(\['message']['value'])) {
                    \ = json_decode(\['message']['value'], true);
                    \(\);
                }
            });
        } catch (\\Exception \) {
            // Fallback: читаем из файла
            \->consumeFromFile(\);
        }
    }

    public function testConnection()
    {
        try {
            \ = @fsockopen('kafka', 9092, \, \, 3);
            if (\) {
                fclose(\);
                return true;
            }
            return false;
        } catch (\\Exception \) {
            return false;
        }
    }

    private function saveToFile(\)
    {
        \ = 'fallback_messages.log';
        \ = '[' . date('Y-m-d H:i:s') . '] FALLBACK: ' . json_encode(\) . PHP_EOL;
        file_put_contents(\, \, FILE_APPEND);
    }

    private function consumeFromFile(callable \)
    {
        \ = 'fallback_messages.log';
        if (file_exists(\)) {
            \ = file(\, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (\ as \) {
                if (preg_match('/FALLBACK: (.+)/', \, \)) {
                    \ = json_decode(\[1], true);
                    \(\);
                }
            }
            // Очищаем файл после обработки
            file_put_contents(\, '');
        }
    }
}
