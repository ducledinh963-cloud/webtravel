<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=addnh" class="btn-add-new">
        <span>➕</span> Thêm Món Ngon Mới
    </a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
<?php elseif (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 70px;">MÃ</th>
                <th style="width: 100px; text-align: center;">Ảnh đại diện</th>
                <th>Tên món / Nhà hàng</th>
                <th>Địa chỉ / Khu vực</th>
                <th style="width: 140px;">Giá cả</th>
                <th style="width: 120px; text-align: center;">Đánh giá</th>
                <th style="width: 90px; text-align: center;">Lượt xem</th>
                <th style="width: 160px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_nhahang)) {
                echo '<tr><td colspan="8" style="text-align: center; color: var(--text-muted);">Không có dữ liệu nhà hàng / món ngon nào.</td></tr>';
            } else {
                foreach ($list_nhahang as $nh):
                    $suanh = "index.php?act=suanh&id=" . $nh['id'];
                    $xoanh = "index.php?act=xoanh&id=" . $nh['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $nh['id']; ?></strong></td>
                    <td style="text-align: center;">
                        <img src="../<?php echo htmlspecialchars($nh['image']); ?>" alt="Seafood" style="width: 80px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/seafood1.png'">
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark); font-size: 14px;"><?php echo htmlspecialchars($nh['name']); ?></td>
                    <td style="color: var(--text-muted); font-size: 13px;">📍 <?php echo htmlspecialchars($nh['address']); ?></td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary-color); font-size: 14px;">
                            <?php echo number_format($nh['price'], 0, ',', '.') . ' đ'; ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div style="color: #facc15; font-size: 13px;">
                            <?php 
                            $stars = round($nh['rating']);
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $stars) {
                                    echo '★';
                                } else {
                                    echo '☆';
                                }
                            }
                            ?>
                        </div>
                    </td>
                    <td style="text-align: center; color: var(--text-muted); font-weight: bold;">
                        <?php echo $nh['views']; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suanh; ?>" class="btn-action btn-edit" title="Sửa thông tin" style="margin-bottom: 5px; display: inline-block; text-decoration: none;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoanh; ?>" class="btn-action btn-delete" title="Xóa món ngon" onclick="return confirm('Bạn có chắc chắn muốn xóa đặc sản này không?');" style="display: inline-block; text-decoration: none;">
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
