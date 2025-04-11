-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 10, 2025 lúc 01:23 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phpdatabase`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `AccountID` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Role` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`AccountID`, `Email`, `Password`, `Role`, `UserID`) VALUES
(4, 'nguyennrdz@gmail.com', '123', 0, 1),
(12, 'Admin@gmail.com', '123', 1, 15),
(25, 'nguyennrdz123@gmail.com', '123', 0, 28),
(26, 'nguyennrdzmie@gmail.com', '123', 0, 29),
(27, 'nguyennrd1234@gmail.com', '123', 2, 30),
(28, 'zzz@zzz.zzz', '123456', 0, 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `BannerID` int(255) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `ProductLineID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`BannerID`, `Img`, `ProductLineID`) VALUES
(2, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/b8/30/b830392d62a91134d24090c872d02e03.png', 1),
(3, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/ab/23/ab23255fa65987fd5bf46c7541a4d88c.png', 1),
(4, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/f3/21/f321e837c302796a0bc00a3175fc3ef6.png', 2),
(5, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/9d/ed/9ded84d061b0f8a653b3cecfd2f2e1a0.png', 2),
(6, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/b4/76/b4761cca11ca43dd6d66e40d57d8ad80.png', 5),
(7, 'https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/f9/bb/f9bb7a64ca90bf77c4e6e0a7b2cad1ce.png', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `CartID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `ProductID` int(255) NOT NULL,
  `Quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`CartID`, `UserID`, `ProductID`, `Quantity`) VALUES
(93, 23, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `credit`
--

CREATE TABLE `credit` (
  `CreditID` int(11) NOT NULL,
  `CardName` varchar(255) NOT NULL,
  `CardNumber` varchar(255) NOT NULL,
  `CardCCV` varchar(255) NOT NULL,
  `CardDate` date NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `province_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`code`, `name`, `province_code`) VALUES
