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
    }

    public function consume(callable \) 
    {
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
    }

    public function testConnection()
    {
        try {
            \ = ProducerConfig::getInstance();
            \->setMetadataBrokerList('kafka:9092');
            return true;
        } catch (\\Exception \) {
            return false;
        }
    }
}
