<?php

use App\Database\DBConnection;

require_once __DIR__ . '/../Database/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $title = sanitizeInput($_POST['title'] ?? '');
    $author = sanitizeInput($_POST['author'] ?? '');
    $genre = sanitizeInput($_POST['genre'] ?? '');
    $year = sanitizeInput($_POST['year'] ?? '');
    $status = trim($_POST['status'] ?? 'Available');


    if (empty($title) || empty($author) || empty($genre) || empty($year)) {
        echo json_encode(['success' => false, 'message' => 'Title, Author, Genre, and Year are required.']);
        exit;
    }


    if (!preg_match('/^\d{4}$/', $year)) {
        echo json_encode(['success' => false, 'message' => 'Invalid year format.']);
        exit;
    }


    $validStatuses = ['Available', 'Borrowed'];
    if (!in_array($status, $validStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid book status.']);
        exit;
    }


    try {

        $db = new DBConnection('localhost', 'library', 'root', '');
        $connection = $db->getConnection();


        $stmt = $connection->prepare('INSERT INTO books (title, author, genre, publication_year, status) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$title, $author, $genre, $year, $status]);

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
