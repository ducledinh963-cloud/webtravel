<?php
require_once 'model/pdo.php';

try {
    $db = Database::getConnection();
    
    // Fetch all accounts from database
    $accounts = $db->query("SELECT * FROM taikhoan ORDER BY id ASC")->fetchAll();
    
    $inserts = [];
    foreach ($accounts as $acc) {
        $id = $acc['id'];
        $username = $acc['username'];
        $password = $acc['password']; // This is the correct, uncorrupted hash from DB
        $email = $acc['email'];
        $phone = $acc['phone'] === null ? 'NULL' : "'" . $acc['phone'] . "'";
        $role = $acc['role'];
        
        $inserts[] = "({$id}, '{$username}', '{$password}', '{$email}', {$phone}, {$role})";
    }
    
    $insert_statement = "INSERT INTO `taikhoan` (`id`, `username`, `password`, `email`, `phone`, `role`) VALUES\n" . implode(",\n", $inserts) . ";";
    
    $sql_file = 'database.sql';
    if (file_exists($sql_file)) {
        $sql_content = file_get_contents($sql_file);
        
        // 1. Replace CREATE TABLE IF NOT EXISTS `taikhoan` block to be clean and correct
        $create_pattern = '/CREATE TABLE IF NOT EXISTS `taikhoan` \([\s\S]*?\) ENGINE=InnoDB[\s\S]*?;/';
        $new_create = "CREATE TABLE IF NOT EXISTS `taikhoan` (\n" .
                      "  `id` int(11) NOT NULL AUTO_INCREMENT,\n" .
                      "  `username` varchar(50) NOT NULL UNIQUE,\n" .
                      "  `password` varchar(255) NOT NULL,\n" .
                      "  `email` varchar(100) NOT NULL UNIQUE,\n" .
                      "  `phone` varchar(20) DEFAULT NULL UNIQUE,\n" .
                      "  `role` int(11) NOT NULL DEFAULT 0,\n" .
                      "  PRIMARY KEY (`id`)\n" .
                      ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                      
        if (preg_match($create_pattern, $sql_content)) {
            $sql_content = preg_replace($create_pattern, $new_create, $sql_content);
            echo "Updated CREATE TABLE `taikhoan` in database.sql.\n";
        } else {
            echo "Warning: Could not find CREATE TABLE `taikhoan` block.\n";
        }
        
        // 2. Replace INSERT INTO `taikhoan` block
        $insert_pattern = '/INSERT INTO `taikhoan` \(`id`, `username`, `password`, `email`, `phone`, `role`[\s\S]*?;\s*/';
        if (preg_match($insert_pattern, $sql_content)) {
            $sql_content = preg_replace($insert_pattern, $insert_statement . "\n\n", $sql_content);
            echo "Updated INSERT INTO `taikhoan` in database.sql.\n";
        } else {
            echo "Warning: Could not find INSERT INTO `taikhoan` block.\n";
        }
        
        file_put_contents($sql_file, $sql_content);
        echo "database.sql fixed and updated successfully.\n";
    } else {
        echo "ERROR: database.sql not found!\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
