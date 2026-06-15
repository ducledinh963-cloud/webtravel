<?php
require_once __DIR__ . '/../model/pdo.php';

try {
    echo "Starting seeding for promo banners...\n";
    $conn = Database::getConnection();

    // 1. Prepare upload files
    $uploads_dir = __DIR__ . '/../uploads/';
    
    // Four distinct scenery/resort images
    $sources = [
        'tour_europe.png',
        'tour_japan.png',
        'tour_china.png',
        'tour_singapore_hagiang.png'
    ];

    for ($i = 1; $i <= 4; $i++) {
        $src_file = $sources[$i - 1];
        $dest_file = 'promo_banner' . $i . '.png';
        if (file_exists($uploads_dir . $src_file)) {
            copy($uploads_dir . $src_file, $uploads_dir . $dest_file);
            echo "Copied $src_file to $dest_file\n";
        } else {
            echo "Source file $src_file does not exist! Trying fallback...\n";
            $fallback = 'hotel1.jpg';
            if (file_exists($uploads_dir . $fallback)) {
                copy($uploads_dir . $fallback, $uploads_dir . $dest_file);
                echo "Copied fallback $fallback to $dest_file\n";
            }
        }
    }

    // 2. Clear old promo banners and seed new ones
    $conn->exec("DELETE FROM banner WHERE position = 'promo'");
    
    $banners = [
        [
            'id' => 5,
            'title' => 'Tour Nước Ngoài - Giá Từ 6.99Tr',
            'image' => 'uploads/promo_banner1.png',
            'position' => 'promo',
            'url' => 'index.php?act=sanpham'
        ],
        [
            'id' => 6,
            'title' => 'Bộ Sản Phẩm Thế Hệ Mới - ESG & L.E.I',
            'image' => 'uploads/promo_banner2.png',
            'position' => 'promo',
            'url' => 'index.php?act=sanpham'
        ],
        [
            'id' => 7,
            'title' => 'Tour Châu Âu Cao Cấp',
            'image' => 'uploads/promo_banner3.png',
            'position' => 'promo',
            'url' => 'index.php?act=sanpham'
        ],
        [
            'id' => 8,
            'title' => 'Nghỉ Dưỡng Sang Trọng',
            'image' => 'uploads/promo_banner4.png',
            'position' => 'promo',
            'url' => 'index.php?act=sanpham'
        ]
    ];

    $insert_statements = [];
    foreach ($banners as $b) {
        $id = $b['id'];
        $title = str_replace("'", "''", $b['title']);
        $img = $b['image'];
        $pos = $b['position'];
        $url = $b['url'];
        
        $sql = "INSERT INTO banner (id, title, image, position, url) VALUES ($id, '$title', '$img', '$pos', '$url')";
        $conn->exec($sql);
        echo "Inserted banner ID $id\n";
        
        $insert_statements[] = "($id, '$title', '$img', '$pos', '$url')";
    }

    // 3. Update database.sql
    $db_sql_path = __DIR__ . '/../database.sql';
    if (file_exists($db_sql_path)) {
        $db_sql = file_get_contents($db_sql_path);
        
        // Find existing INSERT INTO `banner` where position is 'promo' and remove them to avoid duplicates
        // We will just do a simple replacement or let the seed SQL be appended
        // To be clean, let's append a note and the inserts
        $sql_content = "\n-- ==========================================\n";
        $sql_content .= "-- BẢNG BANNER KHUYẾN MÃI KÉP\n";
        $sql_content .= "-- ==========================================\n";
        $sql_content .= "DELETE FROM `banner` WHERE `position` = 'promo';\n";
        $sql_content .= "INSERT INTO `banner` (`id`, `title`, `image`, `position`, `url`) VALUES\n" . implode(",\n", $insert_statements) . ";\n";
        
        file_put_contents($db_sql_path, $sql_content, FILE_APPEND);
        echo "database.sql updated with new promo banners!\n";
    }

    echo "Promo seeding completed successfully!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
