<?php
/**
 * Script sao chép xoay vòng hình ảnh chất lượng cao thành 60 ảnh xe du lịch car1.png - car60.png
 */

$source_images = [
    __DIR__ . '/../uploads/tour_singapore_hagiang.png',
    __DIR__ . '/../uploads/dest_halong.png',
    __DIR__ . '/../uploads/tour_halong1.png',
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
];

$target_dir = __DIR__ . '/../uploads/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$success_count = 0;
$source_count = count($source_images);

for ($i = 1; $i <= 60; $i++) {
    $source_image = $source_images[($i - 1) % $source_count];
    $target_image = $target_dir . 'car' . $i . '.png';
    
    if (file_exists($source_image)) {
        if (copy($source_image, $target_image)) {
            $success_count++;
        } else {
            echo "Lỗi: Không thể sao chép từ $source_image sang $target_image\n";
        }
    } else {
        echo "Lỗi: Không tìm thấy ảnh nguồn $source_image\n";
    }
}

echo "Thành công: Đã tạo xong $success_count/60 hình ảnh xe du lịch tại thư mục uploads/.\n";
?>
