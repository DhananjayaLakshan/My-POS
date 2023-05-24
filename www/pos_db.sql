-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 06:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `barcode` varchar(128) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `image` varchar(500) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `user_id` varchar(128) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `description`, `barcode`, `qty`, `amount`, `image`, `views`, `user_id`, `date`) VALUES
(2, 'sprite', '2222515343176', 12, '120.00', 'uploads/9415ef4fb6c69a4b7f15c933e8aaf08737db6e01_8420.jpeg', 10, '1', '2023-01-13 06:46:30'),
(4, 'Oreo', '222227585631', 350, '1250.00', 'uploads/b2249646d6e12f482fad3ed5f96ffcb9b3fab516_6055.jpg', 2, '1', '2023-01-13 06:49:45'),
(5, 'Ambewela Milk', '2222109121956', 500, '2500.00', 'uploads/ace69244df9d0b76b2ab20a6542b3139618e842d_3435.jpg', 22, '1', '2023-01-13 06:51:14'),
(6, 'lemon', '2222429843614', 12, '120.00', 'uploads/be8389cabeeeb78080e6f607c7bc38e1f51a372c_7844.png', 26, 'Unknown', '2023-01-14 18:58:08'),
(7, 'Dr Papper', '2222330653548', 120, '100.00', 'uploads/cdd82a5b3d7d75852be59a1d863cb0a025d42f9d_9455.jpg', 23, 'Unknown', '2023-01-16 15:58:30'),
(8, 'Coca Cola', '2222568944808', 500, '200.00', 'uploads/039805bf72aae7ba11fb4af554eb3a7dad0eca3a_1900.jpg', 2, '1', '2023-01-25 16:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `description` varchar(60) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `barcode`, `receipt_no`, `description`, `qty`, `amount`, `total`, `date`, `user_id`) VALUES
(1, '2222429843614', 1, 'lemon', 1, '120.00', '120.00', '2023-01-18 08:31:53', 'Unknown'),
(2, '2222109121956', 1, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-18 08:31:53', 'Unknown'),
(3, '2222429843614', 2, 'lemon', 2, '120.00', '240.00', '2023-01-18 08:33:23', 'Unknown'),
(4, '2222109121956', 2, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-18 08:33:23', 'Unknown'),
(5, '222227585631', 2, 'Oreo', 1, '1250.00', '1250.00', '2023-01-18 08:33:23', 'Unknown'),
(6, '2222109121956', 3, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-19 08:14:49', '1'),
(7, '2222429843614', 3, 'lemon', 2, '120.00', '240.00', '2023-01-19 08:14:49', '1'),
(8, '2222109121956', 4, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-19 15:50:37', '1'),
(9, '2222330653548', 4, 'Dr Papper', 1, '100.00', '100.00', '2023-01-19 15:50:37', '1'),
(10, '2222515343176', 4, 'sprite', 1, '120.00', '120.00', '2023-01-19 15:50:37', '1'),
(11, '222227585631', 4, 'Oreo', 4, '1250.00', '5000.00', '2023-01-19 15:50:37', '1'),
(12, '2222330653548', 5, 'Dr Papper', 2, '100.00', '200.00', '2023-01-20 16:17:14', '1'),
(13, '2222109121956', 6, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-20 16:57:09', '1'),
(14, '2222429843614', 7, 'lemon', 1, '120.00', '120.00', '2023-01-20 16:58:56', '1'),
(15, '2222429843614', 8, 'lemon', 2, '120.00', '240.00', '2023-01-20 17:01:08', '1'),
(16, '2222429843614', 9, 'lemon', 1, '120.00', '120.00', '2023-01-20 17:01:45', '1'),
(17, '2222330653548', 10, 'Dr Papper', 1, '100.00', '100.00', '2023-01-20 17:07:47', '1'),
(18, '2222330653548', 11, 'Dr Papper', 1, '100.00', '100.00', '2023-01-20 17:07:53', '1'),
(19, '2222330653548', 12, 'Dr Papper', 1, '100.00', '100.00', '2023-01-20 17:07:59', '1'),
(20, '2222109121956', 13, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-20 17:09:40', '1'),
(21, '2222109121956', 14, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-20 17:09:56', '1'),
(24, '2222429843614', 15, 'lemon', 1, '120.00', '120.00', '2023-01-22 19:21:41', '1'),
(25, '2222515343176', 16, 'sprite', 1, '120.00', '120.00', '2023-01-24 15:37:45', '1'),
(26, '2222406499975', 16, 'Pepci', 1, '1220.00', '1220.00', '2023-01-24 15:37:45', '1'),
(27, '2222330653548', 16, 'Dr Papper', 1, '100.00', '100.00', '2023-01-24 15:37:45', '1'),
(28, '2222109121956', 17, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-24 16:14:36', '1'),
(29, '2222330653548', 18, 'Dr Papper', 1, '100.00', '100.00', '2023-01-24 16:15:14', '1'),
(30, '2222109121956', 19, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-24 18:06:09', '1'),
(31, '2222330653548', 20, 'Dr Papper', 1, '100.00', '100.00', '2023-01-24 19:08:09', '1'),
(32, '2222515343176', 21, 'sprite', 1, '120.00', '120.00', '2023-01-25 06:45:03', '1'),
(33, '2222109121956', 22, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 06:59:37', '1'),
(34, '2222429843614', 22, 'lemon', 1, '120.00', '120.00', '2023-01-25 06:59:37', '1'),
(35, '2222429843614', 23, 'lemon', 1, '120.00', '120.00', '2023-01-25 07:08:33', '1'),
(36, '2222109121956', 23, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 07:08:33', '1'),
(37, '2222429843614', 24, 'lemon', 1, '120.00', '120.00', '2023-01-25 07:09:27', '1'),
(38, '2222330653548', 24, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 07:09:27', '1'),
(39, '2222515343176', 25, 'sprite', 1, '120.00', '120.00', '2023-01-25 08:29:38', '1'),
(40, '2222429843614', 25, 'lemon', 1, '120.00', '120.00', '2023-01-25 08:29:38', '1'),
(41, '2222515343176', 26, 'sprite', 2, '120.00', '240.00', '2023-01-25 08:30:10', '1'),
(42, '2222429843614', 26, 'lemon', 2, '120.00', '240.00', '2023-01-25 08:30:10', '1'),
(43, '2222330653548', 27, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 08:30:53', '1'),
(44, '2222109121956', 27, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:30:53', '1'),
(45, '2222109121956', 28, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:31:18', '1'),
(46, '2222515343176', 29, 'sprite', 1, '120.00', '120.00', '2023-01-25 08:31:36', '1'),
(47, '222227585631', 30, 'Oreo', 1, '1250.00', '1250.00', '2023-01-25 08:31:54', '1'),
(48, '2222330653548', 31, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 08:32:15', '1'),
(49, '2222109121956', 32, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:32:46', '1'),
(50, '2222429843614', 33, 'lemon', 3, '120.00', '360.00', '2023-01-25 08:41:30', '1'),
(51, '2222330653548', 33, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 08:41:30', '1'),
(52, '2222429843614', 34, 'lemon', 1, '120.00', '120.00', '2023-01-25 08:45:47', '1'),
(53, '2222109121956', 34, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:45:47', '1'),
(54, '2222330653548', 35, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 08:48:57', '1'),
(55, '2222429843614', 36, 'lemon', 1, '120.00', '120.00', '2023-01-25 08:49:25', '1'),
(56, '2222109121956', 36, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:49:25', '1'),
(57, '2222109121956', 37, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:50:46', '1'),
(58, '2222406499975', 37, 'Pepci', 1, '1220.00', '1220.00', '2023-01-25 08:50:46', '1'),
(59, '2222109121956', 38, 'Ambewela Milk', 2, '2500.00', '5000.00', '2023-01-25 08:52:16', '1'),
(60, '2222515343176', 39, 'sprite', 1, '120.00', '120.00', '2023-01-25 08:53:17', '1'),
(61, '2222429843614', 39, 'lemon', 1, '120.00', '120.00', '2023-01-25 08:53:17', '1'),
(62, '2222429843614', 40, 'lemon', 1, '120.00', '120.00', '2023-01-25 08:55:33', '1'),
(63, '2222330653548', 40, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 08:55:33', '1'),
(64, '2222109121956', 41, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 08:58:15', '1'),
(65, '2222406499975', 42, 'Pepci', 1, '1220.00', '1220.00', '2023-01-25 08:58:50', '1'),
(66, '222227585631', 42, 'Oreo', 1, '1250.00', '1250.00', '2023-01-25 08:58:50', '1'),
(67, '2222109121956', 43, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 09:01:05', '1'),
(68, '2222429843614', 43, 'lemon', 1, '120.00', '120.00', '2023-01-25 09:01:05', '1'),
(69, '2222330653548', 44, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 09:03:00', '1'),
(70, '2222429843614', 44, 'lemon', 1, '120.00', '120.00', '2023-01-25 09:03:00', '1'),
(71, '2222429843614', 45, 'lemon', 1, '120.00', '120.00', '2023-01-25 09:34:26', '1'),
(72, '2222330653548', 45, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 09:34:26', '1'),
(73, '2222429843614', 46, 'lemon', 1, '120.00', '120.00', '2023-01-25 09:36:31', '1'),
(74, '2222330653548', 46, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 09:36:31', '1'),
(75, '2222109121956', 47, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 09:38:01', '1'),
(76, '2222330653548', 47, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 09:38:01', '1'),
(77, '2222109121956', 48, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 09:40:37', '1'),
(78, '2222406499975', 48, 'Pepci', 1, '1220.00', '1220.00', '2023-01-25 09:40:37', '1'),
(79, '2222429843614', 49, 'lemon', 1, '120.00', '120.00', '2023-01-25 16:45:13', '1'),
(80, '2222109121956', 49, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 16:45:13', '1'),
(81, '2222429843614', 50, 'lemon', 1, '120.00', '120.00', '2023-01-25 16:46:25', '1'),
(82, '2222330653548', 50, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 16:46:25', '1'),
(83, '2222515343176', 51, 'sprite', 1, '120.00', '120.00', '2023-01-25 16:46:43', '1'),
(84, '2222330653548', 51, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 16:46:43', '1'),
(85, '2222515343176', 52, 'sprite', 1, '120.00', '120.00', '2023-01-25 16:47:00', '1'),
(86, '2222330653548', 52, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 16:47:00', '1'),
(87, '2222109121956', 53, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 17:47:21', '1'),
(88, '2222429843614', 53, 'lemon', 1, '120.00', '120.00', '2023-01-25 17:47:21', '1'),
(89, '2222109121956', 54, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 17:53:02', '1'),
(90, '2222429843614', 54, 'lemon', 1, '120.00', '120.00', '2023-01-25 17:53:02', '1'),
(91, '2222515343176', 55, 'sprite', 1, '120.00', '120.00', '2023-01-25 17:53:23', '1'),
(92, '2222429843614', 56, 'lemon', 1, '120.00', '120.00', '2023-01-25 17:56:50', '1'),
(93, '2222330653548', 56, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 17:56:50', '1'),
(94, '2222515343176', 56, 'sprite', 1, '120.00', '120.00', '2023-01-25 17:56:50', '1'),
(95, '2222429843614', 57, 'lemon', 1, '120.00', '120.00', '2023-01-25 17:57:23', '1'),
(96, '2222429843614', 58, 'lemon', 1, '120.00', '120.00', '2023-01-25 17:58:44', '1'),
(97, '2222109121956', 58, 'Ambewela Milk', 1, '2500.00', '2500.00', '2023-01-25 17:58:44', '1'),
(98, '2222568944808', 59, 'Coca Cola', 1, '200.00', '200.00', '2023-01-25 17:59:40', '1'),
(99, '2222568944808', 60, 'Coca Cola', 1, '200.00', '200.00', '2023-01-25 18:00:06', '1'),
(100, '2222429843614', 61, 'lemon', 1, '120.00', '120.00', '2023-01-25 18:00:43', '1'),
(101, '2222330653548', 62, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 18:03:36', '1'),
(102, '2222429843614', 63, 'lemon', 1, '120.00', '120.00', '2023-01-25 18:04:22', '1'),
(103, '2222330653548', 64, 'Dr Papper', 1, '100.00', '100.00', '2023-01-25 17:10:46', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(128) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(128) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'male',
  `deletable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `date`, `image`, `gender`, `deletable`) VALUES
(1, 'Dhananjaya', 'admin@gmail.com', '$2y$10$LzoItX/WLXiDWmASRVIaje7fxCgBFicK6x26iJtPoIGRzNK/.rAd6', 'admin', '2023-01-13 06:19:00', 'uploads/eee90aab9f411f2d317ad8f9a8dbf89863142977_6064.jpg', 'male', 0),
(2, 'Shannel', 'shannel@gmail.com', '$2y$10$0ylCFkyMJeCXT11en2c5keh8WRmnECA0IIZj8PM4mq4/qtdlqXrqi', 'cashier', '2023-01-19 15:09:59', '', 'female', 1),
(4, 'dhananjayalak', 'laki.dhana12@gmail.com', '$2y$10$YkQOjIx0xE/FuX/sDx/Df.IPedpIG/8CpCBc6cjWH0lK/E6.BHfMK', 'user', '2023-01-19 20:32:15', '', 'male', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `receipt_no` (`receipt_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;