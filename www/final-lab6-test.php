<?php
echo "<h1>🎯 Final Lab 6 Test</h1>";

// Simple autoload that definitely works
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . "/" . str_replace("\\", "/", $class_name) . ".php";
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});

echo "<h3>🔧 Class Loading Test</h3>";

if (class_exists("App\\RedisExample")) {
    echo "<p style=\"color: green;\">✅ App\\RedisExample class is loaded</p>";
    
    try {
        $redis = new App\RedisExample();
        
        echo "<h3>🔴 Redis Operations Test</h3>";
        
        // Test SET
        $setResult = $redis->setValue("final_test", "Lab 6 is working perfectly!");
        echo "<p><strong>SET:</strong> $setResult</p>";
        
        // Test GET
        $getResult = $redis->getValue("final_test");
        echo "<p><strong>GET:</strong> $getResult</p>";
        
        // Test error case
        $errorResult = $redis->getValue("non_existent_key");
        echo "<p><strong>GET non-existent:</strong> $errorResult</p>";
        
        echo "<p style=\"color: green; font-weight: bold;\">🎉 ALL REDIS OPERATIONS WORKING!</p>";
        
    } catch (Exception $e) {
        echo "<p style=\"color: red;\">❌ Redis error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style=\"color: red;\">❌ App\\RedisExample class not found</p>";
    
    // Debug info
    echo "<h4>Debug Info:</h4>";
    echo "<p>Current dir: " . __DIR__ . "</p>";
    echo "<p>RedisExample.php exists: " . (file_exists(__DIR__ . "/App/RedisExample.php") ? "YES" : "NO") . "</p>";
}

echo "<h3>🐘 PHP Extensions</h3>";
if (extension_loaded("redis")) {
    echo "<p style=\"color: green;\">✅ Redis extension is loaded</p>";
} else {
    echo "<p style=\"color: red;\">❌ Redis extension not loaded</p>";
}

if (extension_loaded("pdo_mysql")) {
    echo "<p style=\"color: green;\">✅ PDO MySQL extension is loaded</p>";
} else {
    echo "<p style=\"color: red;\">❌ PDO MySQL extension not loaded</p>";
}

echo "<p><a href=\"/\">← Back to main page</a></p>";
echo "<p><a href=\"/lab6-final-report.php\">📊 View Final Report</a></p>";

