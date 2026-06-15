<?php
require_once 'model/pdo.php';

try {
    $conn = pdo_get_connection();
    
    $conn->exec("DROP TABLE IF EXISTS `diemden`");
    
    $conn->exec("CREATE TABLE IF NOT EXISTS `diemden` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `image` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    $conn->exec("INSERT INTO `diemden` (`id`, `name`, `image`) VALUES
    (1, 'HẠ LONG - YÊN TỬ', 'uploads/dest_halong.png'),
    (2, 'SAPA - LÀO CAI', 'uploads/dest_sapa.png'),
    (3, 'HUẾ', 'uploads/dest_hue.png'),
    (4, 'QUẢNG BÌNH', 'uploads/dest_quangbinh.png'),
    (5, 'ĐÀ LẠT', 'uploads/dest_dalat.png'),
    (6, 'ĐÀ NẴNG', 'uploads/dest_danang.png')");
    
    echo "Tạo bảng `diemden` và chèn dữ liệu thành công!\n";
} catch (PDOException $e) {
    die("Lỗi CSDL: " . $e->getMessage() . "\n");
}
?>
