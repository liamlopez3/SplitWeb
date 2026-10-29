<?php
// Copy this file as inc/db.php and write your credentials.
// inc/db.php is listed in .gitignore and is never uploaded to GitHub.
$host = 'localhost';
$db   = 'splitweb';
$user = 'splitweb';
$pass = 'your_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    error_log("DB connection error: " . $e->getMessage());
    http_response_code(500);
    exit("Internal server error.");
}
unset($pass);
