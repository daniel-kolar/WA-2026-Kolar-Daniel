<?php

class AuthController {

    // --- Pomocné metody pro notifikace ---

    protected function addSuccessMessage($message) {
        $_SESSION['messages']['success'][] = $message;
    }

    protected function addNoticeMessage($message) {
        $_SESSION['messages']['notice'][] = $message;
    }

    protected function addErrorMessage($message) {
        $_SESSION['messages']['error'][] = $message;
    }

    // --- Pomocná metoda pro připojení k DB + načtení modelu ---

    private function getUserModel() {
        require_once '../app/models/Database.php';
        require_once '../app/models/User.php';
        $database = new Database();
        return new User($database->getConnection());
    }

    // 1. Zobrazení registračního formuláře
    public function register() {
        // Přesměrujeme přihlášeného uživatele – registraci nepotřebuje
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
        require_once '../app/views/auth/register.php';
    }

    // 2. Zpracování dat z registračního formuláře
    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->addNoticeMessage('Pro registraci je nutné odeslat formulář.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        $username        = trim($_POST['username']         ?? '');
        $email           = trim($_POST['email']            ?? '');
        $password        = $_POST['password']              ?? '';
        $passwordConfirm = $_POST['password_confirm']      ?? '';
        $firstName       = trim($_POST['first_name']       ?? '');
        $lastName        = trim($_POST['last_name']        ?? '');
        $nickname        = trim($_POST['nickname']         ?? '');

        // Validace povinných polí
        if (empty($username) || empty($email) || empty($password)) {
            $this->addErrorMessage('Uživatelské jméno, e-mail a heslo jsou povinné.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addErrorMessage('Zadejte prosím platnou e-mailovou adresu.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        if ($password !== $passwordConfirm) {
            $this->addErrorMessage('Hesla se neshodují. Zkuste to prosím znovu.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        // Kontrola síly hesla pomocí regulárních výrazů (preg_match)
        // Každé nesplněné pravidlo se přidá do pole chyb, takže uživatel dostane
        // konkrétní zprávu o tom, co jeho heslu chybí.
        $passwordErrors = [];

        if (strlen($password) < 8) {
            $passwordErrors[] = 'alespoň 8 znaků';
        }
        if (!preg_match('/[0-9]/', $password)) {
            // Regulární výraz /[0-9]/ hledá v řetězci alespoň jeden znak z rozsahu 0–9
            $passwordErrors[] = 'alespoň 1 číslici (0–9)';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            // /[A-Z]/ hledá alespoň jedno velké písmeno
            $passwordErrors[] = 'alespoň 1 velké písmeno (A–Z)';
        }

        if (!empty($passwordErrors)) {
            $this->addErrorMessage('Heslo nesplňuje požadavky – musí obsahovat: ' . implode(', ', $passwordErrors) . '.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        $userModel = $this->getUserModel();

        // Kontrola, zda e-mail již není registrován
        if ($userModel->findByEmail($email)) {
            $this->addErrorMessage('Tento e-mail je již registrován. Přihlaste se nebo použijte jiný e-mail.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        $isRegistered = $userModel->register(
            $username,
            $email,
            $password,
            $firstName ?: null,
            $lastName  ?: null,
            $nickname  ?: null
        );

        if ($isRegistered) {
            $this->addSuccessMessage('Registrace proběhla úspěšně. Nyní se můžete přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $this->addErrorMessage('Registraci se nepodařilo dokončit. Zkuste to prosím znovu.');
        header('Location: ' . BASE_URL . '/index.php?url=auth/register');
        exit;
    }

    // 3. Zobrazení přihlašovacího formuláře
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
        require_once '../app/views/auth/login.php';
    }

    // 4. Ověření přihlašovacích údajů a zahájení session
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->addNoticeMessage('Pro přihlášení je nutné odeslat formulář.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        if (empty($email) || empty($password)) {
            $this->addErrorMessage('Zadejte prosím e-mail a heslo.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $userModel = $this->getUserModel();
        $user = $userModel->findByEmail($email);

        // Záměrně vágní chybová zpráva – brání útoku výčtem uživatelských jmen
        if (!$user || !password_verify($password, $user['password'])) {
            $this->addErrorMessage('Nesprávný e-mail nebo heslo.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        // Uložení identity do session
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];

        $this->addSuccessMessage('Vítejte zpět, ' . htmlspecialchars($user['username']) . '!');
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // 5. Odhlášení – smazání uživatelských dat ze session
    public function logout() {
        unset($_SESSION['user_id'], $_SESSION['username']);
        $this->addSuccessMessage('Byli jste úspěšně odhlášeni.');
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}
