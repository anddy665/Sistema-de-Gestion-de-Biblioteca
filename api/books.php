<?php

require_once '../config.php';

header('Content-Type: application/json');

require_once '../src/Database/DBConnection.php';
require_once '../src/Models/Book.php';
require_once '../src/Controller/BookController.php';

use App\Models\Book;
use App\Controller\BookController;
use App\Database\DBConnection;

try {
    $dbConnection = new DBConnection();
    $book = new Book($dbConnection);
    $bookController = new BookController($dbConnection);

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'POST') {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'update':
                $bookController->updateBook();
                break;

            case 'delete':
                $bookController->deleteBook();
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

        $books = $book->getPaginated($limit, $offset);
        $totalBooks = $book->getTotalBooks();

        echo json_encode([
            'success' => true,
            'data' => $books,
            'total' => $totalBooks,
            'current_page' => $page,
            'total_pages' => ceil($totalBooks / $limit),
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
