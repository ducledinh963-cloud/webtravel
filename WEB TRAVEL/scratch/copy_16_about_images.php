<?php
/**
 * Script sao chép xoay vòng hình ảnh du lịch thành 16 ảnh cho trang Giới thiệu: about1.png - about16.png
 */

$source_images = [
    __DIR__ . '/../uploads/tour_singapore_hagiang.png',
    __DIR__ . '/../uploads/dest_halong.png',
    __DIR__ . '/../uploads/dest_quangbinh.png',
    __DIR__ . '/../uploads/hotel_famiana.png',
    __DIR__ . '/../uploads/tour_europe1.png',
    __DIR__ . '/../uploads/tour_europe2.png',
    __DIR__ . '/../uploads/tour_europe3.png',
    __DIR__ . '/../uploads/tour_europe4.png',
    __DIR__ . '/../uploads/tour_europe5.png',
    __DIR__ . '/../uploads/tour_europe6.png',
    __DIR__ . '/../uploads/tour_europe7.png',
    __DIR__ . '/../uploads/tour_europe8.png',
    __DIR__ . '/../uploads/hotel_alacarte.png',
    __DIR__ . '/../uploads/hotel_gold.png',
    __DIR__ . '/../uploads/hotel_sheraton.png',
    __DIR__ . '/../uploads/news_luangprabang.png',
    __DIR__ . '/../uploads/news_caodat.png',
];

$target_dir = __DIR__ . '/../uploads/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$success_count = 0;
$source_count = count($source_images);

// Filter existing source images
$existing_sources = [];
foreach ($source_images as $img) {
    if (file_exists($img)) {
        $existing_sources[] = $img;
    }
}

if (empty($existing_sources)) {
    // Fallback if none exists
    $all_pngs = glob($target_dir . '*.png');
    foreach ($all_pngs as $png) {
        $existing_sources[] = $png;
    }
}

if (empty($existing_sources)) {
    echo "Lỗi: Không tìm thấy bất kỳ hình ảnh nguồn nào trong uploads/\n";
    exit(1);
}

$source_count = count($existing_sources);

for ($i = 1; $i <= 16; $i++) {
    $source_image = $existing_sources[($i - 1) % $source_count];
    $target_image = $target_dir . 'about' . $i . '.png';
    
    if (copy($source_image, $target_image)) {
        $success_count++;
    } else {
        echo "Lỗi: Không thể sao chép từ $source_image sang $target_image\n";
    }
}

echo "Thành công: Đã tạo xong $success_count/16 hình ảnh cho trang giới thiệu tại thư mục uploads/.\n";
?>
