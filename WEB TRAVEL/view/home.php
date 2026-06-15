<!-- Banner Image Slider -->
<div class="slider-container">
    <div class="slider-wrapper">
        <?php foreach ($list_slides as $key => $slide): ?>
            <div class="slide <?php echo $key === 0 ? 'active' : ''; ?>" style="background-image: url('<?php echo htmlspecialchars($slide['image']); ?>');">
                <div class="container" style="width: 100%;">
                    <div class="hero-content">
                        <span class="hero-tag" style="<?php 
                            if ($key === 1) echo 'background-color: var(--secondary-color);';
                            elseif ($key === 2) echo 'background-color: #10b981;';
                            elseif ($key === 3) echo 'background-color: var(--primary-hover);';
                            elseif ($key > 3) echo 'background-color: #475569;';
                        ?>"><?php echo htmlspecialchars($slide['tag']); ?></span>
                        <h1 class="hero-title"><?php echo $slide['title']; ?><br><?php echo $slide['subtitle']; ?></h1>
                        <p class="hero-desc"><?php echo htmlspecialchars($slide['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($slide['url']); ?>" class="hero-btn"><?php echo htmlspecialchars($slide['btn_text']); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Nút di chuyển ảnh (Prev / Next) -->
    <button class="slider-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
    <button class="slider-btn next-btn" onclick="moveSlide(1)">&#10095;</button>
    
    <!-- Các nút chấm tròn di chuyển (Indicators) -->
    <div class="slider-dots">
        <?php foreach ($list_slides as $key => $slide): ?>
            <span class="dot <?php echo $key === 0 ? 'active' : ''; ?>" onclick="currentSlide(<?php echo $key; ?>)"></span>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
    <!-- Quick Search Form -->
    <div class="search-wrapper">
        <div class="search-box">
            <form action="index.php" method="GET" class="search-form">
                <input type="hidden" name="act" value="sanpham">
                
                <div class="search-input-group">
                    <label for="keyword">Bạn muốn đi đâu?</label>
                    <input type="text" id="keyword" name="keyword" placeholder="Nhập điểm đến, tên tour du lịch...">
                </div>

                <div class="search-input-group">
                    <label for="id_danhmuc">Khu vực</label>
                    <select id="id_danhmuc" name="id_danhmuc">
                        <option value="">-- Chọn danh mục tour --</option>
                        <?php foreach ($list_danhmuc as $dm): ?>
                            <option value="<?php echo $dm['id']; ?>"><?php echo htmlspecialchars($dm['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="search-submit-btn">Tìm Kiếm Tour</button>
            </form>
        </div>
    </div>

    <!-- Bí ẩn thiên nhiên -->
    <section style="margin-bottom: 60px;">
        <h2 style="text-align: center; color: #0f172a; font-size: 24px; font-weight: 700; margin-bottom: 30px; position: relative;">
            Bí ẩn thiên nhiên
        </h2>

        <div style="display: grid; grid-template-columns: 1.8fr 1fr 1fr; gap: 20px; margin-bottom: 25px;">
            <!-- Card lớn bên trái (ID 92) -->
            <?php if (!empty($tour_nature_left)): ?>
                <div style="position: relative; border-radius: 8px; overflow: hidden; height: 380px; box-shadow: var(--card-shadow); border: 1px solid var(--border-color);">
                    <img src="<?php echo htmlspecialchars($tour_nature_left['image']); ?>" alt="<?php echo htmlspecialchars($tour_nature_left['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    
                    <!-- Badge 12 -->
                    <div style="position: absolute; top: 12px; left: 12px; background-color: #dc2626; color: white; padding: 4px 8px; font-size: 13px; font-weight: bold; border-radius: 3px;">
                        12
                    </div>

                    <!-- Overlay Gradient -->
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 70%, rgba(15, 23, 42, 0) 100%); padding: 20px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: flex-end; height: 160px;">
                        <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700; line-height: 1.4;">
                            <a href="index.php?act=sanphamct&id=<?php echo $tour_nature_left['id']; ?>" style="color: white; text-decoration: none;">
                                <?php echo htmlspecialchars($tour_nature_left['name']); ?>
                            </a>
                        </h3>
                        <div style="display: flex; justify-content: space-between; align-items: center; color: #cbd5e1; font-size: 13px;">
                            <span><?php echo htmlspecialchars($tour_nature_left['duration']); ?></span>
                            <div>
                                <span style="text-decoration: line-through; margin-right: 10px; font-size: 12px; color: #94a3b8;"><?php echo number_format($tour_nature_left['price'], 0, ',', '.'); ?> đ</span>
                                <span style="color: #facc15; font-size: 16px; font-weight: 700;"><?php echo number_format($tour_nature_left['price_sale'], 0, ',', '.'); ?> đ</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Card nhỏ ở giữa (ID 93) -->
            <?php if (!empty($tour_nature_right_1)): ?>
                <div style="background-color: #f8fafc; border-radius: 8px; overflow: hidden; height: 380px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: var(--card-shadow); border: 1px solid var(--border-color);">
                    <div style="position: relative; height: 200px; width: 100%;">
                        <img src="<?php echo htmlspecialchars($tour_nature_right_1['image']); ?>" alt="<?php echo htmlspecialchars($tour_nature_right_1['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <!-- Badge giảm giá -->
                        <div style="position: absolute; top: 12px; left: 12px; background-color: #dc2626; color: white; padding: 4px 8px; font-size: 12px; font-weight: bold; border-radius: 3px;">
                            -10%
                        </div>
                    </div>
                    <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <h3 style="margin: 0; font-size: 15px; font-weight: 700; line-height: 1.4; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <a href="index.php?act=sanphamct&id=<?php echo $tour_nature_right_1['id']; ?>" style="color: #1e293b; text-decoration: none;">
                                <?php echo htmlspecialchars($tour_nature_right_1['name']); ?>
                            </a>
                        </h3>
                        
                        <div style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">
                            <?php echo htmlspecialchars($tour_nature_right_1['duration']); ?>
                        </div>

                        <!-- Vehicle Icons -->
                        <div style="margin: 10px 0; display: flex; gap: 5px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #0284c7; color: white; font-size: 12px;">🚌</span>
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #0284c7; color: white; font-size: 12px;">✈️</span>
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #0284c7; color: white; font-size: 12px;">🛳️</span>
                        </div>

                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <span style="text-decoration: line-through; font-size: 12px; color: var(--text-muted);"><?php echo number_format($tour_nature_right_1['price'], 0, ',', '.'); ?> đ</span>
                            <span style="color: #dc2626; font-size: 15px; font-weight: 700;"><?php echo number_format($tour_nature_right_1['price_sale'], 0, ',', '.'); ?> đ</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Card nhỏ bên phải (ID 161) -->
            <?php if (!empty($tour_nature_right_2)): ?>
                <div style="background-color: #f8fafc; border-radius: 8px; overflow: hidden; height: 380px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: var(--card-shadow); border: 1px solid var(--border-color);">
                    <div style="position: relative; height: 200px; width: 100%;">
                        <img src="<?php echo htmlspecialchars($tour_nature_right_2['image']); ?>" alt="<?php echo htmlspecialchars($tour_nature_right_2['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <!-- Badge giảm giá -->
                        <div style="position: absolute; top: 12px; left: 12px; background-color: #dc2626; color: white; padding: 4px 8px; font-size: 12px; font-weight: bold; border-radius: 3px;">
                            -10%
                        </div>
                    </div>
                    <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <h3 style="margin: 0; font-size: 15px; font-weight: 700; line-height: 1.4; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <a href="index.php?act=sanphamct&id=<?php echo $tour_nature_right_2['id']; ?>" style="color: #1e293b; text-decoration: none;">
                                <?php echo htmlspecialchars($tour_nature_right_2['name']); ?>
                            </a>
                        </h3>
                        
                        <div style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">
                            <?php echo htmlspecialchars($tour_nature_right_2['duration']); ?>
                        </div>

                        <!-- Vehicle Icons -->
                        <div style="margin: 10px 0; display: flex; gap: 5px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #0284c7; color: white; font-size: 12px;">🚌</span>
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%; background-color: #0284c7; color: white; font-size: 12px;">✈️</span>
                        </div>

                        <div style="display: flex; align-items: baseline; gap: 8px;">
                            <span style="text-decoration: line-through; font-size: 12px; color: var(--text-muted);"><?php echo number_format($tour_nature_right_2['price'], 0, ',', '.'); ?> đ</span>
                            <span style="color: #dc2626; font-size: 15px; font-weight: 700;"><?php echo number_format($tour_nature_right_2['price_sale'], 0, ',', '.'); ?> đ</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-bottom: 50px;">
            <a href="index.php?act=sanpham" class="hero-btn" style="background-color: #f97316; box-shadow: none; border-radius: 4px; padding: 10px 24px; font-size: 14px; font-weight: bold;">Xem thêm</a>
        </div>
    </section>

    <!-- Địa điểm yêu thích -->
    <section style="margin-bottom: 60px;">
        <h2 style="text-align: center; color: #0f172a; font-size: 24px; font-weight: 700; margin-bottom: 30px;">
            Địa điểm yêu thích
        </h2>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <?php 
            if (!empty($list_diemden)):
                $index = 0;
                foreach ($list_diemden as $dd):
                    $index++;
                    // Divider between Row 1 and Row 2
                    if ($index === 5):
            ?>
                <div style="grid-column: 1 / -1; border-top: 1px dashed #cbd5e1; margin: 10px 0;"></div>
            <?php 
                    endif;
            ?>
                <a href="index.php?act=sanpham&keyword=<?php echo urlencode($dd['name']); ?>" class="destination-card" style="position: relative; border-radius: 8px; overflow: hidden; height: 160px; display: block; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); transition: var(--transition-speed);">
                    <img src="<?php echo htmlspecialchars($dd['image']); ?>" alt="<?php echo htmlspecialchars($dd['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;" onerror="this.src='https://placehold.co/600x400?text=Destination'">
                    <div class="destination-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.45); display: flex; align-items: center; justify-content: center; transition: var(--transition-speed);">
                        <h3 style="color: var(--white); font-size: 16px; font-weight: 700; text-align: center; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6); padding: 0 10px; margin: 0;"><?php echo htmlspecialchars($dd['name']); ?></h3>
                    </div>
                </a>
            <?php 
                endforeach;
            endif;
            ?>
        </div>
    </section>

    <!-- Tour Section (Sản phẩm) -->
    <section style="margin-bottom: 60px;">
        <div class="section-title-area">
            <span class="section-tag">Lựa Chọn Hoàn Hảo</span>
            <h2 class="section-title">Tour Nổi Bật <span>Đang Diễn Ra</span></h2>
            <p class="section-desc">Danh sách những tour du lịch được yêu thích nhất, chất lượng dịch vụ xuất sắc kèm ưu đãi cực lớn.</p>
        </div>

        <div class="tour-section-layout">
            <!-- Sidebar Trái -->
            <aside class="tour-section-sidebar">
                <div>
                    <div class="hotel-sidebar-header">DANH MỤC TOUR</div>
                    <ul class="hotel-sidebar-list">
                        <?php foreach ($list_danhmuc as $dm): ?>
                            <li>
                                <a href="index.php?act=sanpham&id_danhmuc=<?php echo $dm['id']; ?>">
                                    <span class="location-marker">✈️</span> <?php echo htmlspecialchars($dm['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Banner quảng cáo Ninh Chữ (CSDL) -->
                <div class="ad-banner">
                    <?php if (!empty($sidebar_banner)): 
                        $ad = $sidebar_banner[0];
                    ?>
                        <a href="<?php echo htmlspecialchars($ad['url']); ?>">
                            <img src="<?php echo htmlspecialchars($ad['image']); ?>" alt="<?php echo htmlspecialchars($ad['name']); ?>" onerror="this.src='https://placehold.co/300x480?text=Tour+Ad'">
                        </a>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Lưới Tour bên phải -->
            <main>
                <div class="tour-section-grid">
                    <?php 
                    if (empty($list_sanpham_home)) {
                        echo '<p style="text-align: center; grid-column: 1/-1; color: var(--text-muted);">Không có tour nào để hiển thị.</p>';
                    } else {
                        foreach ($list_sanpham_home as $sp):
                    ?>
                        <div class="tour-card-new">
                            <div class="tour-img-wrapper-new">
                                <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Du+Lich'">
                            </div>
                            
                            <div class="tour-body-new">
                                <h3 class="tour-title-new">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>"><?php echo htmlspecialchars($sp['name']); ?></a>
                                </h3>
                                
                                <div class="tour-duration-new">
                                    <span>🕒</span> <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <div class="tour-price-new">
                                    <?php echo number_format($sp['price']); ?> đồng
                                </div>
                                
                                <form action="index.php?act=addtocart" method="POST" style="margin: 0; width: 100%;">
                                    <input type="hidden" name="id" value="<?php echo $sp['id']; ?>">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($sp['name']); ?>">
                                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($sp['image']); ?>">
                                    <input type="hidden" name="price" value="<?php echo $sp['price']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" name="addtocart" class="btn-tour-book-new" style="cursor: pointer; border: none; font-weight: 700; width: 100%;">Đặt Tour</button>
                                </form>
                            </div>
                        </div>
                    <?php 
                        endforeach; 
                    }
                    ?>
                </div>
            </main>
        </div>

        <div style="text-align: center; margin-bottom: 50px;">
            <a href="index.php?act=sanpham" class="hero-btn" style="background-color: var(--text-dark); box-shadow: none;">Xem Tất Cả Tour</a>
        </div>
    </section>

    <!-- Khu Vực Khách Sạn Hot (Hot Hotels) -->
    <section style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 50px;">
        <div class="hotel-section-layout">
            <!-- Sidebar Trái -->
            <aside class="hotel-sidebar-wrapper">
                <div>
                    <div class="hotel-sidebar-header">Khách Sạn Hot</div>
                    <ul class="hotel-sidebar-list">
                        <?php foreach ($list_locations_home as $loc): ?>
                            <li>
                                <a href="index.php?act=khachsan&location=<?php echo urlencode($loc['location']); ?>">
                                    <span class="location-marker">📍</span> Khách sạn <?php echo htmlspecialchars($loc['location']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <!-- Đảm bảo có đầy đủ các địa điểm theo hình mẫu nếu DB chưa load hết -->
                        <?php 
                        $default_locations = ["Hà Giang", "Hạ Long", "Hà Nội", "miền Bắc", "miền Nam", "Nha Trang", "Ninh Bình", "Phú Quốc", "Sapa"];
                        $existing_locs = array_column($list_locations_home, 'location');
                        foreach ($default_locations as $dl):
                            if (!in_array($dl, $existing_locs)):
                        ?>
                            <li>
                                <a href="index.php?act=khachsan&location=<?php echo urlencode($dl); ?>">
                                    <span class="location-marker">📍</span> Khách sạn <?php echo htmlspecialchars($dl); ?>
                                </a>
                            </li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>

                <!-- Banner quảng cáo Ninh Chữ -->
                <div class="ad-banner">
                    <a href="#">
                        <img src="uploads/ninhchu_ad.jpg" alt="Tour du lịch Ninh Chữ" onerror="this.src='https://placehold.co/300x480?text=Tour+Ninh+Chu'">
                    </a>
                </div>
            </aside>

            <!-- Lưới Khách sạn bên phải -->
            <main>
                <div class="hotel-grid">
                    <?php foreach ($list_khachsan_home as $ks): ?>
                        <div class="hotel-card">
                            <div class="hotel-img-wrapper">
                                <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Hotel'">
                            </div>
                            
                            <div class="hotel-body">
                                <h3 class="hotel-name"><?php echo htmlspecialchars($ks['name']); ?></h3>
                                
                                <div class="hotel-address">
                                    <span style="color: var(--secondary-color);">📍</span> <?php echo htmlspecialchars($ks['address']); ?>
                                </div>
                                
                                <div class="hotel-stars">
                                    <?php 
                                    $stars_count = $ks['stars'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $stars_count) {
                                            echo '★';
                                        } else {
                                            echo '☆';
                                        }
                                    }
                                    ?>
                                </div>
                                
                                <div class="hotel-price">
                                    <?php echo number_format($ks['price']); ?> đồng
                                </div>
                                
                                <button class="btn-hotel-book" onclick="alert('Cảm ơn bạn đã quan tâm! Bộ phận đặt phòng của Web Travel sẽ liên hệ lại với bạn.')">Đặt Phòng</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </section>

    <!-- Banner Khuyến Mãi Kép -->
    <style>
        .promo-banners-section {
            margin-bottom: 50px;
            position: relative;
        }
        .promo-carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }
        .promo-carousel-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: transform;
        }
        .promo-slide {
            flex: 0 0 100%;
            max-width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            box-sizing: border-box;
            padding: 5px;
        }
        .promo-banner-item {
            display: block;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .promo-banner-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .promo-banner-item img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            border-radius: 12px;
        }
        .promo-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.4);
            color: #ffffff;
            border: none;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.2s ease;
        }
        .promo-nav-btn:hover {
            background: rgba(0, 0, 0, 0.7);
            transform: translateY(-50%) scale(1.1);
        }
        .promo-nav-btn.prev {
            left: 15px;
        }
        .promo-nav-btn.next {
            right: 15px;
        }
        
        @media (max-width: 768px) {
            .promo-slide {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .promo-nav-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
        }
    </style>

    <section class="promo-banners-section">
        <div class="promo-carousel-container">
            <div class="promo-carousel-track" id="promo-carousel-track">
                <?php 
                // Group the promo list into pairs of 2 banners
                $promo_pairs = array_chunk($list_promo, 2);
                foreach ($promo_pairs as $pair): 
                ?>
                    <div class="promo-slide">
                        <?php foreach ($pair as $promo): ?>
                            <a href="<?php echo htmlspecialchars($promo['url']); ?>" class="promo-banner-item">
                                <img src="<?php echo htmlspecialchars($promo['image']); ?>" alt="<?php echo htmlspecialchars($promo['title']); ?>" onerror="this.src='https://placehold.co/600x200?text=Promo+Banner'">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation buttons overlayed on the sides -->
        <?php if (count($promo_pairs) > 1): ?>
            <button class="promo-nav-btn prev" onclick="slidePromoPrev()">❮</button>
            <button class="promo-nav-btn next" onclick="slidePromoNext()">❯</button>
        <?php endif; ?>
    </section>

    <script>
    let promoCurrentIndex = 0;
    const totalPromoSlides = <?php echo count($promo_pairs); ?>;

    function updatePromoSlider() {
        const track = document.getElementById('promo-carousel-track');
        if (!track) return;
        const moveAmount = promoCurrentIndex * 100;
        track.style.transform = `translateX(-${moveAmount}%)`;
    }

    function slidePromoPrev() {
        if (promoCurrentIndex > 0) {
            promoCurrentIndex--;
        } else {
            promoCurrentIndex = totalPromoSlides - 1;
        }
        updatePromoSlider();
    }

    function slidePromoNext() {
        if (promoCurrentIndex < totalPromoSlides - 1) {
            promoCurrentIndex++;
        } else {
            promoCurrentIndex = 0;
        }
        updatePromoSlider();
    }
    </script>

    <!-- Kinh Nghiệm Du Lịch (News Section) -->
    <section class="news-section">
        <div class="news-header">KINH NGHIỆM DU LỊCH</div>
        <div class="news-grid">
            <?php foreach (array_slice($list_tintuc, 0, 3) as $tt): ?>
                <div class="news-card">
                    <div class="news-img-wrapper">
                        <img src="<?php echo htmlspecialchars($tt['image']); ?>" alt="<?php echo htmlspecialchars($tt['title']); ?>" onerror="this.src='https://placehold.co/600x400?text=News'">
                    </div>
                    <div class="news-body">
                        <h3 class="news-title"><?php echo htmlspecialchars($tt['title']); ?></h3>
                        <p class="news-desc"><?php echo htmlspecialchars($tt['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Gallery Slider Section (20 hình ảnh) -->
    <section class="gallery-slider-section" style="margin-bottom: 55px; margin-top: 30px;">
        <div class="section-title-area">
            <h2 class="section-title">Kho Ảnh Khám Phá <span>Web Travel</span></h2>
        </div>

        <div class="gallery-slider-container">
            <div class="gallery-slider-wrapper">
                <?php for ($i = 1; $i <= 20; $i++): ?>
                    <div class="gallery-slide <?php echo $i === 1 ? 'active' : ''; ?>" style="background-image: url('uploads/gallery<?php echo $i; ?>.jpg');">
                        <div class="gallery-slide-caption">Khoảnh Khắc Du Lịch - Hình Ảnh <?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Nút di chuyển ảnh < > -->
            <button class="gallery-slider-btn prev-gallery-btn" onclick="moveGallerySlide(-1)">&lt;</button>
            <button class="gallery-slider-btn next-gallery-btn" onclick="moveGallerySlide(1)">&gt;</button>

            <!-- Các nút chấm tròn di chuyển (20 dots) -->
            <div class="gallery-slider-dots">
                <?php for ($i = 1; $i <= 20; $i++): ?>
                    <span class="gallery-dot <?php echo $i === 1 ? 'active' : ''; ?>" onclick="currentGallerySlide(<?php echo $i - 1; ?>)"></span>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- New Featured Tours Carousel Section -->
    <style>
        .featured-tour-card {
            flex: 0 0 calc(25% - 15px);
            min-width: 250px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .featured-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .featured-tour-img-wrapper {
            position: relative;
            aspect-ratio: 4/3;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .featured-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .featured-tour-card:hover .featured-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .featured-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .featured-tour-info {
            padding: 15px 12px;
            background: #f1f5f9;
            margin-top: 10px;
            border-radius: 2px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .featured-tour-category {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            font-family: 'Outfit', sans-serif;
        }
        .featured-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 58px;
            font-family: 'Outfit', sans-serif;
        }
        .featured-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .featured-tour-title a:hover {
            color: #1e70bf;
        }
        .featured-tour-prices {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: auto;
        }
        .featured-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .featured-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }

        @media (max-width: 1024px) {
            .featured-tour-card {
                flex: 0 0 calc(33.333% - 14px);
            }
        }
        @media (max-width: 768px) {
            .featured-tour-card {
                flex: 0 0 calc(50% - 10px);
            }
        }
        @media (max-width: 480px) {
            .featured-tour-card {
                flex: 0 0 100%;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 25px; position: relative;">
        <!-- Title area with spiky NEW starburst SVG badges -->
        <div style="text-align: center; margin-bottom: 30px; display: flex; align-items: center; justify-content: center; gap: 12px;">
            <svg viewBox="0 0 100 100" width="38" height="38" style="display: inline-block; vertical-align: middle;">
                <polygon points="50,0 60,15 77,9 77,27 94,27 88,44 100,50 88,56 94,73 77,73 77,91 60,85 50,100 40,85 23,91 23,73 6,73 12,56 0,50 12,44 6,27 23,27 23,9 40,15" fill="#ef4444" />
                <text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-size="19" font-weight="900" font-family="system-ui, -apple-system, sans-serif">NEW</text>
            </svg>
            <h2 style="font-size: 26px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', 'Inter', sans-serif;">Tour Nổi Bật</h2>
            <svg viewBox="0 0 100 100" width="38" height="38" style="display: inline-block; vertical-align: middle;">
                <polygon points="50,0 60,15 77,9 77,27 94,27 88,44 100,50 88,56 94,73 77,73 77,91 60,85 50,100 40,85 23,91 23,73 6,73 12,56 0,50 12,44 6,27 23,27 23,9 40,15" fill="#ef4444" />
                <text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-size="19" font-weight="900" font-family="system-ui, -apple-system, sans-serif">NEW</text>
            </svg>
        </div>

        <div style="position: relative; padding: 0 45px;">
            <!-- Prev Arrow -->
            <button onclick="slideFeaturedTours(-1)" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #475569; cursor: pointer; transition: all 0.2s; z-index: 10;" onmouseover="this.style.borderColor='#1e70bf'; this.style.color='#1e70bf';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
                &#10094;
            </button>
            
            <!-- Next Arrow -->
            <button onclick="slideFeaturedTours(1)" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #475569; cursor: pointer; transition: all 0.2s; z-index: 10;" onmouseover="this.style.borderColor='#1e70bf'; this.style.color='#1e70bf';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
                &#10095;
            </button>

            <!-- Carousel Viewport -->
            <div style="overflow: hidden; width: 100%;">
                <!-- Carousel Track -->
                <div id="featured-tours-track" style="display: flex; gap: 20px; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;">
                    <?php if (!empty($list_tour_noibat)): ?>
                        <?php foreach ($list_tour_noibat as $sp): ?>
                            <!-- Card -->
                            <div class="featured-tour-card">
                                <!-- Image with discount badge -->
                                <div class="featured-tour-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Du+Lich'">
                                    
                                    <!-- Discount percentage badge -->
                                    <?php 
                                    $discount_pct = 16;
                                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                                    }
                                    ?>
                                    <div class="featured-tour-discount">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                </div>
                                
                                <!-- Card content box -->
                                <div class="featured-tour-info">
                                    <div>
                                        <!-- Category -->
                                        <div class="featured-tour-category">
                                            <?php echo htmlspecialchars($sp['ten_danhmuc']); ?>
                                        </div>
                                        
                                        <!-- Title -->
                                        <h3 class="featured-tour-title">
                                            <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>">
                                                <?php echo htmlspecialchars($sp['name']); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    
                                    <!-- Prices & Booking -->
                                    <div class="featured-tour-prices">
                                        <span class="featured-tour-price-old">
                                            <?php echo number_format($sp['price']); ?> đ
                                        </span>
                                        <span class="featured-tour-price-sale">
                                            <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Carousel script -->
    <script>
    let featuredTourIndex = 0;
    function slideFeaturedTours(direction) {
        const track = document.getElementById('featured-tours-track');
        const cards = document.querySelectorAll('.featured-tour-card');
        if (!track || cards.length === 0) return;
        
        const cardWidth = cards[0].getBoundingClientRect().width + 20; // Width + 20px gap
        const containerWidth = track.parentElement.getBoundingClientRect().width;
        const visibleCards = Math.max(1, Math.floor((containerWidth + 20) / cardWidth));
        const maxIndex = Math.max(0, cards.length - visibleCards);
        
        featuredTourIndex += direction;
        if (featuredTourIndex < 0) {
            featuredTourIndex = maxIndex;
        } else if (featuredTourIndex > maxIndex) {
            featuredTourIndex = 0;
        }
        
        track.style.transform = `translateX(-${featuredTourIndex * cardWidth}px)`;
    }
    // Resize handler to reset position
    window.addEventListener('resize', () => {
        const track = document.getElementById('featured-tours-track');
        if (track) {
            featuredTourIndex = 0;
            track.style.transform = 'translateX(0)';
        }
    });
    </script>

    <!-- New Featured Hotels Section (Khách Sạn) -->
    <style>
        .featured-hotel-card {
            flex: 0 0 calc(25% - 15px);
            min-width: 250px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .featured-hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .featured-hotel-img-wrapper {
            position: relative;
            aspect-ratio: 4/3;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .featured-hotel-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .featured-hotel-card:hover .featured-hotel-img-wrapper img {
            transform: scale(1.05);
        }
        .featured-hotel-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .featured-hotel-info {
            padding: 15px 12px;
            background: #f1f5f9;
            margin-top: 10px;
            border-radius: 2px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .featured-hotel-category {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            font-family: 'Outfit', sans-serif;
        }
        .featured-hotel-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 58px;
            font-family: 'Outfit', sans-serif;
        }
        .featured-hotel-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .featured-hotel-title a:hover {
            color: #1e70bf;
        }
        .featured-hotel-prices {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: auto;
        }
        .featured-hotel-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .featured-hotel-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }

        .hotel-tab-btn {
            padding: 8px 22px;
            font-size: 13.5px;
            font-weight: 700;
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            outline: none;
        }
        .hotel-tab-btn:hover {
            background-color: #e2e8f0;
            color: #1e70bf;
        }
        .hotel-tab-btn.active {
            background-color: #1e70bf;
            color: #ffffff;
            border-color: #1e70bf;
            box-shadow: 0 4px 12px rgba(30, 112, 191, 0.2);
        }

        @media (max-width: 1024px) {
            .featured-hotel-card {
                flex: 0 0 calc(33.333% - 14px);
            }
        }
        @media (max-width: 768px) {
            .featured-hotel-card {
                flex: 0 0 calc(50% - 10px);
            }
        }
        @media (max-width: 480px) {
            .featured-hotel-card {
                flex: 0 0 100%;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 25px; position: relative;">
        <!-- Title area -->
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 id="hotel-section-title" style="font-size: 26px; font-weight: 800; color: #1e70bf; margin: 0 0 15px 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', 'Inter', sans-serif;">Khách Sạn Miền Bắc</h2>
        </div>

        <!-- Filter Tab Buttons -->
        <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 30px;">
            <button onclick="switchHotelTab('bac')" id="tab-btn-bac" class="hotel-tab-btn active">Miền Bắc</button>
            <button onclick="switchHotelTab('trung')" id="tab-btn-trung" class="hotel-tab-btn">Miền Trung</button>
            <button onclick="switchHotelTab('nam')" id="tab-btn-nam" class="hotel-tab-btn">Miền Nam</button>
            <button onclick="switchHotelTab('nuocngoai')" id="tab-btn-nuocngoai" class="hotel-tab-btn">Nước Ngoài</button>
        </div>

        <div style="position: relative; padding: 0 45px;">
            <!-- Prev Arrow -->
            <button onclick="slideFeaturedHotels(-1)" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #475569; cursor: pointer; transition: all 0.2s; z-index: 10;" onmouseover="this.style.borderColor='#1e70bf'; this.style.color='#1e70bf';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
                &#10094;
            </button>
            
            <!-- Next Arrow -->
            <button onclick="slideFeaturedHotels(1)" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: center; font-size: 16px; color: #475569; cursor: pointer; transition: all 0.2s; z-index: 10;" onmouseover="this.style.borderColor='#1e70bf'; this.style.color='#1e70bf';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
                &#10095;
            </button>

            <!-- Carousel Viewport -->
            <div style="overflow: hidden; width: 100%;">
                <!-- Carousel Track for Miền Bắc -->
                <div id="featured-hotels-track-bac" class="featured-hotels-track" style="display: flex; gap: 20px; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;">
                    <?php if (!empty($list_khachsan_bac)): ?>
                        <?php foreach ($list_khachsan_bac as $ks): ?>
                            <!-- Card -->
                            <div class="featured-hotel-card">
                                <div class="featured-hotel-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Khach+San'">
                                    <?php 
                                    $discount_pct = 10;
                                    if ($ks['price'] > 0 && $ks['price_sale'] > 0) {
                                        $discount_pct = round((($ks['price'] - $ks['price_sale']) / $ks['price']) * 100);
                                    }
                                    ?>
                                    <div class="featured-hotel-discount">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                </div>
                                <div class="featured-hotel-info">
                                    <div>
                                        <div class="featured-hotel-category">
                                            <?php echo htmlspecialchars($ks['category']); ?>
                                        </div>
                                        <h3 class="featured-hotel-title">
                                            <a href="index.php?act=khachsanct&id=<?php echo $ks['id']; ?>">
                                                <?php echo htmlspecialchars($ks['name']); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="featured-hotel-prices">
                                        <span class="featured-hotel-price-old">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                        <span class="featured-hotel-price-sale">
                                            <?php echo number_format($ks['price_sale'] > 0 ? $ks['price_sale'] : $ks['price']); ?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Carousel Track for Miền Trung -->
                <div id="featured-hotels-track-trung" class="featured-hotels-track" style="display: none; gap: 20px; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;">
                    <?php if (!empty($list_khachsan_trung)): ?>
                        <?php foreach ($list_khachsan_trung as $ks): ?>
                            <!-- Card -->
                            <div class="featured-hotel-card">
                                <div class="featured-hotel-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Khach+San'">
                                    <?php 
                                    $discount_pct = 10;
                                    if ($ks['price'] > 0 && $ks['price_sale'] > 0) {
                                        $discount_pct = round((($ks['price'] - $ks['price_sale']) / $ks['price']) * 100);
                                    }
                                    ?>
                                    <div class="featured-hotel-discount">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                </div>
                                <div class="featured-hotel-info">
                                    <div>
                                        <div class="featured-hotel-category">
                                            <?php echo htmlspecialchars($ks['category']); ?>
                                        </div>
                                        <h3 class="featured-hotel-title">
                                            <a href="index.php?act=khachsanct&id=<?php echo $ks['id']; ?>">
                                                <?php echo htmlspecialchars($ks['name']); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="featured-hotel-prices">
                                        <span class="featured-hotel-price-old">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                        <span class="featured-hotel-price-sale">
                                            <?php echo number_format($ks['price_sale'] > 0 ? $ks['price_sale'] : $ks['price']); ?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Carousel Track for Miền Nam -->
                <div id="featured-hotels-track-nam" class="featured-hotels-track" style="display: none; gap: 20px; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;">
                    <?php if (!empty($list_khachsan_nam)): ?>
                        <?php foreach ($list_khachsan_nam as $ks): ?>
                            <!-- Card -->
                            <div class="featured-hotel-card">
                                <div class="featured-hotel-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Khach+San'">
                                    <?php 
                                    $discount_pct = 10;
                                    if ($ks['price'] > 0 && $ks['price_sale'] > 0) {
                                        $discount_pct = round((($ks['price'] - $ks['price_sale']) / $ks['price']) * 100);
                                    }
                                    ?>
                                    <div class="featured-hotel-discount">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                </div>
                                <div class="featured-hotel-info">
                                    <div>
                                        <div class="featured-hotel-category">
                                            <?php echo htmlspecialchars($ks['category']); ?>
                                        </div>
                                        <h3 class="featured-hotel-title">
                                            <a href="index.php?act=khachsanct&id=<?php echo $ks['id']; ?>">
                                                <?php echo htmlspecialchars($ks['name']); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="featured-hotel-prices">
                                        <span class="featured-hotel-price-old">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                        <span class="featured-hotel-price-sale">
                                            <?php echo number_format($ks['price_sale'] > 0 ? $ks['price_sale'] : $ks['price']); ?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Carousel Track for Nước Ngoài -->
                <div id="featured-hotels-track-nuocngoai" class="featured-hotels-track" style="display: none; gap: 20px; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); width: 100%;">
                    <?php if (!empty($list_khachsan_nuocngoai)): ?>
                        <?php foreach ($list_khachsan_nuocngoai as $ks): ?>
                            <!-- Card -->
                            <div class="featured-hotel-card">
                                <div class="featured-hotel-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Khach+San'">
                                    <?php 
                                    $discount_pct = 10;
                                    if ($ks['price'] > 0 && $ks['price_sale'] > 0) {
                                        $discount_pct = round((($ks['price'] - $ks['price_sale']) / $ks['price']) * 100);
                                    }
                                    ?>
                                    <div class="featured-hotel-discount">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                </div>
                                <div class="featured-hotel-info">
                                    <div>
                                        <div class="featured-hotel-category">
                                            <?php echo htmlspecialchars($ks['category']); ?>
                                        </div>
                                        <h3 class="featured-hotel-title">
                                            <a href="index.php?act=khachsanct&id=<?php echo $ks['id']; ?>">
                                                <?php echo htmlspecialchars($ks['name']); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="featured-hotel-prices">
                                        <span class="featured-hotel-price-old">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                        <span class="featured-hotel-price-sale">
                                            <?php echo number_format($ks['price_sale'] > 0 ? $ks['price_sale'] : $ks['price']); ?> đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Hotel Carousel script -->
    <script>
    let currentHotelRegion = 'bac';
    let featuredHotelIndex = {
        bac: 0,
        trung: 0,
        nam: 0,
        nuocngoai: 0
    };

    function slideFeaturedHotels(direction) {
        const track = document.getElementById(`featured-hotels-track-${currentHotelRegion}`);
        if (!track) return;
        const cards = track.querySelectorAll('.featured-hotel-card');
        if (cards.length === 0) return;
        
        const cardWidth = cards[0].getBoundingClientRect().width + 20; // Width + 20px gap
        const containerWidth = track.parentElement.getBoundingClientRect().width;
        const visibleCards = Math.max(1, Math.floor((containerWidth + 20) / cardWidth));
        const maxIndex = Math.max(0, cards.length - visibleCards);
        
        let index = featuredHotelIndex[currentHotelRegion] + direction;
        if (index < 0) {
            index = maxIndex;
        } else if (index > maxIndex) {
            index = 0;
        }
        
        featuredHotelIndex[currentHotelRegion] = index;
        track.style.transform = `translateX(-${index * cardWidth}px)`;
    }

    function switchHotelTab(region) {
        // Update Title
        const titleEl = document.getElementById('hotel-section-title');
        if (titleEl) {
            if (region === 'bac') titleEl.innerText = 'Khách Sạn Miền Bắc';
            else if (region === 'trung') titleEl.innerText = 'Khách Sạn Miền Trung';
            else if (region === 'nam') titleEl.innerText = 'Khách Sạn Miền Nam';
            else if (region === 'nuocngoai') titleEl.innerText = 'Khách Sạn Nước Ngoài';
        }

        // Update active tab button
        document.querySelectorAll('.hotel-tab-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById(`tab-btn-${region}`).classList.add('active');

        // Hide all tracks and show the active one
        document.querySelectorAll('.featured-hotels-track').forEach(track => {
            track.style.display = 'none';
        });
        
        const activeTrack = document.getElementById(`featured-hotels-track-${region}`);
        if (activeTrack) {
            activeTrack.style.display = 'flex';
            // Reset position
            featuredHotelIndex[region] = 0;
            activeTrack.style.transform = 'translateX(0)';
        }

        currentHotelRegion = region;
    }

    // Resize handler to reset position
    window.addEventListener('resize', () => {
        document.querySelectorAll('.featured-hotels-track').forEach(track => {
            track.style.transform = 'translateX(0)';
        });
        featuredHotelIndex = { bac: 0, trung: 0, nam: 0, nuocngoai: 0 };
    });
    </script>

    <!-- Châu Âu Tours Grid Section -->
    <style>
        .europe-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .europe-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .europe-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .europe-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .europe-tour-card:hover .europe-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .europe-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .europe-tour-info {
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .europe-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            font-family: 'Outfit', sans-serif;
        }
        .europe-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .europe-tour-title a:hover {
            color: #1e70bf;
        }
        .europe-tour-duration {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
        }
        .europe-tour-transport {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
        }
        .europe-tour-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
        }
        .europe-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .europe-tour-prices {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }
        .europe-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .europe-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }
        .europe-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 32px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .europe-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .europe-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .europe-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .europe-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .europe-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Châu Âu" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Châu Âu</h2>
        </div>

        <div class="europe-tours-grid">
            <?php if (!empty($list_tour_europe)): ?>
                <?php foreach ($list_tour_europe as $index => $sp): ?>
                    <?php 
                    // Calculate discount pct
                    $discount_pct = 10;
                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                    }
                    ?>
                    <!-- Card -->
                    <div class="europe-tour-card">
                        <!-- Image with discount badge -->
                        <div class="europe-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Chau+Au'">
                            <div class="europe-tour-discount">
                                -<?php echo $discount_pct; ?>%
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="europe-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="europe-tour-title">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>">
                                        <?php echo htmlspecialchars($sp['name']); ?>
                                    </a>
                                </h3>
                                
                                <!-- Duration -->
                                <div class="europe-tour-duration">
                                    <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <!-- Transport icons matching screenshot -->
                                <div class="europe-tour-transport">
                                    <span class="europe-tour-icon" title="Xe du lịch đời mới">🚌</span>
                                    <span class="europe-tour-icon" title="Vé máy bay khứ hồi">✈️</span>
                                    <?php if (in_array($index, [0, 1, 3, 5])): ?>
                                        <span class="europe-tour-icon" title="Dạo thuyền / Du thuyền">🚢</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="europe-tour-separator"></div>
                            
                            <!-- Prices -->
                            <div class="europe-tour-prices">
                                <span class="europe-tour-price-old">
                                    <?php echo number_format($sp['price']); ?> đ
                                </span>
                                <span class="europe-tour-price-sale">
                                    <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php?act=sanpham&id_danhmuc=6" class="europe-btn-more">Xem thêm</a>
        </div>
    </section>

    <!-- Châu Á Tours Grid Section -->
    <style>
        .asia-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .asia-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .asia-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .asia-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .asia-tour-card:hover .asia-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .asia-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .asia-tour-info {
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .asia-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            font-family: 'Outfit', sans-serif;
        }
        .asia-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .asia-tour-title a:hover {
            color: #1e70bf;
        }
        .asia-tour-duration {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
        }
        .asia-tour-transport {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
            min-height: 24px;
        }
        .asia-tour-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
        }
        .asia-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .asia-tour-prices {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }
        .asia-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .asia-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }
        .asia-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 32px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .asia-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .asia-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .asia-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .asia-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .asia-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Châu Á" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Châu Á</h2>
        </div>

        <div class="asia-tours-grid">
            <?php if (!empty($list_tour_asia)): ?>
                <?php foreach ($list_tour_asia as $index => $sp): ?>
                    <?php 
                    // Calculate discount pct
                    $discount_pct = 10;
                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                    }
                    ?>
                    <!-- Card -->
                    <div class="asia-tour-card">
                        <!-- Image with discount badge -->
                        <div class="asia-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Chau+A'">
                            <div class="asia-tour-discount">
                                -<?php echo $discount_pct; ?>%
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="asia-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="asia-tour-title">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>">
                                        <?php echo htmlspecialchars($sp['name']); ?>
                                    </a>
                                </h3>
                                
                                <!-- Duration -->
                                <div class="asia-tour-duration">
                                    <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <!-- Transport icons matching screenshot -->
                                <div class="asia-tour-transport">
                                    <?php if ($index !== 1): // Card 2 has no transport icons ?>
                                        <span class="asia-tour-icon" title="Xe du lịch đời mới">🚌</span>
                                        <?php if ($index !== 0): // Card 1 has only bus, others have both bus and plane ?>
                                            <span class="asia-tour-icon" title="Vé máy bay khứ hồi">✈️</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="asia-tour-separator"></div>
                            
                            <!-- Prices -->
                            <div class="asia-tour-prices">
                                <span class="asia-tour-price-old">
                                    <?php echo number_format($sp['price']); ?> đ
                                </span>
                                <span class="asia-tour-price-sale">
                                    <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php?act=sanpham&id_danhmuc=5" class="asia-btn-more">Xem thêm</a>
        </div>
    </section>

    <!-- Nhật Bản Tours Grid Section -->
    <style>
        .japan-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .japan-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .japan-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .japan-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .japan-tour-card:hover .japan-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .japan-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .japan-tour-info {
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .japan-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            font-family: 'Outfit', sans-serif;
        }
        .japan-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .japan-tour-title a:hover {
            color: #1e70bf;
        }
        .japan-tour-duration {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
        }
        .japan-tour-transport {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
            min-height: 24px;
        }
        .japan-tour-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
        }
        .japan-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .japan-tour-prices {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }
        .japan-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .japan-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }
        .japan-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 32px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .japan-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .japan-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .hidden-japan-card {
            display: none !important;
        }
        @media (max-width: 1024px) {
            .japan-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .japan-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .japan-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Nhật Bản" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Nhật Bản</h2>
        </div>

        <div class="japan-tours-grid">
            <?php if (!empty($list_tour_japan)): ?>
                <?php foreach ($list_tour_japan as $index => $sp): ?>
                    <?php 
                    // Calculate discount pct
                    $discount_pct = 10;
                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                    }
                    ?>
                    <!-- Card -->
                    <div class="japan-tour-card <?php echo $index >= 4 ? 'hidden-japan-card' : ''; ?>">
                        <!-- Image with discount badge -->
                        <div class="japan-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Nhat+Ban'">
                            <div class="japan-tour-discount">
                                -<?php echo $discount_pct; ?>%
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="japan-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="japan-tour-title">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>">
                                        <?php echo htmlspecialchars($sp['name']); ?>
                                    </a>
                                </h3>
                                
                                <!-- Duration -->
                                <div class="japan-tour-duration">
                                    <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <!-- Transport icons matching screenshot -->
                                <div class="japan-tour-transport">
                                    <span class="japan-tour-icon" title="Xe du lịch đời mới">🚌</span>
                                    <span class="japan-tour-icon" title="Vé máy bay khứ hồi">✈️</span>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="japan-tour-separator"></div>
                            
                            <!-- Prices -->
                            <div class="japan-tour-prices">
                                <span class="japan-tour-price-old">
                                    <?php echo number_format($sp['price']); ?> đ
                                </span>
                                <span class="japan-tour-price-sale">
                                    <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <div style="text-align: center; margin-top: 40px;">
            <button onclick="revealAllJapanTours(this)" class="japan-btn-more">Xem thêm</button>
        </div>
    </section>

    <script>
    function revealAllJapanTours(btn) {
        const hiddenCards = document.querySelectorAll('.hidden-japan-card');
        hiddenCards.forEach(card => {
            card.classList.remove('hidden-japan-card');
        });
        btn.style.display = 'none'; // Hide button after showing all
    }
    </script>

    <!-- Đông Âu Tours Grid Section -->
    <style>
        .dongau-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .dongau-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .dongau-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .dongau-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .dongau-tour-card:hover .dongau-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .dongau-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .dongau-tour-info {
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .dongau-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            font-family: 'Outfit', sans-serif;
        }
        .dongau-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .dongau-tour-title a:hover {
            color: #1e70bf;
        }
        .dongau-tour-duration {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
        }
        .dongau-tour-transport {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
        }
        .dongau-tour-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
        }
        .dongau-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .dongau-tour-prices {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }
        .dongau-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .dongau-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }
        .dongau-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 32px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .dongau-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .dongau-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .dongau-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .dongau-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .dongau-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Du lịch Đông Âu" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Du lịch Đông Âu</h2>
        </div>

        <div class="dongau-tours-grid">
            <?php if (!empty($list_tour_dong_au)): ?>
                <?php foreach ($list_tour_dong_au as $index => $sp): ?>
                    <?php 
                    // Calculate discount pct
                    $discount_pct = 10;
                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                    }
                    ?>
                    <!-- Card -->
                    <div class="dongau-tour-card">
                        <!-- Image with discount badge -->
                        <div class="dongau-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Dong+Au'">
                            <div class="dongau-tour-discount">
                                -<?php echo $discount_pct; ?>%
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="dongau-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="dongau-tour-title">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>"><?php echo htmlspecialchars($sp['name']); ?></a>
                                </h3>
                                
                                <!-- Duration -->
                                <div class="dongau-tour-duration">
                                    <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <!-- Transport icons -->
                                <div class="dongau-tour-transport">
                                    <span class="dongau-tour-icon" title="Xe du lịch đời mới">🚌</span>
                                    <span class="dongau-tour-icon" title="Vé máy bay khứ hồi">✈️</span>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="dongau-tour-separator"></div>
                            
                            <!-- Prices -->
                            <div class="dongau-tour-prices">
                                <span class="dongau-tour-price-old">
                                    <?php echo number_format($sp['price']); ?> đ
                                </span>
                                <span class="dongau-tour-price-sale">
                                    <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </section>

    <!-- Trung Âu Tours Grid Section -->
    <style>
        .trungau-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 10px;
        }
        .trungau-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .trungau-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 2px;
        }
        .trungau-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .trungau-tour-card:hover .trungau-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .trungau-tour-discount {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ef4444;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 10px;
            font-family: 'Outfit', sans-serif;
            border-bottom-right-radius: 4px;
            z-index: 2;
        }
        .trungau-tour-info {
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .trungau-tour-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            line-height: 1.45;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
            font-family: 'Outfit', sans-serif;
        }
        .trungau-tour-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .trungau-tour-title a:hover {
            color: #1e70bf;
        }
        .trungau-tour-duration {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
        }
        .trungau-tour-transport {
            display: flex;
            gap: 6px;
            margin-bottom: 12px;
        }
        .trungau-tour-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
        }
        .trungau-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .trungau-tour-prices {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }
        .trungau-tour-price-old {
            font-size: 12px;
            text-decoration: line-through;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
        }
        .trungau-tour-price-sale {
            font-size: 14.5px;
            font-weight: 800;
            color: #ef4444;
            font-family: 'Outfit', sans-serif;
        }
        .trungau-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 32px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .trungau-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .trungau-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 1024px) {
            .trungau-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .trungau-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .trungau-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Du lịch Trung Âu" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Du lịch Trung Âu</h2>
        </div>

        <div class="trungau-tours-grid">
            <?php if (!empty($list_tour_trung_au)): ?>
                <?php foreach ($list_tour_trung_au as $index => $sp): ?>
                    <?php 
                    // Calculate discount pct
                    $discount_pct = 10;
                    if ($sp['price'] > 0 && $sp['price_sale'] > 0) {
                        $discount_pct = round((($sp['price'] - $sp['price_sale']) / $sp['price']) * 100);
                    }
                    ?>
                    <!-- Card -->
                    <div class="trungau-tour-card">
                        <!-- Image with discount badge -->
                        <div class="trungau-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sp['image']); ?>" alt="<?php echo htmlspecialchars($sp['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Tour+Trung+Au'">
                            <div class="trungau-tour-discount">
                                -<?php echo $discount_pct; ?>%
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="trungau-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="trungau-tour-title">
                                    <a href="index.php?act=sanphamct&id=<?php echo $sp['id']; ?>"><?php echo htmlspecialchars($sp['name']); ?></a>
                                </h3>
                                
                                <!-- Duration -->
                                <div class="trungau-tour-duration">
                                    <?php echo htmlspecialchars($sp['duration']); ?>
                                </div>
                                
                                <!-- Transport icons -->
                                <div class="trungau-tour-transport">
                                    <span class="trungau-tour-icon" title="Xe du lịch đời mới">🚌</span>
                                    <span class="trungau-tour-icon" title="Vé máy bay khứ hồi">✈️</span>
                                    <?php if (in_array($index, [0, 1, 4, 6])): ?>
                                        <span class="trungau-tour-icon" title="Dạo thuyền / Du thuyền">🚢</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="trungau-tour-separator"></div>
                            
                            <!-- Prices -->
                            <div class="trungau-tour-prices">
                                <span class="trungau-tour-price-old">
                                    <?php echo number_format($sp['price']); ?> đ
                                </span>
                                <span class="trungau-tour-price-sale">
                                    <?php echo number_format($sp['price_sale'] > 0 ? $sp['price_sale'] : $sp['price']); ?> đ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php?act=sanpham&keyword=Trung Âu" class="trungau-btn-more">Xem thêm</a>
        </div>
    </section>

    <!-- Nhà Hàng Món Ngon Du Lịch Biển Section -->
    <style>
        .nhahang-tour-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
            padding: 12px;
        }
        .nhahang-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #cbd5e1;
        }
        .nhahang-tour-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            width: 100%;
            overflow: hidden;
            border-radius: 6px;
        }
        .nhahang-tour-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .nhahang-tour-card:hover .nhahang-tour-img-wrapper img {
            transform: scale(1.05);
        }
        .nhahang-tour-rating {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #eab308;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 12px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 3px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .nhahang-tour-info {
            padding: 12px 4px 4px 4px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }
        .nhahang-tour-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.45;
            margin: 0 0 6px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px;
            font-family: 'Outfit', sans-serif;
        }
        .nhahang-tour-address {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 6px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nhahang-tour-desc {
            font-size: 12px;
            color: #475569;
            margin-bottom: 10px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 36px;
        }
        .nhahang-tour-separator {
            border-top: 1px dashed #cbd5e1;
            margin: 8px 0;
            width: 100%;
        }
        .nhahang-tour-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4px;
        }
        .nhahang-tour-price {
            font-size: 15px;
            font-weight: 800;
            color: #ff5722;
            font-family: 'Outfit', sans-serif;
        }
        .nhahang-tour-views {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }
        .nhahang-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 40px;
            border-radius: 25px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
        }
        .nhahang-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .nhahang-tours-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .hidden-nhahang-card {
            display: none !important;
        }
        @media (max-width: 1024px) {
            .nhahang-tours-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .nhahang-tours-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .nhahang-tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Nhà hàng & Món ngon du lịch biển" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Nhà Hàng &amp; Món Ngon Du Lịch Biển</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 8px; font-family: 'Outfit', sans-serif;">Khám phá tinh hoa ẩm thực vùng biển đảo tươi ngon và những nhà hàng view biển cực chất</p>
        </div>

        <div class="nhahang-tours-grid">
            <?php if (!empty($list_nhahang)): ?>
                <?php foreach ($list_nhahang as $index => $nh): ?>
                    <!-- Card -->
                    <div class="nhahang-tour-card <?php echo $index >= 8 ? 'hidden-nhahang-card' : ''; ?>">
                        <!-- Image with rating badge -->
                        <div class="nhahang-tour-img-wrapper">
                            <img src="<?php echo htmlspecialchars($nh['image']); ?>" alt="<?php echo htmlspecialchars($nh['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Mon+Ngon+Du+Lich+Bien'">
                            <div class="nhahang-tour-rating">
                                ⭐️ <?php echo number_format($nh['rating'], 1); ?>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="nhahang-tour-info">
                            <div>
                                <!-- Title -->
                                <h3 class="nhahang-tour-title">
                                    <?php echo htmlspecialchars($nh['name']); ?>
                                </h3>
                                
                                <!-- Address -->
                                <div class="nhahang-tour-address" title="<?php echo htmlspecialchars($nh['address']); ?>">
                                    📍 <?php echo htmlspecialchars($nh['address']); ?>
                                </div>

                                <!-- Description -->
                                <div class="nhahang-tour-desc">
                                    <?php echo htmlspecialchars($nh['description']); ?>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="nhahang-tour-separator"></div>
                            
                            <!-- Meta & Price -->
                            <div class="nhahang-tour-meta">
                                <span class="nhahang-tour-price">
                                    <?php echo number_format($nh['price'], 0, ',', '.'); ?> đ
                                </span>
                                <span class="nhahang-tour-views">
                                    👁️ <?php echo $nh['views']; ?> lượt xem
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <div style="text-align: center; margin-top: 45px;" id="nhahang-btn-more-container">
            <button onclick="revealAllNhaHangs(this)" class="nhahang-btn-more">Xem thêm</button>
        </div>
    </section>

    <script>
    function revealAllNhaHangs(btn) {
        const hiddenCards = document.querySelectorAll('.hidden-nhahang-card');
        hiddenCards.forEach(card => {
            card.classList.remove('hidden-nhahang-card');
        });
        document.getElementById('nhahang-btn-more-container').style.display = 'none'; // Hide button after showing all
    }
    </script>

    <!-- CSS styles for Cruises (Du Thuyen) Section -->
    <style>
        .duthuyen-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }
        .duthuyen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .duthuyen-img-wrapper {
            position: relative;
            aspect-ratio: 16/10;
            overflow: hidden;
        }
        .duthuyen-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .duthuyen-card:hover .duthuyen-img-wrapper img {
            transform: scale(1.05);
        }
        .duthuyen-rating {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(30, 41, 59, 0.75);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 12px;
            backdrop-filter: blur(4px);
            z-index: 2;
            font-family: 'Outfit', sans-serif;
        }
        .duthuyen-info {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .duthuyen-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.4;
            margin: 0 0 8px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px;
            text-transform: uppercase;
            font-family: 'Outfit', sans-serif;
        }
        .duthuyen-address {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-family: 'Outfit', sans-serif;
        }
        .duthuyen-desc {
            font-size: 12.5px;
            color: #475569;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 56px;
        }
        .duthuyen-separator {
            border-top: 1px dashed #cbd5e1;
            margin-bottom: 12px;
        }
        .duthuyen-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .duthuyen-price {
            font-size: 15px;
            font-weight: 800;
            color: #ff5722;
            font-family: 'Outfit', sans-serif;
        }
        .duthuyen-views {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }
        .duthuyen-btn-more {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 40px;
            border-radius: 25px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
        }
        .duthuyen-btn-more:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.3);
        }
        .duthuyen-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .hidden-duthuyen-card {
            display: none !important;
        }
        @media (max-width: 1024px) {
            .duthuyen-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .duthuyen-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .duthuyen-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section style="margin-bottom: 60px; margin-top: 40px; position: relative;">
        <!-- Title "Du Thuyền Sang Trọng" -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e70bf; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; font-family: 'Outfit', sans-serif;">Du Thuyền Sang Trọng</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 8px; font-family: 'Outfit', sans-serif;">Trải nghiệm hải trình đẳng cấp 5 sao khám phá các vịnh biển thiên đường tại Việt Nam</p>
        </div>

        <div class="duthuyen-grid">
            <?php if (!empty($list_duthuyen)): ?>
                <?php foreach ($list_duthuyen as $index => $dt): ?>
                    <!-- Card -->
                    <div class="duthuyen-card <?php echo $index >= 8 ? 'hidden-duthuyen-card' : ''; ?>">
                        <!-- Image with rating badge -->
                        <div class="duthuyen-img-wrapper">
                            <img src="<?php echo htmlspecialchars($dt['image']); ?>" alt="<?php echo htmlspecialchars($dt['name']); ?>" onerror="this.src='https://placehold.co/600x400?text=Du+Thuyen+Sang+Trong'">
                            <div class="duthuyen-rating">
                                ⭐️ <?php echo number_format($dt['rating'], 1); ?>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="duthuyen-info">
                            <div>
                                <!-- Title -->
                                <h3 class="duthuyen-title">
                                    <a href="#" style="color: inherit; text-decoration: none;" onclick="alert('Tính năng chi tiết du thuyền đang được nâng cấp! Cảm ơn bạn.'); return false;">
                                        <?php echo htmlspecialchars($dt['name']); ?>
                                    </a>
                                </h3>
                                
                                <!-- Address -->
                                <div class="duthuyen-address" title="<?php echo htmlspecialchars($dt['address']); ?>">
                                    📍 <?php echo htmlspecialchars($dt['address']); ?>
                                </div>

                                <!-- Description -->
                                <div class="duthuyen-desc">
                                    <?php echo htmlspecialchars($dt['description']); ?>
                                </div>
                            </div>
                            
                            <!-- Dashed line separator -->
                            <div class="duthuyen-separator"></div>
                            
                            <!-- Meta & Price -->
                            <div class="duthuyen-meta">
                                <span class="duthuyen-price">
                                    <?php echo number_format($dt['price'], 0, ',', '.'); ?> đ
                                </span>
                                <span class="duthuyen-views">
                                    👁️ <?php echo $dt['views']; ?> lượt xem
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Orange "Xem thêm" button at the center bottom -->
        <?php if (!empty($list_duthuyen) && count($list_duthuyen) > 8): ?>
            <div style="text-align: center; margin-top: 45px;" id="duthuyen-btn-more-container">
                <button onclick="revealAllDuThuyens(this)" class="duthuyen-btn-more">Xem thêm</button>
            </div>
        <?php endif; ?>
    </section>

    <script>
    function revealAllDuThuyens(btn) {
        const hiddenCards = document.querySelectorAll('.hidden-duthuyen-card');
        hiddenCards.forEach(card => {
            card.classList.remove('hidden-duthuyen-card');
        });
    }
    </script>

    <!-- Car Rental Section (Thuê xe du lịch) -->
    <style>
    /* Car Rental Section Styles */
    .car-rental-section {
        position: relative;
        padding: 60px 0;
        background-color: #0b1329; /* Sleek dark navy/teal background */
        border-top: 1px solid #1e293b;
        overflow: hidden;
        font-family: 'Outfit', sans-serif;
    }

    .car-section-title-container {
        text-align: center;
        margin-bottom: 40px;
    }

    .car-section-title {
        color: #38bdf8; /* Teal/Cyan */
        font-size: 28px;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .car-section-subtitle {
        color: #94a3b8;
        font-size: 14px;
    }

    .car-carousel-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 50px; /* Leave space for < > buttons */
    }

    .car-carousel-viewport {
        overflow: hidden;
        width: 100%;
    }

    .car-carousel-track {
        display: flex;
        gap: 20px;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* 4 columns on large screens */
    .car-card {
        flex: 0 0 calc(25% - 15px);
        box-sizing: border-box;
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .car-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
    }

    .car-img-wrapper {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
    }

    .car-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .car-card:hover .car-img-wrapper img {
        transform: scale(1.05);
    }

    .car-rating {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(15, 23, 42, 0.85);
        color: #facc15; /* Yellow star */
        font-weight: 700;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 20px;
        border: 1px solid rgba(56, 189, 248, 0.3);
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .car-info {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .car-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.4;
        margin: 0 0 8px 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .car-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }

    .car-title a:hover {
        color: #38bdf8;
    }

    .car-address {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .car-desc {
        font-size: 12.5px;
        color: #cbd5e1;
        line-height: 1.5;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .car-separator {
        border-top: 1px dashed #334155;
        margin-bottom: 12px;
    }

    .car-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .car-price {
        font-size: 15px;
        font-weight: 800;
        color: #38bdf8;
        font-family: 'Outfit', sans-serif;
    }

    .car-views {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
    }

    /* Navigation Buttons */
    .car-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: rgba(30, 41, 59, 0.8);
        border: 1px solid #334155;
        color: #38bdf8;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background-color 0.2s, color 0.2s, border-color 0.2s;
    }

    .car-nav-btn:hover {
        background-color: #38bdf8;
        color: #0f172a;
        border-color: #38bdf8;
    }

    .car-nav-btn.prev {
        left: 0;
    }

    .car-nav-btn.next {
        right: 0;
    }

    /* Xem thêm button */
    .car-btn-more {
        display: inline-block;
        background-color: #38bdf8;
        color: #0f172a;
        font-weight: 700;
        padding: 12px 40px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        letter-spacing: 0.5px;
        transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 14px rgba(56, 189, 248, 0.3);
    }

    .car-btn-more:hover {
        background-color: #0ea5e9;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(56, 189, 248, 0.4);
    }

    /* Grid layout when expanded */
    .car-rental-section.expanded .car-carousel-track {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        transform: none !important;
    }

    .car-rental-section.expanded .car-card {
        flex: none;
        width: 100%;
    }

    .car-rental-section.expanded .car-nav-btn {
        display: none !important;
    }

    .car-rental-section.expanded .car-carousel-container {
        padding: 0; /* Remove padding when expanded */
    }

    /* Responsive carousel adjustments */
    @media (max-width: 1024px) {
        .car-card {
            flex: 0 0 calc(33.333% - 13.333px);
        }
        .car-rental-section.expanded .car-carousel-track {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .car-card {
            flex: 0 0 calc(50% - 10px);
        }
        .car-rental-section.expanded .car-carousel-track {
            grid-template-columns: repeat(2, 1fr);
        }
        .car-carousel-container {
            padding: 0 35px;
        }
    }

    @media (max-width: 480px) {
        .car-card {
            flex: 0 0 100%;
        }
        .car-rental-section.expanded .car-carousel-track {
            grid-template-columns: 1fr;
        }
        .car-carousel-container {
            padding: 0 25px;
        }
    }
    .btn-car-book {
        background-color: #38bdf8;
        color: #0f172a;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: 100%;
        margin-top: 15px;
        display: block;
        text-align: center;
    }
    .btn-car-book:hover {
        background-color: #0ea5e9;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
        transform: translateY(-1px);
    }
    </style>

    <section class="car-rental-section" id="car-rental-section">
        <div class="car-section-title-container">
            <h2 class="car-section-title">🚗 Thuê Xe Khách Du Lịch</h2>
            <p class="car-section-subtitle">Hệ thống thuê xe tự lái và xe du lịch có tài xế chất lượng cao toàn quốc</p>
        </div>

        <div class="car-carousel-container">
            <!-- Navigation Buttons -->
            <button class="car-nav-btn prev" onclick="slideCarPrev()">&lt;</button>
            
            <div class="car-carousel-viewport">
                <div class="car-carousel-track" id="car-carousel-track">
                    <?php if (!empty($list_cars)): ?>
                        <?php foreach ($list_cars as $index => $car): ?>
                            <!-- Card -->
                            <div class="car-card">
                                <!-- Image with rating badge -->
                                <div class="car-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['name']); ?>" onerror="this.src='uploads/car1.png'">
                                    <div class="car-rating">
                                        ⭐ <span><?php echo number_format($car['rating'], 1); ?></span>
                                    </div>
                                </div>
                                
                                <!-- Info -->
                                <div class="car-info">
                                    <div>
                                        <!-- Title -->
                                        <h3 class="car-title">
                                            <a href="#" onclick="alert('Tính năng chi tiết thuê xe đang được nâng cấp! Cảm ơn bạn.'); return false;">
                                                <?php echo htmlspecialchars($car['name']); ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="car-address" title="<?php echo htmlspecialchars($car['address']); ?>">
                                            📍 <?php echo htmlspecialchars($car['address']); ?>
                                        </div>

                                        <!-- Description -->
                                        <div class="car-desc">
                                            <?php echo htmlspecialchars($car['description']); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Dashed line separator -->
                                    <div class="car-separator"></div>
                                    
                                    <!-- Meta & Price -->
                                    <div class="car-meta">
                                        <span class="car-price">
                                            <?php echo number_format($car['price'], 0, ',', '.'); ?> đ/ngày
                                        </span>
                                        <span class="car-views">
                                            👁️ <?php echo $car['views']; ?> lượt xem
                                        </span>
                                    </div>

                                    <!-- Add to Cart Form -->
                                    <form action="index.php?act=addtocart" method="POST" style="margin: 0; width: 100%;">
                                        <input type="hidden" name="id" value="<?php echo 10000 + $car['id']; ?>">
                                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($car['name']); ?>">
                                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($car['image']); ?>">
                                        <input type="hidden" name="price" value="<?php echo $car['price']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="addtocart" class="btn-car-book">Thuê Xe Ngay</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <button class="car-nav-btn next" onclick="slideCarNext()">&gt;</button>
        </div>

        <!-- Xem thêm button -->
        <?php if (!empty($list_cars) && count($list_cars) > 8): ?>
            <div style="text-align: center; margin-top: 45px;" id="car-btn-more-container">
                <button onclick="revealAllCars(this)" class="car-btn-more">Xem thêm 100 xe</button>
            </div>
        <?php endif; ?>
    </section>

    <script>
    let carCurrentIndex = 0;
    
    function getCarVisibleCount() {
        const width = window.innerWidth;
        if (width > 1024) return 4;
        if (width > 768) return 3;
        if (width > 480) return 2;
        return 1;
    }

    function updateCarSlider() {
        const track = document.getElementById('car-carousel-track');
        const cards = track.querySelectorAll('.car-card');
        if (cards.length === 0) return;
        
        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = 20; // gap in px
        const moveAmount = carCurrentIndex * (cardWidth + gap);
        track.style.transform = `translateX(-${moveAmount}px)`;
    }

    function slideCarPrev() {
        if (carCurrentIndex > 0) {
            carCurrentIndex--;
            updateCarSlider();
        } else {
            // Loop to the end
            const track = document.getElementById('car-carousel-track');
            const totalCards = track.querySelectorAll('.car-card').length;
            const visible = getCarVisibleCount();
            carCurrentIndex = Math.max(0, totalCards - visible);
            updateCarSlider();
        }
    }

    function slideCarNext() {
        const track = document.getElementById('car-carousel-track');
        const totalCards = track.querySelectorAll('.car-card').length;
        const visible = getCarVisibleCount();
        if (carCurrentIndex < totalCards - visible) {
            carCurrentIndex++;
            updateCarSlider();
        } else {
            // Loop back to start
            carCurrentIndex = 0;
            updateCarSlider();
        }
    }

    function revealAllCars(btn) {
        const section = document.getElementById('car-rental-section');
        section.classList.add('expanded');
        document.getElementById('car-btn-more-container').style.display = 'none';
    }

    // Auto-update slider on resize
    window.addEventListener('resize', () => {
        const section = document.getElementById('car-rental-section');
        if (!section.classList.contains('expanded')) {
            updateCarSlider();
        }
    });
    </script>

    <!-- Beach Camping Tents Section (Lều cắm trại ở biển) -->
    <style>
    /* Beach Camping Tents Section Styles */
    .tent-rental-section {
        position: relative;
        padding: 60px 0;
        background: linear-gradient(to bottom, #071a22, #041116); /* Deep beach night vibe */
        border-top: 1px solid #143d4c;
        overflow: hidden;
        font-family: 'Outfit', sans-serif;
    }

    .tent-section-title-container {
        text-align: center;
        margin-bottom: 40px;
    }

    .tent-section-title {
        color: #34d399; /* Mint Emerald */
        font-size: 28px;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .tent-section-subtitle {
        color: #94a3b8;
        font-size: 14px;
    }

    .tent-carousel-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 50px;
    }

    .tent-carousel-viewport {
        overflow: hidden;
        width: 100%;
    }

    .tent-carousel-track {
        display: flex;
        gap: 20px;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* 4 columns on large screens */
    .tent-card {
        flex: 0 0 calc(25% - 15px);
        box-sizing: border-box;
        background: #0b2c37;
        border: 1px solid #143d4c;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .tent-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(52, 211, 153, 0.15);
        border-color: #34d399;
    }

    .tent-img-wrapper {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
    }

    .tent-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .tent-card:hover .tent-img-wrapper img {
        transform: scale(1.05);
    }

    .tent-rating {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(5, 28, 36, 0.85);
        color: #facc15;
        font-weight: 700;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 20px;
        border: 1px solid rgba(52, 211, 153, 0.3);
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .tent-info {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .tent-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.4;
        margin: 0 0 8px 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 40px;
    }

    .tent-address {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tent-desc {
        font-size: 12.5px;
        color: #cbd5e1;
        line-height: 1.5;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 36px;
    }

    .tent-separator {
        border-top: 1px dashed #143d4c;
        margin-bottom: 12px;
    }

    .tent-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tent-price {
        font-size: 15px;
        font-weight: 800;
        color: #34d399;
        font-family: 'Outfit', sans-serif;
    }

    .tent-views {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
    }

    /* Navigation Buttons */
    .tent-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: rgba(11, 44, 55, 0.8);
        border: 1px solid #143d4c;
        color: #34d399;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background-color 0.2s, color 0.2s, border-color 0.2s;
    }

    .tent-nav-btn:hover {
        background-color: #34d399;
        color: #051c24;
        border-color: #34d399;
    }

    .tent-nav-btn.prev {
        left: 0;
    }

    .tent-nav-btn.next {
        right: 0;
    }

    /* Booking Button */
    .btn-tent-book {
        background-color: #34d399;
        color: #051c24;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: 100%;
        margin-top: 15px;
        display: block;
        text-align: center;
    }

    .btn-tent-book:hover {
        background-color: #10b981;
        box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
        transform: translateY(-1px);
    }

    /* See More Button */
    .tent-btn-more {
        display: inline-block;
        background-color: #34d399;
        color: #051c24;
        font-weight: 700;
        padding: 12px 40px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        letter-spacing: 0.5px;
        transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 14px rgba(52, 211, 153, 0.3);
    }

    .tent-btn-more:hover {
        background-color: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 211, 153, 0.4);
    }

    /* Grid layout when expanded */
    .tent-rental-section.expanded .tent-carousel-track {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        transform: none !important;
    }

    .tent-rental-section.expanded .tent-card {
        flex: none;
        width: 100%;
    }

    .tent-rental-section.expanded .tent-nav-btn {
        display: none !important;
    }

    .tent-rental-section.expanded .tent-carousel-container {
        padding: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .tent-card {
            flex: 0 0 calc(33.333% - 13.333px);
        }
        .tent-rental-section.expanded .tent-carousel-track {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .tent-card {
            flex: 0 0 calc(50% - 10px);
        }
        .tent-rental-section.expanded .tent-carousel-track {
            grid-template-columns: repeat(2, 1fr);
        }
        .tent-carousel-container {
            padding: 0 35px;
        }
    }

    @media (max-width: 480px) {
        .tent-card {
            flex: 0 0 100%;
        }
        .tent-rental-section.expanded .tent-carousel-track {
            grid-template-columns: 1fr;
        }
        .tent-carousel-container {
            padding: 0 25px;
        }
    }
    </style>

    <section class="tent-rental-section" id="tent-rental-section">
        <div class="tent-section-title-container">
            <h2 class="tent-section-title">⛺ Lều Cắm Trại Ở Biển</h2>
            <p class="tent-section-subtitle">Dịch vụ cho thuê lều trại cắm trại ngoài bãi biển, Glamping cao cấp ngắm trọn bình minh</p>
        </div>

        <div class="tent-carousel-container">
            <!-- Navigation Buttons -->
            <button class="tent-nav-btn prev" onclick="slideTentPrev()">&lt;</button>
            
            <div class="tent-carousel-viewport">
                <div class="tent-carousel-track" id="tent-carousel-track">
                    <?php if (!empty($list_tents)): ?>
                        <?php foreach ($list_tents as $index => $tent): ?>
                            <!-- Card -->
                            <div class="tent-card">
                                <!-- Image with rating badge -->
                                <div class="tent-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($tent['image']); ?>" alt="<?php echo htmlspecialchars($tent['name']); ?>" onerror="this.src='uploads/tiny_placeholder.png'">
                                    <div class="tent-rating">
                                        ⭐ <span><?php echo number_format($tent['rating'], 1); ?></span>
                                    </div>
                                </div>
                                
                                <!-- Info -->
                                <div class="tent-info">
                                    <div>
                                        <!-- Title -->
                                        <h3 class="tent-title">
                                            <a href="#" style="color: inherit; text-decoration: none;" onclick="alert('Tính năng chi tiết lều cắm trại đang được nâng cấp! Cảm ơn bạn.'); return false;">
                                                <?php echo htmlspecialchars($tent['name']); ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="tent-address" title="<?php echo htmlspecialchars($tent['address']); ?>">
                                            📍 <?php echo htmlspecialchars($tent['address']); ?>
                                        </div>

                                        <!-- Description -->
                                        <div class="tent-desc">
                                            <?php echo htmlspecialchars($tent['description']); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Dashed line separator -->
                                    <div class="tent-separator"></div>
                                    
                                    <!-- Meta & Price -->
                                    <div class="tent-meta">
                                        <span class="tent-price">
                                            <?php echo number_format($tent['price'], 0, ',', '.'); ?> đ/ngày
                                        </span>
                                        <span class="tent-views">
                                            👁️ <?php echo $tent['views']; ?> lượt xem
                                        </span>
                                    </div>

                                    <!-- Add to Cart Form -->
                                    <form action="index.php?act=addtocart" method="POST" style="margin: 0; width: 100%;">
                                        <input type="hidden" name="id" value="<?php echo 20000 + $tent['id']; ?>">
                                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($tent['name']); ?>">
                                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($tent['image']); ?>">
                                        <input type="hidden" name="price" value="<?php echo $tent['price']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="addtocart" class="btn-tent-book">Đặt Lều Ngay</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <button class="tent-nav-btn next" onclick="slideTentNext()">&gt;</button>
        </div>

        <!-- Xem thêm button -->
        <?php if (!empty($list_tents) && count($list_tents) > 8): ?>
            <div style="text-align: center; margin-top: 45px;" id="tent-btn-more-container">
                <button onclick="revealAllTents(this)" class="tent-btn-more">Xem thêm 140 lều</button>
            </div>
        <?php endif; ?>
    </section>

    <script>
    let tentCurrentIndex = 0;
    
    function getTentVisibleCount() {
        const width = window.innerWidth;
        if (width > 1024) return 4;
        if (width > 768) return 3;
        if (width > 480) return 2;
        return 1;
    }

    function updateTentSlider() {
        const track = document.getElementById('tent-carousel-track');
        const cards = track.querySelectorAll('.tent-card');
        if (cards.length === 0) return;
        
        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = 20; // gap in px
        const moveAmount = tentCurrentIndex * (cardWidth + gap);
        track.style.transform = `translateX(-${moveAmount}px)`;
    }

    function slideTentPrev() {
        if (tentCurrentIndex > 0) {
            tentCurrentIndex--;
            updateTentSlider();
        } else {
            // Loop to the end
            const track = document.getElementById('tent-carousel-track');
            const totalCards = track.querySelectorAll('.tent-card').length;
            const visible = getTentVisibleCount();
            tentCurrentIndex = Math.max(0, totalCards - visible);
            updateTentSlider();
        }
    }

    function slideTentNext() {
        const track = document.getElementById('tent-carousel-track');
        const totalCards = track.querySelectorAll('.tent-card').length;
        const visible = getTentVisibleCount();
        if (tentCurrentIndex < totalCards - visible) {
            tentCurrentIndex++;
            updateTentSlider();
        } else {
            // Loop back to start
            tentCurrentIndex = 0;
            updateTentSlider();
        }
    }

    function revealAllTents(btn) {
        const section = document.getElementById('tent-rental-section');
        section.classList.add('expanded');
        document.getElementById('tent-btn-more-container').style.display = 'none';
    }

    // Auto-update slider on resize
    window.addEventListener('resize', () => {
        const section = document.getElementById('tent-rental-section');
        if (!section.classList.contains('expanded')) {
            updateTentSlider();
        }
    });
    </script>

    <!-- Tour Ưu Đãi Giá Tốt Section -->
    <style>
        .uudai-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #cbd5e1;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .uudai-dot.active {
            background: #d97706 !important;
            width: 24px;
            border-radius: 5px;
        }
        .tour-uudai-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1) !important;
        }
        .tour-uudai-card:hover .card-img-hover {
            transform: scale(1.08);
        }
        .uudai-nav-btn:hover {
            background: #d97706 !important;
            color: white !important;
            border-color: #d97706 !important;
            box-shadow: 0 6px 15px rgba(217, 119, 6, 0.3) !important;
        }
        
        @media (max-width: 1024px) {
            .tour-uudai-card {
                flex: 0 0 calc((100% - 40px) / 3) !important;
                max-width: calc((100% - 40px) / 3) !important;
            }
        }
        @media (max-width: 768px) {
            .tour-uudai-card {
                flex: 0 0 calc((100% - 20px) / 2) !important;
                max-width: calc((100% - 20px) / 2) !important;
            }
        }
        @media (max-width: 480px) {
            .tour-uudai-card {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }
    </style>

    <section class="tour-uudai-section" style="margin-bottom: 60px; position: relative;">
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">
                <span style="color: #d97706;">TOUR ƯU ĐÃI</span> GIÁ TỐT
            </h2>
            <p style="color: #64748b; font-size: 15px; margin-top: 8px; font-weight: 500;">
                Cùng Elite Tour điểm qua các địa điểm du lịch trong nước và ngoài nước thu hút du khách nhất nhé!
            </p>
        </div>

        <div class="tour-uudai-carousel-container" style="position: relative; overflow: hidden; padding: 10px 0;">
            <div class="tour-uudai-carousel-track" id="tour-uudai-track" style="display: flex; gap: 20px; transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1); will-change: transform;">
                <?php if (!empty($list_touruudai)): ?>
                    <?php foreach ($list_touruudai as $uudai): ?>
                        <div class="tour-uudai-card" style="flex: 0 0 calc((100% - 60px) / 4); max-width: calc((100% - 60px) / 4); background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease; position: relative; box-sizing: border-box;">
                            
                            <!-- Discount Badge -->
                            <div style="position: absolute; top: 12px; left: 12px; background-color: #ef4444; color: white; padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: 20px; z-index: 5; box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);">
                                <?php echo htmlspecialchars($uudai['discount']); ?>
                            </div>

                            <!-- Image -->
                            <div style="position: relative; height: 180px; width: 100%; overflow: hidden;">
                                <img src="<?php echo htmlspecialchars($uudai['image']); ?>" alt="<?php echo htmlspecialchars($uudai['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="card-img-hover">
                            </div>

                            <!-- Content Info -->
                            <div style="padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <!-- Title -->
                                    <h3 style="margin: 0; font-size: 14px; font-weight: 700; line-height: 1.4; color: #1e293b; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="<?php echo htmlspecialchars($uudai['name']); ?>">
                                        <?php echo htmlspecialchars($uudai['name']); ?>
                                    </h3>

                                    <!-- Transports -->
                                    <div style="margin: 10px 0; display: flex; gap: 8px; align-items: center;">
                                        <?php 
                                        $transports = explode(',', $uudai['transport']);
                                        foreach ($transports as $tr): 
                                            $tr = trim($tr);
                                            if ($tr == 'bus') echo '<span style="font-size: 18px;" title="Xe khách">🚌</span>';
                                            elseif ($tr == 'plane') echo '<span style="font-size: 18px;" title="Máy bay">✈️</span>';
                                            elseif ($tr == 'boat') echo '<span style="font-size: 18px;" title="Tàu thủy">🛳️</span>';
                                        endforeach; 
                                        ?>
                                    </div>

                                    <!-- Details -->
                                    <div style="font-size: 12px; color: #64748b; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                                        <span style="font-size: 14px;">📅</span> 
                                        <span>Lịch khởi hành: <strong style="color: #d97706;"><?php echo htmlspecialchars($uudai['departure']); ?></strong></span>
                                    </div>
                                    <div style="font-size: 12px; color: #64748b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                        <span style="font-size: 14px;">⏳</span> 
                                        <span>Thời gian: <strong style="color: #0284c7;"><?php echo htmlspecialchars($uudai['duration']); ?></strong></span>
                                    </div>
                                </div>

                                <!-- Prices -->
                                <div style="display: flex; align-items: baseline; gap: 8px; border-top: 1px dashed #e2e8f0; padding-top: 12px; margin-top: 8px;">
                                    <span style="color: #ef4444; font-size: 16px; font-weight: 700;"><?php echo number_format($uudai['price_sale'], 0, ',', '.'); ?>đ</span>
                                    <span style="text-decoration: line-through; font-size: 12px; color: #94a3b8; font-weight: 500;"><?php echo number_format($uudai['price'], 0, ',', '.'); ?>đ</span>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Navigation Buttons < > -->
        <button onclick="slideUuDaiPrev()" style="position: absolute; top: 55%; left: -20px; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.2s;" class="uudai-nav-btn prev">❮</button>
        <button onclick="slideUuDaiNext()" style="position: absolute; top: 55%; right: -20px; transform: translateY(-50%); width: 40px; height: 40px; border-radius: 50%; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.2s;" class="uudai-nav-btn next">❯</button>

        <!-- Indicators (Chấm tròn) -->
        <div style="display: flex; justify-content: center; gap: 8px; margin-top: 25px;" id="uudai-dots-container">
            <!-- Dynamically populated by JS -->
        </div>
    </section>

    <script>
    let uudaiCurrentIndex = 0;
    
    function getUuDaiVisibleCount() {
        const width = window.innerWidth;
        if (width > 1024) return 4;
        if (width > 768) return 3;
        if (width > 480) return 2;
        return 1;
    }

    function initUuDaiDots() {
        const track = document.getElementById('tour-uudai-track');
        if (!track) return;
        const cards = track.querySelectorAll('.tour-uudai-card');
        const visible = getUuDaiVisibleCount();
        const dotsContainer = document.getElementById('uudai-dots-container');
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        
        const steps = Math.max(0, cards.length - visible + 1);
        for (let i = 0; i < steps; i++) {
            const dot = document.createElement('span');
            dot.className = 'uudai-dot' + (i === uudaiCurrentIndex ? ' active' : '');
            dot.onclick = () => {
                uudaiCurrentIndex = i;
                updateUuDaiSlider();
            };
            dotsContainer.appendChild(dot);
        }
    }

    function updateUuDaiSlider() {
        const track = document.getElementById('tour-uudai-track');
        if (!track) return;
        const cards = track.querySelectorAll('.tour-uudai-card');
        if (cards.length === 0) return;
        
        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = 20; // gap in px
        const moveAmount = uudaiCurrentIndex * (cardWidth + gap);
        track.style.transform = `translateX(-${moveAmount}px)`;
        
        // Update dots
        const dots = document.querySelectorAll('.uudai-dot');
        dots.forEach((dot, idx) => {
            if (idx === uudaiCurrentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function slideUuDaiPrev() {
        if (uudaiCurrentIndex > 0) {
            uudaiCurrentIndex--;
            updateUuDaiSlider();
        } else {
            // Loop to end
            const track = document.getElementById('tour-uudai-track');
            const totalCards = track.querySelectorAll('.tour-uudai-card').length;
            const visible = getUuDaiVisibleCount();
            uudaiCurrentIndex = Math.max(0, totalCards - visible);
            updateUuDaiSlider();
        }
    }

    function slideUuDaiNext() {
        const track = document.getElementById('tour-uudai-track');
        const totalCards = track.querySelectorAll('.tour-uudai-card').length;
        const visible = getUuDaiVisibleCount();
        if (uudaiCurrentIndex < totalCards - visible) {
            uudaiCurrentIndex++;
            updateUuDaiSlider();
        } else {
            // Loop back to start
            uudaiCurrentIndex = 0;
            updateUuDaiSlider();
        }
    }

    // Initialize dots on load
    document.addEventListener('DOMContentLoaded', () => {
        initUuDaiDots();
        updateUuDaiSlider();
    });
    
    // Auto-update slider on resize
    window.addEventListener('resize', () => {
        initUuDaiDots();
        updateUuDaiSlider();
    });
    </script>

    <!-- Newsletter Section (Đăng ký bản tin) -->
    <section class="newsletter-section">
        <div class="newsletter-banner">
            <div class="newsletter-content">
                <h3 class="newsletter-title">Cho chúng tôi cơ hội phục vụ bạn tốt hơn</h3>
                <p class="newsletter-desc">Đăng ký nhận ngay Bản tin du lịch miễn phí từ chúng tôi với các thông tin được cập nhật liên tục từ Kinh nghiệm du lịch, Các Tour/Điểm tham quan và các khuyến mại mới nhất.</p>
            </div>
            <div class="newsletter-form-wrapper">
                <form action="index.php" method="POST" class="newsletter-form" onsubmit="alert('Đăng ký nhận bản tin thành công! Cảm ơn bạn.'); return false;">
                    <input type="email" placeholder="Nhập địa chỉ email của bạn" required class="newsletter-input">
                    <button type="submit" class="newsletter-btn">ĐĂNG KÝ</button>
                </form>
            </div>
            <img src="uploads/newsletter_traveler.png" alt="Traveler illustration" class="newsletter-image">
        </div>
    </section>
</div>

<!-- JavaScript cho Slideshow Banner chuyển động -->
<script>
    // Slider banner chính ở đầu trang
    let slideIndex = 0;
    let slideTimer = null;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlides(n) {
        if (n >= slides.length) {
            slideIndex = 0;
        } else if (n < 0) {
            slideIndex = slides.length - 1;
        } else {
            slideIndex = n;
        }

        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        slides[slideIndex].classList.add('active');
        dots[slideIndex].classList.add('active');

        resetTimer();
    }

    function moveSlide(step) {
        showSlides(slideIndex + step);
    }

    function currentSlide(index) {
        showSlides(index);
    }

    function resetTimer() {
        if (slideTimer) {
            clearInterval(slideTimer);
        }
        slideTimer = setInterval(() => {
            moveSlide(1);
        }, 4000);
    }

    resetTimer();

    // Slider gallery 20 ảnh ở cuối trang
    let galleryIndex = 0;
    let galleryTimer = null;
    const gallerySlides = document.querySelectorAll('.gallery-slide');
    const galleryDots = document.querySelectorAll('.gallery-dot');

    function showGallerySlides(n) {
        if (n >= gallerySlides.length) {
            galleryIndex = 0;
        } else if (n < 0) {
            galleryIndex = gallerySlides.length - 1;
        } else {
            galleryIndex = n;
        }

        gallerySlides.forEach(slide => slide.classList.remove('active'));
        galleryDots.forEach(dot => dot.classList.remove('active'));

        gallerySlides[galleryIndex].classList.add('active');
        galleryDots[galleryIndex].classList.add('active');

        resetGalleryTimer();
    }

    function moveGallerySlide(step) {
        showGallerySlides(galleryIndex + step);
    }

    function currentGallerySlide(index) {
        showGallerySlides(index);
    }

    function resetGalleryTimer() {
        if (galleryTimer) {
            clearInterval(galleryTimer);
        }
        galleryTimer = setInterval(() => {
            moveGallerySlide(1);
        }, 4500); // 4.5 giây chuyển ảnh tự động
    }

    resetGalleryTimer();
</script>
