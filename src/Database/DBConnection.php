<?php

namespace App\Database;

use PDO;
use PDOException;

class DBConnection
{
    private $host = 'localhost';
    private $dbname = 'library';
    private $user = 'harrisong';
    private $pass = 'root';
    private $connection;

    public function connect()
    {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->connection;
    }
}
