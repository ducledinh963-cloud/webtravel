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

    <form action="index.php?act=addks" method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="name">Tên khách sạn / resort *</label>
                <input type="text" id="name" name="name" required placeholder="Ví dụ: Khách sạn Silk Path Grand Resort Sapa..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            
            <div class="admin-form-group">
                <label for="stars">Xếp hạng sao *</label>
                <select id="stars" name="stars" required>
                    <option value="5" <?php echo (isset($_POST['stars']) && $_POST['stars'] == 5) ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 Sao)</option>
                    <option value="4" <?php echo (!isset($_POST['stars']) || $_POST['stars'] == 4) ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 Sao)</option>
                    <option value="3" <?php echo (isset($_POST['stars']) && $_POST['stars'] == 3) ? 'selected' : ''; ?>>⭐⭐⭐ (3 Sao)</option>
                    <option value="2" <?php echo (isset($_POST['stars']) && $_POST['stars'] == 2) ? 'selected' : ''; ?>>⭐⭐ (2 Sao)</option>
                    <option value="1" <?php echo (isset($_POST['stars']) && $_POST['stars'] == 1) ? 'selected' : ''; ?>>⭐ (1 Sao)</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="address">Địa chỉ chi tiết *</label>
            <input type="text" id="address" name="address" required placeholder="Ví dụ: Đồi Quan Phạn, Thị xã Sapa, Lào Cai..." value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="location">Tỉnh / Thành phố *</label>
                <input type="text" id="location" name="location" required placeholder="Ví dụ: Sapa, Nha Trang, Phú Quốc..." value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="region">Vùng miền *</label>
                <select id="region" name="region" required>
                    <option value="Miền Bắc" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Miền Bắc') ? 'selected' : ''; ?>>Miền Bắc</option>
                    <option value="Miền Trung" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Miền Trung') ? 'selected' : ''; ?>>Miền Trung</option>
                    <option value="Miền Nam" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Miền Nam') ? 'selected' : ''; ?>>Miền Nam</option>
                    <option value="Nước Ngoài" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Nước Ngoài') ? 'selected' : ''; ?>>Nước Ngoài</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label for="category">Loại hình lưu trú *</label>
                <select id="category" name="category" required>
                    <option value="Khách sạn" <?php echo (!isset($_POST['category']) || $_POST['category'] == 'Khách sạn') ? 'selected' : ''; ?>>Khách sạn</option>
                    <option value="Resort" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Resort') ? 'selected' : ''; ?>>Resort</option>
                    <option value="Villa" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Villa') ? 'selected' : ''; ?>>Villa</option>
                    <option value="Homestay" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Homestay') ? 'selected' : ''; ?>>Homestay</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="price">Giá phòng gốc / đêm (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Ví dụ: 2500000" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="price_sale">Giá phòng khuyến mãi / đêm (VNĐ)</label>
                <input type="number" id="price_sale" name="price_sale" min="0" placeholder="Ví dụ: 1950000" value="<?php echo isset($_POST['price_sale']) ? htmlspecialchars($_POST['price_sale']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="image">Hình ảnh khách sạn đại diện</label>
            <input type="file" id="image" name="image" style="border: 1px solid var(--border-color); padding: 8px; border-radius: 4px; background-color: var(--white);">
            <div style="margin-top: 8px; font-size: 12px; color: var(--text-muted);">
                Nếu không chọn tệp, hệ thống sẽ sử dụng hình ảnh khách sạn mẫu mặc định (`uploads/hotel1.jpg`).
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Thêm Mới Khách Sạn
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listks" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Khách Sạn
            </a>
        </div>
    </form>
</div>
