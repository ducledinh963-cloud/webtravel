<div class="container" style="padding: 50px 15px; text-align: center;">
    <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 40px; box-shadow: var(--card-shadow); max-width: 650px; margin: 0 auto;">
        
        <div style="font-size: 64px; margin-bottom: 20px;">🎉</div>
        <h2 style="font-size: 24px; font-weight: 800; color: #10b981; margin-bottom: 10px;">ĐẶT TOUR THÀNH CÔNG!</h2>
        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 30px;">
            Cảm ơn bạn đã lựa chọn dịch vụ của Web Travel. Mã đơn đặt tour của bạn là: <strong style="color: var(--primary-color); font-size: 15px;"><?php echo htmlspecialchars($bill['bill_code']); ?></strong>
        </p>

        <!-- Booking details summary -->
        <div style="text-align: left; background-color: #f8fafc; border-radius: 8px; padding: 20px; border: 1px solid var(--border-color); margin-bottom: 35px;">
            <h4 style="font-size: 14px; font-weight: 800; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; margin-top: 0; margin-bottom: 15px; color: var(--text-dark);">
                📄 THÔNG TIN ĐƠN ĐẶT TOUR
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 8px; font-size: 13px;">
                <div><strong>Người liên hệ:</strong> <?php echo htmlspecialchars($bill['bill_name']); ?></div>
                <div><strong>Email:</strong> <?php echo htmlspecialchars($bill['bill_email']); ?></div>
                <div><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($bill['bill_phone']); ?></div>
                <div><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($bill['bill_address']); ?></div>
                <div><strong>Phương thức thanh toán:</strong> 
                    <?php echo $bill['bill_pttt'] == 0 ? 'Chuyển khoản ngân hàng' : 'Thanh toán trực tiếp khi khởi hành'; ?>
                </div>
                <div><strong>Thời gian đặt:</strong> <?php echo htmlspecialchars($bill['date_booking']); ?></div>
                <div><strong>Tổng tiền thanh toán:</strong> <strong style="color: var(--secondary-color); font-size: 14px;"><?php echo number_format($bill['bill_total']); ?>đ</strong></div>
            </div>
            
            <h4 style="font-size: 13px; font-weight: 800; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; margin-top: 20px; margin-bottom: 15px; color: var(--text-dark);">
                ⛵ HÀNH TRÌNH TOUR ĐẶT
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <?php foreach ($bill_details as $item): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px;">
                        <span>- <?php echo htmlspecialchars($item['name']); ?> (<strong><?php echo $item['quantity']; ?> khách</strong>)</span>
                        <span style="font-weight: 700; color: var(--text-dark);"><?php echo number_format($item['total']); ?>đ</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="index.php" class="btn-action" style="background-color: var(--text-dark); padding: 12px 25px; text-decoration: none;">
                🏠 Về Trang Chủ
            </a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?act=mybookings" class="btn-form" style="width: auto; padding: 12px 30px; margin: 0; background-color: var(--primary-color);">
                    📅 Xem Tour Đã Đặt
                </a>
            <?php endif; ?>
        </div>

    </div>
</div>
