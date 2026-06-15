<div class="container">
    <div class="form-card">
        <h2 class="form-title">Đăng Ký Thành Viên</h2>
        <p class="form-subtitle">Tạo tài khoản du lịch để lưu trữ các hành trình yêu thích và nhận ưu đãi đặc biệt.</p>

        <!-- Hiển thị thông báo nếu có -->
        <?php if (isset($thongbao) && $thongbao != ''): ?>
            <div class="alert alert-danger">
                ⚠️ <?php echo htmlspecialchars($thongbao); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($thongbao_success) && $thongbao_success != ''): ?>
            <div class="alert alert-success">
                🎉 <?php echo htmlspecialchars($thongbao_success); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?act=dangky" method="POST" id="registerForm" novalidate>
            <div class="form-group">
                <label for="username">Tên đăng nhập *</label>
                <input type="text" id="username" name="username" placeholder="Tên đăng nhập viết liền không dấu" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <span class="error-message" id="err-username"></span>
            </div>

            <div class="form-group">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <span class="error-message" id="err-email"></span>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" placeholder="09xxxxxxx" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                <span class="error-message" id="err-phone"></span>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu *</label>
                <input type="password" id="password" name="password" placeholder="Tối thiểu 6 ký tự">
                <span class="error-message" id="err-password"></span>
            </div>

            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu *</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu phía trên">
                <span class="error-message" id="err-confirm_password"></span>
            </div>

            <button type="submit" name="dangky" class="btn-form">Đăng Ký Ngay</button>
        </form>

        <div class="form-footer">
            Bạn đã có tài khoản? <a href="index.php?act=dangnhap">Đăng nhập ngay</a>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('registerForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');

    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Reset errors
        resetError(username);
        resetError(email);
        resetError(phone);
        resetError(password);
        resetError(confirmPassword);

        // 1. Không bỏ trống (Validate empty)
        if (username.value.trim() === '') {
            showError(username, 'Tên đăng nhập không được để trống.');
            isValid = false;
        } else {
            showSuccess(username);
        }

        if (email.value.trim() === '') {
            showError(email, 'Địa chỉ Email không được để trống.');
            isValid = false;
        } else {
            // 2. Đúng định dạng email (Validate email format)
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                showError(email, 'Địa chỉ Email không đúng định dạng.');
                isValid = false;
            } else {
                showSuccess(email);
            }
        }

        if (phone.value.trim() === '') {
            showError(phone, 'Số điện thoại không được để trống.');
            isValid = false;
        } else {
            // 3. Đúng định dạng số & độ dài (Validate phone number format)
            const phoneRegex = /^[0-9]+$/;
            if (!phoneRegex.test(phone.value.trim())) {
                showError(phone, 'Số điện thoại không đúng định dạng số (chỉ được chứa các số từ 0-9).');
                isValid = false;
            } else if (phone.value.trim().length < 10 || phone.value.trim().length > 11) {
                showError(phone, 'Số điện thoại phải có độ dài từ 10 đến 11 chữ số.');
                isValid = false;
            } else {
                showSuccess(phone);
            }
        }

        if (password.value === '') {
            showError(password, 'Mật khẩu không được để trống.');
            isValid = false;
        } else if (password.value.length < 6) {
            showError(password, 'Mật khẩu phải có độ dài tối thiểu 6 ký tự.');
            isValid = false;
        } else {
            showSuccess(password);
        }

        if (confirmPassword.value === '') {
            showError(confirmPassword, 'Vui lòng xác nhận lại mật khẩu.');
            isValid = false;
        } else if (confirmPassword.value !== password.value) {
            showError(confirmPassword, 'Mật khẩu xác nhận không trùng khớp.');
            isValid = false;
        } else {
            showSuccess(confirmPassword);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Real-time input listeners to clear errors on typing
    const inputs = [username, email, phone, password, confirmPassword];
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
