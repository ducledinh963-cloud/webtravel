<?php
$source_images = [
    'news_taybac.png',
    'news_dalat.png',
    'news_sapa.png',
    'news_luangprabang.png',
    'news_caodat.png'
];

$uploads_dir = __DIR__ . '/../uploads/';

for ($i = 1; $i <= 40; $i++) {
    $src_index = ($i - 1) % 5;
    $src_file = $uploads_dir . $source_images[$src_index];
    $dest_file = $uploads_dir . 'news' . $i . '.png';
    
    if (file_exists($src_file)) {
        if (copy($src_file, $dest_file)) {
            echo "Copied news{$i}.png from {$source_images[$src_index]}\n";
        } else {
            echo "Failed to copy news{$i}.png\n";
        }
    } else {
        echo "Source file {$source_images[$src_index]} does not exist!\n";
    }
}
?>
