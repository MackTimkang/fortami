-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 03:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

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
  `note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `full_name`, `address_type`, `contact`, `region`, `province`, `city`, `barangay`, `street`, `zip`, `label`, `note`) VALUES
(16, 24, 'Reymark Timkang', 'Default', '1234567890', '8', 'Cebu', 'Central', 'Kuan', 'Eskina unahan, sa kuan ngadto, Room boy', '2023', 'Work', NULL),
(18, 24, 'Reymark Enot Timkang', 'Default', '09991551659', '7', 'Cebu', 'Talisay', 'Linao', 'Maghaway St., RMT Apartment, San Antonio', '6045', 'Home', NULL),
(19, 23, 'Justin Carenderia', 'Shop Address', '09789879877', '7', 'Cebu', 'Cebu', 'Kalubihan', 'Leon Kilat, Block 5 Lot 8', '6000', 'Pickup', 'Red theme store with a big tarpaulin in front'),
(20, 26, 'Romeo Chavez', 'Default', '09123456678', '7', 'Bantayan', 'Cebu City', 'Subangdako', 'Sanciangko St, Cebu City, 6000 Cebu', '6014', 'Home', 'ASAP');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`food_id`, `user_id`, `quantity`) VALUES
(66, 26, '1'),
(67, 26, '1'),
(68, 26, '1'),
(73, 26, '1'),
(74, 26, '1');

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
(4, 'Beverages', 'Drinks and more');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(20) NOT NULL,
  `food_id` int(20) NOT NULL,
  `address_id` int(20) NOT NULL,
  `payTrans_id` int(20) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `order_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `received_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`order_id`, `food_id`, `address_id`, `payTrans_id`, `order_status`, `quantity`, `order_datetime`, `received_datetime`) VALUES
(71, 67, 18, 116, 'Received', '2', '2023-03-23 01:02:37', '2023-03-23 09:02:36');

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
(66, 23, 1, 'american.jpg', 'Big Burger in Cebu', 'The famous BBC is here! Order now                \r\n            ', 'Made to order', '0000-00-00 00:00:00', '299', '350'),
(67, 23, 3, 'baked.jpg', 'Toasted Bread', 'Butter toasted bread so yummy                \r\n            ', 'Surplus', '2023-03-18 11:31:00', '99', '199'),
(68, 23, 1, 'Filipino.webp', 'Sisig', 'Pinoy style yummy sisig                \r\n            ', 'Made to order', '0000-00-00 00:00:00', '150', '200'),
(69, 25, 1, 'Bulalo-Ramen.jpg', 'Bulalo Ramen', '    Bulaloo            \r\n            ', 'Made to order', '2023-03-23 09:44:00', '50', '200'),
(73, 29, 1, 'pancit-bihon.jpg', 'Pancit Bihon', '                Pancit Bihon\r\n            ', 'Fresh', '2023-03-23 22:25:00', '50', '100'),
(74, 27, 4, 'flave_beer.jpg', 'Flavored Beer (Apple)', '        Flavored Beer for all but not for kids        \r\n            ', 'Fresh', '2023-03-23 22:27:00', '12', '42');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `msg_senderID` int(20) NOT NULL,
  `msg_receiverID` int(20) NOT NULL,
  `msg_content` varchar(200) NOT NULL,
  `msg_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Paypal'),
(2, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `payTrans_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `paymethod_id` int(20) NOT NULL,
  `pay_amount` varchar(50) NOT NULL,
  `trans_status` varchar(50) NOT NULL,
  `pay_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_transaction`
--

INSERT INTO `payment_transaction` (`payTrans_id`, `user_id`, `paymethod_id`, `pay_amount`, `trans_status`, `pay_datetime`) VALUES
(116, 24, 2, '198.00', 'Successful', '2023-03-23 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_type` varchar(6) NOT NULL,
  `profile_pic` varchar(50) DEFAULT NULL,
  `user_fName` varchar(50) NOT NULL,
  `user_lName` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_userName` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `profile_pic`, `user_fName`, `user_lName`, `user_email`, `user_userName`, `user_password`) VALUES
(23, 'Seller', NULL, 'Justin', 'Conje', 'justinconje@gmail.com', 'justin', '$2y$10$nnEhDBl.o8B9zfqvKCX5DuCqIIwRNsXNRuLltO7gtrrhrU2HAGl.q'),
(24, 'Buyer', NULL, 'Reymark', 'Timkang', 'reymarktimkang@gmail.com', 'reymark', '$2y$10$HQVqV20viq0Qa8ftXxuHTu/aitkI90/JS2rvzT8qjJE1tP7548fSu'),
(25, 'Seller', NULL, 'Joseph', 'Banzon', 'joseph.banzon15@gmail.com', 'joseph', '$2y$10$NqCUeC9A4YZkiLuSUJj2LOz3ZdoymdhN77tY.1srOfZED5JQws77q'),
(26, 'Buyer', NULL, 'Romeo', 'Chavez', 'romeochavez@gmail.com', 'meo', '$2y$10$.rf9naUO2ZIUVIyeub.84.AuZAAaLPyMYpjYECqKsuJaISUwMik5m'),
(27, 'Seller', NULL, 'Jude', 'Banggabangga', 'judebanggabangga@gmail.com', 'jude', '$2y$10$Id03WiV6c6JPTorItld1AO2cKPl71uxZOZSZsI4q6ADcZMbOj6V/W'),
(29, 'Seller', NULL, 'Jerson', 'Aurelio', 'jersonaurelio@gmail.com', 'jerson', '$2y$10$XznSDNCIOKkENVmpRm94/eY35n8tIXU2ZHwZq4qy6cY0Pw9fkGvXC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_ibfk_1` (`user_id`);

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
  ADD KEY `food_order_ibfk_2` (`food_id`),
  ADD KEY `food_order_ibfk_4` (`address_id`),
  ADD KEY `food_order_ibfk_1` (`payTrans_id`);

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
  MODIFY `address_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `food_product`
--
ALTER TABLE `food_product`
  MODIFY `food_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymethod_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `payTrans_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `food_order_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `food_order_ibfk_4` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
