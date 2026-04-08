<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna – přidat knihu</title>
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

    <main class="flex-1 max-w-2xl mx-auto w-full px-4 py-8">

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">Přidat novou knihu</h2>
            <p class="text-slate-500 mt-1">Vyplňte údaje o knize a uložte je do databáze.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="<?= BASE_URL ?>/index.php?url=book/store" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Název knihy <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-slate-700 mb-1">Autor <span class="text-red-500">*</span></label>
                        <input type="text" id="author" name="author" placeholder="Příjmení Jméno" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="isbn" class="block text-sm font-medium text-slate-700 mb-1">ISBN <span class="text-red-500">*</span></label>
                        <input type="text" id="isbn" name="isbn" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-slate-700 mb-1">Rok vydání <span class="text-red-500">*</span></label>
                        <input type="number" id="year" name="year" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Cena knihy (Kč) <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" step="0.01" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Kategorie</label>
                        <input type="text" id="category" name="category"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-slate-700 mb-1">Podkategorie</label>
                        <input type="text" id="subcategory" name="subcategory"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="link" class="block text-sm font-medium text-slate-700 mb-1">Odkaz (URL)</label>
                        <input type="text" id="link" name="link"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Popis knihy</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition resize-none"></textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Obrázky (lze nahrát více)</label>
                        <label class="flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-lg p-6 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors duration-200">
                            <span class="text-slate-500 text-sm font-medium">Klikni pro výběr souborů</span>
                            <span class="text-slate-400 text-xs mt-1">JPG / PNG / WebP – více souborů najednou</span>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                        </label>
                    </div>

                    <div class="sm:col-span-2 flex justify-end gap-3 pt-2 border-t border-slate-100">
                        <a href="<?= BASE_URL ?>/index.php"
                           class="px-5 py-2 rounded-lg text-sm font-medium border border-slate-300 text-slate-600 hover:bg-slate-100 transition-colors duration-200">
                            Zrušit
                        </a>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors duration-200 shadow-sm">
                            Přidat knihu do DB
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <footer class="bg-slate-800 text-slate-400 text-center text-sm py-4 mt-auto">
        <p>&copy; WA 2026 – jednoduchá PHP aplikace pro správu knih (výukový projekt)</p>
    </footer>

</body>
</html>
