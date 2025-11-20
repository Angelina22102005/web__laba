<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - Отправка в очередь</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #3498db; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .stats { background: #e8f4fd; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📨 Lab 7 - File System Queue</h1>
            <p>Отправка сообщений в файловую очередь</p>
        </div>

        <?php
        $messageSent = false;
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {
            try {
                $messageData = [
                    "name" => $_POST["name"] ?? "Без имени",
                    "email" => $_POST["email"] ?? "Нет email",
                    "message" => $_POST["message"] ?? "Тестовое сообщение",
                    "timestamp" => date("Y-m-d H:i:s")
                ];
                
                $queueEntry = json_encode($messageData, JSON_UNESCAPED_UNICODE) . PHP_EOL;
                file_put_contents("message_queue.txt", $queueEntry, FILE_APPEND);
                $messageSent = true;
                
            } catch (Exception $e) {
                $error = "Ошибка отправки: " . $e->getMessage();
            }
        }

        // Статистика
        $queueSize = 0;
        if (file_exists("message_queue.txt")) {
            $content = file_get_contents("message_queue.txt");
            $queueSize = count(array_filter(explode(PHP_EOL, $content)));
        }
        ?>

        <div class="stats">
            <h3>📊 Статистика очереди:</h3>
            <p>📁 Сообщений в очереди: <strong><?php echo $queueSize; ?></strong></p>
        </div>

        <?php if ($messageSent): ?>
            <div class="success">
                ✅ Сообщение успешно добавлено в очередь!
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error">
                ❌ <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>👤 Имя:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_POST["name"] ?? "Тестовый пользователь"); ?>" required>
            </div>

            <div class="form-group">
                <label>📧 Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($_POST["email"] ?? "test@example.com"); ?>" required>
            </div>

            <div class="form-group">
                <label>💬 Сообщение:</label>
                <textarea name="message" rows="4" required><?php echo htmlspecialchars($_POST["message"] ?? "Привет от Lab 7! Работаем через файловую систему!"); ?></textarea>
            </div>

            <button type="submit" name="send_message" value="1">📨 Отправить в очередь</button>
        </form>

        <div style="margin-top: 30px; padding: 15px; background: #e8f4fd; border-radius: 5px;">
            <h3>🔗 Полезные ссылки:</h3>
            <p><a href="/">🏠 Главная страница</a></p>
            <p><a href="/worker.php" target="_blank">👷 Запуск воркера</a></p>
        </div>
    </div>
</body>
</html>