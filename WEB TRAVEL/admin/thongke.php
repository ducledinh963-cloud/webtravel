<?php
// Chuẩn bị dữ liệu JSON cho Javascript
$js_categories = [];
$js_counts = [];
$js_colors = ['#00acc1', '#ff5722', '#10b981', '#8b5cf6'];
$js_hover_colors = ['#00838f', '#e64a19', '#059669', '#7c3aed'];

// Map statistics data by Category ID for the map details card
$map_data = [];

foreach ($category_stats as $stat) {
    $js_categories[] = $stat['name'];
    $js_counts[] = (int)$stat['count_sp'];
    
    $map_data[(int)$stat['id']] = [
        'name' => $stat['name'],
        'count' => (int)$stat['count_sp'],
        'min_price' => (float)$stat['min_price'],
        'max_price' => (float)$stat['max_price'],
        'avg_price' => (float)$stat['avg_price']
    ];
}

// Top views data for the Bar Chart
$js_top_tours = [];
$js_top_views = [];
foreach ($top_views as $item) {
    $js_top_tours[] = $item['name'];
    $js_top_views[] = (int)$item['views'];
}
?>

<!-- Đăng ký thư viện Chart.js qua CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Styles dành cho bản đồ và các thành phần phụ trợ -->
<style>
@keyframes pulse-city {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(2.5); opacity: 0; }
}
@keyframes pulse-globe {
    0% { transform: scale(1); }
    50% { transform: scale(1.08); }
    100% { transform: scale(1); }
}
.region-path {
    transition: all 0.2s ease-in-out;
}
.region-path:hover {
    filter: brightness(0.9) drop-shadow(0 4px 8px rgba(0,0,0,0.15));
    stroke: var(--text-dark) !important;
    stroke-width: 2.5px !important;
}
.region-trigger {
    outline: none;
}
</style>

<!-- Summary Metrics Grid -->
<div class="intro-stats" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 30px;">
    <!-- Categories -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 28px; color: var(--primary-color); font-weight: 800;">
                <?php echo number_format($total_categories); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Danh Mục Khu Vực</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">📁</div>
    </div>

    <!-- Tours -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 28px; color: var(--secondary-color); font-weight: 800;">
                <?php echo number_format($total_products); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Tổng Số Tour</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">⛵</div>
    </div>

    <!-- Users -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 28px; color: #10b981; font-weight: 800;">
                <?php echo number_format($total_users); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Thành Viên Đăng Ký</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">👥</div>
    </div>

    <!-- Comments -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 28px; color: #8b5cf6; font-weight: 800;">
                <?php echo number_format($total_comments); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Ý Kiến Phản Hồi</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">💬</div>
    </div>

    <!-- Views -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 28px; color: #f59e0b; font-weight: 800;">
                <?php echo number_format($total_views ? $total_views : 0); ?>
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Tổng Lượt Xem</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">👁️</div>
    </div>

    <!-- Total Revenue -->
    <div class="stat-item" style="text-align: left; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div class="stat-number" style="font-size: 24px; color: #ec4899; font-weight: 800; white-space: nowrap;">
                18.958.090.000đ
            </div>
            <div class="stat-label" style="font-size: 13px; margin-top: 5px; color: var(--text-muted);">Tổng Doanh Thu</div>
        </div>
        <div style="font-size: 32px; opacity: 0.25;">💸</div>
    </div>
</div>

<!-- Charts Row: Pie & Bar Charts -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 30px;">
    <!-- Pie/Doughnut Chart Card (Hình Tròn) -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 380px;">
        <h3 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; align-self: flex-start; display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">⭕</span> PHÂN BỔ TOUR THEO KHU VỰC
        </h3>
        <div style="width: 100%; max-width: 250px; position: relative;">
            <canvas id="categoryPieChart"></canvas>
        </div>
    </div>
    
    <!-- Bar Chart Card (Biểu Đồ Cột) -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); min-height: 380px; display: flex; flex-direction: column;">
        <h3 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">📊</span> LƯỢT XEM TOP 5 TOUR NỔI BẬT
        </h3>
        <div style="flex: 1; width: 100%; position: relative; min-height: 240px;">
            <canvas id="viewsBarChart"></canvas>
        </div>
    </div>
</div>

