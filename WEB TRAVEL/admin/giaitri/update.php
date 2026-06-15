<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updategt" method="POST" enctype="multipart/form-data">
        <!-- Mã giải trí ẩn -->
        <input type="hidden" name="id" value="<?php echo $gt['id']; ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($gt['image']); ?>">

        <div style="display: grid; grid-template-columns: 80px 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="id_view">Mã</label>
                <input type="text" id="id_view" disabled value="#<?php echo $gt['id']; ?>" style="background-color: var(--border-color); cursor: not-allowed; text-align: center; font-weight: bold;">
            </div>

            <div class="admin-form-group">
                <label for="name">Tên hoạt động giải trí / Khu vui chơi *</label>
                <input type="text" id="name" name="name" required placeholder="Nhập tên hoạt động giải trí..." value="<?php echo htmlspecialchars($gt['name']); ?>">
            </div>
            
            <div class="admin-form-group">
                <label for="rating">Xếp hạng đánh giá *</label>
                <select id="rating" name="rating" required>
                    <option value="5" <?php echo (round($gt['rating']) == 5) ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 Điểm)</option>
                    <option value="4" <?php echo (round($gt['rating']) == 4) ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 Điểm)</option>
                    <option value="3" <?php echo (round($gt['rating']) == 3) ? 'selected' : ''; ?>>⭐⭐⭐ (3 Điểm)</option>
                    <option value="2" <?php echo (round($gt['rating']) == 2) ? 'selected' : ''; ?>>⭐⭐ (2 Điểm)</option>
                    <option value="1" <?php echo (round($gt['rating']) == 1) ? 'selected' : ''; ?>>⭐ (1 Điểm)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="address">Địa chỉ / Khu vực hoạt động *</label>
                <input type="text" id="address" name="address" required placeholder="Nhập địa chỉ..." value="<?php echo htmlspecialchars($gt['address']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="price">Giá vé / phí dịch vụ trung bình (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Nhập giá vé..." value="<?php echo htmlspecialchars($gt['price']); ?>">
            </div>
        </div>

        <div class="admin-form-group" style="display: flex; gap: 20px; align-items: center; border: 1px solid var(--border-color); padding: 15px; border-radius: 6px; background-color: var(--bg-light);">
            <div style="text-align: center;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">Ảnh hiện tại</label>
                <img src="../<?php echo htmlspecialchars($gt['image']); ?>" alt="Current Entertainment" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/entertainment1.png'">
            </div>
            
            <div style="flex-grow: 1;">
                <label for="image" style="font-weight: bold;">Thay đổi hình ảnh đại diện</label>
                <input type="file" id="image" name="image" style="border: 1px solid var(--border-color); padding: 8px; border-radius: 4px; background-color: var(--white); margin-top: 5px;">
                <div style="margin-top: 8px; font-size: 11px; color: var(--text-muted);">
                    Hỗ trợ các định dạng: JPG, JPEG, PNG, GIF. Nếu không tải tệp mới lên, hệ thống sẽ duy trì hình ảnh cũ.
                </div>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả chi tiết hoạt động giải trí</label>
            <textarea id="description" name="description" rows="6" placeholder="Nhập giới thiệu..." style="width: 100%; font-family: inherit; line-height: 1.5; resize: vertical;"><?php echo htmlspecialchars($gt['description']); ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Hoạt Động
            </button>
            <a href="index.php?act=listgt" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px; text-decoration: none;">
                Hủy &amp; Quay Lại
            </a>
        </div>
    </form>
</div>
