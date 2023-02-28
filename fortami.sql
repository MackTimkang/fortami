-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 04:44 PM
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
(2, 'vegetables', 'Foods that are 100% organic and meat free.');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(20) NOT NULL,
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `offer_id` int(20) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `order_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_product`
--

CREATE TABLE `food_product` (
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `category_id` int(20) NOT NULL,
  `food_pic` longblob NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_description` varchar(100) NOT NULL,
  `food_creation` datetime NOT NULL,
  `food_discountedPrice` varchar(50) NOT NULL,
  `food_origPrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_product`
--

INSERT INTO `food_product` (`food_id`, `user_id`, `category_id`, `food_pic`, `food_name`, `food_description`, `food_creation`, `food_discountedPrice`, `food_origPrice`) VALUES
(26, 20, 1, 0x616d65726963616e2e6a7067, 'Burger', 'Famous BBC (Big Burger in Cebu)', '2023-02-21 23:10:00', '580', '980'),
(27, 20, 1, 0x6d696c6b7465612e6a7067, 'Milktea', 'Beat The Heat with Milktea sa Tag-init', '2023-02-21 23:11:00', '110', '250'),
(28, 20, 1, 0x70697a7a612e6a7067, 'Pizza', 'Hawaiian Pizza with a hint of vanilla extract and cheddar cheese', '2023-02-21 23:12:00', '210', '530'),
(29, 20, 1, 0x6a6170616e65736520646973682e6a7067, 'Sushi', 'Very fresh and yummy sushi ni Tami', '2023-02-21 23:13:00', '500', '950'),
(30, 20, 1, 0x46696c6970696e6f2e77656270, 'Sisig', 'Sisig very yami my Tami', '2023-02-21 23:15:00', '150', '200'),
(31, 20, 1, 0x6974616c69616e2e6a7067, 'Lasagna', 'Fresh from Italy', '2023-02-17 23:17:00', '3000', '5000');

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
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offer_id` int(20) NOT NULL,
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `offer_datetime` datetime NOT NULL,
  `offer_details` varchar(50) NOT NULL,
  `offer_price` varchar(50) NOT NULL,
  `offer_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `paymethod_id` int(20) NOT NULL,
  `paymethod_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `payTrans_id` int(20) NOT NULL,
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `paymethod_id` int(20) NOT NULL,
  `pay_amount` int(12) NOT NULL,
  `trans_status` varchar(50) NOT NULL,
  `pay_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(20) NOT NULL,
  `payTrans_id` int(20) NOT NULL,
  `pay_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `trans_his` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `payTrans_id` int(20) NOT NULL,
  `receipt_id` int(20) NOT NULL,
  `trans_description` varchar(50) NOT NULL,
  `trans_price` varchar(50) NOT NULL,
  `trans_datetime` datetime NOT NULL,
  `trans_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_type` varchar(6) NOT NULL,
  `user_fName` varchar(50) NOT NULL,
  `user_lName` varchar(50) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_number` int(15) NOT NULL,
  `user_userName` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `user_fName`, `user_lName`, `user_address`, `user_email`, `user_number`, `user_userName`, `user_password`) VALUES
(19, 'Buyer', 'Mack', 'Timkang', 'wala ko kahibalo', 'macktimkang@gmail.com', 123456789, 'Mack', '$2y$10$P4lRaqk9IVlUkxrT0QidounaKFfHB6INTNAqRuRvW5DhKC1OFJ6D6'),
(20, 'Seller', 'Justin', 'Conje', 'Cebu', 'justinconje@gmail.com', 123456789, 'justin', '$2y$10$ky0qqWkWt.5UF7UEZ2itJe4DSMsqqLa4mzHaHlWAymjjMdSlJIEe2');

--
-- Indexes for dumped tables
--

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
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_order_ibfk_5` (`food_id`);

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
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `offer_ibfk_4` (`food_id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_transaction_ibfk_4` (`food_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `receipt_ibfk_1` (`payTrans_id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`trans_his`),
  ADD KEY `payTrans_id` (`payTrans_id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_product`
--
ALTER TABLE `food_product`
  MODIFY `food_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offer_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymethod_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `payTrans_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `trans_his` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `food_order_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_order_ibfk_5` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_order_ibfk_6` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`offer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_ibfk_4` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD CONSTRAINT `payment_transaction_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_transaction_ibfk_4` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_transaction_ibfk_5` FOREIGN KEY (`paymethod_id`) REFERENCES `payment_method` (`paymethod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`payTrans_id`) REFERENCES `payment_transaction` (`payTrans_id`);

--
-- Constraints for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD CONSTRAINT `transaction_history_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_history_ibfk_6` FOREIGN KEY (`payTrans_id`) REFERENCES `payment_transaction` (`payTrans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_history_ibfk_7` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`receipt_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
