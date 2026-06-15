<?php
/**
 * Controller xử lý các trang tĩnh và trang chủ phía Client
 */

require_once 'model/khachsan.php';
require_once 'model/diemden.php';
require_once 'model/tintuc.php';
require_once 'model/banner.php';
require_once 'model/nhahang.php';
require_once 'model/duthuyen.php';
require_once 'model/thuexe.php';
require_once 'model/leucamtrai.php';
require_once 'model/touruudai.php';

function home() {
    global $list_danhmuc;
    
    // Lấy danh sách sản phẩm trang chủ
    $list_sanpham_home = sanpham_select_home();
    
    // Lấy danh sách khách sạn hot và địa điểm khách sạn
    $list_khachsan_home = khachsan_select_hot();
    $list_locations_home = khachsan_select_locations();
    
    // Lấy danh sách điểm đến nổi bật
    $list_diemden = diemden_select_all();
    
    // Lấy danh sách tin tức/kinh nghiệm du lịch
    $list_tintuc = tintuc_select_all();
    
    // Lấy danh sách 4 tour nổi bật cho carousel (Cửu Trại Câu, Úc, Châu Âu, Đài Loan)
    $list_tour_noibat = pdo_query("SELECT sp.*, dm.name as ten_danhmuc FROM sanpham sp INNER JOIN danhmuc dm ON sp.id_danhmuc = dm.id WHERE sp.id IN (16, 17, 18, 19, 20, 21, 22) ORDER BY sp.id ASC");
    
    // Lấy danh sách khách sạn theo 4 vùng Miền Bắc, Miền Trung, Miền Nam, Nước Ngoài
    $list_khachsan_bac = pdo_query("SELECT * FROM khachsan WHERE region = 'Miền Bắc' ORDER BY id ASC");
    $list_khachsan_trung = pdo_query("SELECT * FROM khachsan WHERE region = 'Miền Trung' ORDER BY id ASC");
    $list_khachsan_nam = pdo_query("SELECT * FROM khachsan WHERE region = 'Miền Nam' ORDER BY id ASC");
    $list_khachsan_nuocngoai = pdo_query("SELECT * FROM khachsan WHERE region = 'Nước Ngoài' ORDER BY id ASC");
    
    // Lấy danh sách 8 tour Châu Âu hiển thị dưới trang chủ
    $list_tour_europe = pdo_query("SELECT * FROM sanpham WHERE id_danhmuc = 6 ORDER BY id ASC LIMIT 8");
    
    // Lấy danh sách 7 tour Châu Á hiển thị dưới trang chủ
    $list_tour_asia = pdo_query("SELECT * FROM sanpham WHERE id_danhmuc = 5 ORDER BY id ASC LIMIT 7");
    
    // Lấy danh sách 16 tour Nhật Bản hiển thị dưới trang chủ
    $list_tour_japan = pdo_query("SELECT * FROM sanpham WHERE (name LIKE '%Nhật Bản%' OR name LIKE '%nhật bản%') AND id >= 104 ORDER BY id ASC LIMIT 16");
    
    // Lấy danh sách 8 tour Đông Âu hiển thị dưới trang chủ
    $list_tour_dong_au = pdo_query("SELECT * FROM sanpham WHERE id_danhmuc = 6 AND (name LIKE '%Đông Âu%' OR description LIKE '%Đông Âu%') ORDER BY id DESC LIMIT 8");
    
    // Lấy danh sách 8 tour Trung Âu hiển thị dưới trang chủ
    $list_tour_trung_au = pdo_query("SELECT * FROM sanpham WHERE id_danhmuc = 6 AND (name LIKE '%Trung Âu%' OR description LIKE '%Trung Âu%') ORDER BY id DESC LIMIT 8");
    
    // Lấy 3 tour đặc thù cho mục "Bí ẩn thiên nhiên"
    $tour_nature_left = pdo_query_one("SELECT * FROM sanpham WHERE id = 92");
    $tour_nature_right_1 = pdo_query_one("SELECT * FROM sanpham WHERE id = 93");
    $tour_nature_right_2 = pdo_query_one("SELECT * FROM sanpham WHERE id = 161");
    
    // Lấy danh sách banner động từ CSDL
    $list_slides = banner_select_by_position('slider');
    
    // Tự động seed banner promo nếu chưa đủ 4 ảnh
    try {
        $list_promo = banner_select_by_position('promo');
        
        // Always try to restore the original promo_banner1 and promo_banner2 from brain artifacts to ensure correct visuals
        $brain_dir = 'C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a/';
        $uploads_dir = __DIR__ . '/../uploads/';
        $b1 = $brain_dir . 'promo_banner1_1781340961697.png';
        $b2 = $brain_dir . 'promo_banner2_1781340974923.png';
        
        if (file_exists($b1)) {
            @copy($b1, $uploads_dir . 'promo_banner1.png');
        }
        if (file_exists($b2)) {
            @copy($b2, $uploads_dir . 'promo_banner2.png');
        }

        if (empty($list_promo) || count($list_promo) < 4) {
            $conn = Database::getConnection();
            
            // Seed promo_banner3 and promo_banner4 from scenic images
            $sources = ['tour_europe.png', 'tour_japan.png'];
            for ($i = 3; $i <= 4; $i++) {
                $src_file = $sources[$i - 3];
                $dest_file = 'promo_banner' . $i . '.png';
                if (file_exists($uploads_dir . $src_file)) {
                    @copy($uploads_dir . $src_file, $uploads_dir . $dest_file);
                } else {
                    $fallback = 'hotel1.jpg';
                    if (file_exists($uploads_dir . $fallback)) {
                        @copy($uploads_dir . $fallback, $uploads_dir . $dest_file);
                    }
                }
            }
            
            $conn->exec("DELETE FROM banner WHERE position = 'promo'");
            $conn->exec("INSERT INTO banner (id, title, image, position, url) VALUES 
                (5, 'Tour Nước Ngoài - Giá Từ 6.99Tr', 'uploads/promo_banner1.png', 'promo', 'index.php?act=sanpham'),
                (6, 'Bộ Sản Phẩm Thế Hệ Mới - ESG & L.E.I', 'uploads/promo_banner2.png', 'promo', 'index.php?act=sanpham'),
                (7, 'Tour Châu Âu Cao Cấp', 'uploads/promo_banner3.png', 'promo', 'index.php?act=sanpham'),
                (8, 'Nghỉ Dưỡng Sang Trọng', 'uploads/promo_banner4.png', 'promo', 'index.php?act=sanpham')");
            $list_promo = banner_select_by_position('promo');
        }
    } catch (Exception $e) {
        $list_promo = banner_select_by_position('promo');
    }

    $sidebar_banner = banner_select_by_position('sidebar');
    
    // Lấy danh sách 40 nhà hàng món ngon du lịch biển
    $list_nhahang = nhahang_select_all();
    
    // Lấy danh sách 60 du thuyền sang trọng
    $list_duthuyen = duthuyen_select_all();
    
    // Lấy danh sách 100 xe du lịch tự động seed nếu chưa đủ
    try {
        $list_cars = thuexe_select_all();
        if (empty($list_cars) || count($list_cars) < 100) {
            thuexe_seed_100();
            $list_cars = thuexe_select_all();
        }
    } catch (Exception $e) {
        thuexe_seed_100();
        $list_cars = thuexe_select_all();
    }
    
    // Lấy danh sách 140 lều cắm trại tự động seed nếu chưa đủ
    try {
        $list_tents = leucamtrai_select_all();
        if (empty($list_tents) || count($list_tents) < 140) {
            leucamtrai_seed_140();
            $list_tents = leucamtrai_select_all();
        }
    } catch (Exception $e) {
        leucamtrai_seed_140();
        $list_tents = leucamtrai_select_all();
    }
    
    // Lấy danh sách tour ưu đãi giá tốt
    try {
        $list_touruudai = touruudai_select_all();
        if (empty($list_touruudai)) {
            touruudai_seed();
            $list_touruudai = touruudai_select_all();
        }
    } catch (Exception $e) {
        touruudai_seed();
        $list_touruudai = touruudai_select_all();
    }
    
    require_once 'view/header.php';
    require_once 'view/home.php';
    require_once 'view/footer.php';
}

function gioithieu() {
    global $list_danhmuc;
    
    require_once 'view/header.php';
    require_once 'view/gioithieu.php';
    require_once 'view/footer.php';
}

function lienhe() {
    global $list_danhmuc;
    $contact_success = false;
    
    // Xử lý gửi biểu mẫu liên hệ
    if (isset($_POST['lienhe_submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        // Giả lập lưu/gửi thành công
        $contact_success = true;
    }
    
    require_once 'view/header.php';
    require_once 'view/lienhe.php';
    require_once 'view/footer.php';
}

function tintuc() {
    global $list_danhmuc;
    
    // Lấy tất cả bài viết/kinh nghiệm du lịch
    $list_tintuc = tintuc_select_all();
    
    // Lấy danh sách tour và khách sạn cho sidebar
    $list_tours_sidebar = pdo_query("SELECT * FROM sanpham WHERE id IN (15, 14, 13)");
    $list_hotels_sidebar = pdo_query("SELECT * FROM khachsan WHERE id IN (1, 2)");
    
    require_once 'view/header.php';
    require_once 'view/tintuc.php';
    require_once 'view/footer.php';
}
?>
