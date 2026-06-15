<?php
$brain_dir = 'C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a/';
$uploads_dir = __DIR__ . '/../uploads/';

// 1. Find generated placeholder files
$tent_files = glob($brain_dir . 'tent_placeholder_*.png');
$car_files = glob($brain_dir . 'car_placeholder_*.png');

if (empty($tent_files) || empty($car_files)) {
    die("Error: Could not find generated placeholder files in brain directory.\n");
}

$tent_src = $tent_files[0];
$car_src = $car_files[0];

echo "Found tent placeholder: $tent_src (Size: " . round(filesize($tent_src)/1024, 2) . " KB)\n";
echo "Found car placeholder: $car_src (Size: " . round(filesize($car_src)/1024, 2) . " KB)\n";

// 2. Perform copy operations
echo "Copying 140 tent images...\n";
$tent_copies = 0;
for ($i = 1; $i <= 140; $i++) {
    $target = $uploads_dir . 'tent' . $i . '.png';
    if (copy($tent_src, $target)) {
        $tent_copies++;
    }
}

echo "Copying 100 car images...\n";
$car_copies = 0;
for ($i = 1; $i <= 100; $i++) {
    $target = $uploads_dir . 'car' . $i . '.png';
    if (copy($car_src, $target)) {
        $car_copies++;
    }
}

echo "Successfully copied $tent_copies tent images and $car_copies car images.\n";

// 3. Check disk space again
$free = disk_free_space($uploads_dir);
echo "Remaining free space: " . round($free / 1024 / 1024, 2) . " MB\n";
?>
