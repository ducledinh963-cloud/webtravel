<?php
$uploads_dir = __DIR__ . '/../uploads/';

// Check if source files exist
$tent_src = $uploads_dir . 'ninhchu_ad.jpg';
$car_src = $uploads_dir . 'hotel_hagiang2.jpg';

if (!file_exists($tent_src)) {
    die("Error: Source tent image $tent_src does not exist.\n");
}
if (!file_exists($car_src)) {
    die("Error: Source car image $car_src does not exist.\n");
}

echo "Source tent image: $tent_src (Size: " . round(filesize($tent_src)/1024, 2) . " KB)\n";
echo "Source car image: $car_src (Size: " . round(filesize($car_src)/1024, 2) . " KB)\n";

// Copy tent images
echo "Copying 140 tent images...\n";
$tent_copies = 0;
for ($i = 1; $i <= 140; $i++) {
    $target = $uploads_dir . 'tent' . $i . '.png';
    if (copy($tent_src, $target)) {
        $tent_copies++;
    }
}

// Copy car images
echo "Copying 100 car images...\n";
$car_copies = 0;
for ($i = 1; $i <= 100; $i++) {
    $target = $uploads_dir . 'car' . $i . '.png';
    if (copy($car_src, $target)) {
        $car_copies++;
    }
}

echo "Successfully copied $tent_copies tent images and $car_copies car images.\n";

// Check disk space
$free = disk_free_space($uploads_dir);
echo "Remaining free space: " . round($free / 1024 / 1024, 2) . " MB\n";
?>
