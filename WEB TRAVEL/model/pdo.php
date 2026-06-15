<?php
/**
 * Lớp Database kết nối cơ sở dữ liệu sử dụng PDO
 */
class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $dburl = "mysql:host=127.0.0.1;dbname=web_travel;charset=utf8mb4";
            $username = 'root';
            $password = '';

            try {
                self::$conn = new PDO($dburl, $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage() . "<br>Vui lòng đảm bảo đã bật MySQL trong XAMPP và import file 'database.sql'.");
            }
        }
        return self::$conn;
    }

    /**
     * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
     */
    public static function execute($sql, $args = []) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT) trả về nhiều bản ghi
     */
    public static function query($sql, $args = []) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh sql truy vấn một bản ghi
     */
    public static function queryOne($sql, $args = []) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Thực thi câu lệnh sql truy vấn một giá trị
     */
    public static function queryValue($sql, $args = []) {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($args);
            $row = $stmt->fetch(PDO::FETCH_NUM);
            return $row ? $row[0] : null;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

/**
 * Các hàm wrapper tương thích ngược với mô hình procedural cũ
 */
function pdo_get_connection() {
    return Database::getConnection();
}

function pdo_execute($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    Database::execute($sql, $sql_args);
}

function pdo_query($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    return Database::query($sql, $sql_args);
}

function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    return Database::queryOne($sql, $sql_args);
}

function pdo_query_value($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    return Database::queryValue($sql, $sql_args);
}
?>
