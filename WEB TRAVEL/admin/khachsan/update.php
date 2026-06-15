<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updateks" method="POST" enctype="multipart/form-data">
        <!-- Mã khách sạn ẩn -->
        <input type="hidden" name="id" value="<?php echo $ks['id']; ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($ks['image']); ?>">

        <div style="display: grid; grid-template-columns: 80px 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="id_view">Mã KS</label>
                <input type="text" id="id_view" disabled value="#<?php echo $ks['id']; ?>" style="background-color: var(--border-color); cursor: not-allowed; text-align: center; font-weight: bold;">
            </div>

            <div class="admin-form-group">
                <label for="name">Tên khách sạn / resort *</label>
                <input type="text" id="name" name="name" required placeholder="Nhập tên khách sạn..." value="<?php echo htmlspecialchars($ks['name']); ?>">
            </div>
            
            <div class="admin-form-group">
                <label for="stars">Xếp hạng sao *</label>
                <select id="stars" name="stars" required>
                    <option value="5" <?php echo ($ks['stars'] == 5) ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 Sao)</option>
                    <option value="4" <?php echo ($ks['stars'] == 4) ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 Sao)</option>
                    <option value="3" <?php echo ($ks['stars'] == 3) ? 'selected' : ''; ?>>⭐⭐⭐ (3 Sao)</option>
                    <option value="2" <?php echo ($ks['stars'] == 2) ? 'selected' : ''; ?>>⭐⭐ (2 Sao)</option>
                    <option value="1" <?php echo ($ks['stars'] == 1) ? 'selected' : ''; ?>>⭐ (1 Sao)</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="address">Địa chỉ chi tiết *</label>
            <input type="text" id="address" name="address" required placeholder="Nhập địa chỉ..." value="<?php echo htmlspecialchars($ks['address']); ?>">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="location">Tỉnh / Thành phố *</label>
                <input type="text" id="location" name="location" required placeholder="Ví dụ: Nha Trang..." value="<?php echo htmlspecialchars($ks['location']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="region">Vùng miền *</label>
                <select id="region" name="region" required>
                    <option value="Miền Bắc" <?php echo ($ks['region'] == 'Miền Bắc') ? 'selected' : ''; ?>>Miền Bắc</option>
                    <option value="Miền Trung" <?php echo ($ks['region'] == 'Miền Trung') ? 'selected' : ''; ?>>Miền Trung</option>
                    <option value="Miền Nam" <?php echo ($ks['region'] == 'Miền Nam') ? 'selected' : ''; ?>>Miền Nam</option>
                    <option value="Nước Ngoài" <?php echo ($ks['region'] == 'Nước Ngoài') ? 'selected' : ''; ?>>Nước Ngoài</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label for="category">Loại hình lưu trú *</label>
                <select id="category" name="category" required>
                    <option value="Khách sạn" <?php echo ($ks['category'] == 'Khách sạn') ? 'selected' : ''; ?>>Khách sạn</option>
                    <option value="Resort" <?php echo ($ks['category'] == 'Resort') ? 'selected' : ''; ?>>Resort</option>
                    <option value="Villa" <?php echo ($ks['category'] == 'Villa') ? 'selected' : ''; ?>>Villa</option>
                    <option value="Homestay" <?php echo ($ks['category'] == 'Homestay') ? 'selected' : ''; ?>>Homestay</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="price">Giá phòng gốc / đêm (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Nhập giá phòng..." value="<?php echo htmlspecialchars($ks['price']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="price_sale">Giá phòng khuyến mãi / đêm (VNĐ)</label>
                <input type="number" id="price_sale" name="price_sale" min="0" placeholder="Nhập giá khuyến mãi..." value="<?php echo htmlspecialchars($ks['price_sale']); ?>">
            </div>
        </div>

        <div class="admin-form-group" style="display: flex; gap: 20px; align-items: center; border: 1px solid var(--border-color); padding: 15px; border-radius: 6px; background-color: var(--bg-light);">
            <div style="text-align: center;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">Ảnh hiện tại</label>
                <img src="../<?php echo htmlspecialchars($ks['image']); ?>" alt="Current Hotel" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/hotel1.jpg'">
            </div>
            
            <div style="flex-grow: 1;">
                <label for="image" style="font-weight: bold;">Thay đổi hình ảnh khách sạn</label>
                <input type="file" id="image" name="image" style="border: 1px solid var(--border-color); padding: 8px; border-radius: 4px; background-color: var(--white); margin-top: 5px;">
                <div style="margin-top: 8px; font-size: 11px; color: var(--text-muted);">
                    Hỗ trợ các định dạng: JPG, JPEG, PNG, GIF. Nếu không tải tệp mới lên, hệ thống sẽ duy trì hình ảnh cũ.
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Khách Sạn
            </button>
            <a href="index.php?act=listks" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy &amp; Quay Lại
            </a>
        </div>
    </form>
</div>
