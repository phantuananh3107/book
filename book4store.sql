
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--

CREATE TABLE IF NOT EXISTS `cart` (
  `Customer` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Product` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Quantity` int(5) NOT NULL,
  PRIMARY KEY (`Customer`,`Product`),
  KEY `Product` (`Product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Customer`, `Product`, `Quantity`) VALUES
('suyashgulati', 'ENT-12', 1),
('suyash', 'NEW-4', 5),
('suyashgulati', 'ENT-1', 3),
('suyash', 'BIO-3', 5),
('suyashgulati', 'CHILD-1', 6),
('suyashgulati', 'NEW-1', 1),
('nimisha', 'NEW-2', 1),
('nimisha', 'ENT-7', 1),
('suyash', 'ENT-12', 1),
('suyashgulati', 'ENT-1222', 1),
('suyash', 'ENT-1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `PID` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MRP` float NOT NULL,
  `Price` float NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Available` int(11) NOT NULL,
  `Publisher` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Edition` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci,
  `Language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` int(5) DEFAULT NULL,
  `weight` int(4) DEFAULT '500',
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--


INSERT INTO `products` (`PID`, `Title`, `Author`, `MRP`, `Price`, `Discount`, `Available`, `Publisher`, `Edition`, `Category`, `Description`, `Language`, `page`, `weight`) VALUES
('ENT-1', 'Truyện Kiều', 'Nguyễn Du', 100000, 63000, 37, 5, 'Nhà Xuất Bản Kim Đồng', '2', 'Entrance Exam', 'Truyện Kiều là tác phẩm kinh điển của văn học Việt Nam, được viết bởi đại thi hào Nguyễn Du. Câu chuyện kể về cuộc đời đầy bi kịch của Thúy Kiều, một cô gái tài sắc vẹn toàn nhưng phải chịu nhiều bất hạnh trong cuộc sống. Tác phẩm không chỉ là một kiệt tác thơ ca mà còn phản ánh sâu sắc xã hội phong kiến Việt Nam với những bất công và đau khổ của con người, đặc biệt là phụ nữ. Đây là một tài liệu quan trọng cho học sinh ôn thi văn học.', 'Vietnamese', 256, 500),
('ENT-2', 'Nhật Ký Trong Tù', 'Hồ Chí Minh', 80000, 45600, 43, 15, 'Nhà Xuất Bản Chính Trị Quốc Gia', '9', 'Entrance Exam', 'Nhật Ký Trong Tù là tập thơ của Chủ tịch Hồ Chí Minh, được viết trong thời gian Người bị giam cầm tại Trung Quốc (1942-1943). Tập thơ không chỉ thể hiện tinh thần lạc quan, ý chí kiên cường của một nhà cách mạng mà còn là những suy tư sâu sắc về cuộc sống, con người và thiên nhiên. Tác phẩm này là tài liệu quan trọng cho học sinh ôn thi môn Lịch sử và Ngữ văn.', 'Vietnamese', 320, 500),
('ENT-3', 'Lịch Sử Việt Nam Qua Các Triều Đại', 'Trần Trọng Kim', 200000, 140000, 30, 10, 'Nhà Xuất Bản Trẻ', '2', 'Entrance Exam', 'Lịch Sử Việt Nam Qua Các Triều Đại của Trần Trọng Kim là một cuốn sách kinh điển, cung cấp cái nhìn tổng quan về lịch sử Việt Nam từ thời kỳ Hồng Bàng đến thời cận đại. Cuốn sách là tài liệu tham khảo quý giá cho học sinh ôn thi môn Lịch sử.', 'Vietnamese', 936, 500),
('ENT-4', 'Toán Cao Cấp Cho Kỳ Thi Đại Học', 'Lê Hồng Đức', 150000, 112500, 25, 15, 'Nhà Xuất Bản Giáo Dục', '4', 'Entrance Exam', 'Cuốn sách Toán Cao Cấp Cho Kỳ Thi Đại Học của tác giả Lê Hồng Đức bao gồm các bài tập và lý thuyết toán học nâng cao, giúp học sinh chuẩn bị tốt cho kỳ thi đại học. Nội dung bao gồm các chủ đề như đại số, hình học, giải tích, và xác suất.', 'Vietnamese', 590, 500),
('ENT-5', 'Hướng Dẫn Ôn Thi Vật Lý', 'Nguyễn Văn Khánh', 180000, 145800, 19, 2, 'Nhà Xuất Bản Đại Học Quốc Gia', '1', 'Entrance Exam', 'Hướng Dẫn Ôn Thi Vật Lý của Nguyễn Văn Khánh là tài liệu ôn thi môn Vật Lý, bao gồm lý thuyết và bài tập thực hành, giúp học sinh nắm vững các khái niệm cơ bản và nâng cao để chuẩn bị cho kỳ thi đại học.', 'Vietnamese', 272, 560),
('LIT-1', 'Tôi Thấy Hoa Vàng Trên Cỏ Xanh', 'Nguyễn Nhật Ánh', 120000, 78000, 35, 87, 'Nhà Xuất Bản Trẻ', '1', 'Literature and Fiction', 'Tôi Thấy Hoa Vàng Trên Cỏ Xanh là một trong những tác phẩm nổi tiếng nhất của Nguyễn Nhật Ánh. Cuốn sách kể về tuổi thơ đầy cảm xúc của hai anh em Thiều và Tường ở một làng quê Việt Nam, với những rung động đầu đời, những kỷ niệm ngọt ngào và cả những nỗi đau. Tác phẩm đã được chuyển thể thành phim và nhận được nhiều tình cảm từ độc giả.', 'Vietnamese', 7890, 500),
('LIT-2', 'Mắt Biếc', 'Nguyễn Nhật Ánh', 110000, 88000, 20, 67, 'Nhà Xuất Bản Trẻ', '1', 'Literature and Fiction', 'Mắt Biếc là câu chuyện tình yêu đầy day dứt giữa Ngạn và Hà Lan, hai con người với những số phận trái ngược nhau. Ngạn, một chàng trai si tình, đã dành cả thanh xuân để yêu Hà Lan, nhưng cô lại chọn một cuộc sống khác. Tác phẩm của Nguyễn Nhật Ánh đã chạm đến trái tim của hàng triệu độc giả Việt Nam và được chuyển thể thành phim.', 'Vietnamese', 1020, 500),
('LIT-3', 'Số Đỏ', 'Vũ Trọng Phụng', 150000, 109500, 27, 48, 'Nhà Xuất Bản Văn Học', '1', 'Literature and Fiction', 'Số Đỏ của Vũ Trọng Phụng là một tiểu thuyết hiện thực phê phán xuất sắc, kể về hành trình "lên đời" của Xuân Tóc Đỏ, một kẻ vô học nhưng nhờ sự may mắn và thủ đoạn mà trở thành nhân vật nổi tiếng trong xã hội Việt Nam thời kỳ thuộc địa. Tác phẩm là một bức tranh châm biếm sâu sắc về xã hội phong kiến nửa Tây.', 'Vietnamese', 1618, 500),
('LIT-4', 'Tắt Đèn', 'Ngô Tất Tố', 90000, 58500, 35, 78, 'Nhà Xuất Bản Văn Học', '1', 'Literature and Fiction', 'Tắt Đèn là một tác phẩm kinh điển của Ngô Tất Tố, kể về cuộc đời của chị Dậu, một người phụ nữ nông dân nghèo khổ trong xã hội Việt Nam thời kỳ thuộc địa. Tác phẩm phản ánh sâu sắc số phận của người nông dân bị áp bức, bóc lột bởi chế độ phong kiến và thực dân.', 'Vietnamese', 1296, 45),
('LIT-5', 'Nỗi Buồn Chiến Tranh', 'Bảo Ninh', 130000, 89700, 31, 23, 'Nhà Xuất Bản Hội Nhà Văn', '1', 'Literature and Fiction', 'Nỗi Buồn Chiến Tranh của Bảo Ninh là một tiểu thuyết nổi tiếng về chiến tranh Việt Nam, kể về cuộc đời của Kiên, một người lính sống sót sau chiến tranh nhưng bị ám ảnh bởi những ký ức đau thương. Tác phẩm là một lời tự sự đầy cảm xúc về mất mát, đau khổ và những vết thương không thể lành của chiến tranh.', 'Vietnamese', 250, 500),
('CHILD-1', 'Dế Mèn Phiêu Lưu Ký', 'Tô Hoài', 70000, 44100, 37, 12, 'Nhà Xuất Bản Kim Đồng', '1', 'Children and Teens', 'Dế Mèn Phiêu Lưu Ký là tác phẩm kinh điển của Tô Hoài, kể về hành trình phiêu lưu của chú dế Mèn qua thế giới côn trùng đầy màu sắc. Cuốn sách không chỉ mang tính giải trí mà còn chứa đựng nhiều bài học quý giá về tình bạn, lòng dũng cảm và sự trưởng thành. Đây là một trong những tác phẩm thiếu nhi được yêu thích nhất tại Việt Nam.', 'Vietnamese', 220, 500),
('CHILD-2', 'Cho Tôi Xin Một Vé Đi Tuổi Thơ', 'Nguyễn Nhật Ánh', 80000, 50400, 37, 12, 'Nhà Xuất Bản Trẻ', '1', 'Children and Teens', 'Cho Tôi Xin Một Vé Đi Tuổi Thơ là một tác phẩm nổi tiếng của Nguyễn Nhật Ánh, kể về những trò chơi, những kỷ niệm tuổi thơ đầy ngây ngô và trong sáng của bốn đứa trẻ trong một ngôi làng nhỏ. Cuốn sách gợi nhớ về một tuổi thơ đã qua, khiến cả trẻ em và người lớn đều xúc động.', 'Vietnamese', 236, 500),
('CHILD-3', 'Bố Con Cá Gai', 'Trần Đức Lương', 60000, 58800, 2, 19, 'Nhà Xuất Bản Kim Đồng', '1', 'Children and Teens', 'Bố Con Cá Gai của Trần Đức Lương là một câu chuyện cảm động về tình cha con, kể về hành trình của chú cá gai nhỏ và bố trong đại dương bao la. Cuốn sách mang đến những bài học về tình cảm gia đình và sự hy sinh.', 'Vietnamese', 340, 500),
('BIO-1', 'Hồi Ký Nguyễn Hiến Lê', 'Nguyễn Hiến Lê', 120000, 62400, 48, 11, 'Nhà Xuất Bản Văn Học', '1', 'Biographies and Auto Biographies', 'Hồi Ký Nguyễn Hiến Lê là tập hồi ký của học giả Nguyễn Hiến Lê, kể về cuộc đời và sự nghiệp của ông trong việc nghiên cứu, viết lách và dịch thuật. Ông là một trong những học giả nổi tiếng của Việt Nam, với nhiều tác phẩm giá trị về văn hóa, giáo dục và triết học.', 'Vietnamese', 180, 299),
('BIO-2', 'Đời Tôi', 'Phan Bội Châu', 140000, 91000, 35, 16, 'Nhà Xuất Bản Chính Trị Quốc Gia', '1', 'Biographies and Auto Biographies', 'Đời Tôi là cuốn tự truyện của Phan Bội Châu, một nhà yêu nước và chí sĩ cách mạng Việt Nam. Cuốn sách kể về cuộc đời đấu tranh không ngừng nghỉ của ông để giành độc lập cho dân tộc, cùng với những suy tư về đất nước và con người Việt Nam.', 'Vietnamese', 300, 500),
('ACA-1', 'Hướng Dẫn Lập Trình Python Cơ Bản', 'Trần Duy Thanh', 180000, 174600, 3, 1, 'Nhà Xuất Bản Đại Học Quốc Gia', '1', 'Academic and Professional', 'Hướng Dẫn Lập Trình Python Cơ Bản của Trần Duy Thanh là một cuốn sách dành cho người mới bắt đầu học lập trình. Cuốn sách cung cấp các kiến thức cơ bản về ngôn ngữ lập trình Python, từ cú pháp cơ bản đến các bài tập thực hành, giúp người học nắm vững kỹ năng lập trình.', 'Vietnamese', 296, 500),
('REG-1', 'Thơ Lục Tỉnh', 'Huỳnh Tịnh Của', 50000, 32500, 35, 12, 'Nhà Xuất Bản Văn Học', '6', 'Regional Books', 'Thơ Lục Tỉnh của Huỳnh Tịnh Của là tập hợp các bài thơ dân gian miền Nam Việt Nam, phản ánh đời sống, văn hóa và tâm hồn của người dân Nam Bộ. Cuốn sách là một tài liệu quý giá để tìm hiểu về văn học dân gian Việt Nam.', 'Vietnamese', 77, 100),
('BUS-1', 'Quản Lý Dự Án: Quy Trình và Phương Pháp', 'Nguyễn Thúy Quỳnh', 200000, 164000, 18, 5, 'Nhà Xuất Bản Kinh Tế', '6', 'Business and Management', 'Quản Lý Dự Án: Quy Trình và Phương Pháp của Nguyễn Thúy Quỳnh là một cuốn sách hướng dẫn chi tiết về cách quản lý dự án hiệu quả, từ lập kế hoạch, phân bổ nguồn lực đến giám sát và đánh giá. Cuốn sách phù hợp cho sinh viên và người làm việc trong lĩnh vực quản lý.', 'Vietnamese', 961, 500),
('HEA-1', 'Ẩm Thực Việt Nam: Hương Vị Quê Nhà', 'Lê Thị Minh Lý', 150000, 112500, 25, 4, 'Nhà Xuất Bản Phụ Nữ', '1', 'Health and Cooking', 'Ẩm Thực Việt Nam: Hương Vị Quê Nhà của Lê Thị Minh Lý là một cuốn sách giới thiệu các món ăn truyền thống Việt Nam, từ phở, bún bò đến bánh xèo và chè ba màu. Cuốn sách cung cấp công thức chi tiết và các mẹo nấu ăn để giữ được hương vị đậm đà của ẩm thực Việt.', 'Vietnamese', 332, 500);
-- Tiếp tục thay thế các sách còn lại nếu cần...
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci  NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `Password`) VALUES
('suyash', 'gulati'),
('shivangi', 'gupta'),
('nimisha', 'sehgal'),
('avaleen', 'kaur'),
('ankita', 'negi'),
('astha', 'bhargav'),
('avani', 'khurana'),
('shikhar', 'gupta'),
('rakhi', 'gupta'),
('saurabh', 'saha'),
('suyashgulati', 's19'),
('a', 'a');

