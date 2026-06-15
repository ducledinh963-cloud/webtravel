<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=adddv" class="btn-add-new">
        <span>➕</span> Thêm Dịch Vụ Mới
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
                <th style="width: 80px;">Mã DV</th>
                <th style="width: 100px; text-align: center;">Biểu tượng</th>
                <th>Tên dịch vụ</th>
                <th style="width: 180px;">Đơn giá</th>
                <th>Mô tả dịch vụ</th>
                <th style="width: 200px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_dichvu)) {
                echo '<tr><td colspan="6" style="text-align: center; color: var(--text-muted);">Không có dịch vụ nào trong cơ sở dữ liệu.</td></tr>';
            } else {
                foreach ($list_dichvu as $dv):
                    $suadv = "index.php?act=suadv&id=" . $dv['id'];
                    $xoadv = "index.php?act=xoadv&id=" . $dv['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $dv['id']; ?></strong></td>
                    <td style="text-align: center; font-size: 24px;"><?php echo htmlspecialchars($dv['icon']); ?></td>
                    <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($dv['name']); ?></td>
                    <td style="font-weight: 600; color: var(--primary-color);">
                        <?php echo number_format($dv['price'], 0, ',', '.') . ' VNĐ'; ?>
                    </td>
                    <td style="color: var(--text-muted); font-size: 13px; max-width: 400px; line-height: 1.5;">
                        <?php echo htmlspecialchars($dv['description']); ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suadv; ?>" class="btn-action btn-edit" title="Sửa dịch vụ">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoadv; ?>" class="btn-action btn-delete" title="Xóa dịch vụ" onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này khỏi hệ thống không?');">
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
