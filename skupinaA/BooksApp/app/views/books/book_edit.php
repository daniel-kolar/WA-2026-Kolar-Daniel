<?php require_once '../app/views/layout/header.php'; ?>

    <main class="flex-1 max-w-2xl mx-auto w-full px-4 py-8">

        <a href="<?= BASE_URL ?>/index.php"
           class="inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 mb-5 transition-colors duration-200">
            &larr; Zpět na seznam knih
        </a>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">
                Upravit knihu
                <span class="text-base font-normal text-slate-400 ml-2">(ID: <?= htmlspecialchars($book['id']) ?>)</span>
            </h2>
            <p class="text-slate-500 mt-1">
                Upravujete: <strong class="text-slate-700"><?= htmlspecialchars($book['title']) ?></strong>
            </p>
            <p class="text-slate-400 text-sm">Změňte požadované údaje a uložte formulář.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <label for="id_display" class="block text-sm font-medium text-slate-700 mb-1">ID v databázi</label>
                        <input type="text" id="id_display" value="<?= htmlspecialchars($book['id']) ?>" readonly
                               class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-400 bg-slate-50 cursor-not-allowed">
                    </div>

                    <div>
                        <label for="isbn" class="block text-sm font-medium text-slate-700 mb-1">ISBN <span class="text-red-500">*</span></label>
                        <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Název knihy <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-slate-700 mb-1">Autor <span class="text-red-500">*</span></label>
                        <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-slate-700 mb-1">Rok vydání <span class="text-red-500">*</span></label>
                        <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year']) ?>" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Cena knihy (Kč)</label>
                        <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price']) ?>"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Kategorie</label>
                        <input type="text" id="category" name="category" value="<?= htmlspecialchars($book['category']) ?>"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-slate-700 mb-1">Podkategorie</label>
                        <input type="text" id="subcategory" name="subcategory" value="<?= htmlspecialchars($book['subcategory']) ?>"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="link" class="block text-sm font-medium text-slate-700 mb-1">Odkaz (URL)</label>
                        <input type="text" id="link" name="link" value="<?= htmlspecialchars($book['link']) ?>"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Popis knihy</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition resize-none"><?= htmlspecialchars($book['description']) ?></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Obrázky knihy</label>

                        <?php
                        $existingImages = json_decode($book['images'] ?? '[]', true);
                        if (!empty($existingImages)): ?>
                            <div class="mb-3 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                                <p class="text-xs font-semibold text-slate-500 mb-2">Aktuálně uložené obrázky:</p>
                                <ul class="space-y-1">
                                    <?php foreach ($existingImages as $img): ?>
                                        <li class="text-sm text-slate-700">
                                            <?= htmlspecialchars($img) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <p class="text-xs text-amber-600 mt-2 font-medium">
                                    Upozornění: Pokud nyní nahrajete nové soubory, tyto staré budou přepsány.
                                </p>
                            </div>
                        <?php endif; ?>

                        <div class="w-full">
                            <label for="images" class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-600 border-dashed rounded-lg cursor-pointer bg-slate-800/30 hover:bg-slate-700/50 hover:border-blue-400 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <span id="file-title" class="text-sm text-slate-400 font-semibold">Klikni pro výběr souborů</span>
                                    <span id="file-info" class="text-xs text-slate-500 mt-1 text-center px-4">Žádné soubory nebyly vybrány</span>
                                </div>
                                <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                            </label>
                        </div>
                    </div>

                    <div class="sm:col-span-2 flex justify-end gap-3 pt-2 border-t border-slate-100">
                        <a href="<?= BASE_URL ?>/index.php"
                           class="px-5 py-2 rounded-lg text-sm font-medium border border-slate-300 text-slate-600 hover:bg-slate-100 transition-colors duration-200">
                            Zrušit
                        </a>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-white transition-colors duration-200 shadow-sm">
                            Uložit změny do DB
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <script>
            // Najdeme naše HTML prvky podle ID
            const fileInput = document.getElementById('images');
            const fileTitle = document.getElementById('file-title');
            const fileInfo = document.getElementById('file-info');

            // Posloucháme událost 'change' (změna hodnoty v inputu)
            fileInput.addEventListener('change', function(event) {
                const files = event.target.files;
                
                if (files.length === 0) {
                    // Uživatel výběr zrušil
                    fileTitle.textContent = 'Klikněte pro výběr souborů';
                    fileTitle.className = 'text-sm text-slate-400 font-semibold';
                    fileInfo.textContent = 'Žádné soubory nebyly vybrány';
                } else if (files.length === 1) {
                    // Vybrán 1 soubor - ukážeme jeho název
                    fileTitle.textContent = 'Soubor připraven';
                    fileTitle.className = 'text-sm text-blue-400 font-bold';
                    fileInfo.textContent = files[0].name;
                } else {
                    // Vybráno více souborů - ukážeme počet
                    fileTitle.textContent = 'Soubory připraveny';
                    fileTitle.className = 'text-sm text-blue-400 font-bold';
                    fileInfo.textContent = 'Vybráno celkem: ' + files.length + ' souborů';
                }
            });
        </script>
    </main>

    <?php require_once '../app/views/layout/footer.php'; ?>
