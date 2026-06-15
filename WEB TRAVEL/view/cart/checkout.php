<div class="container" style="padding: 40px 15px;">
    <h2 class="form-title" style="text-align: center; margin-bottom: 10px;">Thành Toán Đặt Tour</h2>
    <p class="form-subtitle" style="text-align: center; margin-bottom: 40px;">Vui lòng kiểm tra lại đơn đặt tour và cung cấp thông tin liên lạc chính xác để chúng tôi chuẩn bị dịch vụ tốt nhất.</p>

    <!-- Hiển thị thông báo nếu có -->
    <?php if (isset($thongbao) && $thongbao != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 25px;">
            ⚠️ <?php echo htmlspecialchars($thongbao); ?>
        </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 30px; align-items: start;">
        <!-- Form thông tin khách hàng -->
        <div class="form-card" style="margin: 0; width: 100%;">
            <h3 style="font-weight: 800; font-size: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 20px;">
                👤 THÔNG TIN KHÁCH HÀNG &amp; LIÊN HỆ
            </h3>

            <form action="index.php?act=checkout" method="POST" id="checkoutForm" novalidate>
                <div class="form-group">
                    <label for="bill_name">Họ và Tên khách đại diện *</label>
                    <input type="text" id="bill_name" name="bill_name" placeholder="Nhập đầy đủ họ tên người đi tour" 
                           value="<?php echo isset($_POST['bill_name']) ? htmlspecialchars($_POST['bill_name']) : ($user ? htmlspecialchars($user['username']) : ''); ?>">
                    <span class="error-message" id="err-bill_name"></span>
                </div>

                <div class="form-group">
                    <label for="bill_email">Địa chỉ Email *</label>
                    <input type="email" id="bill_email" name="bill_email" placeholder="example@gmail.com" 
                           value="<?php echo isset($_POST['bill_email']) ? htmlspecialchars($_POST['bill_email']) : ($user ? htmlspecialchars($user['email']) : ''); ?>">
                    <span class="error-message" id="err-bill_email"></span>
                </div>

                <div class="form-group">
                    <label for="bill_phone">Số điện thoại liên hệ *</label>
                    <input type="tel" id="bill_phone" name="bill_phone" placeholder="09xxxxxxx" 
                           value="<?php echo isset($_POST['bill_phone']) ? htmlspecialchars($_POST['bill_phone']) : ($user ? htmlspecialchars($user['phone']) : ''); ?>">
                    <span class="error-message" id="err-bill_phone"></span>
                </div>

                <div class="form-group">
                    <label for="bill_address">Địa chỉ nơi cư trú *</label>
                    <input type="text" id="bill_address" name="bill_address" placeholder="Nhập số nhà, tên đường, tỉnh thành..." 
                           value="<?php echo isset($_POST['bill_address']) ? htmlspecialchars($_POST['bill_address']) : ''; ?>">
                    <span class="error-message" id="err-bill_address"></span>
                </div>

                <div class="form-group">
                    <label>Phương thức thanh toán đặt tour *</label>
                    <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                        <label style="font-weight: 500; font-size: 13px; display: flex; align-items: center; gap: 10px; cursor: pointer; margin: 0;">
                            <input type="radio" name="bill_pttt" value="0" checked style="width: auto;">
                            🏢 Chuyển khoản ngân hàng (Đặt cọc hoặc thanh toán trước)
                        </label>
                        <label style="font-weight: 500; font-size: 13px; display: flex; align-items: center; gap: 10px; cursor: pointer; margin: 0;">
                            <input type="radio" name="bill_pttt" value="1" style="width: auto;">
                            💵 Thanh toán bằng tiền mặt trực tiếp khi khởi hành đi tour
                        </label>
                    </div>
                </div>

                <button type="submit" name="booking" class="btn-form" style="background-color: var(--secondary-color); font-size: 15px; margin-top: 20px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);">
                    ✔️ XÁC NHẬN ĐẶT TOUR NGAY
                </button>
            </form>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow);">
            <h3 style="font-weight: 800; font-size: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 20px;">
                📑 TÓM TẮT CÁC TOUR ĐÃ CHỌN
            </h3>

            <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 25px;">
                <?php 
                $total_amount = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $total_amount += $item['subtotal'];
                ?>
                    <div style="display: flex; align-items: center; gap: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Tour photo" style="width: 55px; height: 38px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                        <div style="flex: 1;">
                            <div style="font-size: 13px; font-weight: 700; color: var(--text-dark); display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </div>
                            <div style="font-size: 12px; color: var(--text-muted);">
                                <?php echo number_format($item['price']); ?>đ x <span style="color: var(--primary-color); font-weight: 700;"><?php echo $item['quantity']; ?> khách</span>
                            </div>
                        </div>
                        <div style="font-size: 13px; font-weight: 800; color: var(--secondary-color);">
                            <?php echo number_format($item['subtotal']); ?>đ
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 2px dashed var(--border-color); padding-top: 15px;">
                <span style="font-weight: 800; font-size: 14px;">Tổng tiền cần thanh toán:</span>
                <span style="font-weight: 800; font-size: 20px; color: var(--secondary-color);">
                    <?php echo number_format($total_amount); ?>đ
                </span>
            </div>

            <!-- Notes or assurances -->
            <div style="margin-top: 25px; background-color: #f8fafc; border-radius: 8px; padding: 15px; border-left: 4px solid var(--primary-color);">
                <h4 style="font-size: 12px; font-weight: 800; margin-bottom: 5px; color: var(--text-dark);">🔒 Đặt tour an toàn &amp; nhanh chóng</h4>
                <p style="font-size: 11px; color: var(--text-muted); line-height: 1.6; margin: 0;">
                    Thông tin giao dịch của bạn được bảo mật tuyệt đối. Sau khi hoàn thành đăng ký, chuyên viên tư vấn của Web Travel sẽ gọi điện xác nhận lại lịch khởi hành trong vòng 15-30 phút.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('checkoutForm');
    const billName = document.getElementById('bill_name');
    const billEmail = document.getElementById('bill_email');
    const billPhone = document.getElementById('bill_phone');
    const billAddress = document.getElementById('bill_address');

    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Reset errors
        resetError(billName);
        resetError(billEmail);
        resetError(billPhone);
        resetError(billAddress);

        // Validate empty
        if (billName.value.trim() === '') {
            showError(billName, 'Vui lòng cung cấp họ tên người đại diện.');
            isValid = false;
        } else {
            showSuccess(billName);
        }

        if (billEmail.value.trim() === '') {
            showError(billEmail, 'Địa chỉ Email không được bỏ trống.');
            isValid = false;
        } else {
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(billEmail.value.trim())) {
                showError(billEmail, 'Địa chỉ Email không đúng định dạng.');
                isValid = false;
            } else {
                showSuccess(billEmail);
            }
        }

        if (billPhone.value.trim() === '') {
            showError(billPhone, 'Vui lòng điền số điện thoại liên lạc.');
            isValid = false;
        } else {
            // Validate phone number format
            const phoneRegex = /^[0-9]+$/;
            if (!phoneRegex.test(billPhone.value.trim())) {
                showError(billPhone, 'Số điện thoại không đúng định dạng số (chỉ chứa các số 0-9).');
                isValid = false;
            } else if (billPhone.value.trim().length < 10 || billPhone.value.trim().length > 11) {
                showError(billPhone, 'Số điện thoại phải có độ dài từ 10 đến 11 chữ số.');
                isValid = false;
            } else {
                showSuccess(billPhone);
            }
        }

        if (billAddress.value.trim() === '') {
            showError(billAddress, 'Vui lòng điền địa chỉ để nhận hồ sơ đặt tour.');
            isValid = false;
        } else {
            showSuccess(billAddress);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Real-time input listeners to clear errors on typing
    const inputs = [billName, billEmail, billPhone, billAddress];
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            resetError(input);
        });
    });

    function showError(inputElement, message) {
        const formGroup = inputElement.parentElement;
        const errorSpan = formGroup.querySelector('.error-message');
        formGroup.classList.remove('valid');
        formGroup.classList.add('invalid');
        if (errorSpan) {
            errorSpan.innerText = message;
            errorSpan.style.display = 'block';
        }
    }

    function showSuccess(inputElement) {
        const formGroup = inputElement.parentElement;
        formGroup.classList.remove('invalid');
        formGroup.classList.add('valid');
        const errorSpan = formGroup.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.style.display = 'none';
        }
    }

    function resetError(inputElement) {
        const formGroup = inputElement.parentElement;
        formGroup.classList.remove('invalid');
        formGroup.classList.remove('valid');
        const errorSpan = formGroup.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.style.display = 'none';
            errorSpan.innerText = '';
        }
    }
});
</script>