('001', 'Ba Đình', '01'),
('002', 'Hoàn Kiếm', '01'),
('003', 'Tây Hồ', '01'),
('004', 'Long Biên', '01'),
('005', 'Cầu Giấy', '01'),
('006', 'Đống Đa', '01'),
('007', 'Hai Bà Trưng', '01'),
('008', 'Hoàng Mai', '01'),
('009', 'Thanh Xuân', '01'),
('016', 'Sóc Sơn', '01'),
('017', 'Đông Anh', '01'),
('018', 'Gia Lâm', '01'),
('019', 'Nam Từ Liêm', '01'),
('020', 'Thanh Trì', '01'),
('021', 'Bắc Từ Liêm', '01'),
('024', 'Hà Giang', '02'),
('026', 'Đồng Văn', '02'),
('027', 'Mèo Vạc', '02'),
('028', 'Yên Minh', '02'),
('029', 'Quản Bạ', '02'),
('030', 'Vị Xuyên', '02'),
('031', 'Bắc Mê', '02'),
('032', 'Hoàng Su Phì', '02'),
('033', 'Xín Mần', '02'),
('034', 'Bắc Quang', '02'),
('035', 'Quang Bình', '02'),
('040', 'Cao Bằng', '04'),
('042', 'Bảo Lâm', '04'),
('043', 'Bảo Lạc', '04'),
('045', 'Hà Quảng', '04'),
('047', 'Trùng Khánh', '04'),
('048', 'Hạ Lang', '04'),
('049', 'Quảng Hòa', '04'),
('051', 'Hoà An', '04'),
('052', 'Nguyên Bình', '04'),
('053', 'Thạch An', '04'),
('058', 'Bắc Kạn', '06'),
('060', 'Pác Nặm', '06'),
('061', 'Ba Bể', '06'),
('062', 'Ngân Sơn', '06'),
('063', 'Bạch Thông', '06'),
('064', 'Chợ Đồn', '06'),
('065', 'Chợ Mới', '06'),
('066', 'Na Rì', '06'),
('070', 'Tuyên Quang', '08'),
('071', 'Lâm Bình', '08'),
('072', 'Na Hang', '08'),
('073', 'Chiêm Hóa', '08'),
('074', 'Hàm Yên', '08'),
('075', 'Yên Sơn', '08'),
('076', 'Sơn Dương', '08'),
('080', 'Lào Cai', '10'),
('082', 'Bát Xát', '10'),
('083', 'Mường Khương', '10'),
('084', 'Si Ma Cai', '10'),
('085', 'Bắc Hà', '10'),
('086', 'Bảo Thắng', '10'),
('087', 'Bảo Yên', '10'),
('088', 'Sa Pa', '10'),
('089', 'Văn Bàn', '10'),
('094', 'Điện Biên Phủ', '11'),
('095', 'Mường Lay', '11'),
('096', 'Mường Nhé', '11'),
('097', 'Mường Chà', '11'),
('098', 'Tủa Chùa', '11'),
('099', 'Tuần Giáo', '11'),
('100', 'Điện Biên', '11'),
('101', 'Điện Biên Đông', '11'),
('102', 'Mường Ảng', '11'),
('103', 'Nậm Pồ', '11'),
('105', 'Lai Châu', '12'),
('106', 'Tam Đường', '12'),
('107', 'Mường Tè', '12'),
('108', 'Sìn Hồ', '12'),
('109', 'Phong Thổ', '12'),
('110', 'Than Uyên', '12'),
('111', 'Tân Uyên', '12'),
('112', 'Nậm Nhùn', '12'),
('116', 'Sơn La', '14'),
('118', 'Quỳnh Nhai', '14'),
('119', 'Thuận Châu', '14'),
('120', 'Mường La', '14'),
('121', 'Bắc Yên', '14'),
('122', 'Phù Yên', '14'),
('123', 'Mộc Châu', '14'),
('124', 'Yên Châu', '14'),
('125', 'Mai Sơn', '14'),
('126', 'Sông Mã', '14'),
('127', 'Sốp Cộp', '14'),
('128', 'Vân Hồ', '14'),
('132', 'Yên Bái', '15'),
('133', 'Nghĩa Lộ', '15'),
('135', 'Lục Yên', '15'),
('136', 'Văn Yên', '15'),
('137', 'Mù Căng Chải', '15'),
('138', 'Trấn Yên', '15'),
('139', 'Trạm Tấu', '15'),
('140', 'Văn Chấn', '15'),
('141', 'Yên Bình', '15'),
('148', 'Hòa Bình', '17'),
('150', 'Đà Bắc', '17'),
('152', 'Lương Sơn', '17'),
('153', 'Kim Bôi', '17'),
('154', 'Cao Phong', '17'),
('155', 'Tân Lạc', '17'),
('156', 'Mai Châu', '17'),
('157', 'Lạc Sơn', '17'),
('158', 'Yên Thủy', '17'),
('159', 'Lạc Thủy', '17'),
('164', 'Thái Nguyên', '19'),
('165', 'Sông Công', '19'),
('167', 'Định Hóa', '19'),
('168', 'Phú Lương', '19'),
('169', 'Đồng Hỷ', '19'),
('170', 'Võ Nhai', '19'),
('171', 'Đại Từ', '19'),
('172', 'Phổ Yên', '19'),
('173', 'Phú Bình', '19'),
('178', 'Lạng Sơn', '20'),
('180', 'Tràng Định', '20'),
('181', 'Bình Gia', '20'),
('182', 'Văn Lãng', '20'),
('183', 'Cao Lộc', '20'),
('184', 'Văn Quan', '20'),
('185', 'Bắc Sơn', '20'),
('186', 'Hữu Lũng', '20'),
('187', 'Chi Lăng', '20'),
('188', 'Lộc Bình', '20'),
('189', 'Đình Lập', '20'),
('193', 'Hạ Long', '22'),
('194', 'Móng Cái', '22'),
('195', 'Cẩm Phả', '22'),
('196', 'Uông Bí', '22'),
('198', 'Bình Liêu', '22'),
('199', 'Tiên Yên', '22'),
('200', 'Đầm Hà', '22'),
('201', 'Hải Hà', '22'),
('202', 'Ba Chẽ', '22'),
('203', 'Vân Đồn', '22'),
('205', 'Đông Triều', '22'),
('206', 'Quảng Yên', '22'),
('207', 'Cô Tô', '22'),
('213', 'Bắc Giang', '24'),
('215', 'Yên Thế', '24'),
('216', 'Tân Yên', '24'),
('217', 'Lạng Giang', '24'),
('218', 'Lục Nam', '24'),
('219', 'Lục Ngạn', '24'),
('220', 'Sơn Động', '24'),
('222', 'Việt Yên', '24'),
('223', 'Hiệp Hòa', '24'),
('224', 'Chũ', '24'),
('227', 'Việt Trì', '25'),
('228', 'Phú Thọ', '25'),
('230', 'Đoan Hùng', '25'),
('231', 'Hạ Hoà', '25'),
('232', 'Thanh Ba', '25'),
('233', 'Phù Ninh', '25'),
('234', 'Yên Lập', '25'),
('235', 'Cẩm Khê', '25'),
('236', 'Tam Nông', '25'),
('237', 'Lâm Thao', '25'),
('238', 'Thanh Sơn', '25'),
('239', 'Thanh Thuỷ', '25'),
('240', 'Tân Sơn', '25'),
('243', 'Vĩnh Yên', '26'),
('244', 'Phúc Yên', '26'),
('246', 'Lập Thạch', '26'),
('247', 'Tam Dương', '26'),
('248', 'Tam Đảo', '26'),
('249', 'Bình Xuyên', '26'),
('250', 'Mê Linh', '01'),
('251', 'Yên Lạc', '26'),
('252', 'Vĩnh Tường', '26'),
('253', 'Sông Lô', '26'),
('256', 'Bắc Ninh', '27'),
('258', 'Yên Phong', '27'),
('259', 'Quế Võ', '27'),
('260', 'Tiên Du', '27'),
('261', 'Từ Sơn', '27'),
('262', 'Thuận Thành', '27'),
('263', 'Gia Bình', '27'),
('264', 'Lương Tài', '27'),
('268', 'Hà Đông', '01'),
('269', 'Sơn Tây', '01'),
('271', 'Ba Vì', '01'),
('272', 'Phúc Thọ', '01'),
('273', 'Đan Phượng', '01'),
('274', 'Hoài Đức', '01'),
('275', 'Quốc Oai', '01'),
('276', 'Thạch Thất', '01'),
('277', 'Chương Mỹ', '01'),
('278', 'Thanh Oai', '01'),
('279', 'Thường Tín', '01'),
('280', 'Phú Xuyên', '01'),
('281', 'Ứng Hòa', '01'),
('282', 'Mỹ Đức', '01'),
('288', 'Hải Dương', '30'),
('290', 'Chí Linh', '30'),
('291', 'Nam Sách', '30'),
('292', 'Kinh Môn', '30'),
('293', 'Kim Thành', '30'),
('294', 'Thanh Hà', '30'),
('295', 'Cẩm Giàng', '30'),
('296', 'Bình Giang', '30'),
('297', 'Gia Lộc', '30'),
('298', 'Tứ Kỳ', '30'),
('299', 'Ninh Giang', '30'),
('300', 'Thanh Miện', '30'),
('303', 'Hồng Bàng', '31'),
('304', 'Ngô Quyền', '31'),
('305', 'Lê Chân', '31'),
('306', 'Hải An', '31'),
('307', 'Kiến An', '31'),
('308', 'Đồ Sơn', '31'),
('309', 'Dương Kinh', '31'),
('311', 'Thuỷ Nguyên', '31'),
('312', 'An Dương', '31'),
('313', 'An Lão', '31'),
('314', 'Kiến Thuỵ', '31'),
('315', 'Tiên Lãng', '31'),
('316', 'Vĩnh Bảo', '31'),
('317', 'Cát Hải', '31'),
('318', 'Bạch Long Vĩ', '31'),
('323', 'Hưng Yên', '33'),
('325', 'Văn Lâm', '33'),
('326', 'Văn Giang', '33'),
('327', 'Yên Mỹ', '33'),
('328', 'Mỹ Hào', '33'),
('329', 'Ân Thi', '33'),
('330', 'Khoái Châu', '33'),
('331', 'Kim Động', '33'),
('332', 'Tiên Lữ', '33'),
('333', 'Phù Cừ', '33'),
('336', 'Thái Bình', '34'),
('338', 'Quỳnh Phụ', '34'),
('339', 'Hưng Hà', '34'),
('340', 'Đông Hưng', '34'),
('341', 'Thái Thụy', '34'),
('342', 'Tiền Hải', '34'),
('343', 'Kiến Xương', '34'),
('344', 'Vũ Thư', '34'),
('347', 'Phủ Lý', '35'),
('349', 'Duy Tiên', '35'),
('350', 'Kim Bảng', '35'),
('351', 'Thanh Liêm', '35'),
('352', 'Bình Lục', '35'),
('353', 'Lý Nhân', '35'),
('356', 'Nam Định', '36'),
('359', 'Vụ Bản', '36'),
('360', 'Ý Yên', '36'),
('361', 'Nghĩa Hưng', '36'),
('362', 'Nam Trực', '36'),
('363', 'Trực Ninh', '36'),
('364', 'Xuân Trường', '36'),
('365', 'Giao Thủy', '36'),
('366', 'Hải Hậu', '36'),
('370', 'Tam Điệp', '37'),
('372', 'Nho Quan', '37'),
('373', 'Gia Viễn', '37'),
('374', 'Hoa Lư', '37'),
('375', 'Yên Khánh', '37'),
('376', 'Kim Sơn', '37'),
('377', 'Yên Mô', '37'),
('380', 'Thanh Hóa', '38'),
('381', 'Bỉm Sơn', '38'),
('382', 'Sầm Sơn', '38'),
('384', 'Mường Lát', '38'),
('385', 'Quan Hóa', '38'),
('386', 'Bá Thước', '38'),
('387', 'Quan Sơn', '38'),
('388', 'Lang Chánh', '38'),
('389', 'Ngọc Lặc', '38'),
('390', 'Cẩm Thủy', '38'),
('391', 'Thạch Thành', '38'),
('392', 'Hà Trung', '38'),
('393', 'Vĩnh Lộc', '38'),
('394', 'Yên Định', '38'),
('395', 'Thọ Xuân', '38'),
('396', 'Thường Xuân', '38'),
('397', 'Triệu Sơn', '38'),
('398', 'Thiệu Hóa', '38'),
('399', 'Hoằng Hóa', '38'),
('400', 'Hậu Lộc', '38'),
('401', 'Nga Sơn', '38'),
('402', 'Như Xuân', '38'),
('403', 'Như Thanh', '38'),
('404', 'Nông Cống', '38'),
('406', 'Quảng Xương', '38'),
('407', 'Nghi Sơn', '38'),
('412', 'Vinh', '40'),
('414', 'Thái Hoà', '40'),
('415', 'Quế Phong', '40'),
('416', 'Quỳ Châu', '40'),
('417', 'Kỳ Sơn', '40'),
('418', 'Tương Dương', '40'),
('419', 'Nghĩa Đàn', '40'),
('420', 'Quỳ Hợp', '40'),
('421', 'Quỳnh Lưu', '40'),
('422', 'Con Cuông', '40'),
('423', 'Tân Kỳ', '40'),
('424', 'Anh Sơn', '40'),
('425', 'Diễn Châu', '40'),
('426', 'Yên Thành', '40'),
('427', 'Đô Lương', '40'),
('428', 'Thanh Chương', '40'),
('429', 'Nghi Lộc', '40'),
('430', 'Nam Đàn', '40'),
('431', 'Hưng Nguyên', '40'),
('432', 'Hoàng Mai', '40'),
('436', 'Hà Tĩnh', '42'),
('437', 'Hồng Lĩnh', '42'),
('439', 'Hương Sơn', '42'),
('440', 'Đức Thọ', '42'),
('441', 'Vũ Quang', '42'),
('442', 'Nghi Xuân', '42'),
('443', 'Can Lộc', '42'),
('444', 'Hương Khê', '42'),
('445', 'Thạch Hà', '42'),
('446', 'Cẩm Xuyên', '42'),
('447', 'Kỳ Anh', '42'),
('449', 'Kỳ Anh', '42'),
('450', 'Đồng Hới', '44'),
('452', 'Minh Hóa', '44'),
('453', 'Tuyên Hóa', '44'),
('454', 'Quảng Trạch', '44'),
('455', 'Bố Trạch', '44'),
('456', 'Quảng Ninh', '44'),
('457', 'Lệ Thủy', '44'),
('458', 'Ba Đồn', '44'),
('461', 'Đông Hà', '45'),
('462', 'Quảng Trị', '45'),
('464', 'Vĩnh Linh', '45'),
('465', 'Hướng Hóa', '45'),
('466', 'Gio Linh', '45'),
('467', 'Đa Krông', '45'),
('468', 'Cam Lộ', '45'),
('469', 'Triệu Phong', '45'),
('470', 'Hải Lăng', '45'),
('471', 'Cồn Cỏ', '45'),
('474', 'Thuận Hóa', '46'),
('475', 'Phú Xuân', '46'),
('476', 'Phong Điền', '46'),
('477', 'Quảng Điền', '46'),
('478', 'Phú Vang', '46'),
('479', 'Hương Thủy', '46'),
('480', 'Hương Trà', '46'),
('481', 'A Lưới', '46'),
('482', 'Phú Lộc', '46'),
('490', 'Liên Chiểu', '48'),
('491', 'Thanh Khê', '48'),
('492', 'Hải Châu', '48'),
('493', 'Sơn Trà', '48'),
('494', 'Ngũ Hành Sơn', '48'),
('495', 'Cẩm Lệ', '48'),
('497', 'Hòa Vang', '48'),
('498', 'Hoàng Sa', '48'),
('502', 'Tam Kỳ', '49'),
('503', 'Hội An', '49'),
('504', 'Tây Giang', '49'),
('505', 'Đông Giang', '49'),
('506', 'Đại Lộc', '49'),
('507', 'Điện Bàn', '49'),
('508', 'Duy Xuyên', '49'),
('509', 'Quế Sơn', '49'),
('510', 'Nam Giang', '49'),
('511', 'Phước Sơn', '49'),
('512', 'Hiệp Đức', '49'),
('513', 'Thăng Bình', '49'),
('514', 'Tiên Phước', '49'),
('515', 'Bắc Trà My', '49'),
('516', 'Nam Trà My', '49'),
('517', 'Núi Thành', '49'),
('518', 'Phú Ninh', '49'),
('522', 'Quảng Ngãi', '51'),
('524', 'Bình Sơn', '51'),
('525', 'Trà Bồng', '51'),
('527', 'Sơn Tịnh', '51'),
('528', 'Tư Nghĩa', '51'),
('529', 'Sơn Hà', '51'),
('530', 'Sơn Tây', '51'),
('531', 'Minh Long', '51'),
('532', 'Nghĩa Hành', '51'),
('533', 'Mộ Đức', '51'),
('534', 'Đức Phổ', '51'),
('535', 'Ba Tơ', '51'),
('536', 'Lý Sơn', '51'),
('540', 'Quy Nhơn', '52'),
('542', 'An Lão', '52'),
('543', 'Hoài Nhơn', '52'),
('544', 'Hoài Ân', '52'),
('545', 'Phù Mỹ', '52'),
('546', 'Vĩnh Thạnh', '52'),
('547', 'Tây Sơn', '52'),
('548', 'Phù Cát', '52'),
('549', 'An Nhơn', '52'),
('550', 'Tuy Phước', '52'),
('551', 'Vân Canh', '52'),
('555', 'Tuy Hoà', '54'),
('557', 'Sông Cầu', '54'),
('587', 'Ninh Phước', '58'),
('588', 'Thuận Bắc', '58'),
('589', 'Thuận Nam', '58'),
('593', 'Phan Thiết', '60'),
('594', 'La Gi', '60'),
('595', 'Tuy Phong', '60'),
('596', 'Bắc Bình', '60'),
('597', 'Hàm Thuận Bắc', '60'),
('598', 'Hàm Thuận Nam', '60'),
('599', 'Tánh Linh', '60'),
('600', 'Đức Linh', '60'),
('601', 'Hàm Tân', '60'),
('602', 'Phú Quí', '60'),
('608', 'Kon Tum', '62'),
('610', 'Đắk Glei', '62'),
('611', 'Ngọc Hồi', '62'),
('612', 'Đắk Tô', '62'),
('613', 'Kon Plông', '62'),
('614', 'Kon Rẫy', '62'),
('615', 'Đắk Hà', '62'),
('616', 'Sa Thầy', '62'),
('617', 'Tu Mơ Rông', '62'),
('618', 'Ia H\' Drai', '62'),
('622', 'Pleiku', '64'),
('623', 'An Khê', '64'),
('624', 'Ayun Pa', '64'),
('625', 'KBang', '64'),
('626', 'Đăk Đoa', '64'),
('627', 'Chư Păh', '64'),
('628', 'Ia Grai', '64'),
('629', 'Mang Yang', '64'),
('630', 'Kông Chro', '64'),
('631', 'Đức Cơ', '64'),
('632', 'Chư Prông', '64'),
('633', 'Chư Sê', '64'),
('634', 'Đăk Pơ', '64'),
('635', 'Ia Pa', '64'),
('637', 'Krông Pa', '64'),
('638', 'Phú Thiện', '64'),
('639', 'Chư Pưh', '64'),
('643', 'Buôn Ma Thuột', '66'),
('644', 'Buôn Hồ', '66'),
('645', 'Ea H\'leo', '66'),
('646', 'Ea Súp', '66'),
('647', 'Buôn Đôn', '66'),
('648', 'Cư M\'gar', '66'),
('649', 'Krông Búk', '66'),
('650', 'Krông Năng', '66'),
('651', 'Ea Kar', '66'),
('652', 'M\'Đrắk', '66'),
('653', 'Krông Bông', '66'),
('654', 'Krông Pắc', '66'),
('655', 'Krông A Na', '66'),
('656', 'Lắk', '66'),
('657', 'Cư Kuin', '66'),
('660', 'Gia Nghĩa', '67'),
('661', 'Đăk Glong', '67'),
('662', 'Cư Jút', '67'),
('663', 'Đắk Mil', '67'),
('664', 'Krông Nô', '67'),
('665', 'Đắk Song', '67'),
('666', 'Đắk R\'Lấp', '67'),
('667', 'Tuy Đức', '67'),
('672', 'Đà Lạt', '68'),
('673', 'Bảo Lộc', '68'),
('674', 'Đam Rông', '68'),
('675', 'Lạc Dương', '68'),
('676', 'Lâm Hà', '68'),
('677', 'Đơn Dương', '68'),
('678', 'Đức Trọng', '68'),
('679', 'Di Linh', '68'),
('680', 'Bảo Lâm', '68'),
('682', 'Đạ Tẻh', '68'),
('688', 'Phước Long', '70'),
('689', 'Đồng Xoài', '70'),
('690', 'Bình Long', '70'),
('691', 'Bù Gia Mập', '70'),
('692', 'Lộc Ninh', '70'),
('693', 'Bù Đốp', '70'),
('694', 'Hớn Quản', '70'),
('695', 'Đồng Phú', '70'),
('696', 'Bù Đăng', '70'),
('697', 'Chơn Thành', '70'),
('698', 'Phú Riềng', '70'),
('703', 'Tây Ninh', '72'),
('705', 'Tân Biên', '72'),
('706', 'Tân Châu', '72'),
('707', 'Dương Minh Châu', '72'),
('708', 'Châu Thành', '72'),
('709', 'Hòa Thành', '72'),
('710', 'Gò Dầu', '72'),
('711', 'Bến Cầu', '72'),
('712', 'Trảng Bàng', '72'),
('718', 'Thủ Dầu Một', '74'),
('719', 'Bàu Bàng', '74'),
('720', 'Dầu Tiếng', '74'),
('721', 'Bến Cát', '74'),
('722', 'Phú Giáo', '74'),
('723', 'Tân Uyên', '74'),
('724', 'Dĩ An', '74'),
('725', 'Thuận An', '74'),
('726', 'Bắc Tân Uyên', '74'),
('731', 'Biên Hòa', '75'),
('732', 'Long Khánh', '75'),
('734', 'Tân Phú', '75'),
('735', 'Vĩnh Cửu', '75'),
('736', 'Định Quán', '75'),
('737', 'Trảng Bom', '75'),
('738', 'Thống Nhất', '75'),
('739', 'Cẩm Mỹ', '75'),
('740', 'Long Thành', '75'),
('741', 'Xuân Lộc', '75'),
('742', 'Nhơn Trạch', '75'),
('747', 'Vũng Tàu', '77'),
('748', 'Bà Rịa', '77'),
('750', 'Châu Đức', '77'),
('751', 'Xuyên Mộc', '77'),
('753', 'Long Đất', '77'),
('754', 'Phú Mỹ', '77'),
('755', 'Côn Đảo', '77'),
('760', '1', '79'),
('761', '12', '79'),
('764', 'Gò Vấp', '79'),
('765', 'Bình Thạnh', '79'),
('766', 'Tân Bình', '79'),
('767', 'Tân Phú', '79'),
('768', 'Phú Nhuận', '79'),
('769', 'Thủ Đức', '79'),
('770', '3', '79'),
('771', '10', '79'),
('772', '11', '79'),
('773', '4', '79'),
('774', '5', '79'),
('775', '6', '79'),
('776', '8', '79'),
('777', 'Bình Tân', '79'),
('778', '7', '79'),
('783', 'Củ Chi', '79'),
('784', 'Hóc Môn', '79'),
('785', 'Bình Chánh', '79'),
('786', 'Nhà Bè', '79'),
('787', 'Cần Giờ', '79'),
('794', 'Tân An', '80'),
('795', 'Kiến Tường', '80'),
('796', 'Tân Hưng', '80'),
('797', 'Vĩnh Hưng', '80'),
('798', 'Mộc Hóa', '80'),
('799', 'Tân Thạnh', '80'),
('800', 'Thạnh Hóa', '80'),
('801', 'Đức Huệ', '80'),
('802', 'Đức Hòa', '80'),
('803', 'Bến Lức', '80'),
('804', 'Thủ Thừa', '80'),
('805', 'Tân Trụ', '80'),
('806', 'Cần Đước', '80'),
('807', 'Cần Giuộc', '80'),
('808', 'Châu Thành', '80'),
('815', 'Mỹ Tho', '82'),
('816', 'Gò Công', '82'),
('817', 'Cai Lậy', '82'),
('818', 'Tân Phước', '82'),
('819', 'Cái Bè', '82'),
('820', 'Cai Lậy', '82'),
('821', 'Châu Thành', '82'),
('822', 'Chợ Gạo', '82'),
('823', 'Gò Công Tây', '82'),
('824', 'Gò Công Đông', '82'),
('825', 'Tân Phú Đông', '82'),
('829', 'Bến Tre', '83'),
('831', 'Châu Thành', '83'),
('832', 'Chợ Lách', '83'),
('833', 'Mỏ Cày Nam', '83'),
('834', 'Giồng Trôm', '83'),
('835', 'Bình Đại', '83'),
('836', 'Ba Tri', '83'),
('837', 'Thạnh Phú', '83'),
('838', 'Mỏ Cày Bắc', '83'),
('842', 'Trà Vinh', '84'),
('844', 'Càng Long', '84'),
('845', 'Cầu Kè', '84'),
('846', 'Tiểu Cần', '84'),
('847', 'Châu Thành', '84'),
('848', 'Cầu Ngang', '84'),
('849', 'Trà Cú', '84'),
('850', 'Duyên Hải', '84'),
('851', 'Duyên Hải', '84'),
('855', 'Vĩnh Long', '86'),
('857', 'Long Hồ', '86'),
('858', 'Mang Thít', '86'),
('859', 'Vũng Liêm', '86'),
('860', 'Tam Bình', '86'),
('861', 'Bình Minh', '86'),
('862', 'Trà Ôn', '86'),
('863', 'Bình Tân', '86'),
('866', 'Cao Lãnh', '87'),
('867', 'Sa Đéc', '87'),
('868', 'Hồng Ngự', '87'),
('869', 'Tân Hồng', '87'),
('870', 'Hồng Ngự', '87'),
('871', 'Tam Nông', '87'),
('872', 'Tháp Mười', '87'),
('873', 'Cao Lãnh', '87'),
('874', 'Thanh Bình', '87'),
('875', 'Lấp Vò', '87'),
('876', 'Lai Vung', '87'),
('877', 'Châu Thành', '87'),
('883', 'Long Xuyên', '89'),
('884', 'Châu Đốc', '89'),
('886', 'An Phú', '89'),
('887', 'Tân Châu', '89'),
('888', 'Phú Tân', '89'),
('889', 'Châu Phú', '89'),
('890', 'Tịnh Biên', '89'),
('891', 'Tri Tôn', '89'),
('892', 'Châu Thành', '89'),
('893', 'Chợ Mới', '89'),
('894', 'Thoại Sơn', '89'),
('899', 'Rạch Giá', '91'),
('900', 'Hà Tiên', '91'),
('902', 'Kiên Lương', '91'),
('903', 'Hòn Đất', '91'),
('904', 'Tân Hiệp', '91'),
('905', 'Châu Thành', '91'),
('906', 'Giồng Riềng', '91'),
('907', 'Gò Quao', '91'),
('908', 'An Biên', '91'),
('909', 'An Minh', '91'),
('910', 'Vĩnh Thuận', '91'),
('911', 'Phú Quốc', '91'),
('912', 'Kiên Hải', '91'),
('913', 'U Minh Thượng', '91'),
('914', 'Giang Thành', '91'),
('916', 'Ninh Kiều', '92'),
('917', 'Ô Môn', '92'),
('918', 'Bình Thuỷ', '92'),
('919', 'Cái Răng', '92'),
('923', 'Thốt Nốt', '92'),
('924', 'Vĩnh Thạnh', '92'),
('925', 'Cờ Đỏ', '92'),
('926', 'Phong Điền', '92'),
('927', 'Thới Lai', '92'),
('930', 'Vị Thanh', '93'),
('931', 'Ngã Bảy', '93'),
('932', 'Châu Thành A', '93'),
('933', 'Châu Thành', '93'),
('934', 'Phụng Hiệp', '93'),
('935', 'Vị Thuỷ', '93'),
('936', 'Long Mỹ', '93'),
('937', 'Long Mỹ', '93'),
('941', 'Sóc Trăng', '94'),
('942', 'Châu Thành', '94'),
('943', 'Kế Sách', '94'),
('944', 'Mỹ Tú', '94'),
('945', 'Cù Lao Dung', '94'),
('946', 'Long Phú', '94'),
('947', 'Mỹ Xuyên', '94'),
('948', 'Ngã Năm', '94'),
('949', 'Thạnh Trị', '94'),
('950', 'Vĩnh Châu', '94'),
('951', 'Trần Đề', '94'),
('954', 'Bạc Liêu', '95'),
('956', 'Hồng Dân', '95'),
('957', 'Phước Long', '95'),
('958', 'Vĩnh Lợi', '95'),
('959', 'Giá Rai', '95'),
('960', 'Đông Hải', '95'),
('961', 'Hoà Bình', '95'),
('964', 'Cà Mau', '96'),
('966', 'U Minh', '96'),
('967', 'Thới Bình', '96'),
('968', 'Trần Văn Thời', '96'),
('969', 'Cái Nước', '96'),
('970', 'Đầm Dơi', '96'),
('971', 'Năm Căn', '96'),
('972', 'Phú Tân', '96'),
('973', 'Ngọc Hiển', '96');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `DetailID` int(11) NOT NULL,
  `InvoiceID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `invoicedetails`
--

INSERT INTO `invoicedetails` (`DetailID`, `InvoiceID`, `ProductID`, `Quantity`) VALUES
(131, 125, 2, 1),
(132, 126, 3, 1),
(133, 127, 9, 1),
(134, 127, 7, 1),
(135, 128, 30, 1),
(136, 129, 20, 1),
(137, 129, 17, 1),
(142, 134, 22, 2),
(143, 134, 13, 2),
(144, 135, 2, 5),
(145, 135, 30, 5),
(146, 136, 2, 4),
(147, 138, 4, 7),
(148, 139, 7, 10),
(149, 140, 9, 10),
(150, 141, 30, 10),
(151, 142, 2, 1),
(152, 143, 2, 7),
(153, 144, 2, 6),
(154, 144, 22, 4),
(155, 144, 30, 2),
(156, 145, 2, 3),
(157, 146, 2, 1),
(160, 149, 2, 3),
(161, 149, 61, 1),
(162, 150, 61, 1),
(165, 153, 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `InvoiceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `InvoiceDate` date DEFAULT curdate(),
  `TotalAmount` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `NumberPhone` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `DateDelivery` date NOT NULL,
  `Note` varchar(255) NOT NULL,
  `UsePoints` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`InvoiceID`, `UserID`, `InvoiceDate`, `TotalAmount`, `status`, `PaymentType`, `NumberPhone`, `Address`, `DateDelivery`, `Note`, `UsePoints`) VALUES
