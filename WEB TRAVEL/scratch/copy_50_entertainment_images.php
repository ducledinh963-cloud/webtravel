<?php
$source_images = [
    'uploads/hotel_famiana.png',
    'uploads/hotel_alacarte.png',
    'uploads/hotel_gold.png',
    'uploads/hotel_sheraton.png',
    'uploads/hotel_halong.png',
    'uploads/hotel_sapa.png',
    'uploads/hotel_hanoi.png',
    'uploads/hotel_hoian.png',
    'uploads/hotel_saigon.png',
    'uploads/hotel_silkpath.png',
    'uploads/hotel_intercon.png',
    'uploads/hotel_caravelle.png',
    'uploads/tour_korea.png',
    'uploads/tour_dubai.png',
    'uploads/tour_paris.png',
    'uploads/tour_usa.png',
    'uploads/tour_china.png',
    'uploads/tour_europe1.png',
    'uploads/tour_europe2.png',
    'uploads/tour_europe3.png',
    'uploads/tour_europe4.png',
    'uploads/tour_europe5.png',
    'uploads/tour_europe6.png',
    'uploads/tour_europe7.png',
    'uploads/tour_europe8.png',
    'uploads/news1.png',
    'uploads/news2.png',
    'uploads/news3.png',
    'uploads/news4.png',
    'uploads/news5.png'
];

$copied = 0;
$total_sources = count($source_images);

for ($i = 1; $i <= 50; $i++) {
    $dest = __DIR__ . '/../uploads/entertainment' . $i . '.png';
    // Cycle through sources
    $srcIndex = ($i - 1) % $total_sources;
    $src = __DIR__ . '/../' . $source_images[$srcIndex];
    
    if (file_exists($src)) {
        if (copy($src, $dest)) {
            $copied++;
        } else {
            echo "Failed to copy $src to $dest\n";
        }
    } else {
        // Fallback: search for any available png/jpg file in uploads to copy
        $found = false;
        foreach ($source_images as $altSrc) {
            $altSrcFullPath = __DIR__ . '/../' . $altSrc;
            if (file_exists($altSrcFullPath)) {
                if (copy($altSrcFullPath, $dest)) {
                    $copied++;
                    $found = true;
                    break;
                }
            }
        }
        if (!$found) {
            echo "Could not find any source image for entertainment$i.png\n";
        }
    }
}

echo "Successfully copied $copied / 50 entertainment images.\n";
?>
