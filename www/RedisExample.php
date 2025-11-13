<?php

namespace App;

use App\Helpers\ClientFactory;

class RedisExample
{
    private $client;

    public function __construct()
    {
        $this->client = ClientFactory::make('http://redis:6379/');
    }

    public function setValue($key, $value)
    {
        try {
            $response = $this->client->post('', [
                'form_params' => [
                    'command' => "SET $key \"$value\""
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Redis Error: " . $e->getMessage();
        }
    }

    public function getValue($key)
    {
        try {
            $response = $this->client->post('', [
                'form_params' => [
                    'command' => "GET $key"
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Redis Error: " . $e->getMessage();
        }
    }

    public function getAllKeys()
    {
        try {
            $response = $this->client->post('', [
                'form_params' => [
                    'command' => "KEYS *"
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Redis Error: " . $e->getMessage();
        }
    }
}
