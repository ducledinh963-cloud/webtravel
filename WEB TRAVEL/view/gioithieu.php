<div class="container">
    <!-- Breadcrumbs -->
    <div style="padding: 20px 0 10px; font-size: 14px; color: var(--text-muted);">
        <a href="index.php">Trang Chủ</a> &raquo; <span>Giới Thiệu</span>
    </div>

    <!-- Intro Grid Section -->
    <section class="intro-section">
        <div>
            <span class="section-tag" style="display: inline-block; margin-bottom: 8px;">Về Web Travel</span>
            <h1 style="font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 20px;">
                Đơn Vị Tổ Chức Tour <br><span>Du Lịch Chuyên Nghiệp</span>
            </h1>
            <p style="margin-bottom: 15px; font-size: 15px; color: var(--text-dark);">
                Được thành lập từ năm 2018, <strong>Web Travel</strong> tự hào là một trong những doanh nghiệp lữ hành hàng đầu tại Việt Nam. Chúng tôi không ngừng đổi mới, thiết kế các chương trình du lịch đột phá để đem lại những kỳ nghỉ chất lượng đẳng cấp nhất cho mỗi du khách Việt.
            </p>
            <p style="margin-bottom: 20px; font-size: 14px; color: var(--text-muted);">
                Với mạng lưới đối tác khách sạn 5 sao toàn cầu, đội ngũ hướng dẫn viên giàu kinh nghiệm và hệ thống hỗ trợ khẩn cấp 24/7, chúng tôi luôn bảo đảm mỗi chuyến đi của bạn là một kỳ nghỉ ngập tràn niềm vui, sự an toàn và kỷ niệm đáng giá.
            </p>
            
            <a href="index.php?act=sanpham" class="hero-btn">Khám Phá Tour Ngay</a>
        </div>
        
        <div>
            <!-- Slideshow 16 ảnh du lịch -->
            <div class="intro-slider-container">
                <div class="intro-slider-viewport">
                    <div class="intro-slider-track" id="intro-slider-track">
                        <?php for ($i = 1; $i <= 16; $i++): ?>
                            <div class="intro-slide <?php echo $i === 1 ? 'active' : ''; ?>">
                                <img src="uploads/about<?php echo $i; ?>.png" alt="Du lịch cùng Web Travel <?php echo $i; ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <!-- Nút di chuyển < > -->
                <button class="intro-slider-btn prev" onclick="moveIntroSlide(-1)">&lt;</button>
                <button class="intro-slider-btn next" onclick="moveIntroSlide(1)">&gt;</button>
                
                <!-- Chấm tròn điều hướng -->
                <div class="intro-slider-dots">
                    <?php for ($i = 0; $i < 16; $i++): ?>
                        <span class="intro-dot <?php echo $i === 0 ? 'active' : ''; ?>" onclick="currentIntroSlide(<?php echo $i; ?>)"></span>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section style="margin: 60px 0;">
        <div class="section-title-area">
            <span class="section-tag">Thành Tựu Của Chúng Tôi</span>
            <h2 class="section-title">Những Con Số <span>Ấn Tượng</span></h2>
            <p class="section-desc">Hành trình nỗ lực kiến tạo niềm vui và mang lại giá trị bền vững cho cộng đồng du lịch.</p>
        </div>

        <div class="intro-stats">
            <div class="stat-item">
                <div class="stat-number">15K+</div>
                <div class="stat-label">Khách Hàng Đã Đi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100+</div>
                <div class="stat-label">Hành Trình Độc Đáo</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Phản Hồi Hài Lòng</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">8+</div>
                <div class="stat-label">Năm Kinh Nghiệm</div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section style="margin: 60px 0 30px;">
        <div class="section-title-area">
            <span class="section-tag">Giá Trị Cốt Lõi</span>
            <h2 class="section-title">Vì Sao Chọn <span>Web Travel?</span></h2>
        </div>

        <div class="categories-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
            <div class="category-card" style="text-align: left; padding: 30px 25px;">
                <div class="category-icon" style="margin: 0 0 15px;">🛡️</div>
                <h3 style="font-size: 18px; margin-bottom: 8px;">An Toàn Tuyệt Đối</h3>
                <p style="font-size: 13px; line-height: 1.6;">Tất cả hành trình đều được mua bảo hiểm du lịch hạng thương gia và có điều phối viên theo sát hỗ trợ y tế, lịch trình khẩn cấp.</p>
            </div>

            <div class="category-card" style="text-align: left; padding: 30px 25px;">
                <div class="category-icon" style="margin: 0 0 15px;">💎</div>
                <h3 style="font-size: 18px; margin-bottom: 8px;">Chất Lượng Thượng Hạng</h3>
                <p style="font-size: 13px; line-height: 1.6;">Tuyển chọn hệ thống khách sạn từ 3 - 5 sao đẳng cấp, thực đơn buffet đặc sản địa phương phong phú và xe vận chuyển đời mới êm ái.</p>
            </div>

            <div class="category-card" style="text-align: left; padding: 30px 25px;">
                <div class="category-icon" style="margin: 0 0 15px;">🤝</div>
                <h3 style="font-size: 18px; margin-bottom: 8px;">Dịch Vụ Tận Tâm</h3>
                <p style="font-size: 13px; line-height: 1.6;">Đội ngũ hỗ trợ và tư vấn nhiệt tình, sẵn sàng giải đáp thắc mắc và tùy biến hành trình cá nhân hóa theo yêu cầu riêng của quý khách hàng.</p>
            </div>
        </div>
    </section>
