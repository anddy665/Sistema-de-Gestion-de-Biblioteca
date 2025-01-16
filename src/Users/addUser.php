<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phoneNumber = trim($_POST['phone_number'] ?? '');


    if (empty($fullName) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Full Name and Email are required.']);
        exit;
    }

    try {

        $db = new DBConnection('localhost', 'library', 'root', '');
        $connection = $db->getConnection();

        $stmt = $connection->prepare('INSERT INTO users (full_name, email, phone_number) VALUES (?, ?, ?)');
        $stmt->execute([$fullName, $email, $phoneNumber]);


        echo json_encode(['success' => true, 'message' => 'User added successfully.']);
    } catch (PDOException $e) {

        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
    }
}
