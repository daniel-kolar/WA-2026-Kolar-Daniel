<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <h1>Přidat novou knihu</h1>
            <p>Vyplňte údaje o knize a ulož te je do databáze.</p>
        </div>

        <div>
            <form action="<?= BASE_URL ?>/index.php?url=book/store" method="POST" enctype="multipart/form-data">
                <div>
                    <div>
                        <label for="title">Název knihy*</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div>
                        <label for="author">Autor*</label>
                        <input type="text" id="author" name="author" placeholder="Příjmení Jméno" required>
                    </div>
                    <div>
                        <label for="isbn">ISBN*</label>
                        <input type="text" id="isbn" name="isbn" required>
                    </div>

                    <div>
                        <label for="year">Rok vydání*</label>
                        <input type="number" id="year" name="year" required>
                    </div>

                    <div>
                        <label for="category">Kategorie</label>
                        <input type="text" id="category" name="category">
                    </div>

                    <div>
                        <label for="subcategory">Podkategorie</label>
                        <input type="text" id="subcategory" name="subcategory">
                    </div>

                    <div>
                        <label for="price">Cena knihy*</label>
                        <input type="number" id="price" name="price" step="0.01" required>
                    </div>

                    <div>
                        <label for="link">Odkaz</label>
                        <input type="text" id="link" name="link">
                    </div>

                    <div>
                        <label for="description">Popis knihy</label>
                        <textarea id="description" name="description" rows="5"></textarea>
                    </div>

                    <div>
                        <label>Obrázky (můžete nahrát více)</label>
                        <label>
                            <span>Klikni pro výběr souborů</span>
                            <span>JPG / PNG / WebP – více souborů najednou</span>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                        </label>
                    </div>
            

                    <div>
                        <button type="submit">Přidat knihu od DB</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>