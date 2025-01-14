<?php
require_once '../src/Database/DBConnection.php';
require_once '../src/Models/Book.php';
require_once './src/Auth/BookController.php';

$bookController = new \App\Books\BookController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $year = $_POST['year'];
        $bookController->create($title, $author, $genre, $year);
        header("Location: index.php#books");
        exit();
    }
}
