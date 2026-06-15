<?php
$uploads_dir = __DIR__ . '/../uploads/';

$categories = [
    'cruise' => [
        'count' => 60,
        'src' => $uploads_dir . 'tour_halong1.png', // 54.5 KB - Beautiful ship/sea background
        'ext' => 'png'
    ],
    'seafood' => [
        'count' => 60,
        'src' => $uploads_dir . 'tour_nhatrang1.png', // 39.3 KB - Sea coast/island
        'ext' => 'png'
    ],
    'entertainment' => [
        'count' => 50,
        'src' => $uploads_dir . 'tour_phuquoc1.png', // 39.3 KB - Tropical beach/resort
        'ext' => 'png'
    ],
    'news' => [
        'count' => 40,
        'src' => $uploads_dir . 'gallery8.jpg', // 20.0 KB - Beautiful travel scenery
        'ext' => 'png'
    ],
    'about' => [
        'count' => 16,
        'src' => $uploads_dir . 'hotel_hagiang2.jpg', // 30.2 KB - Beautiful homestay/resort
        'ext' => 'png'
    ]
];

foreach ($categories as $cat => $config) {
    if (!file_exists($config['src'])) {
        echo "Warning: Source for $cat ({$config['src']}) does not exist. Skipping.\n";
        continue;
    }
    
    echo "Processing $cat: Copying {$config['count']} images from " . basename($config['src']) . " (" . round(filesize($config['src'])/1024, 2) . " KB)...\n";
    $copies = 0;
    for ($i = 1; $i <= $config['count']; $i++) {
        $target = $uploads_dir . $cat . $i . '.' . $config['ext'];
        if (copy($config['src'], $target)) {
            $copies++;
        }
    }
    echo "Successfully copied $copies $cat images.\n";
}

// Check disk space
$free = disk_free_space($uploads_dir);
echo "Remaining free space: " . round($free / 1024 / 1024, 2) . " MB\n";
?>
