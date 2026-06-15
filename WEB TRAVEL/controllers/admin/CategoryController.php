<?php
/**
 * Controller quản lý danh mục phía Admin
 */

function list_dm() {
    global $list_danhmuc;
    
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_danhmuc = danhmuc_select_all();
    
    require_once 'header.php';
    require_once 'danhmuc/list.php';
    require_once 'footer.php';
}

function add_dm() {
    global $list_danhmuc;
    
    $thongbao = '';
    $loi = '';
    
    if (isset($_POST['themmoi'])) {
        $name = trim($_POST['name']);
        if (empty($name)) {
            $loi = 'Tên danh mục không được phép để trống.';
        } else {
            try {
                danhmuc_insert($name);
                $thongbao = 'Thêm danh mục mới thành công!';
                $_POST = array(); // Clear form
            } catch (Exception $e) {
                $loi = 'Đã xảy ra lỗi khi lưu vào CSDL: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'header.php';
    require_once 'danhmuc/add.php';
    require_once 'footer.php';
}

function edit_dm() {
    global $list_danhmuc;
    
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $dm = danhmuc_select_by_id($_GET['id']);
        if ($dm) {
            require_once 'header.php';
            require_once 'danhmuc/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listdm');
            exit();
        }
    } else {
        header('Location: index.php?act=listdm');
        exit();
    }
}

function update_dm() {
    global $list_danhmuc;
    $loi = '';
    
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        if (empty($name)) {
            $loi = 'Tên danh mục không được phép để trống.';
            $dm = danhmuc_select_by_id($id);
            
            require_once 'header.php';
            require_once 'danhmuc/update.php';
            require_once 'footer.php';
        } else {
            try {
                danhmuc_update($id, $name);
                header('Location: index.php?act=listdm&msg=Cập nhật danh mục thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
                $dm = danhmuc_select_by_id($id);
                
                require_once 'header.php';
                require_once 'danhmuc/update.php';
                require_once 'footer.php';
            }
        }
    } else {
        header('Location: index.php?act=listdm');
        exit();
    }
}

function delete_dm() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            danhmuc_delete($_GET['id']);
            header('Location: index.php?act=listdm&msg=Xóa danh mục thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listdm&msg=Lỗi: Không thể xóa danh mục này do ràng buộc dữ liệu.');
            exit();
        }
    }
    header('Location: index.php?act=listdm');
    exit();
}
?>
