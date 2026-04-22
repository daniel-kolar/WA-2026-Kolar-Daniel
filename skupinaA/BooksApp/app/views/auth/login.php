<?php require_once '../app/views/layout/header.php'; ?>

    <main class="flex-1 max-w-md mx-auto w-full px-4 py-8">

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">Přihlášení</h2>
            <p class="text-slate-400 text-sm mt-1">Přihlaste se ke svému účtu.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post">
                <div class="flex flex-col gap-5">

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                            E-mail <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required autofocus
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                            Heslo <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 pt-2 border-t border-slate-100">
                        <p class="text-sm text-slate-500">
                            Nemáte účet?
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register"
                               class="text-indigo-600 hover:text-indigo-800 font-medium">Zaregistrujte se</a>
                        </p>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors duration-200 shadow-sm">
                            Přihlásit se
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </main>

<?php require_once '../app/views/layout/footer.php'; ?>
