<?php
// Thư mục lưu ảnh
$target_dir = "../uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Danh sách 16 URL ảnh chất lượng cao chủ đề du lịch (Unsplash)
$urls = [
    1 => "https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=1200&q=80", // Hạ Long
    2 => "https://images.unsplash.com/photo-1540206395-68808572332f?auto=format&fit=crop&w=1200&q=80", // Phú Quốc
    3 => "https://images.unsplash.com/photo-1509060464153-44667396260f?auto=format&fit=crop&w=1200&q=80", // Sa Pa
    4 => "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=1200&q=80", // Đà Nẵng
    5 => "https://images.unsplash.com/photo-1569154941061-e231b4725ef1?auto=format&fit=crop&w=1200&q=80", // Hội An
    6 => "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80", // Nha Trang
    7 => "https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&w=1200&q=80", // Đà Lạt
    8 => "https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=1200&q=80", // Miền Tây
    9 => "https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=1200&q=80", // Thái Lan
    10 => "https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=1200&q=80", // Singapore
    11 => "https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&q=80", // Hà Nội / Phố cổ
    12 => "https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1200&q=80", // Thuyền trên sông
    13 => "https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1200&q=80", // Bản đồ du lịch
    14 => "https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=1200&q=80", // Biển nhiệt đới
    15 => "https://images.unsplash.com/photo-1473448912268-2022ce9509d8?auto=format&fit=crop&w=1200&q=80", // Rừng núi
    16 => "https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=1200&q=80"  // Cảnh hoàng hôn sông nước
];

echo "Bắt đầu tải xuống 16 hình ảnh cho slide...\n";
foreach ($urls as $index => $url) {
    $filename = "slide" . $index . ".jpg";
    $filepath = $target_dir . $filename;
    
    echo "Đang tải: $filename ... ";
    $content = @file_get_contents($url);
    if ($content !== false) {
        file_put_contents($filepath, $content);
        echo "Thành công!\n";
    } else {
        // Fallback sang Picsum nếu Unsplash bị lỗi
        $fallback_url = "https://picsum.photos/1200/800?random=" . $index;
        $content = @file_get_contents($fallback_url);
        if ($content !== false) {
            file_put_contents($filepath, $content);
            echo "Thành công (fallback Picsum)!\n";
        } else {
            echo "Thất bại!\n";
        }
    }
}
echo "Đã tải xong toàn bộ ảnh mẫu!\n";
?>
