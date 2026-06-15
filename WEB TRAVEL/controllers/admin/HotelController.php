<?php
/**
 * Controller quản lý khách sạn phía Admin
 */

function list_ks() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_khachsan = khachsan_select_all();
    
    require_once 'header.php';
    require_once 'khachsan/list.php';
    require_once 'footer.php';
}

function add_ks() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $stars = trim($_POST['stars']);
        $price = trim($_POST['price']);
        $price_sale = trim($_POST['price_sale']);
        $location = trim($_POST['location']);
        $category = trim($_POST['category']);
        $region = trim($_POST['region']);
        
        // Image Upload
        $image = 'uploads/hotel1.jpg'; // Default fallback
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
            $loi = 'Tên khách sạn không được phép để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ không được phép để trống.';
        } elseif (empty($location)) {
            $loi = 'Địa điểm (thành phố/tỉnh) không được phép để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá phòng gốc phải là số và không được nhỏ hơn 0.';
        } elseif ($price_sale !== '' && (!is_numeric($price_sale) || $price_sale < 0)) {
            $loi = 'Giá phòng khuyến mãi phải là số và không được nhỏ hơn 0.';
        } elseif ($stars < 1 || $stars > 5) {
            $loi = 'Xếp hạng sao phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                $price_sale_val = ($price_sale === '') ? 0 : $price_sale;
                khachsan_insert_full($name, $address, $stars, $price, $price_sale_val, $image, $location, $category, $region);
                $thongbao = 'Thêm khách sạn mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'khachsan/add.php';
    require_once 'footer.php';
}

function edit_ks() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $ks = khachsan_select_by_id($_GET['id']);
        if ($ks) {
            require_once 'header.php';
            require_once 'khachsan/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listks');
            exit();
        }
    } else {
        header('Location: index.php?act=listks');
        exit();
    }
}

function update_ks() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $stars = trim($_POST['stars']);
        $price = trim($_POST['price']);
        $price_sale = trim($_POST['price_sale']);
        $location = trim($_POST['location']);
        $category = trim($_POST['category']);
        $region = trim($_POST['region']);
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
            $loi = 'Tên khách sạn không được để trống.';
        } elseif (empty($address)) {
            $loi = 'Địa chỉ không được để trống.';
        } elseif (empty($location)) {
            $loi = 'Địa điểm không được để trống.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá phòng gốc phải là số và >= 0.';
        } elseif ($price_sale !== '' && (!is_numeric($price_sale) || $price_sale < 0)) {
            $loi = 'Giá phòng khuyến mãi phải là số và >= 0.';
        } elseif ($stars < 1 || $stars > 5) {
            $loi = 'Xếp hạng sao phải từ 1 đến 5 sao.';
        }
        
        if (empty($loi)) {
            try {
                $price_sale_val = ($price_sale === '') ? 0 : $price_sale;
                khachsan_update_full($id, $name, $address, $stars, $price, $price_sale_val, $image, $location, $category, $region);
                header('Location: index.php?act=listks&msg=Cập nhật thông tin khách sạn thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $ks = khachsan_select_by_id($id);
                
                require_once 'header.php';
                require_once 'khachsan/update.php';
                require_once 'footer.php';
            }
        } else {
            $ks = khachsan_select_by_id($id);
            require_once 'header.php';
            require_once 'khachsan/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listks');
        exit();
    }
}

function delete_ks() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            khachsan_delete($_GET['id']);
            header('Location: index.php?act=listks&msg=Xóa khách sạn thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listks&msg=Lỗi: Không thể xóa khách sạn này.');
            exit();
        }
    }
    header('Location: index.php?act=listks');
    exit();
}
?>
