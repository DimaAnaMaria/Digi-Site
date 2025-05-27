<?php
class Database {
    private static $instance = null;
    private $connection;

    // Configurațiile bazei de date
    private $host = 'localhost:3307';
    private $dbName = 'digi';
    private $username = 'root';
    private $password = '';

    // Constructorul este privat pentru a preveni instanțierea directă
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexiunea la baza de date a eșuat: " . $e->getMessage());
        }
    }

    // Previne clonarea instanței
    private function __clone() {}

    // Previne unserializarea instanței
    public function __wakeup() {}

    // Metodă publică pentru a accesa instanța unică
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Metodă pentru a obține conexiunea PDO
    public function getConnection() {
        return $this->connection;
    }
}
