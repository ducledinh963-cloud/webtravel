<div class="container" style="padding: 40px 15px;">
    <h2 class="form-title" style="text-align: center; margin-bottom: 10px;">Lịch Sử Đặt Tour</h2>
    <p class="form-subtitle" style="text-align: center; margin-bottom: 40px;">Theo dõi tiến trình, thông tin thanh toán và trạng thái của các tour du lịch bạn đã đặt mua.</p>

    <?php if (empty($list_bill)): ?>
        <div style="text-align: center; padding: 50px 20px; background-color: var(--white); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
            <div style="font-size: 64px; margin-bottom: 20px;">📅</div>
            <h3 style="font-size: 17px; font-weight: 700; margin-bottom: 10px;">Bạn chưa thực hiện đặt tour nào</h3>
            <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 25px;">Tìm ngay một tour du lịch hấp dẫn và đặt chuyến đi cùng chúng tôi.</p>
            <a href="index.php?act=sanpham" class="btn-form" style="display: inline-block; width: auto; padding: 12px 30px;">Tìm Tour Phù Hợp</a>
        </div>
    <?php else: ?>
        <div class="admin-table-wrapper" style="box-shadow: var(--card-shadow); border-radius: 12px; overflow: hidden; background: var(--white); border: 1px solid var(--border-color);">
            <table class="admin-table">
                <thead>
                    <tr style="background-color: #f8fafc;">
                        <th style="width: 150px;">Mã đơn đặt</th>
                        <th>Khách đại diện</th>
                        <th style="width: 150px; text-align: center;">Ngày đặt</th>
                        <th style="width: 150px; text-align: right;">Tổng thanh toán</th>
                        <th style="width: 180px; text-align: center;">Trạng thái đơn</th>
                        <th style="width: 150px; text-align: center;">Hành trình đặt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($list_bill as $bill): 
                        // Lấy trạng thái
                        $status_str = '';
                        switch ($bill['bill_status']) {
                            case 0:
                                $status_str = '<span style="background-color: #fef3c7; color: #d97706; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Chờ xác nhận</span>';
                                break;
                            case 1:
                                $status_str = '<span style="background-color: #dbeafe; color: #1d4ed8; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Đang chuẩn bị</span>';
                                break;
                            case 2:
                                $status_str = '<span style="background-color: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Đã khởi hành</span>';
                                break;
                            case 3:
                                $status_str = '<span style="background-color: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Đã huỷ đơn</span>';
                                break;
                        }
                    ?>
                        <tr>
                            <td><strong style="color: var(--primary-color);"><?php echo htmlspecialchars($bill['bill_code']); ?></strong></td>
                            <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($bill['bill_name']); ?></td>
                            <td style="text-align: center; font-size: 13px; color: var(--text-muted);"><?php echo htmlspecialchars($bill['date_booking']); ?></td>
                            <td style="text-align: right; font-weight: 800; color: var(--secondary-color);">
                                <?php echo number_format($bill['bill_total']); ?>đ
                            </td>
                            <td style="text-align: center;"><?php echo $status_str; ?></td>
                            <td style="text-align: center;">
                                <a href="index.php?act=checkout_success&id=<?php echo $bill['id']; ?>" class="btn-action" style="padding: 6px 12px; font-size: 12px; background-color: var(--primary-color);">
                                    🔍 Xem Chi Tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
