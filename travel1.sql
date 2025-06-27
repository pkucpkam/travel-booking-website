-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 07, 2024 lúc 02:28 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `travel1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `account` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`account`, `password`, `name`) VALUES
('admin1', 'adminpassword1', 'Admin One'),
('admin2', 'adminpassword2', 'Admin Two');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookdetail`
--

CREATE TABLE `bookdetail` (
  `username` varchar(50) DEFAULT NULL,
  `placeID` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `hotelName` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `checkInDate` date DEFAULT NULL,
  `checkOutDate` date DEFAULT NULL,
  `flightBrand` varchar(100) DEFAULT NULL,
  `typeTicket` varchar(50) DEFAULT NULL,
  `numberPeople` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookdetail`
--

INSERT INTO `bookdetail` (`username`, `placeID`, `location`, `hotelName`, `price`, `checkInDate`, `checkOutDate`, `flightBrand`, `typeTicket`, `numberPeople`) VALUES
('1', 'place1', 'Ha Noi', 'INTERCONTINENTAL HANOI WESTLAKE', 1000000.00, '2024-04-07', '2024-04-18', 'Airline Brands', 'Regular', 8),
('1', 'place1', 'Ha Noi', 'INTERCONTINENTAL HANOI WESTLAKE', 1000000.00, '2024-04-07', '2024-04-18', 'Airline Brands', 'Regular', 8),
('1', 'place4', 'Da Nang', 'INTERCONTINENTAL DANANG SUN PENINSULA RESORT', 0.00, '2024-04-14', '2024-04-21', 'Airline Brands', 'Regular', 0),
('1', 'place4', 'Da Nang', 'INTERCONTINENTAL DANANG SUN PENINSULA RESORT', 20000000.00, '2024-04-13', '2024-05-02', 'Airline Brands', 'Regular', 0),
('1', 'place1', 'Ha Noi', 'INTERCONTINENTAL HANOI WESTLAKE', 1000000.00, '2024-04-18', '2024-04-19', 'Airline Brands', 'Regular', 4),
('1', 'place4', 'Da Nang', 'INTERCONTINENTAL DANANG SUN PENINSULA RESORT', 20000000.00, '2024-04-10', '2024-04-20', 'Airline Brands', 'Regular', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `username` varchar(50) DEFAULT NULL,
  `placeID` varchar(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`username`, `placeID`, `content`) VALUES
('user1', 'place1', 'This place is amazing!'),
('user2', 'place1', 'I had a great time here.'),
('1', 'place1', 'aaaaaaaaa'),
('1', 'place4', 'Cung duoc '),
('1', 'place1', 'OKE');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotdeals`
--

CREATE TABLE `hotdeals` (
  `placeID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hotdeals`
--

INSERT INTO `hotdeals` (`placeID`) VALUES
('place1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `place`
--

CREATE TABLE `place` (
  `placeID` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `initPrice` decimal(10,2) DEFAULT NULL,
  `imgLink` varchar(255) DEFAULT NULL,
  `locationName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `place`
--

INSERT INTO `place` (`placeID`, `name`, `price`, `initPrice`, `imgLink`, `locationName`) VALUES
('place1', 'INTERCONTINENTAL HANOI WESTLAKE', 1200, 1500, 'assets/images/place1.jpg', 'Ha Noi'),
('place2', 'CROWNE PLAZA VINH YEN CITY CENTRE', 1500, 2000, 'assets/images/place2.jpg', 'Ha Noi'),
('place3', 'INTERCONTINENTAL HANOI LANDMARK72', 2200, 4000, 'assets/images/place3.jpg', 'Ha Noi'),
('place4', 'INTERCONTINENTAL DANANG SUN PENINSULA RESORT', 11000,150000, 'assets/images/place4.jpg', 'Da Nang'),
('place5', 'HANAMI HOTEL DANANG', 2500, 3500, 'assets/images/place5.jpg', 'Da Nang'),
('place6', 'ADINA HOTEL', 1000, 1200, 'assets/images/place6.jpg', 'Da Nang'),
('place7', 'INTERCONTINENTAL SAIGON', 6000, 11000, 'assets/images/place7.jpg', 'Ho Chi Minh City'),
('place8', 'HOTEL INDIGO SAIGON THE CITY', 8000, 12000, 'assets/images/place8.jpg', 'Ho Chi Minh City'),
('place9', 'GRAND LEE HOTEL', 1300, 1500, 'assets/images/place9.jpg', 'Ho Chi Minh City');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `planName` varchar(100) DEFAULT NULL,
  `checkInDate` date DEFAULT NULL,
  `checkOutDate` date DEFAULT NULL,
  `flight` varchar(100) DEFAULT NULL,
  `hotelName` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `phoneNumber`, `email`) VALUES
('1', '1', 'Pham Van Phuc', '8234235', 'phucpham.1803@gmail.com'),
('user1', 'password1', 'User One', '123456789', 'user1@example.com'),
('user2', 'password2', 'User Two', '987654321', 'user2@example.com'),
('user3', 'password3', 'User Three', '555555555', 'user3@example.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`account`);

--
-- Chỉ mục cho bảng `bookdetail`
--
ALTER TABLE `bookdetail`
  ADD KEY `username` (`username`),
  ADD KEY `placeID` (`placeID`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD KEY `username` (`username`),
  ADD KEY `placeID` (`placeID`);

--
-- Chỉ mục cho bảng `hotdeals`
--
ALTER TABLE `hotdeals`
  ADD KEY `placeID` (`placeID`);

--
-- Chỉ mục cho bảng `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`placeID`);

--
-- Chỉ mục cho bảng `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookdetail`
--
ALTER TABLE `bookdetail`
  ADD CONSTRAINT `bookdetail_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `bookdetail_ibfk_2` FOREIGN KEY (`placeID`) REFERENCES `place` (`placeID`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`placeID`) REFERENCES `place` (`placeID`);

--
-- Các ràng buộc cho bảng `hotdeals`
--
ALTER TABLE `hotdeals`
  ADD CONSTRAINT `hotdeals_ibfk_1` FOREIGN KEY (`placeID`) REFERENCES `place` (`placeID`);

--
-- Các ràng buộc cho bảng `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
