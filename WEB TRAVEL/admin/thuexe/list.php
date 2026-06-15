<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=addtx" class="btn-add-new">
        <span>➕</span> Thêm Xe Thuê Mới
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
                <th>Tên phương tiện / Loại xe</th>
                <th>Khu vực nhận xe</th>
                <th style="width: 160px;">Giá thuê (ngày)</th>
                <th style="width: 120px; text-align: center;">Đánh giá</th>
                <th style="width: 90px; text-align: center;">Lượt xem</th>
                <th style="width: 160px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_cars)) {
                echo '<tr><td colspan="8" style="text-align: center; color: var(--text-muted);">Không có dữ liệu phương tiện xe thuê nào.</td></tr>';
            } else {
                foreach ($list_cars as $car):
                    $suatx = "index.php?act=suatx&id=" . $car['id'];
                    $xoatx = "index.php?act=xoatx&id=" . $car['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $car['id']; ?></strong></td>
                    <td style="text-align: center;">
                        <img src="../<?php echo htmlspecialchars($car['image']); ?>" alt="Car Rental" style="width: 80px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/car1.png'">
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark); font-size: 14px;"><?php echo htmlspecialchars($car['name']); ?></td>
                    <td style="color: var(--text-muted); font-size: 13px;">📍 <?php echo htmlspecialchars($car['address']); ?></td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary-color); font-size: 14px;">
                            <?php echo number_format($car['price'], 0, ',', '.') . ' đ'; ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div style="color: #facc15; font-size: 13px;">
                            <?php 
                            $stars = round($car['rating']);
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
                        <?php echo $car['views']; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suatx; ?>" class="btn-action btn-edit" title="Sửa thông tin" style="margin-bottom: 5px; display: inline-block; text-decoration: none;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoatx; ?>" class="btn-action btn-delete" title="Xóa xe" onclick="return confirm('Bạn có chắc chắn muốn xóa phương tiện xe thuê này không?');" style="display: inline-block; text-decoration: none;">
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
