<?php
// ============================================
// CONFIGURATION BASE DE DONNEES - RENDER
// ============================================

// Détection de l'environnement
$isProduction = isset($_ENV['RENDER']) || isset($_SERVER['RENDER']);

if ($isProduction) {
    // Variables d'environnement Render
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_NAME', getenv('DB_NAME') ?: 'wonderly');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: '');
} else {
    // Configuration locale (XAMPP)
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'wonderly');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        )
    );
} catch(PDOException $e) {
    die("Erreur de connexion a la base de donnees : " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>