<?php
require '"'"'vendor/autoload.php'"'"';

use App\RedisExample;
use App\ElasticExample;
use App\ClickhouseExample;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 6 - NoSQL Databases</title>
    <style>
        body { 
            font-family: '"'"'Segoe UI'"'"', Arial, sans-serif; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .header { 
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white; 
            padding: 30px; 
            border-radius: 15px; 
            margin-bottom: 25px;
            text-align: center;
        }
        .db-section { 
            background: #f8f9fa; 
            padding: 20px; 
            border-radius: 10px; 
            margin: 15px 0;
            border-left: 5px solid #3498db;
        }
        .redis { border-left-color: #d63031; }
        .elastic { border-left-color: #00b894; }
        .clickhouse { border-left-color: #0984e3; }
        pre {
            background: #2d3436;
            color: #dfe6e9;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .nav-links a {
            padding: 12px 25px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s;
            font-weight: bold;
        }
        .nav-links a:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class='"'"'container'"'"'>
        <div class='"'"'header'"'"'>
            <h1>🚀 Лабораторная работа №6</h1>
            <h2>NoSQL Databases: Redis, Elasticsearch, ClickHouse</h2>
            <p><strong>👩‍🎓 Студент:</strong> Любанская Ангелина Валерьевна | <strong>🎯 Группа:</strong> 3МО-1</p>
        </div>

        <div class='"'"'nav-links'"'"'>
            <a href='"'"'/index.php'"'"'>🏠 Главная Lab6</a>
            <a href='"'"'/hackathon-form.php'"'"'>📝 Регистрация на хакатон</a>
            <a href='"'"'/view.php'"'"'>👥 Все участники</a>
        </div>

        <?php
        // Redis Demo
        echo "<div class='"'"'db-section redis'"'"'>";
        echo "<h3>🔴 Redis Demo - Key/Value Store</h3>";
        try {
            $redis = new RedisExample();
            
            // Set some values
            echo "<h4>Setting values:</h4>";
            echo "<pre>";
            echo $redis->setValue('"'"'movie:title'"'"', '"'"'Inception'"'"');
            echo $redis->setValue('"'"'movie:year'"'"', '"'"'2010'"'"');
            echo $redis->setValue('"'"'movie:director'"'"', '"'"'Christopher Nolan'"'"');
            echo "</pre>";
            
            // Get values
            echo "<h4>Getting values:</h4>";
            echo "<pre>";
            echo "Title: " . $redis->getValue('"'"'movie:title'"'"');
            echo "Year: " . $redis->getValue('"'"'movie:year'"'"'); 
            echo "Director: " . $redis->getValue('"'"'movie:director'"'"');
            echo "</pre>";
            
        } catch (Exception $e) {
            echo "<p style='"'"'color: red;'"'"'>Redis Error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";

        // Elasticsearch Demo
        echo "<div class='"'"'db-section elastic'"'"'>";
        echo "<h3>🔍 Elasticsearch Demo - Movie Catalog</h3>";
        try {
            $elastic = new ElasticExample();
            
            // Check connection
            echo "<h4>Connection check:</h4>";
            echo "<pre>";
            echo $elastic->checkConnection();
            echo "</pre>";
            
            // Create movies index
            echo "<h4>Creating movies index:</h4>";
            echo "<pre>";
            echo $elastic->createIndex('"'"'movies'"'"');
            echo "</pre>";
            
            // Index some movies
            echo "<h4>Indexing movies:</h4>";
            echo "<pre>";
            $movies = [
                ['"'"'id'"'"' => 1, '"'"'title'"'"' => '"'"'Inception'"'"', '"'"'year'"'"' => 2010, '"'"'genre'"'"' => '"'"'Sci-Fi'"'"', '"'"'rating'"'"' => 8.8],
                ['"'"'id'"'"' => 2, '"'"'title'"'"' => '"'"'The Shawshank Redemption'"'"', '"'"'year'"'"' => 1994, '"'"'genre'"'"' => '"'"'Drama'"'"', '"'"'rating'"'"' => 9.3],
                ['"'"'id'"'"' => 3, '"'"'title'"'"' => '"'"'The Dark Knight'"'"', '"'"'year'"'"' => 2008, '"'"'genre'"'"' => '"'"'Action'"'"', '"'"'rating'"'"' => 9.0],
            ];
            
            foreach ($movies as $movie) {
                echo $elastic->indexDocument('"'"'movies'"'"', $movie['"'"'id'"'"'], $movie);
            }
            echo "</pre>";
            
            // Search for movies
            echo "<h4>Searching for Sci-Fi movies:</h4>";
            echo "<pre>";
            echo $elastic->search('"'"'movies'"'"', ['"'"'match'"'"' => ['"'"'genre'"'"' => '"'"'Sci-Fi'"'"']]);
            echo "</pre>";
            
        } catch (Exception $e) {
            echo "<p style='"'"'color: red;'"'"'>Elasticsearch Error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";

        // ClickHouse Demo
        echo "<div class='"'"'db-section clickhouse'"'"'>";
        echo "<h3>⚡️ ClickHouse Demo - Movie Analytics</h3>";
        try {
            $clickhouse = new ClickhouseExample();
            
            // Create table
            echo "<h4>Creating movies table:</h4>";
            echo "<pre>";
            echo $clickhouse->createTable();
            echo "</pre>";
            
            // Insert movies
            echo "<h4>Inserting movies:</h4>";
            echo "<pre>";
            $movies = [
                [1, '"'"'Inception'"'"', 2010, '"'"'Sci-Fi'"'"', 8.8],
                [2, '"'"'The Shawshank Redemption'"'"', 1994, '"'"'Drama'"'"', 9.3],
                [3, '"'"'The Dark Knight'"'"', 2008, '"'"'Action'"'"', 9.0],
                [4, '"'"'Pulp Fiction'"'"', 1994, '"'"'Crime'"'"', 8.9],
                [5, '"'"'Forrest Gump'"'"', 1994, '"'"'Drama'"'"', 8.8],
            ];
            
            foreach ($movies as $movie) {
                echo $clickhouse->insertMovie($movie[0], $movie[1], $movie[2], $movie[3], $movie[4]);
            }
            echo "</pre>";
            
            // Get movies
            echo "<h4>All movies:</h4>";
            echo "<pre>";
            echo $clickhouse->getMovies();
            echo "</pre>";
            
            // Get stats
            echo "<h4>Movie statistics:</h4>";
            echo "<pre>";
            echo $clickhouse->getStats();
            echo "</pre>";
            
        } catch (Exception $e) {
            echo "<p style='"'"'color: red;'"'"'>ClickHouse Error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";
        ?>
    </div>
</body>
</html>
