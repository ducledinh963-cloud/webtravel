<?php
$lines = file('database.sql');
foreach ($lines as $i => $line) {
    if (strpos($line, 'admin') !== false) {
        echo ($i + 1) . ": " . trim($line) . "\n";
    }
}
?>
