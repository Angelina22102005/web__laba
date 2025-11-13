<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'UserInfo.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Тест UserInfo</title>
    <style>
        .user-info-section { border: 1px solid #ccc; padding: 15px; margin: 10px 0; border-radius: 8px; }
        .info-group { margin: 15px 0; padding: 10px; background: #f9f9f9; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Тестирование UserInfo</h1>

    <?php
    UserInfo::saveSubmissionTime();
    $visitorId = UserInfo::generateVisitorId();
    ?>

    <h2>Информация о браузере:</h2>
    <pre><?php print_r(UserInfo::getBrowserInfo()); ?></pre>

    <h2>Форматированная информация:</h2>
    <?php echo UserInfo::getFormattedInfo(); ?>

    <h2>Информация о куках:</h2>
    <p><strong>ID посетителя:</strong> <?php echo $visitorId; ?></p>
    <p><strong>Последняя отправка:</strong> <?php echo UserInfo::getLastSubmission(); ?></p>
    <p><strong>Всего отправок:</strong> <?php echo UserInfo::getSubmissionCount(); ?></p>

    <p style='color: green;'>Тесты UserInfo завершены успешно!</p>

    <form method='post' style='margin-top: 20px;'>
        <button type='submit' name='clear_cookies'>Очистить куки отправок</button>
    </form>

    <?php
    if (isset($_POST['clear_cookies'])) {
        UserInfo::clearSubmissionCookies();
        echo "<p style='color: orange;'>Куки отправок очищены! Обновите страницу.</p>";
    }
    ?>
</body>
</html>