<?php
class Database {
    private $host = 'mysql';
    private $db_name = 'gestion_projet';
    private $username = 'user';
    private $password = 'userpass';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
        return $this->conn;
    }
}