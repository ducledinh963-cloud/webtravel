<?php
$content = file_get_contents(__DIR__ . '/../view/home.php');
$lines = explode("\n", $content);
foreach ($lines as $num => $line) {
    if (strpos($line, 'list_promo') !== false || strpos($line, 'promo') !== false) {
        echo ($num + 1) . ": " . trim($line) . "\n";
    }
}
?>
