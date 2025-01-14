<?php
namespace App\Models;

use App\Database\DBConnection;
use PDO;

class Book {
    private $conn;

    public function __construct() {
        // Crear una instancia de DBConnection
        $dbConnection = new DBConnection();
        // Obtener la conexión a la base de datos
        $this->conn = $dbConnection->getConnection();
    }

    // Get all books
    public function getAll() {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a book by its ID
    public function getById($id) {
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new book
    public function create($title, $author, $genre, $year) {
        $query = "INSERT INTO books (title, author, genre, publication_year) VALUES (:title, :author, :genre, :year)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':year', $year);
        return $stmt->execute();
    }

    // Update book details
    public function update($id, $title, $author, $genre, $year) {
        $query = "UPDATE books SET title = :title, author = :author, genre = :genre, publication_year = :year WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':year', $year);
        return $stmt->execute();
    }

    // Delete a book
    public function delete($id) {
        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
