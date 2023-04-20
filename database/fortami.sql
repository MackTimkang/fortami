-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 06:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fortami`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address_type` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `full_name`, `address_type`, `contact`, `region`, `province`, `city`, `barangay`, `street`, `zip`, `label`, `note`) VALUES
(28, 36, 'Justin Eatery', 'Default', '09244466666', '7', 'Cebu', 'Cebu', 'Sambag 1', 'J. Alcantara St.', '6000', 'Home', 'Across Uc Pri Campus'),
(30, 35, 'Reymark Timkang', 'Default', '09123456789', '7', 'Cebu', 'Talisay', 'Linao', 'Maghaway St. , San Antonio', '6045', 'Home', 'Gray gate , not on a rush so take your time and ha'),
(31, 35, 'Reymark Timkang', 'Default', '09991551657', '7', 'Cebu', 'Cebu', 'N/A', 'University of Cebu Main Campus, Sanciangko St.', '6000', 'Work', 'Bilin lang sa guard, thank you.'),
(32, 37, 'Joseph Restaurant', 'Default', '09999988543', '7', 'Cebu', 'Cebu', 'N/A', 'P.del Rosario St.', '6000', 'Home', 'Beside ACT school'),
(34, 39, 'Romeo Food Hub', 'Default', '09994564213', '7', 'Cebu ', 'Cebu', 'N/A', 'Leon Kilat St.', '6000', 'Home', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Fast Food', 'Foods that takes lesser time to prepare.'),
(2, 'vegetables', 'Foods that are 100% organic and meat free.'),
(3, 'Baked', 'Foods that are baked'),
(4, 'Beverages', 'Drinks and more'),
(5, 'Seafood', 'Foods from the sea'),
(10, 'Liquor', 'Alcoholic Beverages'),
(11, 'Asian', 'Foods that originated in Asia');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(20) NOT NULL,
  `food_id` int(20) DEFAULT NULL,
  `address_id` int(20) NOT NULL,
  `payTrans_id` int(20) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `rating_status` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) NOT NULL,
  `order_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `received_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`order_id`, `food_id`, `address_id`, `payTrans_id`, `order_status`, `rating_status`, `quantity`, `order_datetime`, `received_datetime`) VALUES
