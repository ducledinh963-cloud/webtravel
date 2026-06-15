<div class="container">
    <!-- Breadcrumbs -->
    <div style="padding: 20px 0 10px; font-size: 14px; color: var(--text-muted);">
        <a href="index.php">Trang Chủ</a> &raquo; 
        <a href="index.php?act=sanpham">Tour Du Lịch</a> &raquo; 
        <a href="index.php?act=sanpham&id_danhmuc=<?php echo $sanpham['id_danhmuc']; ?>"><?php echo htmlspecialchars($sanpham['ten_danhmuc']); ?></a> &raquo; 
        <span><?php echo htmlspecialchars($sanpham['name']); ?></span>
    </div>

    <!-- Booking message (simulated) -->
    <?php if (isset($_GET['booked']) && $_GET['booked'] == 'success'): ?>
        <div class="alert alert-success" style="margin-top: 15px;">
            🎉 <strong>Đặt Tour Thành Công!</strong> Chúc mừng bạn đã đăng ký tour du lịch thành công. Chuyên viên của Web Travel sẽ liên hệ lại với bạn qua số điện thoại/email trong vòng 15 phút để xác nhận dịch vụ.
        </div>
    <?php endif; ?>

    <div class="page-layout">
        <!-- Main Tour Detail Content -->
        <main>
            <article class="detail-card">
                <div class="detail-header">
                    <span class="detail-category"><?php echo htmlspecialchars($sanpham['ten_danhmuc']); ?></span>
                    <h1 class="detail-title"><?php echo htmlspecialchars($sanpham['name']); ?></h1>
                    
                    <div class="detail-meta">
                        <span>Lượt xem: <strong><?php echo $sanpham['views']; ?></strong></span>
                        <span>Mã Tour: <strong>WT-<?php echo str_pad($sanpham['id'], 4, '0', STR_PAD_LEFT); ?></strong></span>
                        <span>Thời gian: <strong>Linh hoạt</strong></span>
                    </div>
                </div>

                <div class="detail-img">
                    <img src="<?php echo htmlspecialchars($sanpham['image']); ?>" alt="<?php echo htmlspecialchars($sanpham['name']); ?>" onerror="this.src='https://placehold.co/800x480?text=Tour+Du+Lich'">
                </div>

                <!-- Booking Area Box -->
                <div class="detail-booking-box">
                    <div class="detail-price-box">
                        <span style="font-size: 13px; font-weight: 600; color: var(--text-muted);">Giá trọn gói từ:</span>
                        <?php if (isset($sanpham['price_sale']) && $sanpham['price_sale'] > 0): ?>
                            <span class="price-old"><?php echo number_format($sanpham['price']); ?> VNĐ</span>
                            <span class="price-new"><?php echo number_format($sanpham['price_sale']); ?> VNĐ</span>
                        <?php else: ?>
                            <span class="price-new"><?php echo number_format($sanpham['price']); ?> VNĐ</span>
                        <?php endif; ?>
                    </div>
                    
                    <form action="index.php?act=addtocart" method="POST">
                        <input type="hidden" name="id" value="<?php echo $sanpham['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($sanpham['name']); ?>">
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($sanpham['image']); ?>">
                        <input type="hidden" name="price" value="<?php echo ($sanpham['price_sale'] > 0) ? $sanpham['price_sale'] : $sanpham['price']; ?>">
                        
                        <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <label for="quantity" style="font-size: 13px; font-weight: 700; color: var(--text-dark); margin: 0;">Số lượng khách:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="50" style="width: 70px; padding: 8px; border: 1px solid var(--border-color); border-radius: 4px; text-align: center; font-weight: 700; outline: none;">
                        </div>
                        
                        <button type="submit" name="addtocart" class="btn-large-book" style="cursor: pointer; border: none; font-weight: 800; width: 100%;">Đặt Tour Ngay</button>
                    </form>
                </div>

                <!-- Detailed Text Content -->
                <div class="detail-content">
                    <h3>Tổng Quan Chương Trình Tour</h3>
                    <p><?php echo nl2br(htmlspecialchars($sanpham['description'])); ?></p>

                    <h3>Lịch Trình Chi Tiết &amp; Dịch Vụ Đi Kèm</h3>
                    <ul style="margin-left: 20px; margin-bottom: 20px; display: flex; flex-direction: column; gap: 8px;">
                        <li><strong>Dịch vụ bao gồm:</strong> Xe ô tô đưa đón du lịch đời mới chất lượng cao, Hướng dẫn viên suốt tuyến tận tâm nhiệt tình, Vé tham quan các điểm du lịch theo lịch trình, Ăn các bữa tiêu chuẩn theo chương trình, Bảo hiểm du lịch tối đa 100.000.000đ/vụ.</li>
                        <li><strong>Không bao gồm:</strong> Thuế VAT, Chi phí cá nhân phát sinh, Tiền tip cho HDV và tài xế lái xe.</li>
                        <li><strong>Chính sách trẻ em:</strong> Dưới 5 tuổi miễn phí (bố mẹ tự lo ăn ngủ), Từ 5-9 tuổi tính 75% giá tour, Từ 10 tuổi trở lên tính giá như người lớn.</li>
                    </ul>

                    <h3>Lưu Ý Khi Đi Tour</h3>
                    <p style="font-style: italic; color: var(--text-muted);">Quý khách vui lòng mang theo giấy tờ tùy thân (CMND/CCCD hoặc Hộ chiếu gốc) khi đi tour. Trẻ em mang theo bản sao Giấy khai sinh. Hành lý gọn nhẹ, chuẩn bị trang phục phù hợp với thời tiết và tính chất địa hình tham quan.</p>
                </div>
            </article>

            <!-- Comment Section (Bình Luận Khách Hàng) -->
            <section style="margin-top: 40px; background-color: var(--white); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); margin-bottom: 40px;">
                <div class="section-title-area" style="text-align: left; margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
                    <h2 class="section-title" style="font-size: 20px; margin: 0;">Bình Luận <span>Khách Hàng</span></h2>
                </div>

                <!-- Comment List -->
                <div class="comment-list" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px; max-height: 400px; overflow-y: auto; padding-right: 5px;">
                    <?php if (empty($list_binhluan)): ?>
                        <p style="color: var(--text-muted); font-style: italic; font-size: 14px;">Chưa có bình luận nào cho tour này. Hãy là người đầu tiên chia sẻ cảm nhận!</p>
                    <?php else: ?>
                        <?php foreach ($list_binhluan as $bl): ?>
                            <div class="comment-item" style="border-bottom: 1px dashed var(--border-color); padding-bottom: 12px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <span style="font-weight: 700; font-size: 14px; color: var(--text-dark);">
                                        👤 <?php echo htmlspecialchars($bl['username']); ?>
                                    </span>
                                    <span style="font-size: 11px; color: var(--text-muted); font-style: italic;">
                                        🕒 <?php echo htmlspecialchars($bl['date']); ?>
                                    </span>
                                </div>
                                <p style="font-size: 13.5px; color: #475569; line-height: 1.5; padding-left: 20px; margin: 0;">
                                    <?php echo nl2br(htmlspecialchars($bl['content'])); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Comment Input Form -->
                <div class="comment-form-wrapper" style="border-top: 1px solid var(--border-color); padding-top: 20px;">
                    <?php if (isset($_SESSION['user'])): ?>
                        <form action="index.php?act=sanphamct&id=<?php echo $sanpham['id']; ?>" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                            <input type="hidden" name="id_pro" value="<?php echo $sanpham['id']; ?>">
                            <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-muted); display: block;">Viết bình luận của bạn</label>
                            <textarea name="content" rows="3" required placeholder="Chia sẻ trải nghiệm hoặc câu hỏi của bạn về tour này..." style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; outline: none; font-size: 13.5px; transition: var(--transition-speed); resize: vertical;"></textarea>
                            <button type="submit" name="guibinhluan" class="btn-form" style="margin-top: 0; padding: 10px 20px; align-self: flex-end; width: auto; font-size: 13px; background-color: var(--primary-color);">Gửi Bình Luận</button>
                        </form>
                    <?php else: ?>
                        <div style="background-color: var(--bg-light); padding: 15px; border-radius: 8px; text-align: center; border: 1px dashed var(--border-color); font-size: 13.5px; color: var(--text-muted);">
                            Vui lòng <a href="index.php?act=dangnhap" style="color: var(--primary-color); font-weight: 700; text-decoration: underline;">Đăng Nhập</a> để viết bình luận của bạn.
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Related Tours (Tour Cùng Loại) -->
            <section style="margin-top: 50px;">
                <div class="section-title-area" style="text-align: left; margin-bottom: 25px;">
                    <h2 class="section-title" style="font-size: 22px;">Tour Du Lịch <span>Liên Quan</span></h2>
                </div>

                <div class="tour-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
                    <?php if (empty($list_cungloai)): ?>
                        <p style="color: var(--text-muted); font-size: 14px;">Không có tour liên quan nào khác.</p>
                    <?php else: ?>
                        <?php foreach ($list_cungloai as $sp): ?>
                            <div class="tour-card">
                                <div class="tour-img-wrapper" style="height: 160px;">
                                    <div class="tour-views">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        <?php echo $sp['views']; ?>
                                    </div>
                                    <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Du+Lich'">
                                </div>
                                
                                <div class="tour-body" style="padding: 15px;">
                                    <h3 class="tour-title" style="font-size: 15px; height: 44px; -webkit-line-clamp: 2; margin-bottom: 8px;">
                                        <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>"><?php echo htmlspecialchars($sp['name']); ?></a>
                                    </h3>
                                    
                                    <div class="tour-footer" style="padding-top: 10px; gap: 5px; flex-wrap: wrap;">
                                        <span class="price-new" style="font-size: 14px;"><?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?>đ</span>
                                        <div style="display: flex; gap: 4px; align-items: center;">
                                            <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>" class="btn-book" style="padding: 5px 8px; font-size: 11px; background-color: #0ea5e9;">Xem</a>
                                            
                                            <form action="index.php?act=addtocart" method="POST" style="display: inline-block; margin: 0;">
                                                <input type="hidden" name="id" value="<?php echo $sp['id']; ?>">
                                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($sp['name']); ?>">
                                                <input type="hidden" name="image" value="<?php echo htmlspecialchars($sp['image']); ?>">
                                                <input type="hidden" name="price" value="<?php echo ($sp['price_sale'] > 0) ? $sp['price_sale'] : $sp['price']; ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" name="addtocart" class="btn-book" style="padding: 5px 8px; font-size: 11px; background-color: var(--secondary-color); cursor: pointer; border: none; font-weight: 700; color: var(--white); border-radius: 4px;">Đặt Tour</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <!-- Sidebar (Giống trang danh sách sản phẩm) -->
        <aside class="sidebar">
            <!-- Booking Fast Form Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Yêu Cầu Gọi Lại</h3>
                <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 12px;">
                    <input type="hidden" name="act" value="sanphamct">
                    <input type="hidden" name="id" value="<?php echo $sanpham['id']; ?>">
                    <input type="hidden" name="booked" value="success">
                    
                    <div style="font-size: 12px; color: var(--text-muted);">Để lại thông tin, chúng tôi sẽ gọi lại ngay để hỗ trợ đặt tour!</div>
                    <input type="text" placeholder="Họ và tên của bạn" required style="padding: 10px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 13px;">
                    <input type="tel" placeholder="Số điện thoại di động" required style="padding: 10px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 13px;">
                    
                    <button type="submit" class="btn-form" style="margin-top: 0; padding: 10px; background-color: var(--secondary-color);">Yêu Cầu Tư Vấn</button>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Khu Vực Du Lịch</h3>
                <ul class="widget-list">
                    <?php foreach ($list_danhmuc as $dm): ?>
                        <li class="<?php echo ($sanpham['id_danhmuc'] == $dm['id']) ? 'active' : ''; ?>">
                            <a href="index.php?act=sanpham&id_danhmuc=<?php echo $dm['id']; ?>">
                                <?php echo htmlspecialchars($dm['name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>
</div>
