<?php
$files = [
    'model/nhahang.php',
    'controllers/admin/RestaurantController.php',
    'admin/nhahang/list.php',
    'admin/nhahang/add.php',
    'admin/nhahang/update.php'
];

foreach ($files as $file) {
    $fullPath = __DIR__ . '/../' . $file;
    if (!file_exists($fullPath)) {
        echo "Missing file: $file\n";
    } else {
        // Run syntax check
        $output = [];
        $return_var = 0;
        exec("php -l " . escapeshellarg($fullPath), $output, $return_var);
        if ($return_var !== 0) {
            echo "Syntax error in $file: " . implode("\n", $output) . "\n";
        } else {
            echo "OK: $file\n";
        }
    }
}
?>
