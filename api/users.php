<?php

require_once '../config.php';


header('Content-Type: application/json');


require_once '../src/Database/DBConnection.php';
require_once '../src/Models/User.php';
require_once '../src/Controller/UserController.php';

use App\Models\User;
use App\Auth\UserController;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $user = new User();
    $userController = new UserController();

    switch ($action) {
        case 'update':
            $userController->updateUser();
            break;

        case 'delete':
            $userController->deleteUser();
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $user = new User();
        $users = $user->getAll();
        echo json_encode(['success' => true, 'data' => $users]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error retrieving users: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
