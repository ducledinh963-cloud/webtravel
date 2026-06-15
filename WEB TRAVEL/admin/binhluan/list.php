<?php if (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">MÃ BL</th>
                <th style="width: 150px;">NGƯỜI GỬI</th>
                <th>NỘI DUNG BÌNH LUẬN</th>
                <th style="width: 350px;">SẢN PHẨM (TOUR)</th>
                <th style="width: 150px;">THỜI GIAN</th>
                <th style="width: 100px; text-align: center;">THAO TÁC</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_binhluan)) {
                echo '<tr><td colspan="6" style="text-align: center; color: var(--text-muted);">Không có bình luận nào trên hệ thống.</td></tr>';
            } else {
                foreach ($list_binhluan as $bl):
                    $xoabl = "index.php?act=xoabl&id=" . $bl['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $bl['id']; ?></strong></td>
                    <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($bl['username']); ?></td>
                    <td style="line-height: 1.5; color: #334155; font-size: 13px; max-width: 300px; word-wrap: break-word;"><?php echo htmlspecialchars($bl['content']); ?></td>
                    <td style="font-size: 13px;"><a href="../index.php?act=sanphamct&id=<?php echo $bl['id_pro']; ?>" target="_blank" style="color: var(--primary-color); font-weight: 600; text-decoration: none;"><?php echo htmlspecialchars($bl['ten_sanpham']); ?></a></td>
                    <td style="font-size: 13px; color: #475569;"><?php echo htmlspecialchars($bl['date']); ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo $xoabl; ?>" class="btn-action btn-delete" title="Xóa bình luận" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');" style="padding: 6px 12px; font-size: 12px; text-decoration: none;">
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
