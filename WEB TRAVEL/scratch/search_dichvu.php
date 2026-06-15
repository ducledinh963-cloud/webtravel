<?php
function search_in_dir($dir) {
    $files = @scandir($dir);
    if (!$files) return;
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            if ($file === '.git' || $file === '.system_generated' || $file === 'uploads') continue;
            search_in_dir($path);
        } else if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
            $content = file_get_contents($path);
            if (stripos($content, 'dichvu') !== false || stripos($content, 'dịch vụ') !== false) {
                echo "Found in $path\n";
            }
        }
    }
}
search_in_dir('.');
?>
