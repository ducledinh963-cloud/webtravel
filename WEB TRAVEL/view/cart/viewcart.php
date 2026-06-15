<div class="container" style="padding: 40px 15px;">
    <h2 class="form-title" style="text-align: center; margin-bottom: 10px;">Giỏ Hàng Của Bạn</h2>
    <p class="form-subtitle" style="text-align: center; margin-bottom: 40px;">Xem lại danh sách dịch vụ và hành trình bạn đã lựa chọn trước khi thực hiện thanh toán.</p>

    <?php if (empty($_SESSION['cart'])): ?>
        <div style="text-align: center; padding: 50px 20px; background-color: var(--white); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
            <div style="font-size: 64px; margin-bottom: 20px;">🛒</div>
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 10px;">Giỏ hàng của bạn đang trống</h3>
            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 25px;">Hãy khám phá các điểm đến tuyệt vời và thêm tour du lịch yêu thích của bạn.</p>
            <a href="index.php?act=sanpham" class="btn-form" style="display: inline-block; width: auto; padding: 12px 30px;">Khám Phá Tour Ngay</a>
        </div>
    <?php else: ?>
        <div class="admin-table-wrapper" style="box-shadow: var(--card-shadow); border-radius: 12px; overflow: hidden; background: var(--white); border: 1px solid var(--border-color); margin-bottom: 30px;">
            <table class="admin-table">
                <thead>
                    <tr style="background-color: #f8fafc;">
                        <th style="width: 80px; text-align: center;">Hình ảnh</th>
                        <th>Tên Dịch Vụ / Tour</th>
                        <th style="width: 150px; text-align: right;">Đơn Giá</th>
                        <th style="width: 120px; text-align: center;">Số lượng</th>
                        <th style="width: 150px; text-align: right;">Thành tiền</th>
                        <th style="width: 100px; text-align: center;">Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item): 
                        $total += $item['subtotal'];
                        $del_item = "index.php?act=delcart&id=" . $item['id'];
                    ?>
                        <tr>
                            <td style="text-align: center;">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Tour photo" style="width: 70px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                            </td>
                            <td>
                                <?php if ($item['id'] >= 10000): ?>
                                    <span style="font-weight: 700; color: var(--text-dark);">
                                        <?php echo htmlspecialchars($item['name']); ?>
                                    </span>
                                <?php else: ?>
                                    <a href="index.php?act=sanphamct&id=<?php echo $item['id']; ?>" style="font-weight: 700; color: var(--text-dark); text-decoration: none; hover: color: var(--primary-color);">
                                        <?php echo htmlspecialchars($item['name']); ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: var(--text-dark);">
                                <?php echo number_format($item['price']); ?>đ
                            </td>
                            <td style="text-align: center; font-weight: 700; color: var(--primary-color);">
                                <?php echo $item['quantity']; ?>
                            </td>
                            <td style="text-align: right; font-weight: 800; color: var(--secondary-color);">
                                <?php echo number_format($item['subtotal']); ?>đ
                            </td>
                            <td style="text-align: center;">
                                <a href="<?php echo $del_item; ?>" class="btn-action btn-delete" style="padding: 6px 10px; font-size: 12px;" onclick="return confirm('Bạn có chắc muốn bỏ mục này khỏi giỏ hàng?');">
                                    <span>🗑️</span> Xoá
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <tr style="background-color: #f8fafc; border-top: 2px solid var(--border-color);">
                        <td colspan="4" style="text-align: right; font-weight: 800; font-size: 15px; padding: 15px;">Tổng giá trị đơn hàng:</td>
                        <td style="text-align: right; font-weight: 800; font-size: 18px; color: var(--secondary-color); padding: 15px;">
                            <?php echo number_format($total); ?>đ
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <a href="index.php?act=delcart" class="btn-action btn-delete" style="background-color: #64748b; padding: 12px 25px; display: inline-flex; align-items: center; height: auto;" onclick="return confirm('Bạn có chắc muốn xoá sạch giỏ hàng không?');">
                🧹 Xoá Sạch Giỏ Hàng
            </a>
            
            <div style="display: flex; gap: 10px;">
                <a href="index.php" class="btn-action" style="background-color: var(--text-dark); padding: 12px 25px; display: inline-flex; align-items: center; text-decoration: none; height: auto;">
                    ⛵ Tiếp Tục Mua Sắm
                </a>
                
                <a href="index.php?act=checkout" class="btn-form" style="width: auto; padding: 12px 35px; margin: 0; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4); background-color: var(--secondary-color); hover: background-color: #d97706;">
                    💳 Tiến Hành Thanh Toán
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
