<?php
require_once 'ApiClient.php';

echo \"<h1>🧪 Тестирование ApiClient</h1>\";

// Создаем экземпляр класса
\ = new ApiClient();

// Тестируем получение репозиториев
echo \"<h2>📂 Тест GitHub API:</h2>\";
\ = \->getGitHubRepositories(2);
echo \"<pre>\";
print_r(\);
echo \"</pre>\";

// Тестируем идеи для хакатона
echo \"<h2>💡 Тест идей для хакатона:</h2>\";
\ = \->getRandomHackathonIdea();
echo \"<pre>\";
print_r(\);
echo \"</pre>\";

// Тестируем курсы валют
echo \"<h2>💰 Тест курсов валют:</h2>\";
\ = \->getExchangeRates();
echo \"<pre>\";
print_r(\);
echo \"</pre>\";

echo \"<p style='color: green;'>✅ Все тесты завершены успешно!</p>\";
?>
