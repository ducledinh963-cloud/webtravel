<?php
// Script to distribute the 10 AI generated seafood templates to 60 image files in the uploads directory

$artifactDir = 'C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a';
$targetDir = __DIR__ . '/../uploads';

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Find templates in artifact directory
$templates = glob($artifactDir . '/seafood_tpl*.png');

// If for some reason they are not there, try scanning parent/current folder of brain
if (empty($templates)) {
    // Search relative to workspace or AppData
    $templates = glob(__DIR__ . '/seafood_tpl*.png');
}

echo "Found " . count($templates) . " templates in artifact folder.\n";
foreach ($templates as $t) {
    echo "  Template: " . basename($t) . "\n";
}

if (empty($templates)) {
    die("No templates found! Please check the path.\n");
}

// Sort templates to ensure deterministic order (tpl1, tpl2...)
natsort($templates);
$templates = array_values($templates);

echo "Generating seafood1.png to seafood60.png...\n";

for ($i = 1; $i <= 60; $i++) {
    $tplIndex = ($i - 1) % count($templates);
    $src = $templates[$tplIndex];
    $dest = $targetDir . '/seafood' . $i . '.png';
    
    if (copy($src, $dest)) {
        echo "Created seafood$i.png from " . basename($src) . "\n";
    } else {
        echo "Failed to create seafood$i.png\n";
    }
}

echo "All 60 seafood images created successfully!\n";
?>
