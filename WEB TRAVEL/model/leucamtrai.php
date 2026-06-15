<?php
require_once 'pdo.php';

/**
 * Lớp LeuCamTraiModel quản lý các truy vấn bảng lều cắm trại ở biển (leucamtrai)
 */
class LeuCamTraiModel {
    /**
     * Lấy tất cả lều cắm trại
     */
    public static function selectAll() {
        $sql = "SELECT * FROM leucamtrai ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết lều cắm trại theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM leucamtrai WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm lều cắm trại mới
     */
    public static function insert($name, $image, $description, $price, $address, $rating) {
        $sql = "INSERT INTO leucamtrai (name, image, description, price, address, rating) VALUES (?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating]);
    }

    /**
     * Cập nhật thông tin lều cắm trại
     */
    public static function update($id, $name, $image, $description, $price, $address, $rating) {
        $sql = "UPDATE leucamtrai SET name = ?, image = ?, description = ?, price = ?, address = ?, rating = ? WHERE id = ?";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating, $id]);
    }

    /**
     * Xóa lều cắm trại theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM leucamtrai WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Tự động khởi tạo và seed dữ liệu 140 lều cắm trại ở biển
     */
    public static function seed140() {
        $sql_schema = "
        DROP TABLE IF EXISTS `leucamtrai`;
        CREATE TABLE IF NOT EXISTS `leucamtrai` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `image` varchar(255) NOT NULL,
          `description` text DEFAULT NULL,
          `price` double NOT NULL DEFAULT 0,
          `address` varchar(255) NOT NULL,
          `rating` float NOT NULL DEFAULT 5,
          `views` int(11) NOT NULL DEFAULT 0,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        Database::getConnection()->exec($sql_schema);

        $tent_types = [
            ['Lều cắm trại đơn BeachBasic', 150000, 'Lều đơn 1 người gọn nhẹ, chống thấm tốt, thiết kế thông minh tự bung, thích hợp cho dân phượt bụi tự trải nghiệm bãi biển hoang sơ.'],
            ['Lều dã ngoại đôi OceanBreeze', 250000, 'Lều đôi 2 người thoáng khí với 2 cửa sổ lưới đón gió biển, khung sợi thủy tinh chắc chắn chống chịu gió cát tốt.'],
            ['Lều mái vòm Dome Deluxe', 450000, 'Lều dome 3-4 người hình bán cầu chống bão cát biển, lớp phủ chống tia UV, không gian cắm trại ấm cúng cho nhóm bạn.'],
            ['Lều gia đình Family Outwell', 750000, 'Lều lớn 6 người chia làm 2 buồng ngủ riêng biệt và 1 phòng sinh hoạt chung, thích hợp cho kỳ nghỉ cắm trại gia đình bên bờ biển.'],
            ['Lều Glamping Dome Sang Trọng', 1200000, 'Lều mái vòm Glamping cao cấp đường kính 4m, đầy đủ đệm hơi, quạt máy, đèn lồng vintage và bàn ghế thư giãn ngoài trời.'],
            ['Lều Safari Glamping Cao Cấp', 1800000, 'Lều mui trần phong cách Safari châu Phi sang trọng, chất liệu vải canvas cao cấp cách nhiệt, sàn gỗ nâng cao tránh cát ẩm.'],
            ['Lều dã ngoại chống gió biển', 350000, 'Lều chuyên dụng chống gió to sát biển, trang bị cọc ghim thép đúc và dây neo chịu lực tốt, chống mưa rào.'],
            ['Lều tự bung thông minh Speedy', 300000, 'Lều tự bung chỉ trong 30 giây cực kỳ tiện lợi, thiết kế 2 lớp chống đọng sương ban đêm bên bờ biển.'],
            ['Lều Glamping Oasis Luxury', 2200000, 'Lều Glamping cỡ lớn đầy đủ nội thất sang trọng: giường đệm cao su, điều hòa mini di động, bàn trà, view trực diện đón bình minh biển.'],
            ['Lều võng cắm trại độc đáo', 200000, 'Lều kết hợp võng treo giữa hai rặng dừa sát biển, lớp lưới chống muỗi và bạt che mưa chắn gió lộng gió.'],
        ];

        $beaches = [
            'Bãi Sao, Phú Quốc', 'Bãi Khem, Phú Quốc', 'Bãi Dài, Phú Quốc', 
            'Bãi Mỹ Khê, Đà Nẵng', 'Bãi Non Nước, Đà Nẵng', 'Bãi Nam, Bán đảo Sơn Trà',
            'Bãi Trước, Vũng Tàu', 'Bãi Sau, Vũng Tàu', 'Bãi Dứa, Vũng Tàu',
            'Bãi Kỳ Co, Quy Nhơn', 'Bãi Eo Gió, Quy Nhơn', 'Bãi Xép, Quy Nhơn',
            'Mũi Né, Phan Thiết', 'Hòn Rơm, Phan Thiết', 'Bãi biển Đồi Dương, Phan Thiết',
            'Bãi Nhát, Côn Đảo', 'Bãi Đầm Trầu, Côn Đảo', 'Bãi Lò Vôi, Côn Đảo',
            'Bãi Cát Cò, Cát Bà', 'Bãi Tùng Thu, Cát Bà',
            'Bãi Hồng Vàn, Cô Tô', 'Bãi Vàn Chảy, Cô Tô',
            'Bãi biển Nha Trang, Khánh Hòa', 'Dốc Lết, Nha Trang', 'Bãi Dài, Cam Ranh'
        ];

        $insert_statements = [];
        for ($i = 1; $i <= 140; $i++) {
            $type = $tent_types[($i - 1) % count($tent_types)];
            $beach = $beaches[($i - 1) % count($beaches)];
            
            $base_name = $type[0];
            $base_price = $type[1];
            $base_desc = $type[2];
            
            // Generate dynamic name
            $name = $base_name . " T-" . sprintf('%03d', $i);
            
            // Randomize price slightly (+- 10%)
            $price = $base_price * (0.95 + (mt_rand(0, 10) / 100));
            $price = round($price / 10000) * 10000; // Round to nearest 10,000 đ
            
            // Dynamic description with location detail
            $description = $base_desc . " Trải nghiệm tại " . $beach . " thơ mộng. Dịch vụ thuê trọn gói bao gồm cọc neo cát, thảm cách nhiệt và hệ thống chiếu sáng ban đêm.";
            
            $image = "uploads/tent" . $i . ".png";
            $rating = round((4.3 + (mt_rand(0, 7) / 10)), 1); // 4.3 -> 5.0
            $views = mt_rand(20, 390);
            
            $name_esc = str_replace("'", "''", $name);
            $desc_esc = str_replace("'", "''", $description);
            $beach_esc = str_replace("'", "''", $beach);
            
            $insert_statements[] = "($i, '$name_esc', '$image', '$desc_esc', $price, '$beach_esc', $rating, $views)";
        }

        $sql_inserts = "INSERT INTO `leucamtrai` (`id`, `name`, `image`, `description`, `price`, `address`, `rating`, `views`) VALUES\n" . implode(",\n", $insert_statements) . ";\n";
        
        Database::getConnection()->exec($sql_inserts);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho LeuCamTrai
 */
function leucamtrai_select_all() {
    return LeuCamTraiModel::selectAll();
}

function leucamtrai_select_by_id($id) {
    return LeuCamTraiModel::selectById($id);
}

function leucamtrai_insert($name, $image, $description, $price, $address, $rating) {
    LeuCamTraiModel::insert($name, $image, $description, $price, $address, $rating);
}

function leucamtrai_update($id, $name, $image, $description, $price, $address, $rating) {
    LeuCamTraiModel::update($id, $name, $image, $description, $price, $address, $rating);
}

function leucamtrai_delete($id) {
    LeuCamTraiModel::delete($id);
}

function leucamtrai_seed_140() {
    LeuCamTraiModel::seed140();
}
?>
