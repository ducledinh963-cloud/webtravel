<?php
$content = file_get_contents(__DIR__ . '/../database.sql');
// Find bill_detail or bill table creation schema
if (preg_match('/CREATE TABLE IF NOT EXISTS `bill_detail`\s*\([^)]+\)/is', $content, $matches)) {
    echo $matches[0] . "\n";
} elseif (preg_match('/CREATE TABLE `bill_detail`\s*\([^)]+\)/is', $content, $matches)) {
    echo $matches[0] . "\n";
} else {
    // Just search for occurrences of bill_detail
    echo "No direct CREATE TABLE matching found, showing mentions:\n";
    preg_match_all('/CREATE TABLE.*`bill_detail`.*/i', $content, $matches_lines);
    foreach ($matches_lines[0] as $line) {
        echo $line . "\n";
    }
}
