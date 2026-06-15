<?php
/**
 * Controller quản lý khu vui chơi giải trí / hoạt động du lịch phía Admin
 */

function list_entertainment() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_giaitri = giaitri_select_all();
    
    require_once 'header.php';
    require_once 'giaitri/list.php';
    require_once 'footer.php';
}

function add_entertainment() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $rating = trim($_POST['rating']);
        $description = trim($_POST['description']);
        
        // Image Upload
        $image = 'uploads/entertainment1.png'; // Default fallback
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Allow certain file formats
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
        
        if (empty($name)) {
            $loi = 'Tên hoạt động / khu vui chơi không được phép để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực không được phép để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá vé phải là số và không được nhỏ hơn 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                giaitri_insert($name, $image, $description, $price, $address, $rating);
                $thongbao = 'Thêm hoạt động giải trí mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'giaitri/add.php';
    require_once 'footer.php';
}

function edit_entertainment() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $gt = giaitri_select_by_id($_GET['id']);
        if ($gt) {
            require_once 'header.php';
            require_once 'giaitri/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listgt');
            exit();
        }
    } else {
        header('Location: index.php?act=listgt');
        exit();
    }
}

function update_entertainment() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $rating = trim($_POST['rating']);
        $description = trim($_POST['description']);
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
        
        if (empty($name)) {
            $loi = 'Tên hoạt động / khu vui chơi không được để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực không được để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá vé phải là số và >= 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                giaitri_update($id, $name, $image, $description, $price, $address, $rating);
                header('Location: index.php?act=listgt&msg=Cập nhật thông tin giải trí thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $gt = giaitri_select_by_id($id);
                
                require_once 'header.php';
                require_once 'giaitri/update.php';
                require_once 'footer.php';
            }
        } else {
            $gt = giaitri_select_by_id($id);
            require_once 'header.php';
            require_once 'giaitri/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listgt');
        exit();
    }
}

function delete_entertainment() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            giaitri_delete($_GET['id']);
            header('Location: index.php?act=listgt&msg=Xóa hoạt động giải trí thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listgt&msg=Lỗi: Không thể xóa hoạt động này.');
            exit();
        }
    }
    header('Location: index.php?act=listgt');
    exit();
}
?>
