<?php
session_start();
require_once 'UserInfo.php';

echo \"<h1>🧪 Тестирование UserInfo</h1>\";

// Сохраняем тестовую отправку
UserInfo::saveSubmissionTime();
\ = UserInfo::generateVisitorId();

echo \"<h2>📊 Полная информация:</h2>\";
\ = UserInfo::getFullInfo();
echo \"<pre>\";
print_r(\);
echo \"</pre>\";

echo \"<h2>🎨 Форматированная информация:</h2>\";
echo UserInfo::getFormattedInfo();

echo \"<h2>🍪 Информация о куках:</h2>\";
echo \"<p><strong>ID посетителя:</strong> \</p>\";
echo \"<p><strong>Последняя отправка:</strong> \" . UserInfo::getLastSubmission() . \"</p>\";
echo \"<p><strong>Всего отправок:</strong> \" . UserInfo::getSubmissionCount() . \"</p>\";

echo \"<h2>🔧 Информация о сессии:</h2>\";
\ = UserInfo::getSessionInfo();
echo \"<pre>\";
print_r(\);
echo \"</pre>\";

echo \"<p style='color: green;'>✅ Все тесты UserInfo завершены успешно!</p>\";

// Кнопка для очистки куков (для тестирования)
echo \"<form method='post' style='margin-top: 20px;'>\";
echo \"<button type='submit' name='clear_cookies'>Очистить куки отправок</button>\";
echo \"</form>\";

if (isset(\['clear_cookies'])) {
    UserInfo::clearSubmissionCookies();
    echo \"<p style='color: orange;'>🍪 Куки отправок очищены! Обновите страницу.</p>\";
}
?>
<style>
.user-info-section { border: 1px solid #ccc; padding: 15px; margin: 10px 0; border-radius: 8px; }
.info-group { margin: 15px 0; padding: 10px; background: #f9f9f9; border-radius: 5px; }
</style>
