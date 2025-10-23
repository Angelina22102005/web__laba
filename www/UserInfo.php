<?php
class UserInfo {
    public static function saveSubmissionTime() {
        if (!headers_sent()) {
            setcookie("last_submission", date("Y-m-d H:i:s"), time() + 2592000, "/");
            $count = $_COOKIE["submission_count"] ?? 0;
            setcookie("submission_count", $count + 1, time() + 2592000, "/");
        }
    }

    public static function getLastSubmission() {
        return $_COOKIE["last_submission"] ?? "Никогда";
    }

    public static function getSubmissionCount() {
        return $_COOKIE["submission_count"] ?? 0;
    }

    public static function clearSubmissionCookies() {
        if (!headers_sent()) {
            setcookie("last_submission", "", time() - 3600, "/");
            setcookie("submission_count", "", time() - 3600, "/");
        }
    }

    public static function generateVisitorId() {
        $visitorId = $_COOKIE["visitor_id"] ?? null;
        if (!$visitorId && !headers_sent()) {
            $visitorId = uniqid("visitor_", true);
            setcookie("visitor_id", $visitorId, time() + 31536000, "/");
        }
        return $visitorId;
    }

    public static function getBrowserInfo() {
        $userAgent = $_SERVER["HTTP_USER_AGENT"] ?? "Unknown";
        $browser = "Unknown";
        if (strpos($userAgent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($userAgent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($userAgent, "Safari") !== false) $browser = "Safari";
        elseif (strpos($userAgent, "Edge") !== false) $browser = "Edge";
        
        $os = "Unknown";
        if (strpos($userAgent, "Windows") !== false) $os = "Windows";
        elseif (strpos($userAgent, "Mac") !== false) $os = "macOS";
        elseif (strpos($userAgent, "Linux") !== false) $os = "Linux";
        elseif (strpos($userAgent, "Android") !== false) $os = "Android";
        elseif (strpos($userAgent, "iPhone") !== false) $os = "iOS";

        return [
            "ip_address" => $_SERVER["REMOTE_ADDR"] ?? "Unknown",
            "browser" => $browser,
            "os" => $os,
            "user_agent" => $userAgent,
            "is_mobile" => (strpos($userAgent, "Mobile") !== false || strpos($userAgent, "Android") !== false || strpos($userAgent, "iPhone") !== false),
            "language" => $_SERVER["HTTP_ACCEPT_LANGUAGE"] ?? "Not set",
            "request_time" => date("Y-m-d H:i:s")
        ];
    }

    public static function getFormattedInfo() {
        $info = self::getBrowserInfo();
        $html = "<div class='user-info-section'>";
        $html .= "<h3>Информация о пользователе</h3>";
        $html .= "<div class='info-group'>";
        $html .= "<h4>Сетевые данные:</h4>";
        $html .= "<p><strong>IP-адрес:</strong> " . $info["ip_address"] . "</p>";
        $html .= "</div>";
        $html .= "<div class='info-group'>";
        $html .= "<h4>Браузер и система:</h4>";
        $html .= "<p><strong>Браузер:</strong> " . $info["browser"] . "</p>";
        $html .= "<p><strong>ОС:</strong> " . $info["os"] . "</p>";
        $html .= "<p><strong>Мобильное:</strong> " . ($info["is_mobile"] ? "Да" : "Нет") . "</p>";
        $html .= "</div>";
        $html .= "<div class='info-group'>";
        $html .= "<h4>Данные сессии:</h4>";
        $html .= "<p><strong>Всего отправок:</strong> " . self::getSubmissionCount() . "</p>";
        $html .= "<p><strong>Последняя отправка:</strong> " . self::getLastSubmission() . "</p>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }
}
?>