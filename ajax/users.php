<?php

require_once '../config.php';



// Configuración inicial para manejar la solicitud
header('Content-Type: application/json'); // Especificar que la respuesta es JSON

// Incluir las clases necesarias
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/User.php';

use App\Models\User;

// Verifica el método HTTP de la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $user = new User();

    switch ($action) {
        case 'update':
            $id = $_POST['id'] ?? null;
            $fullName = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phoneNumber = $_POST['phone_number'] ?? '';

            if ($id && $fullName && $email) {
                $success = $user->update($id, $fullName, $email, $phoneNumber);
                echo json_encode(['success' => $success, 'message' => $success ? 'User updated successfully.' : 'Failed to update user.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
            }
            break;

        case 'delete':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $success = $user->delete($id);
                echo json_encode(['success' => $success, 'message' => $success ? 'User deleted successfully.' : 'Failed to delete user.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Manejar solicitudes GET para listar los usuarios
    try {
        $user = new User();
        $users = $user->getAll(); // Método para obtener todos los usuarios
        echo json_encode(['success' => true, 'data' => $users]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error retrieving users: ' . $e->getMessage()]);
    }
} else {
    // Método no soportado
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
