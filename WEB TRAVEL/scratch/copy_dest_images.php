<?php
$copies = [
    'uploads/tour_europe.png' => 'uploads/fav_uk.png',
    'uploads/tour_trungau4.png' => 'uploads/fav_germany.png',
    'uploads/tour_paris.png' => 'uploads/fav_france.png',
    'uploads/tour_dubai.png' => 'uploads/fav_india.png',
    'uploads/dest_danang.png' => 'uploads/fav_vietnam.png',
    'uploads/tour_europe2.png' => 'uploads/fav_italy.png',
    'uploads/tour_japan.png' => 'uploads/fav_japan.png',
    'uploads/tour_china.png' => 'uploads/fav_china.png',
    'uploads/dest_danang.png' => 'uploads/tour_danang_he.png'
];

foreach ($copies as $src => $dest) {
    if (file_exists($src)) {
        if (copy($src, $dest)) {
            echo "Copied $src to $dest\n";
        } else {
            echo "Failed to copy $src to $dest\n";
        }
    } else {
        echo "Source file $src not found\n";
    }
}
?>
