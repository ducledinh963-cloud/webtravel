<?php
require_once 'pdo.php';

/**
 * Lấy tất cả các điểm đến nổi bật
 */
function diemden_select_all() {
    $sql = "SELECT * FROM diemden ORDER BY id ASC";
    return pdo_query($sql);
}
?>
