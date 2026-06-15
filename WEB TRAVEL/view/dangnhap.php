<div class="container">
    <div class="form-card">
        <h2 class="form-title">Đăng Nhập Hệ Thống</h2>
        <p class="form-subtitle">Chào mừng bạn trở lại! Vui lòng đăng nhập tài khoản của bạn.</p>

        <!-- Hiển thị thông báo nếu có -->
        <?php if (isset($thongbao) && $thongbao != ''): ?>
            <div class="alert alert-danger">
                ⚠️ <?php echo htmlspecialchars($thongbao); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="alert alert-success">
                🎉 Bạn đã đăng nhập thành công với tài khoản: <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong>.
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php" class="hero-btn">Về Trang Chủ</a>
            </div>
        <?php else: ?>
            <form action="index.php?act=dangnhap" method="POST">
                <div class="form-group">
                    <label for="username">Tên đăng nhập / Tài khoản *</label>
                    <input type="text" id="username" name="username" required placeholder="Nhập tên đăng nhập của bạn" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu *</label>
                    <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 13px;">
                    <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; font-weight: normal;">
                        <input type="checkbox" name="remember" style="width: auto;"> Ghi nhớ tài khoản
                    </label>
                    <a href="index.php?act=quenmk" style="color: var(--primary-color);">Quên mật khẩu?</a>
                </div>

                <button type="submit" name="dangnhap" class="btn-form">Đăng Nhập</button>
            </form>

            <div class="form-footer">
                Chưa có tài khoản du lịch? <a href="index.php?act=dangky">Đăng ký thành viên mới</a>
            </div>
        <?php endif; ?>
    </div>
</div>
