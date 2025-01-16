<?php

namespace App\Auth;

use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function create($fullName, $email, $phoneNumber)
    {
        return $this->userModel->create($fullName, $email, $phoneNumber);
    }

    public function getAllUsers()
    {
        return $this->userModel->getAll();
    }

    public function getUserById($id)
    {
        return $this->userModel->getById($id);
    }

    public function updateUser()
    {
        $id = $_POST['id'] ?? null;
        $fullName = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phoneNumber = $_POST['phone_number'] ?? '';

        if ($id && $fullName && $email) {
            $success = $this->userModel->update($id, $fullName, $email, $phoneNumber);
            echo json_encode(['success' => $success, 'message' => $success ? 'User updated successfully.' : 'Failed to update user.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }

    public function deleteUser()
    {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $success = $this->userModel->delete($id);
            echo json_encode(['success' => $success, 'message' => $success ? 'User deleted successfully.' : 'Failed to delete user.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }
}
