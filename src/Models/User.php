<?php

namespace App\Models;

use App\Database\DBConnection;

class User
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new DBConnection();
        } catch (\PDOException $e) {
            exit('Database connection failed: ' . $e->getMessage());
        }
    }

    public function create($fullName, $email, $phoneNumber)
    {

        $fullName = $this->sanitizeString($fullName);
        $email = $this->sanitizeString($email);
        $phoneNumber = $this->sanitizeString($phoneNumber);

        if (!$this->isValidEmail($email) || !$this->isValidPhoneNumber($phoneNumber)) {
            return false;
        }

        try {
            $sql = "INSERT INTO users (full_name, email, phone_number) VALUES (:full_name, :email, :phone_number)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phoneNumber);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM ".USER_SLUG;
            $stmt = $this->db->connect()->query($sql);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function update($id, $fullName, $email, $phoneNumber)
    {

        $fullName = $this->sanitizeString($fullName);
        $email = $this->sanitizeString($email);
        $phoneNumber = $this->sanitizeString($phoneNumber);


        if (!$this->isValidEmail($email) || !$this->isValidPhoneNumber($phoneNumber)) {
            return false;
        }

        try {
            $sql = "UPDATE users SET full_name = :full_name, email = :email, phone_number = :phone_number WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phoneNumber);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }


    private function sanitizeString($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }


    private function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    private function isValidPhoneNumber($phoneNumber)
    {
        return preg_match('/^[0-9\-\+]{7,15}$/', $phoneNumber);
    }
}
