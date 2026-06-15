<div class="admin-form-container">
    <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 20px; color: var(--text-dark); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Cập Nhật Nhân Viên</h2>

    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatenv" method="POST" id="update-employee-form">
        <input type="hidden" name="id" value="<?php echo $tk['id']; ?>">

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="username">Tên đăng nhập *</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên tài khoản..." value="<?php echo htmlspecialchars($tk['username']); ?>">
                <span class="error-message" id="username-error" style="color: #ef4444; font-size: 12px; margin-top: 5px; display: none;"></span>
            </div>

            <div class="admin-form-group">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" id="email" name="email" required placeholder="example@webtravel.com..." value="<?php echo htmlspecialchars($tk['email']); ?>">
                <span class="error-message" id="email-error" style="color: #ef4444; font-size: 12px; margin-top: 5px; display: none;"></span>
            </div>
        </div>

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="09xxxxxxx..." value="<?php echo htmlspecialchars($tk['phone'] ? $tk['phone'] : ''); ?>">
                <span class="error-message" id="phone-error" style="color: #ef4444; font-size: 12px; margin-top: 5px; display: none;"></span>
            </div>

            <div class="admin-form-group">
                <label for="password">Mật khẩu mới (để trống nếu không muốn đổi)</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới từ 6 ký tự..." value="">
                <span class="error-message" id="password-error" style="color: #ef4444; font-size: 12px; margin-top: 5px; display: none;"></span>
            </div>
        </div>

        <div class="admin-form-group" style="max-width: 500px;">
            <label for="role">Vai trò tài khoản *</label>
            <select id="role" name="role" required>
                <option value="0" <?php echo ($tk['role'] == 0) ? 'selected' : ''; ?>>Khách hàng</option>
                <option value="2" <?php echo ($tk['role'] == 2) ? 'selected' : ''; ?>>Nhân viên (Staff)</option>
                <option value="1" <?php echo ($tk['role'] == 1) ? 'selected' : ''; ?>>Quản trị viên (Admin)</option>
            </select>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #8b5cf6;">
                Cập Nhật Nhân Viên
            </button>
            <a href="index.php?act=listnv" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy Bỏ
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('update-employee-form');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');

    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Reset errors
        document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
        document.querySelectorAll('input').forEach(el => el.style.borderColor = '');

        // Validate username
        if (username.value.trim().length < 3) {
            showError(username, 'username-error', 'Tên đăng nhập phải chứa ít nhất 3 ký tự.');
            isValid = false;
        }

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            showError(email, 'email-error', 'Địa chỉ email không đúng định dạng.');
            isValid = false;
        }

        // Validate phone (optional but must be number if input)
        if (phone.value.trim() !== '') {
            const phoneRegex = /^[0-9]{10,11}$/;
            if (!phoneRegex.test(phone.value.trim())) {
                showError(phone, 'phone-error', 'Số điện thoại phải chứa 10 hoặc 11 chữ số.');
                isValid = false;
            }
        }

        // Validate password (optional for update, but must be >= 6 if entered)
        if (password.value !== '' && password.value.length < 6) {
            showError(password, 'password-error', 'Mật khẩu phải chứa ít nhất 6 ký tự.');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(inputEl, errorId, message) {
        inputEl.style.borderColor = '#ef4444';
        const errorEl = document.getElementById(errorId);
        errorEl.textContent = message;
        errorEl.style.display = 'block';
    }
});
</script>
