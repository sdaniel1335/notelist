CREATE TABLE IF NOT EXISTS `users` (
                                       `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                       `username` varchar(100) NOT NULL UNIQUE,
    `password_hash` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT current_timestamp()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- admin / admin
INSERT IGNORE INTO `users` (`username`,`password_hash`) VALUES ('admin','$2y$12$EOg47Nwzf6dRaggt3cx6YuD9v6p.pa.vJy96i1x/ZvsQGBr8uYkNe');