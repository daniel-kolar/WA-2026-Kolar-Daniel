<?php require_once '../app/views/layout/header.php'; ?>

    <main class="flex-1 max-w-lg mx-auto w-full px-4 py-8">

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">Registrace</h2>
            <p class="text-slate-400 text-sm mt-1">Vytvořte si účet pro přístup do aplikace.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="<?= BASE_URL ?>/index.php?url=auth/storeUser" method="post">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <!-- Uživatelské jméno (povinné) -->
                    <div class="sm:col-span-2">
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-1">
                            Uživatelské jméno <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="username" name="username" required autofocus
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <!-- E-mail (povinný) -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                            E-mail <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <!-- Heslo (povinné) -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                            Heslo <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                               minlength="8"
                               pattern="(?=.*[0-9])(?=.*[A-Z]).{8,}"
                               title="Heslo musí mít alespoň 8 znaků, obsahovat alespoň 1 číslici a 1 velké písmeno."
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                        <p class="text-xs text-slate-400 mt-1">
                            Minimálně 8 znaků &bull; alespoň 1 číslice &bull; alespoň 1 velké písmeno.
                        </p>
                    </div>

                    <!-- Potvrzení hesla (povinné) -->
                    <div>
                        <label for="password_confirm" class="block text-sm font-medium text-slate-700 mb-1">
                            Potvrzení hesla <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password_confirm" name="password_confirm" required
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <!-- Volitelné údaje -->
                    <div class="sm:col-span-2">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 border-t border-slate-100 pt-3">
                            Volitelné údaje
                        </p>
                    </div>

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-slate-700 mb-1">Jméno</label>
                        <input type="text" id="first_name" name="first_name"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-slate-700 mb-1">Příjmení</label>
                        <input type="text" id="last_name" name="last_name"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="nickname" class="block text-sm font-medium text-slate-700 mb-1">Přezdívka</label>
                        <input type="text" id="nickname" name="nickname"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>

                    <!-- Tlačítka -->
                    <div class="sm:col-span-2 flex flex-col sm:flex-row justify-between items-center gap-3 pt-2 border-t border-slate-100">
                        <p class="text-sm text-slate-500">
                            Již máte účet?
                            <a href="<?= BASE_URL ?>/index.php?url=auth/login"
                               class="text-indigo-600 hover:text-indigo-800 font-medium">Přihlaste se</a>
                        </p>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-colors duration-200 shadow-sm">
                            Zaregistrovat se
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </main>

<?php require_once '../app/views/layout/footer.php'; ?>
