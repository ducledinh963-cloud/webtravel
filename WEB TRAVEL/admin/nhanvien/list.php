<div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
    <!-- Form tìm kiếm nhân viên -->
    <form action="index.php" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <input type="hidden" name="act" value="listnv">
        
        <input type="text" name="keyword" placeholder="Nhập tên, email hoặc SĐT..." 
               value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>"
               style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; width: 220px; outline: none; font-size: 13px;">
               
        <button type="submit" class="btn-action" style="background-color: var(--primary-color); border: none; padding: 8px 15px; font-size: 13px; font-weight: 700; color: var(--white); cursor: pointer; border-radius: 6px;">
            Tìm Kiếm Nhân Viên
        </button>
        
        <?php if (isset($_GET['keyword']) && $_GET['keyword'] !== ''): ?>
            <a href="index.php?act=listnv" style="font-size: 13px; color: var(--text-muted); text-decoration: underline; margin-left: 5px;">Xoá bộ lọc</a>
        <?php endif; ?>
    </form>

    <a href="index.php?act=addnv" class="btn-add-new" style="margin: 0; background-color: #8b5cf6;">
        <span>➕</span> Thêm Nhân Viên Mới
    </a>
</div>

<?php if (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] != ''): ?>
    <div class="alert alert-success">
        🎉 <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 80px;">Mã NV</th>
                <th>Tên đăng nhập</th>
                <th>Địa chỉ Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th style="width: 200px; text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_nhanvien)) {
                echo '<tr><td colspan="6" style="text-align: center; color: var(--text-muted); padding: 20px;">Không tìm thấy nhân viên nào phù hợp.</td></tr>';
            } else {
                foreach ($list_nhanvien as $nv):
                    $suanv = "index.php?act=suanv&id=" . $nv['id'];
                    $xoanv = "index.php?act=xoanv&id=" . $nv['id'];
                    $vai_tro = '<span style="background-color: #f3e8ff; color: #6b21a8; padding: 4px 10px; border-radius: 4px; font-weight: 700; font-size: 11px;">Nhân viên (Staff)</span>';
            ?>
                <tr>
                    <td><strong>#<?php echo $nv['id']; ?></strong></td>
                    <td style="font-weight: 600; color: var(--text-dark);"><?php echo htmlspecialchars($nv['username']); ?></td>
                    <td><?php echo htmlspecialchars($nv['email']); ?></td>
                    <td><?php echo htmlspecialchars($nv['phone'] ? $nv['phone'] : 'Chưa cập nhật'); ?></td>
                    <td><?php echo $vai_tro; ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo $suanv; ?>" class="btn-action btn-edit" title="Sửa nhân viên" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;">
                            <span>✏️</span> Sửa
                        </a>
                        <a href="<?php echo $xoanv; ?>" class="btn-action btn-delete" title="Xóa nhân viên" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?');">
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
