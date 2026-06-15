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

    <form action="index.php?act=adddv" method="POST">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="name">Tên dịch vụ *</label>
                <input type="text" id="name" name="name" required placeholder="Ví dụ: Đặt Vé Máy Bay, Thuê Xe Máy..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>

            <div class="admin-form-group">
                <label for="price">Đơn giá (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" step="1000" placeholder="Ví dụ: 500000" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="icon">Biểu tượng (Icon đại diện) *</label>
            <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                <input type="text" id="icon" name="icon" required placeholder="Nhập 1 emoji hoặc chọn bên dưới" style="max-width: 250px;" value="<?php echo isset($_POST['icon']) ? htmlspecialchars($_POST['icon']) : '💼'; ?>">
                <span style="font-size: 13px; color: var(--text-muted);">Biểu tượng hiển thị bên cạnh dịch vụ</span>
            </div>
            <!-- Quick Emoji list for web travel vibe -->
            <div class="quick-icons-list" style="display: flex; gap: 8px; flex-wrap: wrap; background-color: var(--bg-light); padding: 12px; border-radius: 6px; border: 1px dashed var(--border-color);">
                <?php 
                $quick_emojis = ['💼', '✈️', '🚗', '🎫', '🛡️', '🗣️', '🏨', '🏍️', '🚂', '🛳️', '🗺️', '📸', '🍽️', '⛺', '🎟️', '📞'];
                foreach ($quick_emojis as $emoji) {
                    echo '<span class="quick-emoji-item" style="font-size: 22px; cursor: pointer; padding: 4px 8px; border: 1px solid transparent; border-radius: 4px; transition: all 0.2s;" onclick="selectEmoji(\'' . $emoji . '\')">' . $emoji . '</span>';
                }
                ?>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả ngắn về dịch vụ</label>
            <textarea id="description" name="description" rows="5" placeholder="Giới thiệu khái quát các đặc điểm nổi bật và chính sách hỗ trợ của dịch vụ..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Thêm Mới Dịch Vụ
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listdv" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Dịch Vụ
            </a>
        </div>
    </form>
</div>

<script>
function selectEmoji(emoji) {
    document.getElementById('icon').value = emoji;
    // Highlight selected emoji
    document.querySelectorAll('.quick-emoji-item').forEach(el => {
        el.style.backgroundColor = 'transparent';
        el.style.borderColor = 'transparent';
    });
    event.currentTarget.style.backgroundColor = 'var(--border-color)';
    event.currentTarget.style.borderColor = 'var(--primary-color)';
}
</script>
