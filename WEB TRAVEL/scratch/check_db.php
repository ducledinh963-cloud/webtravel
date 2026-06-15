<?php
require_once __DIR__ . '/../model/pdo.php';

try {
    $conn = Database::getConnection();
    // Check table count
    $stmt = $conn->query("SELECT COUNT(*) as cnt FROM dukhach");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Tourists count in DB: " . $row['cnt'] . "\n";
    
    // Check some files
    $missing = 0;
    for ($i = 1; $i <= 140; $i++) {
        $file = __DIR__ . '/../uploads/dukhach' . $i . '.svg';
        if (!file_exists($file)) {
            $missing++;
        }
    }
    echo "Missing SVGs: " . $missing . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
