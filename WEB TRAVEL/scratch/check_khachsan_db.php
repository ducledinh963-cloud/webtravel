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
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM khachsan");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total hotels in database: " . $row['cnt'] . "\n";
    
    // Count foreign hotels
    $stmt2 = $pdo->query("SELECT COUNT(*) as cnt FROM khachsan WHERE region = 'Nước Ngoài'");
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    echo "Foreign hotels in database: " . $row2['cnt'] . "\n";
    
    // List foreign hotels
    $stmt3 = $pdo->query("SELECT id, name, location, region, image FROM khachsan WHERE region = 'Nước Ngoài' ORDER BY id ASC");
    echo "List of Foreign Hotels:\n";
    while ($r = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        echo "  ID: {$r['id']} - Name: {$r['name']} - Location: {$r['location']} - Region: {$r['region']} - Image: {$r['image']}\n";
        
        // Check if image file exists
        $imgFile = __DIR__ . '/../' . $r['image'];
        if (file_exists($imgFile)) {
            echo "    Image exists!\n";
        } else {
            echo "    ERROR: Image NOT found at $imgFile\n";
        }
    }
} catch (Exception $e) {
    echo "Error querying DB: " . $e->getMessage() . "\n";
}
?>
