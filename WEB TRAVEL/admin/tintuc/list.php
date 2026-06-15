<div style="margin-bottom: 20px; text-align: right;">
    <a href="index.php?act=addtt" class="btn-add-new">
        <span>➕</span> Đăng Bài Viết Mới
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
                <th style="width: 80px;">Mã BV</th>
                <th style="width: 120px; text-align: center;">Hình ảnh</th>
                <th>Tiêu đề bài viết</th>
                <th style="width: 120px; text-align: center;">Ngày đăng</th>
                <th>Tóm tắt mô tả</th>
                <th style="width: 200px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_tintuc)) {
                echo '<tr><td colspan="6" style="text-align: center; color: var(--text-muted);">Không có bài viết nào trong cơ sở dữ liệu.</td></tr>';
            } else {
                foreach ($list_tintuc as $tt):
                    $suatt = "index.php?act=suatt&id=" . $tt['id'];
                    $xoatt = "index.php?act=xoatt&id=" . $tt['id'];
            ?>
                <tr>
                    <td><strong>#<?php echo $tt['id']; ?></strong></td>
                    <td style="text-align: center;">
                        <img src="../<?php echo htmlspecialchars($tt['image']); ?>" alt="News Thumbnail" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);" onerror="this.src='../https://placehold.co/100x60?text=News'">
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark); font-size: 14px; max-width: 250px; line-height: 1.4;"><?php echo htmlspecialchars($tt['title']); ?></td>
                    <td style="text-align: center; font-weight: 600; color: var(--text-muted); font-size: 13px;">
                        <?php echo htmlspecialchars($tt['date']); ?>
                    </td>
                    <td style="color: var(--text-muted); font-size: 13px; max-width: 400px; line-height: 1.5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?php echo htmlspecialchars($tt['description']); ?>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suatt; ?>" class="btn-action btn-edit" title="Sửa bài viết">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoatt; ?>" class="btn-action btn-delete" title="Xóa bài viết" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này khỏi hệ thống không?');">
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
