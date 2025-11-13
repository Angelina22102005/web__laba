<?php
/**
 * Класс для работы с базой данных MySQL
 * Лабораторная работа №5
 */
class Database {
    private $pdo;
    private $error;

    public function __construct() {
        $host = 'db';
        $dbname = 'hackathon_db';
        $username = 'hackathon_user';
        $password = 'hackathon_pass';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            $this->error = "Ошибка подключения к базе данных: " . $e->getMessage();
            error_log($this->error);
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getError() {
        return $this->error;
    }

    public function isConnected() {
        return $this->pdo !== null;
    }

    /**
     * Проверяет существование таблицы
     */
    public function tableExists($tableName) {
        try {
            $result = $this->pdo->query("SELECT 1 FROM $tableName LIMIT 1");
            return $result !== false;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Получает структуру таблицы
     */
    public function getTableStructure($tableName) {
        try {
            $stmt = $this->pdo->query("DESCRIBE $tableName");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>