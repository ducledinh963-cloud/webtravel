<?php
require_once 'pdo.php';

/**
 * Lấy danh sách banner theo vị trí (slider, promo, sidebar)
 */
function banner_select_by_position($position) {
    $sql = "SELECT * FROM banner WHERE position = ? ORDER BY id ASC";
    return pdo_query($sql, $position);
}
?>
