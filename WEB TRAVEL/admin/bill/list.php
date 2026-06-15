<div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
    <!-- Form tìm kiếm & lọc đơn hàng -->
    <form action="index.php" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <input type="hidden" name="act" value="listbill">
        
        <input type="text" name="keyword" placeholder="Mã đơn, tên, SĐT khách..." 
               value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>"
               style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; width: 220px; outline: none; font-size: 13px;">
               
        <select name="status" style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; font-size: 13px; cursor: pointer;">
            <option value="all" <?php echo (isset($_GET['status']) && $_GET['status'] === 'all') ? 'selected' : ''; ?>>Tất cả trạng thái</option>
            <option value="0" <?php echo (isset($_GET['status']) && $_GET['status'] === '0') ? 'selected' : ''; ?>>Chờ xác nhận</option>
            <option value="1" <?php echo (isset($_GET['status']) && $_GET['status'] === '1') ? 'selected' : ''; ?>>Đang chuẩn bị</option>
            <option value="2" <?php echo (isset($_GET['status']) && $_GET['status'] === '2') ? 'selected' : ''; ?>>Đã khởi hành</option>
            <option value="3" <?php echo (isset($_GET['status']) && $_GET['status'] === '3') ? 'selected' : ''; ?>>Đã hủy</option>
        </select>
        
        <button type="submit" class="btn-action" style="background-color: var(--primary-color); border: none; padding: 8px 15px; font-size: 13px; font-weight: 700; color: var(--white); cursor: pointer; border-radius: 6px;">
            Lọc Tìm Kiếm
        </button>
        
        <?php if ((isset($_GET['keyword']) && $_GET['keyword'] !== '') || (isset($_GET['status']) && $_GET['status'] !== 'all' && $_GET['status'] !== '')): ?>
            <a href="index.php?act=listbill" style="font-size: 13px; color: var(--text-muted); text-decoration: underline; margin-left: 5px;">Xoá bộ lọc</a>
        <?php endif; ?>
    </form>
</div>

<?php if (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 100px;">Mã Đơn</th>
                <th>Khách hàng</th>
                <th style="width: 130px; text-align: center;">Ngày Đặt</th>
                <th style="width: 140px; text-align: right;">Tổng Tiền</th>
                <th style="width: 160px; text-align: center;">Thanh toán</th>
                <th style="width: 140px; text-align: center;">Trạng thái</th>
                <th style="width: 220px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Apply filtering logic at the UI level if the controller didn't do it
            $filtered_bills = $list_bill;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
            $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

            if ($keyword !== '' || $status_filter !== 'all') {
                $filtered_bills = array_filter($list_bill, function($b) use ($keyword, $status_filter) {
                    $match_keyword = true;
                    $match_status = true;

                    if ($keyword !== '') {
                        $match_keyword = (stripos($b['bill_code'], $keyword) !== false) ||
                                        (stripos($b['bill_name'], $keyword) !== false) ||
                                        (stripos($b['bill_phone'], $keyword) !== false) ||
                                        (stripos($b['bill_email'], $keyword) !== false);
                    }

                    if ($status_filter !== 'all') {
                        $match_status = (int)$b['bill_status'] === (int)$status_filter;
                    }

                    return $match_keyword && $match_status;
                });
            }

            if (empty($filtered_bills)) {
                echo '<tr><td colspan="7" style="text-align: center; color: var(--text-muted); padding: 20px;">Không có đơn hàng nào khớp với tìm kiếm.</td></tr>';
            } else {
                foreach ($filtered_bills as $b):
                    $detail_url = "index.php?act=detailbill&id=" . $b['id'];
                    $edit_url = "index.php?act=suabill&id=" . $b['id'];
                    $delete_url = "index.php?act=xoabill&id=" . $b['id'];

                    // Trạng thái đơn đặt tour
                    switch ($b['bill_status']) {
                        case 0:
                            $status_badge = '<span style="background-color: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #d1d5db;">Chờ xác nhận</span>';
                            break;
                        case 1:
                            $status_badge = '<span style="background-color: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #bfdbfe;">Đang chuẩn bị</span>';
                            break;
                        case 2:
                            $status_badge = '<span style="background-color: #d1fae5; color: #065f46; padding: 4px 8px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #a7f3d0;">Đã khởi hành</span>';
                            break;
                        case 3:
                            $status_badge = '<span style="background-color: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #fecaca;">Đã hủy</span>';
                            break;
                        default:
                            $status_badge = '<span style="background-color: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 20px; font-weight: 600; font-size: 12px;">Chưa rõ</span>';
                            break;
                    }

                    // Phương thức thanh toán
                    switch ($b['bill_pttt']) {
                        case 0:
                            $pttt_badge = '<span style="background-color: #fff7ed; color: #c2410c; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; border: 1px solid #ffedd5;">💵 Tiền mặt</span>';
                            break;
                        case 1:
                            $pttt_badge = '<span style="background-color: #f0fdf4; color: #15803d; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; border: 1px solid #dcfce7;">🏦 Chuyển khoản</span>';
                            break;
                        case 2:
                            $pttt_badge = '<span style="background-color: #faf5ff; color: #7e22ce; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 600; border: 1px solid #f3e8ff;">📱 Ví điện tử</span>';
                            break;
                        default:
                            $pttt_badge = '<span style="background-color: #f3f4f6; color: #4b5563; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 600;">Khác</span>';
                            break;
                    }
            ?>
                <tr>
                    <td>
                        <a href="<?php echo $detail_url; ?>" style="color: var(--primary-color); font-weight: 700; text-decoration: none; hover: underline;">
                            <?php echo htmlspecialchars($b['bill_code']); ?>
                        </a>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($b['bill_name']); ?></div>
                        <div style="font-size: 11px; color: var(--text-muted); margin-top: 2px;">
                            📞 <?php echo htmlspecialchars($b['bill_phone']); ?>
                        </div>
                    </td>
                    <td style="text-align: center; color: var(--text-muted); font-size: 13px;">
                        <?php echo date('d/m/Y', strtotime($b['date_booking'])); ?>
                    </td>
                    <td style="text-align: right; font-weight: 700; color: var(--primary-color);">
                        <?php echo number_format($b['bill_total'], 0, ',', '.') . ' VNĐ'; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $pttt_badge; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $status_badge; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $detail_url; ?>" class="btn-action" style="background-color: #3b82f6; border: none; color: #fff; padding: 5px 10px; font-size: 12px; font-weight: 600; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" title="Xem chi tiết">
                            <span>👁️</span> Chi tiết
                        </a>
                        <a href="<?php echo $edit_url; ?>" class="btn-action btn-edit" title="Sửa đơn hàng" style="padding: 5px 10px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $delete_url; ?>" class="btn-action btn-delete" title="Xóa đơn hàng" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt tour này không?');" style="padding: 5px 10px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                            <span>🗑️</span> Xóa
                        </a>
                    </td>
                </tr>
            <?php 
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>
