<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Регистрация на хакатон - Lab 4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(142, 27, 27, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #fafafa;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }
        .required {
            color: red;
        }
        input[type='text'],
        input[type='number'],
        input[type='email'],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .radio-item, .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .radio-item input[type='radio'],
        .checkbox-item input[type='checkbox'] {
            margin-top: 2px;
            flex-shrink: 0;
        }
        .radio-item label,
        .checkbox-item label {
            margin: 0;
            font-weight: normal;
            cursor: pointer;
            line-height: 1.4;
        }
        .field-hint {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
            font-style: italic;
            line-height: 1.4;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        button:hover {
            background: #45a049;
        }
        .nav {
            margin-bottom: 20px;
            text-align: center;
        }
        .nav a {
            margin: 0 10px;
            color: #3498db;
            text-decoration: none;
        }
        .error {
            color: red;
            background: #ffeaea;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <div class='form-container'>
        <div class='nav'>
            <a href='/index.php'>Главная</a>
            <a href='/view.php'>Все участники</a>
            <a href='/test-userinfo.php'>Тест UserInfo</a>
        </div>
        
        <h1>Регистрация на хакатон - Lab 4</h1>

        <!-- Блок для вывода ошибок -->
        <?php if(isset($_SESSION['errors'])): ?>
            <div class='error'>
                <strong>Обнаружены ошибки:</strong>
                <ul>
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <form id='hackathonForm' action='process.php' method='POST'>
            <!-- Полное имя -->
            <div class='form-group'>
                <label for='fullName'>Полное имя участника: <span class='required'>*</span></label>
                <input type='text' id='fullName' name='fullName' placeholder='Введите ваше полное имя' required>
                <div class='field-hint'>Как указано в официальном документе</div>
            </div>

            <!-- Возраст -->
            <div class='form-group'>
                <label for='age'>Возраст: <span class='required'>*</span></label>
                <input type='number' id='age' name='age' min='16' max='50' placeholder='Введите ваш возраст' required>
                <div class='field-hint'>От 16 до 50 лет</div>
            </div>

            <!-- Направление -->
            <div class='form-group'>
                <label for='direction'>Направление хакатона: <span class='required'>*</span></label>
                <select id='direction' name='direction' required>
                    <option value=''>-- Выберите направление --</option>
                    <option value='web-development'>Веб-разработка</option>
                    <option value='mobile-development'>Мобильная разработка</option>
                    <option value='ai-ml'>Искусственный интеллект и ML</option>
                    <option value='blockchain'>Блокчейн технологии</option>
                    <option value='iot'>Интернет вещей (IoT)</option>
                    <option value='cybersecurity'>Кибербезопасность</option>
                    <option value='data-science'>Data Science</option>
                    <option value='game-dev'>Разработка игр</option>
                </select>
                <div class='field-hint'>Выберите наиболее интересное для вас направление</div>
            </div>

            <!-- Роль в команде -->
            <div class='form-group'>
                <label>Предпочитаемая роль в команде: <span class='required'>*</span></label>
                <div class='radio-group'>
                    <div class='radio-item'>
                        <input type='radio' id='role-backend' name='teamRole' value='backend' required>
                        <label for='role-backend'>Backend-разработчик</label>
                    </div>
                    <div class='radio-item'>
                        <input type='radio' id='role-frontend' name='teamRole' value='frontend'>
                        <label for='role-frontend'>Frontend-разработчик</label>
                    </div>
                    <div class='radio-item'>
                        <input type='radio' id='role-fullstack' name='teamRole' value='fullstack'>
                        <label for='role-fullstack'>Fullstack-разработчик</label>
                    </div>
                    <div class='radio-item'>
                        <input type='radio' id='role-designer' name='teamRole' value='designer'>
                        <label for='role-designer'>UI/UX дизайнер</label>
                    </div>
                    <div class='radio-item'>
                        <input type='radio' id='role-data' name='teamRole' value='data'>
                        <label for='role-data'>Data Scientist</label>
                    </div>
                </div>
                <div class='field-hint'>Выберите роль, которая лучше всего соответствует вашим навыкам</div>
            </div>

            <!-- Email -->
            <div class='form-group'>
                <label for='email'>Email для связи: <span class='required'>*</span></label>
                <input type='email' id='email' name='email' placeholder='your.email@example.com' required>
                <div class='field-hint'>На этот email придет подтверждение регистрации</div>
            </div>

            <!-- Опыт участия -->
            <div class='form-group'>
                <label>Опыт участия в хакатонах:</label>
                <div class='checkbox-group'>
                    <div class='checkbox-item'>
                        <input type='checkbox' id='previousExperience' name='previousExperience' value='yes'>
                        <label for='previousExperience'>У меня есть опыт участия в хакатонах</label>
                    </div>
                </div>
            </div>

            <!-- Дополнительные опции -->
            <div class='form-group'>
                <label>Дополнительные опции:</label>
                <div class='checkbox-group'>
                    <div class='checkbox-item'>
                        <input type='checkbox' id='workshop' name='workshop' value='yes'>
                        <label for='workshop'>Хочу посетить воркшопы</label>
                    </div>
                    <div class='checkbox-item'>
                        <input type='checkbox' id='mentoring' name='mentoring' value='yes'>
                        <label for='mentoring'>Нужен ментор</label>
                    </div>
                    <div class='checkbox-item'>
                        <input type='checkbox' id='newsletter' name='newsletter' value='yes'>
                        <label for='newsletter'>Подписаться на рассылку IT-мероприятий</label>
                    </div>
                </div>
            </div>

            <button type='submit'>Зарегистрироваться на хакатон</button>
        </form>
    </div>

    <script>
        document.getElementById('hackathonForm').addEventListener('submit', function(e) {
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            alert('Данные будут отправлены на сервер:\nИмя: ' + fullName + '\nEmail: ' + email);
        });
    </script>
</body>
</html>