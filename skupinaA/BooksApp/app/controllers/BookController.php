<?php

class BookController {
    // Metoda pro zobrazení seznamu knih (výchozí akce pro tento kontroler)
    public function index() {
        // V dalších krocích se zde přidá komunikace s modelem pro získání dat o knihách z databáze, ale prozatím se zobrazí statická stránka s knihami.
        // (např. načtení všech uloženách knih)

        // Nyní se pouze načte (vloží) připravený soubor s HTML kódem pro zobrazení seznamu knih, který se nachází v adresáři views/books/books_list.php
        require_once '../app/views/books/books_list.php';
    }

    // Zobrazí formulář pro přidání nové knihy
    public function create() {
        require_once '../app/views/books/book_create.php';
    }

    // Zpracuje odeslaný formulář a uloží knihu do databáze
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /skupinaA/BooksApp/public/index.php');
            exit();
        }

        // Načteme Database a Book model
        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';

        // Získáme připojení k databázi
        $database = new Database();
        $db = $database->getConnection();

        // Vytvoříme instanci modelu a naplníme ji daty z formuláře
        $book = new Book($db);
        $book->title       = $_POST['title']       ?? '';
        $book->author      = $_POST['author']      ?? '';
        $book->isbn        = $_POST['isbn']        ?? '';
        $book->year        = $_POST['year']        ?? '';
        $book->category    = $_POST['category']    ?? '';
        $book->subcategory = $_POST['subcategory'] ?? '';
        $book->price       = $_POST['price']       ?? '';
        $book->link        = $_POST['link']        ?? '';
        $book->description = $_POST['description'] ?? '';

        // Zavoláme metodu create() na modelu – ta provede INSERT do DB
        if ($book->create()) {
            // Po úspěšném uložení přesměrujeme na seznam knih
            header('Location: /skupinaA/BooksApp/public/index.php');
            exit();
        } else {
            echo "Nepodařilo se uložit knihu do databáze.";
        }
    }
}