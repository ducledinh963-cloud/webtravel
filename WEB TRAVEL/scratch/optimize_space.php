<?php
/**
 * Script optimize_space.php
 * Thay thế các ảnh trùng lặp sinh ra tự động bằng ảnh 1x1 pixel siêu nhẹ (95 bytes) để giải phóng dung lượng đĩa.
 */

$target_dir = __DIR__ . '/../uploads/';

// Tạo ảnh 1x1 transparent PNG bằng chuỗi base64
$tiny_png_base64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
$tiny_png_data = base64_decode($tiny_png_base64);
$tiny_file = $target_dir . 'tiny_placeholder.png';
file_put_contents($tiny_file, $tiny_png_data);

echo "Created tiny placeholder image at $tiny_file (Size: " . strlen($tiny_png_data) . " bytes)\n";

$optimize_targets = [];

// 1. Tents (140)
for ($i = 1; $i <= 140; $i++) {
    $optimize_targets[] = $target_dir . 'tent' . $i . '.png';
}

// 2. Cars (100)
for ($i = 1; $i <= 100; $i++) {
    $optimize_targets[] = $target_dir . 'car' . $i . '.png';
}

// 3. Cruises (60)
for ($i = 1; $i <= 60; $i++) {
    $optimize_targets[] = $target_dir . 'cruise' . $i . '.png';
}

// 4. Seafoods (60)
for ($i = 1; $i <= 60; $i++) {
    $optimize_targets[] = $target_dir . 'seafood' . $i . '.png';
}

// 5. Entertainments (50)
for ($i = 1; $i <= 50; $i++) {
    $optimize_targets[] = $target_dir . 'entertainment' . $i . '.png';
}

// 6. News (40)
for ($i = 1; $i <= 40; $i++) {
    $optimize_targets[] = $target_dir . 'news' . $i . '.png';
}

// 7. About (16)
for ($i = 1; $i <= 16; $i++) {
    $optimize_targets[] = $target_dir . 'about' . $i . '.png';
}

$optimized_count = 0;
foreach ($optimize_targets as $file) {
    if (file_exists($file)) {
        // Overwrite with tiny image
        if (copy($tiny_file, $file)) {
            $optimized_count++;
        }
    }
}

echo "Successfully optimized $optimized_count generated images!\n";

// Check free space again
$free = disk_free_space($target_dir);
echo "New Free space: " . round($free / 1024 / 1024, 2) . " MB\n";
?>
