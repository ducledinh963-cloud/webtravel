<?php
$files = [
    __DIR__ . '/../view/cart/checkout.php',
    __DIR__ . '/../view/cart/checkout_success.php',
    __DIR__ . '/../view/cart/my_bookings.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if (strpos($content, 'act=sanphamct') !== false) {
            echo "Found act=sanphamct in " . basename($file) . "\n";
        } else {
            echo "Not found in " . basename($file) . "\n";
        }
    }
}
