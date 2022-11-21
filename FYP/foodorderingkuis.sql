-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2022 at 01:17 PM
-- Server version: 8.0.25
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodorderingkuis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cafe`
--

CREATE TABLE `cafe` (
  `user` varchar(255) NOT NULL,
  `cafename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cafe`
--

INSERT INTO `cafe` (`user`, `cafename`) VALUES
('cafesaiditinakhadijah', 'cafe saiditina khadijah'),
('cuppa365', 'cuppa365'),
('firstcafe', 'first cafe');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`order_id`, `user_id`, `name`, `image`, `quantity`, `price`, `total`, `date`, `time`, `order_date`, `order_time`, `status`, `user`) VALUES
(75, 18, 'Teh Tarik', 'tehtarik.jpg', 2, 1.5, 3, '2022-11-05', '08:50:00', '2022-11-05', '08:40', 'completed', 'cafesaiditinakhadijah'),
(77, 26, 'Tom Yum Fried Rice', 'tom yum fried rice.jpg', 1, 5.5, 5.5, '2022-11-07', '09:58:00', '2022-11-07', '09:49', 'accepted', 'cafesaiditinakhadijah');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `user`) VALUES
(15, 'Chinese Fried Rice', 5, 'chinese fried rice.jpg', 'cafesaiditinakhadijah'),
(16, 'Omelet fried rice', 6, 'omelet fried rice.jpg', 'cafesaiditinakhadijah'),
(17, 'Tom Yum', 5, 'tom-yum.jpg', 'cafesaiditinakhadijah'),
(18, 'Tom Yum Fried Rice', 5.5, 'tom yum fried rice.jpg', 'cafesaiditinakhadijah'),
(19, 'Chicken Fried Rice', 5, 'chicken fried rice.jpg', 'cafesaiditinakhadijah'),
(21, 'Caffe Latte', 8, 'caffe-latte.jpg', 'cuppa365'),
(22, 'Caffe Mocha', 8, 'caffe_mocha.jpg', 'cuppa365'),
(23, 'Caffe Americano', 4, 'caffe-americano.jpg', 'cuppa365'),
(25, 'Nasi Goreng Cina', 5, 'nasi goreng cina.jpg', 'firstcafe'),
(26, 'Nasi Ayam Penyet', 5, 'nasiayampenyet.jpeg', 'cafesaiditinakhadijah'),
(27, 'Teh Tarik', 1.5, 'tehtarik.jpg', 'cafesaiditinakhadijah'),
(28, 'Limau Ais', 1.5, 'limau ais.jpg', 'cafesaiditinakhadijah'),
(30, 'Milo Ais', 2.5, 'Ice-Milo.jpg', 'cafesaiditinakhadijah'),
(31, 'Green Tea Latte', 2.5, 'greentea-latte.jpg', 'cafesaiditinakhadijah'),
(32, 'Asian Dolce Latte', 18, 'adl.jpg', 'cuppa365');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(18, '2039035@student.kuis.edu.my', 'hazman', '20e195673f02a0b0ad4a496a1587d54f', 'customer'),
(20, '2039031@student.kuis.edu.my', 'muiz', '759efe7c12a32c8658c9bcaf0a4ea3c8', 'customer'),
(22, 'cafesaiditinakhadijah@gmail.com', 'cafesaiditinakhadijah', '097d5bc636c44254f5f949248dce8a8f', 'cafe_owner'),
(23, 'cuppa365@gmail.com', 'cuppa365', 'fe877fabd2e86ec4325eadbbf228ed88', 'cafe_owner'),
(24, '2039029@student.kuis.edu.my', 'sufi', '68f64946f7044d4af59b3654e25a036f', 'customer'),
(25, 'firstcafe@gmail.com', 'firstcafe', '82ee5e4d279aefb676e015fbecfb228a', 'cafe_owner'),
(26, '2039016@student.kuis.edu.my', 'ali', '86318e52f5ed4801abe1d13d509443de', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cafe`
--
ALTER TABLE `cafe`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user`) REFERENCES `cafe` (`user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orderlist_ibfk_2` FOREIGN KEY (`user`) REFERENCES `cafe` (`user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user`) REFERENCES `cafe` (`user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
