<?php
require_once __DIR__ . '/../model/pdo.php';
require_once __DIR__ . '/../model/touruudai.php';

try {
    echo "Starting seeding for touruudai...\n";
    touruudai_seed();
    echo "Seed completed successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
