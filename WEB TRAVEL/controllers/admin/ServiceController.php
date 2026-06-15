<?php
/**
 * Controller quản lý dịch vụ phía Admin
 */

function list_dv() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_dichvu = dichvu_select_all();
    
    require_once 'header.php';
    require_once 'dichvu/list.php';
    require_once 'footer.php';
}

function add_dv() {
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        $icon = trim($_POST['icon']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        
        if (empty($name)) {
            $loi = 'Tên dịch vụ không được phép để trống.';
        } elseif (empty($icon)) {
            $loi = 'Vui lòng chọn hoặc nhập biểu tượng (icon) đại diện.';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá dịch vụ phải là số và không được nhỏ hơn 0.';
        } else {
            try {
                dichvu_insert($name, $icon, $description, $price);
                $thongbao = 'Thêm dịch vụ mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'dichvu/add.php';
    require_once 'footer.php';
}

function edit_dv() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $dv = dichvu_select_by_id($_GET['id']);
        if ($dv) {
            require_once 'header.php';
            require_once 'dichvu/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listdv');
            exit();
        }
    } else {
        header('Location: index.php?act=listdv');
        exit();
    }
}

function update_dv() {
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $icon = trim($_POST['icon']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        
        if (empty($name)) {
            $loi = 'Tên dịch vụ không được phép để trống.';
            $dv = dichvu_select_by_id($id);
            
            require_once 'header.php';
            require_once 'dichvu/update.php';
            require_once 'footer.php';
        } elseif (empty($icon)) {
            $loi = 'Vui lòng chọn hoặc nhập biểu tượng (icon) đại diện.';
            $dv = dichvu_select_by_id($id);
            
            require_once 'header.php';
            require_once 'dichvu/update.php';
            require_once 'footer.php';
        } elseif ($price === '' || !is_numeric($price) || $price < 0) {
            $loi = 'Giá dịch vụ phải là số và không được nhỏ hơn 0.';
            $dv = dichvu_select_by_id($id);
            
            require_once 'header.php';
            require_once 'dichvu/update.php';
            require_once 'footer.php';
        } else {
            try {
                dichvu_update($id, $name, $icon, $description, $price);
                header('Location: index.php?act=listdv&msg=Cập nhật dịch vụ thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $dv = dichvu_select_by_id($id);
                
                require_once 'header.php';
                require_once 'dichvu/update.php';
                require_once 'footer.php';
            }
        }
    } else {
        header('Location: index.php?act=listdv');
        exit();
    }
}

function delete_dv() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            dichvu_delete($_GET['id']);
            header('Location: index.php?act=listdv&msg=Xóa dịch vụ thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listdv&msg=Lỗi: Không thể xóa dịch vụ này.');
            exit();
        }
    }
    header('Location: index.php?act=listdv');
    exit();
}
?>
