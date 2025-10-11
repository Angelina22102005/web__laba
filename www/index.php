<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная - ЛР3</title>
</head>
<body>
    <h1>Лабораторная работа №3</h1>

    <?php
    session_start();
    if (isset($_SESSION['errors'])): ?>
        <ul style="color: red;">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <h2>Данные из сессии:</h2>
        <ul>
            <li>Имя: <?= $_SESSION['username'] ?></li>
            <li>Email: <?= $_SESSION['email'] ?? 'Не указан' ?></li>
        </ul>
    <?php else: ?>
        <p>Данных в сессии пока нет.</p>
    <?php endif; ?>

    <hr>
    <a href="form.html">Заполнить форму</a> |
    <a href="view.php">Посмотреть все данные из файла</a>

</body>
</html>