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
        $username = $this->sanitizeString($username);

        try {
            $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }


    private function sanitizeString($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
}
