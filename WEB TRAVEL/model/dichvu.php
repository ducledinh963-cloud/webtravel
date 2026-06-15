<?php
require_once 'pdo.php';

/**
 * Lớp ServiceModel đại diện cho bảng Dịch vụ
 */
class ServiceModel {
    /**
     * Lấy tất cả dịch vụ
     */
    public static function selectAll() {
        $sql = "SELECT * FROM dichvu ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy thông tin một dịch vụ theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM dichvu WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm dịch vụ mới
     */
    public static function insert($name, $icon, $description, $price) {
        $sql = "INSERT INTO dichvu(name, icon, description, price) VALUES(?, ?, ?, ?)";
        Database::execute($sql, [$name, $icon, $description, $price]);
    }

    /**
     * Cập nhật dịch vụ
     */
    public static function update($id, $name, $icon, $description, $price) {
        $sql = "UPDATE dichvu SET name = ?, icon = ?, description = ?, price = ? WHERE id = ?";
        Database::execute($sql, [$name, $icon, $description, $price, $id]);
    }

    /**
     * Xóa dịch vụ
     */
    public static function delete($id) {
        $sql = "DELETE FROM dichvu WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Dịch vụ
 */
function dichvu_select_all() {
    return ServiceModel::selectAll();
}

function dichvu_select_by_id($id) {
    return ServiceModel::selectById($id);
}

function dichvu_insert($name, $icon, $description, $price) {
    ServiceModel::insert($name, $icon, $description, $price);
}

function dichvu_update($id, $name, $icon, $description, $price) {
    ServiceModel::update($id, $name, $icon, $description, $price);
}

function dichvu_delete($id) {
    ServiceModel::delete($id);
}
?>
