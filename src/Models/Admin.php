<?php

namespace App\Models;

use App\Database\DBConnection;
use PDO;

class Admin
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = (new DBConnection())->connect();
        } catch (\PDOException $e) {
            error_log('Database connection failed in Admin::__construct: ' . $e->getMessage(), 0);
            exit('Database connection failed. Check the error log for details.');
        }
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
            error_log('Error in Admin::findByUsername for username "' . $username . '": ' . $e->getMessage(), 0);
            return null;
        }
    }

    private function sanitizeString($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
}