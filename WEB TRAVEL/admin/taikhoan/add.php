<div class="admin-form-container">
    <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 20px; color: var(--text-dark); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Thêm Tài Khoản Mới</h2>

    <?php if (isset($thongbao) && $thongbao != ''): ?>
        <div class="alert alert-success" style="margin-bottom: 20px;">
            🎉 <?php echo htmlspecialchars($thongbao); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=addtk" method="POST">
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="username">Tên đăng nhập *</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên tài khoản..." value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" id="email" name="email" required placeholder="example@webtravel.com..." value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="09xxxxxxx..." value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="password">Mật khẩu *</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu từ 6 ký tự..." value="">
            </div>
        </div>

        <div class="admin-form-group" style="max-width: 500px;">
            <label for="role">Vai trò tài khoản *</label>
            <select id="role" name="role" required>
                <option value="0" <?php echo (isset($_POST['role']) && $_POST['role'] == 0) ? 'selected' : ''; ?>>Khách hàng</option>
                <option value="2" <?php echo (isset($_POST['role']) && $_POST['role'] == 2) ? 'selected' : ''; ?>>Nhân viên (Staff)</option>
                <option value="1" <?php echo (isset($_POST['role']) && $_POST['role'] == 1) ? 'selected' : ''; ?>>Quản trị viên (Admin)</option>
            </select>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Thêm Mới Tài Khoản
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listtk" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Tài Khoản
            </a>
        </div>
    </form>
</div>
