<div class="container">
    <!-- Breadcrumbs -->
    <div style="padding: 20px 0 10px; font-size: 14px; color: var(--text-muted);">
        <a href="index.php">Trang Chủ</a> &raquo; <span>Liên Hệ</span>
    </div>

    <!-- Contact success message (simulated) -->
    <?php if (isset($contact_success) && $contact_success): ?>
        <div class="alert alert-success" style="margin-top: 15px;">
            🎉 <strong>Gửi thông tin liên hệ thành công!</strong> Cảm ơn bạn đã đóng góp ý kiến. Bộ phận CSKH của Web Travel sẽ phản hồi lại bạn sớm nhất có thể.
        </div>
    <?php endif; ?>

    <div class="contact-layout">
        <!-- Contact Info & Map -->
        <div class="contact-info">
            <div>
                <span class="section-tag" style="display: inline-block; margin-bottom: 8px;">Kết Nối Ngay</span>
                <h1 style="font-size: 32px; font-weight: 800; line-height: 1.3; margin-bottom: 15px;">
                    Thông Tin <span>Liên Hệ</span>
                </h1>
                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 25px;">
                    Quý khách cần giải đáp thông tin về tour, thiết kế tour riêng biệt cho gia đình/đoàn thể hoặc gửi phản hồi góp ý dịch vụ. Hãy liên hệ với chúng tôi qua các kênh dưới đây hoặc để lại tin nhắn trong biểu mẫu bên cạnh.
                </p>
            </div>

            <div class="contact-item">
                <div class="contact-icon">🏢</div>
                <div class="contact-text">
                    <h4>Văn Phòng Đại Diện</h4>
                    <p>Tòa nhà Web Travel, 236 Hoàng Quốc Việt, Cổ Nhuế, Bắc Từ Liêm, Hà Nội</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">📞</div>
                <div class="contact-text">
                    <h4>Số Điện Thoại Trợ Giúp</h4>
                    <p>Hotline chính: 094 127 2222 (24/7)<br>Phòng điều hành: 024.3999.8888</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">✉️</div>
                <div class="contact-text">
                    <h4>Thư Điện Tử (Email)</h4>
                    <p>info@webtravel.com - support@webtravel.com</p>
                </div>
            </div>

            <!-- Google Map Iframe (Giả lập bản đồ đẹp mắt Hoàng Quốc Việt Hà Nội) -->
            <div class="map-placeholder">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.6393963493874!2d105.7820120153855!3d21.04710189252445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3b45a8df2f%3A0x86cc93b680c2f82!2zMjM2IEhvw6BuZyBRdeG7kWMgVmnhu4d0LCBD4buVIE5odeG6vywgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1623580000000!5m2!1sen!2s" loading="lazy"></iframe>
            </div>
        </div>

        <!-- Contact Form Card -->
        <div>
            <div class="form-card" style="margin: 0; max-width: 100%;">
                <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 5px;">Gửi Tin Nhắn Cho Chúng Tôi</h3>
                <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 25px;">Hãy điền thông tin và yêu cầu của bạn, chúng tôi sẽ trả lời trong vòng 2 giờ.</p>
                
                <form action="index.php?act=lienhe" method="POST">
                    <div class="form-group">
                        <label for="fullname">Họ và tên của bạn *</label>
                        <input type="text" id="fullname" name="fullname" required placeholder="Ví dụ: Nguyễn Văn A">
                    </div>

                    <div class="form-group">
                        <label for="email">Địa chỉ Email *</label>
                        <input type="email" id="email" name="email" required placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại *</label>
                        <input type="tel" id="phone" name="phone" required placeholder="09xxxxxxx">
                    </div>

                    <div class="form-group">
                        <label for="subject">Chủ đề cần tư vấn *</label>
                        <select id="subject" name="subject" required style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px;">
                            <option value="Tư vấn tour">Tư vấn Tour du lịch</option>
                            <option value="Đặt phòng khách sạn">Đặt phòng Khách sạn</option>
                            <option value="Thiết kế tour riêng">Thiết kế Tour riêng cho đoàn</option>
                            <option value="Hợp tác dịch vụ">Hợp tác đại lý / dịch vụ</option>
                            <option value="Góp ý phản hồi">Phản hồi chất lượng dịch vụ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Nội dung tin nhắn *</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Chi tiết yêu cầu của bạn (Ví dụ: Tôi muốn hỏi tour Hạ Long cho gia đình 4 người vào cuối tuần sau)..." style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; resize: vertical;"></textarea>
                    </div>

                    <button type="submit" name="lienhe_submit" class="btn-form" style="background-color: var(--secondary-color); box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);">Gửi Liên Hệ</button>
                </form>
            </div>
        </div>
    </div>
</div>
