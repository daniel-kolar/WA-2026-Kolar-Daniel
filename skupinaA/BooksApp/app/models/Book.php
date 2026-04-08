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
    public function create($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $uploadedImages = []) {
        $query = "INSERT INTO " . $this->table . "
                    (title, author, isbn, year, category, subcategory, price, link, description)
                  VALUES
                    (:title, :author, :isbn, :year, :category, :subcategory, :price, :link, :description)"; // Používáme pojmenované parametry (placeholders) pro bezpečné vkládání dat do DB (ochrana proti SQL injection)
        
        // stmt = statement (příkaz) - Připravíme dotaz pomocí PDO
        $stmt = $this->conn->prepare($query);

        // Přiřazení parametrů do vlastností objektu před sanitizací
        $this->title       = $title;
        $this->author      = $author;
        $this->isbn        = $isbn;
        $this->year        = $year;
        $this->category    = $category;
        $this->subcategory = $subcategory;
        $this->price       = $price;
        $this->link        = $link;
        $this->description = $description;

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

    // Získání všech knih z databáze
    public function getAll() {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        // Vrací pole asociativních polí (každý řádek z DB je jedno pole)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Získání jedné konkrétní knihy podle jejího ID
    public function getById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Používá se fetch() místo fetchAll(), protože očekáváme maximálně jeden výsledek.
        // Vrátí asociativní pole s daty knihy, nebo false, pokud kniha neexistuje.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aktualizace existující knihy
    public function update(
        $id, $title, $author, $category, $subcategory, 
        $year, $price, $isbn, $description, $link, $images = []
    ) {
        $sql = "UPDATE books 
                SET title = :title, 
                    author = :author, 
                    category = :category, 
                    subcategory = :subcategory, 
                    year = :year, 
                    price = :price, 
                    isbn = :isbn, 
                    description = :description, 
                    link = :link, 
                    images = :images
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);

        // Parametrů je stejné množství jako u create, navíc je pouze :id
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory ?: null,
            ':year' => $year,
            ':price' => $price,
            ':isbn' => $isbn,
            ':description' => $description,
            ':link' => $link,
            ':images' => json_encode($images)
        ]);
    }

    // Trvalé smazání knihy z databáze
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        // Vrací true při úspěchu, false při chybě
        return $stmt->execute([':id' => $id]);
    }


}
