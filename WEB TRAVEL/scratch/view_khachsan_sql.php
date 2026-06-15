<?php
$sql = file_get_contents(__DIR__ . '/../database.sql');
if ($sql === false) {
    die("Cannot read database.sql");
}

// Find CREATE TABLE `khachsan`
if (preg_match('/CREATE TABLE `khachsan`[^;]+;/', $sql, $matches)) {
    echo "=== TABLE STRUCTURE ===\n";
    echo $matches[0] . "\n\n";
}

// Find INSERT INTO `khachsan`
if (preg_match_all('/INSERT INTO `khachsan`[^;]+;/', $sql, $matches)) {
    echo "=== INSERT QUERIES ===\n";
    foreach ($matches[0] as $match) {
        // Just print first 500 chars of each insert
        echo substr($match, 0, 500) . "...\n";
    }
}
?>
