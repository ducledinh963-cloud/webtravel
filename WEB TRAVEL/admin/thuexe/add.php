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

    <form action="index.php?act=addtx" method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="name">Tên phương tiện / Loại xe *</label>
                <input type="text" id="name" name="name" required placeholder="Ví dụ: Toyota Vios 2022 (Tự lái)..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            
            <div class="admin-form-group">
                <label for="rating">Xếp hạng đánh giá *</label>
                <select id="rating" name="rating" required>
                    <option value="5" <?php echo (isset($_POST['rating']) && $_POST['rating'] == 5) ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 Điểm)</option>
                    <option value="4" <?php echo (!isset($_POST['rating']) || $_POST['rating'] == 4) ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 Điểm)</option>
                    <option value="3" <?php echo (isset($_POST['rating']) && $_POST['rating'] == 3) ? 'selected' : ''; ?>>⭐⭐⭐ (3 Điểm)</option>
                    <option value="2" <?php echo (isset($_POST['rating']) && $_POST['rating'] == 2) ? 'selected' : ''; ?>>⭐⭐ (2 Điểm)</option>
                    <option value="1" <?php echo (isset($_POST['rating']) && $_POST['rating'] == 1) ? 'selected' : ''; ?>>⭐ (1 Điểm)</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="address">Địa chỉ / Khu vực nhận xe *</label>
                <input type="text" id="address" name="address" required placeholder="Ví dụ: Quận Hải Châu, Đà Nẵng..." value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="price">Giá thuê xe theo ngày (VNĐ/ngày) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Ví dụ: 800000" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="image">Hình ảnh xe thuê</label>
            <input type="file" id="image" name="image" style="border: 1px solid var(--border-color); padding: 8px; border-radius: 4px; background-color: var(--white);">
            <div style="margin-top: 8px; font-size: 12px; color: var(--text-muted);">
                Nếu không chọn tệp, hệ thống sẽ sử dụng hình ảnh mặc định (`uploads/car1.png`).
            </div>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả tiện nghi & thông số kỹ thuật xe</label>
            <textarea id="description" name="description" rows="6" placeholder="Nhập chi tiết thông tin xe (Ví dụ: số tự động/số sàn, số ghế, mức tiêu thụ xăng, điều hòa, bảo hiểm đi kèm...)" style="width: 100%; font-family: inherit; line-height: 1.5; resize: vertical;"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Thêm Mới Xe
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listtx" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px; text-decoration: none;">
                Danh Sách Xe
            </a>
        </div>
    </form>
</div>
