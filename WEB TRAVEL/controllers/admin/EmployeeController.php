<?php
/**
 * Controller quản lý tài khoản nhân viên phía Admin (role = 2)
 */

function list_employees() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    
    // Check if we need to seed the 140 employees automatically
    $list_nhanvien_check = taikhoan_search('', 2);
    if (count($list_nhanvien_check) < 140) {
        try {
            $db = Database::getConnection();
            
            // 1. Delete all employees except id = 2 (nhanvien1) to ensure clean state
            $db->exec("DELETE FROM taikhoan WHERE role = 2 AND id != 2");
            
            // 2. Generate 139 new employees (nhanvien2 to nhanvien140)
            $password_hash = password_hash('123456', PASSWORD_DEFAULT);
            $sql = "INSERT INTO taikhoan (id, username, password, email, phone, role) VALUES (?, ?, ?, ?, ?, 2)";
            $stmt = $db->prepare($sql);
            
            for ($i = 2; $i <= 140; $i++) {
                $id = $i + 2; // nhanvien2 -> id 4, nhanvien3 -> id 5, ..., nhanvien140 -> id 142
                $username = "nhanvien{$i}";
                $email = "nhanvien{$i}@webtravel.com";
                $phone = "092" . str_pad($i, 7, "0", STR_PAD_LEFT);
                $stmt->execute([$id, $username, $password_hash, $email, $phone]);
            }
            
            // 3. Update database.sql file
            $sql_file = '../database.sql';
            if (file_exists($sql_file)) {
                $sql_content = file_get_contents($sql_file);
                
                $admin_hash = '$2y$10$Y73rM5iHlPzT4nB4u6T2aeEeeuH74p6s/FjXQ.06NlW2zBv5D01mG';
                $nhanvien1_hash = '$2y$10$X8Hn1g69B2tN4O5u6T2aeEeeuH74p6s/FjXQ.06NlW2zBv5D01mG';
                $khachhang_hash = '$2y$10$Y73rM5iHlPzT4nB4u6T2aeEeeuH74p6s/FjXQ.06NlW2zBv5D01mG';
                
                $inserts = [];
                $inserts[] = "(1, 'admin123', '{$admin_hash}', 'admin@webtravel.com', '0987654321', 1)";
                $inserts[] = "(2, 'nhanvien1', '{$nhanvien1_hash}', 'nhanvien1@webtravel.com', '0912345678', 2)";
                $inserts[] = "(3, 'khachhang1', '{$khachhang_hash}', 'khachhang1@gmail.com', '0901234567', 0)";
                
                for ($i = 2; $i <= 140; $i++) {
                    $id = $i + 2;
                    $username = "nhanvien{$i}";
                    $email = "nhanvien{$i}@webtravel.com";
                    $phone = "092" . str_pad($i, 7, "0", STR_PAD_LEFT);
                    $inserts[] = "({$id}, '{$username}', '{$password_hash}', '{$email}', '{$phone}', 2)";
                }
                
                $insert_statement = "INSERT INTO `taikhoan` (`id`, `username`, `password`, `email`, `phone`, `role`) VALUES\n" . implode(",\n", $inserts) . ";";
                
                // Replace CREATE TABLE statement to be inline and correct
                $create_pattern = '/CREATE TABLE IF NOT EXISTS `taikhoan` \([\s\S]*?\) ENGINE=InnoDB[\s\S]*?;/';
                $new_create = "CREATE TABLE IF NOT EXISTS `taikhoan` (\n" .
                              "  `id` int(11) NOT NULL AUTO_INCREMENT,\n" .
                              "  `username` varchar(50) NOT NULL UNIQUE,\n" .
                              "  `password` varchar(255) NOT NULL,\n" .
                              "  `email` varchar(100) NOT NULL UNIQUE,\n" .
                              "  `phone` varchar(20) DEFAULT NULL UNIQUE,\n" .
                              "  `role` int(11) NOT NULL DEFAULT 0,\n" .
                              "  PRIMARY KEY (`id`)\n" .
                              ") ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                              
                if (preg_match($create_pattern, $sql_content)) {
                    $sql_content = preg_replace($create_pattern, $new_create, $sql_content);
                }
                
                // Replace INSERT INTO statement
                $insert_pattern = '/INSERT INTO `taikhoan` \(`id`, `username`, `password`, `email`, `phone`, `role`[\s\S]*?;\s*/';
                if (preg_match($insert_pattern, $sql_content)) {
                    $sql_content = preg_replace($insert_pattern, $insert_statement . "\n\n", $sql_content);
                }
                
                file_put_contents($sql_file, $sql_content);
            }
            $thongbao = 'Đã tự động khởi tạo 140 tài khoản nhân viên hệ thống và cập nhật database.sql!';
        } catch (Exception $e) {
            $thongbao = 'Lỗi tự động khởi tạo nhân viên: ' . $e->getMessage();
        }
        
        // Re-fetch the list after seeding
        $list_nhanvien = taikhoan_search($keyword, 2);
    } else {
        $list_nhanvien = taikhoan_search($keyword, 2);
    }
    
    require_once 'header.php';
    require_once 'nhanvien/list.php';
    require_once 'footer.php';
}

