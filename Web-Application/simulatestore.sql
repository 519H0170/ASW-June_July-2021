-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 06:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simulatestore`
--
CREATE DATABASE IF NOT EXISTS `simulatestore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `simulatestore`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `balance` bigint(20) NOT NULL DEFAULT 500000,
  `propic` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User/default.jpg',
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `Activate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user`, `pass`, `fname`, `lname`, `birthday`, `balance`, `propic`, `level`, `Activate`) VALUES
('admin@gmail.com', '0192023a7bbd73250516f069df18b500', '', '', '2001-04-11', 1000019999, 'User/default.jpg', 'Administrator', 'active'),
('adobe@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Adobe', 'Company', NULL, 0, 'User/default.jpg', 'Developer', 'active'),
('bedep@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 500000, 'User/default.jpg', 'User', 'active'),
('ductrong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Đức', 'Trọng', NULL, 0, 'User/default.jpg', 'Developer', 'active'),
('gamerac@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, 0, 'User/default.jpg', 'Developer', 'active'),
('hung009@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Thanh', 'Hùng', '2001-04-11', 0, 'User/default.jpg', 'Developer', 'active'),
('hungmafia96@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Thanh', 'Minh', NULL, 500000, 'User/default.jpg', 'User', 'active'),
('minovirgo468@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hà', 'Minh', '2001-09-02', 0, 'User/default.jpg', 'Developer', 'active'),
('neovongola123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Huỳnh', 'Trường', NULL, 500000, 'User/default.jpg', 'User', 'active'),
('noizbunny147@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ', 'Quyên', NULL, 0, 'User/default.jpg', 'Developer', 'active'),
('riot@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Riot', 'Company', NULL, 0, 'User/default.jpg', 'Developer', 'active'),
('social@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Social Media', 'Company', NULL, 0, 'User/default.jpg', 'Developer', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminName`, `Username`) VALUES
('Administrator', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `appid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(12) NOT NULL,
  `dl_count` int(12) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_d` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_d` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_app` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`appid`, `appname`, `devname`, `price`, `dl_count`, `status`, `short_d`, `long_d`, `category`, `icon`, `picture`, `file_app`) VALUES
('1cllgcvh63', 'Parking Simulator', 'Game Center', 0, 1, 'published', 'Các bãi đậu xe đầy thử thách và các trò chơi lái xe với các tính năng hiện đại và tác động đố xe cổ điển sang trọng tuyệt đẹp sẽ làm bạn ngạc nhiên.', 'Trò chơi xe hơi hiện đại gây nghiện này cung cấp cho bạn các loại xe dựa trên vật lý tuyệt vời và môi trường đẹp cho một bãi đậu xe thực sự và lái xe nhiều cấp độ trong trò chơi đỗ xe mới này....', 'Trò chơi', 'app/ParkingSimulator/icon', 'app/ParkingSimulator', 'app/ParkingSimulator'),
('2d6471bbpy', 'Twitter', 'Social Media Inc', 0, 1, 'published', 'Join the conversation!', 'Expand your social network and stay updated on what’s trending now. Retweet, chime in on a thread, go viral, or just scroll through the Twitter timeline to stay on top of what’s happening, whether it’s social media news or news from around the world.', 'Mạng xã hội', './app/Twitter/icon', './app/Twitter', './app/Twitter'),
('3dlyzj4ztw', 'Zalo', 'Social Media Inc', 0, 1, 'published', 'Zalo là ứng dụng đa chức năng hoạt động trên nền tảng di động và máy tính', 'Zalo là ứng dụng nhắn tin kiểu mới và kết nối cộng đồng hàng đầu cho người dùng di động Việt.\r\nTốc độ gửi tin nhắn cực nhanh, bạn luôn nhận được thông báo khi có tin nhắn mới kể cả khi không mở ứng dụng.\r\nHãy kích hoạt Zalo và chat ngay với bạn bè trong danh bạ!\r\n', 'Mạng xã hội', 'app/Zalo/icon', 'app/Zalo', 'app/Zalo'),
('3f0adw62ib', 'Zombie Catchers', 'Game Center', 0, 1, 'published', 'Zombie Catchers là tựa game phiêu lưu hành động lấy bối cảnh một thế giới bị zombie xâm chiếm! Trái Đất đầy rẫy xác sống', 'May mắn: A.J. Và Bud, 2 thương nhân liên ngân hà, đã quyết định mở cửa hàng kinh doanh tại Trái Đất! Cùng nhau, họ có ý định bắt tất cả zombie và mang lại sự yên bình cho Trái Đất lần nữa – trong khi vẫn kiếm được một món hời lớn…\r\nSử dụng kho dụng cụ và bẫy để săn lùng và bắt zombie sống, sau đó mang chúng đến phòng thí nghiệm bí mật dưới lòng đất, và… nhận thưởng!', 'Hành động', 'app/Zombie Catchers/icon', 'app/Zombie Catchers', 'app/Zombie Catchers'),
('48x6jg8ajh', 'Fake GPS Joystick', 'Ultilities Inc', 100000, 1, 'published', 'Để bật chế độ chuyên gia sau mỗi lần cập nhật, bạn cần xóa bản sao khỏi hệ thống trước khi cập nhật!', 'Nếu cửa hàng play tự động cập nhật ứng dụng, bạn cần xóa ứng dụng đó trước, tải xuống và thêm lại lần nữa. Sử dụng tính năng xuất để bảo mật tuyến đường và lịch sử của bạn. Xin vui lòng đọc Câu hỏi thường gặp của chúng tôi!', 'Tiện ích', './app/Fake GPS Joystick/icon', './app/Fake GPS Joystick', './app/Fake GPS Joystick'),
('50pv68pnfg', 'Adobe Illustrator Draw', 'Adobe Inc', 0, 1, 'published', 'Winner of the Tabby Award for Creation, Design and Editing and PlayStore Editor’s Choice Award!\r\nCreate vector artwork with image and drawing layers you can send to Adobe Illustrator or to Photoshop.', 'Illustrators, graphic designers and artists can:\r\nZoom up to 64x to apply finer details.\r\nSketch with five different pen tips with adjustable opacity, size and color.\r\nWork with multiple image and drawing layers.\r\nRename, duplicate, merge and adjust each individual layer.\r\nInsert basic shape stencils or new vector shapes from Capture.\r\nSend an editable native file to Illustrator or a PSD to Photoshop that automatically opens on your desktop.', 'Chụp và chỉnh sửa ảnh', 'app/AdobeIllustratorDraw/icon', 'app/AdobeIllustratorDraw', 'app/AdobeIllustratorDraw'),
('5v7jdct20r', 'League of Masters', 'Riot, Inc', 0, 0, 'published', 'Tận hưởng các trận đấu PvP Huyền thoại với game thể thao điện tử MOBA, 3v3!', 'Tuyển chọn từ hơn 20 Nhà vô địch mạnh mẽ và thi đấu trực tuyến trong các trận đấu PvP Arena trực tiếp và hấp dẫn của BRAWL với Bạn bè của bạn, AI lén lút hoặc người chơi được ghép ngẫu nhiên từ khắp nơi trên thế giới....', 'Moba', './app/League of Masters/icon', './app/League of Masters', './app/League of Masters'),
('67fhqqwzhx', 'Adobe Premiere Pro', 'Adobe Inc', 0, 0, 'published', 'Adobe Premiere Pro (còn gọi là Premiere Pro) là một  ứng dụng chỉnh sửa video theo thời gian được Adobe Systems phát triển và được phát hành như là một phần của chương trình cấp phép Adobe Creative Cloud.', 'Premiere Pro hỗ trợ chỉnh sửa video độ phân giải cao lên đến 10.240 × 8.192[8], lên tới 32-bits mỗi điểm màu sắc, trong cả hai RGB và YUV. Chỉnh sửa âm thanh,hỗ trợ VST audio  và âm thanh 5.1 trộn có sẵn... Tải và sử dụng để biết thêm chi tiết', 'Chụp và chỉnh sửa ảnh', 'app/AdobePremierePro/icon', 'app/AdobePremiereProshop', 'app/AdobePremiereProshop'),
('67zdtxe4y1', 'Candy Crush Saga', 'GameRac Inc', 0, 0, 'published', 'Start playing Candy Crush Saga today – a legendary puzzle game loved by millions of players around the world.', 'Switch and match Candies in this tasty puzzle adventure to progress to the next level for that sweet winning feeling! Solve puzzles with quick thinking and smart moves, and be rewarded with delicious rainbow-colored cascades and tasty candy combos!', 'Chiến thuật', 'app/Candy Crush Saga/icon', 'app/Candy Crush Saga', 'app/Candy Crush Saga'),
('696ozt07ka', 'Adobe Light Room', 'Adobe Inc', 1000000, 0, 'published', 'Phần mềm Lightroom hay còn gọi đầy đủ là Adobe Photoshop Lightroom', 'Adobe Photoshop Lightroom là 1 phần mềm làm màu tuyệt vời, rất thích hợp cho những Photographer chuyên chụp ảnh và muốn retouch lại màu cho bức ảnh thêm lung linh và huyền bí.', 'Chụp và chỉnh sửa ảnh', 'app/AdobeLightRoom/icon', 'app/AdobeLightroom', 'app/AdobeLightroom'),
('72gophw2lg', '3D EARTH PRO', 'Ultilities Inc', 50000, 0, 'published', 'Meet the wonderful 3D Earth. The most beautiful app, ever!', 'This unique application combining: weather forecast, clocks, widgets and a beautiful view from the space to our Earth.\r\nAccurate weather conditions and forecast is the main feature of this app.', 'Tiện ích', './app/3D EARTH PRO/icon', './app/3D EARTH PRO', './app/3D EARTH PRO'),
('78j0znhbrb', 'SAO:Intergral Factor', 'Game Center', 0, 0, 'published', 'Trò chơi Sword Art Online mới nhất!\r\nLần này, nhân vật chính là ... bạn!', 'Bạn xuất hiện trong game nhập vai trực tuyến này với tư cách là thành viên của Đội tấn công, làm việc với những người chơi bị cầm tù khác để đến tầng thứ 100 của Aincrad!', 'Nhập vai', 'app/SA0-IntegralFact/icon', 'app/SA0-IntegralFact', 'app/SA0-IntegralFact'),
('7ch6joc7tz', 'Football Manager 2021', 'Game Center', 200000, 1, 'published', 'Hãy ghi dấu ấn của bạn với trò chơi đẹp mắt trong FM21 Mobile, cách nhanh nhất để đạt được sự vĩ đại trong bóng đá.', 'Cảm nhận được sự náo nhiệt khi bạn dễ dàng tạo ra đội hình hoàn hảo và thiết lập chiến thuật đảm bảo sẽ nhận được huy chương bạc, ở bất cứ đâu và bất cứ khi nào bạn muốn. Với hơn 60 giải đấu từ 24 quốc gia có nền bóng đá hàng đầu, bạn sẽ chọn cho mình một chuyến phiêu lưu ra nước ngoài với một trong những cường quốc của bóng đá hay thử thách để đạt được thành công trong nước?', 'Thể thao', './app/Football Manager 2021/icon', './app/Football Manager 2021', './app/Football Manager 2021'),
('7ol0af0jkv', 'Panda World', 'Game Center 2', 0, 0, 'published', 'Là bộ sưu tập bao gồm tất cả các ứng dụng được yêu thích của BabyBus\r\n', 'KHÁM PHÁ 100 KHU VỰC\r\nCó tới 100 khu giải trí tại Thế Giới của Bé Gấu Trúc! Bạn có thể thỏa sức mua sắm trong siêu thị hoặc đi xem phim. Bạn muốn đi chơi công viên giải trí ư? Vô số tiện ích giải trí đang chờ đón bạn!', 'Trò chơi', 'app/PandaWorld/icon', 'app/PandaWorld', 'app/PandaWorld'),
('80vs36pzse', 'Adobe Photoshop', 'Adobe Inc', 0, 0, 'published', 'Một trình chỉnh sửa ảnh thú vị, nhanh chóng và dễ dàng để biến đổi và chỉnh sửa ảnh một chạm - được hàng triệu cá nhân sáng tạo sử dụng.', 'Photoshop Express cung cấp đầy đủ các công cụ và hiệu ứng trong tầm tay bạn. Cá nhân hóa trải nghiệm của bạn với các nhà tạo hình dán, tăng cường độ chuyển màu và hình ảnh, tạo ảnh ghép ảnh, tạo meme, sửa nhanh và nâng cao những khoảnh khắc đáng chia sẻ của bạn.', 'Chụp và chỉnh sửa ảnh', 'app/AdobePhotoshop/icon', 'app/AdobePhotoshop', 'app/AdobePhotoshop'),
('8oxl5kqy3m', 'Learn HTML', 'W3School Inc', 0, 0, 'published', 'Phần mềm hỗ trợ học tập về 1 html cơ bản đến nâng cao', 'HTML là nền tảng của web, ứng dụng này sẽ hỗ trợ bạn tiếp cần đến việc sử dụng HTML.', 'Code', 'app/LearnHTML/icon', 'app/LearnHTML', 'app/LearnHTML'),
('8wiulpwuzg', 'Angry Birds', 'Game Center 2', 0, 0, 'published', 'Game cho cả trẻ em lẫn người ', 'Đây là series game bắn gà nổi trội ở khắp mọi nơi, được nhiều người ưa chuộng để giải trí', 'Chiến thuật', './app/Angry Birds/icon', './app/Angry Birds', './app/Angry Birds'),
('8zl2p27ymq', 'FIFA Online 4', 'Game Center', 0, 0, 'published', 'FIFA hay FIFA Football hoặc FIFA Soccer là series trò chơi bóng đá được phát hành hàng năm bởi hãng Electronic Arts dưới thương hiệu EA Sports ', 'FIFA Online 4 là tựa game thể thao môn bóng đá Online nối tiếp FIFA Online 3 do Nexon và EA Sports phát hành và đã chính thức ra mắt lần đầu tiên vào ngày 17 tháng 5 năm 2018 ở Hàn Quốc trên hệ máy PC.Phiên bản điện thoại được ra mắt lần đầu vào tháng 7 năm 2018 cũng tại Hàn Quốc.', 'Thể thao', 'app/Fifa/icon', 'app/Fifa', 'app/Fifa'),
('b5yfqcivcd', 'Bắn Ruồi', 'GameRac Inc', 20000, 0, 'published', 'Bạn là fan hâm mộ của thể loại trò chơi Bắn ruồi - Game Ban May Bay - Bắn gà vũ trụ - Chiến cơ ?', 'Bạn thích tham gia vào các trận chiến không gian? Đây là game hay nhất dành cho bạn.\r\n-Thu thập đạn và các vật phẩm\r\n- Nâng cấp chiến cơ\r\n- Vòng quay may mắn', 'Hành động', 'app/Bắn Ruồi/icon', 'app/Bắn Ruồi', 'app/Bắn Ruồi'),
('bbfn5ltvke', 'Siêu Nhân Robot', 'Game Center 2', 10000, 0, 'published', 'Mở khoá miễn phí: Siêu nhân Hổ Bạc\r\nMiễn phí 10.000 vàng.\r\nMiễn phí 200 kim cương.\r\nKhông hiển thị quảng cáo trong khi chơi.', 'Hỡi chiến binh, chiến tranh robot đã nổ ra - đến lúc chiến đấu rồi.\r\nVào năm 2250, thành phố Cirin xinh đẹp đang bị những tên robot người máy đột biến xâm chiếm, chúng muốn thu phục căn cứ Techno - nơi chứa bí mật sức mạnh của kỷ nguyên robo 20.0.\r\nĐội anh hùng robot đã được liên minh hòa bình phái đến để bảo vệ Cirin. Họ phát hiện rằng không chỉ có rất nhiều loại robot quái vật mà chúng còn xây dựng vô số tháp và máy móc để đóng quân và tấn công bằng được cả thành phố....', 'Hành động', './app/Siêu Nhân Robot/icon', './app/Siêu Nhân Robot', './app/Siêu Nhân Robot'),
('c38qru6wjc', 'Learn Python', 'W3School Inc', 0, 0, 'published', 'Phần mềm hỗ trợ học tập về 1 python cơ bản đến nâng cao', 'Ứng dụng này sẽ hỗ trợ bạn khá nhiều trong việc học python để sử dụng cho các công việc như tính toán, xử lí ảnh, thống kê dữ liệu, xác suất,...', 'Code', 'app/LearnPython/icon', 'app/LearnPython', 'app/LearnPython'),
('ctz84ckr9f', 'Football Strike ', 'Game Center', 0, 0, 'published', 'Bạn chưa bao giờ chơi một trận bóng đá như thế này trước đây. Chiến đấu với bạn bè của bạn trong các trận đối đầu đá phạt nhiều người chơi, hoặc tạo dựng tên tuổi trong Chế độ nghề nghiệp!', 'Tùy chỉnh tiền đạo và thủ môn của bạn với hàng tấn vật phẩm có thể mở khóa! Thể hiện phong cách của bạn hoặc đại diện cho màu sắc của nhóm của bạn!\r\nTham gia chế độ Nghề nghiệp, đi qua các sân vận động khác nhau trên toàn cầu và tham gia các thử thách bóng đá độc đáo để mở khóa huy chương!', 'Chiến thuật', 'app/Football Strike/icon', 'app/Football Strike', 'app/Football Strike'),
('cxqxnjnen0', 'Heroes Legend', 'Game Center 2', 20000, 0, 'published', 'Heroes Legend - Epic Fantasy RPG', 'Pandora\'s Box đã được mở - Tùy bạn, Người triệu hồi vĩ đại nhất, để cứu thế giới trong Heroes Legend - một sự pha trộn đáng kinh ngạc giữa các game nhập vai và MOBA hay nhất với các yếu tố game hành động! Hàng tá anh hùng với khả năng và tính cách độc đáo đang đứng về phía bạn. Nó sẽ cần một bậc thầy thực sự về chiến thuật để tập hợp một đội vượt qua mọi chướng ngại vật, đánh bại những ông chủ mạnh mẽ và lọt vào trận chung kết để định hình vận mệnh của thế giới này!', 'Nhập vai', './app/Heroes Legend/icon', './app/Heroes Legend', './app/Heroes Legend'),
('derwybngtk', 'Acrobat', 'Adobe Inc', 0, 0, 'published', 'Là một hệ thống các phần mềm ứng dụng và dịch vụ Web được phát triển bởi Adobe Systems', 'Adobe Acrobat là một hệ thống các phần mềm ứng dụng và dịch vụ Web được phát triển bởi Adobe Systems. để xem, tạo, thao tác, in và quản lý các tệp PDF.', 'Tiện ích', 'app/Acrobat/icon', 'app/Acrobat', 'app/Acrobat'),
('e0vqj4v2q7', 'Teamfight Tactics', 'Riot, Inc', 0, 0, 'published', 'Hãy thử nghiệm kỹ năng xây dựng nhóm của bạn trong Teamfight Tactics, trò chơi chiến lược PvP đỉnh cao từ studio đằng sau Liên minh Huyền thoại.', 'Tập hợp một đội quân không thể ngăn cản từ một nhóm tướng chung, sau đó chiến đấu từng vòng để trở thành người chơi cuối cùng đứng. Với sự kết hợp đồng đội vô tận và siêu trò chơi không ngừng phát triển, bất kỳ chiến lược nào cũng được áp dụng — nhưng chỉ một người có thể chiến thắng. Bạn sẽ chọn cái nào?', 'Chiến thuật', 'app/Teamfight Tactics/icon', 'app/Teamfight Tactics', 'app/Teamfight Tactics'),
('ebk8ewcxlw', 'PUBG Mobile', 'GameRac Inc', 0, 0, 'published', 'PUBG Mobile - PLAYERUNKNOWN\'S BATTLEGROUNDS MOBILE là game bắn súng sinh tồn được yêu thích trên toàn thế giới do Tencent & BlueHole nghiên cứu, phát triển và đã được phát hành chính thức tại Việt Nam, duy nhất bởi VNG.', 'Khi tham gia trò chơi, bạn sẽ cùng 99 người chơi khác nhảy dù xuống một hòn đảo hoang để tham gia vào trận chiến sinh tồn. Vòng bo sẽ thu hẹp dần, người chơi phải chạy vào bo để tồn tại. Thu thập súng và trang bị, chiến đấu hành động với những người chơi khác và sử dụng mọi chiến thuật để có thể sống sót đến cuối cùng.', 'FPS', './app/PUBG Mobile/icon', './app/PUBG Mobile', './app/PUBG Mobile'),
('eg8r0ejwba', 'Dude Theft Wars', 'GameRac Inc', 0, 0, 'published', 'Là một trò chơi VUI VẺ DỰA VÀO THẾ GIỚI MỞ TRÊN SANDBOX và một MÔ PHỎNG CUỘC SỐNG SANDBOX', 'Bạn có thể đi ROAM MIỄN PHÍ quanh THÀNH PHỐ, LÁI XE Ô TÔ, CHẠY XE RAGDOLL trong THÀNH PHỐ DUDE MAFIA và kiếm tiền\r\nMục tiêu của Trò chơi Sandbox Thế giới Mở miễn phí dựa trên vật lý vui nhộn này là tận hưởng sự Tự do mà nó mang lại cho bạn để làm bất cứ điều gì bạn muốn trong Mở rộng World Sandbox Mafia City như một người chuyên nghiệp Đi', 'Nhập vai', 'app/Dude Theft Wars/icon', 'app/Dude Theft Wars', 'app/Dude Theft Wars'),
('eqqsxdgjz1', 'Google Authenticator', 'W3School Inc', 0, 0, 'published', 'Google Authenticator tạo mã Xác minh 2 bước trên điện thoại của bạn.', 'Tính năng Xác minh 2 bước cung cấp giải pháp bảo mật mạnh hơn cho Tài khoản Google của bạn bằng cách yêu cầu bạn thực hiện bước xác minh thứ hai khi đăng nhập. Ngoài mật khẩu, bạn còn phải nhập một mã do ứng dụng Google Authenticator tạo trên điện thoại của bạn.', 'Code', './app/Google Authenticator/icon', './app/Google Authenticator', './app/Google Authenticator'),
('ezlxw0780k', 'Freefire', 'Riot, Inc', 0, 0, 'published', 'Free Fire là tựa game bắn súng sinh tồn hot nhất trên mobile. Không mất quá nhiều thời gian cho người chơi, mỗi 10 phút bạn có thể chiến đấu với 49 người chơi khác, tất cả vì mục tiêu tồn tại đến cuối cùng', 'Người chơi có thể tùy chọn vị trí để nhảy dù, đáp xuống, thu thập vật phẩm để chống lại người chơi khác. Mục tiêu của ngưới chơi là ở lại trong vòng tròn an toàn càng lâu càng tốt. Bên cạnh đó game có rất nhiều chiến thuật để người chơi lựa chọn: Lái xe khám phá bản đồ và tránh giao tranh, ẩn nấp, thậm chí trở nên vô hình bằng cách chốn trong các bụi cỏ....Tất cả vì mục tiêu: \"Sống dai thành huyền thoại\"', 'FPS', './app/Freefire/icon', './app/Freefire', './app/Freefire'),
('ftgtrvm4tu', 'TikTok', 'Social Media Inc', 0, 0, 'published', 'TikTok là nền tảng video âm nhạc và mạng xã hội của Trung Quốc.', 'TikTok được ra mắt vào năm 2017, dành cho các thị trường bên ngoài Trung Quốc. bởi Trương Nhất Minh, người sáng lập của ByteDance.', 'Chụp và chỉnh sửa ảnh', 'app/Tiktok/icon', 'app/Tiktok', 'app/Tiktok'),
('ho510mks8y', 'Snapchat', 'Social Media Inc', 0, 0, 'published', 'Snapchat là cách vừa nhanh vừa thú vị để chia sẻ khoảnh khắc với bạn bè và gia đình ', '\r\nSnapchat mở thẳng vào camera nên bạn có thể gửi Snap ngay trong tích tắc! Chỉ cần chụp ảnh hoặc quay video, sau đó thêm chú thích là bạn có thể gửi cho cạ cứng và gia đình rồi. Bạn còn có thể thể hiện cá tính với Bộ Lọc, Lenses, Bitmoji và đủ loại hiệu ứng thú vị nữa.', 'Mạng xã hội', './app/Snapchat/icon', './app/Snapchat', './app/Snapchat'),
('iep4cpfkbx', 'Messenger', 'Social Media Inc', 0, 0, 'published', 'Tụ họp bên nhau mọi lúc bằng ứng dụng giao tiếp đa năng, miễn phí* của chúng tôi, hoàn chỉnh với các tính năng nhắn tin, gọi thoại, gọi video và nhóm chat video không giới hạn. Dễ dàng đồng bộ tin nhắn và danh bạ với điện thoại Android, đồng thời kết nối với mọi người ở mọi nơi.', 'GỌI ĐIỆN VÀ NHẮN TIN LIÊN ỨNG DỤNG\r\nKết nối với bạn bè trên Instagram ngay từ Messenger. Chỉ cần tìm kiếm họ theo tên hoặc tên người dùng để nhắn tin hay gọi điện.\r\n\r\nCHẾ ĐỘ TẠM THỜI\r\nGửi những tin nhắn chỉ tồn tại trong chốc lát. Chọn dùng chế độ tạm thời để các tin nhắn đã xem sẽ biến mất khi bạn thoát khỏi đoạn chat.', 'Mạng xã hội', 'app/Messenger/icon', 'app/Messenger', 'app/Messenger'),
('jivaortpeh', 'Liên quân mobile', 'Riot, Inc', 0, 0, 'published', 'Là một trò chơi đấu trường trận chiến trực tuyến nhiều người chơi do Tencent Games phát triển và phát hành bởi Garena', 'là game mobile eSports đỉnh cao của dòng game MOBA 5v5 phổ biến trên thế giới. Với thao tác dễ dàng, lối chơi quen thuộc, và hệ ...\r\n', 'Moba', './app/Liên quân mobile/icon', './app/Liên quân mobile', './app/Liên quân mobile'),
('krbt8vov6j', 'Huyền Thoại Runeterra', 'Riot, Inc', 0, 0, 'published', 'Trong game thẻ bài chiến thuật này, yếu tố quyết định chiến thắng là kỹ năng chứ không phải may mắn. ', 'Trong game thẻ bài chiến thuật này, yếu tố quyết định chiến thắng là kỹ năng chứ không phải may mắn. Hãy kết hợp các anh hùng, đồng minh và các khu vực của Runeterra để tạo ra những bộ combo đa dạng và vượt mặt đối thủ.', 'Chiến thuật', './app/Huyền Thoại Runeterra/icon', './app/Huyền Thoại Runeterra', './app/Huyền Thoại Runeterra'),
('kw62u9ngk5', 'Modern Combat 4', 'Game Center', 150000, 0, 'published', 'Game hành động FPS số 1 đã trở lại trên smartphone với một chương mới để đẩy giới hạn của game di động đi xa hơn nữa.', 'Trong đêm trước của thảm họa hạt nhân, cơ hội duy nhất để ngăn chặn sự tàn phá toàn cầu nằm trong tay những người lính ưu tú, những người sẽ phải truy tìm và giải cứu những nhà lãnh đạo thế giới khỏi một nhóm khủng bố đáng sợ.', 'FPS', './app/Modern Combat 4/icon', './app/Modern Combat 4', './app/Modern Combat 4'),
('kzzws64yxo', 'Liên Minh: Tốc Chiến', 'Riot, Inc', 0, 0, 'published', 'Hãy hòa mình vào Tốc Chiến: trải nghiệm MOBA 5 đấu 5 thuần kỹ năng và chiến thuật trong Liên Minh Huyền Thoại của Riot Games bằng điện thoại.', 'Với hệ thống điều khiển trơn tru và lối chơi siêu tốc, bạn có thể lập đội cùng bạn bè, khóa chọn tướng của bạn và thực hiện các pha xử lý để đời như trên PC.\r\n', 'Moba', 'app/Tốc chiến/icon', 'app/Tốc chiến', 'app/Tốc chiến'),
('m4uv5xphlq', 'VinID', 'Ultilities Inc', 0, 0, 'published', 'Trợ lí thông minh!!!\r\nTải ứng dụng VinID ngay - Tích điểm, thanh toán, đi chợ dễ dàng!', 'Ứng dụng VinID để dễ dàng quản lý điểm tích và các giao dịch đi chợ, mua sắm của bạn, thanh toán các loại hóa đơn dễ dàng, mua vé các chương trình giải trí hấp dẫn..., hàng ngàn voucher ưu đãi của các thương hiệu nổi tiếng. Tải ngay', 'Tiện ích', 'app/VinID/icon', 'app/VinID', 'app/VinID'),
('n2hej84z9v', 'My Talking Angela', 'GameRac Inc', 0, 0, 'published', 'Talking Angela là một con vật cưng ảo với phong cách mà cả gia đình có thể thưởng thức!\r\nNgười chơi có thể tắm cho cô ấy, trang trí nhà cửa và cho cô ấy ăn những món ăn ngon.', '\r\nMy Talking Angela\r\n- Angela có một loạt các trò chơi nhỏ được thiết kế để kiểm tra kỹ năng, phản xạ và khả năng giải câu đố.\r\n- Người chơi có thể thu thập các nhãn dán phong cách để thu thập và trao đổi với những người chơi khác.', 'Trò chơi', './app/My Talking Angela/icon', './app/My Talking Angela', './app/My Talking Angela'),
('ngydvseuge', 'Amazon', 'Ultilities Inc', 0, 0, 'published', 'Ứng dụng buôn bán', 'Hỗ trợ buôn bán giữa các bên trên thế giới qua phương thức trực tuyến', 'Tiện ích', 'app/Amazon/icon', 'app/Amazon', 'app/Amazon'),
('on694zu465', 'Adobe InDesign', 'Adobe Inc', 0, 0, 'published', 'Là một ứng dụng phần mềm sắp xếp và xuất bản trên máy tính để bàn được sản xuất bởi Adobe Systems.', 'Ứng dụng được sử dụng để tạo ra các tác phẩm như áp phích, tờ rơi, tài liệu quảng cáo, tạp chí, báo, thuyết trình, sách và sách điện tử.', 'Chụp và chỉnh sửa ảnh', 'app/AdobeIndesign/icon', 'app/AdobeIndesign', 'app/AdobeIndesign'),
('onckp9w483', 'Snake.io', 'GameRac Inc', 0, 0, 'published', 'Cùng đến với một phiên bản mới đầy cạnh tranh của trò chơi rắn săn mồi', 'Bắt đầu trò chơi bạn là một chú rắn nhỏ và sẽ cố gắng ăn thật nhiều để càng to ra và vượt qua các màn chơi. Chú rắn sẽ ở trong các vòng, mục tiêu là ăn nhiều thức ăn và vượt qua điểm số của những người chơi khác - liệu bạn sẽ sống sót được bao lâu?', 'Trò chơi', 'app/Snake.io/icon', 'app/Snake.io', 'app/Snake.io'),
('pqfjtxc2cw', 'Genshin Impact-S.PAY', 'Game Center 2', 0, 0, 'published', 'Genshin Impact là một game nhập vai phiêu lưu thế giới mở mới được phát triển bởi miHoYo. Bạn sẽ khám phá một thế giới giả tưởng có tên là \"Lục địa Teyvat\" trong trò chơi.', 'Trong thế giới rộng lớn này, bạn có thể du hành qua bảy vương quốc, gặp gỡ những người bạn đồng hành với những tính cách và năng lực độc đáo khác nhau, cùng chiến đấu chống lại kẻ thù mạnh và bước vào con đường tìm kiếm người thân, hoặc bạn có thể đi lang thang không mục đích và đắm mình trong một thế giới đầy sức sống. Hãy để sự tò mò thúc đẩy bản thân khám phá mọi bí mật trong thế giới này nào...', 'Nhập vai', 'app/Genshin Impact/icon', 'app/Genshin Impact', 'app/Genshin Impact'),
('q93zuoejbc', 'VPN Pro', 'W3School Inc', 20000, 0, '', 'VPN Pro , Yes It’s FREE! Access to all VPN proxy service for Free .', 'VPN Pro , Oh Yes It’s Fast!\r\nVPN Pro , Yes It’s Secure!\r\nAvailable Servers Many countries.', 'Tiện ích', './app/VPN Pro/icon', './app/VPN Pro', './app/VPN Pro'),
('qjn4wqmcao', 'Dragon City', 'Game Center 2', 0, 0, 'published', 'Ứng dụng nuôi, chiến đấu vs rồng được Socialpoint cung cấp', 'Các loài rồng trên đảo được chia thành 15 nguyên tố: Đất, Lửa, Nước, Lá, Điện, Băng, Kim Loại, Gió, Bóng tối, Ánh sáng, Ma thuật, Huyền thoại, Thuần khiết, Chiến binh và Cổ đại. Các nguyên tố này sẽ có quy luật tương khắc với nhau, có thể kể đến như Đất khắc Điện và Bóng tối, Lửa khắc Lá và Băng, Nước khắc Lửa và Chiến Binh, Lá khắc Nước và Ánh sáng, v.v. Người chơi có thể tìm hiểu thêm trong quá trình trải nghiệm game.', 'Trò chơi', 'app/DragonCity/icon', 'app/DragonCity', 'app/DragonCity'),
('t80uq3misp', 'Standoff 2', 'Game Center', 0, 0, 'published', 'The legendary \"Standoff\" is back in the form of a dynamic first-person shooter!', 'New maps, new types of weapons, new game modes are waiting for you in ths incredible action game, where terrorists and special forces going to engage the battle not for life, but to death.', 'Hành động', './app/Standoff 2/icon', './app/Standoff 2', './app/Standoff 2'),
('tea6l5bxj4', 'Stardew Valley', 'GameRac Inc', 120000, 0, 'published', 'Trò chơi nhập vai đình đám của RPG có liên quan đến Mobile!', 'Chuyển đến vùng nông thôn và nuôi dưỡng một cuộc sống mới trong game nhập vai nông nghiệp kết thúc mở đã giành giải thưởng này! Với hơn 50 giờ nội dung chơi trò chơi và các tính năng mới dành riêng cho thiết bị di động, như tự động lưu và nhiều tùy chọn điều khiển.', 'Nhập vai', './app/Stardew Valley/icon', './app/Stardew Valley', './app/Stardew Valley'),
('u3y52brewr', 'Skype', 'Social Media Inc', 0, 0, 'published', 'Skype là một mạng điện thoại Internet ngang hàng được thành lập bởi Niklas Zennström và Janus Friis, cũng là những người thành lập ra ứng dụng chia sẻ tập tin Kazaa và ứng dụng truyền hình ngang hàng Joost', 'Skype đã phát triển nhanh chóng về cả lượng người dùng và phát triển phần mềm từ khi ra mắt, cả dịch vụ miễn phí và dịch vụ trả tiền. Hệ thống liên lạc Skype nổi bật nhờ các tính năng thuộc nhiều lĩnh vực, bao gồm hội nghị thoại và hình ảnh miễn phí, khả năng sử dụng công nghệ (phân bố) ngang hàng để vượt qua vấn đề về tường lửa và NAT, sử dụng kỹ thuật mã hóa mạnh và trong suốt và khả năng cực mạnh chống lại việc biên dịch ngược phần mềm hay giao thức', 'Mạng xã hội', 'app/Skype/icon', 'app/Skype', 'app/Skype'),
('vaf6o9q5wj', 'Instagram', 'Social Media Inc', 0, 0, 'published', 'Đưa bạn đến gần mọi người và những gì mình yêu thích. — Instagram from Facebook', 'Kết nối với bạn bè, chia sẻ những việc bạn đang làm hoặc xem tin tức mới của những người khác trên khắp thế giới. Khám phá cộng đồng của chúng tôi, nơi bạn được là chính mình và chia sẻ tất tần tật mọi thứ, từ những khoảnh khắc hàng ngày cho đến các mốc đáng nhớ trong cuộc sống.', 'Mạng xã hội', './app/Instagram/icon', './app/Instagram', './app/Instagram'),
('vln2n4dk9p', 'Extraordinary Ones', 'W3School Inc', 0, 0, 'published', 'Netease Innovative Anime 5V5 MOBA Game [Extraordinary Ones] is available now！', 'Heroes with mold-breaking characteristics, spirited schoolyard scuffles, and amazing items. Don\'t forget to cultivate heroes\' intimacy and unlock Intimacy Functions！\r\nLearn to much, play to relax, bro', 'Moba', './app/Extraordinary Ones/icon', './app/Extraordinary Ones', './app/Extraordinary Ones'),
('xiwr5qy9yt', 'Bus Simulator', 'Game Center', 0, 0, 'published', 'ĐỖ XE BUÝT TRONG THÀNH PHỐ THỰC TẾ-THỬ THÁCH MỚI CỦA THƯƠNG HIỆU-KINH NGHIỆM LÁI XE TỐI ƯU-NHIỆM VỤ VUI VẺ-MỤC TIÊU THỬ THÁCH-HÌNH ẢNH CHẤT LƯỢNG CONSOLE STUNNING', 'Thiết kế các trạm trong mơ của bạn bằng các công cụ đậu xe buýt mới trong trò chơi của chúng tôi với hình ảnh đẹp hơn. Trò chơi đỗ xe buýt hiện đại đi kèm với các tính năng trò chơi mới. Thiết kế các trò chơi và cấp độ trò chơi của riêng bạn để xây dựng các tình huống đỗ xe.', 'Trò chơi', 'app/BusSimulator/icon', 'app/BusSimulator', 'app/BusSimulator'),
('yo832y94rz', 'FaceBook', 'Social Media Inc', 0, 0, 'published', 'Ứng dụng được cung cấp từ Facebook, Inc. Đã được chỉnh sửa', 'Ứng dụng giúp bạn cập nhật thông tin từ bạn bè nhanh chóng hơn bao giờ hết.\r\nXem bạn bè đang làm gì\r\nChia sẻ cập nhật, ảnh và video\r\nNhận thông báo khi bạn bè thích', 'Mạng xã hội', 'app/Facebook/icon', 'app/Facebook', 'app/FaceBook'),
('yr58nm0sya', 'Firefox', 'Ultilities Inc', 0, 0, 'published', 'Firefox, còn được gọi đầy đủ là Mozilla Firefox', 'Là một trình duyệt web mã nguồn mở tự do xuất phát từ Gói Ứng dụng Mozilla, do Tập đoàn Mozilla quản lý.', 'Tiện ích', 'app/Firefox/icon', 'app/Firefox', 'app/Firefox');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`) VALUES
('Chiến thuật'),
('Chụp và chỉnh sửa ảnh'),
('Code'),
('FPS'),
('Hành động'),
('Mạng xã hội'),
('Moba'),
('Nhập vai'),
('Thể thao'),
('Tiện ích'),
('Trò chơi');

-- --------------------------------------------------------

--
-- Table structure for table `dev`
--

CREATE TABLE `dev` (
  `devname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dev`
--

INSERT INTO `dev` (`devname`, `info`, `phone`, `user`) VALUES
('Adobe Inc', 'Adobe, Inc là một tập đoàn phần mềm máy tính của Hoa Kỳ có trụ sở chính đặt tại San Jose, California, Hoa Kỳ. Adobe được thành lập vào tháng 12 năm 1982 bởi John Warnock và Charles Geschke', '0908777777', 'adobe@gmail.com'),
('Game Center', 'Công ty cung cấp các trò chơi, được lấy từ các công ty khác', '0909831811', 'minovirgo468@gmail.com'),
('Game Center 2', 'Công ty cung cấp các trò chơi, được lấy từ các công ty khác chi nhánh của GameCenter', '0908787877', 'noizbunny147@gmail.com'),
('GameRac Inc', 'Chuyên về game rác', '0908234561', 'gamerac@gmail.com'),
('Riot, Inc', 'Riot Games, Inc. là một công ty chuyên về phát triển và phát hành trò chơi điện tử đa quốc gia của Hoa Kỳ', '0908999222', 'riot@gmail.com'),
('Social Media Inc', 'Social Media, Inc là công ty cung cấp các dịch vụ mạng xã hội trực tuyến.', '0932621811', 'social@gmail.com'),
('Ultilities Inc', 'Công ty cung cấp các dịch vụ tiện ích từ tính phí tới free', '0911111111', 'hung009@gmail.com'),
('W3School Inc', 'w3school là tổ chức giáo dục cung cấp các nội dung hướng dẫn về HTML,CSS,JS,Pthon,... trong công nghệ thông tin', '0908888888', 'ductrong@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gift_card`
--

CREATE TABLE `gift_card` (
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdminName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Administrator',
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Value` bigint(20) NOT NULL,
  `usedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gift_card`
--

INSERT INTO `gift_card` (`serial`, `AdminName`, `Username`, `Value`, `usedate`) VALUES
('1OVYIHQ9OY6J', 'Administrator', NULL, 20000, NULL),
('29E3LG004PSR', 'Administrator', NULL, 20000, NULL),
('30U5U6YM6V2V', 'Administrator', NULL, 50000, NULL),
('35I4TYI1P44X', 'Administrator', NULL, 100000, NULL),
('47R1HR6NSWJ1', 'Administrator', NULL, 50000, NULL),
('6G7L34BM44RY', 'Administrator', NULL, 50000, NULL),
('8PG2ZR2HU3DJ', 'Administrator', NULL, 50000, NULL),
('A3FDMRDB6DA0', 'Administrator', NULL, 50000, NULL),
('BJN3T34PFYHX', 'Administrator', NULL, 500000, NULL),
('BSBYTXZXZV3Y', 'Administrator', NULL, 20000, NULL),
('D9QFPJ7AJ8D7', 'Administrator', NULL, 50000, NULL),
('DQ7H9VXCCKDL', 'Administrator', NULL, 50000, NULL),
('DYDNLR6X0DMO', 'Administrator', NULL, 50000, NULL),
('EPYFLNLXDNOU', 'Administrator', NULL, 50000, NULL),
('G2I06UC01SAF', 'Administrator', NULL, 20000, NULL),
('G6ROEA8IHXSI', 'Administrator', NULL, 50000, NULL),
('HB0PGH1ZDR5B', 'Administrator', NULL, 50000, NULL),
('HKKJV5C2EAVJ', 'Administrator', NULL, 20000, NULL),
('I5KZK2LNH8TE', 'Administrator', NULL, 50000, NULL),
('K8QHDULACUZ0', 'Administrator', NULL, 200000, NULL),
('KK0ROUSFTVKN', 'Administrator', NULL, 50000, NULL),
('LB9USFBDCJ3S', 'Administrator', NULL, 20000, NULL),
('LD08GNTD7GQU', 'Administrator', NULL, 50000, NULL),
('M1HL4TSORVP3', 'Administrator', NULL, 50000, NULL),
('MXLKXA70CBR2', 'Administrator', NULL, 50000, NULL),
('NULFXKYDL8W7', 'Administrator', NULL, 20000, NULL),
('PJETDLJ3CZJK', 'Administrator', NULL, 50000, NULL),
('RNU2O7XCDWG3', 'Administrator', NULL, 50000, NULL),
('TV74TXACVYYT', 'Administrator', NULL, 50000, NULL),
('VNIL36LRI8NU', 'Administrator', NULL, 50000, NULL),
('WEWE6NKPO7C9', 'Administrator', NULL, 100000, NULL),
('X2W9LZRUDSQN', 'Administrator', NULL, 50000, NULL),
('Y17333C09L8T', 'Administrator', NULL, 20000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rate_comment`
--

CREATE TABLE `rate_comment` (
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL DEFAULT 5,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ratetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regaccount`
--

CREATE TABLE `regaccount` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resetpass`
--

CREATE TABLE `resetpass` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resetpass`
--

INSERT INTO `resetpass` (`token`, `username`, `expire`) VALUES
('89304fa3cb3305c708ba', 'hungmafia96@gmail.com', '2021-05-26 21:41:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminName`),
  ADD KEY `FK_Admin_Account` (`Username`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`appid`),
  ADD KEY `FK_App_Dev` (`devname`),
  ADD KEY `FK_App_Cate` (`category`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `dev`
--
ALTER TABLE `dev`
  ADD PRIMARY KEY (`devname`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `gift_card`
--
ALTER TABLE `gift_card`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `rate_comment`
--
ALTER TABLE `rate_comment`
  ADD PRIMARY KEY (`user`,`appid`) USING BTREE,
  ADD KEY `FK_Rate_App` (`appid`);

--
-- Indexes for table `regaccount`
--
ALTER TABLE `regaccount`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `resetpass`
--
ALTER TABLE `resetpass`
  ADD PRIMARY KEY (`token`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_Admin_Account` FOREIGN KEY (`Username`) REFERENCES `account` (`user`);

--
-- Constraints for table `app`
--
ALTER TABLE `app`
  ADD CONSTRAINT `FK_App_Cate` FOREIGN KEY (`category`) REFERENCES `category` (`category`),
  ADD CONSTRAINT `FK_App_Dev` FOREIGN KEY (`devname`) REFERENCES `dev` (`devname`);

--
-- Constraints for table `dev`
--
ALTER TABLE `dev`
  ADD CONSTRAINT `FK_Dev_Account` FOREIGN KEY (`user`) REFERENCES `account` (`user`);

--
-- Constraints for table `gift_card`
--
ALTER TABLE `gift_card`
  ADD CONSTRAINT `FK_Card_Admin` FOREIGN KEY (`AdminName`) REFERENCES `admin` (`AdminName`);

--
-- Constraints for table `rate_comment`
--
ALTER TABLE `rate_comment`
  ADD CONSTRAINT `FK_Rate_App` FOREIGN KEY (`appid`) REFERENCES `app` (`appid`),
  ADD CONSTRAINT `FK_Rate_Use` FOREIGN KEY (`user`) REFERENCES `account` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
