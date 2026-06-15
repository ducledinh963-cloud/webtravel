<?php
require_once __DIR__ . '/../model/pdo.php';

try {
    $conn = Database::getConnection();
    $stmt = $conn->query("SELECT * FROM banner WHERE position = 'promo'");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Promo banners count: " . count($rows) . "\n";
    foreach ($rows as $r) {
        echo "- ID: " . $r['id'] . ", Title: " . $r['title'] . ", Image: " . $r['image'] . ", Position: " . $r['position'] . ", URL: " . $r['url'] . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
