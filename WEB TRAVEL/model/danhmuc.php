<?php
require_once 'pdo.php';

/**
 * Lớp CategoryModel đại diện cho bảng Danh mục
 */
class CategoryModel {
    /**
     * Lấy tất cả danh mục tour
     */
    public static function selectAll() {
        $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy thông tin một danh mục theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM danhmuc WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm danh mục mới
     */
    public static function insert($name) {
        $sql = "INSERT INTO danhmuc(name) VALUES(?)";
        Database::execute($sql, [$name]);
    }

    /**
     * Cập nhật danh mục
     */
    public static function update($id, $name) {
        $sql = "UPDATE danhmuc SET name = ? WHERE id = ?";
        Database::execute($sql, [$name, $id]);
    }

    /**
     * Xóa danh mục
     */
    public static function delete($id) {
        $sql = "DELETE FROM danhmuc WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Danh mục
 */
function danhmuc_select_all() {
    return CategoryModel::selectAll();
}

function danhmuc_select_by_id($id) {
    return CategoryModel::selectById($id);
}

function danhmuc_insert($name) {
    CategoryModel::insert($name);
}

function danhmuc_update($id, $name) {
    CategoryModel::update($id, $name);
}

function danhmuc_delete($id) {
    CategoryModel::delete($id);
}
?>