(112, NULL, 30, 151, 'Received', 'Done', '1', '2023-04-17 04:13:03', '2023-04-17 11:56:59'),
(113, NULL, 30, 152, 'Received', 'Done', '1', '2023-04-17 07:22:13', '2023-04-17 15:21:55'),
(114, NULL, 30, 152, 'Received', 'Done', '2', '2023-04-17 07:22:21', '2023-04-17 15:21:55'),
(115, NULL, 30, 153, 'Received', 'Done', '1', '2023-04-17 07:23:33', '2023-04-17 15:23:19'),
(116, NULL, 30, 153, 'Received', 'Done', '2', '2023-04-17 07:24:05', '2023-04-17 15:23:19'),
(117, NULL, 30, 154, 'Received', 'Done', '1', '2023-04-17 09:14:04', '2023-04-17 17:13:38'),
(118, NULL, 30, 154, 'Received', 'Done', '1', '2023-04-17 09:14:20', '2023-04-17 17:13:38'),
(119, NULL, 30, 155, 'Received', 'Done', '1', '2023-04-17 10:27:45', '2023-04-17 18:27:31'),
(120, NULL, 30, 156, 'Cancelled', NULL, '1', '2023-04-17 12:38:57', NULL),
(121, NULL, 30, 157, 'Received', 'Done', '1', '2023-04-17 12:41:33', '2023-04-17 20:41:09'),
(122, NULL, 30, 158, 'Cancelled', NULL, '1', '2023-04-18 07:57:44', NULL),
(123, NULL, 30, 159, 'Cancelled', NULL, '1', '2023-04-18 08:03:06', NULL),
(124, NULL, 30, 160, 'Cancelled', NULL, '1', '2023-04-18 08:03:34', NULL),
(125, NULL, 30, 161, 'Cancelled', NULL, '1', '2023-04-18 08:05:10', NULL),
(126, NULL, 30, 162, 'Received', 'Done', '1', '2023-04-18 08:07:19', '2023-04-18 16:07:11'),
(127, NULL, 30, 163, 'Cancelled', NULL, '1', '2023-04-18 09:01:44', NULL),
(128, NULL, 30, 164, 'Cancelled', NULL, '1', '2023-04-18 09:02:39', NULL),
(129, NULL, 30, 165, 'Cancelled', NULL, '1', '2023-04-18 09:03:19', NULL),
(130, NULL, 30, 166, 'Received', 'Done', '1', '2023-04-18 09:04:37', '2023-04-18 17:04:26'),
(131, NULL, 30, 167, 'Received', 'Done', '2', '2023-04-18 09:41:51', '2023-04-18 17:41:39'),
(132, 90, 30, 168, 'Cancelled', NULL, '4', '2023-04-18 09:48:27', NULL),
(133, NULL, 30, 169, 'Cancelled', NULL, '2', '2023-04-18 09:48:31', NULL),
(134, 90, 30, 170, 'Received', 'Done', '1', '2023-04-18 09:50:50', '2023-04-18 17:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `food_product`
--

CREATE TABLE `food_product` (
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `category_id` int(20) NOT NULL,
  `food_pic` varchar(255) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_description` varchar(100) NOT NULL,
  `preparation` varchar(50) NOT NULL,
  `food_creation` datetime DEFAULT NULL,
  `food_discountedPrice` varchar(50) DEFAULT NULL,
  `food_origPrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_product`
--

INSERT INTO `food_product` (`food_id`, `user_id`, `category_id`, `food_pic`, `food_name`, `food_description`, `preparation`, `food_creation`, `food_discountedPrice`, `food_origPrice`) VALUES
(90, 36, 5, 'FORTAMI-643e5bfe2ac702.86181772.jpg', 'Caviar', 'Fresh luxurius caviar especially for you\r\n            ', 'Fresh', '2023-04-18 16:59:00', '1900', '2500'),
(92, 37, 1, 'FORTAMI-643eee3608bfa7.67794895.jpg', 'Lechon Manok', 'Pinoy style grilled chicken. Very juicy and yummy                \r\n            ', 'Fresh', '2023-04-19 08:23:00', '275', '300');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `receiver_id` int(20) NOT NULL,
  `content` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `msg_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `user_id`, `receiver_id`, `content`, `status`, `msg_datetime`) VALUES
(3, 35, 36, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem sequi sunt voluptatibus quo incidunt necessitatibus, provident dolorem in voluptatum repellat! Facere, ipsam minima impedit ad inven', 'Read', '2023-04-18 21:54:04'),
(4, 36, 35, 'Ha? Pagsure oi', 'Read', '2023-04-18 21:54:50'),
(5, 35, 36, 'Lage mao rana', 'Read', '2023-04-18 21:56:31'),
(6, 43, 36, 'Hi you are inactive, do you wish to continue selling?', 'Read', '2023-04-18 22:02:50'),
(7, 36, 43, 'Yes admin I would like to continue selling.', 'Read', '2023-04-18 22:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) NOT NULL,
  `user_id` int(20) NOT NULL,
  `notif_datetime` datetime NOT NULL,
  `notif_details` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `paymethod_id` int(20) NOT NULL,
  `paymethod_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`paymethod_id`, `paymethod_type`) VALUES
(1, 'Gcash'),
(2, 'Maya'),
(3, 'Coinsph'),
(4, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `payTrans_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `paymethod_id` int(20) NOT NULL,
  `pay_amount` varchar(50) NOT NULL,
  `delivery_option` varchar(20) NOT NULL,
  `trans_status` varchar(50) NOT NULL,
  `pay_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_transaction`
--

INSERT INTO `payment_transaction` (`payTrans_id`, `user_id`, `paymethod_id`, `pay_amount`, `delivery_option`, `trans_status`, `pay_datetime`) VALUES
(151, 35, 4, '350.00', 'Delivery', 'Successful', '2023-04-17 03:55:00'),
(152, 35, 4, '2,650.00', 'Pick-up', 'Successful', '2023-04-17 07:21:35'),
(153, 35, 4, '2,650.00', 'Delivery', 'Successful', '2023-04-17 07:22:48'),
(154, 35, 4, '258.00', 'Pick-up', 'Successful', '2023-04-17 09:12:09'),
(155, 35, 4, '59.00', 'Delivery', 'Successful', '2023-04-17 10:26:48'),
(156, 35, 4, '350.00', 'Delivery', 'Cancelled', '2023-04-17 12:38:42'),
(157, 35, 4, '59.00', 'Delivery', 'Successful', '2023-04-17 12:40:17'),
(158, 35, 4, '1,950.00', '', 'Cancelled', '2023-04-18 07:57:35'),
(159, 35, 4, '1,950.00', 'Delivery', 'Cancelled', '2023-04-18 08:03:03'),
(160, 35, 4, '1,950.00', 'Delivery', 'Cancelled', '2023-04-18 08:03:31'),
(161, 35, 4, '1,950.00', 'Delivery', 'Cancelled', '2023-04-18 08:05:08'),
(162, 35, 4, '1,950.00', 'Pick-up', 'Successful', '2023-04-18 08:05:27'),
(163, 35, 4, '59.00', '', 'Cancelled', '2023-04-18 09:01:39'),
(164, 35, 4, '59.00', '', 'Cancelled', '2023-04-18 09:02:37'),
(165, 35, 4, '59.00', 'Delivery', 'Cancelled', '2023-04-18 09:03:16'),
(166, 35, 4, '59.00', 'Pick-up', 'Successful', '2023-04-18 09:03:41'),
(167, 35, 4, '110.00', 'Delivery', 'Successful', '2023-04-18 09:41:24'),
(168, 35, 4, '7,600.00', 'Delivery', 'Cancelled', '2023-04-18 09:42:21'),
(169, 35, 4, '110.00', 'Delivery', 'Cancelled', '2023-04-18 09:42:47'),
(170, 35, 4, '1,900.00', 'Delivery', 'Successful', '2023-04-18 09:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `order_id`, `rating`, `comment`) VALUES
(6, 112, '4', 'Delicious'),
(7, 113, '4', 'Yummy'),
(8, 114, '5', 'Delicious'),
(9, 115, '5', '2nd time still yummy'),
(10, 116, '4', '2nd time very delicious'),
(11, 117, '3', 'VERY INIT'),
(12, 118, '5', 'VERY BUGNAW'),
(13, 119, '4', 'yummy'),
(14, 121, '4', 'Cold '),
(15, 126, '4', 'Wow'),
(16, 130, '3', 'Not cold anymore '),
(17, 131, '4', 'Very lami and healthy'),
(18, 134, '4', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_type` varchar(6) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `user_fName` varchar(50) NOT NULL,
  `user_lName` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_userName` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `tagline` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `profile_pic`, `user_fName`, `user_lName`, `user_email`, `user_userName`, `user_password`, `tagline`) VALUES
(35, 'Buyer', 'FORTAMI-643d60cb5a4912.19721463.jpg', 'Reymark', 'Timkang', 'reymark@gmail.com', 'reymark', '$2y$10$5Y844Z4VcjbQ0/AZyR.Ssuhw5GUtP9PV4hVQul6RL2IGvMRLVmtzm', NULL),
(36, 'Seller', 'FORTAMI-643c2332b597c5.64436764.jpg', 'Justin', 'Conje', 'justinconje@gmail.com', 'JustinEatery', '$2y$10$AmjTjdgItwp5buYug9O5OujaflmPqx79Ub7Q65WTjw21iPMPQ.sIa', NULL),
(37, 'Seller', 'FORTAMI-643d0b16de3775.33433947.jpg', 'Joseph', 'Banzon', 'joseph@gmail.com', 'Joseph Restaurant', '$2y$10$IJ/vWWD84ZQRiR3ojfnnWeAoV/XL79fqbwcli8Zqu5CEEr/pgVRm2', NULL),
(39, 'Seller', 'FORTAMI-643d102d3a84e1.80215800.jpg', 'Romeo', 'Chavez', 'romeo@gmail.com', 'Romeo Food Hub', '$2y$10$VMZtYxqdzlAvv20wn/ryPOeWMqvxrqOb2WFNzNE/3dmhSHmTMltM.', NULL),
(43, 'Admin', 'FORTAMI-643d8848154386.21430403.png', 'Fortami', 'Admin', 'timkang@gmail.com', 'Admin_Reymark', '$2y$10$X3eEtgUvjp/ANcl5PPbCdeD9Xe.KsqOXgCMa3c9y3yMyjBsetN/d.', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_fk_1` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`food_id`,`user_id`),
  ADD KEY `cart_ibfk_2` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `food_order_ibfk_1` (`payTrans_id`),
  ADD KEY `food_order_ibfk_3` (`address_id`),
  ADD KEY `food_order_ibfk_2` (`food_id`);

--
-- Indexes for table `food_product`
--
ALTER TABLE `food_product`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_product_ibfk_2` (`category_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymethod_id`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`payTrans_id`),
  ADD KEY `paymethod_id` (`paymethod_id`),
  ADD KEY `payment_transaction_ibfk_4` (`user_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `rating_ibfk_1` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `food_product`
--
ALTER TABLE `food_product`
  MODIFY `food_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymethod_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `payTrans_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_fk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `food_order_ibfk_1` FOREIGN KEY (`payTrans_id`) REFERENCES `payment_transaction` (`payTrans_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `food_order_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `food_order_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `food_product`
--
ALTER TABLE `food_product`
  ADD CONSTRAINT `food_product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD CONSTRAINT `payment_transaction_ibfk_1` FOREIGN KEY (`paymethod_id`) REFERENCES `payment_method` (`paymethod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment_transaction_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `food_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
