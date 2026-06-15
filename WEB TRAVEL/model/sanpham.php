<?php
require_once 'pdo.php';

/**
 * Lớp ProductModel đại diện cho bảng Sản phẩm (Tour)
 */
class ProductModel {
    /**
     * Thêm sản phẩm mới (Tour)
     */
    public static function insert($name, $price, $price_sale, $image, $description, $id_danhmuc) {
        $sql = "INSERT INTO sanpham(name, price, price_sale, image, description, id_danhmuc) VALUES(?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $price, $price_sale, $image, $description, $id_danhmuc]);
    }

    /**
     * Lấy tất cả sản phẩm
     */
    public static function selectAll() {
        $sql = "SELECT * FROM sanpham ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách sản phẩm hiển thị trên Trang chủ
     */
    public static function selectHome() {
        $sql = "SELECT * FROM sanpham ORDER BY id DESC LIMIT 6";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách 10 tour được xem nhiều nhất
     */
    public static function selectTop10() {
        $sql = "SELECT * FROM sanpham ORDER BY views DESC LIMIT 10";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết sản phẩm theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT sp.*, dm.name as ten_danhmuc FROM sanpham sp 
                INNER JOIN danhmuc dm ON sp.id_danhmuc = dm.id 
                WHERE sp.id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Lấy danh sách sản phẩm cùng loại (liên quan), loại trừ sản phẩm hiện tại
     */
    public static function selectCungloai($id, $id_danhmuc) {
        $sql = "SELECT * FROM sanpham WHERE id_danhmuc = ? AND id <> ? ORDER BY id DESC LIMIT 4";
        return Database::query($sql, [$id_danhmuc, $id]);
    }

    /**
     * Lấy danh sách sản phẩm theo danh mục
     */
    public static function selectByDanhmuc($id_danhmuc) {
        $sql = "SELECT * FROM sanpham WHERE id_danhmuc = ? ORDER BY id DESC";
        return Database::query($sql, [$id_danhmuc]);
    }

    /**
     * Tìm kiếm sản phẩm theo từ khóa và danh mục (nếu có)
     */
    public static function search($keyword, $id_danhmuc = '') {
        if ($id_danhmuc != '') {
            $sql = "SELECT * FROM sanpham WHERE id_danhmuc = ? AND (name LIKE ? OR description LIKE ?) ORDER BY id DESC";
            $search_term = "%" . $keyword . "%";
            return Database::query($sql, [$id_danhmuc, $search_term, $search_term]);
        } else {
            $sql = "SELECT * FROM sanpham WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC";
            $search_term = "%" . $keyword . "%";
            return Database::query($sql, [$search_term, $search_term]);
        }
    }

    /**
     * Tăng lượt xem của sản phẩm khi người dùng kích xem chi tiết
     */
    public static function tangLuotXem($id) {
        $sql = "UPDATE sanpham SET views = views + 1 WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Xóa sản phẩm theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM sanpham WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Cập nhật thông tin sản phẩm
     */
    public static function update($id, $name, $price, $price_sale, $image, $description, $id_danhmuc) {
        $sql = "UPDATE sanpham SET name = ?, price = ?, price_sale = ?, image = ?, description = ?, id_danhmuc = ? WHERE id = ?";
        Database::execute($sql, [$name, $price, $price_sale, $image, $description, $id_danhmuc, $id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Sản phẩm
 */
function sanpham_insert($name, $price, $price_sale, $image, $description, $id_danhmuc) {
    ProductModel::insert($name, $price, $price_sale, $image, $description, $id_danhmuc);
}

function sanpham_select_all() {
    return ProductModel::selectAll();
}

function sanpham_select_home() {
    return ProductModel::selectHome();
}

function sanpham_select_top10() {
    return ProductModel::selectTop10();
}

function sanpham_select_by_id($id) {
    return ProductModel::selectById($id);
}

function sanpham_select_cungloai($id, $id_danhmuc) {
    return ProductModel::selectCungloai($id, $id_danhmuc);
}

function sanpham_select_by_danhmuc($id_danhmuc) {
    return ProductModel::selectByDanhmuc($id_danhmuc);
}

function sanpham_search($keyword, $id_danhmuc = '') {
    return ProductModel::search($keyword, $id_danhmuc);
}

function sanpham_tang_luotxem($id) {
    ProductModel::tangLuotXem($id);
}

function sanpham_delete($id) {
    ProductModel::delete($id);
}

function sanpham_update($id, $name, $price, $price_sale, $image, $description, $id_danhmuc) {
    ProductModel::update($id, $name, $price, $price_sale, $image, $description, $id_danhmuc);
}
?>
