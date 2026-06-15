<?php
require_once 'pdo.php';

/**
 * Lớp ThueXeModel quản lý các truy vấn bảng xe cho thuê (thuexe)
 */
class ThueXeModel {
    /**
     * Lấy tất cả phương tiện xe thuê
     */
    public static function selectAll() {
        $sql = "SELECT * FROM thuexe ORDER BY id DESC";
        return Database::query($sql);
    }

    /**
     * Lấy chi tiết xe thuê theo ID
     */
    public static function selectById($id) {
        $sql = "SELECT * FROM thuexe WHERE id = ?";
        return Database::queryOne($sql, [$id]);
    }

    /**
     * Thêm xe thuê mới
     */
    public static function insert($name, $image, $description, $price, $address, $rating) {
        $sql = "INSERT INTO thuexe (name, image, description, price, address, rating) VALUES (?, ?, ?, ?, ?, ?)";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating]);
    }

    /**
     * Cập nhật thông tin xe thuê
     */
    public static function update($id, $name, $image, $description, $price, $address, $rating) {
        $sql = "UPDATE thuexe SET name = ?, image = ?, description = ?, price = ?, address = ?, rating = ? WHERE id = ?";
        Database::execute($sql, [$name, $image, $description, $price, $address, $rating, $id]);
    }

    /**
     * Xóa xe thuê theo ID
     */
    public static function delete($id) {
        $sql = "DELETE FROM thuexe WHERE id = ?";
        Database::execute($sql, [$id]);
    }

    /**
     * Tự động khởi tạo và seed dữ liệu 100 xe du lịch
     */
    public static function seed100() {
        $sql_schema = "
        DROP TABLE IF EXISTS `thuexe`;
        CREATE TABLE IF NOT EXISTS `thuexe` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `image` varchar(255) NOT NULL,
          `description` text DEFAULT NULL,
          `price` double NOT NULL DEFAULT 0,
          `address` varchar(255) NOT NULL,
          `rating` float NOT NULL DEFAULT 5,
          `views` int(11) NOT NULL DEFAULT 0,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        Database::getConnection()->exec($sql_schema);

        $cars = [
            // 1 - 20
            ['Kia Morning 2021 (Tự lái)', 550000, 'Quận Hải Châu, Đà Nẵng', 'Dòng xe Hatchback 4 chỗ nhỏ gọn, số tự động, tiết kiệm nhiên liệu, rất thích hợp đi lại trong nội thành Đà Nẵng.'],
            ['Hyundai Grand i10 2022 (Tự lái)', 580000, 'Quận Hoàn Kiếm, Hà Nội', 'Hatchback 4 chỗ rộng rãi, số sàn êm ái, thích hợp cho gia đình nhỏ đi du lịch dã ngoại hoặc công tác ngắn ngày.'],
            ['VinFast Fadil 1.4 Premium (Tự lái)', 600000, 'Quận 1, TP. Hồ Chí Minh', 'Dòng xe Hatchback phân khúc A mạnh mẽ bậc nhất, số tự động vô cấp CVT, trang bị hệ thống an toàn tối ưu.'],
            ['Toyota Vios 1.5G 2021 (Tự lái)', 750000, 'Quận Sơn Trà, Đà Nẵng', 'Dòng sedan 5 chỗ quốc dân, số tự động, khoang hành lý rộng rãi, xe vận hành bền bỉ, tiết kiệm nhiên liệu.'],
            ['Honda City RS 2022 (Tự lái)', 800000, 'Quận Cầu Giấy, Hà Nội', 'Sedan 5 chỗ thể thao cá tính, số tự động vô cấp CVT, nội thất bọc da pha nỉ hiện đại, điều hòa mát sâu.'],
            ['Hyundai Accent Athletic 2022 (Tự lái)', 780000, 'Quận 3, TP. Hồ Chí Minh', 'Sedan 5 chỗ kiểu dáng trẻ trung năng động, số tự động, có trang bị cửa sổ trời và bản đồ định vị thông minh.'],
            ['Mazda 3 Premium 2022 (Tự lái)', 950000, 'Quận Tây Hồ, Hà Nội', 'Sedan phân khúc C cao cấp kiểu dáng Kodo sang trọng thời thượng, số tự động, hỗ trợ Apple CarPlay không dây.'],
            ['Kia K3 Luxury 1.6 2022 (Tự lái)', 900000, 'Quận Ngũ Hành Sơn, Đà Nẵng', 'Sedan 5 chỗ ngồi rộng rãi thoải mái bậc nhất, số tự động, trang bị điều hòa độc lập và sạc không dây.'],
            ['Hyundai Elantra 2.0 2021 (Tự lái)', 880000, 'Quận Tân Bình, TP. Hồ Chí Minh', 'Dòng sedan thể thao cao cấp, số tự động, không gian lái yên tĩnh, giảm chấn cực tốt mang lại hành trình thoải mái.'],
            ['Honda Civic RS Turbo 2022 (Tự lái)', 1100000, 'Quận Long Biên, Hà Nội', 'Sedan thể thao đẳng cấp cao, động cơ tăng áp 1.5L VTEC Turbo cực bốc, trang bị gói an toàn thông minh Honda Sensing.'],
            ['Toyota Camry 2.5Q 2021 (Tự lái)', 1400000, 'Quận 7, TP. Hồ Chí Minh', 'Sedan hạng D sang trọng đẳng cấp, số tự động, hàng ghế sau ngả lưng chỉnh điện và hệ thống âm thanh JBL cao cấp.'],
            ['Mazda 6 Signature 2021 (Tự lái)', 1300000, 'Quận Hải Châu, Đà Nẵng', 'Sedan hạng D thời thượng phong cách thể thao, trang bị phanh tay điện tử, màn hình HUD và camera 360 sắc nét.'],
            ['VinFast Lux A2.0 Premium (Tự lái)', 1200000, 'Quận Đống Đa, Hà Nội', 'Sedan hạng E cao cấp gầm bệ chắc chắn chuẩn Đức, động cơ 2.0L tăng áp dẫn động cầu sau cho cảm giác lái đầm chắc.'],
            ['VinFast VF e34 Điện (Tự lái)', 800000, 'Quận Liên Chiểu, Đà Nẵng', 'Dòng Crossover điện thông minh 5 chỗ rộng rãi, sạc nhanh tiện lợi, tích hợp trợ lý ảo tiếng Việt cực kỳ thông minh.'],
            ['VinFast VF 8 Plus Điện (Tự lái)', 1400000, 'Quận Hoàn Kiếm, Hà Nội', 'SUV điện 5 chỗ thông minh cao cấp, động cơ điện kép dẫn động 4 bánh siêu tốc độ, trang bị hỗ trợ lái nâng cao ADAS.'],
            ['VinFast VF 9 Plus Điện (Có tài)', 2500000, 'Quận 2, TP. Hồ Chí Minh', 'Siêu SUV điện 7 chỗ cỡ lớn, ghế thương gia tích hợp massage thông gió cao cấp, phù hợp đưa đón tiếp khách VIP.'],
            ['Mercedes-Benz C200 Avantgarde 2021 (Có tài)', 2800000, 'Quận 3, TP. Hồ Chí Minh', 'Sedan hạng sang từ hãng xe Đức, xe hoa đám cưới lịch lãm hoặc đưa đón hội nghị VIP kèm tài xế chuyên nghiệp.'],
            ['Mercedes-Benz E300 AMG 2022 (Có tài)', 3800000, 'Quận Hoàn Kiếm, Hà Nội', 'Sedan hạng sang cao cấp, nội thất ốp gỗ cao cấp và đèn viền 64 màu, phục vụ khách hàng thượng lưu chu đáo nhất.'],
            ['BMW 520i M Sport 2022 (Có tài)', 3800000, 'Quận 1, TP. Hồ Chí Minh', 'Xe sang phong cách thể thao mạnh mẽ Đức, xe luôn được vệ sinh sạch sẽ thơm tho, phục vụ đưa đón đúng giờ.'],
            ['Lexus RX350 Premium 2021 (Có tài)', 4200000, 'Quận Hải Châu, Đà Nẵng', 'SUV hạng sang Nhật Bản vận hành êm ái cách âm tuyệt đối, mang lại trải nghiệm đỉnh cao cho hành trình tiếp khách.'],

            // 21 - 40
            ['Mitsubishi Xpander Premium 2022 (Tự lái)', 850000, 'Quận Cẩm Lệ, Đà Nẵng', 'Xe đa dụng MPV 7 chỗ bán chạy nhất Việt Nam, gầm cao thoáng đạt, số tự động lái nhẹ nhàng và tiết kiệm nhiên liệu.'],
            ['Toyota Veloz Cross Top 2022 (Tự lái)', 950000, 'Quận Thanh Xuân, Hà Nội', 'MPV 7 chỗ thông minh, số tự động CVT, sạc điện thoại không dây, màn hình trần giải trí cho hành khách phía sau.'],
            ['Suzuki XL7 Sport Limited 2021 (Tự lái)', 880000, 'Quận Bình Thạnh, TP. Hồ Chí Minh', 'SUV 7 chỗ kiểu dáng cá tính năng động, điều hòa làm lạnh nhanh, camera 360 hỗ trợ đỗ xe dễ dàng.'],
            ['Toyota Innova 2.0E 2020 (Tự lái)', 900000, 'Quận Ba Đình, Hà Nội', 'Xe 7 chỗ rộng rãi bền bỉ trứ danh, động cơ 2.0L mạnh mẽ khỏe khoắn, gầm cao thích hợp đi các cung đường xa.'],
            ['Toyota Innova Venturer 2021 (Tự lái)', 1000000, 'Quận Sơn Trà, Đà Nẵng', 'Dòng Innova phiên bản thể thao cá tính, 7 chỗ ngồi tiện nghi thoải mái thích hợp phục vụ cả gia đình đi du lịch.'],
            ['Hyundai Tucson 2.0 Premium 2022 (Tự lái)', 1100000, 'Quận Cầu Giấy, Hà Nội', 'SUV 5 chỗ thiết kế phá cách hiện đại, số tự động, trang bị màn hình cảm ứng kép cỡ lớn và cốp điện thông minh.'],
            ['Mazda CX-5 2.0 Premium 2022 (Tự lái)', 1100000, 'Quận 2, TP. Hồ Chí Minh', 'SUV 5 chỗ thiết kế thời thượng cá tính, số tự động, hệ thống 10 loa Bose mang lại không gian âm nhạc sống động.'],
            ['Honda CR-V 1.5 L 2021 (Tự lái)', 1200000, 'Quận Thanh Khê, Đà Nẵng', 'SUV 7 chỗ (5+2) cao cấp bền bỉ, động cơ 1.5L Turbo tiết kiệm xăng, tích hợp cửa sổ trời toàn cảnh panorama.'],
            ['Mitsubishi Outlander 2.0 Premium 2021 (Tự lái)', 1050000, 'Quận Sơn Trà, Đà Nẵng', 'SUV 7 chỗ rộng rãi, cách âm tốt bậc nhất phân khúc, số tự động êm ái, ghế lái chỉnh điện tiện dụng.'],
            ['Kia Seltos 1.4 Premium 2022 (Tự lái)', 850000, 'Quận Đống Đa, Hà Nội', 'SUV cỡ nhỏ năng động trẻ trung, số tự động, gầm cao linh hoạt đi trong phố lẫn đường trường đều rất đầm.'],
            ['Hyundai Creta 1.5 Cao Cấp 2022 (Tự lái)', 850000, 'Quận Gò Vấp, TP. Hồ Chí Minh', 'SUV đô thị 5 chỗ hiện đại, trang bị phanh tay điện tử, làm mát ghế lái và hệ thống loa Bose cao cấp.'],
            ['Toyota Corolla Cross 1.8V 2022 (Tự lái)', 1000000, 'Quận Liên Chiểu, Đà Nẵng', 'Crossover 5 chỗ nhập khẩu Thái Lan bền bỉ, trang bị gói an toàn Toyota Safety Sense cao cấp cực kỳ an tâm.'],
            ['Kia Sportage Signature 2022 (Tự lái)', 1150000, 'Quận Tây Hồ, Hà Nội', 'SUV 5 chỗ thiết kế tương lai hiện đại, số tự động, cửa sổ trời toàn cảnh, ghế chỉnh điện sấy sưởi đa năng.'],
            ['Ford Territory Titanium 2023 (Tự lái)', 1100000, 'Quận 1, TP. Hồ Chí Minh', 'SUV 5 chỗ thế hệ mới rộng rãi tiện nghi vượt trội phân khúc, số tự động, sạc không dây và phanh tự động khẩn cấp.'],
            ['Peugeot 3008 Active 2021 (Tự lái)', 1200000, 'Quận Hải Châu, Đà Nẵng', 'SUV 5 chỗ thương hiệu Pháp thiết kế khoang lái i-Cockpit độc đáo như máy bay, số tự động vận hành đầm chắc.'],
            ['Hyundai SantaFe 2.2 Dầu Premium 2021 (Tự lái)', 1500000, 'Quận Cầu Giấy, Hà Nội', 'SUV 7 chỗ máy dầu cao cấp êm ái, số tự động 8 cấp, trang bị dẫn động 4 bánh HTRAC vượt mọi địa hình trơn trượt.'],
            ['Kia Sorento Signature Dầu 2022 (Tự lái)', 1500000, 'Quận 7, TP. Hồ Chí Minh', 'SUV 7 chỗ máy dầu cao cấp, nội thất bọc da nappa cao cấp, trang bị sưởi/thông gió ghế và HUD hiển thị kính lái.'],
            ['Toyota Fortuner 2.4 Dầu 2021 (Tự lái)', 1300000, 'Thành phố Nha Trang, Khánh Hòa', 'SUV 7 chỗ gầm cao cơ bắp máy dầu bền bỉ tiết kiệm nhiên liệu, phù hợp chở gia đình chinh phục đồi cát Nha Trang.'],
            ['Ford Everest Titanium 2.0 Bi-Turbo 2022 (Tự lái)', 1600000, 'Thành phố Đà Lạt, Lâm Đồng', 'SUV 7 chỗ gầm cao nhập khẩu, động cơ tăng áp kép cực kỳ mạnh mẽ đầm chắc, phù hợp đổ đèo dốc uốn lượn Đà Lạt.'],
            ['VinFast Lux SA2.0 Cao Cấp 2021 (Tự lái)', 1600000, 'Quận Ngũ Hành Sơn, Đà Nẵng', 'SUV 7 chỗ cỡ lớn dẫn động 4 bánh toàn thời gian AWD, gầm cao cách âm đỉnh cao mang lại sự êm ái cho hành trình.'],

            // 41 - 60
            ['Mitsubishi Pajero Sport Dầu 2021 (Tự lái)', 1350000, 'Quận Gò Vấp, TP. Hồ Chí Minh', 'SUV 7 chỗ gầm cao thực thụ máy dầu mạnh mẽ, số tự động 8 cấp có lẫy chuyển số vô lăng thể thao.'],
            ['Isuzu mu-X B7 Plus 2022 (Tự lái)', 1100000, 'Quận Long Biên, Hà Nội', 'SUV 7 chỗ thực dụng nhập khẩu Thái Lan bền bỉ dẻo dai, máy dầu cực kỳ tiết kiệm nhiên liệu cho chuyến đi dài.'],
            ['Ford Ranger Wildtrak 2.0 Bi-Turbo 2021 (Tự lái)', 1100000, 'Quận Hải Châu, Đà Nẵng', 'Xe bán tải 5 chỗ ngồi thể thao cơ bắp Mỹ, động cơ tăng áp kép dẫn động 4 bánh chủ động, thích hợp du lịch mạo hiểm.'],
            ['Toyota Hilux Adventure 2.8 2021 (Tự lái)', 1100000, 'Quận Tân Bình, TP. Hồ Chí Minh', 'Xe bán tải bền bỉ hàng đầu nhập khẩu nguyên chiếc, số tự động, cabin kép tiện nghi thoải mái chở hành lý cắm trại.'],
            ['Mitsubishi Triton Athlete 2022 (Tự lái)', 1000000, 'Quận Cầu Giấy, Hà Nội', 'Bán tải thể thao thiết kế Dynamic Shield hiện đại gầm cao, số tự động vận hành êm ái đầm chắc chắn.'],
            ['Ford Transit Luxury 16 chỗ (Có tài)', 1500000, 'Quận Long Biên, Hà Nội', 'Dòng xe 16 chỗ phục vụ du lịch đoàn đông người, ghế da ngả độc lập thoải mái, điều hòa hai dàn lạnh chạy mát rượi.'],
            ['Hyundai Solati 16 chỗ VIP (Có tài)', 1800000, 'Quận Hải Châu, Đà Nẵng', 'Dòng xe 16 chỗ phân khúc cao cấp trần xe cao thoáng đãng, số sàn, trang bị bệ bước tự động, khoang để hành lý rộng.'],
            ['Toyota Hiace Cá Mập 16 chỗ (Có tài)', 1400000, 'Quận 1, TP. Hồ Chí Minh', 'Dòng xe 16 chỗ nhập khẩu Nhật Bản bền bỉ tiết kiệm xăng, thích hợp đưa đón nhân viên hoặc gia đình đi chơi xa.'],
            ['Ford Transit Limousine Dcar 9 chỗ (Có tài)', 2200000, 'Quận Hoàn Kiếm, Hà Nội', 'Chuyên cơ mặt đất Limousine 9 ghế da thương gia chỉnh điện, tích hợp massage nâng đỡ chân và cổng sạc usb.'],
            ['Hyundai Solati Limousine Dcar 12 chỗ (Có tài)', 2500000, 'Quận Hải Châu, Đà Nẵng', 'Xe Limousine 12 chỗ ngồi rộng rãi bọc da cao cấp, trang bị tủ lạnh mini, wifi tốc độ cao và tivi led giải trí.'],
            ['Ford Transit Limousine 16 chỗ (Có tài)', 2800000, 'Quận 3, TP. Hồ Chí Minh', 'Limousine 16 chỗ ngồi tiện nghi sang trọng thích hợp đưa đón đoàn doanh nhân, golfer dự giải đấu sang trọng.'],
            ['Toyota Fortuner Limousine 7 chỗ (Có tài)', 2000000, 'Thành phố Nha Trang, Khánh Hòa', 'SUV Fortuner độ Limousine sang trọng, ghế ngồi khoang VIP rộng rãi êm ái, tài xế bản địa đưa đón tận tình.'],
            ['Kia Sedona Carnival 2.2 Dầu 2020 (Tự lái)', 1300000, 'Quận Tây Hồ, Hà Nội', 'Mẫu xe MPV 7 chỗ cỡ lớn gia đình cực kỳ tiện nghi rộng rãi, số tự động cửa lùa điện hai bên vô cùng tiện lợi.'],
            ['Kia Carnival Premium 2022 (Tự lái)', 1800000, 'Quận Hải Châu, Đà Nẵng', 'Mẫu MPV thế hệ mới siêu rộng rãi thiết kế lịch lãm đẳng cấp, số tự động, thích hợp đi gia đình đông người du lịch.'],
            ['Kia Carnival Royal 4 chỗ VIP (Có tài)', 3500000, 'Quận 1, TP. Hồ Chí Minh', 'Phiên bản Carnival hoàng gia với 4 chỗ ngồi siêu VIP biệt lập, vách ngăn tivi led 32 inch, tài xế phục vụ chuẩn VIP.'],
            ['Toyota Alphard Luxury 2021 (Có tài)', 4500000, 'Quận Hoàn Kiếm, Hà Nội', 'Chuyên cơ mặt đất Toyota Alphard sang trọng bậc nhất, ghế thương gia chỉnh điện đa hướng, tài xế tận tâm chuyên nghiệp.'],
            ['Hyundai Starex 9 chỗ 2019 (Tự lái)', 950000, 'Quận Cầu Giấy, Hà Nội', 'Mẫu xe MPV 9 chỗ ngồi thực dụng bền bỉ, số tự động êm ái, thích hợp chở nhiều người du lịch chi phí tiết kiệm.'],
            ['Ford Tourneo Titanium 2020 (Tự lái)', 1000000, 'Quận Bình Thạnh, TP. Hồ Chí Minh', 'Xe MPV 7 chỗ ngồi phong cách Châu Âu rộng rãi, treo khí nén phía sau êm ái thoải mái cho người ngồi suốt chuyến đi.'],
            ['Mercedes-Benz V250 Luxury 2020 (Có tài)', 3200000, 'Quận 7, TP. Hồ Chí Minh', 'Dòng xe MPV hạng sang thương hiệu ngôi sao ba cánh Đức, ghế VIP chỉnh điện, thích hợp đi lại làm việc hoặc tiếp đối tác.'],
            ['Lexus LM300h 4 chỗ siêu VIP (Có tài)', 6000000, 'Quận Hoàn Kiếm, Hà Nội', 'Đỉnh cao chuyên cơ mặt đất sang trọng Lexus LM300h, vách ngăn riêng tư, tủ lạnh, ghế massage hoàng gia có tài xế phục vụ.'],

            // 61 - 80 (40 xe mới bổ sung để đạt 100 xe)
            ['Hyundai County 29 chỗ (Có tài)', 2500000, 'Quận Cầu Giấy, Hà Nội', 'Xe khách 29 chỗ tầm trung thích hợp cho đoàn du lịch, học sinh đi trải nghiệm thực tế, tài xế giàu kinh nghiệm.'],
            ['Thaco Meadow TB85S 29 chỗ (Có tài)', 2800000, 'Quận Hải Châu, Đà Nẵng', 'Xe khách 29 chỗ bầu hơi êm ái đầm chắc, trang bị tivi, karaoke chất lượng cao phục vụ các tour nội địa xa.'],
            ['Samco Felix 29 chỗ (Có tài)', 2700000, 'Quận Tân Bình, TP. Hồ Chí Minh', 'Dòng xe 29 chỗ đời mới thiết kế sang trọng, động cơ Isuzu bền bỉ, thích hợp đi đèo dốc hiểm trở.'],
            ['Isuzu Samco 29 chỗ (Có tài)', 2600000, 'Quận Tây Hồ, Hà Nội', 'Xe du lịch 29 chỗ đời mới sạch sẽ thơm tho, lái xe lịch thiệp am hiểu các tuyến điểm tham quan du lịch.'],
            ['Hyundai Universe Express 45 chỗ (Có tài)', 3800000, 'Quận 1, TP. Hồ Chí Minh', 'Dòng xe khách 45 chỗ cao cấp nhất hiện nay, khoang xe rộng rãi, bầu hơi êm ái vượt mọi cung đường xa.'],
            ['Thaco Bluesky 120S 45 chỗ (Có tài)', 4000000, 'Quận Đống Đa, Hà Nội', 'Xe du lịch 45 chỗ đời mới chất lượng cao, trang bị hệ thống ánh sáng led hiện đại và dàn âm thanh sống động.'],
            ['Hyundai Universe Noble 47 chỗ (Có tài)', 4200000, 'Quận Liên Chiểu, Đà Nẵng', 'Dòng xe Universe 47 chỗ ngồi rộng rãi ghế da cao cấp, lái xe an toàn chu đáo nhiệt tình, hỗ trợ khách suốt tuyến.'],
            ['Thaco Mobihome 40 giường (Có tài)', 4500000, 'Quận Hoàn Kiếm, Hà Nội', 'Xe khách giường nằm cao cấp 40 giường có chăn gối sạch sẽ, cổng sạc điện thoại tiện lợi tại mỗi vị trí nằm.'],
            ['Xe Limousine giường phòng 22 phòng (Có tài)', 5500000, 'Quận 3, TP. Hồ Chí Minh', 'Chuyên cơ di động giường phòng VIP 22 cabin riêng tư có tivi LCD, tai nghe bluetooth phục vụ tour du lịch cao cấp.'],
            ['Toyota Wigo 2021 (Tự lái)', 500000, 'Quận Hải Châu, Đà Nẵng', 'Hatchback 4 chỗ nhỏ gọn bền bỉ Nhật Bản, tiết kiệm nhiên liệu tối đa, số tự động dễ lái đi lại trong phố.'],
            ['Honda Brio 2020 (Tự lái)', 550000, 'Quận 1, TP. Hồ Chí Minh', 'Dòng xe 4 chỗ nhỏ gọn thể thao nhập khẩu Indonesia, số tự động đầm chắc cách âm tốt bậc nhất phân khúc.'],
            ['Mitsubishi Attrage 2021 (Tự lái)', 600000, 'Quận Cầu Giấy, Hà Nội', 'Sedan 5 chỗ rộng rãi tầm trung, tiết kiệm nhiên liệu vượt trội, số tự động vô cấp CVT lái cực kỳ nhàn.'],
            ['Nissan Almera 2022 (Tự lái)', 700000, 'Quận Sơn Trà, Đà Nẵng', 'Sedan 5 chỗ nhập khẩu Thái Lan động cơ tăng áp 1.0L mạnh mẽ, cabin rộng rãi, số tự động mượt mà.'],
            ['Kia Soluto 2021 (Tự lái)', 600000, 'Quận 3, TP. Hồ Chí Minh', 'Sedan 5 chỗ thực dụng tầm trung, số tự động lái nhẹ nhàng, thích hợp du lịch giá rẻ tiết kiệm chi phí.'],
            ['Mazda 2 Luxury 2022 (Tự lái)', 750000, 'Quận Ngũ Hành Sơn, Đà Nẵng', 'Sedan 5 chỗ thiết kế Kodo thanh lịch nhỏ gọn, số tự động, nhiều trang bị an toàn cao cấp phong cách trẻ.'],
            ['Mazda CX-3 Premium 2022 (Tự lái)', 850000, 'Quận Tây Hồ, Hà Nội', 'SUV cỡ nhỏ gầm cao thể thao cá tính, số tự động, có hiển thị kính lái HUD hiện đại và phanh tự động.'],
            ['Hyundai Kona 2.0 2021 (Tự lái)', 800000, 'Quận Gò Vấp, TP. Hồ Chí Minh', 'Crossover 5 chỗ năng động mạnh mẽ động cơ 2.0L, số tự động, điều hòa hai chiều làm lạnh nhanh sâu.'],
            ['Honda HR-V L 2022 (Tự lái)', 950000, 'Quận Đống Đa, Hà Nội', 'SUV 5 chỗ thiết kế coupe thể thao, số tự động CVT, ghế Magic Seat gập đa năng tiện dụng chứa đồ cắm trại.'],
            ['Peugeot 2008 GT Line 2022 (Tự lái)', 1000000, 'Quận Liên Chiểu, Đà Nẵng', 'SUV 5 chỗ phong cách Pháp thời thượng, đèn led răng nanh sư tử ấn tượng, số tự động lái cực đầm chắc.'],
            ['Mazda CX-30 Premium 2022 (Tự lái)', 1000000, 'Quận 2, TP. Hồ Chí Minh', 'Crossover 5 chỗ nhập khẩu nguyên chiếc thiết kế tinh tế sang trọng, số tự động 6 cấp êm ái nhẹ nhàng.'],

            // 81 - 100
            ['Toyota Corolla Altis 1.8V 2022 (Tự lái)', 1000000, 'Quận Cầu Giấy, Hà Nội', 'Sedan 5 chỗ phân khúc C bền bỉ lịch lãm Nhật Bản, số tự động CVT, trang bị gói an toàn TSS thông minh.'],
            ['Mazda CX-8 Premium 2021 (Tự lái)', 1400000, 'Quận 1, TP. Hồ Chí Minh', 'SUV 7 chỗ cỡ lớn rộng rãi êm ái, bọc da nappa cao cấp, trang bị loa Bose và camera 360 độ siêu nét.'],
            ['Hyundai Palisade Exclusive 2023 (Tự lái)', 1700000, 'Quận Hải Châu, Đà Nẵng', 'SUV 7 chỗ cỡ lớn bề thế lịch lãm, động cơ dầu 2.2L êm ái, thích hợp cho chuyến đi gia đình đông người tiện lợi.'],
            ['Ford Explorer Limited 2022 (Có tài)', 2500000, 'Quận Tây Hồ, Hà Nội', 'SUV 7 chỗ nhập khẩu Mỹ siêu sang trọng, động cơ tăng áp EcoBoost 2.3L mạnh mẽ, tài xế phục vụ suốt tuyến.'],
            ['Peugeot 5008 AL 2022 (Tự lái)', 1400000, 'Quận Bình Thạnh, TP. Hồ Chí Minh', 'SUV 7 chỗ thương hiệu Pháp thiết kế khoang lái mô phỏng chuyên cơ hiện đại, ghế lái massage cao cấp thư giãn.'],
            ['Subaru Forester i-S EyeSight 2021 (Tự lái)', 1200000, 'Quận Liên Chiểu, Đà Nẵng', 'SUV 5 chỗ nhập khẩu an toàn bậc nhất thế giới, dẫn động 4 bánh toàn thời gian đối xứng S-AWD vượt trội mọi địa hình.'],
            ['Jeep Wrangler Rubicon 2021 (Tự lái)', 3000000, 'Quận Sơn Trà, Đà Nẵng', 'SUV off-road huyền thoại Mỹ mui trần cá tính bụi bặm, động cơ 2.0L tăng áp vượt địa hình đồi cát cực đỉnh.'],
            ['Chevrolet Trailblazer Dầu 2019 (Tự lái)', 1100000, 'Quận Đống Đa, Hà Nội', 'SUV 7 chỗ gầm cao mạnh mẽ cơ bắp Mỹ máy dầu số tự động, xe cực đầm chắc chạy đường trường đèo dốc rất đã.'],
            ['Nissan Terra V 2020 (Tự lái)', 1100000, 'Quận Gò Vấp, TP. Hồ Chí Minh', 'SUV 7 chỗ gầm cao nhập khẩu số tự động dẫn động 2 cầu mạnh mẽ bền bỉ vượt mọi cát đá lầy lội công trình.'],
            ['Thaco Town 29 chỗ bầu hơi (Có tài)', 2700000, 'Quận Long Biên, Hà Nội', 'Dòng xe khách 29 chỗ bầu hơi hiện đại, tivi lcd, dàn karaoke giải trí sống động suốt hành trình dài.'],
            ['Samco Growin Li 29 chỗ (Có tài)', 2800000, 'Quận Hải Châu, Đà Nẵng', 'Xe du lịch 29 chỗ ngồi thiết kế sang trọng đời mới, ghế bọc da êm ái ngả lưng sâu thoải mái cho khách.'],
            ['Hyundai Aero Space 45 chỗ (Có tài)', 3500000, 'Quận 3, TP. Hồ Chí Minh', 'Xe du lịch 45 chỗ ngồi thực dụng bền bỉ, lái xe nhiều năm kinh nghiệm chạy các tuyến Tây Bắc, Đông Bắc an toàn.'],
            ['Hyundai Universe Prime 45 chỗ (Có tài)', 4200000, 'Quận 2, TP. Hồ Chí Minh', 'Siêu xe du lịch 45 chỗ Universe đời mới nội thất hoàng gia lộng lẫy, đầy đủ tiện nghi giải trí tủ lạnh mini.'],
            ['VinFast VF 5 Plus Điện (Tự lái)', 600000, 'Quận Sơn Trà, Đà Nẵng', 'Hatchback điện cỡ nhỏ thông minh thời thượng thích hợp đi lại luồn lách đô thị chật hẹp vô cùng tiện lợi.'],
            ['VinFast VF 6 Plus 2023 (Tự lái)', 900000, 'Quận Cầu Giấy, Hà Nội', 'Crossover điện 5 chỗ thông minh hiện đại, trợ lý ảo tiếng Việt, camera 360 và gói an toàn thông minh ADAS.'],
            ['VinFast VF 7 Plus 2024 (Tự lái)', 1200000, 'Quận Tân Bình, TP. Hồ Chí Minh', 'SUV điện 5 chỗ thiết kế tương lai ấn tượng thể thao, động cơ điện kép siêu mạnh mẽ cực bốc lái phấn khích.'],
            ['Toyota Land Cruiser Prado 2021 (Có tài)', 3000000, 'Quận Tây Hồ, Hà Nội', 'SUV gầm cao hạng sang Nhật Bản phục vụ đưa đón nguyên thủ, chuyên gia đi công tác vùng cao, đồi núi đầm chắc.'],
            ['Mercedes-Benz S450 Luxury 2022 (Có tài)', 5000000, 'Quận 1, TP. Hồ Chí Minh', 'Sedan siêu sang Mercedes S-Class, nội thất thương gia thượng lưu, lái xe phục vụ chuẩn nghi thức ngoại giao lịch lãm.'],
            ['BMW 730Li M Sport 2022 (Có tài)', 5000000, 'Quận Hải Châu, Đà Nẵng', 'Sedan hạng sang đầu bảng BMW Series 7, thiết kế thể thao kiêu hãnh, tài xế phục vụ chu đáo lịch thiệp đúng giờ.'],
            ['Audi A8L Premium 2021 (Có tài)', 5500000, 'Quận Hoàn Kiếm, Hà Nội', 'Sedan hạng sang cỡ lớn Audi A8L, đèn pha Matrix led đỉnh cao, trải nghiệm cabin yên tĩnh cách âm tuyệt đối.'],
        ];

        $insert_statements = [];
        $index = 1;
        foreach ($cars as $car) {
            $name = $car[0];
            $price = $car[1];
            $address = $car[2];
            $description = $car[3];
            $image = "uploads/car" . $index . ".png";
            $rating = round((4.2 + (mt_rand(0, 8) / 10)), 1); // 4.2 -> 5.0
            $views = mt_rand(45, 490);
            
            $name_esc = str_replace("'", "''", $name);
            $desc_esc = str_replace("'", "''", $description);
            $addr_esc = str_replace("'", "''", $address);
            
            $insert_statements[] = "($index, '$name_esc', '$image', '$desc_esc', $price, '$addr_esc', $rating, $views)";
            $index++;
        }

        $sql_inserts = "INSERT INTO `thuexe` (`id`, `name`, `image`, `description`, `price`, `address`, `rating`, `views`) VALUES\n" . implode(",\n", $insert_statements) . ";\n";
        
        Database::getConnection()->exec($sql_inserts);
    }
}

/**
 * Các hàm wrapper tương thích ngược cho ThueXe
 */
function thuexe_select_all() {
    return ThueXeModel::selectAll();
}

function thuexe_select_by_id($id) {
    return ThueXeModel::selectById($id);
}

function thuexe_insert($name, $image, $description, $price, $address, $rating) {
    ThueXeModel::insert($name, $image, $description, $price, $address, $rating);
}

function thuexe_update($id, $name, $image, $description, $price, $address, $rating) {
    ThueXeModel::update($id, $name, $image, $description, $price, $address, $rating);
}

function thuexe_delete($id) {
    ThueXeModel::delete($id);
}

function thuexe_seed_100() {
    ThueXeModel::seed100();
}
?>
