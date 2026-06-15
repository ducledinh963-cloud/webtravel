<?php
require_once 'pdo.php';

/**
 * Lớp DuKhachModel quản lý các truy vấn bảng du khách (dukhach)
 */
class DuKhachModel {
    /**
     * Lấy tất cả du khách
     */
    public static function selectAll() {
        $sql = "SELECT * FROM dukhach ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết du khách theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM dukhach WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm du khách mới
     */
    public static function insert($name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate) {
        $sql = "INSERT INTO dukhach (name, image, email, phone, address, passport, nationality, gender, birthdate) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return Database::executeAndGetId($sql, [$name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate]);
    }

    /**
     * Cập nhật thông tin du khách
     */
    public static function update($id, $name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate) {
        $sql = "UPDATE dukhach SET name = ?, image = ?, email = ?, phone = ?, address = ?, passport = ?, nationality = ?, gender = ?, birthdate = ? 
                WHERE id = ?";
        Database::execute($sql, [$name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate, $id]);
    }

    /**
     * Xóa du khách theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM dukhach WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Tìm kiếm du khách theo từ khóa và giới tính
     */
    public static function search($keyword = '', $gender = '') {
        $sql = "SELECT * FROM dukhach WHERE 1";
        $params = [];
        
        if (!empty($keyword)) {
            $sql .= " AND (name LIKE ? OR email LIKE ? OR phone LIKE ? OR nationality LIKE ?)";
            $keyword_param = "%$keyword%";
            array_push($params, $keyword_param, $keyword_param, $keyword_param, $keyword_param);
        }
        
        if (!empty($gender)) {
            $sql .= " AND gender = ?";
            $params[] = $gender;
        }
        
        $sql .= " ORDER BY id DESC";
        return Database::query($sql, $params);
    }

    /**
     * Sinh ký tự viết tắt từ họ tên (Initials)
     */
    public static function getInitials($name) {
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            $first = mb_substr($words[0], 0, 1, 'UTF-8');
            $last = mb_substr($words[count($words) - 1], 0, 1, 'UTF-8');
            return mb_strtoupper($first . $last, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
    }

    /**
     * Tự động khởi tạo và seed dữ liệu 140 du khách và hình ảnh SVG độc bản
     */
    public static function seed140() {
        $sql_schema = "
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
        Database::getConnection()->exec($sql_schema);

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

        $colors = [
            ['#ef4444', '#b91c1c'], // Red
            ['#f97316', '#c2410c'], // Orange
            ['#f59e0b', '#b45309'], // Amber
            ['#eab308', '#a16207'], // Yellow
            ['#84cc16', '#4d7c0f'], // Lime
            ['#10b981', '#047857'], // Emerald
            ['#14b8a6', '#0f766e'], // Teal
            ['#06b6d4', '#0e7490'], // Cyan
            ['#0ea5e9', '#0369a1'], // Sky
            ['#3b82f6', '#1d4ed8'], // Blue
            ['#6366f1', '#4338ca'], // Indigo
            ['#8b5cf6', '#6d28d9'], // Violet
            ['#a855f7', '#7e22ce'], // Purple
            ['#d946ef', '#a21caf'], // Fuchsia
            ['#ec4899', '#be185d'], // Pink
            ['#f43f5e', '#be123c']  // Rose
        ];

        $uploads_dir = __DIR__ . '/../uploads/';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $insert_statements = [];
        for ($i = 1; $i <= 140; $i++) {
            // Determine name, nationality, and gender
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

            // Generate unique, beautiful SVG avatar file
            $initials = self::getInitials($name);
            $grad_colors = $colors[($i - 1) % count($colors)];
            $c1 = $grad_colors[0];
            $c2 = $grad_colors[1];
            
            $svg_content = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
  <defs>
    <linearGradient id="grad' . $i . '" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:' . $c1 . ';stop-opacity:1" />
      <stop offset="100%" style="stop-color:' . $c2 . ';stop-opacity:1" />
    </linearGradient>
  </defs>
  <circle cx="50" cy="50" r="50" fill="url(#grad' . $i . ')" />
  <text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-size="34" font-weight="800" font-family="\'Outfit\', \'Segoe UI\', sans-serif">' . $initials . '</text>
</svg>';

            $image_path = 'uploads/dukhach' . $i . '.svg';
            file_put_contents($uploads_dir . 'dukhach' . $i . '.svg', $svg_content);

            // Generate realistic values
            // Create simplified email slug from name
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
        Database::getConnection()->exec($sql_inserts);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho DuKhach
 */
function dukhach_select_all() {
    return DuKhachModel::selectAll();
}

function dukhach_select_by_id($id) {
    return DuKhachModel::selectById($id);
}

function dukhach_insert($name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate) {
    return DuKhachModel::insert($name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate);
}

function dukhach_update($id, $name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate) {
    DuKhachModel::update($id, $name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate);
}

function dukhach_delete($id) {
    DuKhachModel::delete($id);
}

function dukhach_search($keyword = '', $gender = '') {
    return DuKhachModel::search($keyword, $gender);
}

function dukhach_seed_140() {
    DuKhachModel::seed140();
}
?>
