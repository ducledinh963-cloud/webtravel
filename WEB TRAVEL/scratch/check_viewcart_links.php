<?php
$path = __DIR__ . '/../view/cart/viewcart.php';
if (file_exists($path)) {
    $content = file_get_contents($path);
    preg_match_all('/act=sanphamct[^"]*/i', $content, $matches);
    foreach ($matches[0] as $match) {
        echo htmlspecialchars($match) . "\n";
    }
} else {
    echo "viewcart.php not found!\n";
}
