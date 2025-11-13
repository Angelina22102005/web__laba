<?php
require "vendor/autoload.php";

echo "<h1>🧪 Simple Autoload Test</h1>";

// Test if classes exist
$classes = [
    "App\\RedisExample",
    "App\\Helpers\\ClientFactory"
];

foreach ($classes as $class) {
    if (class_exists($class)) {
        echo "<p style=\"color: green;\">✅ $class is loaded</p>";
    } else {
        echo "<p style=\"color: red;\">❌ $class not found</p>";
    }
}

// Test RedisExample functionality
if (class_exists("App\\RedisExample")) {
    try {
        $redis = new App\RedisExample();
        $result = $redis->setValue("autoload_test", "Autoload is working!");
        echo "<p style=\"color: green;\">✅ RedisExample works: $result</p>";
    } catch (Exception $e) {
        echo "<p style=\"color: red;\">❌ RedisExample error: " . $e->getMessage() . "</p>";
    }
}

echo "<p><a href=\"/test-redis.php\">→ Full Redis Test</a></p>";
echo "<p><a href=\"/\">→ Main Page</a></p>";

