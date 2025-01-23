<?php

namespace App\Controller;

use App\Models\Book;
use App\Database\DBConnection;

class BookController
{
    private $bookModel;

    public function __construct(DBConnection $db)
    {
        $this->bookModel = new Book($db);
    }

    public function create($title, $author, $genre, $year, $status)
    {
        return $this->bookModel->create($title, $author, $genre, $year, $status);
    }

    public function getAllBooks()
    {
        return $this->bookModel->getAll();
    }

    public function getBookById($id)
    {
        return $this->bookModel->getById($id);
    }

    public function updateBook()
    {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $year = $_POST['year'] ?? '';
        $status = $_POST['status'] ?? 'Available';

        if ($id && $title && $author && $genre && $year) {
            $success = $this->bookModel->update($id, $title, $author, $genre, $year, $status);
            echo json_encode([
                'success' => $success,
                'message' => $success ? 'Book updated successfully.' : 'Failed to update book.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }

    public function deleteBook()
    {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $success = $this->bookModel->delete($id);
            echo json_encode([
                'success' => $success,
                'message' => $success ? 'Book deleted successfully.' : 'Failed to delete book.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }
}
