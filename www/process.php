<?php
session_start();

// Получаем данные из формы
$fullName = htmlspecialchars(trim($_POST['fullName'] ?? ''));
$age = htmlspecialchars(trim($_POST['age'] ?? ''));
$direction = htmlspecialchars(trim($_POST['direction'] ?? ''));
$teamRole = htmlspecialchars(trim($_POST['teamRole'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$previousExperience = isset($_POST['previousExperience']) ? 'Да' : 'Нет';
$workshop = isset($_POST['workshop']) ? 'Да' : 'Нет';
$mentoring = isset($_POST['mentoring']) ? 'Да' : 'Нет';
$newsletter = isset($_POST['newsletter']) ? 'Да' : 'Нет';

// Сохраняем старые данные для повторного заполнения формы
$_SESSION['old_data'] = [
    'fullName' => $fullName,
    'age' => $age,
    'direction' => $direction,
    'teamRole' => $teamRole,
    'email' => $email,
    'previousExperience' => $previousExperience,
    'workshop' => $workshop,
    'mentoring' => $mentoring,
    'newsletter' => $newsletter
];

// Валидация данных
$errors = [];

// Проверка имени
if (empty($fullName)) {
    $errors[] = "Поле 'Полное имя' обязательно для заполнения";
} elseif (strlen($fullName) < 2) {
    $errors[] = "Имя должно содержать минимум 2 символа";
} elseif (strlen($fullName) > 100) {
    $errors[] = "Имя не должно превышать 100 символов";
}

// Проверка возраста
if (empty($age)) {
    $errors[] = "Поле 'Возраст' обязательно для заполнения";
} elseif (!is_numeric($age)) {
    $errors[] = "Возраст должен быть числом";
} elseif ($age < 16 || $age > 50) {
    $errors[] = "Возраст должен быть от 16 до 50 лет";
}

// Проверка направления
if (empty($direction)) {
    $errors[] = "Необходимо выбрать направление хакатона";
}

// Проверка роли в команде
if (empty($teamRole)) {
    $errors[] = "Необходимо выбрать роль в команде";
}

// Проверка email
if (empty($email)) {
    $errors[] = "Поле 'Email' обязательно для заполнения";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некорректный формат email адреса";
}

// Если есть ошибки, сохраняем их и перенаправляем обратно
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: hackathon-form.html');
    exit();
}

// Сохраняем успешные данные в сессию для отображения на главной
$_SESSION['last_registration'] = [
    'fullName' => $fullName,
    'age' => $age,
    'direction' => $direction,
    'teamRole' => $teamRole,
    'email' => $email,
    'previousExperience' => $previousExperience,
    'workshop' => $workshop,
    'mentoring' => $mentoring,
    'newsletter' => $newsletter,
    'timestamp' => date('Y-m-d H:i:s')
];

// Сохраняем данные в файл
$dataLine = date('Y-m-d H:i:s') . " | " . 
            $fullName . " | " . 
            $age . " | " . 
            $direction . " | " . 
            $teamRole . " | " . 
            $email . " | " . 
            $previousExperience . " | " . 
            $workshop . " | " . 
            $mentoring . " | " . 
            $newsletter . "\n";

file_put_contents("hackathon_registrations.txt", $dataLine, FILE_APPEND);

// Очищаем старые данные
unset($_SESSION['old_data']);

// Перенаправляем на главную страницу с сообщением об успехе
header('Location: index.php?registration=success');
exit();
?>