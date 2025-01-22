<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = sanitizeInput($_POST['title'] ?? '');
    $author = sanitizeInput($_POST['author'] ?? '');
    $genre = sanitizeInput($_POST['genre'] ?? '');
    $year = sanitizeInput($_POST['year'] ?? '');

    // Validar los campos obligatorios
    if (empty($title) || empty($author)) {
        echo json_encode(['success' => false, 'message' => 'Title and Author are required.']);
        exit;
    }

    // Validar el año como un número válido
    if (!empty($year) && (!is_numeric($year) || $year < 0)) {
        echo json_encode(['success' => false, 'message' => 'Invalid year format.']);
        exit;
    }

    try {
        $db = new DBConnection('localhost', 'library', 'root', '');
        $connection = $db->getConnection();

        // Insertar el libro en la base de datos
        $stmt = $connection->prepare('INSERT INTO books (title, author, genre, publication_year, status) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$title, $author, $genre, $year, 'Available']);

        echo json_encode(['success' => true, 'message' => 'Book added successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
    }
}

/**
 * Helper function to sanitize input
 *
 * @param string $input
 * @return string
 */
function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
