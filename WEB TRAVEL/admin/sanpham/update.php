<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatesp" method="POST" enctype="multipart/form-data">
        <!-- ID ẩn -->
        <input type="hidden" name="id" value="<?php echo $sp['id']; ?>">

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="id_danhmuc">Khu vực / Danh mục tour *</label>
                <select id="id_danhmuc" name="id_danhmuc" required>
                    <option value="">-- Chọn danh mục tour --</option>
                    <?php foreach ($list_danhmuc as $dm): ?>
                        <option value="<?php echo $dm['id']; ?>" <?php echo ($sp['id_danhmuc'] == $dm['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($dm['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="admin-form-group">
                <label for="name">Tên tour du lịch *</label>
                <input type="text" id="name" name="name" required placeholder="Nhập tên tour..." value="<?php echo htmlspecialchars($sp['name']); ?>">
            </div>
        </div>

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="price">Giá niêm yết (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Ví dụ: 3500000" value="<?php echo htmlspecialchars($sp['price']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="price_sale">Giá khuyến mãi (VNĐ)</label>
                <input type="number" id="price_sale" name="price_sale" min="0" placeholder="Ví dụ: 2990000" value="<?php echo htmlspecialchars($sp['price_sale']); ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label>Hình ảnh hiện tại</label>
            <div style="margin: 10px 0;">
                <img src="<?php echo htmlspecialchars(strpos($sp['image'], 'http') === 0 ? $sp['image'] : '../' . $sp['image']); ?>" alt="Current image" style="max-height: 150px; border-radius: 8px; border: 1px solid var(--border-color);" onerror="this.src='https://placehold.co/150x100?text=Tour'">
            </div>
            
            <label for="image">Thay đổi hình ảnh mới (Bỏ trống nếu giữ nguyên ảnh cũ)</label>
            <input type="file" id="image" name="image" accept="image/*">
            <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">Hỗ trợ định dạng: JPG, JPEG, PNG, WEBP. Dung lượng nhỏ hơn 2MB.</p>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả lịch trình &amp; Dịch vụ tour *</label>
            <textarea id="description" name="description" rows="8" required placeholder="Chi tiết lịch trình tour..."><?php echo htmlspecialchars($sp['description']); ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Tour
            </button>
            <a href="index.php?act=listsp" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy &amp; Quay Lại
            </a>
        </div>
    </form>
</div>
