<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=addgt" class="btn-add-new">
        <span>➕</span> Thêm Hoạt Động Mới
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
                <th>Tên hoạt động / Khu vui chơi</th>
                <th>Địa chỉ / Khu vực</th>
                <th style="width: 140px;">Giá vé trung bình</th>
                <th style="width: 120px; text-align: center;">Đánh giá</th>
                <th style="width: 90px; text-align: center;">Lượt xem</th>
                <th style="width: 160px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_giaitri)) {
                echo '<tr><td colspan="8" style="text-align: center; color: var(--text-muted);">Không có dữ liệu khu vui chơi / giải trí nào.</td></tr>';
            } else {
                foreach ($list_giaitri as $gt):
                    $suagt = "index.php?act=suagt&id=" . $gt['id'];
                    $xoagt = "index.php?act=xoagt&id=" . $gt['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $gt['id']; ?></strong></td>
                    <td style="text-align: center;">
                        <img src="../<?php echo htmlspecialchars($gt['image']); ?>" alt="Entertainment" style="width: 80px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/entertainment1.png'">
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark); font-size: 14px;"><?php echo htmlspecialchars($gt['name']); ?></td>
                    <td style="color: var(--text-muted); font-size: 13px;">📍 <?php echo htmlspecialchars($gt['address']); ?></td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary-color); font-size: 14px;">
                            <?php echo number_format($gt['price'], 0, ',', '.') . ' đ'; ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div style="color: #facc15; font-size: 13px;">
                            <?php 
                            $stars = round($gt['rating']);
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
                        <?php echo $gt['views']; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suagt; ?>" class="btn-action btn-edit" title="Sửa thông tin" style="margin-bottom: 5px; display: inline-block; text-decoration: none;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoagt; ?>" class="btn-action btn-delete" title="Xóa hoạt động" onclick="return confirm('Bạn có chắc chắn muốn xóa hoạt động giải trí này không?');" style="display: inline-block; text-decoration: none;">
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
