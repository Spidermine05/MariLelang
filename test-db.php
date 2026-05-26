<?php
require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "DB_HOST from .env: " . $_ENV['DB_HOST'] . "\n";
echo "DB_HOST from env(): " . env('DB_HOST') . "\n";
echo "DB_HOST from getenv(): " . getenv('DB_HOST') . "\n";

try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";port=3306;dbname=marilelang",
        "root",
        ""
    );
    echo "Connection successful!\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
