<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Database.php';
require_once 'HackathonRegistration.php';

$database = new Database();
$hackathonRegistration = new HackathonRegistration($database);

$allRegistrations = $hackathonRegistration->getAllRegistrations();
$directionStats = $hackathonRegistration->getDirectionStats();
$roleStats = $hackathonRegistration->getRoleStats();
$totalRegistrations = $hackathonRegistration->getTotalRegistrations();

$dbConnected = $database->isConnected();
$dbError = $database->getError();
?>
<!DOCTYPE html>
<html>
<head>
    <title>База данных регистраций - Lab 5</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid #3498db;
            text-align: center;
        }
        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            color: #7f8c8d;
            margin-top: 10px;
        }
        .registration-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .registration-table th,
        .registration-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .registration-table th {
            background: #34495e;
            color: white;
        }
        .registration-table tr:hover {
            background: #f5f5f5;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            font-weight: bold;
        }
        .badge-yes {
            background: #d4edda;
            color: #155724;
        }
        .badge-no {
            background: #f8d7da;
            color: #721c24;
        }
        .db-status {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .db-connected {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .db-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .nav-links a {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-links a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🗃️ База данных регистраций</h1>
            <p>Лабораторная работа №5 - MySQL + PHP + Docker</p>
            <p><strong>Студент:</strong> Любанская Ангелина Валерьевна | <strong>Группа:</strong> 3МО-1</p>
        </div>

        <div class="nav-links">
            <a href="index.php">🏠 Главная</a>
            <a href="hackathon-form.php">📝 Форма регистрации</a>
            <a href="test-database.php">🧪 Тест БД</a>
            <a href="http://localhost:8081" target="_blank">📊 Adminer</a>
        </div>

        <!-- Статус подключения к БД -->
        <div class="db-status <?= $dbConnected ? 'db-connected' : 'db-error' ?>">
            <?php if ($dbConnected): ?>
                ✅ Подключение к базе данных установлено успешно
            <?php else: ?>
                ❌ Ошибка подключения к базе данных: <?= $dbError ?>
            <?php endif; ?>
        </div>

        <!-- Статистика -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?= $totalRegistrations ?></div>
                <div class="stat-label">Всего регистраций</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($directionStats) ?></div>
                <div class="stat-label">Направлений</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($roleStats) ?></div>
                <div class="stat-label">Ролей в команде</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">MySQL 8.0</div>
                <div class="stat-label">Версия базы данных</div>
            </div>
        </div>

        <!-- Статистика по направлениям -->
        <?php if (!empty($directionStats)): ?>
        <div style="background: #e8f4fd; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3>📊 Статистика по направлениям:</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
                <?php foreach ($directionStats as $stat): ?>
                    <div style="background: white; padding: 10px; border-radius: 5px; border-left: 4px solid #3498db;">
                        <strong><?= htmlspecialchars($stat['direction']) ?></strong>
                        <span style="float: right; background: #3498db; color: white; padding: 2px 8px; border-radius: 10px;">
                            <?= $stat['count'] ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Таблица регистраций -->
        <h2>📋 Все регистрации (<?= count($allRegistrations) ?>):</h2>
        
        <?php if (empty($allRegistrations)): ?>
            <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 8px;">
                <h3>📭 Нет данных в базе</h3>
                <p>Зарегистрируйтесь первым через форму регистрации!</p>
                <a href="hackathon-form.php" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">
                    📝 Перейти к регистрации
                </a>
            </div>
        <?php else: ?>
            <table class="registration-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Возраст</th>
                        <th>Email</th>
                        <th>Направление</th>
                        <th>Роль</th>
                        <th>Опыт</th>
                        <th>Дата регистрации</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allRegistrations as $registration): ?>
                    <tr>
                        <td><?= $registration['id'] ?></td>
                        <td><strong><?= htmlspecialchars($registration['full_name']) ?></strong></td>
                        <td><?= $registration['age'] ?> лет</td>
                        <td><?= htmlspecialchars($registration['email']) ?></td>
                        <td>
                            <span style="background: #e3f2fd; padding: 4px 8px; border-radius: 4px;">
                                <?= htmlspecialchars($registration['direction']) ?>
                            </span>
                        </td>
                        <td>
                            <span style="background: #f3e5f5; padding: 4px 8px; border-radius: 4px;">
                                <?= htmlspecialchars($registration['team_role']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge <?= $registration['previous_experience'] ? 'badge-yes' : 'badge-no' ?>">
                                <?= $registration['previous_experience'] ? 'Да' : 'Нет' ?>
                            </span>
                        </td>
                        <td><?= date('d.m.Y H:i', strtotime($registration['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>