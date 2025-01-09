<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Configuración inicial para manejar la solicitud
header('Content-Type: application/json'); // Especificar que la respuesta es JSON

// Incluir las clases necesarias
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/User.php';


use App\Models\User;

try {
    // Crear instancia del modelo User
    $userModel = new User();

    // Obtener todos los usuarios
    $users = $userModel->getAll();

    // Responder con los datos de los usuarios en formato JSON
    echo json_encode([
        'success' => true,
        'data' => $users
    ]);
} catch (Exception $e) {
    // Manejar errores y enviar un mensaje JSON de error
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener la lista de usuarios',
        'error' => $e->getMessage()
    ]);
}
