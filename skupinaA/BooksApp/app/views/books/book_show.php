<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Detail knihy – <?= htmlspecialchars($book['title']) ?></title>
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

    <main class="flex-1 max-w-3xl mx-auto w-full px-4 py-8">

        <a href="<?= BASE_URL ?>/index.php"
           class="inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 mb-5 transition-colors duration-200">
            &larr; Zpět na seznam knih
        </a>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">
                <?= htmlspecialchars($book['title']) ?>
                <span class="text-base font-normal text-slate-400 ml-2">(ID: <?= htmlspecialchars($book['id']) ?>)</span>
            </h2>
            <p class="text-slate-500 mt-1"><?= htmlspecialchars($book['author']) ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Autor</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['author']) ?></dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">ISBN</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['isbn']) ?></dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Kategorie</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['category']) ?></dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Podkategorie</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['subcategory']) ?></dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Rok vydání</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['year']) ?></dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Cena</dt>
                    <dd class="text-slate-800"><?= htmlspecialchars($book['price']) ?> Kč</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Odkaz</dt>
                    <dd class="text-slate-800">
                        <?php if (!empty($book['link'])): ?>
                            <a href="<?= htmlspecialchars($book['link']) ?>"
                               target="_blank" rel="noopener noreferrer"
                               class="text-indigo-600 hover:text-indigo-800 underline break-all">
                                <?= htmlspecialchars($book['link']) ?>
                            </a>
                        <?php else: ?>
                            <span class="text-slate-400 italic">neuvedeno</span>
                        <?php endif; ?>
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-1">Popis</dt>
                    <dd class="text-slate-800 whitespace-pre-line">
                        <?php if (!empty($book['description'])): ?>
                            <?= htmlspecialchars($book['description']) ?>
                        <?php else: ?>
                            <span class="text-slate-400 italic">bez popisu</span>
                        <?php endif; ?>
                    </dd>
                </div>

            </dl>

            <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-slate-100">
                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= htmlspecialchars($book['id']) ?>"
                   class="px-5 py-2 rounded-lg text-sm font-medium bg-amber-500 hover:bg-amber-400 text-white transition-colors duration-200 shadow-sm">
                    Upravit knihu
                </a>
            </div>
        </div>

    </main>

    <footer class="bg-slate-800 text-slate-400 text-center text-sm py-4 mt-auto">
        <p>&copy; WA 2026 – jednoduchá PHP aplikace pro správu knih (výukový projekt)</p>
    </footer>

</body>
</html>
