<?php
require_once __DIR__ . '/../model/pdo.php';

try {
    $conn = Database::getConnection();
    // Check if table exists
    $stmt = $conn->query("SHOW TABLES LIKE 'touruudai'");
    if ($stmt->rowCount() > 0) {
        $stmt2 = $conn->query("SELECT COUNT(*) as cnt FROM touruudai");
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        echo "Table touruudai exists with " . $row['cnt'] . " rows.\n";
        
        $stmt3 = $conn->query("SELECT id, name, image, price, price_sale FROM touruudai LIMIT 3");
        while ($r = $stmt3->fetch(PDO::FETCH_ASSOC)) {
            echo "- ID: " . $r['id'] . ", Name: " . $r['name'] . ", Image: " . $r['image'] . ", Price: " . $r['price'] . ", Price Sale: " . $r['price_sale'] . "\n";
        }
    } else {
        echo "Table touruudai does not exist!\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
