<?php

require_once '../config.php';

header('Content-Type: application/json');

require_once '../src/Database/DBConnection.php';
require_once '../src/Models/User.php';
require_once '../src/Controller/UserController.php';

use App\Models\User;
use App\Controller\UserController;

try {
    $user = new User();
    $userController = new UserController();


    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'POST') {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'update':
                $userController->updateUser();
                break;

            case 'delete':
                $userController->deleteUser();
                break;

            default:
                echo json_encode(['success' => false, 'message' => 'Invalid action.']);
                break;
        }
    } elseif ($method === 'GET') {

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = max(1, $page);
        $limit = max(1, $limit);
        $offset = ($page - 1) * $limit;


        $users = $user->getPaginated($limit, $offset);
        $totalUsers = $user->getTotalUsers();


        echo json_encode([
            'success' => true,
            'data' => $users,
            'total' => $totalUsers,
            'current_page' => $page,
            'total_pages' => ceil($totalUsers / $limit),
        ]);
    } else {

        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (Exception $e) {

    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
