<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 4 - Composer + GitHub API</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .header { 
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white; 
            padding: 30px; 
            border-radius: 15px; 
            margin-bottom: 25px;
            text-align: center;
        }
        .info { 
            background: #f8f9fa; 
            padding: 20px; 
            border-radius: 10px; 
            margin: 15px 0;
            border-left: 5px solid #3498db;
        }
        .api-data { 
            background: #e8f4fd; 
            padding: 20px; 
            border-radius: 10px; 
            margin: 15px 0;
            border-left: 5px solid #2ecc71;
        }
        .user-info { 
            background: #fff3cd; 
            padding: 20px; 
            border-radius: 10px; 
            margin: 15px 0;
            border-left: 5px solid #ffc107;
        }
        .repo { 
            border: 1px solid #dee2e6; 
            padding: 15px; 
            margin: 10px 0; 
            border-radius: 8px;
            background: white;
            transition: transform 0.2s;
        }
        .repo:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .nav-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .nav-links a {
            padding: 12px 25px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s;
            font-weight: bold;
        }
        .nav-links a:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .tech-stack {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 10px 0;
        }
        .tech-tag {
            background: #e74c3c;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        .stars {
            color: #f39c12;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🚀 Лабораторная работа №4</h1>
            <h2>Composer + GitHub API + Пользовательские классы</h2>
            <p><strong>👩‍🎓 Студент:</strong> Любанская Ангелина Валерьевна | <strong>🎯 Группа:</strong> 3МО-1</p>
        </div>
        
        <div class='info'>
            <h3>✅ PHP успешно работает!</h3>
            <p><strong>📅 Текущая дата и время на сервере:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>🔄 Версия PHP:</strong> <?php echo phpversion(); ?></p>
            <p><strong>📦 Composer Autoload:</strong> ✔️ Активен</p>
        </div>

        <div class='nav-links'>
            <a href='/index.php'>🏠 Главная</a>
            <a href='/hackathon-form.php'>📝 Регистрация на хакатон</a>
            <a href='/view.php'>👥 Все участники</a>
            <a href='/test-userinfo.php'>🧪 Тест UserInfo</a>
            <a href='/test-api.php'>🧪 Тест API</a>
        </div>

        <!-- Данные из последней регистрации -->
        <div class='info'>
            <h3>📋 Данные из последней регистрации:</h3>
            <?php if(isset($_SESSION['form_data'])): ?>
                <p><strong>👤 Имя:</strong> <?= $_SESSION['form_data']['fullName'] ?></p>
                <p><strong>🎂 Возраст:</strong> <?= $_SESSION['form_data']['age'] ?> лет</p>
                <p><strong>📧 Email:</strong> <?= $_SESSION['form_data']['email'] ?></p>
                <p><strong>🎯 Направление:</strong> <?= $_SESSION['form_data']['direction'] ?></p>
                <p><strong>⚙️ Роль в команде:</strong> <?= $_SESSION['form_data']['teamRole'] ?></p>
                <p><strong>📅 Дата регистрации:</strong> <?= $_SESSION['form_data']['registration_date'] ?></p>
                <?php unset($_SESSION['form_data']); ?>
            <?php else: ?>
                <p>📭 Данных регистрации пока нет. <a href='hackathon-form.php'>Зарегистрируйтесь первым!</a></p>
            <?php endif; ?>
        </div>

        <!-- Данные из API -->
        <?php if(isset($_SESSION['api_data'])): ?>
        <div class='api-data'>
            <h3>🚀 Данные из внешних API:</h3>
            
            <?php if(isset($_SESSION['api_data']['error'])): ?>
                <p style="color: red;">❌ <?= $_SESSION['api_data']['error'] ?></p>
            <?php else: ?>
                <!-- Идея для хакатона -->
                <div class='info'>
                    <h4>💡 Случайная идея для хакатона:</h4>
                    <p><strong><?= $_SESSION['api_data']['hackathon_idea']['idea'] ?></strong></p>
                    <p><strong>🎯 Сложность:</strong> <?= str_repeat('⭐', $_SESSION['api_data']['hackathon_idea']['complexity']) ?></p>
                    <div class='tech-stack'>
                        <strong>🛠 Технологии:</strong>
                        <?php foreach($_SESSION['api_data']['hackathon_idea']['tech_stack'] as $tech): ?>
                            <span class='tech-tag'><?= $tech ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Репозитории GitHub -->
                <h4>📂 Популярные репозитории GitHub:</h4>
                <?php foreach($_SESSION['api_data']['github_repos'] as $repo): ?>
                    <?php if(!isset($repo['error'])): ?>
                    <div class='repo'>
                        <strong>📁 <?= htmlspecialchars($repo['name'] ?? 'Неизвестно') ?></strong>
                        <span class='stars'>⭐ <?= $repo['stargazers_count'] ?? 0 ?></span><br>
                        <em>🔗 <?= htmlspecialchars($repo['full_name'] ?? '') ?></em><br>
                        <?php if(isset($repo['description']) && $repo['description']): ?>
                            <p>📝 <?= htmlspecialchars($repo['description']) ?></p>
                        <?php endif; ?>
                        <small>🌐 <a href="<?= $repo['html_url'] ?? '#' ?>" target="_blank">Открыть на GitHub</a></small>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <!-- Курсы валют -->
                <div class='info'>
                    <h4>💰 Курсы валют (USD):</h4>
                    <?php foreach($_SESSION['api_data']['exchange_rates']['rates'] as $currency => $rate): ?>
                        <p><strong><?= $currency ?>:</strong> <?= number_format($rate, 2) ?></p>
                    <?php endforeach; ?>
                    <p><small>📅 Дата: <?= $_SESSION['api_data']['exchange_rates']['date'] ?></small></p>
                </div>
                
                <p><small>🕐 Обновлено API: <?= $_SESSION['api_data']['api_timestamp'] ?></small></p>
            <?php endif; ?>
            
            <?php unset($_SESSION['api_data']); ?>
        </div>
        <?php endif; ?>

        <!-- Информация о пользователе -->
        <div class='user-info'>
            <h3>👤 Информация о вашем устройстве:</h3>
            <?php
            require_once 'UserInfo.php';
            $userInfo = UserInfo::getBrowserInfo();
            ?>
            <p><strong>🌐 IP-адрес:</strong> <?= $userInfo['ip_address'] ?></p>
            <p><strong>🖥 Браузер:</strong> <?= $userInfo['browser'] ?></p>
            <p><strong>💻 Платформа:</strong> <?= $userInfo['os'] ?></p>
            <p><strong>📱 Мобильное:</strong> <?= $userInfo['is_mobile'] ? 'Да' : 'Нет' ?></p>
            <p><strong>⏰ Время запроса:</strong> <?= $userInfo['request_time'] ?></p>
            <p><strong>📊 Всего отправок форм:</strong> <?= UserInfo::getSubmissionCount() ?></p>
            <p><strong>🕐 Последняя регистрация:</strong> <?= UserInfo::getLastSubmission() ?></p>
        </div>

        <!-- Информация о сервере -->
        <div class='info'>
            <h4>🔧 Информация о сервере:</h4>
            <p><strong>🏠 Имя сервера:</strong> <?= $_SERVER['SERVER_NAME'] ?></p>
            <p><strong>🔌 Порт:</strong> <?= $_SERVER['SERVER_PORT'] ?></p>
            <p><strong>⚙️ Software:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?></p>
        </div>
    </div>
</body>
</html>