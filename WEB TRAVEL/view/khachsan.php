<div class="container">
    <!-- Breadcrumbs -->
    <div style="padding: 20px 0 10px; font-size: 13px; color: var(--text-muted); text-transform: uppercase; font-weight: 500; border-bottom: 1px solid var(--border-color); margin-bottom: 25px;">
        <a href="index.php">Trang Chủ</a> &nbsp;/&nbsp; 
        <a href="index.php?act=khachsan">Khách Sạn</a> 
        <?php if ($location != ''): ?>
            &nbsp;/&nbsp; <span style="color: var(--text-dark); font-weight: 700;">Khách Sạn <?php echo htmlspecialchars($location); ?></span>
        <?php endif; ?>
    </div>

    <!-- Callback alert (simulated) -->
    <?php if (isset($_GET['callback']) && $_GET['callback'] == 'success'): ?>
        <div class="alert alert-success" style="margin-bottom: 25px;">
            🎉 <strong>Gửi yêu cầu thành công!</strong> Chúng tôi đã tiếp nhận yêu cầu gọi lại từ số điện thoại <strong><?php echo htmlspecialchars($_GET['phone']); ?></strong>. Chuyên viên tư vấn khách sạn sẽ gọi cho bạn trong vài phút!
        </div>
    <?php endif; ?>

    <!-- Hotel Listing Header (Count & Sort) -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
        <div style="font-size: 15px; font-weight: 700; color: #ff5722; text-transform: uppercase;">
            <?php echo $location != '' ? 'Khách Sạn ' . htmlspecialchars($location) : 'Tất Cả Khách Sạn'; ?>
        </div>
        <div style="display: flex; align-items: center; gap: 15px; font-size: 13px;">
            <span style="color: var(--text-muted);">Xem <strong class="hotel-count-display"><?php echo count($list_khachsan); ?></strong> sản phẩm</span>
            <select style="padding: 6px 12px; border: 1px solid var(--border-color); border-radius: 4px; outline: none; background-color: var(--white); font-weight: 600; color: #475569;">
                <option value="default">Mặc định</option>
                <option value="price-asc">Giá thấp đến cao</option>
                <option value="price-desc">Giá cao đến thấp</option>
            </select>
        </div>
    </div>

    <!-- Regional tabs buttons -->
    <div style="display: flex; gap: 10px; margin-bottom: 15px; align-items: center; justify-content: flex-start; flex-wrap: wrap;">
        <span style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-dark); margin-right: 10px;">Lọc theo khu vực:</span>
        <button class="hotel-filter-btn" onclick="handleRegionFilter('all', this)" style="padding: 7px 18px; border-radius: 20px; font-weight: 700; border: 1.5px solid var(--primary-color); background-color: var(--primary-color); color: var(--white); cursor: pointer; transition: all 0.2s; font-size: 12px; text-transform: uppercase; outline: none;">Tất Cả</button>
        <button class="hotel-filter-btn" onclick="handleRegionFilter('Miền Bắc', this)" style="padding: 7px 18px; border-radius: 20px; font-weight: 700; border: 1.5px solid var(--border-color); background-color: var(--white); color: var(--text-dark); cursor: pointer; transition: all 0.2s; font-size: 12px; text-transform: uppercase; outline: none;">Miền Bắc</button>
        <button class="hotel-filter-btn" onclick="handleRegionFilter('Miền Trung', this)" style="padding: 7px 18px; border-radius: 20px; font-weight: 700; border: 1.5px solid var(--border-color); background-color: var(--white); color: var(--text-dark); cursor: pointer; transition: all 0.2s; font-size: 12px; text-transform: uppercase; outline: none;">Miền Trung</button>
        <button class="hotel-filter-btn" onclick="handleRegionFilter('Miền Nam', this)" style="padding: 7px 18px; border-radius: 20px; font-weight: 700; border: 1.5px solid var(--border-color); background-color: var(--white); color: var(--text-dark); cursor: pointer; transition: all 0.2s; font-size: 12px; text-transform: uppercase; outline: none;">Miền Nam</button>
        <button class="hotel-filter-btn" onclick="handleRegionFilter('Nước Ngoài', this)" style="padding: 7px 18px; border-radius: 20px; font-weight: 700; border: 1.5px solid var(--border-color); background-color: var(--white); color: var(--text-dark); cursor: pointer; transition: all 0.2s; font-size: 12px; text-transform: uppercase; outline: none;">Nước Ngoài</button>
    </div>

    <!-- Foreign destinations sub-filter -->
    <div id="foreign-cities-subfilter" style="display: none; gap: 8px; margin-bottom: 25px; align-items: center; justify-content: flex-start; flex-wrap: wrap; padding: 12px 18px; background-color: var(--white); border: 1px solid var(--border-color); border-radius: 8px;">
        <span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: var(--text-muted); margin-right: 10px;">Điểm đến Nước Ngoài:</span>
        <button class="hotel-city-btn" onclick="filterHotelsByCity('all', this)" style="padding: 6px 14px; border-radius: 15px; font-weight: 700; border: 1px solid var(--primary-color); background-color: var(--primary-color); color: var(--white); cursor: pointer; transition: all 0.2s; font-size: 11px; outline: none;">Tất Cả</button>
        <?php foreach ($foreign_locations as $floc): ?>
            <button class="hotel-city-btn" onclick="filterHotelsByCity('<?php echo htmlspecialchars($floc['location']); ?>', this)" style="padding: 6px 14px; border-radius: 15px; font-weight: 700; border: 1px solid var(--border-color); background-color: var(--white); color: var(--text-dark); cursor: pointer; transition: all 0.2s; font-size: 11px; outline: none;"><?php echo htmlspecialchars($floc['location']); ?></button>
        <?php endforeach; ?>
    </div>

    <div class="page-layout" style="grid-template-columns: 1fr 320px;">
        <!-- Left Side: Hotel Listings Grid -->
        <main>
            <?php if (empty($list_khachsan)): ?>
                <!-- Thông báo sản phẩm đang được cập nhật y như ảnh mẫu -->
                <div style="padding: 40px 0; min-height: 250px;">
                    <h2 style="font-size: 18px; font-weight: 500; color: #475569; font-style: italic;">
                        Sản phẩm đang được cập nhật
                    </h2>
                </div>
            <?php else: ?>
                <div class="hotel-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px;">
                    <?php foreach ($list_khachsan as $ks): ?>
                        <div class="hotel-card" data-region="<?php echo htmlspecialchars($ks['region']); ?>" data-location="<?php echo htmlspecialchars($ks['location']); ?>">
                            <div class="hotel-img-wrapper" style="height: 160px; position: relative; overflow: hidden; border-radius: 4px 4px 0 0;">
                                <img src="<?php echo htmlspecialchars($ks['image']); ?>" alt="<?php echo htmlspecialchars($ks['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/600x400?text=Hotel'">
                                <?php 
                                $discount_pct = 10;
                                if ($ks['price'] > 0 && $ks['price_sale'] > 0) {
                                    $discount_pct = round((($ks['price'] - $ks['price_sale']) / $ks['price']) * 100);
                                }
                                ?>
                                <?php if ($ks['price_sale'] > 0): ?>
                                    <div class="featured-hotel-discount" style="position: absolute; top: 0; left: 0; background-color: #ef4444; color: #fff; font-size: 13px; font-weight: 800; padding: 6px 10px; font-family: 'Outfit', sans-serif; border-bottom-right-radius: 4px; z-index: 2;">
                                        -<?php echo $discount_pct; ?>%
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="hotel-body" style="padding: 15px; gap: 6px; text-align: left; display: flex; flex-direction: column; align-items: flex-start;">
                                <h3 class="hotel-name" style="font-size: 14px; min-height: 38px; text-align: left; font-weight: bold; margin: 0 0 5px 0; color: var(--text-dark);"><?php echo htmlspecialchars($ks['name']); ?></h3>
                                
                                <div class="hotel-address" style="font-size: 11px; color: var(--text-muted); margin-bottom: 2px;">
                                    <span class="location-marker">📍</span> <?php echo htmlspecialchars($ks['address']); ?>
                                </div>
                                
                                <div class="hotel-stars" style="font-size: 10px; letter-spacing: 1px; color: #ffbc0b; margin-bottom: 5px;">
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
                                
                                <div class="hotel-prices" style="display: flex; gap: 10px; align-items: center; margin: 5px 0 10px 0;">
                                    <?php if ($ks['price_sale'] > 0): ?>
                                        <span class="hotel-price-old" style="font-size: 12px; text-decoration: line-through; color: var(--text-muted);">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                        <span class="hotel-price-sale" style="font-size: 15px; color: #ef4444; font-weight: 800;">
                                            <?php echo number_format($ks['price_sale']); ?> đ
                                        </span>
                                    <?php else: ?>
                                        <span class="hotel-price-sale" style="font-size: 15px; color: var(--primary-hover); font-weight: 800;">
                                            <?php echo number_format($ks['price']); ?> đ
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <button class="btn-hotel-book" style="margin-top: auto; width: 100%; text-align: center; padding: 8px 15px; background-color: var(--secondary-color); color: var(--white); border: none; font-weight: 700; border-radius: 4px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='var(--secondary-hover)'" onmouseout="this.style.backgroundColor='var(--secondary-color)'" onclick="alert('Cảm ơn bạn! Yêu cầu đặt phòng tại <?php echo htmlspecialchars($ks['name']); ?> đã được gửi đi.')">Đặt Phòng</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>

        <!-- Right Side: Sidebar (Tìm kiếm địa điểm & Yêu cầu gọi lại) -->
        <aside class="sidebar">
            <!-- Search Location Widget -->
            <div class="sidebar-widget" style="padding: 25px;">
                <h3 class="widget-title" style="font-size: 14px; text-align: center; margin-bottom: 20px; font-weight: bold;">TÌM KIẾM ĐỊA ĐIỂM</h3>
                <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 10px;">
                    <input type="hidden" name="act" value="khachsan">
                    <input type="text" name="keyword" placeholder="Nhập địa điểm du lịch..." value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>" style="padding: 10px 12px; border: 1px solid var(--border-color); border-radius: 4px; outline: none; font-size: 13px; text-align: center;">
                    <button type="submit" class="btn-hotel-book" style="margin-top: 5px; width: 100%; border-radius: 4px; padding: 10px;">Tìm kiếm</button>
                </form>
            </div>

            <!-- Callback Request Widget (Matching the exact look from screenshot!) -->
            <div class="sidebar-widget" style="padding: 25px; text-align: center; display: flex; flex-direction: column; gap: 15px; border-color: #ff9800;">
                <h4 style="font-size: 14px; font-weight: 800; color: var(--text-dark); text-transform: uppercase;">
                    Liên hệ càng sớm – Giá càng rẻ
                </h4>
                
                <div style="font-size: 12px; color: var(--text-muted); line-height: 1.6;">
                    Hoặc để lại số điện thoại, chúng tôi sẽ gọi lại cho bạn sau ít phút !
                </div>
                
                <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 10px; width: 100%;">
                    <input type="hidden" name="act" value="khachsan">
                    <input type="hidden" name="location" value="<?php echo htmlspecialchars($location); ?>">
                    <input type="hidden" name="callback" value="success">
                    
                    <input type="tel" name="phone" required placeholder="Số điện thoại của tôi là" style="padding: 10px; border: 1px solid var(--border-color); border-radius: 4px; font-size: 13px; text-align: center; outline: none; width: 100%;">
                    
                    <button type="submit" class="btn-hotel-book" style="margin-top: 5px; width: 100%; background-color: #ff9800; padding: 12px; font-weight: 800; border-radius: 4px;">
                        Yêu Cầu Gọi Lại
                    </button>
                </form>
            </div>
            
            <!-- Quick list of domestic destinations -->
            <div class="sidebar-widget">
                <h3 class="widget-title" style="font-size: 14px; font-weight: bold; color: var(--primary-color);">KHÁCH SẠN TRONG NƯỚC</h3>
                <ul class="widget-list" style="max-height: 250px; overflow-y: auto; padding-right: 5px; list-style: none; margin: 0; padding: 0;">
                    <?php foreach ($domestic_locations as $loc): ?>
                        <li class="<?php echo ($location == $loc['location']) ? 'active' : ''; ?>" style="margin-bottom: 8px;">
                            <a href="index.php?act=khachsan&location=<?php echo urlencode($loc['location']); ?>" style="font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; color: var(--text-dark); text-decoration: none; padding: 6px 10px; border-radius: 4px; transition: background-color 0.2s;">
                                <span style="font-size: 14px;">📍</span> Khách sạn <?php echo htmlspecialchars($loc['location']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Quick list of foreign destinations -->
            <div class="sidebar-widget" style="border-top: 1px dashed var(--border-color); padding-top: 20px; margin-top: 20px;">
                <h3 class="widget-title" style="font-size: 14px; font-weight: bold; color: #ff9800;">KHÁCH SẠN NƯỚC NGOÀI</h3>
                <ul class="widget-list" style="max-height: 250px; overflow-y: auto; padding-right: 5px; list-style: none; margin: 0; padding: 0;">
                    <?php foreach ($foreign_locations as $loc): ?>
                        <li class="<?php echo ($location == $loc['location']) ? 'active' : ''; ?>" style="margin-bottom: 8px;">
                            <a href="index.php?act=khachsan&location=<?php echo urlencode($loc['location']); ?>" style="font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; color: var(--text-dark); text-decoration: none; padding: 6px 10px; border-radius: 4px; transition: background-color 0.2s;">
                                <span style="font-size: 14px;">🌐</span> Khách sạn <?php echo htmlspecialchars($loc['location']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>
</div>

<script>
function handleRegionFilter(region, buttonEl) {
    // If there is an active location or keyword filter (meaning we came from a search/specific location query),
    // redirect to the main hotel page and apply the region filter.
    <?php if ($location != '' || $keyword != ''): ?>
        window.location.href = 'index.php?act=khachsan&region_filter=' + encodeURIComponent(region);
    <?php else: ?>
        filterHotelsByRegion(region, buttonEl);
    <?php endif; ?>
}

function filterHotelsByRegion(region, buttonEl) {
    // Update active tab styling
    document.querySelectorAll('.hotel-filter-btn').forEach(btn => {
        btn.style.backgroundColor = 'var(--white)';
        btn.style.color = 'var(--text-dark)';
        btn.style.borderColor = 'var(--border-color)';
    });
    buttonEl.style.backgroundColor = 'var(--primary-color)';
    buttonEl.style.color = 'var(--white)';
    buttonEl.style.borderColor = 'var(--primary-color)';

    // Toggle sub-filter row for foreign cities
    const subfilter = document.getElementById('foreign-cities-subfilter');
    if (region === 'Nước Ngoài') {
        if (subfilter) subfilter.style.display = 'flex';
        // Reset active state for city buttons to "All"
        document.querySelectorAll('.hotel-city-btn').forEach((btn, idx) => {
            if (idx === 0) {
                btn.style.backgroundColor = 'var(--primary-color)';
                btn.style.color = 'var(--white)';
                btn.style.borderColor = 'var(--primary-color)';
            } else {
                btn.style.backgroundColor = 'var(--white)';
                btn.style.color = 'var(--text-dark)';
                btn.style.borderColor = 'var(--border-color)';
            }
        });
    } else {
        if (subfilter) subfilter.style.display = 'none';
    }

    // Filter cards
    const cards = document.querySelectorAll('.hotel-card');
    let count = 0;
    cards.forEach(card => {
        const cardRegion = card.getAttribute('data-region');
        if (region === 'all' || cardRegion === region) {
            card.style.display = 'block';
            count++;
        } else {
            card.style.display = 'none';
        }
    });

    // Update count display
    const countEl = document.querySelector('.hotel-count-display');
    if (countEl) {
        countEl.innerHTML = count;
    }
}

function filterHotelsByCity(city, buttonEl) {
    // Update active city button styling
    document.querySelectorAll('.hotel-city-btn').forEach(btn => {
        btn.style.backgroundColor = 'var(--white)';
        btn.style.color = 'var(--text-dark)';
        btn.style.borderColor = 'var(--border-color)';
    });
    buttonEl.style.backgroundColor = 'var(--primary-color)';
    buttonEl.style.color = 'var(--white)';
    buttonEl.style.borderColor = 'var(--primary-color)';

    // Filter cards
    const cards = document.querySelectorAll('.hotel-card');
    let count = 0;
    cards.forEach(card => {
        const cardRegion = card.getAttribute('data-region');
        const cardLocation = card.getAttribute('data-location');
        if (cardRegion === 'Nước Ngoài' && (city === 'all' || cardLocation === city)) {
            card.style.display = 'block';
            count++;
        } else {
            card.style.display = 'none';
        }
    });

    // Update count display
    const countEl = document.querySelector('.hotel-count-display');
    if (countEl) {
        countEl.innerHTML = count;
    }
}

// On Page Load: check if region_filter is passed in URL query parameters
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const regionFilter = urlParams.get('region_filter');
    if (regionFilter) {
        const btn = Array.from(document.querySelectorAll('.hotel-filter-btn'))
            .find(b => b.textContent.trim() === regionFilter);
        if (btn) {
            filterHotelsByRegion(regionFilter, btn);
        }
    }
});
</script>
