<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=adddm" class="btn-add-new">
        <span>➕</span> Thêm Danh Mục Mới
    </a>
</div>

<?php if (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">Mã loại</th>
                <th>Tên danh mục tour</th>
                <th style="width: 200px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_danhmuc)) {
                echo '<tr><td colspan="3" style="text-align: center; color: var(--text-muted);">Không có danh mục nào trong cơ sở dữ liệu.</td></tr>';
            } else {
                foreach ($list_danhmuc as $dm):
                    $suadm = "index.php?act=suadm&id=" . $dm['id'];
                    $xoadm = "index.php?act=xoadm&id=" . $dm['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $dm['id']; ?></strong></td>
                    <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($dm['name']); ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suadm; ?>" class="btn-action btn-edit" title="Sửa danh mục">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoadm; ?>" class="btn-action btn-delete" title="Xóa danh mục" onclick="return confirm('CẢNH BÁO: Việc xóa danh mục này sẽ xóa toàn bộ các sản phẩm/tour thuộc danh mục! Bạn có chắc chắn muốn xóa không?');">
                            <span>🗑️</span> Xóa
                        </a>
                    </td>
                </tr>
            <?php 
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>
