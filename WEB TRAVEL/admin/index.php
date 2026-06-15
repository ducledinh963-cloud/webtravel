<?php
session_start();

// Import các model từ thư mục gốc
require_once '../model/pdo.php';
require_once '../model/danhmuc.php';
require_once '../model/sanpham.php';
require_once '../model/taikhoan.php';
require_once '../model/binhluan.php';
require_once '../model/bill.php';
require_once '../model/dichvu.php';
require_once '../model/khachsan.php';
require_once '../model/tintuc.php';
require_once '../model/nhahang.php';
require_once '../model/giaitri.php';
require_once '../model/thuexe.php';

// Kiểm duyệt quyền truy cập Admin (Role = 1)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header('Location: ../index.php?act=dangnhap');
    exit();
}

// Import các Admin Controllers
require_once '../controllers/admin/AdminController.php';
require_once '../controllers/admin/CategoryController.php';
require_once '../controllers/admin/ProductController.php';
require_once '../controllers/admin/UserController.php';
require_once '../controllers/admin/CommentController.php';
require_once '../controllers/admin/EmployeeController.php';
require_once '../controllers/admin/ServiceController.php';
require_once '../controllers/admin/HotelController.php';
require_once '../controllers/admin/BillController.php';
require_once '../controllers/admin/NewsController.php';
require_once '../controllers/admin/RestaurantController.php';
require_once '../controllers/admin/EntertainmentController.php';
require_once '../controllers/admin/CarController.php';
require_once '../controllers/admin/TouristController.php';

// Khởi tạo các biến dùng chung
$list_danhmuc = danhmuc_select_all();
$act = isset($_GET['act']) ? $_GET['act'] : 'dashboard';

switch ($act) {
    // ==========================================
    // QUẢN LÝ DANH MỤC
    // ==========================================
    case 'listdm':
        list_dm();
        break;

    case 'adddm':
        add_dm();
        break;

    case 'suadm':
        edit_dm();
        break;

    case 'updatedm':
        update_dm();
        break;

    case 'xoadm':
        delete_dm();
        break;

    // ==========================================
    // QUẢN LÝ SẢN PHẨM (TOUR DU LỊCH)
    // ==========================================
    case 'listsp':
        list_sp();
        break;

    case 'addsp':
        add_sp();
        break;

    case 'suasp':
        edit_sp();
        break;

    case 'updatesp':
        update_sp();
        break;

    case 'xoasp':
        delete_sp();
        break;

    // ==========================================
    // QUẢN LÝ TÀI KHOẢN (THÀNH VIÊN)
    // ==========================================
    case 'listtk':
        list_users();
        break;

    case 'addtk':
        add_user();
        break;

    case 'suatk':
        edit_user();
        break;

    case 'updatetk':
        update_user();
        break;

    case 'xoatk':
        delete_user();
        break;

    // ==========================================
    // QUẢN LÝ NHÂN VIÊN
    // ==========================================
    case 'listnv':
        list_employees();
        break;

    case 'addnv':
        add_employee();
        break;

    case 'suanv':
        edit_employee();
        break;

    case 'updatenv':
        update_employee();
        break;

    case 'xoanv':
        delete_employee();
        break;


    // ==========================================
    // QUẢN LÝ BÌNH LUẬN (COMMENTS)
    // ==========================================
    case 'listbl':
        list_comments();
        break;

    case 'xoabl':
        delete_comment();
        break;

    // ==========================================
    // QUẢN LÝ DỊCH VỤ
    // ==========================================
    case 'listdv':
        list_dv();
        break;

    case 'adddv':
        add_dv();
        break;

    case 'suadv':
        edit_dv();
        break;

    case 'updatedv':
        update_dv();
        break;

    case 'xoadv':
        delete_dv();
        break;

    // ==========================================
    // QUẢN LÝ KHÁCH SẠN
    // ==========================================
    case 'listks':
        list_ks();
        break;

    case 'addks':
        add_ks();
        break;

    case 'suaks':
        edit_ks();
        break;

    case 'updateks':
        update_ks();
        break;

    case 'xoaks':
        delete_ks();
        break;

    // ==========================================
    // QUẢN LÝ ĐƠN HÀNG
    // ==========================================
    case 'listbill':
        list_bill();
        break;

    case 'suabill':
        edit_bill();
        break;

    case 'updatebill':
        update_bill();
        break;

    case 'xoabill':
        delete_bill();
        break;

    case 'detailbill':
        view_bill_detail();
        break;

    // ==========================================
    // QUẢN LÝ BÀI VIẾT (TIN TỨC)
    // ==========================================
    case 'listtt':
        list_tt();
        break;

    case 'addtt':
        add_tt();
        break;

    case 'suatt':
        edit_tt();
        break;

    case 'updatett':
        update_tt();
        break;

    case 'xoatt':
        delete_tt();
        break;

    // ==========================================
    // QUẢN LÝ NHÀ HÀNG (RESTAURANTS)
    // ==========================================
    case 'listnh':
        list_restaurants();
        break;

    case 'addnh':
        add_restaurant();
        break;

    case 'suanh':
        edit_restaurant();
        break;

    case 'updatenh':
        update_restaurant();
        break;

    case 'xoanh':
        delete_restaurant();
        break;

    // ==========================================
    // QUẢN LÝ GIẢI TRÍ (ENTERTAINMENT)
    // ==========================================
    case 'listgt':
        list_entertainment();
        break;

    case 'addgt':
        add_entertainment();
        break;

    case 'suagt':
        edit_entertainment();
        break;

    case 'updategt':
        update_entertainment();
        break;

    case 'xoagt':
        delete_entertainment();
        break;

    // ==========================================
    // QUẢN LÝ THUÊ XE (CAR RENTAL)
    // ==========================================
    case 'listtx':
        list_cars();
        break;

    case 'addtx':
        add_car();
        break;

    case 'suatx':
        edit_car();
        break;

    case 'updatetx':
        update_car();
        break;

    case 'xoatx':
        delete_car();
        break;

    // ==========================================
    // QUẢN LÝ DU KHÁCH (TOURISTS)
    // ==========================================
    case 'listdk':
        list_tourists();
        break;

    case 'adddk':
        add_tourist();
        break;

    case 'suadk':
        edit_tourist();
        break;

    case 'updatedk':
        update_tourist();
        break;

    case 'xoadk':
        delete_tourist();
        break;

    // ==========================================
    // BÁO CÁO VÀ THỐNG KÊ
    // ==========================================
    case 'thongke':
        show_statistics();
        break;

    // ==========================================
    // TRANG CHỦ ADMIN PANEL
    // ==========================================
    case 'dashboard':
    default:
        dashboard();
        break;
}
?>
