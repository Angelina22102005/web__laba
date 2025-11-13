<?php
echo "<h1>🧪 Improved Autoload Test</h1>";

// Test if autoload file exists
if (file_exists("vendor/autoload.php")) {
    echo "<p style=\"color: green;\">✅ vendor/autoload.php exists</p>";
    
    // Include autoload
    require "vendor/autoload.php";
    echo "<p style=\"color: green;\">✅ Autoload included successfully</p>";
    
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
            
            // Debug: show available files
            if ($class === "App\\RedisExample") {
                $file = "App/RedisExample.php";
                if (file_exists($file)) {
                    echo "<p style=\"color: orange;\">📄 File exists: $file</p>";
                } else {
                    echo "<p style=\"color: red;\">📄 File missing: $file</p>";
                }
            }
        }
    }

    // Test RedisExample functionality
    if (class_exists("App\\RedisExample")) {
        try {
            $redis = new App\RedisExample();
            $result = $redis->setValue("autoload_test", "Autoload is working!");
            echo "<p style=\"color: green;\">✅ RedisExample works: $result</p>";
            
            // Test get value
            $getResult = $redis->getValue("autoload_test");
            echo "<p style=\"color: green;\">✅ Redis get works: $getResult</p>";
        } catch (Exception $e) {
            echo "<p style=\"color: red;\">❌ RedisExample error: " . $e->getMessage() . "</p>";
        }
    }
} else {
    echo "<p style=\"color: red;\">❌ vendor/autoload.php not found</p>";
}

echo "<p><a href=\"/test-redis.php\">→ Full Redis Test</a></p>";
echo "<p><a href=\"/\">→ Main Page</a></p>";

