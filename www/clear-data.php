<?php
session_start();

if (file_exists('hackathon_registrations.txt')) {
    unlink('hackathon_registrations.txt');
}

// Очищаем сессионные данные
if (isset($_SESSION['last_registration'])) {
    unset($_SESSION['last_registration']);
}

$_SESSION['message'] = "Все данные успешно очищены";
header('Location: view.php');
exit();
?>