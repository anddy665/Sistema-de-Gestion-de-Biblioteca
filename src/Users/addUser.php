<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = sanitizeInput($_POST['full_name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phoneNumber = sanitizeInput($_POST['phone_number'] ?? '');


    if (empty($fullName) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Full Name and Email are required.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit;
    }

    if (!empty($phoneNumber) && !preg_match('/^\+?[0-9]{10,15}$/', $phoneNumber)) {
        echo json_encode(['success' => false, 'message' => 'Invalid phone number format.']);
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

/**
 * Helper function to sanitize input
 *
 * @param string 
 * @return string
 */
function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
