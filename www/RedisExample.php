<?php

namespace App;

class RedisExample
{
    private $redis;

    public function __construct()
    {
        // Проверяем доступно ли Redis расширение
        if (!extension_loaded('redis')) {
            throw new \Exception('Redis extension not loaded');
        }
        
        $this->redis = new \Redis();
        $this->redis->connect('redis', 6379, 5);
        $this->redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);
    }

    public function setValue($key, $value)
    {
        try {
            return $this->redis->set($key, $value) ? "OK: Set $key to $value" : "Error setting value";
        } catch (\Exception $e) {
            return "Redis Error: " . $e->getMessage();
        }
    }

    public function getValue($key)
    {
        try {
            $value = $this->redis->get($key);
            return $value !== false ? "Value for $key: $value" : "Key $key not found";
        } catch (\Exception $e) {
            return "Redis Error: " . $e->getMessage();
        }
    }
}
