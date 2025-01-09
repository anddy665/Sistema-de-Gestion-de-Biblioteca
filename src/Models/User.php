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
}
?>
