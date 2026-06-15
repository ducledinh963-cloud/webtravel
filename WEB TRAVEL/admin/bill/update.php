<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatebill" method="POST">
        <!-- ID đơn hàng ẩn -->
        <input type="hidden" name="id" value="<?php echo $bill['id']; ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="bill_code">Mã đơn hàng</label>
                <input type="text" id="bill_code" disabled value="<?php echo htmlspecialchars($bill['bill_code']); ?>" style="background-color: var(--border-color); cursor: not-allowed; font-weight: bold;">
            </div>

            <div class="admin-form-group">
                <label for="date_booking">Ngày đặt tour</label>
                <input type="text" id="date_booking" disabled value="<?php echo date('d/m/Y H:i:s', strtotime($bill['date_booking'])); ?>" style="background-color: var(--border-color); cursor: not-allowed;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="bill_name">Tên khách hàng *</label>
                <input type="text" id="bill_name" name="bill_name" required placeholder="Nhập tên khách hàng..." value="<?php echo htmlspecialchars($bill['bill_name']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="bill_phone">Số điện thoại *</label>
                <input type="text" id="bill_phone" name="bill_phone" required placeholder="Nhập số điện thoại..." value="<?php echo htmlspecialchars($bill['bill_phone']); ?>">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="bill_email">Địa chỉ Email</label>
                <input type="email" id="bill_email" name="bill_email" placeholder="Nhập địa chỉ email..." value="<?php echo htmlspecialchars($bill['bill_email']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="bill_status">Trạng thái đơn hàng *</label>
                <select id="bill_status" name="bill_status" required style="padding: 10px; border: 1px solid var(--border-color); border-radius: 6px; width: 100%; outline: none; cursor: pointer;">
                    <option value="0" <?php echo ($bill['bill_status'] == 0) ? 'selected' : ''; ?>>Chờ xác nhận</option>
                    <option value="1" <?php echo ($bill['bill_status'] == 1) ? 'selected' : ''; ?>>Đang chuẩn bị</option>
                    <option value="2" <?php echo ($bill['bill_status'] == 2) ? 'selected' : ''; ?>>Đã khởi hành</option>
                    <option value="3" <?php echo ($bill['bill_status'] == 3) ? 'selected' : ''; ?>>Đã hủy</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="bill_address">Địa chỉ liên hệ</label>
            <input type="text" id="bill_address" name="bill_address" placeholder="Nhập địa chỉ giao dịch/liên hệ..." value="<?php echo htmlspecialchars($bill['bill_address']); ?>">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div class="admin-form-group">
                <label>Hình thức thanh toán</label>
                <div style="padding: 12px; background-color: var(--bg-light); border-radius: 6px; font-weight: 600; color: var(--text-dark); border: 1px solid var(--border-color);">
                    <?php 
                    switch ($bill['bill_pttt']) {
                        case 0: echo '💵 Tiền mặt'; break;
                        case 1: echo '🏦 Chuyển khoản ngân hàng'; break;
                        case 2: echo '📱 Ví điện tử'; break;
                        default: echo 'Chưa xác định'; break;
                    }
                    ?>
                </div>
            </div>

            <div class="admin-form-group">
                <label>Tổng giá trị đơn hàng</label>
                <div style="padding: 12px; background-color: var(--bg-light); border-radius: 6px; font-weight: 700; color: var(--primary-color); border: 1px solid var(--border-color); font-size: 16px;">
                    <?php echo number_format($bill['bill_total'], 0, ',', '.') . ' VNĐ'; ?>
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Đơn Hàng
            </button>
            <a href="index.php?act=listbill" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy &amp; Quay Lại
            </a>
        </div>
    </form>
</div>
