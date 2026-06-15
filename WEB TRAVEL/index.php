<?php
session_start();

// Import các file cấu hình và models
require_once 'model/pdo.php';
require_once 'model/danhmuc.php';
require_once 'model/sanpham.php';
require_once 'model/taikhoan.php';
require_once 'model/bill.php';

// Import các Controllers
require_once 'controllers/HomeController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/HotelController.php';
require_once 'controllers/CartController.php';

// Khởi tạo các biến dùng chung
$list_danhmuc = danhmuc_select_all();

// Lấy tham số hành động 'act' từ URL
$act = isset($_GET['act']) ? $_GET['act'] : 'home';

switch ($act) {
    case 'khachsan':
        show_hotels();
        break;

    case 'gioithieu':
        gioithieu();
        break;

    case 'lienhe':
        lienhe();
        break;

    case 'tintuc':
        tintuc();
        break;

    case 'sanpham':
        show_products();
        break;

    case 'tourtrongnuoc':
        show_domestic_tours();
        break;

    case 'sanphamct':
        product_detail();
        break;

    case 'dangky':
        register();
        break;

    case 'dangnhap':
        login();
        break;

    case 'quenmk':
        forgot_password();
        break;

    case 'thoat':
        logout();
        break;

    case 'taikhoan':
        edit_profile();
        break;

    case 'addtocart':
        add_to_cart();
        break;

    case 'viewcart':
        view_cart();
        break;

    case 'delcart':
        delete_cart();
        break;

    case 'checkout':
        checkout();
        break;

    case 'checkout_success':
        checkout_success();
        break;

    case 'mybookings':
        my_bookings();
        break;

    case 'home':
    default:
        home();
        break;
}
?>
