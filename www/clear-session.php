<?php
session_start();

// Очищаем все данные сессии
session_unset();
session_destroy();

// Начинаем новую сессию для сообщения
session_start();
$_SESSION['message'] = "Данные сессии успешно очищены";

header('Location: index.php');
exit();
?>