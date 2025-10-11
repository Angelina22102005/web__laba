<?php
session_start();
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Главная страница - Хакатон</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
        }
        .nav a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav a:hover {
            background-color: #e9ecef;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
            border: 1px solid #c3e6cb;
        }
        .session-data {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .data-item {
            margin: 10px 0;
            padding: 8px;
            background: white;
            border-radius: 4px;
        }
        .stats {
            background: #fff3cd;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background: #e0a800;
        }
        .welcome-message {
            text-align: center;
            padding: 30px;
            background: #e8f4f8;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='nav'>
            <a href='index.php'>Главная</a>
            <a href='phpinfo.php'>PHP Info</a>
            <a href='form.html'>Общая форма</a>
            <a href='hackathon-form.php'>Хакатон</a>
            <a href='view.php'>Все участники</a>
        </div>

        <h1>Система регистрации на хакатон</h1>

        <!-- Вывод сообщений -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class='success-message'>
                ✅ <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_GET['registration']) && $_GET['registration'] == 'success'): ?>
            <div class='success-message'>
                ✅ Регистрация успешно завершена! Данные сохранены в системе.
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['last_registration'])): ?>
            <div class='session-data'>
                <h2>Последняя регистрация:</h2>
                <?php
                $data = $_SESSION['last_registration'];
                $directionNames = [
                    'web-development' => 'Веб-разработка',
                    'mobile-development' => 'Мобильная разработка',
                    'ai-ml' => 'Искусственный интеллект и ML',
                    'blockchain' => 'Блокчейн технологии',
                    'iot' => 'Интернет вещей (IoT)',
                    'cybersecurity' => 'Кибербезопасность',
                    'data-science' => 'Data Science',
                    'game-dev' => 'Разработка игр'
                ];
                $roleNames = [
                    'backend' => 'Backend-разработчик',
                    'frontend' => 'Frontend-разработчик',
                    'fullstack' => 'Fullstack-разработчик',
                    'designer' => 'UI/UX дизайнер',
                    'data' => 'Data Scientist'
                ];
                ?>
                <div class='data-item'><strong>Имя:</strong> <?= htmlspecialchars($data['fullName']) ?></div>
                <div class='data-item'><strong>Возраст:</strong> <?= htmlspecialchars($data['age']) ?></div>
                <div class='data-item'><strong>Направление:</strong> <?= $directionNames[$data['direction']] ?? $data['direction'] ?></div>
                <div class='data-item'><strong>Роль:</strong> <?= $roleNames[$data['teamRole']] ?? $data['teamRole'] ?></div>
                <div class='data-item'><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></div>
                <div class='data-item'><strong>Опыт участия:</strong> <?= $data['previousExperience'] ?></div>
                <div class='data-item'><strong>Воркшопы:</strong> <?= $data['workshop'] ?></div>
                <div class='data-item'><strong>Ментор:</strong> <?= $data['mentoring'] ?></div>
                <div class='data-item'><strong>Рассылка:</strong> <?= $data['newsletter'] ?></div>
                <div class='data-item'><strong>Время регистрации:</strong> <?= $data['timestamp'] ?></div>
            </div>
        <?php else: ?>
            <div class='welcome-message'>
                <p>Добро пожаловать в систему регистрации на хакатон!</p>
                <p>Для участия заполните форму регистрации.</p>
            </div>
        <?php endif; ?>

        <div class='stats'>
            <?php
            $totalRegistrations = 0;
            if (file_exists('hackathon_registrations.txt')) {
                $lines = file('hackathon_registrations.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $totalRegistrations = count($lines);
            }
            ?>
            <h3>Статистика регистраций</h3>
            <p><strong>Всего зарегистрированных участников:</strong> <?= $totalRegistrations ?></p>
        </div>

        <div class='action-buttons'>
            <a href='hackathon-form.php' class='btn btn-primary'>Зарегистрироваться на хакатон</a>
            <a href='view.php' class='btn btn-secondary'>Посмотреть всех участников</a>
            
            <?php if (isset($_SESSION['last_registration'])): ?>
                <a href='clear-session.php' class='btn btn-warning' 
                   onclick="return confirm('Очистить данные текущей сессии?')">
                    Очистить сессию
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>