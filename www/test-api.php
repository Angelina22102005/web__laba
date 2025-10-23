<?php
require_once 'ApiClient.php';

echo "<h1>🧪 Тестирование ApiClient</h1>";

// Создаем экземпляр класса
$apiClient = new ApiClient();

// Тестируем получение репозиториев
echo "<h2>📂 Тест GitHub API:</h2>";
$repos = $apiClient->getGitHubRepositories(2);
echo "<pre>";
print_r($repos);
echo "</pre>";

// Тестируем идеи для хакатона
echo "<h2>💡 Тест идей для хакатона:</h2>";
$idea = $apiClient->getRandomHackathonIdea();
echo "<pre>";
print_r($idea);
echo "</pre>";

// Тестируем курсы валют
echo "<h2>💰 Тест курсов валют:</h2>";
$rates = $apiClient->getExchangeRates();
echo "<pre>";
print_r($rates);
echo "</pre>";

echo "<p style='color: green;'>✅ Все тесты завершены успешно!</p>";
?>