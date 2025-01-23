<?php
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/Book.php';
require_once '../src/Controller/BookController.php';

use App\Database\DBConnection;
use App\Controller\BookController;

$dbConnection = new DBConnection();
$bookController = new BookController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'create') {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $year = $_POST['year'] ?? '';
        $status = $_POST['status'] ?? 'Available';

        $bookController->create($title, $author, $genre, $year, $status);

        header("Location: index.php#books");
        exit();
    }
}
