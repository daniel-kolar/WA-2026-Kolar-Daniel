<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna</title>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <header class="bg-slate-400 text-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <a href="<?= BASE_URL ?>/index.php">
                <h1 class="text-2xl font-bold tracking-tight text-indigo-300"><img src="<?= BASE_URL ?>/images/logo.svg" alt="Knihovna" class="h-10"></h1>
            </a>
            <nav>
                <ul class="flex flex-wrap items-center gap-2">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php"
                           class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                            Domů
                        </a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Přihlášený uživatel -->
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=book/create"
                               class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                                + Přidat knihu
                            </a>
                        </li>
                        <li>
                            <span class="text-sm text-slate-800 px-2">
                                Přihlášen: <strong class="text-slate-800"><?= htmlspecialchars($_SESSION['username']) ?></strong>
                            </span>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/logout"
                               class="inline-block bg-slate-600 hover:bg-slate-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                                Odhlásit se
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Nepřihlášený uživatel -->
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/login"
                               class="inline-block bg-indigo-500 hover:bg-indigo-400 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                                Přihlásit se
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register"
                               class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                                Registrace
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

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