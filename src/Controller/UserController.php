<?php

namespace App\Controller;

require_once '../../config.php';
require_once '../Database/DBConnection.php';
require_once '../Models/User.php';


use App\Models\User;
use App\Database\DBConnection;

class UserController
{
    private $userModel;

    public function __construct(DBConnection $db)
    {
        $this->userModel = new User($db);
    }

    public function handleRequest()
    {
        header('Content-Type: application/json');

        try {
            $method = $_SERVER['REQUEST_METHOD'];

            if ($method === 'POST') {
                $action = $_POST['action'] ?? '';

                switch ($action) {
                    case 'create':
                        $this->createUser();
                        break;
                    case 'update':
                        $this->updateUser();
                        break;
                    case 'delete':
                        $this->deleteUser();
                        break;
                    default:
                        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
                }
            } elseif ($method === 'GET') {
                $this->getUsers();
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    private function getUsers()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = max(1, $page);
        $limit = max(1, $limit);
        $offset = ($page - 1) * $limit;

        $users = $this->userModel->getPaginated($limit, $offset);
        $totalUsers = $this->userModel->getTotalUsers();

        echo json_encode([
            'success' => true,
            'data' => $users,
            'total' => $totalUsers,
            'current_page' => $page,
            'total_pages' => ceil($totalUsers / $limit),
        ]);
    }

    private function createUser()
    {
        $fullName = $this->sanitizeInput($_POST['full_name'] ?? '');
        $email = $this->sanitizeInput($_POST['email'] ?? '');
        $phoneNumber = $this->sanitizeInput($_POST['phone_number'] ?? '');

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

        try {
            $success = $this->userModel->create($fullName, $email, $phoneNumber);
            echo json_encode(['success' => $success, 'message' => $success ? 'User added successfully.' : 'Failed to add user.']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
        }
    }

    private function updateUser()
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

    private function deleteUser()
    {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $success = $this->userModel->delete($id);
            echo json_encode(['success' => $success, 'message' => $success ? 'User deleted successfully.' : 'Failed to delete user.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }

    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
}



$dbConnection = new \App\Database\DBConnection();
$userController = new UserController($dbConnection);
$userController->handleRequest();
