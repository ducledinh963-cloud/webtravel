<?php
$lines = file(__DIR__ . '/../database.sql');
foreach ($lines as $num => $line) {
    if (stripos($line, 'giải trí') !== false) {
        echo "Line " . ($num + 1) . ": " . trim($line) . "\n";
    }
}
?>
