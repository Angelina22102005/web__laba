<?php

/**
 * Класс для работы с внешними API
 * Лабораторная работа №4
 * Студент: Любанская Ангелина Валерьевна
 * Группа: 3МО-3
 */
class ApiClient 
{
    private \;
    private \;

    /**
     * Конструктор класса
     */
    public function __construct() 
    {
        \->timeout = 10;
        \->userAgent = 'Hackathon-App/1.0 (Lab 4; Angelina)';
    }

    /**
     * Выполняет HTTP GET запрос
     */
    private function httpGet(\) 
    {
        try {
            // Настраиваем контекст для file_get_contents
            \ = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => 'User-Agent: ' . \->userAgent . \"\\r\\n\" .
                               'Accept: application/json' . \"\\r\\n\",
                    'timeout' => \->timeout,
                    'ignore_errors' => true
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            // Выполняем запрос
            \ = file_get_contents(\, false, \);

            if (\ === false) {
                throw new Exception('Не удалось выполнить запрос к API');
            }

            return [
                'success' => true,
                'data' => \,
                'status_code' => 200
            ];

        } catch (Exception \) {
            return [
                'success' => false,
                'error' => \->getMessage(),
                'status_code' => 0
            ];
        }
    }

    /**
     * Получает список репозиториев с GitHub
     */
    public function getGitHubRepositories(\ = 5) 
    {
        \ = 'https://api.github.com/repositories';
        
        \ = \->httpGet(\);
        
        if (!\['success']) {
            return [
                'error' => \['error'],
                'fallback_data' => \->getFallbackRepositories(\)
            ];
        }

        try {
            // Декодируем JSON ответ
            \ = json_decode(\['data'], true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Ошибка декодирования JSON: ' . json_last_error_msg());
            }

            // Ограничиваем количество репозиториев
            \ = array_slice(\, 0, \);

            // Форматируем ответ
            \ = [];
            foreach (\ as \) {
                \[] = [
                    'id' => \['id'] ?? null,
                    'name' => \['name'] ?? 'Неизвестно',
                    'full_name' => \['full_name'] ?? '',
                    'description' => \['description'] ?? 'Описание отсутствует',
                    'html_url' => \['html_url'] ?? '#',
                    'language' => \['language'] ?? 'Не указан',
                    'stargazers_count' => \['stargazers_count'] ?? 0,
                    'forks_count' => \['forks_count'] ?? 0
                ];
            }

            return [
                'success' => true,
                'repositories' => \,
                'total_count' => count(\),
                'source' => 'GitHub API'
            ];

        } catch (Exception \) {
            return [
                'success' => false,
                'error' => \->getMessage(),
                'fallback_data' => \->getFallbackRepositories(\),
                'source' => 'Fallback'
            ];
        }
    }

    /**
     * Запасные данные на случай ошибки API
     */
    private function getFallbackRepositories(\) 
    {
        \ = [
            [
                'id' => 1,
                'name' => 'freeCodeCamp',
                'full_name' => 'freeCodeCamp/freeCodeCamp',
                'description' => 'Open source codebase and curriculum',
                'html_url' => 'https://github.com/freeCodeCamp/freeCodeCamp',
                'language' => 'JavaScript',
                'stargazers_count' => 374000,
                'forks_count' => 33500
            ],
            [
                'id' => 2,
                'name' => 'vue',
                'full_name' => 'vuejs/vue',
                'description' => 'Progressive JavaScript Framework',
                'html_url' => 'https://github.com/vuejs/vue',
                'language' => 'JavaScript',
                'stargazers_count' => 208000,
                'forks_count' => 34500
            ],
            [
                'id' => 3,
                'name' => 'react',
                'full_name' => 'facebook/react',
                'description' => 'Library for building user interfaces',
                'html_url' => 'https://github.com/facebook/react',
                'language' => 'JavaScript',
                'stargazers_count' => 215000,
                'forks_count' => 45000
            ],
            [
                'id' => 4,
                'name' => 'tensorflow',
                'full_name' => 'tensorflow/tensorflow',
                'description' => 'Machine Learning Framework',
                'html_url' => 'https://github.com/tensorflow/tensorflow',
                'language' => 'C++',
                'stargazers_count' => 179000,
                'forks_count' => 88500
            ],
            [
                'id' => 5,
                'name' => 'bootstrap',
                'full_name' => 'twbs/bootstrap',
                'description' => 'CSS framework',
                'html_url' => 'https://github.com/twbs/bootstrap',
                'language' => 'JavaScript',
                'stargazers_count' => 166000,
                'forks_count' => 78500
            ]
        ];

        return array_slice(\, 0, \);
    }

