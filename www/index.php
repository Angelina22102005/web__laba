<!DOCTYPE html>
<html>
<head>
    <title>Lab 6 - NoSQL Databases</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #2c3e50; color: white; padding: 30px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .service { background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 10px; border-left: 5px solid #3498db; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .redis-section { border-left-color: #d63031; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Lab 6 - NoSQL Databases</h1>
            <p>Redis + MySQL with Docker - WORKING VERSION</p>
        </div>

        <div class="service">
            <h3>📊 System Status</h3>
            <?php
            echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
            echo "<p><strong>Server Time:</strong> " . date("Y-m-d H:i:s") . "</p>";
            ?>
        </div>

        <div class="service redis-section">
            <h3>🔴 Redis Test with RedisExample Class</h3>
            <?php
            // Simple direct autoload for main page
            spl_autoload_register(function ($class_name) {
                $file = __DIR__ . "/" . str_replace("\\", "/", $class_name) . ".php";
                if (file_exists($file)) {
                    require $file;
                }
            });

            if (class_exists("App\\RedisExample")) {
                try {
                    $redis = new App\RedisExample();
                    
                    // Test operations
                    $setResult = $redis->setValue("homepage_test", "Hello from Lab 6 homepage!");
                    $getResult = $redis->getValue("homepage_test");
                    
                    echo "<p class=\"success\">✅ RedisExample class is working!</p>";
                    echo "<p><strong>SET operation:</strong> $setResult</p>";
                    echo "<p><strong>GET operation:</strong> $getResult</p>";
                    echo "<p class=\"success\">✅ Redis extension is loaded and working</p>";
                    
                } catch (Exception $e) {
                    echo "<p class=\"error\">❌ Redis error: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class=\"error\">❌ RedisExample class not available</p>";
            }
            ?>
        </div>

        <div class="service">
            <h3>🗄️ MySQL Test</h3>
            <?php
            try {
                $pdo = new PDO("mysql:host=db;dbname=hackathon_db", "hackathon_user", "hackathon_pass");
                echo "<p class=\"success\">✅ MySQL is working</p>";
                echo "<p><strong>Database:</strong> hackathon_db</p>";
                echo "<p><strong>User:</strong> hackathon_user</p>";
            } catch (Exception $e) {
                echo "<p class=\"error\">❌ MySQL error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="service">
            <h3>🔗 Useful Links</h3>
            <p><a href="http://localhost:8081" target="_blank">📊 Adminer (MySQL Admin)</a></p>
            <p><a href="/final-lab6-test.php">🎯 Final Lab 6 Test</a></p>
            <p><a href="/lab6-final-report.php">📋 Lab 6 Report</a></p>
            <p><a href="/debug-autoload.php">🐛 Debug Page</a></p>
            <p><strong>Redis Connection:</strong> localhost:6379</p>
            <p><strong>MySQL Connection:</strong> localhost:3307</p>
        </div>
    </div>
</body>
</html>
