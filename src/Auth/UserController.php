<?php
namespace App\Auth;

use App\Models\User;

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Crear un usuario
    public function create($fullName, $email, $phoneNumber) {
        return $this->userModel->create($fullName, $email, $phoneNumber);
    }

    // Obtener todos los usuarios
    public function getAllUsers() {
        return $this->userModel->getAll();
    }

    // Obtener un usuario por ID
    public function getUserById($id) {
        return $this->userModel->getById($id);
    }
}
?>
