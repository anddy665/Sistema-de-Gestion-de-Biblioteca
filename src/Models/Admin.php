<?php

namespace App\Models;

use App\Database\DBConnection;
use PDO;

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBConnection())->connect();
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
