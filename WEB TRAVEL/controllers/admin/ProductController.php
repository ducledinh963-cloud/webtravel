<?php
/**
 * Controller quản lý sản phẩm (Tour) phía Admin
 */

function list_sp() {
    global $list_danhmuc;
    
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $id_danhmuc = isset($_GET['id_danhmuc']) ? $_GET['id_danhmuc'] : '';

    if ($id_danhmuc != '') {
        $list_sanpham = sanpham_select_by_danhmuc($id_danhmuc);
    } elseif ($keyword != '') {
        $list_sanpham = sanpham_search($keyword);
    } else {
        $list_sanpham = sanpham_select_all();
    }

    require_once 'header.php';
    require_once 'sanpham/list.php';
    require_once 'footer.php';
}

function add_sp() {
    global $list_danhmuc;
    
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $id_danhmuc = $_POST['id_danhmuc'];
        $name = trim($_POST['name']);
        $price = $_POST['price'];
        $price_sale = $_POST['price_sale'];
        $description = trim($_POST['description']);
        
        $image_path = '';
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $file_name = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $file_name;
            
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allow_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (!in_array($imageFileType, $allow_types)) {
                $loi = 'Định dạng hình ảnh không hợp lệ (Chỉ nhận JPG, JPEG, PNG, GIF, WEBP).';
            } elseif ($_FILES['image']['size'] > 2097152) { // 2MB
                $loi = 'Kích thước tệp tin ảnh quá lớn (Phải nhỏ hơn 2MB).';
            } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = 'uploads/' . $file_name;
            } else {
                $loi = 'Không thể tải tệp tin ảnh lên máy chủ.';
            }
        } else {
            $loi = 'Vui lòng chọn hình ảnh đại diện cho tour du lịch.';
        }

        if (empty($name) || empty($id_danhmuc) || empty($price)) {
            $loi = 'Vui lòng điền đầy đủ các thông tin bắt buộc (*).';
        }

        if ($loi == '') {
            try {
                sanpham_insert($name, $price, $price_sale, $image_path, $description, $id_danhmuc);
                $thongbao = 'Đăng tải tour du lịch mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Lỗi lưu CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'sanpham/add.php';
    require_once 'footer.php';
}

function edit_sp() {
    global $list_danhmuc;
    
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $sp = sanpham_select_by_id($_GET['id']);
        if ($sp) {
            require_once 'header.php';
            require_once 'sanpham/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listsp');
            exit();
        }
    } else {
        header('Location: index.php?act=listsp');
        exit();
    }
}

function update_sp() {
    global $list_danhmuc;
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $id_danhmuc = $_POST['id_danhmuc'];
        $name = trim($_POST['name']);
        $price = $_POST['price'];
        $price_sale = $_POST['price_sale'];
        $description = trim($_POST['description']);

        $sp_old = sanpham_select_by_id($id);
        $image_path = $sp_old['image'];

        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $target_dir = "../uploads/";
            $file_name = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $file_name;
            
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allow_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (!in_array($imageFileType, $allow_types)) {
                $loi = 'Định dạng hình ảnh không hợp lệ (Chỉ nhận JPG, JPEG, PNG, GIF, WEBP).';
            } elseif ($_FILES['image']['size'] > 2097152) { // 2MB
                $loi = 'Kích thước tệp tin ảnh quá lớn (Phải nhỏ hơn 2MB).';
            } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = 'uploads/' . $file_name;
                
                if (!empty($sp_old['image']) && strpos($sp_old['image'], 'http') !== 0) {
                    $old_file_physical = '../' . $sp_old['image'];
                    if (file_exists($old_file_physical)) {
                        @unlink($old_file_physical);
                    }
                }
            } else {
                $loi = 'Không thể tải tệp tin ảnh mới lên máy chủ.';
            }
        }

        if (empty($name) || empty($id_danhmuc) || empty($price)) {
            $loi = 'Vui lòng điền đầy đủ các thông tin bắt buộc (*).';
        }

        if ($loi == '') {
            try {
                sanpham_update($id, $name, $price, $price_sale, $image_path, $description, $id_danhmuc);
                header('Location: index.php?act=listsp&msg=Cập nhật tour du lịch thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật CSDL: ' . $e->getMessage();
                $sp = sanpham_select_by_id($id);
                require_once 'header.php';
                require_once 'sanpham/update.php';
                require_once 'footer.php';
            }
        } else {
            $sp = sanpham_select_by_id($id);
            require_once 'header.php';
            require_once 'sanpham/update.php';
            require_once 'footer.php';
        }
    } else {
        header('Location: index.php?act=listsp');
        exit();
    }
}

function delete_sp() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $sp = sanpham_select_by_id($_GET['id']);
        if ($sp) {
            if (!empty($sp['image']) && strpos($sp['image'], 'http') !== 0) {
                $file_physical = '../' . $sp['image'];
                if (file_exists($file_physical)) {
                    @unlink($file_physical);
                }
            }
            sanpham_delete($_GET['id']);
            header('Location: index.php?act=listsp&msg=Xóa tour du lịch thành công!');
            exit();
        }
    }
    header('Location: index.php?act=listsp');
    exit();
}
?>
