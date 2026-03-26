<?php

class Book {
    private $conn;
    private $table = 'books';

    // Vlastnosti odpovídající sloupcům v tabulce
    public $title;
    public $author;
    public $isbn;
    public $year;
    public $category;
    public $subcategory;
    public $price;
    public $link;
    public $description;

    // Přijmeme připojení k DB v konstruktoru (dependency injection)
    public function __construct($db) {
        $this->conn = $db;
    }

    // Vytvoří nový záznam knihy v databázi
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                    (title, author, isbn, year, category, subcategory, price, link, description)
                  VALUES
                    (:title, :author, :isbn, :year, :category, :subcategory, :price, :link, :description)";

        $stmt = $this->conn->prepare($query);

        // Ochrana proti XSS – vyčistíme vstupy
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->author      = htmlspecialchars(strip_tags($this->author));
        $this->isbn        = htmlspecialchars(strip_tags($this->isbn));
        $this->year        = htmlspecialchars(strip_tags($this->year));
        $this->category    = htmlspecialchars(strip_tags($this->category));
        $this->subcategory = htmlspecialchars(strip_tags($this->subcategory));
        $this->price       = htmlspecialchars(strip_tags($this->price));
        $this->link        = htmlspecialchars(strip_tags($this->link));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Navážeme hodnoty na pojmenované parametry (ochrana proti SQL injection)
        $stmt->bindParam(':title',       $this->title);
        $stmt->bindParam(':author',      $this->author);
        $stmt->bindParam(':isbn',        $this->isbn);
        $stmt->bindParam(':year',        $this->year);
        $stmt->bindParam(':category',    $this->category);
        $stmt->bindParam(':subcategory', $this->subcategory);
        $stmt->bindParam(':price',       $this->price);
        $stmt->bindParam(':link',        $this->link);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
