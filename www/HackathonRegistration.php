<?php
/**
 * Класс для работы с регистрациями на хакатон
 * Лабораторная работа №5
 */
class HackathonRegistration {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    /**
     * Добавляет новую регистрацию в базу данных
     */
    public function addRegistration($data) {
        if (!$this->db->isConnected()) {
            return ['success' => false, 'error' => 'Нет подключения к базе данных'];
        }

        try {
            $sql = "INSERT INTO hackathon_registrations 
                    (full_name, age, email, direction, team_role, previous_experience, workshop, mentoring, newsletter, ip_address, user_agent) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->getConnection()->prepare($sql);
            
            $result = $stmt->execute([
                $data['full_name'],
                $data['age'],
                $data['email'],
                $data['direction'],
                $data['team_role'],
                $data['previous_experience'] ? 1 : 0,
                $data['workshop'] ? 1 : 0,
                $data['mentoring'] ? 1 : 0,
                $data['newsletter'] ? 1 : 0,
                $data['ip_address'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
                $data['user_agent'] ?? $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
            ]);

            if ($result) {
                return [
                    'success' => true,
                    'id' => $this->db->getConnection()->lastInsertId(),
                    'message' => 'Регистрация успешно сохранена в базу данных'
                ];
            } else {
                return ['success' => false, 'error' => 'Ошибка при сохранении данных'];
            }

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return ['success' => false, 'error' => 'Ошибка базы данных: ' . $e->getMessage()];
        }
    }

    /**
     * Получает все регистрации
     */
    public function getAllRegistrations($limit = 100) {
        if (!$this->db->isConnected()) {
            return [];
        }

        try {
            $sql = "SELECT * FROM hackathon_registrations 
                    ORDER BY created_at DESC 
                    LIMIT ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$limit]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Получает регистрацию по ID
     */
    public function getRegistrationById($id) {
        if (!$this->db->isConnected()) {
            return null;
        }

        try {
            $sql = "SELECT * FROM hackathon_registrations WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Получает статистику по направлениям
     */
    public function getDirectionStats() {
        if (!$this->db->isConnected()) {
            return [];
        }

        try {
            $sql = "SELECT direction, COUNT(*) as count 
                    FROM hackathon_registrations 
                    GROUP BY direction 
                    ORDER BY count DESC";
            $stmt = $this->db->getConnection()->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Получает статистику по ролям в команде
     */
    public function getRoleStats() {
        if (!$this->db->isConnected()) {
            return [];
        }

        try {
            $sql = "SELECT team_role, COUNT(*) as count 
                    FROM hackathon_registrations 
                    GROUP BY team_role 
                    ORDER BY count DESC";
            $stmt = $this->db->getConnection()->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Получает общее количество регистраций
     */
    public function getTotalRegistrations() {
        if (!$this->db->isConnected()) {
            return 0;
        }

        try {
            $sql = "SELECT COUNT(*) as total FROM hackathon_registrations";
            $stmt = $this->db->getConnection()->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Удаляет регистрацию по ID
     */
    public function deleteRegistration($id) {
        if (!$this->db->isConnected()) {
            return false;
        }

        try {
            $sql = "DELETE FROM hackathon_registrations WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}
?>