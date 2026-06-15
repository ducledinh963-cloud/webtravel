<?php
/**
 * Controller xử lý các yêu cầu liên quan đến Khách Sạn phía Client
 */
require_once 'model/khachsan.php';

function show_hotels() {
    global $list_danhmuc;
    
    $list_locations = khachsan_select_locations();
    $domestic_locations = khachsan_select_domestic_locations();
    $foreign_locations = khachsan_select_foreign_locations();
    
    $list_khachsan = [];
    $location = isset($_GET['location']) ? trim($_GET['location']) : '';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $region_filter = isset($_GET['region_filter']) ? trim($_GET['region_filter']) : '';

    if ($location != '') {
        $list_khachsan = khachsan_select_by_location($location);
    } elseif ($keyword != '') {
        $list_khachsan = khachsan_search($keyword);
    } elseif ($region_filter != '') {
        $list_khachsan = khachsan_select_by_region($region_filter);
    } else {
        $list_khachsan = khachsan_select_all();
    }

    require_once 'view/header.php';
    require_once 'view/khachsan.php';
    require_once 'view/footer.php';
}
?>
