<?php

class User {
    private PDO $conn;
    private $table = 'users';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Registrace nového uživatele – heslo se ukládá jako bcrypt hash, nikdy v čistém textu
    public function register($username, $email, $password, $firstName = null, $lastName = null, $nickname = null) {
        $sql = "INSERT INTO " . $this->table . "
                    (username, email, password, first_name, last_name, nickname)
                VALUES
                    (:username, :email, :password, :first_name, :last_name, :nickname)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':username'   => htmlspecialchars(strip_tags($username)),
            ':email'      => htmlspecialchars(strip_tags($email)),
            ':password'   => password_hash($password, PASSWORD_DEFAULT),
            ':first_name' => $firstName ? htmlspecialchars(strip_tags($firstName)) : null,
            ':last_name'  => $lastName  ? htmlspecialchars(strip_tags($lastName))  : null,
            ':nickname'   => $nickname  ? htmlspecialchars(strip_tags($nickname))  : null,
        ]);
    }

    // Vyhledání uživatele podle e-mailu – používá se při přihlašování
    public function findByEmail($email) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vyhledání uživatele podle ID – vynechává sloupec password (nikdy ho nepotřebujeme zobrazit)
    public function findById($id) {
        $sql = "SELECT id, username, email, first_name, last_name, nickname, created_at
                FROM " . $this->table . "
                WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