<!-- Charts Row 2: Visitors & Sales (Mockup Charts from User Request) -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 30px;">
    <!-- Online Store Visitors Card -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); min-height: 380px; display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="font-size: 15px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 8px; color: var(--text-dark);">
                Online Store Visitors
            </h3>
            <a href="#" style="font-size: 13px; color: #007aff; text-decoration: none; font-weight: 600;">View Report</a>
        </div>
        <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 5px;">
            <span style="font-size: 28px; font-weight: 800; color: var(--text-dark);">820</span>
            <span style="color: #10b981; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 2px;">
                ↑ 12.5%
            </span>
        </div>
        <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 20px; display: flex; justify-content: space-between; width: 100%;">
            <span>Visitors Over Time</span>
            <span style="color: var(--text-muted);">Since last week</span>
        </div>
        <div style="flex: 1; width: 100%; position: relative; min-height: 220px;">
            <canvas id="visitorsLineChart"></canvas>
        </div>
    </div>
    
    <!-- Sales Card -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); min-height: 380px; display: flex; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="font-size: 15px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 8px; color: var(--text-dark);">
                Sales
            </h3>
            <a href="#" style="font-size: 13px; color: #007aff; text-decoration: none; font-weight: 600;">View Report</a>
        </div>
        <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 5px;">
            <span style="font-size: 28px; font-weight: 800; color: var(--text-dark);">$18,230.00</span>
            <span style="color: #10b981; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 2px;">
                ↑ 33.1%
            </span>
        </div>
        <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 20px; display: flex; justify-content: space-between; width: 100%;">
            <span>Sales Over Time</span>
            <span style="color: var(--text-muted);">Since last month</span>
        </div>
        <div style="flex: 1; width: 100%; position: relative; min-height: 220px;">
            <canvas id="salesBarChart"></canvas>
        </div>
    </div>
</div>

