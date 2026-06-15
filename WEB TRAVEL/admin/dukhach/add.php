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
    .btn-reset-form {
        background: #ffffff;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .btn-reset-form:hover {
        background: #f8fafc;
        color: #334155;
    }
    .file-input-wrapper {
        position: relative;
        border: 2px dashed #cbd5e1;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .file-input-wrapper:hover {
        border-color: var(--primary-color);
        background: #eff6ff;
    }
    .file-input-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
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

    <form action="index.php?act=adddk" method="POST" enctype="multipart/form-data" id="addTouristForm">
        <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            👤 Thông Tin Cá Nhân Du Khách
        </h3>
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Họ và Tên <span class="required-star">*</span></label>
                <input type="text" id="name" name="name" placeholder="Nhập đầy đủ họ và tên..." value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                <div class="error-msg" id="name_err">Họ tên du khách không được để trống.</div>
            </div>

            <div class="form-group">
                <label for="gender">Giới Tính <span class="required-star">*</span></label>
                <select id="gender" name="gender">
                    <option value="Nam" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthdate">Ngày Sinh (DD/MM/YYYY) <span class="required-star">*</span></label>
                <input type="text" id="birthdate" name="birthdate" placeholder="Ví dụ: 15/08/1995" value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>">
                <div class="error-msg" id="birthdate_err">Vui lòng nhập ngày sinh.</div>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="nationality">Quốc Tịch <span class="required-star">*</span></label>
                <input type="text" id="nationality" name="nationality" placeholder="Ví dụ: Việt Nam, Mỹ..." value="<?php echo isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : 'Việt Nam'; ?>">
                <div class="error-msg" id="nationality_err">Vui lòng nhập quốc tịch.</div>
            </div>

            <div class="form-group">
                <label for="passport">Số Hộ Chiếu (Passport) / CCCD</label>
                <input type="text" id="passport" name="passport" placeholder="Nhập số hộ chiếu hoặc CCCD..." value="<?php echo isset($_POST['passport']) ? htmlspecialchars($_POST['passport']) : ''; ?>">
            </div>
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            📞 Thông Tin Liên Hệ
        </h3>

        <div class="form-grid">
            <div class="form-group">
                <label for="email">Địa Chỉ Email <span class="required-star">*</span></label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <div class="error-msg" id="email_err">Địa chỉ Email không hợp lệ.</div>
            </div>

            <div class="form-group">
                <label for="phone">Số Điện Thoại <span class="required-star">*</span></label>
                <input type="text" id="phone" name="phone" placeholder="Nhập 10-11 chữ số..." value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                <div class="error-msg" id="phone_err">Số điện thoại không hợp lệ (phải gồm 10-11 chữ số).</div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Địa Chỉ Thường Trú</label>
            <input type="text" id="address" name="address" placeholder="Quận/Huyện, Tỉnh/Thành phố..." value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
        </div>

        <h3 style="margin-top: 30px; margin-bottom: 20px; font-size: 16px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
            🖼️ Ảnh Đại Diện
        </h3>

        <div class="form-group">
            <label>Tải Ảnh Lên</label>
            <div class="file-input-wrapper">
                <span style="font-size: 24px; color: #64748b; display: block; margin-bottom: 8px;">📤</span>
                <span style="font-size: 14px; font-weight: 600; color: #475569; display: block;" id="fileNameDisplay">Nhấp để chọn hoặc kéo thả tệp ảnh vào đây</span>
                <span style="font-size: 12px; color: #94a3b8; display: block; margin-top: 4px;">Chấp nhận JPG, JPEG, PNG, GIF, SVG</span>
                <input type="file" id="image" name="image" onchange="displayFileName(this)">
            </div>
            <div style="margin-top: 8px; font-size: 12px; color: var(--text-muted);">
                * Nếu không chọn ảnh, hệ thống sẽ tự động khởi tạo avatar SVG độc bản dựa trên chữ cái đầu của tên du khách.
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" name="themmoi" class="btn-submit">
                💾 Lưu Hồ Sơ Du Khách
            </button>
            <button type="reset" class="btn-reset-form" onclick="resetFormErrors()">
                🔄 Nhập Lại
            </button>
        </div>
    </form>
</div>

<script>
function displayFileName(input) {
    const display = document.getElementById('fileNameDisplay');
    if (input.files && input.files.length > 0) {
        display.innerText = 'Tệp đã chọn: ' + input.files[0].name;
        display.style.color = '#10b981';
    } else {
        display.innerText = 'Nhấp để chọn hoặc kéo thả tệp ảnh vào đây';
        display.style.color = '#475569';
    }
}

function resetFormErrors() {
    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input').forEach(el => el.classList.remove('input-error'));
    document.getElementById('fileNameDisplay').innerText = 'Nhấp để chọn hoặc kéo thả tệp ảnh vào đây';
    document.getElementById('fileNameDisplay').style.color = '#475569';
}

document.getElementById('addTouristForm').addEventListener('submit', function(e) {
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
