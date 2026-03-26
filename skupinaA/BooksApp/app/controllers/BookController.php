<?php

class BookController {
    // Metoda pro zobrazení seznamu knih (výchozí akce pro tento kontroler)
    public function index() {
        // V dalších krocích se zde přidá komunikace s modelem pro získání dat o knihách z databáze, ale prozatím se zobrazí statická stránka s knihami.
        // (např. načtení všech uloženách knih)

        // Nyní se pouze načte (vloží) připravený soubor s HTML kódem pro zobrazení seznamu knih, který se nachází v adresáři views/books/books_list.php
        require_once '../app/views/books/books_list.php';
    }
}