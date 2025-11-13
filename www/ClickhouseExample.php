<?php

namespace App;

use App\Helpers\ClientFactory;

class ClickhouseExample
{
    private $client;

    public function __construct()
    {
        $this->client = ClientFactory::make('http://clickhouse:8123/');
    }

    public function query($sql)
    {
        try {
            $response = $this->client->post('', [
                'body' => $sql,
                'headers' => [
                    'X-ClickHouse-Format' => 'JSON'
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return "ClickHouse Error: " . $e->getMessage();
        }
    }

    public function createTable()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS movies (
            id UInt32,
            title String,
            year UInt16,
            genre String,
            rating Float32,
            created_date DateTime DEFAULT now()
        ) ENGINE = MergeTree()
        ORDER BY (id, created_date)
        ";

        return $this->query($sql);
    }

    public function insertMovie($id, $title, $year, $genre, $rating)
    {
        $sql = "INSERT INTO movies (id, title, year, genre, rating) VALUES ($id, '$title', $year, '$genre', $rating)";
        return $this->query($sql);
    }

    public function getMovies()
    {
        $sql = "SELECT * FROM movies FORMAT JSON";
        return $this->query($sql);
    }

    public function getStats()
    {
        $sql = "
        SELECT 
            count() as total_movies,
            avg(rating) as avg_rating,
            min(year) as oldest_year,
            max(year) as newest_year
        FROM movies FORMAT JSON
        ";
        return $this->query($sql);
    }
}
