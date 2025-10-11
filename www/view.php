<?php
// www/view.php
session_start();
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Все участники хакатона</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
        }
        .nav a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav a:hover {
            background-color: #e9ecef;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .stats {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='nav'>
            <a href='index.php'>Главная</a>
            <a href='phpinfo.php'>PHP Info</a>
            <a href='form.html'>Общая форма</a>
            <a href='hackathon-form.html'>Хакатон</a>
            <a href='view.php'>Все участники</a>
        </div>

        <h1>Все зарегистрированные участники хакатона</h1>

        <?php if (file_exists('hackathon_registrations.txt') && filesize('hackathon_registrations.txt') > 0): ?>
            <?php
            $lines = file('hackathon_registrations.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lines = array_reverse($lines); // Новые записи сверху
            
            $directionNames = [
                'web-development' => 'Веб-разработка',
                'mobile-development' => 'Мобильная разработка',
                'ai-ml' => 'Искусственный интеллект и ML',
                'blockchain' => 'Блокчейн технологии',
                'iot' => 'Интернет вещей (IoT)',
                'cybersecurity' => 'Кибербезопасность',
                'data-science' => 'Data Science',
                'game-dev' => 'Разработка игр'
            ];
            
            $roleNames = [
                'backend' => 'Backend',
                'frontend' => 'Frontend',
                'fullstack' => 'Fullstack',
                'designer' => 'Дизайнер',
                'data' => 'Data Scientist'
            ];
            ?>
            
            <div class='stats'>
                <p><strong>Всего зарегистрированных участников:</strong> <?= count($lines) ?></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Дата/Время</th>
                        <th>Имя</th>
                        <th>Возраст</th>
                        <th>Направление</th>
                        <th>Роль</th>
                        <th>Email</th>
                        <th>Опыт</th>
                        <th>Воркшоп</th>
                        <th>Ментор</th>
                        <th>Рассылка</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lines as $line): ?>
                        <?php
                        $data = explode(' | ', $line);
                        if (count($data) >= 10):
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($data[0]) ?></td>
                                <td><?= htmlspecialchars($data[1]) ?></td>
                                <td><?= htmlspecialchars($data[2]) ?></td>
                                <td><?= $directionNames[$data[3]] ?? $data[3] ?></td>
                                <td><?= $roleNames[$data[4]] ?? $data[4] ?></td>
                                <td><?= htmlspecialchars($data[5]) ?></td>
                                <td><?= htmlspecialchars($data[6]) ?></td>
                                <td><?= htmlspecialchars($data[7]) ?></td>
                                <td><?= htmlspecialchars($data[8]) ?></td>
                                <td><?= htmlspecialchars($data[9]) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php else: ?>
            <div class='empty-state'>
                <h3>📝 Данных пока нет</h3>
                <p>Будьте первым зарегистрированным участником!</p>
                <a href='hackathon-form.html' style='
                    background: #28a745;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 4px;
                    display: inline-block;
                    margin-top: 15px;
                '>Зарегистрироваться</a>
            </div>
        <?php endif; ?>

        <div style='text-align: center; margin-top: 30px;'>
            <a href='index.php' style='
                background: #6c757d;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 4px;
                display: inline-block;
                margin-right: 10px;
            '>На главную</a>
            
            <?php if (file_exists('hackathon_registrations.txt') && filesize('hackathon_registrations.txt') > 0): ?>
                <a href='clear-data.php' onclick="return confirm('Вы уверены, что хотите удалить все данные?')" style='
                    background: #dc3545;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 4px;
                    display: inline-block;
                '>Очистить все данные</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>