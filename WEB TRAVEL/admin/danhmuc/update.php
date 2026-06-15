<div class="admin-form-container">
    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatedm" method="POST">
        <!-- Mã loại ẩn -->
        <input type="hidden" name="id" value="<?php echo $dm['id']; ?>">

        <div class="admin-form-group" style="max-width: 500px;">
            <label for="id_view">Mã danh mục</label>
            <input type="text" id="id_view" disabled value="#<?php echo $dm['id']; ?>" style="background-color: var(--border-color); cursor: not-allowed;">
        </div>

        <div class="admin-form-group" style="max-width: 500px;">
            <label for="name">Tên danh mục tour *</label>
            <input type="text" id="name" name="name" required placeholder="Nhập tên danh mục tour..." value="<?php echo htmlspecialchars($dm['name']); ?>">
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="capnhat" class="btn-add-new" style="border: none; cursor: pointer; background-color: #0ea5e9; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);">
                Cập Nhật Danh Mục
            </button>
            <a href="index.php?act=listdm" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Hủy &amp; Quay Lại
            </a>
        </div>
    </form>
</div>
