<?php
require_once 'pdo.php';

/**
 * Lớp TourUuDaiModel quản lý các truy vấn bảng tour ưu đãi giá tốt (touruudai)
 */
class TourUuDaiModel {
    /**
     * Lấy tất cả tour ưu đãi
     */
    public static function selectAll() {
        $sql = "SELECT * FROM touruudai ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết tour ưu đãi theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM touruudai WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm tour ưu đãi mới
     */
    public static function insert($name, $image, $discount, $transport, $departure, $duration, $price, $price_sale, $rating = 5) {
        $sql = "INSERT INTO touruudai (name, image, discount, transport, departure, duration, price, price_sale, rating) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $discount, $transport, $departure, $duration, $price, $price_sale, $rating]);
    }

    /**
     * Cập nhật thông tin tour ưu đãi
     */
    public static function update($id, $name, $image, $discount, $transport, $departure, $duration, $price, $price_sale, $rating) {
        $sql = "UPDATE touruudai SET name = ?, image = ?, discount = ?, transport = ?, departure = ?, duration = ?, price = ?, price_sale = ?, rating = ? 
                WHERE id = ?";
        Database::execute($sql, [$name, $image, $discount, $transport, $departure, $duration, $price, $price_sale, $rating, $id]);
    }

    /**
     * Xóa tour ưu đãi theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM touruudai WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Tự động khởi tạo và seed dữ liệu tour ưu đãi giá tốt
     */
    public static function seed() {
        $sql_schema = "
        DROP TABLE IF EXISTS `touruudai`;
        CREATE TABLE IF NOT EXISTS `touruudai` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `image` varchar(255) NOT NULL,
          `discount` varchar(20) NOT NULL,
          `transport` varchar(100) NOT NULL,
          `departure` varchar(100) NOT NULL,
          `duration` varchar(100) NOT NULL,
          `price` double NOT NULL DEFAULT 0,
          `price_sale` double NOT NULL DEFAULT 0,
          `rating` float NOT NULL DEFAULT 5,
          `views` int(11) NOT NULL DEFAULT 0,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        Database::getConnection()->exec($sql_schema);

        // Copy 12 unique scenery/hotel images for the 12 deal tours to make sure they are distinct
        $uploads_dir = __DIR__ . '/../uploads/';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        // Available scenic and hotel source images on disk
        $sources = [
            'tour_china.png',
            'tour_japan.png',
            'tour_europe.png',
            'tour_korea.png',
            'tour_paris.png',
            'tour_usa.png',
            'tour_singapore_hagiang.png',
            'tour_mucangchai.png',
            'tour_trangan.png',
            'tour_quynhon.png',
            'tour_phongnha.png',
            'tour_hue.png'
        ];

        // Ensure we copy distinct images
        for ($i = 1; $i <= 12; $i++) {
            $src_file = $sources[($i - 1) % count($sources)];
            $dest_file = 'uudai' . $i . '.png';
            if (file_exists($uploads_dir . $src_file)) {
                copy($uploads_dir . $src_file, $uploads_dir . $dest_file);
            } else {
                // Fallback to copying standard image if some don't exist
                $fallback = 'hotel1.jpg';
                if (file_exists($uploads_dir . $fallback)) {
                    copy($uploads_dir . $fallback, $uploads_dir . $dest_file);
                }
            }
        }

        $tours = [
            [
                'name' => 'Tour Hà Khẩu - Đại Lý - Lệ Giang - Côn Minh 6 Ngày 5 Đêm',
                'image' => 'uploads/uudai1.png',
                'discount' => '-15%',
                'transport' => 'bus',
                'departure' => 'Thứ 3 hàng tuần',
                'duration' => '5 ngày 5 đêm',
                'price' => 11750000,
                'price_sale' => 9990000,
                'rating' => 5,
                'views' => 245
            ],
            [
                'name' => 'Tour Thượng Hải - Hàng Châu - Ô Trấn 5N4Đ Cao Cấp',
                'image' => 'uploads/uudai2.png',
                'discount' => '-20%',
                'transport' => 'bus, plane',
                'departure' => 'Linh hoạt',
                'duration' => '5 ngày 4 đêm',
                'price' => 23990000,
                'price_sale' => 19290000,
                'rating' => 4.8,
                'views' => 412
            ],
            [
                'name' => 'Tour Tây An Trung Quốc 5 ngày 4 đêm No Shopping',
                'image' => 'uploads/uudai3.png',
                'discount' => '-13%',
                'transport' => 'bus, plane',
                'departure' => 'Linh hoạt',
                'duration' => '5 ngày 4 đêm',
                'price' => 20990000,
                'price_sale' => 18290000,
                'rating' => 4.9,
                'views' => 189
            ],
            [
                'name' => 'Tour Hà Nội - Hà Khẩu - Đại Lý - Côn Minh 5N4Đ Khởi Hành Hàng Tuần',
                'image' => 'uploads/uudai4.png',
                'discount' => '-13%',
                'transport' => 'bus',
                'departure' => 'Thứ 4 hàng tuần',
                'duration' => '5 ngày 4 đêm',
                'price' => 8290000,
                'price_sale' => 7190000,
                'rating' => 4.7,
                'views' => 322
            ],
            [
                'name' => 'Tour Hà Khẩu - Côn Minh 4N4Đ Trượt tuyết & Khám phá núi tuyết',
                'image' => 'uploads/uudai5.png',
                'discount' => '-13%',
                'transport' => 'bus',
                'departure' => 'Thứ 4 hàng tuần',
                'duration' => '4 ngày 4 đêm',
                'price' => 7790000,
                'price_sale' => 6790000,
                'rating' => 5,
                'views' => 540
            ],
            [
                'name' => 'Tour Hà Nội - Thái Bình Cổ Trấn - Nam Ninh 3N2Đ Trọn Gói',
                'image' => 'uploads/uudai6.png',
                'discount' => '-17%',
                'transport' => 'bus',
                'departure' => 'Linh hoạt',
                'duration' => '3 ngày 2 đêm',
                'price' => 5190000,
                'price_sale' => 4290000,
                'rating' => 4.6,
                'views' => 295
            ],
            [
                'name' => 'Tour Bình Biên - Kiến Thủy - Khai Viễn - Mông Tự 3 ngày 3 đêm',
                'image' => 'uploads/uudai7.png',
                'discount' => '-21%',
                'transport' => 'bus',
                'departure' => 'Thứ 5 hàng tuần',
                'duration' => '3 ngày 3 đêm',
                'price' => 4290000,
                'price_sale' => 3390000,
                'rating' => 4.8,
                'views' => 173
            ],
            [
                'name' => 'Tour Bắc Kinh - Tô Châu - Hàng Châu - Thượng Hải 7N6Đ',
                'image' => 'uploads/uudai8.png',
                'discount' => '-10%',
                'transport' => 'bus, plane',
                'departure' => 'Linh hoạt',
                'duration' => '7 ngày 6 đêm',
                'price' => 24450000,
                'price_sale' => 21990000,
                'rating' => 5,
                'views' => 682
            ],
            // Add 4 more to make the slider scrollable (total 12)
            [
                'name' => 'Tour khám phá Tràng An - Ninh Bình - Bái Đính 2N1Đ',
                'image' => 'uploads/uudai9.png',
                'discount' => '-15%',
                'transport' => 'bus',
                'departure' => 'Hàng ngày',
                'duration' => '2 ngày 1 đêm',
                'price' => 2500000,
                'price_sale' => 2125000,
                'rating' => 4.9,
                'views' => 310
            ],
            [
                'name' => 'Tour nghỉ dưỡng Quy Nhơn - Kỳ Co - Eo Gió 3N2Đ',
                'image' => 'uploads/uudai10.png',
                'discount' => '-18%',
                'transport' => 'bus, plane',
                'departure' => 'Thứ 5 hàng tuần',
                'duration' => '3 ngày 2 đêm',
                'price' => 4850000,
                'price_sale' => 3977000,
                'rating' => 4.7,
                'views' => 245
            ],
            [
                'name' => 'Tour thám hiểm Động Phong Nha - Kẻ Bàng 3N3Đ',
                'image' => 'uploads/uudai11.png',
                'discount' => '-12%',
                'transport' => 'bus',
                'departure' => 'Linh hoạt',
                'duration' => '3 ngày 3 đêm',
                'price' => 3600000,
                'price_sale' => 3168000,
                'rating' => 4.8,
                'views' => 195
            ],
            [
                'name' => 'Tour cố đô Huế - Lăng tẩm - Chùa Thiên Mụ 1 ngày',
                'image' => 'uploads/uudai12.png',
                'discount' => '-10%',
                'transport' => 'bus',
                'departure' => 'Hàng ngày',
                'duration' => '1 ngày',
                'price' => 850000,
                'price_sale' => 765000,
                'rating' => 4.5,
                'views' => 154
            ]
        ];

        $insert_statements = [];
        foreach ($tours as $t) {
            $name_esc = str_replace("'", "''", $t['name']);
            $img = $t['image'];
            $disc = $t['discount'];
            $trans = $t['transport'];
            $dep = $t['departure'];
            $dur = $t['duration'];
            $pr = $t['price'];
            $pr_s = $t['price_sale'];
            $rat = $t['rating'];
            $v = $t['views'];

            $insert_statements[] = "('$name_esc', '$img', '$disc', '$trans', '$dep', '$dur', $pr, $pr_s, $rat, $v)";
        }

        $sql_inserts = "INSERT INTO `touruudai` (`name`, `image`, `discount`, `transport`, `departure`, `duration`, `price`, `price_sale`, `rating`, `views`) VALUES\n" . implode(",\n", $insert_statements) . ";\n";
        Database::getConnection()->exec($sql_inserts);

        // Append to database.sql
        $sql_file_path = __DIR__ . '/../database.sql';
        if (file_exists($sql_file_path)) {
            $sql_content = "\n-- ==========================================\n";
            $sql_content .= "-- BẢNG TOUR ƯU ĐÃI GIÁ TỐT\n";
            $sql_content .= "-- ==========================================\n";
            $sql_content .= "DROP TABLE IF EXISTS `touruudai`;\n";
            $sql_content .= "CREATE TABLE `touruudai` (\n";
            $sql_content .= "  `id` int(11) NOT NULL AUTO_INCREMENT,\n";
            $sql_content .= "  `name` varchar(255) NOT NULL,\n";
            $sql_content .= "  `image` varchar(255) NOT NULL,\n";
            $sql_content .= "  `discount` varchar(20) NOT NULL,\n";
            $sql_content .= "  `transport` varchar(100) NOT NULL,\n";
            $sql_content .= "  `departure` varchar(100) NOT NULL,\n";
            $sql_content .= "  `duration` varchar(100) NOT NULL,\n";
            $sql_content .= "  `price` double NOT NULL DEFAULT 0,\n";
            $sql_content .= "  `price_sale` double NOT NULL DEFAULT 0,\n";
            $sql_content .= "  `rating` float NOT NULL DEFAULT 5,\n";
            $sql_content .= "  `views` int(11) NOT NULL DEFAULT 0,\n";
            $sql_content .= "  PRIMARY KEY (`id`)\n";
            $sql_content .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";
            $sql_content .= $sql_inserts;
            file_put_contents($sql_file_path, $sql_content, FILE_APPEND);
        }
    }
}

/**
 * Các hàm wrapper tương thích ngược
 */
function touruudai_select_all() {
    return TourUuDaiModel::selectAll();
}

function touruudai_select_by_id($id) {
    return TourUuDaiModel::selectById($id);
}

function touruudai_seed() {
    TourUuDaiModel::seed();
}
?>
