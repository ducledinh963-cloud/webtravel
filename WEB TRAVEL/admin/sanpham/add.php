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

    <form action="index.php?act=addsp" method="POST" enctype="multipart/form-data">
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="id_danhmuc">Khu vực / Danh mục tour *</label>
                <select id="id_danhmuc" name="id_danhmuc" required>
                    <option value="">-- Chọn danh mục tour --</option>
                    <?php foreach ($list_danhmuc as $dm): ?>
                        <option value="<?php echo $dm['id']; ?>" <?php echo (isset($_POST['id_danhmuc']) && $_POST['id_danhmuc'] == $dm['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($dm['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="admin-form-group">
                <label for="name">Tên tour du lịch *</label>
                <input type="text" id="name" name="name" required placeholder="Nhập tên tour du lịch..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="price">Giá niêm yết (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" placeholder="Ví dụ: 3500000" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="price_sale">Giá khuyến mãi (VNĐ) - Nhập 0 nếu không giảm</label>
                <input type="number" id="price_sale" name="price_sale" min="0" placeholder="Ví dụ: 2990000" value="<?php echo isset($_POST['price_sale']) ? htmlspecialchars($_POST['price_sale']) : '0'; ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="image">Hình ảnh đại diện cho Tour *</label>
            <input type="file" id="image" name="image" required accept="image/*">
            <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">Hỗ trợ định dạng: JPG, JPEG, PNG, WEBP. Dung lượng nhỏ hơn 2MB.</p>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả lịch trình &amp; Dịch vụ tour *</label>
            <textarea id="description" name="description" rows="8" required placeholder="Chi tiết lịch trình tour theo từng ngày, khách sạn lưu trú, món ăn, dịch vụ đi kèm..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Đăng Tải Tour Mới
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listsp" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Tour
            </a>
        </div>
    </form>
</div>
