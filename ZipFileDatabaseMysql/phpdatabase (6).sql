-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 14, 2025 lúc 12:02 PM
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
(11, 'meo@gmail.com', '1', 0, 14),
(12, 'Admin@gmail.com', '123', 1, 15),
(13, 'nguyennrdz123@gmail.com', '123', 0, 16),
(14, 'meo1@gmail.com', '123', 0, 17);

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
(86, 1, 18, 3),
(87, 1, 22, 1);

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
(78, 77, 4, 2),
(79, 77, 7, 1),
(80, 78, 18, 1),
(81, 79, 2, 1),
(82, 80, 22, 1),
(85, 83, 2, 1),
(86, 83, 9, 1),
(87, 84, 9, 2),
(88, 85, 15, 1),
(89, 85, 20, 1),
(90, 86, 18, 1),
(91, 86, 9, 1),
(92, 87, 18, 1),
(93, 88, 15, 1),
(95, 90, 22, 1),
(96, 91, 22, 1),
(97, 92, 18, 1),
(98, 93, 2, 1),
(99, 94, 18, 1);

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
(77, 14, '2025-02-06', 76000000, 4, 'normal', '0368731585', '129', '0000-00-00', 'xx', 0),
(78, 14, '2025-02-06', 29000000, 3, 'normal', '0368731585', '129', '0000-00-00', 'xx', 0),
(79, 1, '2025-02-15', 31000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '0000-00-00', 'xx', 0),
(80, 1, '2024-12-18', 24000000, 3, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-24', '', 0),
(83, 1, '2025-02-20', 66000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-27', '', 0),
(84, 1, '2025-02-20', 70000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-26', '', 0),
(85, 1, '2025-02-20', 51000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-27', '', 0),
(86, 1, '2025-02-20', 64000000, 1, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-26', '', 0),
(87, 1, '2025-02-20', 29000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-26', '', 0),
(88, 1, '2025-02-20', 30999997, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-02-26', '', 0),
(90, 1, '2025-02-28', 12000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-03-12', 'xxxxxxxxxxxxxxxxxxxx', 0),
(91, 1, '2025-02-28', 12000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-03-06', 'xxxxxxxxxxxxxxxxxxxx', 0),
(92, 1, '2025-02-28', 29000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-03-06', 'xxxxxxxxxxxxxxxxxxxx', 0),
(93, 1, '2025-03-01', 19000000, 4, 'normal', '0368731585', '129', '2025-03-07', 'xxxxxxxxxxxxxxxxxxxx', 12000000),
(94, 1, '2025-03-01', 17000000, 4, 'normal', '0368731585', '129 tan thoi nhat', '2025-03-07', 'xxxxxxxxxxxxxxxxxxxx', 12000000);

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
(48, 15, '2025-03-14 17:39:46', 'Logout');

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
(17, 14, 78, 'Giao hang thanh cong', '1', '2025-03-01 22:22:45'),
(19, 1, 79, 'Send invoice word file', '2', '2025-03-14 17:39:43');

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
(130, 'Iphone 13', '/public/ImgType/67d406f27e45d_iphone-13-256gb-xanh-duong-1-650x650.jpg');

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
-- Cấu trúc bảng cho bảng `productmodel`
--

CREATE TABLE `productmodel` (
  `ProductModelID` int(11) NOT NULL,
  `ProductModelName` varchar(255) NOT NULL,
  `ProductLine` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `productmodel`
--

INSERT INTO `productmodel` (`ProductModelID`, `ProductModelName`, `ProductLine`) VALUES
(1, 'Iphone 16', 1),
(2, 'Iphone 15', 1),
(3, 'Iphone 14', 1),
(6, 'Iphone 13', 1),
(7, 'iPad Pro M2', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductLineID` int(11) NOT NULL,
  `ProductModel` varchar(255) NOT NULL,
  `ProductType` varchar(255) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
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

INSERT INTO `products` (`ProductID`, `ProductLineID`, `ProductModel`, `ProductType`, `ProductName`, `Price`, `OriginalPrice`, `Stock`, `Img`, `Capacity`, `Color`) VALUES
(2, 1, 'Iphone 16', 'Iphone 16', 'Iphone 16 255GB', 31000000.00, 32000000, 10, 'https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png', '255GB', 'pink'),
(3, 1, 'Iphone 16', 'Iphone 16', 'Iphone 16 128GB', 29000000.00, 32000000, 100, 'https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png', '128GB', 'pink'),
(4, 1, 'Iphone 16', 'Iphone 16', 'Iphone 16 512GB', 28000000.00, 32000000, 98, 'https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png', '512GB', 'pink'),
(7, 2, 'MacBook Air', 'MacBook Air M2', 'MacBook Air 13 inch M2 8GPU 512GB', 20000000.00, 32000000, 0, 'https://cdn.tgdd.vn/Products/Images/44/231244/s16/mac-air-m1-13-xam-new-650x650.png', '512GB', 'white'),
(8, 4, 'Apple Watch Series 10', 'Apple Watch Series 10', 'Apple Watch Series 10 GPS + Cellular 42mm viền nhôm dây vải', 34000000.00, 32000000, 100, 'https://cdn.tgdd.vn/Products/Images/7077/316008/s16/t%C3%A1ch%20n%E1%BB%81n%20site%2016-650x650.png', '512GB', 'white'),
(9, 3, 'Mac Mini', 'Mac Mini M4 Pro ', 'Mac Mini M4 Pro 48GB/512GB', 35000000.00, 32000000, 96, 'https://cdn.tgdd.vn/Products/Images/5698/331504/s16/mac-mini-m4-pro-48gb-512gb-thumb-16-650x650.png', '512GB', 'white'),
(12, 1, 'Iphone 16', 'Iphone 16', 'Iphone 16 255GB', 31000000.00, 32000000, 100, 'https://cdn.tgdd.vn/Products/Images/42/329135/s16/iphone-16-xanh-la-650x650.png', '255GB', 'green'),
(13, 1, 'Iphone 16', 'Iphone 16', 'Iphone 16 512GB', 31000000.00, 32000000, 0, 'https://cdn.tgdd.vn/Products/Images/42/329135/s16/iphone-16-xanh-la-650x650.png', '512GB', 'green'),
(14, 1, 'Iphone 16', 'Iphone 16 Pro Max', 'Iphone 16 Pro Max', 31000000.00, 32000000, 10, 'https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png', '255GB', 'yellow'),
(15, 5, 'iPad 10', 'iPad 10 5G', 'iPad 10 5G', 31000000.00, 32000000, 8, 'https://cdn.tgdd.vn/Products/Images/522/295453/s16/ipad-gen-10-blue-650x650.png', '255GB', 'blue'),
(16, 6, 'cables', 'cables', 'Cáp Thunderbolt 4 1.8m', 31000000.00, 32000000, 10, 'https://cdn.tgdd.vn/Products/Images/58/325164/s16/cap-thunderbolt-4-mw5j3-650x650.png', 'null', 'black'),
(17, 6, 'AirTag', 'AirTag', 'AirTag', 31000000.00, 32000000, 10, 'https://cdn.tgdd.vn/Products/Images/10618/238092/s16/airtag-650x650.png', 'null', 'white'),
(18, 1, 'iPhone 15 ', 'iPhone 15 Pro', 'iPhone 15 Pro 1T', 29000000.00, 32000000, 95, 'https://cdn.tgdd.vn/Products/Images/42/303832/s16/iphone-15-pro-blue-1-2-650x650.png', '1T', 'black'),
(19, 2, 'MacBook Pro 14', 'MacBook Pro 14', 'MacBook Pro 14 inch M4', 20000000.00, 32000000, 0, 'https://cdn.tgdd.vn/Products/Images/44/331564/s16/macbook-pro-14-inch-m4-pro-topzone-den-thumb-650x650.png', 'RAM-16/ROM-512GB', 'black'),
(20, 2, 'MacBook Air', 'MacBook Air M3', 'MacBook Air 13 inch M3 10GPU', 20000000.00, 32000000, 0, 'https://cdn.tgdd.vn/Products/Images/44/322633/s16/macbook-air-15-inch-m3-2024-xam-650x650.png', 'RAM-8GB/ROM-512GB', 'white'),
(21, 1, 'Iphone 16', 'Iphone 16 Pro', 'Iphone 16 Pro 1T', 28000000.00, 300000000, 6, 'public/img/1739110657_iphone-16-pro-tu-nhien-650x650.png', '1T', 'white'),
(22, 1, 'Iphone 14', 'Iphone 14', 'Iphone 14 255GB', 24000000.00, 28000000, 195, 'public/img/1739113522_iphone-14-purple-650x650.png', '255GB', 'pink'),
(24, 1, 'Iphone 14', 'Iphone 14', 'Iphone 14 255GB yellow', 26000000.00, 28000000, 309, 'public/img/1739198763_iphone-14-gold-1-650x650.png', '255GB', 'yellow'),
(28, 5, 'iPad Pro M2', 'iPad Pro M2', 'iPad Pro M2 12.9 inch 5G 2TB', 19000000.00, 20000000, 121, 'public/img/1740738334_iPad-Pro-M2-129-5G-sliver-thumb-650x650.png', '2TB', 'white'),
(29, 1, 'Iphone 16', 'iPhone 16e', 'iPhone 16e 128GB', 24151452.00, 111212335, 124, 'public/img/1740842368_iphone-16e-black-thumbtz-650x650.png', '128GB', 'black'),
(30, 1, 'Iphone 13', 'Iphone 13', 'Iphone 13 128GB', 17000000.00, 20000000, 13, 'public/img/1741948576_iphone-13-blue-1-2-3-650x650.png', '128GB', 'green');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeID` int(11) NOT NULL,
  `ProductModelID` int(11) NOT NULL,
  `ProductTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `producttype`
--

INSERT INTO `producttype` (`ProductTypeID`, `ProductModelID`, `ProductTypeName`) VALUES
(1, 1, 'Iphone 16'),
(2, 1, 'Iphone 16 Pro'),
(3, 1, 'Iphone 16 Pro Max'),
(4, 2, 'Iphone 15 Pro Max'),
(5, 3, 'Iphone 14'),
(27, 1, 'iPhone 16e'),
(30, 7, 'iPad Pro M2'),
(31, 6, 'Iphone 13');

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
(1, 'meoemo', '0368731585', 'meo meo', 0),
(14, 'Nguyên công meo', '0368731585', '129', 2),
(15, 'Admin', NULL, NULL, 0),
(16, 'Nguyên công Trần', '0368731585', '129', 0),
(17, 'Meo1', '0368731585', '129', 0);

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
-- Chỉ mục cho bảng `productmodel`
--
ALTER TABLE `productmodel`
  ADD PRIMARY KEY (`ProductModelID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ProductLineID` (`ProductLineID`);

--
-- Chỉ mục cho bảng `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ProductTypeID`);

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
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `BannerID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `credit`
--
ALTER TABLE `credit`
  MODIFY `CreditID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `linkinvoices`
--
ALTER TABLE `linkinvoices`
  MODIFY `LinkID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loginmanager`
--
ALTER TABLE `loginmanager`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `loyaltypoints`
--
ALTER TABLE `loyaltypoints`
  MODIFY `PointID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `ProductDetaiID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT cho bảng `productlines`
--
ALTER TABLE `productlines`
  MODIFY `ProductLineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `productmodel`
--
ALTER TABLE `productmodel`
  MODIFY `ProductModelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
