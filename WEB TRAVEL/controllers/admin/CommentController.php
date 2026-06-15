<?php
/**
 * Controller quản lý bình luận phía Admin
 */

function list_comments() {
    $thongbao = isset($_GET['msg']) ? $_GET['msg'] : '';
    
    // Sử dụng CommentModel hoặc pdo_query trực tiếp
    $list_binhluan = binhluan_select_all();
    
    require_once 'header.php';
    require_once 'binhluan/list.php';
    require_once 'footer.php';
}

function delete_comment() {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        try {
            binhluan_delete($_GET['id']);
            header('Location: index.php?act=listbl&msg=Xóa bình luận thành công!');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?act=listbl&msg=Lỗi: Không thể xóa bình luận này.');
            exit();
        }
    }
    header('Location: index.php?act=listbl');
    exit();
}
?>
