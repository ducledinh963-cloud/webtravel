<?php
$lines = file(__DIR__ . '/../database.sql');
$start = -1;
foreach ($lines as $i => $line) {
    if (strpos($line, 'CREATE TABLE IF NOT EXISTS `bill_detail`') !== false || strpos($line, 'CREATE TABLE `bill_detail`') !== false) {
        $start = $i;
        break;
    }
}

if ($start !== -1) {
    for ($i = $start; $i < $start + 15; $i++) {
        if (isset($lines[$i])) {
            echo $lines[$i];
        }
    }
} else {
    echo "bill_detail CREATE TABLE not found in database.sql\n";
}
