<?php

class Book {
    // Vlastnost pro uložení připojení k databázi ($conn bude vždy instantcí třídy PDO)
    private PDO $conn;
    private $table = 'books';

    // Vlastnosti odpovídající sloupcům v tabulce books v databázi
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
    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Vytvoří nový záznam knihy v databázi a vrátí true/false podle úspěchu operace
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                    (title, author, isbn, year, category, subcategory, price, link, description)
                  VALUES
                    (:title, :author, :isbn, :year, :category, :subcategory, :price, :link, :description)"; // Používáme pojmenované parametry (placeholders) pro bezpečné vkládání dat do DB (ochrana proti SQL injection)
        
        // stmt = statement (příkaz) - Připravíme dotaz pomocí PDO
        $stmt = $this->conn->prepare($query);

        // Ochrana proti XSS – vyčistíme vstupy od HTML tagů a speciálních znaků (před uložením do DB) - tato ochrana je důležitá, protože data z formuláře mohou obsahovat škodlivý kód, který by mohl být spuštěn při zobrazení (např. v seznamu knih).
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->author      = htmlspecialchars(strip_tags($this->author));
        $this->isbn        = htmlspecialchars(strip_tags($this->isbn));
        $this->year        = htmlspecialchars(strip_tags($this->year));
        $this->category    = htmlspecialchars(strip_tags($this->category));
        $this->subcategory = htmlspecialchars(strip_tags($this->subcategory));
        $this->price       = htmlspecialchars(strip_tags($this->price));
        $this->link        = htmlspecialchars(strip_tags($this->link));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Navážeme hodnoty na pojmenované parametry (placeholders) (ochrana proti SQL injection) a provedeme dotaz do DB pomocí PDO 
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

    //WIP - metoda pro získání všech knih z databáze (pro zobrazení v seznamu knih) - dodělat vypis na index.php
    public function getAll() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC"; // Seřadíme knihy podle data vytvoření (nejdříve nejnovější)
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
}
