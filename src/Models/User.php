<?php
namespace App\Models;

use App\Database\DBConnection;

class User {
    private $db;

    public function __construct() {
        try {
            // Inicializa la conexión a la base de datos utilizando el método 'connect()'
            $this->db = new DBConnection();
        } catch (\PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    }

    // Crear un nuevo usuario
    public function create($fullName, $email, $phoneNumber) {
        try {
            $sql = "INSERT INTO users (full_name, email, phone_number) VALUES (:full_name, :email, :phone_number)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phoneNumber);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo "Error al crear el usuario: " . $e->getMessage();
            return false;
        }
    }

    // Obtener todos los usuarios
    public function getAll() {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->db->connect()->query($sql);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
            return [];
        }
    }

    // Obtener un usuario por su ID
    public function getById($id) {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (\PDOException $e) {
            echo "Error al obtener el usuario: " . $e->getMessage();
            return null;
        }
    }

      // Actualizar usuario
      public function update($id, $fullName, $email, $phoneNumber) {
        try {
            $sql = "UPDATE users SET full_name = :full_name, email = :email, phone_number = :phone_number WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phoneNumber);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo "Error al actualizar usuario: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar usuario
    public function delete($id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo "Error al eliminar usuario: " . $e->getMessage();
            return false;
        }
    }
}
?>
