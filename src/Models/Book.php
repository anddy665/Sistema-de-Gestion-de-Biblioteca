<?php

namespace App\Models;


use App\Database\DBConnection;
use PDO;

class Book
{
    private $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function create($title, $author, $genre, $year)
    {
        $title = $this->sanitizeString($title);
        $author = $this->sanitizeString($author);
        $genre = $this->sanitizeString($genre);
        $year = (int)$year;

        if (!$this->isValidYear($year)) {
            return false;
        }

        try {
            $sql = "INSERT INTO " . BOOK_SLUG . " (title, author, genre, publication_year) VALUES (:title, :author, :genre, :year)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':year', $year);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM " . BOOK_SLUG;
            $stmt = $this->db->connect()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM " . BOOK_SLUG . " WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function update($id, $title, $author, $genre, $year)
    {
        $title = $this->sanitizeString($title);
        $author = $this->sanitizeString($author);
        $genre = $this->sanitizeString($genre);
        $year = (int)$year;

        if (!$this->isValidYear($year)) {
            return false;
        }

        try {
            $sql = "UPDATE " . BOOK_SLUG . " SET title = :title, author = :author, genre = :genre, publication_year = :year WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':year', $year);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM " . BOOK_SLUG . " WHERE id = :id";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }

    private function sanitizeString($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    private function isValidYear($year)
    {
        $currentYear = date("Y");
        return $year > 0 && $year <= $currentYear;
    }

    public function getPaginated($limit, $offset)
    {
        try {
            $sql = "SELECT * FROM " . BOOK_SLUG . " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getTotalBooks()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM " . BOOK_SLUG;
            $stmt = $this->db->connect()->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (\PDOException $e) {
            return 0;
        }
    }
}
