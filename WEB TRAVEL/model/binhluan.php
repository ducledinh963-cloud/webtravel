<?php
require_once 'pdo.php';

/**
 * Lớp CommentModel đại diện cho bảng Bình luận
 */
class CommentModel {
    /**
     * Thêm bình luận mới
     */
    public static function insert($content, $id_user, $id_pro, $date) {
        $sql = "INSERT INTO binhluan (content, id_user, id_pro, date) VALUES (?, ?, ?, ?)";
        Database::execute($sql, [$content, $id_user, $id_pro, $date]);
    }

    /**
     * Lấy tất cả bình luận của một sản phẩm
     */
    public static function selectByProduct($id_pro) {
        $sql = "SELECT bl.*, tk.username FROM binhluan bl 
                INNER JOIN taikhoan tk ON bl.id_user = tk.id 
                WHERE bl.id_pro = ? 
                ORDER BY bl.id DESC";
        return Database::query($sql, [$id_pro]);
    }

    /**
     * Lấy tất cả bình luận cho trang quản trị
     */
    public static function selectAll() {
        $sql = "SELECT bl.*, tk.username, sp.name as ten_sanpham FROM binhluan bl
                INNER JOIN taikhoan tk ON bl.id_user = tk.id
                INNER JOIN sanpham sp ON bl.id_pro = sp.id
                ORDER BY bl.id DESC";
        return Database::query($sql);
    }

    /**
     * Xóa bình luận theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM binhluan WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Bình luận
 */
function binhluan_insert($content, $id_user, $id_pro, $date) {
    CommentModel::insert($content, $id_user, $id_pro, $date);
}

function binhluan_select_by_product($id_pro) {
    return CommentModel::selectByProduct($id_pro);
}

function binhluan_select_all() {
    return CommentModel::selectAll();
}

function binhluan_delete($id) {
    CommentModel::delete($id);
}
?>
