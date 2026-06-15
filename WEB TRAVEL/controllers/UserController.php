<?php
/**
 * Controller xử lý tài khoản, đăng ký, đăng nhập thành viên phía Client
 */

function register() {
    global $list_danhmuc;
    
    $thongbao = '';
    $thongbao_success = '';

    if (isset($_POST['dangky'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
            $thongbao = 'Vui lòng điền đầy đủ tất cả các thông tin. Không được bỏ trống bất kỳ trường nào.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $thongbao = 'Địa chỉ Email không đúng định dạng.';
        } elseif (!preg_match('/^[0-9]+$/', $phone)) {
            $thongbao = 'Số điện thoại không đúng định dạng số (chỉ được chứa các chữ số từ 0-9).';
        } elseif (strlen($phone) < 10 || strlen($phone) > 11) {
            $thongbao = 'Số điện thoại phải có độ dài từ 10 đến 11 chữ số.';
        } elseif (strlen($password) < 6) {
            $thongbao = 'Mật khẩu phải có độ dài tối thiểu 6 ký tự.';
        } elseif ($password !== $confirm_password) {
            $thongbao = 'Mật khẩu xác nhận không trùng khớp.';
        } elseif (taikhoan_exists($username)) {
            $thongbao = 'Tên đăng nhập đã tồn tại trên hệ thống.';
        } elseif (taikhoan_email_exists($email)) {
            $thongbao = 'Địa chỉ Email đã tồn tại trên hệ thống.';
        } elseif (taikhoan_phone_exists($phone)) {
            $thongbao = 'Số điện thoại đã tồn tại trên hệ thống.';
        } else {
            try {
                taikhoan_insert($username, $password, $email, $phone);
                $thongbao_success = 'Đăng ký tài khoản thành viên thành công! Bạn có thể đăng nhập ngay bây giờ.';
                $_POST = array(); // Xóa dữ liệu cũ trong form
            } catch (Exception $e) {
                $thongbao = 'Đã có lỗi xảy ra: ' . $e->getMessage();
            }
        }
    }

    require_once 'view/header.php';
    require_once 'view/dangky.php';
    require_once 'view/footer.php';
}

function login() {
    global $list_danhmuc;
    
    $thongbao = '';

    if (isset($_POST['dangnhap'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $thongbao = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu.';
        } else {
            $user = taikhoan_check($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit();
            } else {
                $thongbao = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
            }
        }
    }

    require_once 'view/header.php';
    require_once 'view/dangnhap.php';
    require_once 'view/footer.php';
}

function logout() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
    header('Location: index.php');
    exit();
}

function edit_profile() {
    global $list_danhmuc;
    
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?act=dangnhap');
        exit();
    }
    
    $thongbao = '';
    $thongbao_success = '';
    
    $user_id = $_SESSION['user']['id'];
    
    if (isset($_POST['capnhat'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];
        
        if (empty($username) || empty($email) || empty($phone)) {
            $thongbao = 'Vui lòng điền đầy đủ tất cả thông tin bắt buộc (*).';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $thongbao = 'Địa chỉ Email không đúng định dạng.';
        } elseif (!preg_match('/^[0-9]+$/', $phone)) {
            $thongbao = 'Số điện thoại không đúng định dạng số (chỉ được chứa các chữ số từ 0-9).';
        } elseif (strlen($phone) < 10 || strlen($phone) > 11) {
            $thongbao = 'Số điện thoại phải có độ dài từ 10 đến 11 chữ số.';
        } elseif (!empty($password) && strlen($password) < 6) {
            $thongbao = 'Mật khẩu mới phải có độ dài tối thiểu 6 ký tự.';
        } else {
            try {
                if ($username !== $_SESSION['user']['username'] && taikhoan_exists($username)) {
                    $thongbao = 'Tên đăng nhập đã tồn tại trên hệ thống.';
                } elseif ($email !== $_SESSION['user']['email'] && taikhoan_email_exists_except($email, $user_id)) {
                    $thongbao = 'Địa chỉ Email đã được đăng ký bởi một tài khoản khác.';
                } elseif ($phone !== $_SESSION['user']['phone'] && taikhoan_phone_exists_except($phone, $user_id)) {
                    $thongbao = 'Số điện thoại đã được đăng ký bởi một tài khoản khác.';
                } else {
                    taikhoan_update($user_id, $username, $password, $email, $phone);
                    // Cập nhật lại session
                    $_SESSION['user'] = taikhoan_select_by_id($user_id);
                    $thongbao_success = 'Cập nhật thông tin tài khoản thành công!';
                }
            } catch (Exception $e) {
                $thongbao = 'Đã có lỗi xảy ra: ' . $e->getMessage();
            }
        }
    }
    
    $user = taikhoan_select_by_id($user_id);
    
    require_once 'view/header.php';
    require_once 'view/taikhoan.php';
    require_once 'view/footer.php';
}

function forgot_password() {
    global $list_danhmuc;
    
    $thongbao = '';
    $thongbao_success = '';

    if (isset($_POST['guiyeucau'])) {
        $email = trim($_POST['email']);

        if (empty($email)) {
            $thongbao = 'Vui lòng nhập địa chỉ Email của bạn.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $thongbao = 'Địa chỉ Email không đúng định dạng.';
        } else {
            $user = taikhoan_select_by_email($email);
            if ($user) {
                // Generate a random temporary password
                $new_plain_password = 'temp_' . rand(100000, 999999);
                
                // Update password in database
                taikhoan_update($user['id'], $user['username'], $new_plain_password, $user['email'], $user['phone']);
                
                // For user testing purposes, we display it on the screen!
                $thongbao_success = 'Yêu cầu khôi phục mật khẩu thành công! Mật khẩu mới của tài khoản <strong>' . htmlspecialchars($user['username']) . '</strong> đã được đặt lại là: <span style="font-size: 16px; font-weight: bold; color: var(--primary-color); background-color: #eff6ff; padding: 4px 8px; border-radius: 4px; border: 1px solid #bfdbfe; font-family: monospace;">' . $new_plain_password . '</span>. Vui lòng ghi nhớ mật khẩu này và đổi lại sau khi đăng nhập.';
            } else {
                $thongbao = 'Địa chỉ Email này không khớp với bất kỳ tài khoản nào trên hệ thống.';
            }
        }
    }

    require_once 'view/header.php';
    require_once 'view/quenmk.php';
    require_once 'view/footer.php';
}
?>