function add_employee() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        
        if (empty($username) || empty($email) || empty($password)) {
            $loi = 'Vui lòng điền đầy đủ thông tin bắt buộc (*).';
        } elseif (taikhoan_exists($username)) {
            $loi = 'Tên đăng nhập đã tồn tại.';
        } elseif (taikhoan_email_exists($email)) {
            $loi = 'Địa chỉ email đã tồn tại.';
        } elseif (!empty($phone) && taikhoan_phone_exists($phone)) {
            $loi = 'Số điện thoại đã tồn tại.';
        } else {
            try {
                // Thêm với role = 2 (Nhân viên)
                taikhoan_insert_admin($username, $password, $email, $phone, 2);
                $thongbao = 'Thêm nhân viên thành công!';
                $_POST = array(); // Xóa dữ liệu cũ trong form
            } catch (Exception $e) {
                $loi = 'Lỗi lưu thông tin nhân viên: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'nhanvien/add.php';
    require_once 'footer.php';
}

function edit_employee() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $tk = taikhoan_select_by_id($_GET['id']);
        // Kiểm tra xem tài khoản này có thực sự là nhân viên (role = 2) hay không
        if ($tk && $tk['role'] == 2) {
            require_once 'header.php';
            require_once 'nhanvien/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listnv&msg=Lỗi: Không tìm thấy nhân viên!');
            exit();
        }
    } else {
        header('Location: index.php?act=listnv');
        exit();
    }
}

function update_employee() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        $role = $_POST['role']; // Có thể cập nhật lại role (chuyển thành Admin hoặc Khách hàng)
        
        if (empty($username) || empty($email)) {
            $loi = 'Tên đăng nhập và Email không được để trống.';
            $tk = taikhoan_select_by_id($id);
            
            require_once 'header.php';
            require_once 'nhanvien/update.php';
            require_once 'footer.php';
        } else {
            try {
                $current_user = taikhoan_select_by_id($id);
                if ($username !== $current_user['username'] && taikhoan_exists($username)) {
                    $loi = 'Tên đăng nhập đã tồn tại.';
                    $tk = $current_user;
                    require_once 'header.php';
                    require_once 'nhanvien/update.php';
                    require_once 'footer.php';
                } elseif ($email !== $current_user['email'] && taikhoan_email_exists($email)) {
                    $loi = 'Địa chỉ email đã tồn tại.';
                    $tk = $current_user;
                    require_once 'header.php';
                    require_once 'nhanvien/update.php';
                    require_once 'footer.php';
                } elseif (!empty($phone) && $phone !== $current_user['phone'] && taikhoan_phone_exists($phone)) {
                    $loi = 'Số điện thoại đã tồn tại.';
                    $tk = $current_user;
                    require_once 'header.php';
                    require_once 'nhanvien/update.php';
                    require_once 'footer.php';
                } else {
                    taikhoan_update_admin($id, $username, $password, $email, $phone, $role);
                    
                    // Nếu admin tự cập nhật tài khoản của chính mình (trong trường hợp được liên kết)
                    if ($id == $_SESSION['user']['id']) {
                        $_SESSION['user'] = taikhoan_select_by_id($id);
                    }
                    
                    header('Location: index.php?act=listnv&msg=Cập nhật nhân viên thành công!');
                    exit();
                }
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $tk = taikhoan_select_by_id($id);
                
                require_once 'header.php';
                require_once 'nhanvien/update.php';
                require_once 'footer.php';
            }
        }
    } else {
        header('Location: index.php?act=listnv');
        exit();
    }
}

function delete_employee() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        
        // Không cho phép tự xóa tài khoản của chính mình
        if ($id == $_SESSION['user']['id']) {
            header('Location: index.php?act=listnv&msg=Lỗi: Bạn không thể tự xóa tài khoản của chính mình!');
            exit();
        }
        
        try {
            taikhoan_delete($id);
            header('Location: index.php?act=listnv&msg=Xóa nhân viên thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listnv&msg=Lỗi: Không thể xóa tài khoản này do có dữ liệu liên kết.');
            exit();
        }
    }
    header('Location: index.php?act=listnv');
    exit();
}
?>
