-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 12:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `com_p`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `d_id` int(3) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Price` varchar(20) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Photoes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`d_id`, `Name`, `Price`, `Description`, `Photoes`) VALUES
(23, 'iphone', '300', 'good', 'pexels-kevin-ku-577585.jpg'),
(24, 'Samsung S23 Ultra', '400', 'X100 Zoom', 'images (4).jpeg'),
(25, 'Samsung S24 Ultra', '450', 'X100 Zoom valuable', 'Samsung-Galaxy-S24-Ultra-2.jpg'),
(26, 'Samsung S24 Ultra', '450', 'X100 Zoom valuable', 'Samsung-Galaxy-S24-Ultra-2.jpg'),
(27, 'Samsung S24 Ultra', '450', 'X100 Zoom valuable', 'Samsung-Galaxy-S24-Ultra-2.jpg'),
(28, 'Samsung S24 Ultra', '450', 'X100 Zoom valuable', 'Samsung-Galaxy-S24-Ultra-2.jpg'),
(29, 'iphone', '500', 'thy\r\njytj', 'milano-duomodimilano01 - Copy.jpg'),
(30, 'iphone', '500', 'thy\r\njytj', 'milano-duomodimilano01 - Copy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(3) NOT NULL,
  `d_id` int(3) NOT NULL,
  `date` datetime NOT NULL,
  `quantity` int(3) NOT NULL,
  `id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `d_id`, `date`, `quantity`, `id`) VALUES
(4, 23, '2024-04-08 15:12:41', 1, 0),
(5, 23, '2024-04-08 15:21:30', 1, 0),
(6, 23, '2024-04-08 15:21:34', 1, 0),
(7, 23, '2024-04-08 15:23:15', 1, 0),
(8, 23, '2024-04-08 15:24:38', 1, 0),
(9, 23, '2024-04-08 15:26:14', 1, 9),
(10, 23, '2024-04-08 15:26:16', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE `shop_details` (
  `s_id` int(3) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `d_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`s_id`, `name`, `location`, `d_id`) VALUES
(1, 'hello', 'kahatowita', 23),
(2, 'hello', 'kahatowita', 23);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cpassword` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `email`, `password`, `cpassword`, `user_type`) VALUES
(7, 'Faham Fahim', 'fzfahim19@gmail.com', 'asdfg131', '', 'manager'),
(8, 'Faham Fahim', 'as@gmail.com', 'asdfg131', '', 'director'),
(9, 'cas', 'cas@gmail.com', 'asdfg131', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `d_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_details`
--
ALTER TABLE `shop_details`
  MODIFY `s_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `devices` (`d_id`);

--
-- Constraints for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD CONSTRAINT `shop_details_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `devices` (`d_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
