<div class="container" style="margin-top: 40px; margin-bottom: 60px;">
    <!-- Page Layout Wrapper -->
    <div style="display: flex; gap: 40px; align-items: flex-start; flex-wrap: wrap;">
        
        <!-- Left Column: Articles List (70%) -->
        <div style="flex: 2.3; min-width: 320px;">
            <div style="display: flex; flex-direction: column; gap: 35px;">
                <?php 
                if (empty($list_tintuc)) {
                    echo '<p style="text-align: center; color: var(--text-muted); padding: 40px;">Hiện chưa có bài viết kinh nghiệm nào.</p>';
                } else {
                    foreach ($list_tintuc as $item):
                        // Parse date badge (e.g., "02 Th11" -> Day "02", Month "Th11")
                        $date_parts = explode(' ', $item['date']);
                        $day = isset($date_parts[0]) ? $date_parts[0] : '02';
                        $month = isset($date_parts[1]) ? $date_parts[1] : 'Th11';
                ?>
                    <!-- Article Card -->
                    <article style="display: flex; gap: 25px; align-items: flex-start; flex-wrap: wrap; background-color: var(--white); border-radius: 8px; overflow: hidden; transition: transform var(--transition-speed); padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                        <!-- Image Container with Date Badge -->
                        <div style="position: relative; flex: 1; min-width: 260px; max-width: 320px; height: 180px; overflow: hidden; border-radius: 6px;">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-speed);" class="article-img">
                            
                            <!-- Date Badge -->
                            <div style="position: absolute; top: 12px; left: 12px; background-color: var(--primary-color); color: var(--white); border-radius: 4px; padding: 6px 10px; text-align: center; font-family: var(--font-family); box-shadow: 0 4px 10px rgba(0,0,0,0.15); line-height: 1.2;">
                                <div style="font-size: 18px; font-weight: 800;"><?php echo htmlspecialchars($day); ?></div>
                                <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; margin-top: 2px; opacity: 0.9;"><?php echo htmlspecialchars($month); ?></div>
                            </div>
                        </div>

                        <!-- Content Info -->
                        <div style="flex: 1.5; min-width: 280px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                            <div>
                                <h3 style="font-size: 18px; font-weight: 700; color: #475569; margin: 0 0 12px 0; line-height: 1.4; transition: color var(--transition-speed);">
                                    <a href="#" style="text-decoration: none; color: inherit;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='inherit'">
                                        <?php echo htmlspecialchars($item['title']); ?>
                                    </a>
                                </h3>
                                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin: 0 0 15px 0;">
                                    <?php echo htmlspecialchars($item['description']); ?>
                                </p>
                            </div>
                        </div>
                    </article>
                <?php 
                    endforeach;
                }
                ?>
            </div>
        </div>

        <!-- Right Column: Sidebar (30%) -->
        <aside style="flex: 1; min-width: 300px; display: flex; flex-direction: column; gap: 40px;">
            
            <!-- Callback Request Widget -->
            <div style="background-color: #f8fafc; border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; box-shadow: var(--card-shadow);">
                <h4 style="font-size: 15px; font-weight: 800; color: var(--primary-color); margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                    Liên hệ càng sớm – Giá càng rẻ
                </h4>
                
                <!-- Graphic or Icon line -->
                <div style="width: 40px; height: 3px; background-color: var(--secondary-color); margin-bottom: 15px;"></div>
                
                <p style="font-size: 13px; color: var(--text-dark); font-weight: 500; line-height: 1.5; margin-bottom: 20px;">
                    Hoặc để lại số điện thoại, chúng tôi sẽ gọi lại cho bạn sau ít phút !
                </p>
                
                <form id="sidebar-callback-form" onsubmit="handleCallback(event)" style="display: flex; flex-direction: column; gap: 12px;">
                    <input type="tel" id="callback-phone" placeholder="Số điện thoại của tôi là" required
                           style="padding: 10px 15px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; font-size: 13px; width: 100%; transition: border-color var(--transition-speed);">
                           
                    <button type="submit" 
                            style="background-color: var(--secondary-color); color: var(--white); border: none; padding: 12px; border-radius: 6px; font-weight: 700; font-size: 13px; cursor: pointer; transition: background-color var(--transition-speed); text-transform: uppercase; letter-spacing: 0.5px;">
                        Yêu cầu gọi lại
                    </button>
                </form>
                
                <div id="callback-success" style="display: none; background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 10px; border-radius: 6px; font-size: 12px; margin-top: 15px; text-align: center; font-weight: 600;">
                    🎉 Đã ghi nhận! Chúng tôi sẽ liên hệ lại ngay.
                </div>
            </div>

            <!-- Hot Tours & Hotels List -->
            <div>
                <h4 style="font-size: 14px; font-weight: 800; color: var(--text-dark); margin: 0 0 15px 0; text-transform: uppercase; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">
                    Tour – Khách Sạn Hot
                </h4>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <!-- Hot Tours -->
                    <?php if (!empty($list_tours_sidebar)): ?>
                        <?php 
                        // Mock original prices matching screenshot
                        $mock_prices = [
                            15 => ['old' => '5,200,000 đ', 'new' => '4,000,000 đ'],
                            14 => ['old' => '4,200,000 đ', 'new' => '3,000,000 đ'],
                            13 => ['old' => '2,200,000 đ', 'new' => '1,800,000 đ']
                        ];
                        foreach ($list_tours_sidebar as $tour):
                            $price_old = isset($mock_prices[$tour['id']]) ? $mock_prices[$tour['id']]['old'] : number_format($tour['price'] * 1.3) . ' đ';
                            $price_new = isset($mock_prices[$tour['id']]) ? $mock_prices[$tour['id']]['new'] : number_format($tour['price']) . ' đ';
                        ?>
                            <div style="display: flex; gap: 12px; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed var(--border-color);">
                                <img src="<?php echo htmlspecialchars($tour['image']); ?>" alt="Tour photo" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                <div style="flex: 1;">
                                    <a href="index.php?act=sanphamct&id=<?php echo $tour['id']; ?>" style="font-size: 12.5px; font-weight: 700; color: var(--text-dark); text-decoration: none; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" class="sidebar-item-title">
                                        <?php echo htmlspecialchars($tour['name']); ?>
                                    </a>
                                    <div style="display: flex; gap: 8px; align-items: center; margin-top: 3px;">
                                        <span style="font-size: 11px; text-decoration: line-through; color: var(--primary-color);"><?php echo $price_old; ?></span>
                                        <span style="font-size: 12px; font-weight: 700; color: #00acc1;"><?php echo $price_new; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Hot Hotels -->
                    <?php if (!empty($list_hotels_sidebar)): ?>
                        <?php 
                        $mock_hotel_prices = [
                            1 => ['old' => '850,000 đ', 'new' => '680,000 đ'],
                            2 => ['old' => '650,000 đ', 'new' => '580,000 đ']
                        ];
                        foreach ($list_hotels_sidebar as $hotel):
                            $h_old = isset($mock_hotel_prices[$hotel['id']]) ? $mock_hotel_prices[$hotel['id']]['old'] : number_format($hotel['price'] * 1.25) . ' đ';
                            $h_new = isset($mock_hotel_prices[$hotel['id']]) ? $mock_hotel_prices[$hotel['id']]['new'] : number_format($hotel['price']) . ' đ';
                        ?>
                            <div style="display: flex; gap: 12px; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed var(--border-color);">
                                <img src="<?php echo htmlspecialchars($hotel['image']); ?>" alt="Hotel photo" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                <div style="flex: 1;">
                                    <a href="index.php?act=khachsan" style="font-size: 12.5px; font-weight: 700; color: var(--text-dark); text-decoration: none; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" class="sidebar-item-title">
                                        <?php echo htmlspecialchars($hotel['name']); ?>
                                    </a>
                                    <div style="display: flex; gap: 8px; align-items: center; margin-top: 3px;">
                                        <span style="font-size: 11px; text-decoration: line-through; color: var(--primary-color);"><?php echo $h_old; ?></span>
                                        <span style="font-size: 12px; font-weight: 700; color: #00acc1;"><?php echo $h_new; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- New Articles Widget -->
            <div>
                <h4 style="font-size: 14px; font-weight: 800; color: var(--text-dark); margin: 0 0 15px 0; text-transform: uppercase; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">
                    Bài Viết Mới
                </h4>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <?php 
                    // Show top 3 recent articles
                    $recent_articles = array_slice($list_tintuc, 0, 3);
                    foreach ($recent_articles as $recent):
                        $r_date_parts = explode(' ', $recent['date']);
                        $r_day = isset($r_date_parts[0]) ? $r_date_parts[0] : '02';
                        $r_month = isset($r_date_parts[1]) ? $r_date_parts[1] : 'Th11';
                    ?>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <!-- Small Date Badge -->
                            <div style="background-color: #334155; color: var(--white); border-radius: 4px; padding: 4px 6px; text-align: center; font-family: var(--font-family); min-width: 42px; line-height: 1.1;">
                                <div style="font-size: 13px; font-weight: 800;"><?php echo htmlspecialchars($r_day); ?></div>
                                <div style="font-size: 8px; font-weight: 600; text-transform: uppercase; opacity: 0.8; margin-top: 1px;"><?php echo htmlspecialchars($r_month); ?></div>
                            </div>
                            
                            <a href="#" style="flex: 1; font-size: 13px; font-weight: 700; color: var(--text-dark); text-decoration: none; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" class="sidebar-recent-title">
                                <?php echo htmlspecialchars($recent['title']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </aside>
    </div>
</div>

<script>
function handleCallback(event) {
    event.preventDefault();
    const phoneInput = document.getElementById('callback-phone');
    const successMessage = document.getElementById('callback-success');
    
    if (phoneInput.value.trim() !== '') {
        successMessage.style.display = 'block';
        phoneInput.value = '';
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    }
}
</script>

<style>
.article-img:hover {
    transform: scale(1.05);
}
.sidebar-item-title:hover, .sidebar-recent-title:hover {
    color: var(--primary-color) !important;
}
</style>