<!-- Interactive Map Row (Bản Đồ Thống Kê Việt Nam) -->
<div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); margin-bottom: 30px;">
    <h3 style="font-size: 16px; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 8px;">
        <span style="font-size: 20px;">🗺️</span> BẢN ĐỒ PHÂN VÙNG VÀ THỐNG KÊ DU LỊCH
    </h3>
    
    <div style="display: flex; gap: 40px; align-items: stretch; flex-wrap: wrap;">
        <!-- Left: Map Visualization -->
        <div style="flex: 1; min-width: 280px; display: flex; justify-content: center; position: relative; padding: 20px; background-color: #fafbfd; border-radius: 12px; border: 1px dashed #e2e8f0;">
            
            <!-- Floating Globe for Nước Ngoài -->
            <div id="globe-widget" class="region-trigger" data-region-id="4" style="position: absolute; top: 20px; right: 20px; text-align: center; cursor: pointer; transition: transform 0.2s ease;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #c084fc, #7c3aed); display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3); margin-bottom: 5px;">
                    <span style="font-size: 32px; animation: pulse-globe 3s infinite; display: inline-block;">🌍</span>
                </div>
                <div style="font-size: 11px; font-weight: 700; color: #6b21a8; text-transform: uppercase; letter-spacing: 0.5px;">Quốc Tế</div>
            </div>

            <!-- Stylized SVG Map of Vietnam -->
            <svg id="vietnam-map" viewBox="0 0 200 400" width="220" height="400" style="filter: drop-shadow(0 10px 15px rgba(0,0,0,0.05)); overflow: visible;">
                <!-- Gradients for Regions -->
                <defs>
                    <linearGradient id="grad-north" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#00e5ff" />
                        <stop offset="100%" stop-color="#00acc1" />
                    </linearGradient>
                    <linearGradient id="grad-central" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#ff7043" />
                        <stop offset="100%" stop-color="#ff5722" />
                    </linearGradient>
                    <linearGradient id="grad-south" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#34d399" />
                        <stop offset="100%" stop-color="#10b981" />
                    </linearGradient>
                </defs>

                <!-- North Region (ID 1) -->
                <path id="region-1" class="region-path region-trigger" data-region-id="1" d="M 80,20 C 110,15 130,35 125,60 C 120,80 100,95 85,105 C 75,110 60,95 55,80 C 50,60 60,30 80,20 Z" fill="url(#grad-north)" stroke="#fff" stroke-width="2" style="cursor: pointer;" />
                
                <!-- Central Region (ID 2) -->
                <path id="region-2" class="region-path region-trigger" data-region-id="2" d="M 85,115 C 95,110 105,120 110,130 C 115,145 120,165 125,185 C 130,205 135,225 140,245 C 130,250 120,240 115,220 C 110,200 105,180 95,160 C 90,140 80,125 85,115 Z" fill="url(#grad-central)" stroke="#fff" stroke-width="2" style="cursor: pointer;" />
                
                <!-- South Region (ID 3) -->
                <path id="region-3" class="region-path region-trigger" data-region-id="3" d="M 140,255 C 150,250 160,265 155,280 C 150,295 140,310 135,330 C 125,350 105,360 85,355 C 70,350 65,330 75,315 C 85,300 110,295 120,285 C 130,275 135,265 140,255 Z" fill="url(#grad-south)" stroke="#fff" stroke-width="2" style="cursor: pointer;" />

                <!-- City indicators -->
                <!-- Hanoi -->
                <circle cx="85" cy="55" r="4" fill="#ef4444" stroke="#fff" stroke-width="1" style="pointer-events: none;" />
                <circle cx="85" cy="55" r="8" fill="none" stroke="#ef4444" stroke-width="1.5" style="pointer-events: none; animation: pulse-city 2s infinite;" />
                <text x="75" y="45" font-size="8" font-weight="700" fill="#1e293b" style="pointer-events: none; font-family: Outfit, sans-serif;">Hà Nội</text>

                <!-- Da Nang -->
                <circle cx="115" cy="175" r="4" fill="#ef4444" stroke="#fff" stroke-width="1" style="pointer-events: none;" />
                <text x="123" y="178" font-size="8" font-weight="700" fill="#1e293b" style="pointer-events: none; font-family: Outfit, sans-serif;">Đà Nẵng</text>

                <!-- HCMC -->
                <circle cx="120" cy="310" r="4" fill="#ef4444" stroke="#fff" stroke-width="1" style="pointer-events: none;" />
                <text x="75" y="313" font-size="8" font-weight="700" fill="#1e293b" style="pointer-events: none; font-family: Outfit, sans-serif;">TP.HCM</text>
            </svg>
        </div>
        
        <!-- Right: Map Info Card Details -->
        <div style="flex: 1.5; min-width: 320px; display: flex; flex-direction: column; justify-content: center;">
            <div id="map-details-card" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column; justify-content: center;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <span id="region-icon" style="font-size: 36px; transition: transform 0.2s ease;">🇻🇳</span>
                    <div>
                        <h4 id="region-title" style="font-size: 20px; font-weight: 800; color: var(--text-dark); margin: 0;">Khám Phá Bản Đồ Tour</h4>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 3px 0 0 0;">Di chuyển chuột vào các vùng bản đồ để xem thống kê nhanh</p>
                    </div>
                </div>
                
                <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 15px 0;">
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="background: var(--white); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 5px; letter-spacing: 0.5px;">Số lượng Tour</div>
                        <div id="region-count" style="font-size: 22px; font-weight: 800; color: var(--primary-color);">-</div>
                    </div>
                    <div style="background: var(--white); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 5px; letter-spacing: 0.5px;">Giá trung bình</div>
                        <div id="region-avg-price" style="font-size: 22px; font-weight: 800; color: #f59e0b;">-</div>
                    </div>
                    <div style="background: var(--white); padding: 12px 15px; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 5px; letter-spacing: 0.5px;">Giá thấp nhất</div>
                        <div id="region-min-price" style="font-size: 16px; font-weight: 700; color: #10b981;">-</div>
                    </div>
                    <div style="background: var(--white); padding: 12px 15px; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 5px; letter-spacing: 0.5px;">Giá cao nhất</div>
                        <div id="region-max-price" style="font-size: 16px; font-weight: 700; color: #ef4444;">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Stats Table -->
