<?php
/**
 * Controller quản lý bài viết/tin tức phía Admin
 */

function list_tt() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_tintuc = tintuc_select_all();
    
    require_once 'header.php';
    require_once 'tintuc/list.php';
    require_once 'footer.php';
}

function add_tt() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $date = trim($_POST['date']);
        
        // Mặc định ngày hiện tại định dạng "Ngày ThTháng" nếu bỏ trống
        if (empty($date)) {
            $months_vn = ["Th01", "Th02", "Th03", "Th04", "Th05", "Th06", "Th07", "Th08", "Th09", "Th10", "Th11", "Th12"];
            $day = date('d');
            $month = (int)date('m');
            $date = $day . ' ' . $months_vn[$month - 1];
        }
        
        // Image Upload
        $image = 'uploads/news1.png'; // Fallback default image
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (in_array($image_file_type, ["jpg", "jpeg", "png", "gif"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = "uploads/" . basename($_FILES["image"]["name"]);
                } else {
                    $loi = 'Lỗi không thể tải hình ảnh lên thư mục uploads.';
                }
            } else {
                $loi = 'Định dạng ảnh không hợp lệ (Chỉ chấp nhận JPG, JPEG, PNG, GIF).';
            }
        }
        
        if (empty($title)) {
            $loi = 'Tiêu đề bài viết không được để trống.';
        } elseif (empty($description)) {
            $loi = 'Nội dung bài viết không được để trống.';
        }
        
        if (empty($loi)) {
            try {
                tintuc_insert($title, $image, $description, $date);
                $thongbao = 'Đăng bài viết mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'tintuc/add.php';
    require_once 'footer.php';
}

function edit_tt() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $tt = tintuc_select_by_id($_GET['id']);
        if ($tt) {
            require_once 'header.php';
            require_once 'tintuc/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listtt');
            exit();
        }
    } else {
        header('Location: index.php?act=listtt');
        exit();
    }
}

function update_tt() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $date = trim($_POST['date']);
        $old_image = $_POST['old_image'];
        
        // Image Upload
        $image = $old_image; // Keep old image by default
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (in_array($image_file_type, ["jpg", "jpeg", "png", "gif"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = "uploads/" . basename($_FILES["image"]["name"]);
                } else {
                    $loi = 'Lỗi không thể tải hình ảnh lên thư mục uploads.';
                }
            } else {
                $loi = 'Định dạng ảnh không hợp lệ (Chỉ chấp nhận JPG, JPEG, PNG, GIF).';
            }
        }
        
        if (empty($title)) {
            $loi = 'Tiêu đề bài viết không được để trống.';
        } elseif (empty($description)) {
            $loi = 'Nội dung bài viết không được để trống.';
        }
        
        if (empty($loi)) {
            try {
                tintuc_update($id, $title, $image, $description, $date);
                header('Location: index.php?act=listtt&msg=Cập nhật bài viết thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $tt = tintuc_select_by_id($id);
                
                require_once 'header.php';
                require_once 'tintuc/update.php';
                require_once 'footer.php';
            }
        } else {
            $tt = tintuc_select_by_id($id);
            require_once 'header.php';
            require_once 'tintuc/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listtt');
        exit();
    }
}

function delete_tt() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            tintuc_delete($_GET['id']);
            header('Location: index.php?act=listtt&msg=Xóa bài viết thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listtt&msg=Lỗi: Không thể xóa bài viết này.');
            exit();
        }
    }
    header('Location: index.php?act=listtt');
    exit();
}
?>
