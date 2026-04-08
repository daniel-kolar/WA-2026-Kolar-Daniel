<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browse@4"></script> -->
    <title>Knihovna - seznam knih</title>
</head>

<body>
    <header>
        <h1>Aplikace knihovna</h1>

        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Domů - seznam knih</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat knihu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Dostupné knihy</h2>
        
        <?php if (empty($books)): ?>
            <p>V databázi se zatím nenachází žádné knihy.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Název knihy</th>
                        <th>Autor</th>
                        <th>Rok vydání</th>
                        <th>Cena</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id']) ?></td>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['year']) ?></td>
                            <td><?= htmlspecialchars($book['price']) ?> Kč</td>
                            <td>
                                <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>">Detail</a> | 
                                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>">Upravit</a> | 
                                <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')">Smazat</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; WA 2026 - jednoduchá PHP aplikace pro správu knih (výukový projekt)</p>
    </footer>
    
</body>
</html>