<div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow); margin-bottom: 30px;">
    <h3 style="font-size: 16px; font-weight: 800; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
        <span style="font-size: 20px;">📊</span> BẢNG THỐNG KÊ CHI TIẾT THEO DANH MỤC KHU VỰC
    </h3>
    
    <div style="overflow-x: auto;">
        <table class="admin-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 12px 15px; text-align: center; font-weight: 700; font-size: 13px; color: #475569; width: 60px;">STT</th>
                    <th style="padding: 12px 15px; text-align: left; font-weight: 700; font-size: 13px; color: #475569;">Tên Danh Mục</th>
                    <th style="padding: 12px 15px; text-align: center; font-weight: 700; font-size: 13px; color: #475569;">Số Lượng Tour</th>
                    <th style="padding: 12px 15px; text-align: right; font-weight: 700; font-size: 13px; color: #475569;">Giá Thấp Nhất</th>
                    <th style="padding: 12px 15px; text-align: right; font-weight: 700; font-size: 13px; color: #475569;">Giá Cao Nhất</th>
                    <th style="padding: 12px 15px; text-align: right; font-weight: 700; font-size: 13px; color: #475569;">Giá Trung Bình</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($category_stats)): ?>
                    <?php foreach ($category_stats as $key => $stat): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9; hover: background-color: #f8fafc;">
                            <td style="padding: 12px 15px; text-align: center; font-size: 13px; color: var(--text-muted);"><?php echo $key + 1; ?></td>
                            <td style="padding: 12px 15px; font-weight: 600; font-size: 13px; color: var(--text-dark);"><?php echo htmlspecialchars($stat['name']); ?></td>
                            <td style="padding: 12px 15px; text-align: center; font-size: 13px; font-weight: 700; color: var(--primary-color);"><?php echo $stat['count_sp']; ?></td>
                            <td style="padding: 12px 15px; text-align: right; font-size: 13px; font-weight: 600; color: #10b981;">
                                <?php echo $stat['count_sp'] > 0 ? number_format($stat['min_price']) . 'đ' : '-'; ?>
                            </td>
                            <td style="padding: 12px 15px; text-align: right; font-size: 13px; font-weight: 600; color: #ef4444;">
                                <?php echo $stat['count_sp'] > 0 ? number_format($stat['max_price']) . 'đ' : '-'; ?>
                            </td>
                            <td style="padding: 12px 15px; text-align: right; font-size: 13px; font-weight: 700; color: #f59e0b;">
                                <?php echo $stat['count_sp'] > 0 ? number_format($stat['avg_price']) . 'đ' : '-'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding: 20px; text-align: center; color: var(--text-muted);">Không có dữ liệu thống kê nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Detailed Leaderboards Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px;">
    <!-- Top 5 Most Viewed -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow);">
        <h3 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">🔥</span> TOP 5 TOUR ĐƯỢC XEM NHIỀU NHẤT
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <?php if (!empty($top_views)): ?>
                <?php foreach ($top_views as $index => $item): ?>
                    <div style="display: flex; align-items: center; gap: 15px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                        <!-- Rank circle -->
                        <div style="width: 26px; height: 26px; border-radius: 50%; background-color: <?php echo $index == 0 ? '#ef4444' : ($index == 1 ? '#f97316' : ($index == 2 ? '#f59e0b' : '#94a3b8')); ?>; color: var(--white); display: flex; justify-content: center; align-items: center; font-size: 12px; font-weight: 700;">
                            <?php echo $index + 1; ?>
                        </div>
                        
                        <!-- Thumbnail -->
                        <img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="Tour photo" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                        
                        <!-- Info -->
                        <div style="flex: 1;">
                            <a href="../index.php?act=sanphamct&id=<?php echo $item['id']; ?>" target="_blank" style="font-size: 13px; font-weight: 700; color: var(--text-dark); text-decoration: none; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; hover: color: var(--primary-color);">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </a>
                            <span style="font-size: 11px; color: var(--text-muted);"><?php echo htmlspecialchars($item['ten_danhmuc']); ?></span>
                        </div>
                        
                        <!-- Value -->
                        <div style="text-align: right; font-size: 13px; font-weight: 700; color: #f59e0b;">
                            👁️ <?php echo number_format($item['views']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; color: var(--text-muted); padding: 20px;">Không có dữ liệu tour.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top 5 Cheapest / Saving -->
    <div class="admin-card" style="background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow);">
        <h3 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">💰</span> TOP 5 TOUR TIẾT KIỆM (GIÁ THẤP NHẤT)
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <?php if (!empty($top_cheapest)): ?>
                <?php foreach ($top_cheapest as $index => $item): ?>
                    <div style="display: flex; align-items: center; gap: 15px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                        <!-- Rank circle -->
                        <div style="width: 26px; height: 26px; border-radius: 50%; background-color: <?php echo $index == 0 ? '#10b981' : ($index == 1 ? '#22c55e' : ($index == 2 ? '#4ade80' : '#94a3b8')); ?>; color: var(--white); display: flex; justify-content: center; align-items: center; font-size: 12px; font-weight: 700;">
                            <?php echo $index + 1; ?>
                        </div>
                        
                        <!-- Thumbnail -->
                        <img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="Tour photo" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                        
                        <!-- Info -->
                        <div style="flex: 1;">
                            <a href="../index.php?act=sanphamct&id=<?php echo $item['id']; ?>" target="_blank" style="font-size: 13px; font-weight: 700; color: var(--text-dark); text-decoration: none; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; hover: color: var(--primary-color);">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </a>
                            <span style="font-size: 11px; color: var(--text-muted);"><?php echo htmlspecialchars($item['ten_danhmuc']); ?></span>
                        </div>
                        
                        <!-- Value -->
                        <div style="text-align: right; font-size: 13px; font-weight: 800; color: #10b981;">
                            <?php echo number_format($item['price']); ?>đ
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; color: var(--text-muted); padding: 20px;">Không có dữ liệu tour.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Scripts xử lý biểu đồ và bản đồ tương tác -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ----------------------------------------------------
    // 1. BIỂU ĐỒ HÌNH TRÒN (PHÂN BỔ TOUR)
    // ----------------------------------------------------
    const ctxPie = document.getElementById('categoryPieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($js_categories); ?>,
            datasets: [{
                data: <?php echo json_encode($js_counts); ?>,
                backgroundColor: <?php echo json_encode($js_colors); ?>,
                hoverBackgroundColor: <?php echo json_encode($js_hover_colors); ?>,
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: {
                            family: 'Outfit',
                            size: 11,
                            weight: '600'
                        },
                        color: '#475569'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = <?php echo $total_products > 0 ? $total_products : 1; ?>;
                            const percentage = Math.round(context.raw / total * 100);
                            return ' ' + context.label + ': ' + context.raw + ' Tour (' + percentage + '%)';
                        }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // ----------------------------------------------------
    // 2. BIỂU ĐỒ CỘT (LƯỢT XEM TOP TOUR)
    // ----------------------------------------------------
    const ctxBar = document.getElementById('viewsBarChart').getContext('2d');
    
    // Rút ngắn tên các tour dài để hiển thị biểu đồ đẹp hơn
    const tourLabels = <?php echo json_encode($js_top_tours); ?>.map(name => {
        return name.length > 22 ? name.substring(0, 20) + '...' : name;
    });

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: tourLabels,
            datasets: [{
                label: 'Lượt xem',
                data: <?php echo json_encode($js_top_views); ?>,
                backgroundColor: 'rgba(255, 87, 34, 0.85)',
                hoverBackgroundColor: '#e64a19',
                borderRadius: 6,
                borderWidth: 0,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.raw.toLocaleString() + ' lượt xem';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        font: {
                            family: 'Outfit',
                            size: 10
                        },
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Outfit',
                            size: 10,
                            weight: '500'
                        },
                        color: '#64748b'
                    }
                }
            }
        }
    });

    // ----------------------------------------------------
    // 3. BẢN ĐỒ VIỆT NAM TƯƠNG TÁC (SVG INTERACTIVE MAP)
    // ----------------------------------------------------
    const mapData = <?php echo json_encode($map_data); ?>;
    const regionIcons = {
        1: '🏔️', // Miền Bắc (Núi non)
        2: '🏖️', // Miền Trung (Biển xanh)
        3: '🌴', // Miền Nam (Sông nước rặng dừa)
        4: '🌍'  // Nước Ngoài (Quả địa cầu)
    };

    document.querySelectorAll('.region-trigger').forEach(trigger => {
        trigger.addEventListener('mouseenter', function() {
            const regionId = parseInt(this.getAttribute('data-region-id'));
            const data = mapData[regionId];
            
            if (data) {
                // Thêm hiệu ứng highlight bằng Javascript trực tiếp để tránh lỗi CSS transform SVG
                if (this.classList.contains('region-path')) {
                    this.style.stroke = 'var(--text-dark)';
                    this.style.strokeWidth = '3px';
                    this.style.filter = 'brightness(0.9) drop-shadow(0 6px 12px rgba(0,0,0,0.25))';
                } else if (this.id === 'globe-widget') {
                    this.style.transform = 'scale(1.08)';
                }
                
                // Cập nhật thẻ chi tiết thông tin thống kê khu vực
                document.getElementById('region-icon').textContent = regionIcons[regionId] || '🇻🇳';
                document.getElementById('region-title').textContent = data.name;
                document.getElementById('region-count').textContent = data.count + ' Tour';
                document.getElementById('region-avg-price').textContent = data.count > 0 ? formatMoney(data.avg_price) : '-';
                document.getElementById('region-min-price').textContent = data.count > 0 ? formatMoney(data.min_price) : '-';
                document.getElementById('region-max-price').textContent = data.count > 0 ? formatMoney(data.max_price) : '-';
                
                // Đổi màu nền thẻ chi tiết tương ứng với màu sắc từng vùng miền
                const card = document.getElementById('map-details-card');
                if (regionId === 1) {
                    card.style.background = 'linear-gradient(135deg, #e0f7fa, #b2ebf2)';
                } else if (regionId === 2) {
                    card.style.background = 'linear-gradient(135deg, #ffe0b2, #ffcc80)';
                } else if (regionId === 3) {
                    card.style.background = 'linear-gradient(135deg, #e8f5e9, #c8e6c9)';
                } else if (regionId === 4) {
                    card.style.background = 'linear-gradient(135deg, #f3e5f5, #e1bee7)';
                }
            }
        });
        
        trigger.addEventListener('mouseleave', function() {
            // Khôi phục trạng thái ban đầu khi rời chuột
            if (this.classList.contains('region-path')) {
                this.style.stroke = '#fff';
                this.style.strokeWidth = '2px';
                this.style.filter = '';
            } else if (this.id === 'globe-widget') {
                this.style.transform = '';
            }
        });
    });

    function formatMoney(amount) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
            .format(amount)
            .replace('₫', 'đ');
    }

    // ----------------------------------------------------
    // 4. BIỂU ĐỒ LINE CHART (ONLINE STORE VISITORS)
    // ----------------------------------------------------
    const ctxVisitors = document.getElementById('visitorsLineChart').getContext('2d');
    new Chart(ctxVisitors, {
        type: 'line',
        data: {
            labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
            datasets: [
                {
                    label: 'This Week',
                    data: [100, 120, 170, 167, 180, 177, 160],
                    borderColor: '#007aff',
                    backgroundColor: '#007aff',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: false
                },
                {
                    label: 'Last Week',
                    data: [60, 80, 70, 68, 80, 76, 100],
                    borderColor: '#cbd5e1',
                    backgroundColor: '#cbd5e1',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: {
                            family: 'Outfit',
                            size: 11,
                            weight: '600'
                        },
                        color: '#64748b'
                    }
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 200,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        stepSize: 20,
                        font: {
                            family: 'Outfit',
                            size: 10
                        },
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Outfit',
                            size: 10
                        },
                        color: '#64748b'
                    }
                }
            }
        }
    });

    // ----------------------------------------------------
    // 5. BIỂU ĐỒ BAR CHART (SALES)
    // ----------------------------------------------------
    const ctxSales = document.getElementById('salesBarChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'This year',
                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000],
                    backgroundColor: '#007aff',
                    borderRadius: 4,
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                },
                {
                    label: 'Last year',
                    data: [700, 1700, 2700, 2000, 1800, 1500, 2000],
                    backgroundColor: '#cbd5e1',
                    borderRadius: 4,
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: {
                            family: 'Outfit',
                            size: 11,
                            weight: '600'
                        },
                        color: '#64748b'
                    }
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 3000,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        stepSize: 500,
                        callback: function(value) {
                            if (value === 0) return '$0';
                            if (value >= 1000) return '$' + (value / 1000) + 'k';
                            return '$' + value;
                        },
                        font: {
                            family: 'Outfit',
                            size: 10
                        },
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Outfit',
                            size: 10
                        },
                        color: '#64748b'
                    }
                }
            }
        }
    });

    // Thiết lập vùng hiển thị mặc định ban đầu là Miền Bắc (ID 1)
    const defaultRegion = document.getElementById('region-1');
    if (defaultRegion) {
        const event = new Event('mouseenter');
        defaultRegion.dispatchEvent(event);
    }
});
</script>
