<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatedv" method="POST">
        <!-- ID dịch vụ ẩn -->
        <input type="hidden" name="id" value="<?php echo $dv['id']; ?>">

        <div style="display: grid; grid-template-columns: 80px 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="id_view">Mã DV</label>
                <input type="text" id="id_view" disabled value="#<?php echo $dv['id']; ?>" style="background-color: var(--border-color); cursor: not-allowed; text-align: center; font-weight: bold;">
            </div>

            <div class="admin-form-group">
                <label for="name">Tên dịch vụ *</label>
                <input type="text" id="name" name="name" required placeholder="Nhập tên dịch vụ..." value="<?php echo htmlspecialchars($dv['name']); ?>">
            </div>

            <div class="admin-form-group">
                <label for="price">Đơn giá (VNĐ) *</label>
                <input type="number" id="price" name="price" required min="0" step="1000" placeholder="Nhập đơn giá..." value="<?php echo htmlspecialchars($dv['price']); ?>">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="icon">Biểu tượng (Icon đại diện) *</label>
            <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
                <input type="text" id="icon" name="icon" required placeholder="Nhập 1 emoji hoặc chọn bên dưới" style="max-width: 250px;" value="<?php echo htmlspecialchars($dv['icon']); ?>">
                <span style="font-size: 13px; color: var(--text-muted);">Biểu tượng hiển thị bên cạnh dịch vụ</span>
            </div>
            <!-- Quick Emoji list for web travel vibe -->
            <div class="quick-icons-list" style="display: flex; gap: 8px; flex-wrap: wrap; background-color: var(--bg-light); padding: 12px; border-radius: 6px; border: 1px dashed var(--border-color);">
                <?php 
                $quick_emojis = ['💼', '✈️', '🚗', '🎫', '🛡️', '🗣️', '🏨', '🏍️', '🚂', '🛳️', '🗺️', '📸', '🍽️', '⛺', '🎟️', '📞'];
                foreach ($quick_emojis as $emoji) {
                    $isSelected = ($emoji === $dv['icon']) ? 'background-color: var(--border-color); border-color: var(--primary-color);' : '';
                    echo '<span class="quick-emoji-item" style="font-size: 22px; cursor: pointer; padding: 4px 8px; border: 1px solid transparent; border-radius: 4px; transition: all 0.2s; ' . $isSelected . '" onclick="selectEmoji(\'' . $emoji . '\')">' . $emoji . '</span>';
                }
                ?>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="description">Mô tả ngắn về dịch vụ</label>
            <textarea id="description" name="description" rows="5" placeholder="Giới thiệu khái quát các đặc điểm nổi bật và chính sách hỗ trợ của dịch vụ..."><?php echo htmlspecialchars($dv['description']); ?></textarea>
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Dịch Vụ
            </button>
            <a href="index.php?act=listdv" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy &amp; Quay Lại
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
