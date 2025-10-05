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
        <ul>
            <li><a href='/index.php'>Главная (PHP)</a></li>
            <li><a href='/phpinfo.php'>phpinfo()</a></li>
            <li><a href='/form.html'>Форма регистрации</a></li>
        </ul>
    </nav>

    <?php
    echo '<div class=\"info\">';
    echo '<h4>Информация о сервере:</h4>';
    echo '<p>Имя сервера: ' . $_SERVER['SERVER_NAME'] . '</p>';
    echo '<p>Порт: ' . $_SERVER['SERVER_PORT'] . '</p>';
    echo '<p>Software: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
    echo '</div>';
    ?>
</body>
</html>