</div>

<style>
/* CSS cho Slideshow 16 ảnh giới thiệu */
.intro-slider-container {
    position: relative;
    width: 100%;
    aspect-ratio: 1.5;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.intro-slider-viewport {
    width: 100%;
    height: 100%;
    position: relative;
}

.intro-slider-track {
    width: 100%;
    height: 100%;
    position: relative;
}

.intro-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 1;
    transform: scale(1.03);
    transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
}

.intro-slide.active {
    opacity: 1;
    z-index: 2;
    transform: scale(1);
}

.intro-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.intro-slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(0, 0, 0, 0.08);
    color: #1e70bf;
    font-size: 16px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.25s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.intro-slider-btn:hover {
    background-color: #1e70bf;
    color: #ffffff;
    border-color: #1e70bf;
    transform: translateY(-50%) scale(1.05);
}

.intro-slider-btn.prev {
    left: 15px;
}

.intro-slider-btn.next {
    right: 15px;
}

.intro-slider-dots {
    position: absolute;
    bottom: 18px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 6px;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.35);
    padding: 6px 12px;
    border-radius: 20px;
    backdrop-filter: blur(4px);
}

.intro-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.45);
    cursor: pointer;
    transition: all 0.25s ease;
}

.intro-dot:hover {
    background-color: rgba(255, 255, 255, 0.85);
}

.intro-dot.active {
    background-color: #38bdf8; /* Màu xanh nước biển đồng bộ */
    transform: scale(1.2);
}

@media (max-width: 768px) {
    .intro-slider-btn {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
}
</style>

<script>
// JS cho Slideshow 16 ảnh trang giới thiệu
let introSlideIndex = 0;
let introSlideTimer = null;

function showIntroSlides(n) {
    const slides = document.querySelectorAll('.intro-slide');
    const dots = document.querySelectorAll('.intro-dot');
    
    if (slides.length === 0) return;
    
    if (n >= slides.length) {
        introSlideIndex = 0;
    } else if (n < 0) {
        introSlideIndex = slides.length - 1;
    } else {
        introSlideIndex = n;
    }
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[introSlideIndex].classList.add('active');
    dots[introSlideIndex].classList.add('active');
    
    resetIntroTimer();
}

function moveIntroSlide(step) {
    showIntroSlides(introSlideIndex + step);
}

function currentIntroSlide(index) {
    showIntroSlides(index);
}

function resetIntroTimer() {
    if (introSlideTimer) {
        clearInterval(introSlideTimer);
    }
    introSlideTimer = setInterval(() => {
        moveIntroSlide(1);
    }, 4000); // Tự động chuyển ảnh sau 4 giây
}

// Bắt đầu chạy tự động
document.addEventListener('DOMContentLoaded', () => {
    resetIntroTimer();
});
</script>
