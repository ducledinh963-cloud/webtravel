<div class="container">
    <div class="form-card">
        <h2 class="form-title">Khôi Phục Mật Khẩu</h2>
        <p class="form-subtitle">Nhập địa chỉ Email đã đăng ký để đặt lại mật khẩu của bạn.</p>

        <!-- Hiển thị thông báo nếu có -->
        <?php if (isset($thongbao) && $thongbao != ''): ?>
            <div class="alert alert-danger" style="border-radius: 6px; border-left: 4px solid #ef4444; margin-bottom: 20px;">
                ⚠️ <?php echo htmlspecialchars($thongbao); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($thongbao_success) && $thongbao_success != ''): ?>
            <div class="alert alert-success" style="border-radius: 6px; border-left: 4px solid #10b981; margin-bottom: 20px; line-height: 1.6;">
                🎉 <?php echo $thongbao_success; ?>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php?act=dangnhap" class="hero-btn">Đăng Nhập Ngay</a>
            </div>
        <?php else: ?>
            <form action="index.php?act=quenmk" method="POST" id="forgotPasswordForm">
                <div class="form-group">
                    <label for="email">Địa chỉ Email đã đăng ký *</label>
                    <input type="email" id="email" name="email" required placeholder="Nhập địa chỉ email của bạn" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <span id="email_err" style="color: #ef4444; font-size: 12px; display: none; margin-top: 4px;">Email không đúng định dạng.</span>
                </div>

                <button type="submit" name="guiyeucau" class="btn-form" style="margin-top: 10px;">Gửi Yêu Cầu Khôi Phục</button>
            </form>

            <div class="form-footer">
                Quay lại trang <a href="index.php?act=dangnhap">Đăng nhập tài khoản</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('forgotPasswordForm')?.addEventListener('submit', function(e) {
    let hasError = false;
    const email = document.getElementById('email');
    const emailErr = document.getElementById('email_err');
    
    // Clear errors
    email.classList.remove('input-error');
    if (emailErr) emailErr.style.display = 'none';

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
        email.classList.add('input-error');
        if (emailErr) emailErr.style.display = 'block';
        hasError = true;
    }

    if (hasError) {
        e.preventDefault();
        email.focus();
    }
});
</script>
