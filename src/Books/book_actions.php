<?php
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/Book.php';
require_once '../src/Controller/BookController.php';

use App\Database\DBConnection;
$dbConnection = new DBConnection();
$bookController = new \App\Controller\BookController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $publicationYear = $_POST['year'] ?? null;

        $bookController->create($title, $author, $genre, $publicationYear);
        header("Location: index.php#books");
        exit();
    }
}
