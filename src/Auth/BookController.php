<?php

namespace App\Books;

use App\Models\Book;

class BookController
{
    private $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function create($title, $author, $genre, $year)
    {
        return $this->bookModel->create($title, $author, $genre, $year);
    }

    public function getAllBooks()
    {
        return $this->bookModel->getAll();
    }
}
