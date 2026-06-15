<?php
/**
 * Controller xử lý liên quan đến sản phẩm (Tour du lịch) phía Client
 */
require_once 'model/binhluan.php';

function show_products() {
    global $list_danhmuc;
    
    $list_sanpham = [];
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $id_danhmuc = isset($_GET['id_danhmuc']) ? $_GET['id_danhmuc'] : '';

    if ($id_danhmuc != '' && $keyword != '') {
        $danhmuc_hientai = danhmuc_select_by_id($id_danhmuc);
        $list_sanpham = sanpham_search($keyword, $id_danhmuc);
    } elseif ($id_danhmuc != '') {
        $danhmuc_hientai = danhmuc_select_by_id($id_danhmuc);
        $list_sanpham = sanpham_select_by_danhmuc($id_danhmuc);
    } elseif ($keyword != '') {
        $list_sanpham = sanpham_search($keyword);
    } else {
        $list_sanpham = sanpham_select_all();
    }

    require_once 'view/header.php';
    require_once 'view/sanpham.php';
    require_once 'view/footer.php';
}

function show_domestic_tours() {
    global $list_danhmuc;
    
    $id_danhmuc = 'trongnuoc';
    $list_sanpham = pdo_query("SELECT * FROM sanpham WHERE id_danhmuc IN (1, 2, 3, 7) ORDER BY id DESC");
    $danhmuc_hientai = ['id' => 'trongnuoc', 'name' => 'Tour Trong Nước'];
    
    require_once 'view/header.php';
    require_once 'view/sanpham.php';
    require_once 'view/footer.php';
}

function product_detail() {
    global $list_danhmuc;
    
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        
        // Xử lý gửi bình luận
        if (isset($_POST['guibinhluan']) && isset($_SESSION['user'])) {
            $content = trim($_POST['content']);
            $id_user = $_SESSION['user']['id'];
            $id_pro = $_POST['id_pro'];
            $date = date('H:i d/m/Y');
            if (!empty($content)) {
                binhluan_insert($content, $id_user, $id_pro, $date);
                header("Location: index.php?act=sanphamct&id=" . $id_pro);
                exit();
            }
        }
        
        // Tăng lượt xem (nếu không phải vừa reload đặt tour hoặc gửi bình luận)
        if (!isset($_GET['booked']) && !isset($_POST['guibinhluan'])) {
            sanpham_tang_luotxem($id);
        }
        
        $sanpham = sanpham_select_by_id($id);
        if ($sanpham) {
            $list_cungloai = sanpham_select_cungloai($id, $sanpham['id_danhmuc']);
            
            // Lấy danh sách bình luận của sản phẩm
            $list_binhluan = binhluan_select_by_product($id);
            
            require_once 'view/header.php';
            require_once 'view/sanphamct.php';
            require_once 'view/footer.php';
        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        header('Location: index.php');
        exit();
    }
}
?>
