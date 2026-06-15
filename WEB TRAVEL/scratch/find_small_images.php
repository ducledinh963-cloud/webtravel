<?php
$dir = __DIR__ . '/../uploads/';
$files = glob($dir . '*');
$small_files = [];
foreach ($files as $file) {
    $size = filesize($file);
    if ($size > 1000 && $size < 150000) { // between 1KB and 150KB
        $small_files[] = [
            'name' => basename($file),
            'size' => round($size / 1024, 2) . ' KB'
        ];
    }
}
usort($small_files, function($a, $b) {
    return (float)$a['size'] <=> (float)$b['size'];
});
echo "Found " . count($small_files) . " small visible files:\n";
print_r(array_slice($small_files, 0, 30));
?>
