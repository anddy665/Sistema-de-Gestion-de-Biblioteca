<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $publicationYear = trim($_POST['publication_year'] ?? '');
    $status = trim($_POST['status'] ?? 'Available');

    // Validación de campos obligatorios
    if (empty($title) || empty($author)) {
        echo json_encode(['success' => false, 'message' => 'Title and Author are required.']);
        exit;
    }

    try {
        $db = new DBConnection('localhost', 'library', 'root', '');
        $connection = $db->getConnection();

        $stmt = $connection->prepare('INSERT INTO books (title, author, genre, publication_year, status) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$title, $author, $genre, $publicationYear, $status]);

        echo json_encode(['success' => true, 'message' => 'Book added successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
    }
}
