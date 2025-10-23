<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Database.php';
require_once 'HackathonRegistration.php';

$database = new Database();
$hackathonRegistration = new HackathonRegistration($database);

$dbConnected = $database->isConnected();
$dbError = $database->getError();
$tableExists = $database->tableExists('hackathon_registrations');
$tableStructure = $database->getTableStructure('hackathon_registrations');

// Тестовые данные для проверки
$testData = [
    'full_name' => 'Тестовый Пользователь',
    'age' => 25,
    'email' => 'test@example.com',
    'direction' => 'web-development',
    'team_role' => 'frontend',
    'previous_experience' => true,
    'workshop' => false,
    'mentoring' => true,
    'newsletter' => true,
    'ip_address' => '127.0.0.1',
    'user_agent' => 'Test Browser'
];

$testResult = $hackathonRegistration->addRegistration($testData);
$allRegistrations = $hackathonRegistration->getAllRegistrations(5);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Тест базы данных - Lab 5</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .test-section { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 5px solid #3498db; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; }
        .warning { background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .nav-links { display: flex; gap: 15px; margin: 20px 0; flex-wrap: wrap; }
        .nav-links a { padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🧪 Тестирование базы данных</h1>
    
    <div class="nav-links">
        <a href="index.php">🏠 Главная</a>
        <a href="database-view.php">🗃️ Просмотр БД</a>
        <a href="hackathon-form.php">📝 Форма</a>
        <a href="http://localhost:8081" target="_blank">📊 Adminer</a>
    </div>

    <!-- Тест подключения -->
    <div class="test-section">
        <h2>🔌 Тест подключения к базе данных</h2>
        <?php if ($dbConnected): ?>
            <div class="success">✅ Успешное подключение к MySQL базе данных</div>
        <?php else: ?>
            <div class="error">❌ Ошибка подключения: <?= $dbError ?></div>
        <?php endif; ?>
    </div>

    <!-- Тест таблицы -->
    <div class="test-section">
        <h2>📊 Тест существования таблицы</h2>
        <?php if ($tableExists): ?>
            <div class="success">✅ Таблица 'hackathon_registrations' существует</div>
            <h3>Структура таблицы:</h3>
            <pre><?php print_r($tableStructure); ?></pre>
        <?php else: ?>
            <div class="error">❌ Таблица 'hackathon_registrations' не существует</div>
        <?php endif; ?>
    </div>

    <!-- Тест записи данных -->
    <div class="test-section">
        <h2>💾 Тест записи данных</h2>
        <?php if ($testResult['success']): ?>
            <div class="success">✅ Тестовые данные успешно сохранены (ID: <?= $testResult['id'] ?>)</div>
            <h3>Отправленные данные:</h3>
            <pre><?php print_r($testData); ?></pre>
        <?php else: ?>
            <div class="error">❌ Ошибка сохранения: <?= $testResult['error'] ?></div>
        <?php endif; ?>
    </div>

    <!-- Тест чтения данных -->
    <div class="test-section">
        <h2>📖 Тест чтения данных</h2>
        <?php if (!empty($allRegistrations)): ?>
            <div class="success">✅ Успешно получено <?= count($allRegistrations) ?> записей</div>
            <h3>Последние записи:</h3>
            <pre><?php print_r($allRegistrations); ?></pre>
        <?php else: ?>
            <div class="warning">⚠️ Нет данных для отображения</div>
        <?php endif; ?>
    </div>

    <!-- Информация о БД -->
    <div class="test-section">
        <h2>ℹ️ Информация о базе данных</h2>
        <ul>
            <li><strong>Хост:</strong> db</li>
            <li><strong>База данных:</strong> hackathon_db</li>
            <li><strong>Пользователь:</strong> hackathon_user</li>
            <li><strong>Порт MySQL:</strong> 3306 (внутри Docker), 3307 (локально)</li>
            <li><strong>Adminer:</strong> <a href="http://localhost:8081" target="_blank">http://localhost:8081</a></li>
        </ul>
    </div>

    <!-- Инструкции для Adminer -->
    <div class="test-section">
        <h2>📊 Доступ к Adminer</h2>
        <p>Для ручного управления базой данных используйте Adminer:</p>
        <ol>
            <li>Откройте <a href="http://localhost:8081" target="_blank">http://localhost:8081</a></li>
            <li>Система: <strong>MySQL</strong></li>
            <li>Сервер: <strong>db</strong></li>
            <li>Пользователь: <strong>hackathon_user</strong></li>
            <li>Пароль: <strong>hackathon_pass</strong></li>
            <li>База данных: <strong>hackathon_db</strong></li>
        </ol>
    </div>
</body>
</html>