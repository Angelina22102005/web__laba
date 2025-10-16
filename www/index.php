<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab 2 - PHP Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        .info { background: #ecf0f1; padding: 15px; border-radius: 5px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class='header'>
        <h1>Лабораторная работа №2</h1>
        <h2>Nginx + PHP-FPM + Docker</h2>
        <p><strong>Студент:</strong> Любанская Ангелина Валерьевна | <strong>Группа:</strong> 3МО-1</p>
    </div>
    
    <div class='info'>
        <h3>PHP успешно работает!</h3>
        <p>Текущая дата и время на сервере: <?php echo date('Y-m-d H:i:s'); ?></p>
        <p>Версия PHP: <?php echo phpversion(); ?></p>
    </div>

    <nav>
        <h3>Доступные страницы:</h3>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href='/index.php' style="padding: 8px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">🏠 Главная</a>
            <a href='/phpinfo.php' style="padding: 8px 15px; background: #9b59b6; color: white; text-decoration: none; border-radius: 5px;">ℹ️ PHP Info</a>
            <a href='/hackathon-form.php' style="padding: 8px 15px; background: #2ecc71; color: white; text-decoration: none; border-radius: 5px;">📝 Регистрация</a>
            <a href='/view.php' style="padding: 8px 15px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">👥 Все участники</a>
            <a href='/form.html' style="padding: 8px 15px; background: #f39c12; color: white; text-decoration: none; border-radius: 5px;">📋 Общая форма</a>
        </div>
    </nav>

    <div class='info'>
        <h3>📋 Данные из последней регистрации:</h3>
        <?php if(isset($_SESSION['form_data'])): ?>
            <p><strong>Имя:</strong> <?= $_SESSION['form_data']['fullName'] ?></p>
            <p><strong>Возраст:</strong> <?= $_SESSION['form_data']['age'] ?> лет</p>
            <p><strong>Email:</strong> <?= $_SESSION['form_data']['email'] ?></p>
            <p><strong>Направление:</strong> <?= $_SESSION['form_data']['direction'] ?></p>
            <p><strong>Роль в команде:</strong> <?= $_SESSION['form_data']['teamRole'] ?></p>
            <p><strong>Дата регистрации:</strong> <?= $_SESSION['form_data']['registration_date'] ?></p>
            
            <?php unset($_SESSION['form_data']); ?>
        <?php else: ?>
            <p>Данных регистрации пока нет. <a href='hackathon-form.php'>Зарегистрируйтесь первым!</a></p>
        <?php endif; ?>
    </div>

    <?php
    echo '<div class="info">';
    echo '<h4>Информация о сервере:</h4>';
    echo '<p>Имя сервера: ' . $_SERVER['SERVER_NAME'] . '</p>';
    echo '<p>Порт: ' . $_SERVER['SERVER_PORT'] . '</p>';
    echo '<p>Software: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
    echo '</div>';
    ?>
</body>
</html>