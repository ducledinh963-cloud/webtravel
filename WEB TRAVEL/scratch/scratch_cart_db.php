<?php
require_once dirname(__DIR__) . '/model/pdo.php';

try {
    $conn = Database::getConnection();
    
    // Create bill table
    $sql_bill = "CREATE TABLE IF NOT EXISTS `bill` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `bill_code` varchar(50) NOT NULL UNIQUE,
      `id_user` int(11) DEFAULT NULL,
      `bill_name` varchar(255) NOT NULL,
      `bill_email` varchar(100) NOT NULL,
      `bill_phone` varchar(20) NOT NULL,
      `bill_address` varchar(255) NOT NULL,
      `bill_pttt` int(11) NOT NULL DEFAULT 0, -- 0: Chuyển khoản, 1: Trực tiếp khi đi tour
      `bill_total` double NOT NULL DEFAULT 0,
      `bill_status` int(11) NOT NULL DEFAULT 0, -- 0: Chờ xác nhận, 1: Đang chuẩn bị, 2: Đã khởi hành, 3: Đã huỷ
      `date_booking` varchar(50) NOT NULL,
      PRIMARY KEY (`id`),
      CONSTRAINT `fk_bill_taikhoan` FOREIGN KEY (`id_user`) REFERENCES `taikhoan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $conn->exec($sql_bill);
    echo "Table 'bill' created successfully!\n";

    // Create bill_detail table
    $sql_detail = "CREATE TABLE IF NOT EXISTS `bill_detail` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `id_bill` int(11) NOT NULL,
      `id_pro` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `image` varchar(255) NOT NULL,
      `price` double NOT NULL DEFAULT 0,
      `quantity` int(11) NOT NULL DEFAULT 1,
      `total` double NOT NULL DEFAULT 0,
      PRIMARY KEY (`id`),
      CONSTRAINT `fk_detail_bill` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT `fk_detail_sanpham` FOREIGN KEY (`id_pro`) REFERENCES `sanpham` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $conn->exec($sql_detail);
    echo "Table 'bill_detail' created successfully!\n";
    
    echo "Database upgraded successfully!\n";
} catch (Exception $e) {
    die("Database upgrade failed: " . $e->getMessage() . "\n");
}
?>
