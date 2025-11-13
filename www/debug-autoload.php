<?php
echo "<h1>🐛 Debug Autoload</h1>";

echo "<h3>📁 File Structure</h3>";
$base_dir = __DIR__ . "/";
echo "<p>Current dir: $base_dir</p>";

$vendor_dir = $base_dir . "vendor/";
echo "<p>Vendor dir: $vendor_dir</p>";
echo "<p>Autoload exists: " . (file_exists($vendor_dir . "autoload.php") ? "YES" : "NO") . "</p>";

$app_dir = $base_dir . "App/";
echo "<p>App dir: $app_dir</p>";
echo "<p>RedisExample exists: " . (file_exists($app_dir . "RedisExample.php") ? "YES" : "NO") . "</p>";

echo "<h3>🔧 Testing Autoload Manually</h3>";

// Test manual require
if (file_exists($vendor_dir . "autoload.php")) {
    require $vendor_dir . "autoload.php";
    echo "<p>✅ Autoload required</p>";
    
    // Test class manually
    $manual_file = $app_dir . "RedisExample.php";
    if (file_exists($manual_file)) {
        require $manual_file;
        echo "<p>✅ RedisExample.php required manually</p>";
        
        if (class_exists("App\\RedisExample")) {
            echo "<p style=\"color: green;\">✅ App\\RedisExample class exists after manual require</p>";
            
            try {
                $redis = new App\RedisExample();
                $result = $redis->setValue("debug_test", "Manual require works!");
                echo "<p style=\"color: green;\">✅ RedisExample works: $result</p>";
            } catch (Exception $e) {
                echo "<p style=\"color: red;\">❌ RedisExample error: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style=\"color: red;\">❌ App\\RedisExample class still not found</p>";
        }
    } else {
        echo "<p style=\"color: red;\">❌ RedisExample.php not found at: $manual_file</p>";
    }
} else {
    echo "<p style=\"color: red;\">❌ autoload.php not found</p>";
}

echo "<p><a href=\"/\">← Back to main</a></p>";

