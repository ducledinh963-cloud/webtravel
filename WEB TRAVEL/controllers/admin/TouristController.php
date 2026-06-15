<?php
/**
 * Controller quản lý du khách phía Admin
 */

require_once '../model/dukhach.php';

function list_tourists() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    
    // Xử lý tìm kiếm và bộ lọc giới tính
    $keyword = '';
    $gender = '';
    
    if (isset($_POST['search_submit'])) {
        $keyword = trim($_POST['keyword']);
        $gender = $_POST['gender'];
        $_SESSION['tourist_search_keyword'] = $keyword;
        $_SESSION['tourist_search_gender'] = $gender;
    } elseif (isset($_GET['clear_search'])) {
        unset($_SESSION['tourist_search_keyword']);
        unset($_SESSION['tourist_search_gender']);
    } else {
        $keyword = isset($_SESSION['tourist_search_keyword']) ? $_SESSION['tourist_search_keyword'] : '';
        $gender = isset($_SESSION['tourist_search_gender']) ? $_SESSION['tourist_search_gender'] : '';
    }
    
    $list_dukhach = DuKhachModel::search($keyword, $gender);
    
    require_once 'header.php';
    require_once 'dukhach/list.php';
    require_once 'footer.php';
}

function add_tourist() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $passport = trim($_POST['passport']);
        $nationality = trim($_POST['nationality']);
        $gender = $_POST['gender'];
        $birthdate = trim($_POST['birthdate']);
        
        // Image Upload
        $image = 'uploads/tiny_placeholder.png'; // Fallback
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (in_array($image_file_type, ["jpg", "jpeg", "png", "gif", "svg"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = "uploads/" . basename($_FILES["image"]["name"]);
                } else {
                    $loi = 'Lỗi không thể tải hình ảnh lên thư mục uploads.';
                }
            } else {
                $loi = 'Định dạng ảnh không hợp lệ (Chấp nhận JPG, JPEG, PNG, GIF, SVG).';
            }
        } else {
            // Mặc định tự sinh SVG avatar ngẫu nhiên dựa trên tên nếu không tải ảnh lên
            $initials = DuKhachModel::getInitials($name);
            $random_colors = [
                ['#10b981', '#047857'],
                ['#3b82f6', '#1d4ed8'],
                ['#ec4899', '#be185d'],
                ['#f59e0b', '#b45309']
            ];
            $grad = $random_colors[rand(0, 3)];
            $svg_content = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
  <defs>
    <linearGradient id="grad_new" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:' . $grad[0] . ';stop-opacity:1" />
      <stop offset="100%" style="stop-color:' . $grad[1] . ';stop-opacity:1" />
    </linearGradient>
  </defs>
  <circle cx="50" cy="50" r="50" fill="url(#grad_new)" />
  <text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-size="34" font-weight="800" font-family="\'Outfit\', \'Segoe UI\', sans-serif">' . $initials . '</text>
</svg>';
            $new_filename = 'dukhach_new_' . time() . '.svg';
            file_put_contents($target_dir = "../uploads/" . $new_filename, $svg_content);
            $image = "uploads/" . $new_filename;
        }
        
        // Validation
        if (empty($name)) {
            $loi = 'Họ tên du khách không được để trống.';
        } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loi = 'Địa chỉ Email không hợp lệ.';
        } elseif (empty($phone) || !preg_match('/^[0-9]{10,11}$/', $phone)) {
            $loi = 'Số điện thoại không hợp lệ (phải gồm 10-11 chữ số).';
        }
        
        if (empty($loi)) {
            try {
                DuKhachModel::insert($name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate);
                $thongbao = 'Thêm mới du khách thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Lỗi lưu dữ liệu: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'dukhach/add.php';
    require_once 'footer.php';
}

function edit_tourist() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $dk = DuKhachModel::selectById($_GET['id']);
        if ($dk) {
            require_once 'header.php';
            require_once 'dukhach/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listdk');
            exit();
        }
    } else {
        header('Location: index.php?act=listdk');
        exit();
    }
}

function update_tourist() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $passport = trim($_POST['passport']);
        $nationality = trim($_POST['nationality']);
        $gender = $_POST['gender'];
        $birthdate = trim($_POST['birthdate']);
        $old_image = $_POST['old_image'];
        
        // Image Upload
        $image = $old_image; // Keep old image by default
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (in_array($image_file_type, ["jpg", "jpeg", "png", "gif", "svg"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = "uploads/" . basename($_FILES["image"]["name"]);
                } else {
                    $loi = 'Lỗi không thể tải hình ảnh lên thư mục uploads.';
                }
            } else {
                $loi = 'Định dạng ảnh không hợp lệ (Chấp nhận JPG, JPEG, PNG, GIF, SVG).';
            }
        }
        
        // Validation
        if (empty($name)) {
            $loi = 'Họ tên du khách không được để trống.';
        } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loi = 'Địa chỉ Email không hợp lệ.';
        } elseif (empty($phone) || !preg_match('/^[0-9]{10,11}$/', $phone)) {
            $loi = 'Số điện thoại không hợp lệ (phải gồm 10-11 chữ số).';
        }
        
        if (empty($loi)) {
            try {
                DuKhachModel::update($id, $name, $image, $email, $phone, $address, $passport, $nationality, $gender, $birthdate);
                header('Location: index.php?act=listdk&msg=Cập nhật du khách thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $dk = DuKhachModel::selectById($id);
                require_once 'header.php';
                require_once 'dukhach/update.php';
                require_once 'footer.php';
            }
        } else {
            $dk = DuKhachModel::selectById($id);
            require_once 'header.php';
            require_once 'dukhach/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listdk');
        exit();
    }
}

function delete_tourist() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            // Có thể xóa ảnh đại diện nếu là ảnh tự sinh mới
            $dk = DuKhachModel::selectById($_GET['id']);
            if ($dk && strpos($dk['image'], 'dukhach_new_') !== false) {
                @unlink('../' . $dk['image']);
            }
            
            DuKhachModel::delete($_GET['id']);
            header('Location: index.php?act=listdk&msg=Xóa du khách thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listdk&msg=Lỗi: Không thể xóa du khách này.');
            exit();
        }
    }
    header('Location: index.php?act=listdk');
    exit();
}
?>
