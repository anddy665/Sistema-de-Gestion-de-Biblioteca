<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración inicial para manejar la solicitud
header('Content-Type: application/json'); // Especificar que la respuesta es JSON

// Incluir las clases necesarias
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/Book.php';

use App\Models\Book;

// Verifica el método HTTP de la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $book = new Book();

    switch ($action) {
        case 'update':
            $id = $_POST['id'] ?? null;
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $publicationYear = $_POST['publication_year'] ?? '';
            $status = $_POST['status'] ?? '';

            if ($id && $title && $author && $genre && $publicationYear) {
                $success = $book->update($id, $title, $author, $genre, $publicationYear, $status);
                echo json_encode(['success' => $success, 'message' => $success ? 'Book updated successfully.' : 'Failed to update book.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
            }
            break;

        case 'delete':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $success = $book->delete($id);
                echo json_encode(['success' => $success, 'message' => $success ? 'Book deleted successfully.' : 'Failed to delete book.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Manejar solicitudes GET para listar los libros
    try {
        $book = new Book();
        $books = $book->getAll(); // Método para obtener todos los libros
        echo json_encode(['success' => true, 'data' => $books]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error retrieving books: ' . $e->getMessage()]);
    }
} else {
    // Método no soportado
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
