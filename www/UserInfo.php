<?php

/**
 * Класс для работы с информацией о пользователе и куками
 * Лабораторная работа №4
 * Студент: Любанская Ангелина Валерьевна
 * Группа: 3МО-1
 */
class UserInfo 
{
    /**
     * Получает полную информацию о пользователе и его устройстве
     */
    public static function getFullInfo() 
    {
        return [
            'ip_info' => self::getIPInfo(),
            'browser_info' => self::getBrowserInfo(),
            'system_info' => self::getSystemInfo(),
            'request_info' => self::getRequestInfo(),
            'cookie_info' => self::getCookieInfo(),
            'geolocation' => self::getGeolocationInfo()
        ];
    }

    /**
     * Получает информацию об IP-адресе
     */
    private static function getIPInfo() 
    {
        \ = self::getClientIP();
        
        return [
            'ip_address' => \,
            'ip_version' => filter_var(\, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? 'IPv4' : 
                           (filter_var(\, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? 'IPv6' : 'Unknown'),
            'is_private' => self::isPrivateIP(\),
            'forwarded_for' => \['HTTP_X_FORWARDED_FOR'] ?? 'Not set',
            'real_ip' => \['HTTP_X_REAL_IP'] ?? 'Not set'
        ];
    }

    /**
     * Определяет реальный IP-адрес клиента
     */
    private static function getClientIP() 
    {
        \ = \['REMOTE_ADDR'] ?? 'Unknown';

        // Проверяем различные заголовки для определения реального IP
        \ = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP', 
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED'
        ];

        foreach (\ as \) {
            if (!empty(\[\])) {
                \ = explode(',', \[\]);
                \ = trim(\[0]);
                break;
            }
        }

        // Фильтруем IP
        \ = filter_var(\, FILTER_VALIDATE_IP);
        return \ ? \ : 'Invalid IP';
    }

    /**
     * Проверяет является ли IP приватным
     */
    private static function isPrivateIP(\) 
    {
        if (!filter_var(\, FILTER_VALIDATE_IP)) {
            return false;
        }

        \ = [
            '10.0.0.0/8',
            '172.16.0.0/12', 
            '192.168.0.0/16',
            '127.0.0.0/8',
            '169.254.0.0/16'
        ];

        foreach (\ as \) {
            if (self::ipInRange(\, \)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Проверяет вхождение IP в диапазон
     */
    private static function ipInRange(\, \) 
    {
        if (strpos(\, '/') === false) {
            return \ === \;
        }

        list(\, \) = explode('/', \, 2);
        
        \ = ip2long(\);
        \ = ip2long(\);
        \ = pow(2, (32 - \)) - 1;
        \ = ~ \;

        return (\ & \) == (\ & \);
    }

    /**
     * Получает информацию о браузере
     */
    private static function getBrowserInfo() 
    {
        \ = \['HTTP_USER_AGENT'] ?? 'Unknown';
        
        return [
            'user_agent' => \,
            'browser_name' => self::detectBrowser(\),
            'browser_version' => self::detectBrowserVersion(\),
            'is_mobile' => self::isMobile(\),
            'is_bot' => self::isBot(\),
            'language' => \['HTTP_ACCEPT_LANGUAGE'] ?? 'Not set'
        ];
    }

    /**
     * Определяет название браузера
     */
    private static function detectBrowser(\) 
    {
        \ = [
            'Chrome' => 'Chrome',
            'Firefox' => 'Firefox', 
            'Safari' => 'Safari',
            'Edge' => 'Edge',
            'Opera' => 'Opera',
            'MSIE' => 'Internet Explorer',
            'Trident' => 'Internet Explorer'
        ];

        foreach (\ as \ => \) {
            if (stripos(\, \) !== false) {
                return \;
            }
        }

        return 'Unknown Browser';
    }

    /**
     * Определяет версию браузера
     */
    private static function detectBrowserVersion(\) 
    {
        // Упрощенное определение версии
        if (preg_match('/(Chrome|Firefox|Safari|Edge|Opera|Version|MSIE)[\\/\\s]?([\\d.]+)/i', \, \)) {
            return \[2] ?? 'Unknown';
        }

        return 'Unknown';
    }

    /**
     * Проверяет мобильное устройство
     */
    private static function isMobile(\) 
    {
        \ = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'Windows Phone', 
            'BlackBerry', 'Opera Mini', 'IEMobile'
        ];

        foreach (\ as \) {
            if (stripos(\, \) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Проверяет бота/краулера
     */
    private static function isBot(\) 
    {
        \ = [
            'bot', 'crawler', 'spider', 'slurp', 'search', 'archive',
            'google', 'bing', 'yandex', 'baidu', 'facebook'
        ];

        foreach (\ as \) {
            if (stripos(\, \) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Получает информацию о системе
     */
    private static function getSystemInfo() 
    {
        \ = \['HTTP_USER_AGENT'] ?? 'Unknown';
        
        return [
            'operating_system' => self::detectOS(\),
            'platform' => self::detectPlatform(\),
            'device_type' => self::getDeviceType(\),
            'architecture' => 'Unknown' // Требует дополнительных данных
        ];
    }

    /**
     * Определяет операционную систему
     */
    private static function detectOS(\) 
    {
        \ = [
            'Windows 10' => 'Windows NT 10.0',
            'Windows 8.1' => 'Windows NT 6.3',
            'Windows 8' => 'Windows NT 6.2',
            'Windows 7' => 'Windows NT 6.1',
            'Windows Vista' => 'Windows NT 6.0',
            'Windows XP' => 'Windows NT 5.1',
            'macOS' => 'Macintosh',
            'Linux' => 'Linux',
            'Android' => 'Android',
            'iOS' => 'iPhone',
            'iPadOS' => 'iPad'
        ];

        foreach (\ as \ => \) {
            if (stripos(\, \) !== false) {
                return \;
            }
        }

        return 'Unknown OS';
    }

    /**
     * Определяет платформу
     */
    private static function detectPlatform(\) 
    {
        if (stripos(\, 'Win') !== false) return 'Windows';
        if (stripos(\, 'Mac') !== false) return 'macOS';
        if (stripos(\, 'Linux') !== false) return 'Linux';
        if (stripos(\, 'Android') !== false) return 'Android';
        if (stripos(\, 'iPhone') !== false || stripos(\, 'iPad') !== false) return 'iOS';
        
        return 'Unknown';
    }

    /**
     * Определяет тип устройства
     */
    private static function getDeviceType(\) 
    {
        if (self::isMobile(\)) {
            if (stripos(\, 'Tablet') !== false || stripos(\, 'iPad') !== false) {
                return 'Tablet';
            }
            return 'Mobile';
        }

        return 'Desktop';
    }

    /**
     * Получает информацию о запросе
     */
    private static function getRequestInfo() 
    {
        return [
            'request_method' => \['REQUEST_METHOD'] ?? 'Unknown',
            'request_time' => \['REQUEST_TIME'] ?? time(),
            'request_time_formatted' => date('Y-m-d H:i:s', \['REQUEST_TIME'] ?? time()),
            'request_uri' => \['REQUEST_URI'] ?? 'Unknown',
            'query_string' => \['QUERY_STRING'] ?? 'No query',
            'https' => isset(\['HTTPS']) && \['HTTPS'] !== 'off',
            'server_protocol' => \['SERVER_PROTOCOL'] ?? 'Unknown',
            'server_port' => \['SERVER_PORT'] ?? 'Unknown'
        ];
    }

    /**
     * Получает информацию о куках
     */
    private static function getCookieInfo() 
    {
        \ = \;
        \ = count(\);
        
        // Скрываем чувствительные данные
        \ = [];
        foreach (\ as \ => \) {
            if (in_array(strtolower(\), ['password', 'token', 'secret', 'auth'])) {
                \[\] = '***HIDDEN***';
            } else {
                \[\] = \;
            }
        }

        return [
            'total_cookies' => \,
            'cookies_list' => \,
            'last_submission' => \['last_submission'] ?? 'Never',
            'submission_count' => \['submission_count'] ?? 0,
            'session_id' => session_id()
        ];
    }

    /**
     * Получает геолокационную информацию (упрощенная)
     */
    private static function getGeolocationInfo() 
    {
        \ = self::getClientIP();
        
        if (\ === '127.0.0.1' || \ === '::1' || self::isPrivateIP(\)) {
            return [
                'country' => 'Localhost',
                'city' => 'Local Network',
                'timezone' => date_default_timezone_get(),
                'note' => 'Local IP address'
            ];
        }

        // В реальном проекте здесь был бы вызов API геолокации
        return [
            'country' => 'Unknown (API not implemented)',
            'city' => 'Unknown',
            'timezone' => date_default_timezone_get(),
            'note' => 'Geolocation requires external API'
        ];
    }

    /**
     * Сохраняет время отправки формы в куки
     */
    public static function saveSubmissionTime() 
    {
        \ = date('Y-m-d H:i:s');
        
        // Сохраняем время последней отправки
        setcookie('last_submission', \, [
            'expires' => time() + (30 * 24 * 60 * 60), // 30 дней
            'path' => '/',
            'secure' => isset(\['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        // Увеличиваем счетчик отправок
        \ = \['submission_count'] ?? 0;
        setcookie('submission_count', \ + 1, [
            'expires' => time() + (30 * 24 * 60 * 60),
            'path' => '/',
            'secure' => isset(\['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        return \;
    }

    /**
     * Получает время последней отправки
     */
    public static function getLastSubmission() 
    {
        return \['last_submission'] ?? 'Никогда';
    }

    /**
     * Получает количество отправок
     */
    public static function getSubmissionCount() 
    {
        return \['submission_count'] ?? 0;
    }

    /**
     * Очищает куки отправок (для тестирования)
     */
    public static function clearSubmissionCookies() 
    {
        setcookie('last_submission', '', time() - 3600, '/');
        setcookie('submission_count', '', time() - 3600, '/');
    }

    /**
     * Генерирует уникальный идентификатор посетителя
     */
    public static function generateVisitorId() 
    {
        \ = \['visitor_id'] ?? null;
        
        if (!\) {
            \ = uniqid('visitor_', true);
            setcookie('visitor_id', \, [
                'expires' => time() + (365 * 24 * 60 * 60), // 1 год
                'path' => '/',
                'secure' => isset(\['HTTPS']),
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }

        return \;
    }

    /**
     * Получает информацию о сессии
     */
    public static function getSessionInfo() 
    {
        return [
            'session_id' => session_id(),
            'session_status' => session_status(),
            'session_name' => session_name(),
            'session_cookie_params' => session_get_cookie_params()
        ];
    }

    /**
     * Форматирует информацию о пользователе для красивого вывода
     */
    public static function getFormattedInfo() 
    {
        \ = self::getFullInfo();
        
        \ = \"\";
        \ .= \"<div class='user-info-section'>\n\";
        \ .= \"<h3>👤 Информация о пользователе</h3>\n\";
        
        // IP информация
        \ .= \"<div class='info-group'>\n\";
        \ .= \"<h4>🌐 Сетевые данные:</h4>\n\";
        \ .= \"<p><strong>IP-адрес:</strong> {\['ip_info']['ip_address']}</p>\n\";
        \ .= \"<p><strong>Тип IP:</strong> {\['ip_info']['ip_version']}</p>\n\";
        \ .= \"<p><strong>Локальная сеть:</strong> \" . (\['ip_info']['is_private'] ? 'Да' : 'Нет') . \"</p>\n\";
        \ .= \"</div>\n\";
        
        // Браузер информация
        \ .= \"<div class='info-group'>\n\";
        \ .= \"<h4>🖥 Браузер и система:</h4>\n\";
        \ .= \"<p><strong>Браузер:</strong> {\['browser_info']['browser_name']} {\['browser_info']['browser_version']}</p>\n\";
        \ .= \"<p><strong>ОС:</strong> {\['system_info']['operating_system']}</p>\n\";
        \ .= \"<p><strong>Платформа:</strong> {\['system_info']['platform']}</p>\n\";
        \ .= \"<p><strong>Устройство:</strong> {\['system_info']['device_type']}</p>\n\";
        \ .= \"<p><strong>Мобильное:</strong> \" . (\['browser_info']['is_mobile'] ? 'Да' : 'Нет') . \"</p>\n\";
        \ .= \"</div>\n\";
        
        // Куки информация
        \ .= \"<div class='info-group'>\n\";
        \ .= \"<h4>🍪 Данные сессии:</h4>\n\";
        \ .= \"<p><strong>Всего отправок:</strong> {\['cookie_info']['submission_count']}</p>\n\";
        \ .= \"<p><strong>Последняя отправка:</strong> {\['cookie_info']['last_submission']}</p>\n\";
        \ .= \"<p><strong>ID сессии:</strong> {\['cookie_info']['session_id']}</p>\n\";
        \ .= \"</div>\n\";
        
        \ .= \"</div>\n\";
        
        return \;
    }
}

?>
