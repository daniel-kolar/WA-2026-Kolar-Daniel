<?php require_once '../app/views/layout/header.php'; ?>

    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-8">

        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="notifications-container mb-6">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php
                        $classes = 'border px-4 py-3 rounded-lg mb-2 font-medium';
                        if ($type === 'success') $classes .= ' bg-green-50 border-green-400 text-green-800';
                        elseif ($type === 'error')   $classes .= ' bg-red-50 border-red-400 text-red-800';
                        elseif ($type === 'notice')  $classes .= ' bg-amber-50 border-amber-400 text-amber-800';
                        else                         $classes .= ' bg-slate-50 border-slate-400 text-slate-800';
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="<?= $classes ?>">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['messages']); ?>
        <?php endif; ?>

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

    <?php require_once '../app/views/layout/footer.php'; ?>
