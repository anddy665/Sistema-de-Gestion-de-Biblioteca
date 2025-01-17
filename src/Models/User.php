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
            exit;
        }
    }


    public function create($fullName, $email, $phoneNumber)
    {
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
            $sql = "SELECT * FROM users";
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
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (\PDOException $e) {
            return null;
        }
    }


    public function update($id, $fullName, $email, $phoneNumber)
    {
        try {
            $sql = "UPDATE users SET full_name = :full_name, email = :email, phone_number = :phone_number WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
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
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }
}
