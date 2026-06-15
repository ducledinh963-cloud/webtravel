<?php
require_once 'pdo.php';

/**
 * Lớp DuThuyenModel quản lý các truy vấn bảng du thuyền (duthuyen)
 */
class DuThuyenModel {
    /**
     * Lấy tất cả du thuyền sắp xếp theo thứ tự ID
     */
    public static function selectAll() {
        $sql = "SELECT * FROM duthuyen ORDER BY id ASC";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách du thuyền giới hạn số lượng
     */
    public static function selectTop($limit) {
        $sql = "SELECT * FROM duthuyen ORDER BY id ASC LIMIT " . (int)$limit;
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết du thuyền theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM duthuyen WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm du thuyền mới
     */
    public static function insert($name, $image, $description, $price, $address, $rating) {
        $sql = "INSERT INTO duthuyen (name, image, description, price, address, rating) VALUES (?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating]);
    }

    /**
     * Cập nhật thông tin du thuyền
     */
    public static function update($id, $name, $image, $description, $price, $address, $rating) {
        $sql = "UPDATE duthuyen SET name = ?, image = ?, description = ?, price = ?, address = ?, rating = ? WHERE id = ?";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating, $id]);
    }

    /**
     * Xóa du thuyền theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM duthuyen WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho DuThuyen
 */
function duthuyen_select_all() {
    return DuThuyenModel::selectAll();
}

function duthuyen_select_top($limit) {
    return DuThuyenModel::selectTop($limit);
}

function duthuyen_select_by_id($id) {
    return DuThuyenModel::selectById($id);
}
?>
