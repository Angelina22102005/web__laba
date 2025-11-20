<?php
require 'vendor/autoload.php';
use App\QueueManager;

\ = false;
\Невозможно загрузить файл C:\Users\Home\AppData\Local\Programs\Microsoft VS Code\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1, так как выполнение сценариев отключено в этой системе. Для получения дополнительных сведений см. about_Execution_Policies по адресу https:/go.microsoft.com/fwlink/?LinkID=135170. = '';

if (\['send_message'] ?? false) {
    try {
        \ = new QueueManager();
        
        \ = [
            'id' => uniqid(),
            'name' => \['name'] ?? 'Без имени',
            'email' => \['email'] ?? 'Нет email',
            'message' => \['message'] ?? 'Тестовое сообщение',
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => 'user_message'
        ];
        
        \->publish(\);
        \ = true;
        
    } catch (Exception \) {
        \Невозможно загрузить файл C:\Users\Home\AppData\Local\Programs\Microsoft VS Code\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1, так как выполнение сценариев отключено в этой системе. Для получения дополнительных сведений см. about_Execution_Policies по адресу https:/go.microsoft.com/fwlink/?LinkID=135170. = 'Ошибка отправки: ' . \->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 7 - Отправка в Kafka</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f0f2f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #3498db; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🔮 Lab 7 - Apache Kafka</h1>
            <p>Отправка сообщений в очередь</p>
        </div>

        <?php if (\): ?>
            <div class='success'>
                ✅ Сообщение успешно отправлено в Kafka!
            </div>
        <?php endif; ?>

        <?php if (\Невозможно загрузить файл C:\Users\Home\AppData\Local\Programs\Microsoft VS Code\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1, так как выполнение сценариев отключено в этой системе. Для получения дополнительных сведений см. about_Execution_Policies по адресу https:/go.microsoft.com/fwlink/?LinkID=135170.): ?>
            <div class='error'>
                ❌ <?= \Невозможно загрузить файл C:\Users\Home\AppData\Local\Programs\Microsoft VS Code\resources\app\out\vs\workbench\contrib\terminal\common\scripts\shellIntegration.ps1, так как выполнение сценариев отключено в этой системе. Для получения дополнительных сведений см. about_Execution_Policies по адресу https:/go.microsoft.com/fwlink/?LinkID=135170. ?>
            </div>
        <?php endif; ?>

        <form method='POST'>
            <div class='form-group'>
                <label>👤 Имя:</label>
                <input type='text' name='name' value='<?= \['name'] ?? 'Тестовый пользователь' ?>' required>
            </div>

            <div class='form-group'>
                <label>📧 Email:</label>
                <input type='email' name='email' value='<?= \['email'] ?? 'test@example.com' ?>' required>
            </div>

            <div class='form-group'>
                <label>💬 Сообщение:</label>
                <textarea name='message' rows='4' required><?= \['message'] ?? 'Привет от Lab 7!' ?></textarea>
            </div>

            <button type='submit' name='send_message' value='1'>🚀 Отправить в Kafka</button>
        </form>

        <div style='margin-top: 30px; padding: 15px; background: #e8f4fd; border-radius: 5px;'>
            <h3>🔗 Полезные ссылки:</h3>
            <p><a href='/'>🏠 Главная страница</a></p>
            <p><a href='/worker.php'>👷 Запуск воркера</a></p>
            <p><a href='/status.php'>📊 Статус системы</a></p>
        </div>
    </div>
</body>
</html>
