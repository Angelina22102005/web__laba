<?php
require "vendor/autoload.php";

echo "<h1>🧪 RedisExample Test</h1>";

// Проверяем что autoload работает
echo "<h3>🔧 Autoload Check</h3>";
if (class_exists("App\\RedisExample")) {
    echo "<p style=\"color: green;\">✅ App\\RedisExample class is loaded</p>";
} else {
    echo "<p style=\"color: red;\">❌ App\\RedisExample class not found</p>";
    
    // Показываем доступные классы
    echo "<h4>Available classes in App namespace:</h4>";
    $files = scandir(__DIR__ . "/App");
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === "php") {
            echo "<p>📄 $file</p>";
        }
    }
}

try {
    if (class_exists("App\\RedisExample")) {
        $redis = new App\RedisExample();
        
        echo "<h3>🔴 Testing Redis SET</h3>";
        $setResult = $redis->setValue("test_key", "Hello from RedisExample!");
        echo "<pre>$setResult</pre>";
        
        echo "<h3>🔴 Testing Redis GET</h3>";
        $getResult = $redis->getValue("test_key");
        echo "<pre>$getResult</pre>";
        
        echo "<p style=\"color: green;\">✅ RedisExample class is working!</p>";
    } else {
        echo "<p style=\"color: red;\">❌ RedisExample class not available</p>";
    }
    
} catch (Exception $e) {
    echo "<p style=\"color: red;\">❌ Error: " . $e->getMessage() . "</p>";
}

echo "<p><a href=\"/\">← Back to main page</a></p>";