(125, 29, '2025-04-07', 31000000, 3, 'normal', '0368731585', 'nct, Ba Bể, Bắc Kạn', '0000-00-00', '', 0),
(126, 29, '2025-04-07', 29000000, 3, 'normal', '0368731585', 'nct, Ba Bể, Bắc Kạn', '0000-00-00', '', 0),
(127, 29, '2025-05-10', 55000000, 3, 'normal', '0368731585', 'nct, Ba Bể, Bắc Kạn', '0000-00-00', '', 0),
(128, 1, '2025-04-07', 17000000, 4, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(129, 1, '2025-04-07', 51000000, 3, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(134, 1, '2025-04-09', 110000000, 3, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(135, 1, '2025-04-09', 240000000, 3, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(136, 1, '2025-04-09', 124000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(138, 1, '2025-04-09', 196000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(139, 1, '2025-04-09', 200000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(140, 1, '2025-04-09', 350000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(141, 1, '2025-04-09', 170000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(142, 1, '2025-04-09', 31000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(143, 1, '2025-04-09', 217000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(144, 1, '2025-04-09', 316000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(145, 1, '2025-04-09', 93000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(146, 1, '2025-04-09', 31000000, 0, 'normal', '03687315855', 'nct, Ba Đình, Hà Nội', '0000-00-00', '', 0),
(149, 1, '2025-04-09', 93000001, 0, 'normal', '03687315855', 'nct, Đống Đa, Hà Nội', '2025-04-17', '', 0),
(150, 1, '2025-04-09', 1, 0, 'normal', '03687315855', 'xxx, Na Hang, Tuyên Quang', '0000-00-00', '', 0),
(153, 31, '2025-04-10', 29000000, 3, 'normal', '0368731585', 'xx, Hai Bà Trưng, Hà Nội', '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `linkinvoices`
--

CREATE TABLE `linkinvoices` (
  `LinkID` int(255) NOT NULL,
  `InvoiceID` int(255) NOT NULL,
  `URL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `linkinvoices`
--

INSERT INTO `linkinvoices` (`LinkID`, `InvoiceID`, `URL`) VALUES
(1, 86, 'C:/xampp/htdocs/WebsiteSells/public/bill/ID_86_Name_Nguyên công Trần_hoadon.docx'),
(2, 80, 'C:/xampp/htdocs/WebsiteSells/public/bill/ID_80_Name_Nguyên công Trần_hoadon.docx'),
(3, 79, 'C:/xampp/htdocs/WebsiteSells/public/bill/ID_79_Name_meoemo_hoadon.docx');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loginmanager`
--

CREATE TABLE `loginmanager` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TimeLogin` datetime NOT NULL,
  `Action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loginmanager`
--

INSERT INTO `loginmanager` (`ID`, `UserID`, `TimeLogin`, `Action`) VALUES
(7, 15, '2025-02-19 17:30:19', 'Login'),
(8, 15, '2025-02-19 17:51:22', 'Logout'),
(9, 15, '2025-02-19 17:51:55', 'Login'),
(10, 15, '2025-02-19 17:51:55', 'Delete'),
(11, 15, '2025-02-19 18:00:58', 'Delete'),
(12, 15, '2025-02-19 20:36:37', 'Logout'),
(13, 15, '2025-02-19 20:38:09', 'Login'),
(14, 15, '2025-02-19 20:38:26', 'Delete Oder'),
(15, 15, '2025-02-19 20:40:55', 'Logout'),
(16, 15, '2025-02-19 23:56:59', 'Login'),
(17, 15, '2025-02-19 23:58:37', 'Logout'),
(18, 15, '2025-02-20 00:11:46', 'Login'),
(19, 15, '2025-02-20 20:53:10', 'Login'),
(20, 15, '2025-02-20 20:53:20', 'Logout'),
(21, 15, '2025-02-22 07:27:33', 'Login'),
(22, 15, '2025-02-23 22:21:56', 'Login'),
(23, 15, '2025-02-23 22:23:15', 'Logout'),
(24, 15, '2025-02-28 15:35:03', 'Login'),
(25, 15, '2025-02-28 17:10:13', 'Delete'),
(26, 15, '2025-02-28 17:42:09', 'Logout'),
(27, 15, '2025-02-28 17:44:19', 'Login'),
(28, 15, '2025-02-28 17:44:54', 'Logout'),
(29, 15, '2025-02-28 17:53:33', 'Login'),
(30, 15, '2025-02-28 17:53:44', 'Logout'),
(31, 15, '2025-03-01 09:08:10', 'Login'),
(32, 15, '2025-03-01 09:08:11', 'Logout'),
(33, 15, '2025-03-01 09:56:41', 'Login'),
(34, 15, '2025-03-01 09:56:50', 'Logout'),
(35, 15, '2025-03-01 22:15:38', 'Login'),
(36, 15, '2025-03-01 22:15:55', 'Logout'),
(41, 15, '2025-03-01 22:21:21', 'Login'),
(42, 15, '2025-03-01 22:21:43', 'Logout'),
(43, 15, '2025-03-01 22:22:11', 'Login'),
(44, 15, '2025-03-01 22:24:41', 'Logout'),
(45, 15, '2025-03-01 22:25:32', 'Login'),
(46, 15, '2025-03-01 22:26:18', 'Logout'),
(47, 15, '2025-03-14 17:34:01', 'Login'),
(48, 15, '2025-03-14 17:39:46', 'Logout'),
(49, 15, '2025-03-15 07:56:55', 'Login'),
(50, 15, '2025-03-15 13:43:55', 'Login'),
(51, 15, '2025-03-17 11:16:02', 'Login'),
(52, 15, '2025-03-17 12:25:28', 'Delete'),
(53, 15, '2025-03-17 12:25:44', 'Delete'),
(54, 15, '2025-03-17 20:40:39', 'Login'),
(55, 15, '2025-03-19 19:30:22', 'Login'),
(56, 15, '2025-03-19 19:39:44', 'Delete'),
(57, 15, '2025-03-19 21:04:08', 'Logout'),
(58, 15, '2025-03-19 21:04:28', 'Login'),
(59, 15, '2025-03-19 23:47:11', 'Login'),
(61, 15, '2025-03-20 00:11:33', 'Login'),
(62, 15, '2025-03-20 00:14:49', 'Delete'),
(63, 15, '2025-03-20 00:14:58', 'Delete'),
(64, 15, '2025-04-01 20:23:28', 'Login'),
(65, 15, '2025-04-01 20:26:29', 'Logout'),
(66, 15, '2025-04-01 20:33:06', 'Login'),
(67, 15, '2025-04-01 20:44:20', 'Logout'),
(68, 15, '2025-04-01 20:46:02', 'Login'),
(69, 15, '2025-04-01 20:46:53', 'Delete Oder'),
(70, 15, '2025-04-05 07:05:51', 'Login'),
(71, 15, '2025-04-05 07:09:48', 'Delete'),
(72, 15, '2025-04-05 07:09:58', 'Delete'),
(73, 15, '2025-04-05 07:13:25', 'Login'),
(74, 15, '2025-04-05 07:24:02', 'Logout'),
(75, 15, '2025-04-05 07:37:08', 'Login'),
(76, 15, '2025-04-05 07:48:01', 'Delete'),
(77, 15, '2025-04-05 08:01:33', 'Logout'),
(78, 15, '2025-04-05 08:04:49', 'Login'),
(79, 15, '2025-04-05 08:21:04', 'Login'),
(80, 15, '2025-04-05 08:21:44', 'Logout'),
(81, 15, '2025-04-05 10:16:51', 'Login'),
(82, 15, '2025-09-05 10:53:45', 'Delete'),
(83, 15, '2025-04-07 21:06:21', 'Login'),
(84, 15, '2025-04-07 21:52:06', 'Login'),
(85, 15, '2025-04-07 21:59:56', 'Logout'),
(86, 15, '2025-04-07 22:44:29', 'Login'),
(87, 15, '2025-04-07 23:24:38', 'Login'),
(88, 15, '2025-04-07 23:36:53', 'Logout'),
(89, 15, '2025-04-07 23:43:06', 'Login'),
(90, 15, '2025-04-07 23:51:44', 'Logout'),
(91, 15, '2025-04-07 23:51:57', 'Login'),
(92, 15, '2025-04-08 00:01:05', 'Login'),
(93, 15, '2025-04-08 00:35:46', 'Logout'),
(94, 15, '2025-04-08 00:35:55', 'Login'),
(95, 15, '2025-04-08 00:36:44', 'Logout'),
(96, 15, '2025-04-08 00:39:22', 'Login'),
(97, 15, '2025-04-09 13:07:03', 'Login'),
(98, 15, '2025-04-09 13:20:16', 'Login'),
(99, 15, '2025-04-09 13:20:23', 'Delete'),
(100, 15, '2025-04-09 13:20:27', 'Logout'),
(101, 15, '2025-04-09 13:20:43', 'Login'),
(102, 15, '2025-04-09 13:25:28', 'Delete'),
(103, 15, '2025-04-09 15:56:32', 'Logout'),
(104, 15, '2025-04-09 17:21:17', 'Login'),
(105, 15, '2025-04-09 21:13:52', 'Login'),
(106, 15, '2025-04-09 21:18:57', 'Delete'),
(107, 15, '2025-04-09 21:19:41', 'Logout'),
(108, 15, '2025-04-09 21:24:17', 'Login'),
(109, 15, '2025-04-09 21:25:16', 'Delete Oder'),
(110, 15, '2025-04-09 21:25:19', 'Delete Oder'),
(111, 15, '2025-04-09 21:25:22', 'Delete Oder'),
(112, 15, '2025-04-09 21:28:01', 'Logout'),
(113, 15, '2025-04-09 21:29:09', 'Login'),
(114, 15, '2025-04-09 21:29:30', 'Delete'),
(115, 15, '2025-04-09 21:29:34', 'Logout'),
(116, 15, '2025-04-09 21:33:52', 'Login'),
(117, 30, '2025-04-09 21:37:37', 'Logout'),
(118, 15, '2025-04-09 21:37:50', 'Login'),
(119, 15, '2025-04-09 21:40:28', 'Logout'),
(120, 15, '2025-04-10 18:07:10', 'Login'),
(121, 15, '2025-04-10 18:08:37', 'Logout');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loyaltypoints`
--

CREATE TABLE `loyaltypoints` (
  `PointID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PointsEarned` int(11) DEFAULT 0,
  `PointsUsed` int(11) DEFAULT 0,
  `TransactionDate` date DEFAULT curdate(),
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `InvoiceID` int(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`ID`, `UserID`, `InvoiceID`, `Content`, `Status`, `Time`) VALUES
(23, 1, 98, 'Giao hang thanh cong', '1', '2025-03-17 22:35:34'),
(26, 1, 80, 'Giao hang thanh cong', '1', '2025-04-01 20:47:59'),
(31, 1, 80, 'Giao hang thanh cong', '1', '2025-04-07 21:31:05'),
(32, 1, 79, 'Giao hang thanh cong', '1', '2025-04-07 21:31:31'),
(33, 1, 79, 'Giao hang thanh cong', '1', '2025-04-07 21:31:50'),
(34, 1, 122, 'Giao hang thanh cong', '1', '2025-04-07 21:32:52'),
(35, 1, 115, 'Giao hang thanh cong', '1', '2025-04-07 21:36:00'),
(37, 29, 125, 'Giao hang thanh cong', '1', '2025-04-08 00:01:11'),
(38, 29, 126, 'Giao hang thanh cong', '1', '2025-04-08 00:01:13'),
(39, 29, 127, 'Giao hang thanh cong', '1', '2025-04-08 00:01:16'),
(46, 1, 135, 'Giao hang thanh cong', '1', '2025-04-09 21:26:08'),
(47, 31, 153, 'Giao hang thanh cong', '1', '2025-04-10 18:07:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productdetails`
--

CREATE TABLE `productdetails` (
  `ProductDetaiID` int(255) NOT NULL,
  `ProductType` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `productdetails`
--

INSERT INTO `productdetails` (`ProductDetaiID`, `ProductType`, `Img`) VALUES
(1, 'Iphone 16', 'https://cdnv2.tgdd.vn/mwg-static//42/329138/s16/iphone-16-plus-pink-6-638621670633730226-650x650.jpg'),
(2, 'Iphone 16', 'https://cdnv2.tgdd.vn/mwg-static//42/329138/s16/iphone-16-plus-pink-7-638621670640790888-650x650.jpg'),
(3, 'Iphone 16', 'https://cdnv2.tgdd.vn/mwg-static//42/329138/s16/iphone-16-plus-pink-8-638621670648966251-650x650.jpg'),
(4, 'Iphone 16', 'https://cdnv2.tgdd.vn/mwg-static//42/329138/s16/iphone-16-plus-pink-10-638621670665483270-650x650.jpg'),
(5, 'MacBook Air', 'https://cdn.tgdd.vn/Products/Images/44/231244/s16/macbook-air-m1-spgry-02-650x650.jpg'),
(6, 'Apple Watch Series 10', 'https://cdnv2.tgdd.vn/mwg-static//7077/316008/s16/apple-watch-se-2023-gps-day-vai-starlight-4-638671123946590847-650x650.jpg'),
(7, 'Mac Mini M4 Pro ', 'https://cdnv2.tgdd.vn/mwg-static//5698/331505/s16/mac-mini-m4-pro-48gb-1tb-3-638671788292267498-650x650.jpg'),
(8, 'Iphone 16 Pro Max', 'https://cdnv2.tgdd.vn/mwg-static//42/329149/s16/iphone-16-pro-max-desert-titan-6-638621795603626395-650x650.jpg'),
(9, 'Iphone 16 Pro Max', 'https://cdnv2.tgdd.vn/mwg-static//42/329149/s16/iphone-16-pro-max-desert-titan-8-638621795619447667-650x650.jpg'),
(121, 'iPhone 16e', '/public/ImgType/67c18bae6ecf4_iphone-16e-black-tz-8-638756446555940600-650x650.jpg'),
(122, 'iPhone 16e', '/public/ImgType/67c18bae6f076_iphone-16e-black-tz-7-638756446547840092-650x650.jpg'),
(123, 'iPhone 16e', '/public/ImgType/67c18bae6f2cd_iphone-16e-black-tz-6-638756446540426235-650x650.jpg'),
(124, 'iPhone 16e', '/public/ImgType/67c18bae6f485_iphone-16e-black-tz-5-638756446531591535-650x650.jpg'),
(125, 'iPhone 16e', '/public/ImgType/67c18bae6f6e8_iphone-16e-black-tz-4-638756446503324970-650x650.jpg'),
(126, 'iPad Pro M2', '/public/ImgType/67c18ed8c6204_vn_ipad_pro_cellular_12-9_in_6th_gen_silver_pdp_image_position-4-650x650.jpg'),
(127, 'iPad Pro M2', '/public/ImgType/67c18ed8c6364_vn_ipad_pro_cellular_12-9_in_6th_gen_silver_pdp_image_position-3-650x650.jpg'),
(128, 'Iphone 13', '/public/ImgType/67d406f27dcc6_iphone-13-256gb-xanh-duong-6-650x650.jpg'),
(129, 'Iphone 13', '/public/ImgType/67d406f27e09b_iphone-13-256gb-xanh-duong-4-650x650.jpg'),
(130, 'Iphone 13', '/public/ImgType/67d406f27e45d_iphone-13-256gb-xanh-duong-1-650x650.jpg'),
(131, 'aaa', '/public/ImgType/67d4d5a352763_Screenshot 2025-02-18 213817.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productlines`
--

CREATE TABLE `productlines` (
  `ProductLineID` int(11) NOT NULL,
  `ProductLineName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `productlines`
--

INSERT INTO `productlines` (`ProductLineID`, `ProductLineName`) VALUES
(1, 'Iphone'),
(2, 'Macbook\r\n'),
(3, 'Mac'),
(4, 'Watch'),
(5, 'Ipad'),
(6, 'Accessory');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductLineID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Status` int(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `OriginalPrice` int(255) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT 0,
  `Img` varchar(255) DEFAULT NULL,
  `Capacity` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ProductID`, `ProductLineID`, `ProductName`, `Status`, `Price`, `OriginalPrice`, `Stock`, `Img`, `Capacity`, `Color`) VALUES
(2, 1, 'Iphone 16 255GB', 0, 31000000.00, 32000000, -31, '/uploads/iphone-15-green-1-2-650x650.png', '255GB', 'pink'),
(3, 1, 'Iphone 16 128GB pink', 0, 29000000.00, 32000000, 98, 'https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png', '128GB', 'pink'),
(4, 1, 'Iphone 16 512GB', 0, 28000000.00, 32000000, 90, 'https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png', '512GB', 'pink'),
(7, 2, 'MacBook Air 13 inch M2 8GPU 512GB', 0, 20000000.00, 32000000, 100, 'https://cdn.tgdd.vn/Products/Images/44/231244/s16/mac-air-m1-13-xam-new-650x650.png', '512GB', 'white'),
(8, 4, 'Apple Watch Series 10 GPS + Cellular 42mm viền nhôm dây vải', 0, 34000000.00, 32000000, 100, 'https://cdn.tgdd.vn/Products/Images/7077/316008/s16/t%C3%A1ch%20n%E1%BB%81n%20site%2016-650x650.png', '512GB', 'white'),
(9, 3, 'Mac Mini M4 Pro 48GB/512GB', 0, 35000000.00, 32000000, 85, 'https://cdn.tgdd.vn/Products/Images/5698/331504/s16/mac-mini-m4-pro-48gb-512gb-thumb-16-650x650.png', '512GB', 'white'),
(13, 1, 'Iphone 16 512GB', 0, 31000000.00, 32000000, 1109, 'https://cdn.tgdd.vn/Products/Images/42/329135/s16/iphone-16-xanh-la-650x650.png', '512GB', 'green'),
(14, 1, 'Iphone 16 Pro Max', 0, 31000000.00, 32000000, 10, 'https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png', '255GB', 'yellow'),
(15, 5, 'iPad 10 5G', 0, 31000000.00, 32000000, 8, 'https://cdn.tgdd.vn/Products/Images/522/295453/s16/ipad-gen-10-blue-650x650.png', '255GB', 'blue'),
(16, 6, 'Cáp Thunderbolt 4 1.8m', 0, 31000000.00, 32000000, 9, 'https://cdn.tgdd.vn/Products/Images/58/325164/s16/cap-thunderbolt-4-mw5j3-650x650.png', 'null', 'black'),
(17, 6, 'AirTag', 0, 31000000.00, 32000000, 8, 'https://cdn.tgdd.vn/Products/Images/10618/238092/s16/airtag-650x650.png', 'null', 'white'),
(18, 1, 'iPhone 15 Pro 1T', 0, 29000000.00, 32000000, 88, 'https://cdn.tgdd.vn/Products/Images/42/303832/s16/iphone-15-pro-blue-1-2-650x650.png', '1T', 'black'),
(19, 2, 'MacBook Pro 14 inch M4', 0, 20000000.00, 32000000, 11110, 'https://cdn.tgdd.vn/Products/Images/44/331564/s16/macbook-pro-14-inch-m4-pro-topzone-den-thumb-650x650.png', 'RAM-16/ROM-512GB', 'black'),
(20, 2, 'MacBook Air 13 inch M3 10GPU', 0, 20000000.00, 32000000, 1110, 'https://cdn.tgdd.vn/Products/Images/44/322633/s16/macbook-air-15-inch-m3-2024-xam-650x650.png', 'RAM-8GB/ROM-512GB', 'white'),
(21, 1, 'Iphone 16 Pro 1T', 0, 28000000.00, 300000000, 6, 'public/img/1739110657_iphone-16-pro-tu-nhien-650x650.png', '1T', 'white'),
(22, 1, 'Iphone 14 255GB', 0, 24000000.00, 28000000, 186, 'public/img/1739113522_iphone-14-purple-650x650.png', '255GB', 'pink'),
(24, 1, 'Iphone 14 255GB yellow', 0, 26000000.00, 28000000, 309, 'public/img/1739198763_iphone-14-gold-1-650x650.png', '255GB', 'yellow'),
(29, 1, 'iPhone 16e 128GB', 0, 24151452.00, 111212335, 124, 'public/img/1740842368_iphone-16e-black-thumbtz-650x650.png', '128GB', 'black'),
(30, 1, 'Iphone 13 128GB', 0, 17000000.00, 20000000, -8, 'public/img/1741948576_iphone-13-blue-1-2-3-650x650.png', '128GB', 'green'),
(44, 2, 'iPhone 13', 0, 10000000.00, 11, 1, '/uploads/iphone-13-black-1-2-3-650x650.png', '255GB', 'green'),
(45, 6, 'AirPods Max', 0, 4500000.00, 5000000, 1, 'public/img/1743812040_bluetooth-airpods-max-apple-pink-tn-650x650.png', ' ', 'pink'),
(46, 5, 'IPad Pro M4 13 inch WiFi', 0, 11000000.00, 12000000, 1, 'public/img/1743812097_ipad-pro-13-inch-wifi-silver-650x650.png', '255GB', 'white'),
(47, 5, 'iPad mini 7 WiFi', 0, 12000000.00, 15000000, 0, 'public/img/1743812146_ipad-mini-7-wifi-grey-thumbtz-650x650.png', '128GB', 'black'),
(48, 5, 'iPad 11 (A16) 5G', 0, 11000000.00, 12000000, 1, 'public/img/1743812214_ipad-11-5g-yellow-thumb-650x650.png', '255GB', 'yellow'),
(49, 5, 'iPad Pro M4 13 inch Nano WiFi', 0, 11000000.00, 12000000, 1, 'public/img/1743812274_ipad-pro-13-inch-wifi-nano-black-650x650.png', '1T', 'black'),
(50, 5, 'iPad Pro M4 13 inch Nano WiFi', 0, 11900000.00, 12000000, 1, 'public/img/1743812320_ipad-pro-13-inch-wifi-nano-silver-650x650.png', '2TB', 'white'),
(51, 5, 'iPad 9 4G', 0, 8000000.00, 9000000, 1, 'public/img/1743812373_ipad-9-lte-grey-650x650.png', '128GB', 'black'),
(52, 5, 'iPad Air 6 M2 13 inch 5G', 0, 9000000.00, 10000000, 1, 'public/img/1743812449_ipad-air-m2-13-inch-wifi-cellular-blue-thumb-650x650.png', '128GB', 'green'),
(53, 5, 'iPad Air 6 M2 13 inch 5G', 0, 8000000.00, 9000000, 1, 'public/img/1743812484_ipad-air-m2-13-inch-wifi-cellular-purple-thumb-650x650.png', '128GB', 'pink'),
(54, 2, 'MacBook Air 13 inch M1', 0, 28000000.00, 29000000, 1, 'public/img/1743812735_mac-air-m1-13-xam-new-650x650.png', '255GB', 'white'),
(55, 4, 'Apple Watch Series 9 GPS 45mm viền nhôm dây thể thao', 0, 29000000.00, 3000000, 1, 'public/img/1743812805_apple-watch-s9-45mm-vien-nhom-day-silicone-do-thumb-650x650.png', '128GB', 'red'),
(56, 4, 'Apple Watch Series 9 GPS + Cellular 41mm viền nhôm dây vải', 0, 9000000.00, 10000000, 1, 'public/img/1743812853_apple-watch-s9-vien-nhom-day-vai-hong-tb-1-650x650.png', '128GB', 'pink'),
(57, 4, 'Apple Watch Series 10 GPS + Cellular 42mm viền nhôm dây thể thao', 0, 11000000.00, 12000000, 1, 'public/img/1743812899_apple-watch-s10-den-tb-650x650.png', '128GB', 'black'),
(58, 3, 'Mac Studio M4 Max 36GB/512GB', 0, 35000000.00, 40000000, 1, 'public/img/1743814018_mac-studio-m4-max-36gb-512gb-070325-031326-214-650x650.png', '512GB', 'white'),
(59, 3, 'Mac Studio M4 Max 36GB/255GB', 0, 25000000.00, 30000000, 1, 'public/img/1743814057_mac-studio-m4-max-36gb-512gb-070325-031326-214-650x650.png', '255GB', 'white'),
(61, 1, 'z', 1, 1.00, 12, -1, '/uploads/iphone-13-black-1-2-3-650x650.png', '1', 'black');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`code`, `name`) VALUES
('01', 'Hà Nội'),
('02', 'Hà Giang'),
('04', 'Cao Bằng'),
('06', 'Bắc Kạn'),
('08', 'Tuyên Quang'),
('10', 'Lào Cai'),
('11', 'Điện Biên'),
('12', 'Lai Châu'),
('14', 'Sơn La'),
('15', 'Yên Bái'),
('17', 'Hoà Bình'),
('19', 'Thái Nguyên'),
('20', 'Lạng Sơn'),
('22', 'Quảng Ninh'),
('24', 'Bắc Giang'),
('25', 'Phú Thọ'),
('26', 'Vĩnh Phúc'),
('27', 'Bắc Ninh'),
('30', 'Hải Dương'),
('31', 'Hải Phòng'),
('33', 'Hưng Yên'),
('34', 'Thái Bình'),
('35', 'Hà Nam'),
('36', 'Nam Định'),
('37', 'Ninh Bình'),
('38', 'Thanh Hóa'),
('40', 'Nghệ An'),
('42', 'Hà Tĩnh'),
('44', 'Quảng Bình'),
('45', 'Quảng Trị'),
('46', 'Huế'),
('48', 'Đà Nẵng'),
('49', 'Quảng Nam'),
('51', 'Quảng Ngãi'),
('52', 'Bình Định'),
('54', 'Phú Yên'),
('56', 'Khánh Hòa'),
('58', 'Ninh Thuận'),
('60', 'Bình Thuận'),
('62', 'Kon Tum'),
('64', 'Gia Lai'),
('66', 'Đắk Lắk'),
('67', 'Đắk Nông'),
('68', 'Lâm Đồng'),
('70', 'Bình Phước'),
('72', 'Tây Ninh'),
('74', 'Bình Dương'),
('75', 'Đồng Nai'),
('77', 'Bà Rịa - Vũng Tàu'),
('79', 'Hồ Chí Minh'),
('80', 'Long An'),
('82', 'Tiền Giang'),
('83', 'Bến Tre'),
('84', 'Trà Vinh'),
('86', 'Vĩnh Long'),
('87', 'Đồng Tháp'),
('89', 'An Giang'),
('91', 'Kiên Giang'),
('92', 'Cần Thơ'),
('93', 'Hậu Giang'),
('94', 'Sóc Trăng'),
('95', 'Bạc Liêu'),
('96', 'Cà Mau');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `LoyaltyPoints` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `PhoneNumber`, `Address`, `LoyaltyPoints`) VALUES
(1, 'Nguyên công Trần', '03687315855', 'xxx, Na Hang, Tuyên Quang', 480000),
(15, 'Admin', NULL, NULL, 0),
(28, 'Nguyên công Trần', '0368731585', '1231, Đồng Văn, Hà Giang', 0),
(29, 'Nguyên công a', '0368731585', 'nct, Ba Bể, Bắc Kạn', 0),
(30, 'Nguyên công', '0368731585', '1, Thanh Xuân, Hà Nội', 0),
(31, 'Ngũ', '0368731585', 'xx, Hai Bà Trưng, Hà Nội', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`BannerID`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Chỉ mục cho bảng `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`CreditID`),
  ADD KEY `fk_user` (`UserID`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`code`),
  ADD KEY `districts_province_code_fkey` (`province_code`);

--
-- Chỉ mục cho bảng `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `InvoiceID` (`InvoiceID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `linkinvoices`
--
ALTER TABLE `linkinvoices`
  ADD PRIMARY KEY (`LinkID`);

--
-- Chỉ mục cho bảng `loginmanager`
--
ALTER TABLE `loginmanager`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `loyaltypoints`
--
ALTER TABLE `loyaltypoints`
  ADD PRIMARY KEY (`PointID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`ProductDetaiID`);

--
-- Chỉ mục cho bảng `productlines`
--
ALTER TABLE `productlines`
  ADD PRIMARY KEY (`ProductLineID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ProductLineID` (`ProductLineID`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`code`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `BannerID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `credit`
--
ALTER TABLE `credit`
  MODIFY `CreditID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT cho bảng `linkinvoices`
--
ALTER TABLE `linkinvoices`
  MODIFY `LinkID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loginmanager`
--
ALTER TABLE `loginmanager`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `loyaltypoints`
--
ALTER TABLE `loyaltypoints`
  MODIFY `PointID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `ProductDetaiID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT cho bảng `productlines`
--
ALTER TABLE `productlines`
  MODIFY `ProductLineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_code_fkey` FOREIGN KEY (`province_code`) REFERENCES `provinces` (`code`);

--
-- Các ràng buộc cho bảng `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`InvoiceID`) REFERENCES `invoices` (`InvoiceID`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `loginmanager`
--
ALTER TABLE `loginmanager`
  ADD CONSTRAINT `loginmanager_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `loyaltypoints`
--
ALTER TABLE `loyaltypoints`
  ADD CONSTRAINT `loyaltypoints_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ProductLineID`) REFERENCES `productlines` (`ProductLineID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
