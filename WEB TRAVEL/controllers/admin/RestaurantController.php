<?php
/**
 * Controller quản lý nhà hàng / đặc sản món ngon phía Admin
 */

function list_restaurants() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_nhahang = nhahang_select_all();
    
    require_once 'header.php';
    require_once 'nhahang/list.php';
    require_once 'footer.php';
}

function add_restaurant() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $price = trim($_POST['price']);
        $rating = trim($_POST['rating']);
        $description = trim($_POST['description']);
        
        // Image Upload
        $image = 'uploads/seafood1.png'; // Default fallback
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
            $loi = 'Tên món ăn / nhà hàng không được phép để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực không được phép để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá món ăn phải là số và không được nhỏ hơn 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                nhahang_insert($name, $image, $description, $price, $address, $rating);
                $thongbao = 'Thêm món ngon / nhà hàng mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'nhahang/add.php';
    require_once 'footer.php';
}

function edit_restaurant() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $nh = nhahang_select_by_id($_GET['id']);
        if ($nh) {
            require_once 'header.php';
            require_once 'nhahang/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listnh');
            exit();
        }
    } else {
        header('Location: index.php?act=listnh');
        exit();
    }
}

function update_restaurant() {
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
            $loi = 'Tên món ăn / nhà hàng không được để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ / Khu vực không được để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá món ăn phải là số và >= 0.';
        } elseif ($rating === '' || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            $loi = 'Đánh giá phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                nhahang_update($id, $name, $image, $description, $price, $address, $rating);
                header('Location: index.php?act=listnh&msg=Cập nhật thông tin món ngon thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $nh = nhahang_select_by_id($id);
                
                require_once 'header.php';
                require_once 'nhahang/update.php';
                require_once 'footer.php';
            }
        } else {
            $nh = nhahang_select_by_id($id);
            require_once 'header.php';
            require_once 'nhahang/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listnh');
        exit();
    }
}

function delete_restaurant() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            nhahang_delete($_GET['id']);
            header('Location: index.php?act=listnh&msg=Xóa món ngon / nhà hàng thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listnh&msg=Lỗi: Không thể xóa món ngon này.');
            exit();
        }
    }
    header('Location: index.php?act=listnh');
    exit();
}
?>
