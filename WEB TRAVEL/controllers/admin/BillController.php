<?php
/**
 * Controller quản lý đơn hàng phía Admin
 */

function list_bill() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    $list_bill = bill_select_all();
    
    require_once 'header.php';
    require_once 'bill/list.php';
    require_once 'footer.php';
}

function edit_bill() {
    $loi = '';
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $bill = bill_select_by_id($_GET['id']);
        if ($bill) {
            require_once 'header.php';
            require_once 'bill/update.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listbill');
            exit();
        }
    } else {
        header('Location: index.php?act=listbill');
        exit();
    }
}

function update_bill() {
    $loi = '';
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $bill_name = trim($_POST['bill_name']);
        $bill_email = trim($_POST['bill_email']);
        $bill_phone = trim($_POST['bill_phone']);
        $bill_address = trim($_POST['bill_address']);
        $bill_status = $_POST['bill_status'];
        
        if (empty($bill_name)) {
            $loi = 'Tên khách hàng không được để trống.';
        } elseif (empty($bill_phone)) {
            $loi = 'Số điện thoại không được để trống.';
        } else {
            try {
                bill_update($id, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_status);
                header('Location: index.php?act=listbill&msg=Cập nhật đơn hàng thành công!');
                exit();
            } catch (Exception $e) {
                $loi = 'Lỗi cập nhật: ' . $e->getMessage();
            }
        }
        
        $bill = bill_select_by_id($id);
        require_once 'header.php';
        require_once 'bill/update.php';
        require_once 'footer.php';
    } else {
        header('Location: index.php?act=listbill');
        exit();
    }
}

function delete_bill() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            bill_delete($_GET['id']);
            header('Location: index.php?act=listbill&msg=Xóa đơn hàng thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listbill&msg=Lỗi: Không thể xóa đơn hàng này.');
            exit();
        }
    }
    header('Location: index.php?act=listbill');
    exit();
}

function view_bill_detail() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $bill = bill_select_by_id($_GET['id']);
        if ($bill) {
            $bill_details = bill_select_details($_GET['id']);
            require_once 'header.php';
            require_once 'bill/detail.php';
            require_once 'footer.php';
        } else {
            header('Location: index.php?act=listbill');
            exit();
        }
    } else {
        header('Location: index.php?act=listbill');
        exit();
    }
}
?>
