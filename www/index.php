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
        <h1>Laboratory Work No. 2</h1>
        <h2>Nginx + PHP-FPM + Docker</h2>
        <p><strong>Student:</strong> Lyubanskaya Angelina Valeryevna | <strong>Group:</strong> 3MO-1</p>
    </div>
    
    <div class='info'>
        <h3>PHP is working successfully!</h3>
        <p>Current date and time on server: <?php echo date('Y-m-d H:i:s'); ?></p>
        <p>PHP version: <?php echo phpversion(); ?></p>
    </div>

    <nav>
        <h3>Available pages:</h3>
        <ul>
            <li><a href='/index.php'>Main (PHP)</a></li>
            <li><a href='/phpinfo.php'>phpinfo()</a></li>
            <li><a href='/hackathon-form.php'>Registration for the hackathon</a></li>
            <li><a href='/view.php'>All registrations</a></li>
            <li><a href='/form.html'>Registration form</a></li>
        </ul>
    </nav>
    <!-- ДОБАВЬТЕ этот блок после nav -->
    <div class='info'>
        <h3> Данные из последней регистрации:</h3>
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
    echo '<div class=\"info\">';
    echo '<h4>Server information:</h4>';
    echo '<p>Server name: ' . $_SERVER['SERVER_NAME'] . '</p>';
    echo '<p>Port: ' . $_SERVER['SERVER_PORT'] . '</p>';
    echo '<p>Software: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
    echo '</div>';
    ?>
</body>
</html>