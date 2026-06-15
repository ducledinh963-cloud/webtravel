<?php
$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = '';
$dbname = 'web_travel';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    // Connect to database
    $pdo->exec("USE `$dbname`");
    
    $sql = file_get_contents(__DIR__ . '/database.sql');
    if ($sql === false) {
        die("Could not read database.sql\n");
    }
    
    echo "Executing database.sql into web_travel...\n";
    $pdo->exec($sql);
    echo "Import completed successfully!\n";
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