    /**
     * Генерирует случайную идею для хакатона
     */
    public function getRandomHackathonIdea() 
    {
        \ = [
            [
                'title' => 'Платформа для поиска команды на хакатон',
                'description' => 'Разработать веб-приложение, которое помогает участникам находить команды по навыкам и интересам',
                'complexity' => 3,
                'tech_stack' => ['PHP', 'JavaScript', 'MySQL', 'Docker', 'Bootstrap'],
                'category' => 'Социальная сеть'
            ],
            [
                'title' => 'AI-помощник для генерации идей проектов',
                'description' => 'Создать нейросеть, которая генерирует уникальные идеи для проектов на основе интересов пользователя',
                'complexity' => 5,
                'tech_stack' => ['Python', 'TensorFlow', 'React', 'FastAPI', 'MongoDB'],
                'category' => 'Искусственный интеллект'
            ],
            [
                'title' => 'Система оценки проектов для жюри хакатона',
                'description' => 'Разработать платформу для удобного оценивания проектов с автоматическим подсчетом баллов',
                'complexity' => 4,
                'tech_stack' => ['PHP', 'Vue.js', 'WebSocket', 'Redis', 'Chart.js'],
                'category' => 'Организация мероприятий'
            ],
            [
                'title' => 'Платформа для онлайн-презентаций проектов',
                'description' => 'Создать сервис для проведения презентаций проектов с возможностью голосования и комментариев',
                'complexity' => 3,
                'tech_stack' => ['Node.js', 'WebRTC', 'MongoDB', 'Express', 'Socket.io'],
                'category' => 'Видео-платформа'
            ],
            [
                'title' => 'Мобильное приложение для участников хакатона',
                'description' => 'Разработать приложение с расписанием, уведомлениями и картой мероприятия',
                'complexity' => 4,
                'tech_stack' => ['React Native', 'Firebase', 'Redux', 'TypeScript', 'Google Maps API'],
                'category' => 'Мобильная разработка'
            ],
            [
                'title' => 'Система управления задачами для команд',
                'description' => 'Создать Kanban-доску для управления задачами во время хакатона',
                'complexity' => 2,
                'tech_stack' => ['PHP', 'JavaScript', 'MySQL', 'Drag & Drop API', 'REST API'],
                'category' => 'Проектный менеджмент'
            ]
        ];

        \ = \[array_rand(\)];
        
        return [
            'success' => true,
            'idea' => \,
            'generated_at' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Получает текущие курсы валют
     */
    public function getExchangeRates() 
    {
        \ = 'https://api.exchangerate.host/latest?base=USD';
        
        \ = \->httpGet(\);
        
        if (!\['success']) {
            return \->getFallbackExchangeRates();
        }

        try {
            \ = json_decode(\['data'], true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Ошибка декодирования JSON курсов валют');
            }

            return [
                'success' => true,
                'base' => \['base'] ?? 'USD',
                'rates' => [
                    'USD' => 1,
                    'EUR' => \['rates']['EUR'] ?? 0.92,
                    'RUB' => \['rates']['RUB'] ?? 95.50,
                    'GBP' => \['rates']['GBP'] ?? 0.79,
                    'JPY' => \['rates']['JPY'] ?? 149.00
                ],
                'date' => \['date'] ?? date('Y-m-d'),
                'source' => 'ExchangeRate API'
            ];

        } catch (Exception \) {
            return \->getFallbackExchangeRates();
        }
    }

    /**
     * Запасные данные курсов валют
     */
    private function getFallbackExchangeRates() 
    {
        return [
            'success' => true,
            'base' => 'USD',
            'rates' => [
                'USD' => 1,
                'EUR' => 0.92,
                'RUB' => 95.50,
                'GBP' => 0.79,
                'JPY' => 149.00
            ],
            'date' => date('Y-m-d'),
            'source' => 'Fallback Data',
            'note' => 'Используются тестовые данные'
        ];
    }

    /**
     * Получает случайную tech-новость (заглушка)
     */
    public function getRandomTechNews() 
    {
        \ = [
            [
                'title' => 'Новый фреймворк для PHP упрощает разработку API',
                'summary' => 'Представлен новый микро-фреймворк, который обещает ускорить создание REST API',
                'category' => 'Backend'
            ],
            [
                'title' => 'Искусственный интеллект в веб-разработке',
                'summary' => 'AI начинает активно использоваться для генерации кода и тестирования приложений',
                'category' => 'AI/ML'
            ],
            [
                'title' => 'Docker представляет новые функции безопасности',
                'summary' => 'В новой версии Docker улучшена изоляция контейнеров и управление секретами',
                'category' => 'DevOps'
            ]
        ];

        return [
            'success' => true,
            'news' => \[array_rand(\)],
            'fetched_at' => date('Y-m-d H:i:s')
        ];
    }
}

?>
