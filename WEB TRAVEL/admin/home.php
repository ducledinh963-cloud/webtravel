<!-- Stats Cards Row -->
<div class="intro-stats" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 40px;">
    <div class="stat-item" style="text-align: left; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 32px; color: var(--primary-color);">
                <?php echo count($list_danhmuc); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px;">Danh mục tour</div>
        </div>
        <div style="font-size: 36px; opacity: 0.3;">📁</div>
    </div>

    <div class="stat-item" style="text-align: left; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 32px; color: var(--secondary-color);">
                <?php 
                $count_sp = pdo_query_value("SELECT count(*) FROM sanpham");
                echo $count_sp; 
                ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px;">Tour đang chạy</div>
        </div>
        <div style="font-size: 36px; opacity: 0.3;">⛵</div>
    </div>

    <div class="stat-item" style="text-align: left; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 32px; color: #10b981;">
                <?php 
                $count_tk = pdo_query_value("SELECT count(*) FROM taikhoan");
                echo $count_tk; 
                ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px;">Thành viên</div>
        </div>
        <div style="font-size: 36px; opacity: 0.3;">👥</div>
    </div>

    <div class="stat-item" style="text-align: left; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 32px; color: #f59e0b;">
                <?php 
                $sum_views = pdo_query_value("SELECT sum(views) FROM sanpham");
                echo number_format($sum_views ? $sum_views : 0); 
                ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px;">Lượt xem tour</div>
        </div>
        <div style="font-size: 36px; opacity: 0.3;">👁️</div>
    </div>
</div>

<!-- Quick Actions & General info -->
<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
    <!-- Welcome message -->
    <div style="background-color: var(--white); padding: 35px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 15px;">Hệ thống Quản trị Web Travel</h3>
        <p style="color: var(--text-muted); font-size: 14px; line-height: 1.7; margin-bottom: 20px;">
            Chào mừng bạn đến với trang quản trị dành riêng cho Ban quản lý Web Travel. Tại đây bạn có thể thêm mới các hành trình tour độc đáo, chỉnh sửa bảng giá, điều chỉnh các danh mục khu vực địa lý, quản lý bình luận khách hàng và theo dõi chỉ số lượt xem thực tế của từng tour du lịch.
        </p>
        <div style="display: flex; gap: 10px;">
            <a href="index.php?act=addsp" class="btn-add-new">
                Thêm Tour Mới
            </a>
            <a href="index.php?act=listsp" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px; display: inline-flex; align-items: center;">
                Quản Lý Tour
            </a>
        </div>
    </div>

    <!-- Quick guidelines -->
    <div style="background-color: var(--white); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); display: flex; flex-direction: column; gap: 15px;">
        <h4 style="font-weight: 800; font-size: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Lưu ý vận hành</h4>
        <ul style="font-size: 13px; color: var(--text-muted); padding-left: 20px; display: flex; flex-direction: column; gap: 10px;">
            <li><strong>Ảnh đại diện tour:</strong> Nên chọn các hình ảnh ngang tỷ lệ 3:2, dung lượng tối ưu dưới 1.5MB để tránh lag trang.</li>
            <li><strong>Bảo mật tài khoản:</strong> Đăng xuất khỏi hệ thống admin khi rời khỏi máy tính làm việc để bảo đảm an toàn dữ liệu khách hàng.</li>
            <li><strong>Xóa danh mục:</strong> Khi xóa danh mục thì toàn bộ tour thuộc danh mục đó cũng sẽ tự động bị xóa theo (Foreign Key Cascade). Cần hết sức thận trọng!</li>
        </ul>
    </div>
</div>
