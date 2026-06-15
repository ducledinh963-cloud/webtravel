<div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
    <!-- Form tìm kiếm & lọc -->
    <form action="index.php" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <input type="hidden" name="act" value="listtk">
        
        <input type="text" name="keyword" placeholder="Nhập tên, email hoặc SĐT..." 
               value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>"
               style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; width: 220px; outline: none; font-size: 13px;">
               
        <select name="role" style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; font-size: 13px; cursor: pointer;">
            <option value="all" <?php echo (isset($_GET['role']) && $_GET['role'] === 'all') ? 'selected' : ''; ?>>Tất cả vai trò</option>
            <option value="1" <?php echo (isset($_GET['role']) && $_GET['role'] === '1') ? 'selected' : ''; ?>>Chỉ Admin (Quản trị)</option>
            <option value="2" <?php echo (isset($_GET['role']) && $_GET['role'] === '2') ? 'selected' : ''; ?>>Chỉ Nhân viên</option>
            <option value="0" <?php echo (isset($_GET['role']) && $_GET['role'] === '0') ? 'selected' : ''; ?>>Chỉ Khách hàng</option>
        </select>
        
        <button type="submit" class="btn-action" style="background-color: var(--primary-color); border: none; padding: 8px 15px; font-size: 13px; font-weight: 700; color: var(--white); cursor: pointer; border-radius: 6px;">
            Lọc Tìm Kiếm
        </button>
        
        <?php if ((isset($_GET['keyword']) && $_GET['keyword'] !== '') || (isset($_GET['role']) && $_GET['role'] !== 'all' && $_GET['role'] !== '')): ?>
            <a href="index.php?act=listtk" style="font-size: 13px; color: var(--text-muted); text-decoration: underline; margin-left: 5px;">Xoá bộ lọc</a>
        <?php endif; ?>
    </form>

    <a href="index.php?act=addtk" class="btn-add-new" style="margin: 0;">
        <span>➕</span> Thêm Tài Khoản Mới
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
                <th style="width: 80px;">Mã TK</th>
                <th>Tên đăng nhập</th>
                <th>Địa chỉ Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th style="width: 200px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_taikhoan)) {
                echo '<tr><td colspan="6" style="text-align: center; color: var(--text-muted);">Không có tài khoản nào trong cơ sở dữ liệu.</td></tr>';
            } else {
                foreach ($list_taikhoan as $tk):
                    $suatk = "index.php?act=suatk&id=" . $tk['id'];
                    $xoatk = "index.php?act=xoatk&id=" . $tk['id'];
                    if ($tk['role'] == 1) {
                        $vai_tro = '<span style="background-color: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Admin</span>';
                    } elseif ($tk['role'] == 2) {
                        $vai_tro = '<span style="background-color: #f3e8ff; color: #6b21a8; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Nhân viên</span>';
                    } else {
                        $vai_tro = '<span style="background-color: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">Khách hàng</span>';
                    }
            ?>
                <tr>
                    <td><strong>#<?php echo $tk['id']; ?></strong></td>
                    <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($tk['username']); ?></td>
                    <td><?php echo htmlspecialchars($tk['email']); ?></td>
                    <td><?php echo htmlspecialchars($tk['phone'] ? $tk['phone'] : 'Chưa cập nhật'); ?></td>
                    <td><?php echo $vai_tro; ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suatk; ?>" class="btn-action btn-edit" title="Sửa tài khoản">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoatk; ?>" class="btn-action btn-delete" title="Xóa tài khoản" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không? Tất cả bình luận liên quan đến tài khoản này cũng sẽ bị xóa!');">
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
