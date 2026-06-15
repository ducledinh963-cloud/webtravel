<?php
require_once __DIR__ . '/../model/pdo.php';
try {
    $count = Database::queryValue("SELECT count(*) FROM leucamtrai");
    echo "Tents count in DB: " . $count . "\n";
} catch (Exception $e) {
    echo "Error checking DB: " . $e->getMessage() . "\n";
}

$missing = 0;
for ($i = 1; $i <= 140; $i++) {
    if (!file_exists(__DIR__ . '/../uploads/tent' . $i . '.png')) {
        $missing++;
    }
}
echo "Missing tent images: " . $missing . "\n";
?>
