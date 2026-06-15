<?php
$lines = file(__DIR__ . '/../view/cart/viewcart.php');
foreach ($lines as $i => $line) {
    if (strpos($line, 'act=sanphamct') !== false) {
        // Show 5 lines before and after
        for ($j = max(0, $i - 5); $j <= min(count($lines) - 1, $i + 5); $j++) {
            echo ($j + 1) . ": " . $lines[$j];
        }
        break;
    }
}
