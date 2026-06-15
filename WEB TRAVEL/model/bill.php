<?php
require_once 'pdo.php';

/**
 * Lớp BillModel đại diện cho bảng Bill (Đơn đặt tour) và Bill_Detail (Chi tiết đơn)
 */
class BillModel {
    /**
     * Thêm đơn đặt tour mới
     */
    public static function insert($bill_code, $id_user, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_pttt, $bill_total, $date_booking) {
        $sql = "INSERT INTO bill(bill_code, id_user, bill_name, bill_email, bill_phone, bill_address, bill_pttt, bill_total, date_booking, bill_status) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        Database::execute($sql, [$bill_code, $id_user, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_pttt, $bill_total, $date_booking]);
        
        // Lấy ID tự sinh của bản ghi vừa chèn
        return Database::queryValue("SELECT id FROM bill WHERE bill_code = ?", [$bill_code]);
    }

    /**
     * Thêm chi tiết đơn đặt tour
     */
    public static function insertDetail($id_bill, $id_pro, $name, $image, $price, $quantity, $total) {
        $sql = "INSERT INTO bill_detail(id_bill, id_pro, name, image, price, quantity, total) 
                VALUES(?, ?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$id_bill, $id_pro, $name, $image, $price, $quantity, $total]);
    }

    /**
     * Lấy thông tin đơn hàng theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM bill WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Lấy tất cả đơn hàng
     */
    public static function selectAll() {
        $sql = "SELECT * FROM bill ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy danh sách đơn hàng của một người dùng
     */
    public static function selectByUser($id_user) {
        $sql = "SELECT * FROM bill WHERE id_user = ? ORDER BY id DESC";
        return Database::query($sql, [$id_user]);
    }

    /**
     * Lấy chi tiết của một đơn hàng
     */
    public static function selectDetails($id_bill) {
        $sql = "SELECT * FROM bill_detail WHERE id_bill = ? ORDER BY id ASC";
        return Database::query($sql, [$id_bill]);
    }

    /**
     * Cập nhật trạng thái đơn đặt tour
     */
    public static function updateStatus($id, $status) {
        $sql = "UPDATE bill SET bill_status = ? WHERE id = ?";
        Database::execute($sql, [$status, $id]);
    }

    /**
     * Cập nhật thông tin chi tiết đơn hàng (khách hàng & trạng thái)
     */
    public static function update($id, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_status) {
        $sql = "UPDATE bill SET bill_name = ?, bill_email = ?, bill_phone = ?, bill_address = ?, bill_status = ? WHERE id = ?";
        Database::execute($sql, [$bill_name, $bill_email, $bill_phone, $bill_address, $bill_status, $id]);
    }

    /**
     * Xóa đơn hàng theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM bill WHERE id = ?";
        Database::execute($sql, [$id]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Bill
 */
function bill_insert($bill_code, $id_user, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_pttt, $bill_total, $date_booking) {
    return BillModel::insert($bill_code, $id_user, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_pttt, $bill_total, $date_booking);
}

function bill_insert_detail($id_bill, $id_pro, $name, $image, $price, $quantity, $total) {
    BillModel::insertDetail($id_bill, $id_pro, $name, $image, $price, $quantity, $total);
}

function bill_select_by_id($id) {
    return BillModel::selectById($id);
}

function bill_select_all() {
    return BillModel::selectAll();
}

function bill_select_by_user($id_user) {
    return BillModel::selectByUser($id_user);
}

function bill_select_details($id_bill) {
    return BillModel::selectDetails($id_bill);
}

function bill_update_status($id, $status) {
    BillModel::updateStatus($id, $status);
}

function bill_update($id, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_status) {
    BillModel::update($id, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_status);
}

function bill_delete($id) {
    BillModel::delete($id);
}
?>
