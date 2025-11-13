<?php
require 'vendor/autoload.php';

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
            font-family: 'Segoe UI', Arial, sans-serif; 
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
    <div class='container'>
        <div class='header'>
            <h1>🚀 Лабораторная работа №6</h1>
            <h2>NoSQL Databases: Redis, Elasticsearch, ClickHouse</h2>
            <p><strong>👩‍🎓 Студент:</strong> Любанская Ангелина Валерьевна | <strong>🎯 Группа:</strong> 3МО-1</p>
        </div>

        <div class='nav-links'>
            <a href='/index.php'>🏠 Главная Lab6</a>
            <a href='/hackathon-form.php'>📝 Регистрация на хакатон</a>
            <a href='/view.php'>👥 Все участники</a>
            <a href='/lab6-report.php'>📊 Отчет Lab6</a>
            <a href='/final-test.php'>🧪 Тестирование</a>
        </div>

        <?php
        // Redis Demo
        echo "<div class='db-section redis'>";
        echo "<h3>🔴 Redis Demo - Key/Value Store</h3>";
        try {
            $redis = new RedisExample();
            
            // Set some values
            echo "<h4>Setting values:</h4>";
            echo "<pre>";
            echo $redis->setValue('movie:title', 'Inception');
            echo $redis->setValue('movie:year', '2010');
            echo $redis->setValue('movie:director', 'Christopher Nolan');
            echo "</pre>";
            
            // Get values
            echo "<h4>Getting values:</h4>";
            echo "<pre>";
            echo "Title: " . $redis->getValue('movie:title');
            echo "Year: " . $redis->getValue('movie:year'); 
            echo "Director: " . $redis->getValue('movie:director');
            echo "</pre>";
            
        } catch (Exception $e) {
            echo "<p style='color: red;'>Redis Error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";

        // Service Status
        echo "<div class='db-section'>";
        echo "<h3>🌐 Service Status</h3>";
        
        // Check Redis
        try {
            if (extension_loaded('redis')) {
                $redis = new Redis();
                if ($redis->connect('redis', 6379, 2)) {
                    echo "<p style='color: green;'>✅ Redis: Connected and working</p>";
                } else {
                    echo "<p style='color: red;'>❌ Redis: Connection failed</p>";
                }
            } else {
                echo "<p style='color: orange;'>⚠️ Redis extension not loaded</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ Redis Error: " . $e->getMessage() . "</p>";
        }
        
        // Check MySQL
        try {
            $pdo = new PDO('mysql:host=db;dbname=hackathon_db', 'hackathon_user', 'hackathon_pass');
            echo "<p style='color: green;'>✅ MySQL: Connected and working</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ MySQL Error: " . $e->getMessage() . "</p>";
        }
        
        echo "</div>";

        // PHP Info
        echo "<div class='db-section'>";
        echo "<h3>🐘 PHP Information</h3>";
        echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
        echo "<p><strong>Server Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
        
        // Check autoload
        try {
            require_once 'vendor/autoload.php';
            echo "<p style='color: green;'>✅ Composer autoload is working</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ Autoload error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";
        ?>
    </div>
</body>
</html>
