<?php
/**
 * Script verify_and_fix.php
 * Kiểm tra hình ảnh và cơ sở dữ liệu cho phần Thuê xe khách du lịch (100 xe)
 */

require_once __DIR__ . '/../model/pdo.php';
require_once __DIR__ . '/../model/thuexe.php';

echo "=== KIỂM TRA HÌNH ẢNH ===\n";
$target_dir = __DIR__ . '/../uploads/';
$missing_images = [];
for ($i = 1; $i <= 100; $i++) {
    $target_image = $target_dir . 'car' . $i . '.png';
    if (!file_exists($target_image)) {
        $missing_images[] = 'car' . $i . '.png';
    }
}

if (empty($missing_images)) {
    echo "Thành công: Đầy đủ 100 hình ảnh car1.png - car100.png trong thư mục uploads/.\n";
} else {
    echo "Phát hiện thiếu " . count($missing_images) . " hình ảnh. Tiến hành tự động tạo...\n";
    
    // Ảnh nguồn mẫu từ uploads/
    $source_candidates = [
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
    ];
    
    // Tìm ảnh thực tế để làm nguồn
    $source_images = [];
    foreach ($source_candidates as $candidate) {
        if (file_exists($candidate)) {
            $source_images[] = $candidate;
        }
    }
    
    if (empty($source_images)) {
        // Dự phòng nếu không tìm thấy, lấy bất kỳ ảnh png nào từ uploads/
        $all_pngs = glob($target_dir . '*.png');
        foreach ($all_pngs as $png) {
            if (basename($png) !== 'car*.png') {
                $source_images[] = $png;
                if (count($source_images) >= 5) break;
            }
        }
    }
    
    if (empty($source_images)) {
        // Tạo ảnh giả lập nhỏ
        echo "Không tìm thấy ảnh nguồn nào, tạo ảnh placeholder...\n";
        for ($i = 1; $i <= 100; $i++) {
            $target_image = $target_dir . 'car' . $i . '.png';
            file_put_contents($target_image, ''); // Empty file just as placeholder
        }
        echo "Đã tạo 100 ảnh placeholder rỗng.\n";
    } else {
        $source_count = count($source_images);
        $copied = 0;
        for ($i = 1; $i <= 100; $i++) {
            $target_image = $target_dir . 'car' . $i . '.png';
            if (!file_exists($target_image)) {
                $src = $source_images[($i - 1) % $source_count];
                if (copy($src, $target_image)) {
                    $copied++;
                }
            }
        }
        echo "Đã tạo/sao chép thành công $copied hình ảnh xe du lịch.\n";
    }
}

echo "\n=== KIỂM TRA CƠ SỞ DỮ LIỆU ===\n";
try {
    $conn = Database::getConnection();
    // Kiểm tra bảng thuexe
    $stmt = $conn->query("SHOW TABLES LIKE 'thuexe'");
    $table_exists = $stmt->rowCount() > 0;
    
    if (!$table_exists) {
        echo "Bảng 'thuexe' chưa tồn tại. Tiến hành tạo và seed...\n";
        thuexe_seed_100();
        echo "Đã tạo và seed bảng 'thuexe' với 100 xe.\n";
    } else {
        $count = Database::queryValue("SELECT count(*) FROM thuexe");
        echo "Số lượng xe hiện có trong bảng 'thuexe': $count\n";
        if ($count < 100) {
            echo "Số lượng xe < 100. Tiến hành nạp lại seed...\n";
            thuexe_seed_100();
            $count = Database::queryValue("SELECT count(*) FROM thuexe");
            echo "Đã nạp lại. Số lượng xe mới: $count\n";
        } else {
            echo "Đầy đủ 100 xe du lịch trong cơ sở dữ liệu.\n";
        }
    }
} catch (Exception $e) {
    echo "Lỗi khi kiểm tra/seed cơ sở dữ liệu: " . $e->getMessage() . "\n";
}

echo "\n=== KIỂM TRA ĐỒNG BỘ database.sql ===\n";
$db_sql_path = __DIR__ . '/../database.sql';
if (file_exists($db_sql_path)) {
    $db_sql = file_get_contents($db_sql_path);
    if (strpos($db_sql, "INSERT INTO `thuexe`") !== false && strpos($db_sql, "car100.png") !== false) {
        echo "Thành công: database.sql đã đồng bộ chứa dữ liệu seed 100 xe.\n";
    } else {
        echo "database.sql chưa chứa dữ liệu seed 100 xe hoặc chưa đầy đủ. Chạy cập nhật database.sql...\n";
        
        // Load seed script to write database.sql
        include_once __DIR__ . '/seed_thuexe_100.php';
    }
} else {
    echo "Cảnh báo: Không tìm thấy file database.sql tại $db_sql_path\n";
}
echo "=== HOÀN THÀNH KIỂM TRA ===\n";
