<style>
    .form-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #475569;
    }
    .form-group input, .form-group select, .form-group textarea {
        padding: 11px 14px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #ffffff;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .form-group input::placeholder {
        color: #94a3b8;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        border-top: 1px solid #e2e8f0;
        padding-top: 20px;
        flex-wrap: wrap;
    }
    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }
    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
    }
    .btn-back {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .image-preview-container {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        border: 1px dashed #cbd5e1;
    }
    .preview-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .file-input-custom {
        flex: 1;
        position: relative;
    }
    .file-input-custom input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background: #ffffff;
        font-size: 13px;
    }
    .required-star {
        color: #ef4444;
    }
    .error-msg {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        display: none;
    }
    .input-error {
        border-color: #ef4444 !important;
    }
</style>

<div style="margin-bottom: 25px;">
    <a href="index.php?act=listdk" class="btn-back">
        <span>⬅️</span> Quay Lại Danh Sách
    </a>
</div>

<div class="form-card">
    <?php if (isset($thongbao) && $thongbao != ''): ?>
        <div class="alert alert-success" style="margin-bottom: 25px; border-radius: 8px; border-left: 4px solid #10b981;">
            🎉 <?php echo htmlspecialchars($thongbao); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($loi) && $loi != ''): ?>
        <div class="alert alert-danger" style="margin-bottom: 25px; border-radius: 8px; border-left: 4px solid #ef4444;">
            ⚠️ <?php echo htmlspecialchars($loi); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatedk" method="POST" enctype="multipart/form-data" id="updateTouristForm">
        <!-- Hidden input for ID and old image path -->
        <input type="hidden" name="id" value="<?php echo $dk['id']; ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($dk['image']); ?>">

        <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            👤 Cập Nhật Thông Tin Du Khách #<?php echo $dk['id']; ?>
        </h3>
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Họ và Tên <span class="required-star">*</span></label>
                <input type="text" id="name" name="name" placeholder="Nhập đầy đủ họ và tên..." value="<?php echo htmlspecialchars($dk['name']); ?>">
                <div class="error-msg" id="name_err">Họ tên du khách không được để trống.</div>
            </div>

            <div class="form-group">
                <label for="gender">Giới Tính <span class="required-star">*</span></label>
                <select id="gender" name="gender">
                    <option value="Nam" <?php echo ($dk['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($dk['gender'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthdate">Ngày Sinh (DD/MM/YYYY) <span class="required-star">*</span></label>
                <input type="text" id="birthdate" name="birthdate" placeholder="Ví dụ: 15/08/1995" value="<?php echo htmlspecialchars($dk['birthdate']); ?>">
                <div class="error-msg" id="birthdate_err">Vui lòng nhập ngày sinh.</div>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="nationality">Quốc Tịch <span class="required-star">*</span></label>
                <input type="text" id="nationality" name="nationality" placeholder="Ví dụ: Việt Nam, Mỹ..." value="<?php echo htmlspecialchars($dk['nationality']); ?>">
                <div class="error-msg" id="nationality_err">Vui lòng nhập quốc tịch.</div>
            </div>

            <div class="form-group">
                <label for="passport">Số Hộ Chiếu (Passport) / CCCD</label>
                <input type="text" id="passport" name="passport" placeholder="Nhập số hộ chiếu hoặc CCCD..." value="<?php echo htmlspecialchars($dk['passport']); ?>">
            </div>
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            📞 Thông Tin Liên Hệ
        </h3>

        <div class="form-grid">
            <div class="form-group">
                <label for="email">Địa Chỉ Email <span class="required-star">*</span></label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" value="<?php echo htmlspecialchars($dk['email']); ?>">
                <div class="error-msg" id="email_err">Địa chỉ Email không hợp lệ.</div>
            </div>

            <div class="form-group">
                <label for="phone">Số Điện Thoại <span class="required-star">*</span></label>
                <input type="text" id="phone" name="phone" placeholder="Nhập 10-11 chữ số..." value="<?php echo htmlspecialchars($dk['phone']); ?>">
                <div class="error-msg" id="phone_err">Số điện thoại không hợp lệ (phải gồm 10-11 chữ số).</div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Địa Chỉ Thường Trú</label>
            <input type="text" id="address" name="address" placeholder="Quận/Huyện, Tỉnh/Thành phố..." value="<?php echo htmlspecialchars($dk['address']); ?>">
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            🖼️ Ảnh Đại Diện Hiện Tại
        </h3>

        <div class="form-group">
            <div class="image-preview-container">
                <img src="../<?php echo htmlspecialchars($dk['image']); ?>" alt="Current Avatar" class="preview-avatar" id="avatarPreview" onerror="this.src='../uploads/dukhach1.svg'">
                
                <div class="file-input-custom">
                    <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">Thay đổi ảnh đại diện (Tải lên ảnh mới)</label>
                    <input type="file" id="image" name="image" onchange="previewNewImage(this)">
                    <span style="font-size: 11px; color: #94a3b8; display: block; margin-top: 4px;">Chấp nhận JPG, JPEG, PNG, GIF, SVG. Để trống nếu giữ nguyên ảnh hiện tại.</span>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" name="capnhat" class="btn-submit">
                💾 Cập Nhật Thay Đổi
            </button>
            <a href="index.php?act=listdk" class="btn-back" style="background: #ffffff; border: 1px solid #cbd5e1;">
                Huỷ Bỏ
            </a>
        </div>
    </form>
</div>

<script>
function previewNewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function resetFormErrors() {
    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input').forEach(el => el.classList.remove('input-error'));
}

document.getElementById('updateTouristForm').addEventListener('submit', function(e) {
    let hasError = false;
    
    // Clear old error classes and messages
    resetFormErrors();
    
    // Validate Name
    const name = document.getElementById('name');
    if (!name.value.trim()) {
        name.classList.add('input-error');
        document.getElementById('name_err').style.display = 'block';
        hasError = true;
    }
    
    // Validate Birthdate
    const birthdate = document.getElementById('birthdate');
    if (!birthdate.value.trim()) {
        birthdate.classList.add('input-error');
        document.getElementById('birthdate_err').style.display = 'block';
        hasError = true;
    }
    
    // Validate Nationality
    const nationality = document.getElementById('nationality');
    if (!nationality.value.trim()) {
        nationality.classList.add('input-error');
        document.getElementById('nationality_err').style.display = 'block';
        hasError = true;
    }
    
    // Validate Email
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
        email.classList.add('input-error');
        document.getElementById('email_err').style.display = 'block';
        hasError = true;
    }
    
    // Validate Phone
    const phone = document.getElementById('phone');
    const phoneRegex = /^[0-9]{10,11}$/;
    if (!phone.value.trim() || !phoneRegex.test(phone.value.trim())) {
        phone.classList.add('input-error');
        document.getElementById('phone_err').style.display = 'block';
        hasError = true;
    }
    
    if (hasError) {
        e.preventDefault();
        // Scroll to the first error
        const firstError = document.querySelector('.input-error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    }
});
</script>
