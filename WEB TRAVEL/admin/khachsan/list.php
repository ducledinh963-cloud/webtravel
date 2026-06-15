<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=addks" class="btn-add-new">
        <span>➕</span> Thêm Khách Sạn Mới
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
                <th style="width: 70px;">Mã</th>
                <th style="width: 100px;">Ảnh đại diện</th>
                <th>Khách sạn / Địa chỉ</th>
                <th style="width: 150px; text-align: center;">Sao &amp; Loại</th>
                <th style="width: 130px;">Khu vực</th>
                <th style="width: 160px;">Giá phòng / đêm</th>
                <th style="width: 90px; text-align: center;">Lượt xem</th>
                <th style="width: 160px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_khachsan)) {
                echo '<tr><td colspan="8" style="text-align: center; color: var(--text-muted);">Không có khách sạn nào trong cơ sở dữ liệu.</td></tr>';
            } else {
                foreach ($list_khachsan as $ks):
                    $suaks = "index.php?act=suaks&id=" . $ks['id'];
                    $xoaks = "index.php?act=xoaks&id=" . $ks['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $ks['id']; ?></strong></td>
                    <td>
                        <img src="../<?php echo htmlspecialchars($ks['image']); ?>" alt="Hotel" style="width: 80px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/hotel1.jpg'">
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark); font-size: 14px;"><?php echo htmlspecialchars($ks['name']); ?></div>
                        <div style="color: var(--text-muted); font-size: 12px; margin-top: 4px;">📍 <?php echo htmlspecialchars($ks['address']); ?></div>
                    </td>
                    <td style="text-align: center;">
                        <!-- Hiển thị sao bằng emoji -->
                        <div style="color: #facc15; font-size: 13px;">
                            <?php 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $ks['stars']) {
                                    echo '★';
                                } else {
                                    echo '☆';
                                }
                            }
                            ?>
                        </div>
                        <span class="badge" style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-size: 11px; margin-top: 5px; display: inline-block; padding: 2px 6px; border-radius: 4px;">
                            <?php echo htmlspecialchars($ks['category']); ?>
                        </span>
                    </td>
                    <td>
                        <span style="font-weight: 600; font-size: 13px; color: var(--text-dark);"><?php echo htmlspecialchars($ks['location']); ?></span>
                        <div style="font-size: 11px; color: var(--text-muted); margin-top: 2px;"><?php echo htmlspecialchars($ks['region']); ?></div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary-color); font-size: 14px;">
                            <?php echo number_format($ks['price_sale'], 0, ',', '.') . ' đ'; ?>
                        </div>
                        <?php if ($ks['price'] > 0 && $ks['price'] > $ks['price_sale']): ?>
                            <div style="text-decoration: line-through; color: var(--text-muted); font-size: 11px; margin-top: 2px;">
                                <?php echo number_format($ks['price'], 0, ',', '.') . ' đ'; ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center; color: var(--text-muted); font-weight: bold;">
                        <?php echo $ks['views']; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suaks; ?>" class="btn-action btn-edit" title="Sửa khách sạn" style="margin-bottom: 5px; display: inline-block;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoaks; ?>" class="btn-action btn-delete" title="Xóa khách sạn" onclick="return confirm('Bạn có chắc chắn muốn xóa khách sạn này khỏi hệ thống không?');" style="display: inline-block;">
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
