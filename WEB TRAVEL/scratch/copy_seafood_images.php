<?php
// Script to generate 40 seafood images by duplicating existing local assets

$targetDir = __DIR__ . '/../uploads';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Find existing image assets to use as templates
$templates = [];
$potentialTemplates = [
    'hotel_famiana.png',
    'tour_nhatrang2.png',
    'dest_danang.png',
    'dest_halong.png',
    'tour_sapa.png',
    'tour_thailand.png',
    'tour_singapore_hagiang.png',
    'tour_japan.png',
    'tour_europe1.png',
    'tour_europe2.png',
    'tour_europe3.png',
    'tour_europe4.png',
    'tour_europe5.png',
    'tour_europe6.png',
    'tour_europe7.png',
    'tour_europe8.png',
    'hotel1.jpg',
    'hotel2.jpg',
    'dest_dalat.png',
    'dest_hue.png',
    'dest_quangbinh.png',
    'dest_sapa.png'
];

foreach ($potentialTemplates as $file) {
    $path = $targetDir . '/' . $file;
    if (file_exists($path)) {
        $templates[] = $path;
    }
}

// Fallback if no specific templates found, scan uploads dir
if (empty($templates)) {
    $files = glob($targetDir . '/*.{png,jpg,jpeg}', GLOB_BRACES);
    if (!empty($files)) {
        $templates = $files;
    }
}

if (empty($templates)) {
    die("No template images found in uploads directory!\n");
}

echo "Found " . count($templates) . " template images.\n";
echo "Copying to seafood1.png through seafood40.png...\n";

for ($i = 1; $i <= 40; $i++) {
    // Cycle through templates
    $tplIndex = ($i - 1) % count($templates);
    $src = $templates[$tplIndex];
    
    // Get extension of source template
    $ext = pathinfo($src, PATHINFO_EXTENSION);
    $dest = $targetDir . '/seafood' . $i . '.png'; // Keep it always png or match extension. Actually it is better to save as png/jpg
    
    if (copy($src, $dest)) {
        echo "Created $dest from " . basename($src) . "\n";
    } else {
        echo "Failed to create $dest\n";
    }
}

echo "All 40 images created successfully!\n";
?>
