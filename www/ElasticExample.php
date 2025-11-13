<?php

namespace App;

use App\Helpers\ClientFactory;

class ElasticExample
{
    private $client;

    public function __construct()
    {
        $this->client = ClientFactory::make('http://elasticsearch:9200/');
    }

    public function checkConnection()
    {
        try {
            $response = $this->client->get('');
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Elasticsearch Connection Error: " . $e->getMessage();
        }
    }

    public function createIndex($index)
    {
        try {
            $response = $this->client->put($index);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Elasticsearch Index Creation Error: " . $e->getMessage();
        }
    }

    public function indexDocument($index, $id, $data)
    {
        try {
            $response = $this->client->put("$index/_doc/$id", [
                'json' => $data
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Elasticsearch Document Indexing Error: " . $e->getMessage();
        }
    }

    public function search($index, $query)
    {
        try {
            $response = $this->client->get("$index/_search", [
                'json' => ['query' => $query]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Elasticsearch Search Error: " . $e->getMessage();
        }
    }

    public function getAllDocuments($index)
    {
        try {
            $response = $this->client->get("$index/_search", [
                'json' => ['query' => ['match_all' => new \stdClass()]]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "Elasticsearch Get All Error: " . $e->getMessage();
        }
    }
}
