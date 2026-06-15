<?php
/**
 * Controller quản lý xe cho thuê phía Admin
 */

function list_cars() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_cars = thuexe_select_all();
    
    require_once 'header.php';
    require_once 'thuexe/list.php';
    require_once 'footer.php';
}

function add_car() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $rating = trim($_POST['rating']);
        $description = trim($_POST['description']);
        
        // Image Upload
        $image = 'uploads/car1.png'; // Default fallback
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
            $loi = 'Tên xe không được phép để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực nhận xe không được phép để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá thuê xe phải là số và không được nhỏ hơn 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                thuexe_insert($name, $image, $description, $price, $address, $rating);
                $thongbao = 'Thêm xe thuê mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'thuexe/add.php';
    require_once 'footer.php';
}

function edit_car() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $car = thuexe_select_by_id($_GET['id']);
        if ($car) {
            require_once 'header.php';
            require_once 'thuexe/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listtx');
            exit();
        }
    } else {
        header('Location: index.php?act=listtx');
        exit();
    }
}

function update_car() {
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
            $loi = 'Tên xe không được để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực nhận xe không được để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá thuê xe phải là số và >= 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                thuexe_update($id, $name, $image, $description, $price, $address, $rating);
                header('Location: index.php?act=listtx&msg=Cập nhật thông tin xe thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $car = thuexe_select_by_id($id);
                
                require_once 'header.php';
                require_once 'thuexe/update.php';
                require_once 'footer.php';
            }
        } else {
            $car = thuexe_select_by_id($id);
            require_once 'header.php';
            require_once 'thuexe/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listtx');
        exit();
    }
}

function delete_car() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            thuexe_delete($_GET['id']);
            header('Location: index.php?act=listtx&msg=Xóa xe thuê thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listtx&msg=Lỗi: Không thể xóa xe thuê này.');
            exit();
        }
    }
    header('Location: index.php?act=listtx');
    exit();
}
?>
