<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Подключаем наши классы
require_once 'ApiClient.php';
require_once 'UserInfo.php';
require_once 'Database.php';
require_once 'HackathonRegistration.php';

// Инициализируем базу данных
$database = new Database();
$hackathonRegistration = new HackathonRegistration($database);

// Получаем данные из формы
$fullName = htmlspecialchars($_POST['fullName'] ?? '');
$age = htmlspecialchars($_POST['age'] ?? '');
$direction = htmlspecialchars($_POST['direction'] ?? '');
$teamRole = htmlspecialchars($_POST['teamRole'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$previousExperience = isset($_POST['previousExperience']) ? true : false;
$workshop = isset($_POST['workshop']) ? true : false;
$mentoring = isset($_POST['mentoring']) ? true : false;
$newsletter = isset($_POST['newsletter']) ? true : false;

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

// СОХРАНЕНИЕ ДАННЫХ В БАЗУ ДАННЫХ
$registrationData = [
    'full_name' => $fullName,
    'age' => $age,
    'email' => $email,
    'direction' => $direction,
    'team_role' => $teamRole,
    'previous_experience' => $previousExperience,
    'workshop' => $workshop,
    'mentoring' => $mentoring,
    'newsletter' => $newsletter
];

$dbResult = $hackathonRegistration->addRegistration($registrationData);

if (!$dbResult['success']) {
    $_SESSION['errors'] = ['Ошибка сохранения в базу данных: ' . $dbResult['error']];
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
    'previousExperience' => $previousExperience ? 'Да' : 'Нет',
    'workshop' => $workshop ? 'Да' : 'Нет',
    'mentoring' => $mentoring ? 'Да' : 'Нет',
    'newsletter' => $newsletter ? 'Да' : 'Нет',
    'registration_date' => date('Y-m-d H:i:s'),
    'db_id' => $dbResult['id'] ?? null
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

// СОХРАНЕНИЕ В ФАЙЛ (резервное копирование)
$dataLine = date('Y-m-d H:i:s') . '|' . 
            $fullName . '|' . 
            $age . '|' . 
            $direction . '|' . 
            $teamRole . '|' . 
            $email . '|' . 
            ($previousExperience ? 'Да' : 'Нет') . '|' . 
            ($workshop ? 'Да' : 'Нет') . '|' . 
            ($mentoring ? 'Да' : 'Нет') . '|' . 
            ($newsletter ? 'Да' : 'Нет') . "\n";

file_put_contents('registrations.txt', $dataLine, FILE_APPEND);

// СОХРАНЕНИЕ В КУКИ
UserInfo::saveSubmissionTime();
$submissionCount = UserInfo::getSubmissionCount();

// Добавляем информацию о куках в сессию для отображения
$_SESSION['cookie_info'] = [
    'last_submission' => UserInfo::getLastSubmission(),
    'submission_count' => $submissionCount,
    'db_success' => $dbResult['success'],
    'db_message' => $dbResult['message'] ?? 'Данные сохранены'
];

// Перенаправляем на главную
header("Location: index.php");
exit();
?>