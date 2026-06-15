<?php
require_once 'pdo.php';

/**
 * Lớp GiaiTriModel quản lý các truy vấn bảng khu vui chơi giải trí (giaitri)
 */
class GiaiTriModel {
    /**
     * Lấy tất cả hoạt động giải trí
     */
    public static function selectAll() {
        $sql = "SELECT * FROM giaitri ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết hoạt động giải trí theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM giaitri WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm hoạt động giải trí mới
     */
    public static function insert($name, $image, $description, $price, $address, $rating) {
        $sql = "INSERT INTO giaitri (name, image, description, price, address, rating) VALUES (?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating]);
    }

    /**
     * Cập nhật thông tin hoạt động giải trí
     */
    public static function update($id, $name, $image, $description, $price, $address, $rating) {
        $sql = "UPDATE giaitri SET name = ?, image = ?, description = ?, price = ?, address = ?, rating = ? WHERE id = ?";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating, $id]);
    }

    /**
     * Xóa hoạt động giải trí theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM giaitri WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho GiaiTri
 */
function giaitri_select_all() {
    return GiaiTriModel::selectAll();
}

function giaitri_select_by_id($id) {
    return GiaiTriModel::selectById($id);
}

function giaitri_insert($name, $image, $description, $price, $address, $rating) {
    GiaiTriModel::insert($name, $image, $description, $price, $address, $rating);
}

function giaitri_update($id, $name, $image, $description, $price, $address, $rating) {
    GiaiTriModel::update($id, $name, $image, $description, $price, $address, $rating);
}

function giaitri_delete($id) {
    GiaiTriModel::delete($id);
}
?>
