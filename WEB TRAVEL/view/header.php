<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Travel - Hệ Thống Đặt Tour Du Lịch Trực Tuyến Hàng Đầu</title>
    <meta name="description" content="Đặt tour du lịch Hạ Long, Sapa, Phú Quốc giá rẻ. Chất lượng dịch vụ 5 sao, phục vụ tận tâm chu đáo. Gọi ngay hotline 094 127 2222.">
    <!-- CSS Tùy Chỉnh -->
    <link rel="stylesheet" href="css/style.css?v=3">
</head>
<body>

<header>
    <div class="container header-container">
        <!-- Logo -->
        <div class="logo">
            <a href="index.php">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary-color);"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><path d="M12 11l2 2-2 2"></path><path d="M8 13h6"></path></svg>
                <div>
                    WEB<span>TRAVEL</span>
                    <span class="logo-sub">Hành trình tuyệt vời</span>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav>
            <ul class="nav-menu">
                <li class="<?php echo (!isset($_GET['act']) || $_GET['act'] == '' || $_GET['act'] == 'home') ? 'active' : ''; ?>">
                    <a href="index.php">Trang Chủ</a>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'gioithieu') ? 'active' : ''; ?> menu-text">
                    <a href="index.php?act=gioithieu">Giới Thiệu</a>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'sanpham' && !isset($_GET['id_danhmuc'])) ? 'active' : ''; ?>">
                    <a href="index.php?act=sanpham">Tour Du Lịch</a>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'tourtrongnuoc') ? 'active' : ''; ?> menu-text has-dropdown">
                    <a href="index.php?act=tourtrongnuoc">Tour Trong Nước</a>
                    <div class="mega-dropdown" style="min-width: 580px;">
                        <div class="dropdown-column">
                            <h3 class="column-title">Tour Miền Bắc</h3>
                            <ul>
                                <li><a href="index.php?act=sanpham&id_danhmuc=1">Tất cả Miền Bắc</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Hà Giang">Du lịch Hà Giang</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Sapa">Du lịch Sapa</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Hạ Long">Du lịch Hạ Long</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Ninh Bình">Du lịch Ninh Bình</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-column">
                            <h3 class="column-title">Tour Miền Trung</h3>
                            <ul>
                                <li><a href="index.php?act=sanpham&id_danhmuc=2">Tất cả Miền Trung</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Đà Nẵng">Du lịch Đà Nẵng</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Nha Trang">Du lịch Nha Trang</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Đà Lạt">Du lịch Đà Lạt</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Huế">Du lịch Huế</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-column">
                            <h3 class="column-title">Tour Miền Nam</h3>
                            <ul>
                                <li><a href="index.php?act=sanpham&id_danhmuc=3">Tất cả Miền Nam</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Phú Quốc">Du lịch Phú Quốc</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Miền Tây">Du lịch Miền Tây</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php
                // Lấy danh mục động từ CSDL nếu có hoặc load cứng 1 số danh mục chính
                // Ở đây ta có thể show các danh mục cụ thể hoặc điều hướng đến trang sản phẩm chung
                ?>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'sanpham' && isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == 4) ? 'active' : ''; ?> menu-text has-dropdown">
                    <a href="index.php?act=sanpham&id_danhmuc=4">Tour Nước Ngoài</a>
                    <div class="mega-dropdown">
                        <div class="dropdown-column">
                            <h3 class="column-title">DU LỊCH CHÂU ÂU</h3>
                            <ul>
                                <li><a href="index.php?act=sanpham&keyword=Trung Âu">Du lịch Trung Âu</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Đông Âu">Du lịch Đông Âu</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Tây Âu">Du lịch Tây Âu</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-column">
                            <h3 class="column-title">DU LỊCH CHÂU Á</h3>
                            <ul>
                                <li><a href="index.php?act=sanpham&keyword=Sing">Du lịch Sing – Mã</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Trung Quốc">Du lịch Trung Quốc</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Nhật Bản">Du lịch Nhật Bản</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Nga">Du lịch Nga</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Bali">Du lịch Bali – Indonesia</a></li>
                                <li><a href="index.php?act=sanpham&keyword=Ấn Độ">Du lịch Ấn Độ</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'khachsan') ? 'active' : ''; ?> menu-text has-dropdown">
                    <a href="index.php?act=khachsan">Khách Sạn</a>
                    <div class="mega-dropdown" style="min-width: 480px;">
                        <div class="dropdown-column">
                            <h3 class="column-title">Khách Sạn Trong Nước</h3>
                            <ul>
                                <li><a href="index.php?act=khachsan&region_filter=Miền Bắc">Khu vực Miền Bắc</a></li>
                                <li><a href="index.php?act=khachsan&region_filter=Miền Trung">Khu vực Miền Trung</a></li>
                                <li><a href="index.php?act=khachsan&region_filter=Miền Nam">Khu vực Miền Nam</a></li>
                                <li><hr style="border: 0; border-top: 1px solid var(--border-color); margin: 6px 0;"></li>
                                <li><a href="index.php?act=khachsan&location=Hà Nội">Khách sạn Hà Nội</a></li>
                                <li><a href="index.php?act=khachsan&location=Sapa">Khách sạn Sapa</a></li>
                                <li><a href="index.php?act=khachsan&location=Hạ Long">Khách sạn Hạ Long</a></li>
                                <li><a href="index.php?act=khachsan&location=Đà Nẵng">Khách sạn Đà Nẵng</a></li>
                                <li><a href="index.php?act=khachsan&location=Nha Trang">Khách sạn Nha Trang</a></li>
                                <li><a href="index.php?act=khachsan&location=Phú Quốc">Khách sạn Phú Quốc</a></li>
                                <li><a href="index.php?act=khachsan&location=Đà Lạt">Khách sạn Đà Lạt</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-column">
                            <h3 class="column-title">Khách Sạn Nước Ngoài</h3>
                            <ul>
                                <li><a href="index.php?act=khachsan&region_filter=Nước Ngoài">Tất cả Nước Ngoài</a></li>
                                <li><hr style="border: 0; border-top: 1px solid var(--border-color); margin: 6px 0;"></li>
                                <li><a href="index.php?act=khachsan&location=Singapore">Khách sạn Singapore</a></li>
                                <li><a href="index.php?act=khachsan&location=Tokyo">Khách sạn Tokyo</a></li>
                                <li><a href="index.php?act=khachsan&location=Paris">Khách sạn Paris</a></li>
                                <li><a href="index.php?act=khachsan&location=London">Khách sạn London</a></li>
                                <li><a href="index.php?act=khachsan&location=Seoul">Khách sạn Seoul</a></li>
                                <li><a href="index.php?act=khachsan&location=Bangkok">Khách sạn Bangkok</a></li>
                                <li><a href="index.php?act=khachsan&location=Sydney">Khách sạn Sydney</a></li>
                                <li><a href="index.php?act=khachsan&location=Dubai">Khách sạn Dubai</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'tintuc') ? 'active' : ''; ?> menu-text">
                    <a href="index.php?act=tintuc">Kinh Nghiệm</a>
                </li>
                <li class="<?php echo (isset($_GET['act']) && $_GET['act'] == 'lienhe') ? 'active' : ''; ?>">
                    <a href="index.php?act=lienhe">Liên Hệ</a>
                </li>
            </ul>
        </nav>

        <div class="header-right">
            <a href="tel:0941272222" class="hotline">
                Hotline : 094 127 2222
            </a>
            
            <!-- Giỏ hàng (Cart Button) -->
            <a href="index.php?act=viewcart" class="cart-btn" style="position: relative; display: inline-flex; align-items: center; justify-content: center; background-color: var(--white); border: 1px solid var(--border-color); width: 38px; height: 38px; border-radius: 50%; color: var(--text-dark); text-decoration: none; transition: var(--transition-speed); margin-right: 5px;" title="Xem giỏ hàng đặt tour">
                <span style="font-size: 18px;">🛒</span>
                <?php 
                $cart_count = 0;
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $cart_count += $item['quantity'];
                    }
                }
                if ($cart_count > 0):
                ?>
                    <span style="position: absolute; top: -5px; right: -5px; background-color: var(--secondary-color); color: var(--white); font-size: 10px; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
                        <?php echo $cart_count; ?>
                    </span>
                <?php endif; ?>
            </a>
            
            <div class="user-menu">
                <?php if (isset($_SESSION['user'])): ?>
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-dark);">
                        Hi, <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong>
                    </span>
                    <a href="index.php?act=taikhoan" class="btn-user">Tài Khoản</a>
                    <a href="index.php?act=mybookings" class="btn-user" style="color: var(--primary-color); border-color: var(--primary-color);">Tour Đã Đặt</a>
                    <?php if ($_SESSION['user']['role'] == 1): ?>
                        <a href="admin/" class="btn-user btn-user-primary" title="Quản trị viên">Admin</a>
                    <?php endif; ?>
                    <a href="index.php?act=thoat" class="btn-user" style="color: var(--secondary-color); border-color: var(--secondary-color);">Đăng Xuất</a>
                <?php else: ?>
                    <a href="index.php?act=dangnhap" class="btn-user">Đăng Nhập</a>
                    <a href="index.php?act=dangky" class="btn-user btn-user-primary">Đăng Ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
