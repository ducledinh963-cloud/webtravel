<?php
require_once 'pdo.php';

/**
 * Lớp NhaHangModel quản lý các truy vấn bảng nhà hàng món ngon du lịch biển (nhahang)
 */
class NhaHangModel {
    /**
     * Lấy tất cả nhà hàng, đặc sản món ngon
     */
    public static function selectAll() {
        $sql = "SELECT * FROM nhahang ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết món ăn / nhà hàng theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM nhahang WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm món ăn / nhà hàng mới
     */
    public static function insert($name, $image, $description, $price, $address, $rating) {
        $sql = "INSERT INTO nhahang (name, image, description, price, address, rating) VALUES (?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating]);
    }

    /**
     * Cập nhật thông tin món ăn / nhà hàng
     */
    public static function update($id, $name, $image, $description, $price, $address, $rating) {
        $sql = "UPDATE nhahang SET name = ?, image = ?, description = ?, price = ?, address = ?, rating = ? WHERE id = ?";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating, $id]);
    }

    /**
     * Xóa món ăn / nhà hàng theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM nhahang WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Hàm wrapper tương thích ngược
 */
function nhahang_select_all() {
    return NhaHangModel::selectAll();
}

function nhahang_select_by_id($id) {
    return NhaHangModel::selectById($id);
}

function nhahang_insert($name, $image, $description, $price, $address, $rating) {
    NhaHangModel::insert($name, $image, $description, $price, $address, $rating);
}

function nhahang_update($id, $name, $image, $description, $price, $address, $rating) {
    NhaHangModel::update($id, $name, $image, $description, $price, $address, $rating);
}

function nhahang_delete($id) {
    NhaHangModel::delete($id);
}
?>
