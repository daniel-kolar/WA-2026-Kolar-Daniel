-- =========================================================
-- Migrace: Přidání tabulky uživatelů a vazby na knihy
-- Spusťte v phpMyAdmin pro databázi: wa_2026_dk_01
-- =========================================================

-- 1. Vytvoření tabulky uživatelů
CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT          AUTO_INCREMENT PRIMARY KEY,
    `username`   VARCHAR(50)  NOT NULL UNIQUE,
    `email`      VARCHAR(100) NOT NULL UNIQUE,
    `password`   VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(50)  DEFAULT NULL,
    `last_name`  VARCHAR(50)  DEFAULT NULL,
    `nickname`   VARCHAR(50)  DEFAULT NULL,
    `created_at` TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Přidání cizích klíčů do tabulky knih (kdo záznam vytvořil / naposledy upravil)
ALTER TABLE `books`
    ADD COLUMN IF NOT EXISTS `created_by` INT DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `updated_by` INT DEFAULT NULL;

ALTER TABLE `books`
    ADD CONSTRAINT `fk_books_created_by`
        FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `fk_books_updated_by`
        FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE SET NULL;
