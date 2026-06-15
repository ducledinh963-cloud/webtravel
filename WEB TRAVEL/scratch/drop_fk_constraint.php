<?php
require_once __DIR__ . '/../model/pdo.php';

try {
    $conn = Database::getConnection();
    echo "Attempting to drop foreign key fk_detail_sanpham...\n";
    $conn->exec("ALTER TABLE bill_detail DROP FOREIGN KEY fk_detail_sanpham");
    echo "Success: Foreign key constraint dropped successfully!\n";
} catch (Exception $e) {
    echo "Result: " . $e->getMessage() . "\n";
}

try {
    // Also remove it from database.sql so that new imports don't recreate the constraint
    $db_sql_path = __DIR__ . '/../database.sql';
    if (file_exists($db_sql_path)) {
        $content = file_get_contents($db_sql_path);
        
        // Remove the CONSTRAINT fk_detail_sanpham line
        $pattern = '/,\s*CONSTRAINT\s*`fk_detail_sanpham`[^,\n\r]*/i';
        $content = preg_replace($pattern, '', $content);
        
        file_put_contents($db_sql_path, $content);
        echo "Success: Removed constraint from database.sql!\n";
    }
} catch (Exception $e) {
    echo "Error updating database.sql: " . $e->getMessage() . "\n";
}
