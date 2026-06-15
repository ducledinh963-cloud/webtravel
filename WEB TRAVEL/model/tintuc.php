<?php
require_once 'pdo.php';

/**
 * Lớp NewsModel quản lý các truy vấn bảng bài viết/tin tức (tintuc)
 */
class NewsModel {
    /**
     * Lấy tất cả tin tức/bài viết
     */
    public static function selectAll() {
        $sql = "SELECT * FROM tintuc ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy thông tin bài viết theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM tintuc WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm bài viết mới
     */
    public static function insert($title, $image, $description, $date) {
        $sql = "INSERT INTO tintuc(title, image, description, date) VALUES(?, ?, ?, ?)";
        Database::execute($sql, [$title, $image, $description, $date]);
    }

    /**
     * Cập nhật bài viết
     */
    public static function update($id, $title, $image, $description, $date) {
        $sql = "UPDATE tintuc SET title = ?, image = ?, description = ?, date = ? WHERE id = ?";
        Database::execute($sql, [$title, $image, $description, $date, $id]);
    }

    /**
     * Xóa bài viết
     */
    public static function delete($id) {
        $sql = "DELETE FROM tintuc WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Bài viết/Tin tức
 */
function tintuc_select_all() {
    return NewsModel::selectAll();
}

function tintuc_select_by_id($id) {
    return NewsModel::selectById($id);
}

function tintuc_insert($title, $image, $description, $date) {
    NewsModel::insert($title, $image, $description, $date);
}

function tintuc_update($id, $title, $image, $description, $date) {
    NewsModel::update($id, $title, $image, $description, $date);
}

function tintuc_delete($id) {
    NewsModel::delete($id);
}
?>
