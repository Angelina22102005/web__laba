<?php session_start(); ?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Все регистрации на хакатон</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .registration {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .registration h3 {
            color: #2c3e50;
            margin-top: 0;
        }
        .nav-links {
            margin: 20px 0;
        }
        .nav-links a {
            color: #3498db;
            text-decoration: none;
            margin-right: 15px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .empty-message {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class='header'>
        <h1>📊 Все зарегистрированные участники хакатона</h1>
        <p>Общий список всех регистраций</p>
    </div>

    <div class='nav-links'>
        <a href='index.php'>← На главную</a>
        <a href='hackathon-form.php'>➕ Новая регистрация</a>
    </div>

    <?php if(file_exists('registrations.txt') && filesize('registrations.txt') > 0): ?>
        <?php 
        $lines = file('registrations.txt', FILE_IGNORE_NEW_LINES);
        $totalRegistrations = count($lines);
        ?>
        
        <div style="background: #e8f4fc; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Всего зарегистрированных участников: <?= $totalRegistrations ?></strong>
        </div>

        <?php foreach(array_reverse($lines) as $index => $line): ?>
            <?php 
            $data = explode('|', $line);
            if(count($data) >= 10) {
                list($date, $name, $age, $direction, $role, $email, $exp, $workshop, $mentoring, $newsletter) = $data;
            ?>
            <div class='registration'>
                <h3>👤 <?= $name ?> (<?= $age ?> лет)</h3>
                <p><strong>📧 Email:</strong> <?= $email ?></p>
                <p><strong>🎯 Направление:</strong> <?= $direction ?></p>
                <p><strong>⚙️ Роль в команде:</strong> <?= $role ?></p>
                <p><strong>💼 Опыт участия:</strong> <?= $exp ?></p>
                <p><strong>📅 Дата регистрации:</strong> <?= $date ?></p>
                
                <div style="margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <strong>Дополнительные опции:</strong><br>
                    • Воркшопы: <?= $workshop ?><br>
                    • Менторство: <?= $mentoring ?><br>
                    • Рассылка: <?= $newsletter ?>
                </div>
            </div>
            <?php } ?>
        <?php endforeach; ?>
        
    <?php else: ?>
        <div class='empty-message'>
            <h3>📭 Зарегистрированных участников пока нет</h3>
            <p>Будьте первым участником хакатона!</p>
            <a href='hackathon-form.php' style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Зарегистрироваться</a>
        </div>
    <?php endif; ?>

</body>
</html>