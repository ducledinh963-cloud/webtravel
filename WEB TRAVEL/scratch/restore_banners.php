<?php
$brain_dir = 'C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a/';
$uploads_dir = __DIR__ . '/../uploads/';

$b1 = $brain_dir . 'promo_banner1_1781340961697.png';
$b2 = $brain_dir . 'promo_banner2_1781340974923.png';

$dest1 = $uploads_dir . 'promo_banner1.png';
$dest2 = $uploads_dir . 'promo_banner2.png';

echo "Restoring promo_banner1.png...\n";
if (file_exists($b1)) {
    if (copy($b1, $dest1)) {
        echo "Successfully restored promo_banner1.png!\n";
    } else {
        echo "Failed to copy promo_banner1.png\n";
    }
} else {
    echo "Source file $b1 does not exist!\n";
}

echo "Restoring promo_banner2.png...\n";
if (file_exists($b2)) {
    if (copy($b2, $dest2)) {
        echo "Successfully restored promo_banner2.png!\n";
    } else {
        echo "Failed to copy promo_banner2.png\n";
    }
} else {
    echo "Source file $b2 does not exist!\n";
}
?>
