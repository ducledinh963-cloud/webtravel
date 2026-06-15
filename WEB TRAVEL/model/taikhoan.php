<?php
require_once 'pdo.php';

/**
 * Lớp UserModel đại diện cho bảng Tài khoản
 */
class UserModel {
    /**
     * Thêm tài khoản đăng ký mới
     */
    public static function insert($username, $password, $email, $phone = '') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO taikhoan(username, password, email, phone, role) VALUES(?, ?, ?, ?, 0)";
        Database::execute($sql, [$username, $hashed_password, $email, $phone]);
    }

    /**
     * Kiểm tra tài khoản đăng nhập
     */
    public static function check($username_or_email, $password) {
        $sql = "SELECT * FROM taikhoan WHERE username = ? OR email = ?";
        $user = Database::queryOne($sql, [$username_or_email, $username_or_email]);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
            if ($password === $user['password']) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Kiểm tra xem username đã tồn tại chưa
     */
    public static function exists($username) {
        $sql = "SELECT count(*) FROM taikhoan WHERE username = ?";
        return Database::queryValue($sql, [$username]) > 0;
    }

    /**
     * Lấy thông tin tài khoản theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM taikhoan WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Cập nhật thông tin tài khoản
     */
    public static function update($id, $username, $password, $email, $phone) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE taikhoan SET username = ?, password = ?, email = ?, phone = ? WHERE id = ?";
            Database::execute($sql, [$username, $hashed_password, $email, $phone, $id]);
        } else {
            $sql = "UPDATE taikhoan SET username = ?, email = ?, phone = ? WHERE id = ?";
            Database::execute($sql, [$username, $email, $phone, $id]);
        }
    }

    /**
     * Lấy tất cả tài khoản
     */
    public static function selectAll() {
        $sql = "SELECT * FROM taikhoan ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Xóa tài khoản theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM taikhoan WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Cập nhật thông tin tài khoản kèm role trong admin
     */
    public static function updateAdmin($id, $username, $password, $email, $phone, $role) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE taikhoan SET username = ?, password = ?, email = ?, phone = ?, role = ? WHERE id = ?";
            Database::execute($sql, [$username, $hashed_password, $email, $phone, $role, $id]);
        } else {
            $sql = "UPDATE taikhoan SET username = ?, email = ?, phone = ?, role = ? WHERE id = ?";
            Database::execute($sql, [$username, $email, $phone, $role, $id]);
        }
    }

    /**
     * Thêm tài khoản mới từ admin (có role)
     */
    public static function insertAdmin($username, $password, $email, $phone, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO taikhoan(username, password, email, phone, role) VALUES(?, ?, ?, ?, ?)";
        Database::execute($sql, [$username, $hashed_password, $email, $phone, $role]);
    }

    /**
     * Kiểm tra xem email đã tồn tại trên hệ thống chưa
     */
    public static function emailExists($email) {
        $sql = "SELECT count(*) FROM taikhoan WHERE email = ?";
        return Database::queryValue($sql, [$email]) > 0;
    }

    /**
     * Kiểm tra xem số điện thoại đã tồn tại trên hệ thống chưa
     */
    public static function phoneExists($phone) {
        if (empty($phone)) return false;
        $sql = "SELECT count(*) FROM taikhoan WHERE phone = ?";
        return Database::queryValue($sql, [$phone]) > 0;
    }

    /**
     * Kiểm tra xem email có tồn tại cho người dùng khác không
     */
    public static function emailExistsExcept($email, $id) {
        $sql = "SELECT count(*) FROM taikhoan WHERE email = ? AND id != ?";
        return Database::queryValue($sql, [$email, $id]) > 0;
    }

    /**
     * Kiểm tra xem số điện thoại có tồn tại cho người dùng khác không
     */
    public static function phoneExistsExcept($phone, $id) {
        if (empty($phone)) return false;
        $sql = "SELECT count(*) FROM taikhoan WHERE phone = ? AND id != ?";
        return Database::queryValue($sql, [$phone, $id]) > 0;
    }
    /**
     * Tìm kiếm và lọc tài khoản theo từ khóa và vai trò
     */
    public static function search($keyword, $role = 'all') {
        $sql = "SELECT * FROM taikhoan WHERE 1";
        $params = [];
        
        if ($role !== 'all') {
            $sql .= " AND role = ?";
            $params[] = (int)$role;
        }
        
        if (!empty($keyword)) {
            $sql .= " AND (username LIKE ? OR email LIKE ? OR phone LIKE ?)";
            $search_term = "%" . $keyword . "%";
            $params[] = $search_term;
            $params[] = $search_term;
            $params[] = $search_term;
        }
        
        $sql .= " ORDER BY id DESC";
        return Database::query($sql, $params);
    }
    
    /**
     * Lấy thông tin tài khoản theo email
     */
    public static function selectByEmail($email) {
        $sql = "SELECT * FROM taikhoan WHERE email = ?";
        return Database::queryOne($sql, [$email]);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho Tài khoản (User)
 */
function taikhoan_insert($username, $password, $email, $phone = '') {
    UserModel::insert($username, $password, $email, $phone);
}

function taikhoan_check($username, $password) {
    return UserModel::check($username, $password);
}

function taikhoan_exists($username) {
    return UserModel::exists($username);
}

function taikhoan_select_by_id($id) {
    return UserModel::selectById($id);
}

function taikhoan_update($id, $username, $password, $email, $phone) {
    UserModel::update($id, $username, $password, $email, $phone);
}

function taikhoan_select_all() {
    return UserModel::selectAll();
}

function taikhoan_delete($id) {
    UserModel::delete($id);
}

function taikhoan_update_admin($id, $username, $password, $email, $phone, $role) {
    UserModel::updateAdmin($id, $username, $password, $email, $phone, $role);
}

function taikhoan_insert_admin($username, $password, $email, $phone, $role) {
    UserModel::insertAdmin($username, $password, $email, $phone, $role);
}

function taikhoan_email_exists($email) {
    return UserModel::emailExists($email);
}

function taikhoan_phone_exists($phone) {
    return UserModel::phoneExists($phone);
}

function taikhoan_email_exists_except($email, $id) {
    return UserModel::emailExistsExcept($email, $id);
}

function taikhoan_phone_exists_except($phone, $id) {
    return UserModel::phoneExistsExcept($phone, $id);
}

function taikhoan_search($keyword, $role = 'all') {
    return UserModel::search($keyword, $role);
}

function taikhoan_select_by_email($email) {
    return UserModel::selectByEmail($email);
}
?>
