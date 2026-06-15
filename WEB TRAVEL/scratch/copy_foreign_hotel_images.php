<?php
$artifactDir = 'C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a';
$targetDir = __DIR__ . '/../uploads';

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Locate the two generated images
$tokyoImg = glob($artifactDir . '/hotel_tokyo*.png');
$parisImg = glob($artifactDir . '/hotel_paris*.png');

$tokyoPath = !empty($tokyoImg) ? $tokyoImg[0] : '';
$parisPath = !empty($parisImg) ? $parisImg[0] : '';

echo "Tokyo Image: $tokyoPath\n";
echo "Paris Image: $parisPath\n";

// We will cycle copy them to create hotel_foreign1.png to hotel_foreign10.png
$sources = [];
if ($tokyoPath && file_exists($tokyoPath)) {
    $sources[] = $tokyoPath;
}
if ($parisPath && file_exists($parisPath)) {
    $sources[] = $parisPath;
}

// Fallback to existing hotel images if generated ones are not found
if (empty($sources)) {
    $sources = glob($targetDir . '/hotel*.png');
}
if (empty($sources)) {
    $sources = glob($targetDir . '/hotel*.jpg');
}

if (empty($sources)) {
    die("No source images found for copying!\n");
}

echo "Found " . count($sources) . " source images.\n";

for ($i = 1; $i <= 10; $i++) {
    $src = $sources[($i - 1) % count($sources)];
    $dest = $targetDir . '/hotel_foreign' . $i . '.png';
    if (copy($src, $dest)) {
        echo "Successfully copied " . basename($src) . " to " . basename($dest) . "\n";
    } else {
        echo "Failed to copy to " . basename($dest) . "\n";
    }
}

echo "Completed copying foreign hotel images.\n";
?>
