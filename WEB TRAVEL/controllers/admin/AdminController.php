<?php
/**
 * Controller xử lý tổng quan bảng điều khiển Admin
 */

function dashboard() {
    global $list_danhmuc;
    
    require_once 'header.php';
    require_once 'home.php';
    require_once 'footer.php';
}

function show_statistics() {
    // Thống kê tổng số lượng
    $total_categories = pdo_query_value("SELECT COUNT(*) FROM danhmuc");
    $total_products = pdo_query_value("SELECT COUNT(*) FROM sanpham");
    $total_users = pdo_query_value("SELECT COUNT(*) FROM taikhoan");
    $total_comments = pdo_query_value("SELECT COUNT(*) FROM binhluan");
    $total_views = pdo_query_value("SELECT SUM(views) FROM sanpham");
    
    // Thống kê sản phẩm theo danh mục
    $sql_category_stats = "SELECT dm.id, dm.name, 
                            COUNT(sp.id) as count_sp, 
                            IFNULL(MIN(sp.price), 0) as min_price, 
                            IFNULL(MAX(sp.price), 0) as max_price, 
                            IFNULL(AVG(sp.price), 0) as avg_price 
                           FROM danhmuc dm 
                           LEFT JOIN sanpham sp ON dm.id = sp.id_danhmuc 
                           GROUP BY dm.id, dm.name 
                           ORDER BY count_sp DESC";
    $category_stats = pdo_query($sql_category_stats);
    
    // Top 5 sản phẩm xem nhiều nhất
    $sql_top_views = "SELECT sp.*, dm.name as ten_danhmuc 
                      FROM sanpham sp 
                      INNER JOIN danhmuc dm ON sp.id_danhmuc = dm.id 
                      ORDER BY sp.views DESC LIMIT 5";
    $top_views = pdo_query($sql_top_views);

    // Top 5 tour có giá rẻ nhất (tiết kiệm nhất)
    $sql_cheapest = "SELECT sp.*, dm.name as ten_danhmuc 
                     FROM sanpham sp 
                     INNER JOIN danhmuc dm ON sp.id_danhmuc = dm.id 
                     ORDER BY sp.price ASC LIMIT 5";
    $top_cheapest = pdo_query($sql_cheapest);
    
    require_once 'header.php';
    require_once 'thongke.php';
    require_once 'footer.php';
}
?>
