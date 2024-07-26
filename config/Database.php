<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'email_service';
    private $user = 'postgres';
    private $pass = 'postgres';
    private $port = '5433';    // Update this to your new port number
    private $pdo;

    public function connect() {
        if ($this->pdo === null) {
            try {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
