-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2024 at 07:54 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_img` varchar(255) NOT NULL,
  `cart_name` varchar(255) NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT '1',
  `cart_price` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_img`, `cart_name`, `cart_quantity`, `cart_price`, `user_id`, `product_id`, `order_id`) VALUES
(98, 'image/dao usuba.jpg', 'Dao Usuba', 1, '1600000.00', 18, 6, NULL),
(99, 'image/dao paring.webp', 'Dao Paring', 1, '800000.00', 18, 7, NULL),
(100, 'image/dao dai.png', 'Dao Chiffon', 1, '1900000.00', 18, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Dao Cắt Thái'),
(2, 'Dao Phi Lê'),
(3, 'Dao Shushi'),
(4, 'Dao Chặt Xương'),
(5, 'Dao Bếp'),
(6, 'Dao bay'),
(7, 'Dao HÃ n'),
(8, 'Dao Bay do'),
(9, 'dao chanh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `delivery_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_price` decimal(10,2) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `user_id`, `cart_id`, `payment_method`, `delivery_method`, `status`, `created_at`, `updated_at`, `total_price`, `product_img`) VALUES
(30, 17, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'ÄÃ£ giao', '2024-12-04 00:02:09', '2024-12-04 00:45:39', '2400000.00', NULL),
(31, 17, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'ÄÃ£ giao', '2024-12-04 00:05:47', '2024-12-04 00:45:55', '3500000.00', NULL),
(32, 17, NULL, 'ATM', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 02:27:35', '2024-12-04 02:27:35', '3500000.00', NULL),
(33, 18, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 02:50:52', '2024-12-04 02:50:52', '5000000.00', NULL),
(34, 18, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 05:01:30', '2024-12-04 05:01:30', '3500000.00', NULL),
(35, 18, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 05:10:53', '2024-12-04 05:10:53', '2300000.00', NULL),
(36, 18, NULL, 'Thanh toán khi nhận hàng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 05:47:01', '2024-12-04 05:47:01', '2400000.00', NULL),
(37, 18, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 07:12:36', '2024-12-04 07:12:36', '4500000.00', NULL),
(38, 18, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 08:29:10', '2024-12-04 08:29:10', '6200000.00', NULL),
(39, 18, NULL, 'ATM', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-04 08:36:22', '2024-12-04 08:36:22', '3000000.00', NULL),
(40, 17, NULL, 'Thẻ tín dụng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-11 06:43:38', '2024-12-11 06:43:38', '2700000.00', NULL),
(41, 17, NULL, 'Thanh toán khi nhận hàng', 'Chuyển phát nhanh', 'Chờ Xử Lý', '2024-12-11 07:41:58', '2024-12-11 07:41:58', '6800000.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_detail`
--

CREATE TABLE `tbl_payment_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_detail`
--

INSERT INTO `tbl_payment_detail` (`detail_id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_img`, `status`, `created_at`) VALUES
(1, 32, 6, 'Dao Usuba', '1600000.00', 1, 'image/dao usuba.jpg', 'Đã huỷ', '2024-12-04 09:44:24'),
(2, 32, 8, 'Dao Chiffon', '1900000.00', 1, 'image/dao dai.png', 'Đang chuẩn bị', '2024-12-04 09:44:24'),
(3, 33, 1, 'Dao Santoku', '1200000.00', 1, 'image/dao santoku.webp', 'Đã giao', '2024-12-04 09:50:52'),
(4, 33, 3, 'Dao Nakiri', '1800000.00', 1, 'image/dao nakiri.jpg', 'Đã huỷ', '2024-12-04 09:50:52'),
(5, 33, 4, 'Dao Yanagiba', '2000000.00', 1, 'image/dao yanagiba.webp', 'Đã huỷ', '2024-12-04 09:50:53'),
(10, 36, 6, 'Dao Usuba', '1600000.00', 1, 'image/dao usuba.jpg', 'Đang giao', '2024-12-04 12:47:01'),
(11, 36, 7, 'Dao Paring', '800000.00', 1, 'image/dao paring.webp', NULL, '2024-12-04 12:47:01'),
(12, 37, 2, 'Dao Gyuto', '1500000.00', 1, 'image/dao gyuto.jpg', NULL, '2024-12-04 14:12:36'),
(13, 37, 3, 'Dao Nakiri', '1800000.00', 1, 'image/dao nakiri.jpg', NULL, '2024-12-04 14:12:36'),
(14, 37, 1, 'Dao Santoku', '1200000.00', 1, 'image/dao santoku.webp', 'Đã giao', '2024-12-04 14:12:36'),
(15, 38, 1, 'Dao Santoku', '1200000.00', 2, 'image/dao santoku.webp', 'Đã giao', '2024-12-04 15:29:10'),
(16, 38, 4, 'Dao Yanagiba', '2000000.00', 1, 'image/dao yanagiba.webp', 'Đang chuẩn bị', '2024-12-04 15:29:10'),
(17, 38, 3, 'Dao Nakiri', '1800000.00', 1, 'image/dao nakiri.jpg', 'Đã huỷ', '2024-12-04 15:29:10'),
(18, 39, 1, 'Dao Santoku', '1200000.00', 1, 'image/dao santoku.webp', NULL, '2024-12-04 15:36:22'),
(22, 41, 2, 'Dao Gyuto', '1500000.00', 2, 'image/dao gyuto.jpg', 'Đã giao', '2024-12-11 14:41:58'),
(23, 41, 3, 'Dao Nakiri', '1800000.00', 1, 'image/dao nakiri.jpg', 'Đã huỷ', '2024-12-11 14:41:58'),
(24, 41, 4, 'Dao Yanagiba', '2000000.00', 1, 'image/dao yanagiba.webp', NULL, '2024-12-11 14:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_price` bigint(20) DEFAULT NULL,
  `product_price_new` bigint(20) DEFAULT NULL,
  `product_desc` varchar(900) DEFAULT NULL,
  `product_img` varchar(255) NOT NULL,
  `is_highlighted` tinyint(1) DEFAULT NULL,
  `is_on_sale` tinyint(1) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('Còn hàng','Hết hàng') DEFAULT 'Còn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `category_id`, `product_price`, `product_price_new`, `product_desc`, `product_img`, `is_highlighted`, `is_on_sale`, `price`, `status`) VALUES
(1, 'Dao Santoku', 5, 1200000, 1000000, 'Dao Santoku tại Dao Nhật KATANA có thiết kế đẹp, sang trọng. Phần lưỡi dao có khả năng duy trì độ sắc bén và sáng bóng sau thời gian dài sử dụng. Lưỡi dao làm bằng thép không gỉ AUS8, độ cứng lên đến 59HRC, nhập khẩu nguyên liệu và sản xuất theo công nghệ Nhật Bản, mang đến khả năng chống ăn mòn cũng như cho phép bạn cắt thái chính xác, sắc nét trên mọi loại thực phẩm. \n\n', 'image/dao santoku.webp', 1, 0, '0.00', 'Còn hàng'),
(2, 'Dao Gyuto', 2, 1500000, 1250000, 'Dao Gyuto là loại dao phương Tây, dao Gyuto hay còn gọi là dao Chef\'s knife, dao chef\'s knife phiên bản Nhật Bản. Dao gyuto thường mỏng hơn, nhẹ hơn và ít cong hơn nhiều so với dao của đầu bếp phương Tây. So với dao Santoku, dao Guyto có chiều dài lưỡi dao dài hơn, bề rộng lưỡi dao khoảng 4cm, trọng lượng dao vừa phải giúp bạn không phải dùng quá nhiều lực để thái thực phẩm cũng như không mỏi tay khi sử dụng lâu, thiết kế nhọn và nhỏ dần về phía mũi dao, giúp việc điều khiển khi sử dụng trở nên dễ dàng.', 'image/dao gyuto.jpg', 1, 0, '0.00', 'Còn hàng'),
(3, 'Dao Nakiri', 4, 1800000, 1500000, 'Dao Nakiri là loại dao có lưỡi thẳng và rộng. Nó được đánh giá là tuyệt vời trong việc cắt rau, và ưu điểm của nó là có thể cắt các loại rau dày như bắp cải mà không làm nát chúng. Mặc dù có lưỡi dao mỏng nhưng nó rất bền và nhẹ nên tay bạn sẽ không bị mỏi, đó là một trong những điểm hấp dẫn của nó. Tuy nhiên, nó không phù hợp để cắt các nguyên liệu khác nên bạn cần hiểu rõ ưu nhược điểm trước khi chọn mua và sử dụng dao bếp Nakiri.', 'image/dao nakiri.jpg', 1, 0, '0.00', 'Còn hàng'),
(4, 'Dao Yanagiba', 2, 2000000, 1700000, 'Dao Yanagiba Nhật Bản là một công cụ cắt đặc biệt được sử dụng phổ biến trong ẩm thực Nhật Bản, đặc biệt cho việc chuẩn bị sashimi - món ăn truyền thống tinh tế từ hải sản tươi ngon. Với lưỡi dao dài và sắc bén, dao Yanagiba Nhật Bản mang đến sự chính xác và mịn màng trong việc cắt sashimi.', 'image/dao yanagiba.webp', 1, 0, '0.00', 'Còn hàng'),
(5, 'Dao Deba', 1, 1400000, 1150000, 'Trong số các loại dao bếp Nhật, dao Deba có đặc điểm là lưỡi dày, nặng và mạnh mẽ. Đây là loại bếp được sử dụng nhiều khi chế biến cá, ngoài ra có thể dùng để chế biến chim, rùa và các loại thực phẩm cứng khác. Vì độ dày của nó nên khi sử dụng lực mạnh vẫn giữ được độ cứng và không bị uốn cong. Hình dạng của nó thường được mô tả như hình tam giác.', 'image/dao deba.png', 1, 0, '0.00', 'Còn hàng'),
(6, 'Dao Usuba', 4, 1600000, 1350000, 'Dao Usuba là dao làm bếp của Nhật Bản với lưỡi thẳng, vuông giúp việc vệ sinh và cắt rau trở nên dễ dàng. Nặng hơn dao Nakiri, dao BUMNEI Usuba được yêu thích bởi các đầu bếp Nhật Bản. Lưỡi thép không gỉ carbon cao với molypden và vanadi 57 HRC cho khả năng giữ cạnh tuyệt vời, vát 1 mặt bên phải.', 'image/dao usuba.jpg', 1, 0, '0.00', 'Còn hàng'),
(7, 'Dao Paring', 3, 800000, 700000, 'Được làm từ chất liệu thép cao cấp, chống mòn, gỉ, độ bền cao. Lưỡi dao sắc bén, đầu dao nhọn, cứng, làm từ thép VG-max. Chuyên dùng để gọt hoa quả. Trọng lượng nhẹ, thiết kế nhỏ gọn, giúp sử dụng và mang theo dễ dàng', 'image/dao paring.webp', 1, 0, '0.00', 'Còn hàng'),
(8, 'Dao Chiffon', 3, 1900000, 1650000, 'Dao Nhật có chất lượng cao, lưỡi sắc bén và được làm từ các vật liệu chất lượng. Chúng mang lại hiệu suất cắt tuyệt vời và độ bền cao.', 'image/dao dai.png', 1, 0, '0.00', 'Hết hàng'),
(9, 'Dao Kaishun Dâm·', 9, 3400000, 2900000, 'Dao bếp Nhật Kaishun cao cấp classic chef - dao thái thịt cá thép damascus 69 lớp.', 'image/dao_sale1.webp', 0, 1, '0.00', 'Còn hàng'),
(14, 'Dao Nhật Bunka', 1, 2500000, 2200000, 'ên sản phẩm: dao Nhật Deba \n\n► Chiều dài lưỡi: 150mm\n\n► Bản rộng lưỡi: 50mm\n\n► Tổng thể : 290mm \n\n► Độ dày lưỡi dao: 3mm\n\n► Cán dao: Gỗ khâu sừng\n\n\nên sản phẩm: dao Nhật Deba \n\n► Chiều dài lưỡi: 150mm\n\n► Bản rộng lưỡi: 50mm\n\n► Tổng thể : 290mm \n\n► Độ dày lưỡi dao: 3mm\n\n► Cán dao: Gỗ khâu sừng\n\n\n', 'image/product1.png', 1, 0, '0.00', 'Còn hàng'),
(15, 'Dao Nhật Deba - 15cm', 2, 1300000, 1100000, 'Dao Deba là dao làm bếp của Nhật Bản với lưỡi thẳng, vuông giúp việc vệ sinh và cắt rau trở nên dễ dàng. Nặng hơn dao Nakiri, dao BUMNEI Usuba được yêu thích bởi các đầu bếp Nhật Bản. Lưỡi thép không gỉ carbon cao với molypden và vanadi 57 HRC cho khả năng giữ cạnh tuyệt vời, vát 1 mặt bên phải.', 'image/product2.png', 1, 0, '0.00', 'Hết hàng');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '2',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `phone`, `role`, `created_at`) VALUES
(10, 'khaikhai', 'khaikhai', 'khai7a2dl@gmail.com', '0345981926', 1, '2024-12-04 15:19:20'),
(15, 'root', 'khongchiu', 'khaidaostore@gmail.com', '0345981926', 1, '2024-12-04 15:19:20'),
(16, 'khai', 'khaikhai', 'khaidaddofpt@gmail.com', '0345981926', 2, '2024-12-04 15:19:20'),
(17, 'khaidao', 'khaidao@gmail.com', 'khaidao@gmail.com', '0345981926', 2, '2024-12-04 15:19:20'),
(18, 'khaidafasdas', 'khaidsph54666@gmail.com', 'khaidsph54666@gmail.com', '0345981945', 2, '2024-12-04 15:19:20'),
(19, 'khaikhainene', 'khaidaoday@gmail.com', 'khaidaoday@gmail.com', '0345981925', 2, '2024-12-11 13:41:49'),
(20, 'demo', 'demo@gmail.com', 'demo@gmail.com', '0976464675', 2, '2024-12-11 14:36:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_payment_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `tbl_cart` (`cart_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD CONSTRAINT `tbl_payment_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_payment` (`id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_category_product` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
