<?php
/**
 * Script seed_dukhach.php
 * Khởi tạo bảng, seed 140 du khách và hình ảnh SVG, đồng bộ vào database.sql
 */

require_once __DIR__ . '/../model/pdo.php';
require_once __DIR__ . '/../model/dukhach.php';

// Tạo cấu trúc bảng SQL
$sql_schema = "
-- --------------------------------------------------------
-- Cấu trúc bảng cho bảng `dukhach`
--
DROP TABLE IF EXISTS `dukhach`;
CREATE TABLE IF NOT EXISTS `dukhach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `passport` varchar(50) DEFAULT NULL,
  `nationality` varchar(100) NOT NULL DEFAULT 'Việt Nam',
  `gender` varchar(10) NOT NULL DEFAULT 'Nam',
  `birthdate` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

$first_names_vn = ['Anh', 'Bảo', 'Cường', 'Dương', 'Đạt', 'Em', 'Giang', 'Hải', 'Hùng', 'Huy', 'Khoa', 'Linh', 'Minh', 'Nam', 'Phong', 'Quân', 'Sơn', 'Tuấn', 'Vinh', 'Vy', 'Yến'];
$middle_names_vn = ['Văn', 'Thị', 'Minh', 'Đức', 'Hữu', 'Hoàng', 'Thành', 'Tuấn', 'Ngọc', 'Phương', 'Khánh'];
$last_names_vn = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];

$names_intl = [
    ['John Smith', 'Mỹ', 'Nam'],
    ['Emma Watson', 'Anh', 'Nữ'],
    ['Pierre Dubois', 'Pháp', 'Nam'],
    ['Yuki Tanaka', 'Nhật Bản', 'Nữ'],
    ['Kim Min-jun', 'Hàn Quốc', 'Nam'],
    ['Hans Schmidt', 'Đức', 'Nam'],
    ['Maria Rossi', 'Ý', 'Nữ'],
    ['David Chen', 'Trung Quốc', 'Nam'],
    ['Sofia Silva', 'Brazil', 'Nữ'],
    ['Dmitry Petrov', 'Nga', 'Nam'],
];

$insert_statements = [];
for ($i = 1; $i <= 140; $i++) {
    if ($i % 10 === 0) {
        $intl = $names_intl[($i / 10 - 1) % count($names_intl)];
        $name = $intl[0];
        $nationality = $intl[1];
        $gender = $intl[2];
    } else {
        $last = $last_names_vn[($i - 1) % count($last_names_vn)];
        $mid = $middle_names_vn[floor(($i - 1) / 2) % count($middle_names_vn)];
        $first = $first_names_vn[($i * 3) % count($first_names_vn)];
        $name = $last . ' ' . $mid . ' ' . $first;
        $nationality = 'Việt Nam';
        $gender = (strpos($mid, 'Thị') !== false || strpos($mid, 'Ngọc') !== false || strpos($mid, 'Phương') !== false) ? 'Nữ' : 'Nam';
    }

    $image_path = 'uploads/dukhach' . $i . '.svg';
    $name_slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $name)));
    $email = $name_slug . $i . '@example.com';
    $phone = '09' . sprintf('%08d', ($i * 713 + 123456) % 100000000);
    
    $birth_year = 1970 + ($i % 35);
    $birth_month = sprintf('%02d', 1 + ($i % 12));
    $birth_day = sprintf('%02d', 1 + ($i % 28));
    $birthdate = "$birth_day/$birth_month/$birth_year";
    
    $passport = 'B' . sprintf('%07d', ($i * 917 + 54321) % 10000000);
    
    $addresses = [
        'Quận 1, TP. Hồ Chí Minh', 'Quận Hoàn Kiếm, Hà Nội', 'Quận Hải Châu, Đà Nẵng',
        'Thành phố Nha Trang, Khánh Hòa', 'Thành phố Quy Nhơn, Bình Định', 'Thành phố Vũng Tàu, Bà Rịa - Vũng Tàu',
        'Thành phố Đà Lạt, Lâm Đồng', 'Thành phố Cần Thơ', 'Thành phố Hạ Long, Quảng Ninh'
    ];
    $address = $addresses[($i - 1) % count($addresses)];

    $name_esc = str_replace("'", "''", $name);
    $email_esc = str_replace("'", "''", $email);
    $phone_esc = str_replace("'", "''", $phone);
    $addr_esc = str_replace("'", "''", $address);
    $passport_esc = str_replace("'", "''", $passport);
    $nat_esc = str_replace("'", "''", $nationality);

    $insert_statements[] = "($i, '$name_esc', '$image_path', '$email_esc', '$phone_esc', '$addr_esc', '$passport_esc', '$nat_esc', '$gender', '$birthdate')";
}

$sql_inserts = "INSERT INTO `dukhach` (`id`, `name`, `image`, `email`, `phone`, `address`, `passport`, `nationality`, `gender`, `birthdate`) VALUES\n" . implode(",\n", $insert_statements) . ";\n";

// 1. Cập nhật database.sql
$db_sql_path = __DIR__ . '/../database.sql';
if (file_exists($db_sql_path)) {
    $db_sql = file_get_contents($db_sql_path);
    
    // Tìm vị trí dukhach cũ để thay thế hoặc nối vào cuối
    $pos = strpos($db_sql, 'DROP TABLE IF EXISTS `dukhach`;');
    if ($pos === false) {
        $pos = strpos($db_sql, '-- Cấu trúc bảng cho bảng `dukhach`');
    }
    
    if ($pos !== false) {
        $db_sql = substr($db_sql, 0, $pos);
    }
    
    $append_sql = "-- Cấu trúc bảng cho bảng `dukhach`\n--\n" . $sql_schema . "\n-- Thêm dữ liệu cho bảng `dukhach`\n" . $sql_inserts;
    file_put_contents($db_sql_path, rtrim($db_sql) . "\n\n" . $append_sql);
    echo "database.sql updated with dukhach schema and 140 seeds!\n";
} else {
    echo "database.sql not found!\n";
}

// 2. Chạy trực tiếp trong MySQL sử dụng 127.0.0.1
try {
    echo "Connecting to MySQL via 127.0.0.1...\n";
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=web_travel;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Running seed140() from model to generate SVGs and database tables...\n";
    // Chúng ta nạp file dukhach.php và gọi seed140()
    dukhach_seed_140();
    echo "Database table 'dukhach' seeded successfully and 140 SVG avatars generated!\n";
} catch (Exception $e) {
    echo "Error running SQL queries: " . $e->getMessage() . "\n";
}
?>
