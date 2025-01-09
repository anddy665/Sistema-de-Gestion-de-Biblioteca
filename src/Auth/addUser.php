<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y limpiar los datos del formulario
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phoneNumber = trim($_POST['phone_number'] ?? '');

    // Validación de campos obligatorios
    if (empty($fullName) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Full Name and Email are required.']);
        exit;
    }

    try {
        // Configura la conexión a la base de datos
        $db = new DBConnection('localhost', 'library', 'root', ''); // Ajusta las credenciales si es necesario
        $connection = $db->getConnection();

        // Preparar e insertar los datos en la tabla
        $stmt = $connection->prepare('INSERT INTO users (full_name, email, phone_number) VALUES (?, ?, ?)');
        $stmt->execute([$fullName, $email, $phoneNumber]);

        // Respuesta exitosa
        echo json_encode(['success' => true, 'message' => 'User added successfully.']);
    } catch (PDOException $e) {
        // Manejo de errores
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
    }
}
