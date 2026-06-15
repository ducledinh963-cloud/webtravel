<?php
$uploads_dir = __DIR__ . '/../uploads/';

// 1. Definition of diverse visible images for each category
$tents_src_pool = [
    'ninhchu_ad.jpg',        // Beach landscape
    'gallery8.jpg',         // Scenery landscape
    'hotel_hagiang2.jpg',    // Homestay cabin
    'tour_nhatrang1.png',    // Sea view
    'tour_phuquoc1.png',     // Tropical beach
    'tour_nhatrang4.png',    // Beach resort
    'tour_quynhon1.png',     // Sandy coast
    'tour_halong1.png',      // Cruise bay
    'tour_nhatrang5.png',    // Sea view 2
    'hotel_hagiang1.jpg',    // Hills landscape
    'tour_hagiang1.png',     // Mountain homestay
    'gallery3.jpg',          // Scenic view
    'tour_mientay1.png',     // Water landscape
    'gallery7.jpg'           // Sea landscape
];

$cars_src_pool = [
    'hotel_hagiang2.jpg',    // Adventure hills
    'tour_dalat1.png',       // Da Lat forest
    'tour_mientay1.png',     // River landscape
    'tour_nhatrang2.png',    // Coastal landscape
    'tour_danang1.png',      // Da Nang cityscape
    'tour_hue1.png',         // Hue historical architecture
    'gallery18.jpg',         // Nature scenic
    'gallery3.jpg',          // Mountain view
    'slide3.jpg',            // Road trip view
    'hotel1.jpg'             // Resort stay
];

$cruises_src_pool = [
    'tour_halong1.png',
    'tour_nhatrang1.png',
    'tour_phuquoc1.png',
    'ninhchu_ad.jpg',
    'tour_nhatrang5.png'
];

$seafoods_src_pool = [
    'hotel1.jpg',
    'hotel2.jpg',
    'hotel3.jpg',
    'hotel4.jpg',
    'hotel5.jpg',
    'hotel6.jpg'
];

$entertainment_src_pool = [
    'tour_phuquoc1.png',
    'tour_nhatrang1.png',
    'ninhchu_ad.jpg',
    'gallery8.jpg',
    'gallery18.jpg'
];

$news_src_pool = [
    'gallery8.jpg',
    'gallery18.jpg',
    'gallery3.jpg',
    'gallery7.jpg'
];

$about_src_pool = [
    'hotel_hagiang2.jpg',
    'hotel_hagiang1.jpg',
    'hotel1.jpg',
    'hotel2.jpg'
];

// Helper function to distribute pool over files
function distribute_pool($cat_name, $count, $pool, $uploads_dir, $ext = 'png') {
    $success = 0;
    $pool_count = count($pool);
    
    // Resolve absolute paths for source pool
    $resolved_pool = [];
    foreach ($pool as $img) {
        $path = $uploads_dir . $img;
        if (file_exists($path)) {
            $resolved_pool[] = $path;
        }
    }
    
    if (empty($resolved_pool)) {
        echo "Error: No valid source images found for category '$cat_name'.\n";
        return 0;
    }
    
    $resolved_count = count($resolved_pool);
    for ($i = 1; $i <= $count; $i++) {
        $src = $resolved_pool[($i - 1) % $resolved_count];
        $target = $uploads_dir . $cat_name . $i . '.' . $ext;
        if (copy($src, $target)) {
            $success++;
        }
    }
    return $success;
}

echo "=== START DIVERSE IMAGE DISTRIBUTION ===\n";

// 2. Perform copy distribution for each category
$tents_copies = distribute_pool('tent', 140, $tents_src_pool, $uploads_dir);
echo "Successfully distributed $tents_copies tent images (using " . count($tents_src_pool) . " source images).\n";

$cars_copies = distribute_pool('car', 100, $cars_src_pool, $uploads_dir);
echo "Successfully distributed $cars_copies car images (using " . count($cars_src_pool) . " source images).\n";

$cruises_copies = distribute_pool('cruise', 60, $cruises_src_pool, $uploads_dir);
echo "Successfully distributed $cruises_copies cruise images (using " . count($cruises_src_pool) . " source images).\n";

$seafoods_copies = distribute_pool('seafood', 60, $seafoods_src_pool, $uploads_dir);
echo "Successfully distributed $seafoods_copies seafood images (using " . count($seafoods_src_pool) . " source images).\n";

$ent_copies = distribute_pool('entertainment', 50, $entertainment_src_pool, $uploads_dir);
echo "Successfully distributed $ent_copies entertainment images.\n";

$news_copies = distribute_pool('news', 40, $news_src_pool, $uploads_dir);
echo "Successfully distributed $news_copies news images.\n";

$about_copies = distribute_pool('about', 16, $about_src_pool, $uploads_dir);
echo "Successfully distributed $about_copies about images.\n";

// 3. Check disk space
$free = disk_free_space($uploads_dir);
echo "=== FINISHED ===\n";
echo "Remaining free space: " . round($free / 1024 / 1024, 2) . " MB\n";
?>
