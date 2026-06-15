<style>
    .filter-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease;
    }
    .filter-card:hover {
        transform: translateY(-2px);
    }
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: flex-end;
    }
    .filter-group {
        flex: 1;
        min-width: 200px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .filter-group label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }
    .filter-group input, .filter-group select {
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .filter-group input:focus, .filter-group select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .filter-actions {
        display: flex;
        gap: 10px;
    }
    .btn-search {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-search:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }
    .btn-clear {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-clear:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .avatar-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.2s ease;
    }
    .avatar-circle:hover {
        transform: scale(1.15) rotate(3deg);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10;
    }
    .badge-gender {
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-nam {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .badge-nu {
        background-color: #fdf2f8;
        color: #db2777;
        border: 1px solid #fbcfe8;
    }
    .badge-nationality {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }
    .badge-vn {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fef3c7;
    }
    .badge-intl {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }
    .tourist-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
    }
    .tourist-contact {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }
    .table-responsive-wrapper {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }
    .admin-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border-bottom: 2px solid #e2e8f0;
    }
    .admin-table td {
        padding: 14px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
    }
    .admin-table tr:hover {
        background-color: #f8fafc;
    }
    .tourist-meta-icon {
        color: #94a3b8;
        margin-right: 4px;
    }
    .btn-add-new-tourist {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white !important;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        transition: all 0.2s ease;
    }
    .btn-add-new-tourist:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
    }
    .results-count {
        margin-top: 15px;
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }
</style>

<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
    <div>
        <h2 style="margin: 0; font-size: 18px; font-weight: 700; color: #1e293b;">Bảng Quản Lý Hồ Sơ</h2>
    </div>
    <a href="index.php?act=adddk" class="btn-add-new-tourist">
        <span>➕</span> Thêm Du Khách Mới
    </a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] != ''): ?>
    <div class="alert alert-success" style="margin-bottom: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
        🎉 <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
<?php elseif (isset($thongbao) && $thongbao != ''): ?>
    <div class="alert alert-success" style="margin-bottom: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
        🎉 <?php echo htmlspecialchars($thongbao); ?>
    </div>
<?php endif; ?>

<!-- Filter & Search Card -->
<div class="filter-card">
    <form action="index.php?act=listdk" method="POST" class="filter-form">
        <div class="filter-group">
            <label for="keyword">Tìm kiếm du khách</label>
            <input type="text" id="keyword" name="keyword" placeholder="Nhập tên, email, sđt, quốc tịch..." value="<?php echo htmlspecialchars($keyword); ?>">
        </div>
        
        <div class="filter-group" style="max-width: 250px;">
            <label for="gender">Giới tính</label>
            <select id="gender" name="gender">
                <option value="">Tất cả giới tính</option>
                <option value="Nam" <?php echo ($gender == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                <option value="Nữ" <?php echo ($gender == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit" name="search_submit" class="btn-search">
                <span>🔍</span> Lọc Kết Quả
            </button>
            <?php if (!empty($keyword) || !empty($gender)): ?>
                <a href="index.php?act=listdk&clear_search=1" class="btn-clear">
                    <span>🔄</span> Bỏ Lọc
                </a>
            <?php endif; ?>
        </div>
    </form>
    
    <div class="results-count">
        Hiển thị: <strong><?php echo count($list_dukhach); ?></strong> du khách trong danh sách.
    </div>
</div>

<!-- Table Card -->
<div class="table-responsive-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;">ID</th>
                <th style="width: 80px; text-align: center;">Hình Ảnh</th>
                <th>Thông Tin Cá Nhân</th>
                <th>Thông Tin Liên Lạc</th>
                <th>Quốc Tịch &amp; Hộ Chiếu</th>
                <th>Ngày Sinh</th>
                <th style="width: 140px; text-align: center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (empty($list_dukhach)) {
                echo '<tr><td colspan="7" style="text-align: center; color: var(--text-muted); padding: 40px;">Không tìm thấy du khách nào phù hợp với bộ lọc tìm kiếm.</td></tr>';
            } else {
                foreach ($list_dukhach as $dk):
                    $suadk = "index.php?act=suadk&id=" . $dk['id'];
                    $xoadk = "index.php?act=xoadk&id=" . $dk['id'];
                    
                    // Giới tính badge class
                    $gender_badge = ($dk['gender'] == 'Nữ') ? 'badge-nu' : 'badge-nam';
                    
                    // Quốc tịch badge class
                    $nationality_badge = (trim($dk['nationality']) == 'Việt Nam') ? 'badge-vn' : 'badge-intl';
            ?>
                <tr>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; color: #64748b;">#<?php echo $dk['id']; ?></span>
                    </td>
                    <td style="text-align: center;">
                        <img src="../<?php echo htmlspecialchars($dk['image']); ?>" alt="Avatar" class="avatar-circle" onerror="this.src='../uploads/dukhach1.svg'">
                    </td>
                    <td>
                        <div class="tourist-name"><?php echo htmlspecialchars($dk['name']); ?></div>
                        <div style="margin-top: 4px;">
                            <span class="badge-gender <?php echo $gender_badge; ?>"><?php echo htmlspecialchars($dk['gender']); ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="tourist-contact">
                            <span class="tourist-meta-icon">📧</span> <?php echo htmlspecialchars($dk['email']); ?>
                        </div>
                        <div class="tourist-contact" style="margin-top: 4px;">
                            <span class="tourist-meta-icon">📞</span> <?php echo htmlspecialchars($dk['phone']); ?>
                        </div>
                        <div class="tourist-contact" style="margin-top: 4px; font-size: 11px;">
                            <span class="tourist-meta-icon">📍</span> <?php echo htmlspecialchars($dk['address']); ?>
                        </div>
                    </td>
                    <td>
                        <div>
                            <span class="badge-nationality <?php echo $nationality_badge; ?>">
                                🌐 <?php echo htmlspecialchars($dk['nationality']); ?>
                            </span>
                        </div>
                        <?php if(!empty($dk['passport'])): ?>
                            <div style="font-size: 12px; color: #64748b; margin-top: 4px; font-family: monospace; font-weight: 600;">
                                🪪 <?php echo htmlspecialchars($dk['passport']); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="font-size: 13px; font-weight: 500; color: #334155;">
                            📅 <?php echo htmlspecialchars($dk['birthdate']); ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?php echo $suadk; ?>" class="btn-action btn-edit" title="Chỉnh sửa thông tin" style="text-decoration: none; padding: 6px 12px; font-size: 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;">
                                <span>✏️</span> Sửa
                            </a>
                            <a href="<?php echo $xoadk; ?>" class="btn-action btn-delete" title="Xóa hồ sơ du khách" onclick="return confirm('Bạn có chắc chắn muốn xóa du khách này? Hành động này không thể hoàn tác.');" style="text-decoration: none; padding: 6px 12px; font-size: 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;">
                                <span>🗑️</span> Xóa
                            </a>
                        </div>
                    </td>
                </tr>
            <?php 
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>
