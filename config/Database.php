<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'empresa';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch(PDOException $e) {
            die("Erro na conexão: " + $e->getMessage());
        }
        return $this->conn;
    }
}
?>