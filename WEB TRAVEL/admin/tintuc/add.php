<div class="admin-form-container">
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

    <form action="index.php?act=addtt" method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="title">Tiêu đề bài viết *</label>
                <input type="text" id="title" name="title" required placeholder="Nhập tiêu đề tin tức hoặc bài viết..." value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="date">Ngày đăng bài</label>
                <input type="text" id="date" name="date" placeholder="Mặc định: Ngày hiện tại (ví dụ: 14 Th06)" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="image">Hình ảnh đại diện bài viết</label>
            <input type="file" id="image" name="image" style="padding: 6px;">
            <span style="font-size: 12px; color: var(--text-muted); display: block; margin-top: 5px;">Hệ thống hỗ trợ các định dạng JPG, JPEG, PNG, GIF. Kích thước khuyến nghị: 600x380px.</span>
        </div>

        <div class="admin-form-group">
            <label for="description">Nội dung chi tiết bài viết *</label>
            <textarea id="description" name="description" rows="12" required placeholder="Viết nội dung bài viết chia sẻ kinh nghiệm du lịch tại đây..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Đăng Bài Viết
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listtt" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Bài Viết
            </a>
        </div>
    </form>
</div>
