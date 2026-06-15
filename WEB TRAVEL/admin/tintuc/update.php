<?php
if (isset($tt) && is_array($tt)) {
    extract($tt);
}
?>
<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatett" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($image); ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="title">Tiêu đề bài viết *</label>
                <input type="text" id="title" name="title" required placeholder="Nhập tiêu đề tin tức hoặc bài viết..." value="<?php echo htmlspecialchars($title); ?>">
            </div>

            <div class="admin-form-group">
                <label for="date">Ngày đăng bài</label>
                <input type="text" id="date" name="date" required placeholder="Ví dụ: 14 Th06" value="<?php echo htmlspecialchars($date); ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="image">Hình ảnh đại diện bài viết</label>
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 10px;">
                <img src="../<?php echo htmlspecialchars($image); ?>" alt="Old Image" style="width: 150px; height: 90px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../https://placehold.co/150x90?text=No+Image'">
                <span style="font-size: 13px; color: var(--text-muted);">Hình ảnh hiện tại đang sử dụng. Đăng ảnh mới bên dưới nếu muốn thay đổi.</span>
            </div>
            <input type="file" id="image" name="image" style="padding: 6px;">
            <span style="font-size: 12px; color: var(--text-muted); display: block; margin-top: 5px;">Hệ thống hỗ trợ các định dạng JPG, JPEG, PNG, GIF. Kích thước khuyến nghị: 600x380px.</span>
        </div>

        <div class="admin-form-group">
            <label for="description">Nội dung chi tiết bài viết *</label>
            <textarea id="description" name="description" rows="12" required placeholder="Viết nội dung bài viết chia sẻ kinh nghiệm du lịch tại đây..."><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer;">
                Lưu Thay Đổi
            </button>
            <a href="index.php?act=listtt" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy Bỏ / Danh Sách
            </a>
        </div>
    </form>
</div>
