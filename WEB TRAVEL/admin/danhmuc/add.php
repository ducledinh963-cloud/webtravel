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

    <form action="index.php?act=adddm" method="POST">
        <div class="admin-form-group" style="max-width: 500px;">
            <label for="name">Tên danh mục tour *</label>
            <input type="text" id="name" name="name" required placeholder="Nhập tên danh mục tour mới (Ví dụ: Tour Thám Hiểm)..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>

        <div class="admin-form-actions">
            <button type="submit" name="themmoi" class="btn-add-new" style="border: none; cursor: pointer;">
                Thêm Mới Danh Mục
            </button>
            <button type="reset" class="btn-action btn-reset" style="padding: 10px 20px; font-size: 13px;">
                Nhập Lại Form
            </button>
            <a href="index.php?act=listdm" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px;">
                Danh Sách Danh Mục
            </a>
        </div>
    </form>
</div>
