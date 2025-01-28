<?php

namespace App\Controller;

use App\Models\User;
use App\Database\DBConnection;

class UserController
{
    private $userModel;

    public function __construct(DBConnection $db)
    {
        $this->userModel = new User($db);
    }

    public function create($fullName, $email, $phoneNumber)
    {
        return $this->userModel->create($fullName, $email, $phoneNumber);
    }

    public function createUser()
    {
        // Sanitize input
        $fullName = $this->sanitizeInput($_POST['full_name'] ?? '');
        $email = $this->sanitizeInput($_POST['email'] ?? '');
        $phoneNumber = $this->sanitizeInput($_POST['phone_number'] ?? '');

        // Validate input
        if (empty($fullName) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Full Name and Email are required.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
            return;
        }

        if (!empty($phoneNumber) && !preg_match('/^\+?[0-9]{10,15}$/', $phoneNumber)) {
            echo json_encode(['success' => false, 'message' => 'Invalid phone number format.']);
            return;
        }

        // Call model to insert the new user
        try {
            $success = $this->userModel->create($fullName, $email, $phoneNumber);
            echo json_encode(['success' => $success, 'message' => $success ? 'User added successfully.' : 'Failed to add user.']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
        }
    }

    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
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
