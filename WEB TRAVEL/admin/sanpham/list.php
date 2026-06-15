<!-- Filter Bar with Search and Category Filter -->
<div class="admin-filter-bar">
    <form action="index.php" method="GET" class="admin-filter-form">
        <input type="hidden" name="act" value="listsp">
        
        <input type="text" name="keyword" class="admin-filter-input" placeholder="Tìm tên tour du lịch..." value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
        
        <select name="id_danhmuc" class="admin-filter-select">
            <option value="">-- Tất cả danh mục --</option>
            <?php foreach ($list_danhmuc as $dm): ?>
                <option value="<?php echo $dm['id']; ?>" <?php echo (isset($id_danhmuc) && $id_danhmuc == $dm['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($dm['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit" class="btn-action" style="background-color: var(--text-dark); padding: 8px 15px; font-size: 13px;">Lọc / Tìm Kiếm</button>
        <?php if ((isset($keyword) && $keyword != '') || (isset($id_danhmuc) && $id_danhmuc != '')): ?>
            <a href="index.php?act=listsp" style="font-size: 12px; color: var(--secondary-color);">Xóa lọc</a>
        <?php endif; ?>
    </form>

    <a href="index.php?act=addsp" class="btn-add-new">
        <span>➕</span> Thêm Tour Mới
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
                <th style="width: 80px;">Hình ảnh</th>
                <th>Tên tour du lịch</th>
                <th style="width: 140px;">Giá niêm yết</th>
                <th style="width: 140px;">Giá khuyến mãi</th>
                <th style="width: 130px;">Danh mục</th>
                <th style="width: 80px; text-align: center;">Lượt xem</th>
                <th style="width: 180px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_sanpham)) {
                echo '<tr><td colspan="8" style="text-align: center; color: var(--text-muted);">Không tìm thấy tour du lịch nào.</td></tr>';
            } else {
                foreach ($list_sanpham as $sp):
                    $suasp = "index.php?act=suasp&id=" . $sp['id'];
                    $xoasp = "index.php?act=xoasp&id=" . $sp['id'];
                    
                    // Lấy tên danh mục tương ứng
                    $ten_dm = 'Không xác định';
                    foreach ($list_danhmuc as $dm) {
                        if ($dm['id'] == $sp['id_danhmuc']) {
                            $ten_dm = $dm['name'];
                            break;
                        }
                    }
            ?>
                <tr>
                    <td><strong>#<?php echo $sp['id']; ?></strong></td>
                    <td>
                        <img src="<?php echo htmlspecialchars(strpos($sp['image'], 'http') === 0 ? $sp['image'] : '../' . $sp['image']); ?>" alt="Tour thumbnail" class="admin-thumbnail" onerror="this.src='https://placehold.co/120x80?text=Tour'">
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark); line-height: 1.4;">
                        <?php echo htmlspecialchars($sp['name']); ?>
                    </td>
                    <td>
                        <span style="font-weight: 600;"><?php echo number_format($sp['price']); ?> VNĐ</span>
                    </td>
                    <td>
                        <?php if (isset($sp['price_sale']) && $sp['price_sale'] > 0): ?>
                            <span style="font-weight: 700; color: var(--secondary-color);"><?php echo number_format($sp['price_sale']); ?> VNĐ</span>
                        <?php else: ?>
                            <span style="color: var(--text-muted); font-style: italic;">Không giảm</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="tour-category" style="font-size: 11px;"><?php echo htmlspecialchars($ten_dm); ?></span>
                    </td>
                    <td style="text-align: center; font-weight: 600;">
                        <?php echo $sp['views']; ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suasp; ?>" class="btn-action btn-edit" title="Sửa tour">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoasp; ?>" class="btn-action btn-delete" title="Xóa tour" onclick="return confirm('Bạn có chắc chắn muốn xóa tour du lịch này? Thao tác không thể hoàn tác!');">
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
