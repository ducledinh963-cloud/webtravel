<?php
/**
 * Controller quản lý tài khoản phía Admin
 */

function list_users() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $role = isset($_GET['role']) ? $_GET['role'] : 'all';
    
    $list_taikhoan = taikhoan_search($keyword, $role);
    
    require_once 'header.php';
    require_once 'taikhoan/list.php';
    require_once 'footer.php';
}

function add_user() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        if (empty($username) || empty($email) || empty($password)) {
            $loi = 'Vui lòng điền đầy đủ thông tin bắt buộc (*).';
        } elseif (taikhoan_exists($username)) {
            $loi = 'Tên đăng nhập đã tồn tại.';
        } else {
            try {
                taikhoan_insert_admin($username, $password, $email, $phone, $role);
                $thongbao = 'Thêm tài khoản thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Lỗi lưu tài khoản: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'taikhoan/add.php';
    require_once 'footer.php';
}

function edit_user() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $tk = taikhoan_select_by_id($_GET['id']);
        if ($tk) {
            require_once 'header.php';
            require_once 'taikhoan/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listtk');
            exit();
        }
    } else {
        header('Location: index.php?act=listtk');
        exit();
    }
}

function update_user() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        if (empty($username) || empty($email)) {
            $loi = 'Tên đăng nhập và Email không được để trống.';
            $tk = taikhoan_select_by_id($id);
            
            require_once 'header.php';
            require_once 'taikhoan/update.php';
            require_once 'footer.php';
        } else {
            try {
                // Kiểm tra tên trùng lắp
                $current_user = taikhoan_select_by_id($id);
                if ($username !== $current_user['username'] && taikhoan_exists($username)) {
                    $loi = 'Tên đăng nhập đã tồn tại.';
                    $tk = $current_user;
                    require_once 'header.php';
                    require_once 'taikhoan/update.php';
                    require_once 'footer.php';
                } else {
                    taikhoan_update_admin($id, $username, $password, $email, $phone, $role);
                    
                    // Nếu admin tự cập nhật tài khoản của chính mình, cập nhật lại session luôn
                    if ($id == $_SESSION['user']['id']) {
                        $_SESSION['user'] = taikhoan_select_by_id($id);
                    }
                    
                    header('Location: index.php?act=listtk&msg=Cập nhật tài khoản thành công!');
                    exit();
                }
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $tk = taikhoan_select_by_id($id);
                
                require_once 'header.php';
                require_once 'taikhoan/update.php';
                require_once 'footer.php';
            }
        }
    } else {
        header('Location: index.php?act=listtk');
        exit();
    }
}

function delete_user() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        // Không cho phép tự xóa tài khoản của chính mình
        if ($id == $_SESSION['user']['id']) {
            header('Location: index.php?act=listtk&msg=Lỗi: Bạn không thể tự xóa tài khoản của chính mình!');
            exit();
        }
        
        try {
            taikhoan_delete($id);
            header('Location: index.php?act=listtk&msg=Xóa tài khoản thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listtk&msg=Lỗi: Không thể xóa tài khoản này do có liên kết dữ liệu khác.');
            exit();
        }
    }
    header('Location: index.php?act=listtk');
    exit();
}
?>
