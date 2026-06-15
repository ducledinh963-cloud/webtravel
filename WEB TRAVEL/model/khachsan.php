<?php
require_once 'pdo.php';

/**
 * Lớp HotelModel quản lý các truy vấn bảng khách sạn (khachsan)
 */
class HotelModel {
    /**
     * Lấy tất cả khách sạn
     */
    public static function selectAll() {
        $sql = "SELECT * FROM khachsan ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách khách sạn nổi bật theo lượt xem
     */
    public static function selectHot() {
        $sql = "SELECT * FROM khachsan ORDER BY views DESC LIMIT 6";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách các địa điểm độc nhất
     */
    public static function selectLocations() {
        $sql = "SELECT DISTINCT location FROM khachsan ORDER BY location ASC";
        return Database::query($sql);
    }

    /**
     * Lấy thông tin khách sạn theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM khachsan WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Lấy danh sách khách sạn theo địa điểm
     */
    public static function selectByLocation($location) {
        $sql = "SELECT * FROM khachsan WHERE location = ? ORDER BY id DESC";
        return Database::query($sql, [$location]);
    }

    /**
     * Tìm kiếm khách sạn theo từ khóa
     */
    public static function search($keyword) {
        $sql = "SELECT * FROM khachsan WHERE name LIKE ? OR address LIKE ? OR location LIKE ? ORDER BY id DESC";
        $search_term = "%" . $keyword . "%";
        return Database::query($sql, [$search_term, $search_term, $search_term]);
    }

    /**
     * Thêm mới khách sạn
     */
    public static function insert($name, $address, $stars, $price, $price_sale, $image, $location, $category, $region) {
        $sql = "INSERT INTO khachsan(name, address, stars, price, price_sale, image, location, category, region) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $address, $stars, $price, $price_sale, $image, $location, $category, $region]);
    }

    /**
     * Cập nhật khách sạn
     */
    public static function update($id, $name, $address, $stars, $price, $price_sale, $image, $location, $category, $region) {
        $sql = "UPDATE khachsan SET name = ?, address = ?, stars = ?, price = ?, price_sale = ?, image = ?, location = ?, category = ?, region = ? WHERE id = ?";
        Database::execute($sql, [$name, $address, $stars, $price, $price_sale, $image, $location, $category, $region, $id]);
    }

    /**
     * Xóa khách sạn
     */
    public static function delete($id) {
        $sql = "DELETE FROM khachsan WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Lấy các địa điểm trong nước
     */
    public static function selectDomesticLocations() {
        $sql = "SELECT DISTINCT location FROM khachsan WHERE region != 'Nước Ngoài' ORDER BY location ASC";
        return Database::query($sql);
    }

    /**
     * Lấy các địa điểm nước ngoài
     */
    public static function selectForeignLocations() {
        $sql = "SELECT DISTINCT location FROM khachsan WHERE region = 'Nước Ngoài' ORDER BY location ASC";
        return Database::query($sql);
    }

    /**
     * Lấy khách sạn theo khu vực
     */
    public static function selectByRegion($region) {
        $sql = "SELECT * FROM khachsan WHERE region = ? ORDER BY id DESC";
        return Database::query($sql, [$region]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Khách sạn
 */
function khachsan_select_all() {
    return HotelModel::selectAll();
}

function khachsan_select_hot() {
    return HotelModel::selectHot();
}

function khachsan_select_locations() {
    return HotelModel::selectLocations();
}

function khachsan_select_by_id($id) {
    return HotelModel::selectById($id);
}

function khachsan_select_by_location($location) {
    return HotelModel::selectByLocation($location);
}

function khachsan_search($keyword) {
    return HotelModel::search($keyword);
}

function khachsan_insert($name, $address, $stars, $price, $image, $location) {
    HotelModel::insert($name, $address, $stars, $price, 0, $image, $location, 'Khách sạn', 'Miền Bắc');
}

function khachsan_insert_full($name, $address, $stars, $price, $price_sale, $image, $location, $category, $region) {
    HotelModel::insert($name, $address, $stars, $price, $price_sale, $image, $location, $category, $region);
}

function khachsan_update_full($id, $name, $address, $stars, $price, $price_sale, $image, $location, $category, $region) {
    HotelModel::update($id, $name, $address, $stars, $price, $price_sale, $image, $location, $category, $region);
}

function khachsan_delete($id) {
    HotelModel::delete($id);
}

function khachsan_select_domestic_locations() {
    return HotelModel::selectDomesticLocations();
}

function khachsan_select_foreign_locations() {
    return HotelModel::selectForeignLocations();
}

function khachsan_select_by_region($region) {
    return HotelModel::selectByRegion($region);
}
?>
