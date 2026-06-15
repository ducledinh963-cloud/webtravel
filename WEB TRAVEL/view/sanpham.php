<div class="container">
    <!-- Breadcrumbs or simple header -->
    <div style="padding: 20px 0 10px; font-size: 14px; color: var(--text-muted);">
        <a href="index.php">Trang Chủ</a> &raquo; <span>Tour Du Lịch</span>
        <?php if (isset($danhmuc_hientai)): ?>
            &raquo; <span><?php echo htmlspecialchars($danhmuc_hientai['name']); ?></span>
        <?php endif; ?>
    </div>

    <div class="page-layout">
        <!-- Main Content Area -->
        <main>
            <div style="margin-bottom: 25px;">
                <h1 style="font-size: 28px; font-weight: 800;">
                    <?php 
                    if (isset($keyword) && $keyword != '') {
                        echo 'Kết quả tìm kiếm cho: "' . htmlspecialchars($keyword) . '"';
                    } elseif (isset($danhmuc_hientai)) {
                        echo htmlspecialchars($danhmuc_hientai['name']);
                    } else {
                        echo 'Tất Cả Tour Du Lịch';
                    }
                    ?>
                </h1>
                <p style="color: var(--text-muted); font-size: 14px; margin-top: 5px;">
                    Tìm thấy <?php echo count($list_sanpham); ?> tour phù hợp với yêu cầu của bạn.
                </p>
            </div>

            <?php if (empty($list_sanpham)): ?>
                <div style="background-color: var(--white); padding: 40px; border-radius: 12px; text-align: center; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); margin-bottom: 30px;">
                    <div style="font-size: 48px; margin-bottom: 15px;">🔍</div>
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 10px;">Không tìm thấy tour du lịch nào</h3>
                    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Vui lòng thử tìm kiếm với từ khóa khác hoặc quay lại xem tất cả danh mục.</p>
                    <a href="index.php?act=sanpham" class="hero-btn" style="padding: 8px 20px; font-size: 13px;">Xem Tất Cả Tour</a>
                </div>
            <?php else: ?>
                <div class="tour-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    <?php 
                    foreach ($list_sanpham as $sp):
                        // Lấy tên danh mục tương ứng
                        $ten_dm = 'Tour Du Lịch';
                        foreach ($list_danhmuc as $dm) {
                            if ($dm['id'] == $sp['id_danhmuc']) {
                                $ten_dm = $dm['name'];
                                break;
                            }
                        }
                    ?>
                        <div class="tour-card">
                            <div class="tour-img-wrapper" style="height: 180px;">
                                <span class="tour-badge">Giá Tốt</span>
                                <div class="tour-views">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <?php echo $sp['views']; ?>
                                </div>
                                <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Du+Lich'">
                            </div>
                            
                            <div class="tour-body" style="padding: 20px;">
                                <div class="tour-category"><?php echo htmlspecialchars($ten_dm); ?></div>
                                <h3 class="tour-title" style="font-size: 16px; height: 44px; -webkit-line-clamp: 2;">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>"><?php echo htmlspecialchars($sp['name']); ?></a>
                                </h3>
                                <p class="tour-desc" style="font-size: 12px; margin-bottom: 15px; -webkit-line-clamp: 2;"><?php echo htmlspecialchars($sp['description']); ?></p>
                                
                                <div class="tour-footer" style="gap: 5px; flex-wrap: wrap;">
                                    <div class="tour-price">
                                        <?php if (isset($sp['price_sale']) && $sp['price_sale'] > 0): ?>
                                            <span class="price-old" style="font-size: 11px;"><?php echo number_format($sp['price']); ?>đ</span>
                                            <span class="price-new" style="font-size: 15px;"><?php echo number_format($sp['price_sale']); ?>đ</span>
                                        <?php else: ?>
                                            <span class="price-new" style="font-size: 15px;"><?php echo number_format($sp['price']); ?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <div style="display: flex; gap: 5px; align-items: center;">
                                        <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>" class="btn-book" style="padding: 6px 10px; font-size: 11px; background-color: #0ea5e9;">Xem</a>
                                        
                                        <form action="index.php?act=addtocart" method="POST" style="display: inline-block; margin: 0;">
                                            <input type="hidden" name="id" value="<?php echo $sp['id']; ?>">
                                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($sp['name']); ?>">
                                            <input type="hidden" name="image" value="<?php echo htmlspecialchars($sp['image']); ?>">
                                            <input type="hidden" name="price" value="<?php echo ($sp['price_sale'] > 0) ? $sp['price_sale'] : $sp['price']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="addtocart" class="btn-book" style="padding: 6px 10px; font-size: 11px; background-color: var(--secondary-color); cursor: pointer; border: none; font-weight: 700; color: var(--white); border-radius: 4px;">Đặt Tour</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>

        <!-- Sidebar Area -->
        <aside class="sidebar">
            <!-- Search Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Tìm Kiếm Nhanh</h3>
                <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 10px;">
                    <input type="hidden" name="act" value="sanpham">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>" style="padding: 10px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; font-size: 13px;">
                    <button type="submit" class="btn-form" style="margin-top: 0; padding: 10px;">Tìm kiếm</button>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Khu Vực Du Lịch</h3>
                <ul class="widget-list">
                    <li class="<?php echo (!isset($id_danhmuc) || $id_danhmuc == '') ? 'active' : ''; ?>">
                        <a href="index.php?act=sanpham">
                            Tất Cả Tour
                        </a>
                    </li>
                    <?php foreach ($list_danhmuc as $dm): ?>
                        <li class="<?php echo (isset($id_danhmuc) && $id_danhmuc == $dm['id']) ? 'active' : ''; ?>">
                            <a href="index.php?act=sanpham&id_danhmuc=<?php echo $dm['id']; ?>">
                                <?php echo htmlspecialchars($dm['name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Hotline Widget -->
            <div class="sidebar-widget" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%); color: var(--white); text-align: center;">
                <h4 style="font-weight: 800; font-size: 18px; margin-bottom: 10px;">Bạn cần hỗ trợ?</h4>
                <p style="font-size: 13px; opacity: 0.9; margin-bottom: 15px;">Liên hệ với chuyên viên của chúng tôi để được tư vấn thiết kế tour miễn phí 24/7.</p>
                <a href="tel:0941272222" style="background-color: var(--white); color: var(--primary-color); display: inline-block; padding: 10px 20px; border-radius: 30px; font-weight: 800; font-size: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">094 127 2222</a>
            </div>
        </aside>
    </div>
</div>
