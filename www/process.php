<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Подключаем наши классы
require_once 'ApiClient.php';
require_once 'UserInfo.php';

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

if (empty($fullName)) $errors[] = "Полное имя обязательно для заполнения";
if (empty($age) || $age < 16 || $age > 50) $errors[] = "Возраст должен быть от 16 до 50 лет";
if (empty($direction)) $errors[] = "Выберите направление хакатона";
if (empty($teamRole)) $errors[] = "Выберите роль в команде";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Введите корректный email адрес";

// Если есть ошибки - возвращаем на форму
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: hackathon-form.php");
    exit();
}

// СОХРАНЕНИЕ ДАННЫХ В СЕССИЮ
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

// ПОЛУЧЕНИЕ ДАННЫХ ИЗ API
try {
    $apiClient = new ApiClient();
    
    // Получаем репозитории с GitHub
    $githubRepos = $apiClient->getGitHubRepositories(3);
    
    // Получаем случайную идею для хакатона
    $hackathonIdea = $apiClient->getRandomHackathonIdea();
    
    // Получаем курсы валют
    $exchangeRates = $apiClient->getExchangeRates();
    
    $_SESSION['api_data'] = [
        'github_repos' => $githubRepos,
        'hackathon_idea' => $hackathonIdea,
        'exchange_rates' => $exchangeRates,
        'api_timestamp' => date('Y-m-d H:i:s')
    ];
    
} catch (Exception $e) {
    $_SESSION['api_data'] = [
        'error' => 'Не удалось получить данные API: ' . $e->getMessage()
    ];
}

// СОХРАНЕНИЕ В ФАЙЛ
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

file_put_contents('registrations.txt', $dataLine, FILE_APPEND);

// СОХРАНЕНИЕ В КУКИ
UserInfo::saveSubmissionTime();
$submissionCount = UserInfo::getSubmissionCount();

// Добавляем информацию о куках в сессию для отображения
$_SESSION['cookie_info'] = [
    'last_submission' => UserInfo::getLastSubmission(),
    'submission_count' => $submissionCount
];

// Перенаправляем на главную
header("Location: index.php");
exit();
?>