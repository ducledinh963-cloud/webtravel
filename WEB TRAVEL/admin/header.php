<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm duyệt quyền truy cập Admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    // Chuyển hướng về trang đăng nhập của Client nếu không có quyền Admin
    header('Location: ../index.php?act=dangnhap');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Hệ Thống - Web Travel</title>
    <!-- CSS Tùy Chỉnh dùng chung -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-layout-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary-color);"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            <div>ADMIN<span>PANEL</span></div>
        </div>

        <ul class="admin-nav">
            <li class="<?php echo (!isset($_GET['act']) || $_GET['act'] == 'dashboard') ? 'active' : ''; ?>">
                <a href="index.php?act=dashboard">
                    <span>📊</span> Bảng Điều Khiển
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listdm', 'adddm', 'suadm', 'updatedm'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listdm">
                    <span>📁</span> Quản Lý Danh Mục
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listsp', 'addsp', 'suasp', 'updatesp'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listsp">
                    <span>⛵</span> Quản Lý Sản Phẩm (Tour)
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listtk', 'addtk', 'suatk', 'updatetk'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listtk">
                    <span>👤</span> Quản Lý Tài Khoản
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listnv', 'addnv', 'suanv', 'updatenv'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listnv">
                    <span>👥</span> Quản Lý Nhân Viên
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listbl', 'xoabl'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listbl">
                    <span>💬</span> Quản Lý Bình Luận
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listdv', 'adddv', 'suadv', 'updatedv'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listdv">
                    <span>💼</span> Quản Lý Dịch Vụ
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listks', 'addks', 'suaks', 'updateks'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listks">
                    <span>🏨</span> Quản Lý Khách Sạn
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listnh', 'addnh', 'suanh', 'updatenh'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listnh">
                    <span>🍤</span> Quản Lý Nhà Hàng
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listgt', 'addgt', 'suagt', 'updategt'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listgt">
                    <span>🎡</span> Quản Lý Giải Trí
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listtx', 'addtx', 'suatx', 'updatetx'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listtx">
                    <span>🚗</span> Quản Lý Thuê Xe
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listdk', 'adddk', 'suadk', 'updatedk'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listdk">
                    <span>✈️</span> Quản Lý Du Khách
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listbill', 'suabill', 'updatebill', 'detailbill'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listbill">
                    <span>🧾</span> Quản Lý Đơn Hàng
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && in_array($_GET['act'], ['listtt', 'addtt', 'suatt', 'updatett'])) ? 'active' : ''; ?>">
                <a href="index.php?act=listtt">
                    <span>📰</span> Quản Lý Bài Viết
                </a>
            </li>
            <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'thongke') ? 'active' : ''; ?>">
                <a href="index.php?act=thongke">
                    <span>📈</span> Báo Cáo &amp; Thống Kê
                </a>
            </li>
            <hr style="border: 0; border-top: 1px solid #1e293b; margin: 15px 0;">
            <li>
                <a href="../index.php" target="_blank" style="color: #38bdf8;">
                    <span>🌐</span> Xem Trang Chủ Client
                </a>
            </li>
            <li>
                <a href="../index.php?act=thoat" style="color: #f87171;">
                    <span>🚪</span> Đăng Xuất Admin
                </a>
            </li>
        </ul>
        
        <div style="margin-top: auto; font-size: 11px; text-align: center; opacity: 0.5;">
            Web Travel Admin v1.0
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
        <div class="admin-header">
            <div class="admin-title">
                <?php
                $page_title = 'Bảng Điều Khiển';
                $page_subtitle = 'Tổng quan hệ thống đặt tour trực tuyến';
                
                if (isset($_GET['act'])) {
                    switch ($_GET['act']) {
                        case 'listdm':
                            $page_title = 'Danh Sách Danh Mục';
                            $page_subtitle = 'Quản lý các khu vực, danh mục tour du lịch';
                            break;
                        case 'adddm':
                            $page_title = 'Thêm Danh Mục Mới';
                            $page_subtitle = 'Khởi tạo một danh mục tour du lịch mới';
                            break;
                        case 'suadm':
                            $page_title = 'Cập Nhật Danh Mục';
                            $page_subtitle = 'Chỉnh sửa thông tin tên danh mục';
                            break;
                        case 'listsp':
                            $page_title = 'Danh Sách Sản Phẩm (Tour)';
                            $page_subtitle = 'Quản lý thông tin và lịch trình các tour du lịch';
                            break;
                        case 'addsp':
                            $page_title = 'Thêm Tour Du Lịch Mới';
                            $page_subtitle = 'Đăng tải một tour du lịch mới lên hệ thống';
                            break;
                        case 'suasp':
                            $page_title = 'Cập Nhật Tour Du Lịch';
                            $page_subtitle = 'Chỉnh sửa chi tiết thông tin và lịch trình tour';
                            break;
                        case 'listtk':
                            $page_title = 'Danh Sách Tài Khoản';
                            $page_subtitle = 'Quản lý thông tin và vai trò của các thành viên';
                            break;
                        case 'addtk':
                            $page_title = 'Thêm Tài Khoản Mới';
                            $page_subtitle = 'Tạo tài khoản quản trị hoặc khách hàng mới';
                            break;
                        case 'suatk':
                            $page_title = 'Cập Nhật Tài Khoản';
                            $page_subtitle = 'Thay đổi thông tin liên lạc và vai trò của thành viên';
                            break;
                        case 'listnv':
                            $page_title = 'Danh Sách Nhân Viên';
                            $page_subtitle = 'Quản lý thông tin và tài khoản của nhân viên hệ thống';
                            break;
                        case 'addnv':
                            $page_title = 'Thêm Nhân Viên Mới';
                            $page_subtitle = 'Khởi tạo tài khoản nhân viên (Staff) mới';
                            break;
                        case 'suanv':
                            $page_title = 'Cập Nhật Nhân Viên';
                            $page_subtitle = 'Chỉnh sửa thông tin và vai trò của nhân viên';
                            break;
                        case 'listbl':
                            $page_title = 'Danh Sách Bình Luận';
                            $page_subtitle = 'Quản lý các phản hồi và ý kiến đóng góp từ khách hàng';
                            break;
                        case 'listdv':
                            $page_title = 'Danh Sách Dịch Vụ';
                            $page_subtitle = 'Quản lý các dịch vụ đi kèm và hỗ trợ tour du lịch';
                            break;
                        case 'adddv':
                            $page_title = 'Thêm Dịch Vụ Mới';
                            $page_subtitle = 'Khởi tạo một dịch vụ du lịch hoặc hỗ trợ mới';
                            break;
                        case 'suadv':
                            $page_title = 'Cập Nhật Dịch Vụ';
                            $page_subtitle = 'Chỉnh sửa thông tin chi tiết dịch vụ du lịch';
                            break;
                        case 'listks':
                            $page_title = 'Danh Sách Khách Sạn';
                            $page_subtitle = 'Quản lý thông tin lưu trú, resort, khách sạn toàn quốc';
                            break;
                        case 'listnh':
                            $page_title = 'Danh Sách Món Ngon & Nhà Hàng';
                            $page_subtitle = 'Quản lý ẩm thực, đặc sản hải sản và nhà hàng liên kết';
                            break;
                        case 'addnh':
                            $page_title = 'Thêm Món Ngon Mới';
                            $page_subtitle = 'Đăng tải thông tin món ăn, đặc sản và nhà hàng mới';
                            break;
                        case 'suanh':
                            $page_title = 'Cập Nhật Món Ngon';
                            $page_subtitle = 'Chỉnh sửa chi tiết thông tin món ngon / nhà hàng';
                            break;
                        case 'listgt':
                            $page_title = 'Danh Sách Địa Điểm Giải Trí';
                            $page_subtitle = 'Quản lý khu vui chơi, hoạt động giải trí và trải nghiệm du lịch';
                            break;
                        case 'addgt':
                            $page_title = 'Thêm Hoạt Động Giải Trí Mới';
                            $page_subtitle = 'Đăng tải thông tin khu vui chơi, trải nghiệm hoặc hoạt động mới';
                            break;
                        case 'suagt':
                            $page_title = 'Cập Nhật Hoạt Động Giải Trí';
                            $page_subtitle = 'Chỉnh sửa chi tiết thông tin khu vui chơi hoặc hoạt động giải trí';
                            break;
                        case 'listtx':
                            $page_title = 'Danh Sách Xe Thuê';
                            $page_subtitle = 'Quản lý các loại phương tiện xe tự lái và xe du lịch có tài xế';
                            break;
                        case 'addtx':
                            $page_title = 'Thêm Phương Tiện Xe Mới';
                            $page_subtitle = 'Đăng tải thông tin phương tiện xe cho thuê mới';
                            break;
                        case 'suatx':
                            $page_title = 'Cập Nhật Thông Tin Xe';
                            $page_subtitle = 'Chỉnh sửa thông tin chi tiết và giá thuê phương tiện';
                            break;
                        case 'listdk':
                            $page_title = 'Danh Sách Du Khách';
                            $page_subtitle = 'Quản lý thông tin cá nhân và hồ sơ du khách';
                            break;
                        case 'adddk':
                            $page_title = 'Thêm Du Khách Mới';
                            $page_subtitle = 'Thêm hồ sơ du khách mới vào hệ thống';
                            break;
                        case 'suadk':
                            $page_title = 'Cập Nhật Du Khách';
                            $page_subtitle = 'Chỉnh sửa thông tin cá nhân của du khách';
                            break;
                        case 'addks':
                            $page_title = 'Thêm Khách Sạn Mới';
                            $page_subtitle = 'Đăng tải thông tin cơ sở lưu trú mới';
                            break;
                        case 'suaks':
                            $page_title = 'Cập Nhật Khách Sạn';
                            $page_subtitle = 'Chỉnh sửa thông tin chi tiết cơ sở lưu trú';
                            break;
                        case 'listbill':
                            $page_title = 'Danh Sách Đơn Hàng';
                            $page_subtitle = 'Quản lý các tour đặt hàng của người dùng';
                            break;
                        case 'suabill':
                            $page_title = 'Cập Nhật Đơn Hàng';
                            $page_subtitle = 'Chỉnh sửa thông tin và trạng thái đơn hàng';
                            break;
                        case 'detailbill':
                            $page_title = 'Chi Tiết Đơn Hàng';
                            $page_subtitle = 'Xem chi tiết các tour đã đặt và thông tin thanh toán';
                            break;
                        case 'listtt':
                            $page_title = 'Danh Sách Bài Viết';
                            $page_subtitle = 'Quản lý các tin tức, kinh nghiệm du lịch đăng trên website';
                            break;
                        case 'addtt':
                            $page_title = 'Thêm Bài Viết Mới';
                            $page_subtitle = 'Đăng tải một bài viết mới lên hệ thống';
                            break;
                        case 'suatt':
                            $page_title = 'Cập Nhật Bài Viết';
                            $page_subtitle = 'Chỉnh sửa chi tiết thông tin bài viết';
                            break;
                        case 'thongke':
                            $page_title = 'Báo Cáo & Thống Kê';
                            $page_subtitle = 'Số liệu thống kê danh mục, sản phẩm, người dùng và bình luận';
                            break;
                    }
                }
                ?>
                <h1><?php echo $page_title; ?></h1>
                <p><?php echo $page_subtitle; ?></p>
            </div>

            <div style="font-size: 13px; font-weight: 600;">
                Xin chào, <span style="color: var(--primary-color);"><?php echo htmlspecialchars($_SESSION['user']['username']); ?></span> (Quản trị viên)
            </div>
        </div>
