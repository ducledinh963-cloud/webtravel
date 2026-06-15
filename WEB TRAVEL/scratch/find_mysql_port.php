<?php
$ports = [3306, 3307, 3308, 3309];
foreach ($ports as $port) {
    try {
        $pdo = new PDO("mysql:host=127.0.0.1;port=$port;charset=utf8mb4", "root", "");
        echo "SUCCESS: Connected to MySQL on port $port!\n";
        
        // Let's also check if web_travel database exists on this port
        try {
            $pdo->exec("USE web_travel");
            echo "Database 'web_travel' exists on port $port!\n";
        } catch (Exception $e) {
            echo "Database 'web_travel' does not exist on port $port. Error: " . $e->getMessage() . "\n";
        }
        
    } catch (PDOException $e) {
        echo "FAILED: Port $port - " . $e->getMessage() . "\n";
    }
}
?>
