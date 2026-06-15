<div style="margin-bottom: 20px;">
    <a href="index.php?act=listbill" class="btn-action" style="background-color: var(--text-dark); padding: 10px 20px; font-size: 13px; text-decoration: none; border-radius: 6px; display: inline-flex; align-items: center; gap: 8px;">
        <span>⬅️</span> Quay Lại Danh Sách
    </a>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: start; margin-top: 10px;">
    
    <!-- LEFT COLUMN: Booking Details -->
    <div style="background-color: var(--white); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="background-color: #f8fafc; border-bottom: 1px solid var(--border-color); padding: 15px 20px;">
            <h3 style="margin: 0; font-size: 16px; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                <span>📋</span> Thông Tin Đơn Hàng
            </h3>
        </div>
        <div style="padding: 20px;">
            <div style="margin-bottom: 20px; text-align: center; border-bottom: 1px dashed var(--border-color); padding-bottom: 15px;">
                <span style="font-size: 13px; color: var(--text-muted); font-weight: 500;">MÃ ĐƠN ĐẶT TOUR</span>
                <div style="font-size: 24px; font-weight: 800; color: var(--primary-color); letter-spacing: 1px; margin-top: 5px;">
                    <?php echo htmlspecialchars($bill['bill_code']); ?>
                </div>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 14px; line-height: 1.6;">
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500; width: 120px;">Khách hàng:</td>
                    <td style="padding: 8px 0; color: var(--text-dark); font-weight: 700;">
                        <?php echo htmlspecialchars($bill['bill_name']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500;">Số điện thoại:</td>
                    <td style="padding: 8px 0; color: var(--text-dark); font-weight: 600;">
                        <?php echo htmlspecialchars($bill['bill_phone']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500;">Địa chỉ Email:</td>
                    <td style="padding: 8px 0; color: var(--text-dark);">
                        <?php echo htmlspecialchars($bill['bill_email'] ? $bill['bill_email'] : 'Chưa cập nhật'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500;">Địa chỉ liên hệ:</td>
                    <td style="padding: 8px 0; color: var(--text-dark); font-size: 13px;">
                        <?php echo htmlspecialchars($bill['bill_address'] ? $bill['bill_address'] : 'Chưa cập nhật'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500;">Ngày đặt tour:</td>
                    <td style="padding: 8px 0; color: var(--text-dark);">
                        <?php echo date('d/m/Y H:i:s', strtotime($bill['date_booking'])); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500; vertical-align: middle;">Thanh toán:</td>
                    <td style="padding: 8px 0; color: var(--text-dark);">
                        <?php 
                        switch ($bill['bill_pttt']) {
                            case 0:
                                echo '<span style="background-color: #fff7ed; color: #c2410c; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; border: 1px solid #ffedd5;">💵 Tiền mặt</span>';
                                break;
                            case 1:
                                echo '<span style="background-color: #f0fdf4; color: #15803d; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; border: 1px solid #dcfce7;">🏦 Chuyển khoản</span>';
                                break;
                            case 2:
                                echo '<span style="background-color: #faf5ff; color: #7e22ce; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; border: 1px solid #f3e8ff;">📱 Ví điện tử</span>';
                                break;
                            default:
                                echo '<span style="background-color: #f3f4f6; color: #4b5563; padding: 3px 8px; border-radius: 4px; font-size: 12px;">Khác</span>';
                                break;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); font-weight: 500; vertical-align: middle;">Trạng thái:</td>
                    <td style="padding: 8px 0;">
                        <?php 
                        switch ($bill['bill_status']) {
                            case 0:
                                echo '<span style="background-color: #f3f4f6; color: #374151; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #d1d5db; display: inline-block;">Chờ xác nhận</span>';
                                break;
                            case 1:
                                echo '<span style="background-color: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #bfdbfe; display: inline-block;">Đang chuẩn bị</span>';
                                break;
                            case 2:
                                echo '<span style="background-color: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #a7f3d0; display: inline-block;">Đã khởi hành</span>';
                                break;
                            case 3:
                                echo '<span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; border: 1px solid #fecaca; display: inline-block;">Đã hủy</span>';
                                break;
                            default:
                                echo '<span style="background-color: #f3f4f6; color: #374151; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; display: inline-block;">Chưa rõ</span>';
                                break;
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <div style="margin-top: 25px; display: flex; gap: 10px;">
                <a href="index.php?act=suabill&id=<?php echo $bill['id']; ?>" class="btn-action btn-edit" style="flex: 1; padding: 10px; font-size: 13px; text-decoration: none; border-radius: 6px; text-align: center; display: inline-flex; justify-content: center; align-items: center; gap: 6px;">
                    <span>✏️</span> Chỉnh sửa
                </a>
                <a href="index.php?act=xoabill&id=<?php echo $bill['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');" style="padding: 10px; font-size: 13px; text-decoration: none; border-radius: 6px; text-align: center; display: inline-flex; justify-content: center; align-items: center; gap: 6px;">
                    <span>🗑️</span> Xóa
                </a>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN: Order Items -->
    <div style="background-color: var(--white); border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="background-color: #f8fafc; border-bottom: 1px solid var(--border-color); padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 16px; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                <span>⛵</span> Danh Sách Tour Đăng Ký
            </h3>
            <span style="background-color: var(--primary-color); color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 12px; font-weight: 700;">
                <?php echo count($bill_details); ?> items
            </span>
        </div>
        <div style="padding: 20px;">
            <table class="admin-table" style="box-shadow: none; border: 1px solid var(--border-color); border-radius: 8px;">
                <thead>
                    <tr>
                        <th style="width: 90px; border-top-left-radius: 8px;">Hình ảnh</th>
                        <th>Tên Tour Du Lịch</th>
                        <th style="width: 130px; text-align: right;">Đơn Giá</th>
                        <th style="width: 100px; text-align: center;">Số lượng</th>
                        <th style="width: 140px; text-align: right; border-top-right-radius: 8px;">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $subtotal = 0;
                    foreach ($bill_details as $item): 
                        $subtotal += $item['total'];
                        // Make sure the image path has correct relative prefix for display in admin
                        $img_src = (strpos($item['image'], 'uploads/') === 0) ? '../' . $item['image'] : '../uploads/' . $item['image'];
                    ?>
                        <tr>
                            <td style="padding: 12px;">
                                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Tour Image" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);" onerror="this.src='../uploads/hotel1.jpg'">
                            </td>
                            <td style="padding: 12px; font-weight: 600; color: var(--text-dark); font-size: 14px;">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </td>
                            <td style="padding: 12px; text-align: right; font-weight: 600; color: var(--text-muted); font-size: 13px;">
                                <?php echo number_format($item['price'], 0, ',', '.') . ' VNĐ'; ?>
                            </td>
                            <td style="padding: 12px; text-align: center; font-weight: 700; color: var(--text-dark); font-size: 14px;">
                                <?php echo $item['quantity']; ?> khách
                            </td>
                            <td style="padding: 12px; text-align: right; font-weight: 700; color: var(--primary-color); font-size: 14px;">
                                <?php echo number_format($item['total'], 0, ',', '.') . ' VNĐ'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="margin-top: 25px; background-color: #f8fafc; border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; display: flex; flex-direction: column; gap: 10px; max-width: 450px; margin-left: auto;">
                <div style="display: flex; justify-content: space-between; font-size: 14px; color: var(--text-muted);">
                    <span>Tổng phụ các tour:</span>
                    <span style="font-weight: 600; color: var(--text-dark);"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 14px; color: var(--text-muted); border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span>Phí dịch vụ &amp; VAT:</span>
                    <span style="font-weight: 600; color: var(--text-dark);">0 VNĐ</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: 800; color: var(--text-dark); padding-top: 5px;">
                    <span>TỔNG THÀNH TIỀN:</span>
                    <span style="color: var(--primary-color); font-size: 18px;"><?php echo number_format($bill['bill_total'], 0, ',', '.'); ?> VNĐ</span>
                </div>
            </div>
        </div>
    </div>

</div>
