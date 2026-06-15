<?php
$exists = [];
$missing = [];
for ($i = 1; $i <= 60; $i++) {
    $file = __DIR__ . '/../uploads/seafood' . $i . '.png';
    if (file_exists($file)) {
        $exists[] = $i;
    } else {
        $missing[] = $i;
    }
}
echo "Exists: " . implode(',', $exists) . "\n";
echo "Missing count: " . count($missing) . "\n";
if (!empty($missing)) {
    echo "Missing: " . implode(',', $missing) . "\n";
}
?>
