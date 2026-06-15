<?php
$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = '';
$dbname = 'web_travel';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Count records
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM nhahang");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total restaurants in database: " . $row['cnt'] . "\n";
    
    // List all records
    $stmt2 = $pdo->query("SELECT id, name, image FROM nhahang ORDER BY id ASC");
    echo "All restaurants:\n";
    while ($r = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo "  ID: {$r['id']} - Name: {$r['name']} - Image: {$r['image']}\n";
    }
} catch (Exception $e) {
    echo "Error querying DB: " . $e->getMessage() . "\n";
}
?>
