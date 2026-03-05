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
            <form action="">
                <div>
                    <div>
                        <label for="title">Název knihy:</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div>
                        <label for="author">Autor:</label>
                        <input type="text" id="author" name="author" required>
                    </div>
                    <div>
                        <label for="year">Rok vydání:</label>
                        <input type="number" id="year" name="year" required>
                    </div>
                    <div>
                        <label for="category">Kategorie:</label>
                        <input type="text" id="category" name="category">
                    </div>  
                    <div>
                        <label for="subcategory">Podkategorie:</label>
                        <input type="text" id="subcategory" name="subcategory">
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