<?php
// Включение сессии
session_start();

// Получаем данные из формы
$fullName = htmlspecialchars($_POST['fullName'] ?? '');
$age = htmlspecialchars($_POST['age'] ?? '');
$direction = htmlspecialchars($_POST['direction'] ?? '');
$teamRole = htmlspecialchars($_POST['teamRole'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$previousExperience = isset($_POST['previousExperience']) ? 'Да' : 'Нет';
$workshop = isset($_POST['workshop']) ? 'Да' : 'Нет';
$mentoring = isset($_POST['mentoring']) ? 'Да' : 'Нет';
$newsletter = isset($_POST['newsletter']) ? 'Да' : 'Нет';

// ВАЛИДАЦИЯ ДАННЫХ
$errors = [];

if(empty($fullName)) $errors[] = "Полное имя обязательно для заполнения";
if(empty($age) || $age < 16 || $age > 50) $errors[] = "Возраст должен быть от 16 до 50 лет";
if(empty($direction)) $errors[] = "Выберите направление хакатона";
if(empty($teamRole)) $errors[] = "Выберите роль в команде";
if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Введите корректный email адрес";

// Если есть ошибки - возвращаем на форму
if(!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: hackathon-form.php");
    exit();
}

// Сохраняем данные в сессию
$_SESSION['form_data'] = [
    'fullName' => $fullName,
    'age' => $age,
    'direction' => $direction,
    'teamRole' => $teamRole,
    'email' => $email,
    'previousExperience' => $previousExperience,
    'workshop' => $workshop,
    'mentoring' => $mentoring,
    'newsletter' => $newsletter,
    'registration_date' => date('Y-m-d H:i:s')
];

$dataLine = date('Y-m-d H:i:s') . '|' . 
            $fullName . '|' . 
            $age . '|' . 
            $direction . '|' . 
            $teamRole . '|' . 
            $email . '|' . 
            $previousExperience . '|' . 
            $workshop . '|' . 
            $mentoring . '|' . 
            $newsletter . "\n";

// Сохраняем в файл
file_put_contents('registrations.txt', $dataLine, FILE_APPEND);

error_log("Сохранено в сессию: " . print_r($_SESSION['form_data'], true));
// Перенаправляем на главную страницу
header("Location: index.php");
exit();
?>