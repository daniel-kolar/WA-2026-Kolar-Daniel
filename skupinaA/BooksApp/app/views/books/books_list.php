<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna - seznam knih</title>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">

    <header class="bg-slate-800 text-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h1 class="text-2xl font-bold tracking-tight text-indigo-300">📚 Aplikace Knihovna</h1>
            <nav>
                <ul class="flex flex-wrap gap-2">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php"
                           class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                            Domů – seznam knih
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create"
                           class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                            + Přidat knihu
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">
        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Dostupné knihy</h2>

        <?php if (empty($books)): ?>
            <div class="bg-white border border-slate-200 rounded-xl p-8 text-center text-slate-500 shadow-sm">
                <p class="text-lg">V databázi se zatím nenachází žádné knihy.</p>
                <a href="<?= BASE_URL ?>/index.php?url=book/create"
                   class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Přidat první knihu
                </a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-4 py-3 font-semibold">ID</th>
                                <th class="px-4 py-3 font-semibold">Název knihy</th>
                                <th class="px-4 py-3 font-semibold">Autor</th>
                                <th class="px-4 py-3 font-semibold">Rok vydání</th>
                                <th class="px-4 py-3 font-semibold">Cena</th>
                                <th class="px-4 py-3 font-semibold text-center">Akce</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($books as $book): ?>
                                <tr class="hover:bg-indigo-50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-slate-400 font-mono"><?= htmlspecialchars($book['id']) ?></td>
                                    <td class="px-4 py-3 font-medium text-slate-800"><?= htmlspecialchars($book['title']) ?></td>
                                    <td class="px-4 py-3 text-slate-600"><?= htmlspecialchars($book['author']) ?></td>
                                    <td class="px-4 py-3 text-slate-600"><?= htmlspecialchars($book['year']) ?></td>
                                    <td class="px-4 py-3 text-slate-700 font-medium"><?= htmlspecialchars($book['price']) ?> Kč</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap justify-center gap-2">
                                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>"
                                               class="inline-block bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-xs font-medium px-3 py-1 rounded-lg transition-colors duration-200">
                                                Detail
                                            </a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>"
                                               class="inline-block bg-amber-100 hover:bg-amber-200 text-amber-700 text-xs font-medium px-3 py-1 rounded-lg transition-colors duration-200">
                                                Upravit
                                            </a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>"
                                               onclick="return confirm('Opravdu chcete tuto knihu smazat?')"
                                               class="inline-block bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium px-3 py-1 rounded-lg transition-colors duration-200">
                                                Smazat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="mt-3 text-xs text-slate-400 text-right">Celkem knih: <?= count($books) ?></p>
        <?php endif; ?>
    </main>

    <footer class="bg-slate-800 text-slate-400 text-center text-sm py-4 mt-auto">
        <p>&copy; WA 2026 – jednoduchá PHP aplikace pro správu knih (výukový projekt)</p>
    </footer>

</body>
</html>
