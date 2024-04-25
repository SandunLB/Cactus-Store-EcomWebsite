-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 03:00 PM
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
-- Database: `cactus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'nethmi', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Sandun', 'sandunlb2001@gmail.com', 'I love Your Cactus', '2024-04-20 17:01:30'),
(2, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:02:39'),
(3, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:03:08'),
(4, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:03:17'),
(5, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:03:30'),
(6, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:03:34'),
(7, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:04:18'),
(8, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:04:52'),
(9, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:05:57'),
(10, 'dfs', 'sandunlb2001@gmail.com', 'asd', '2024-04-25 09:06:22'),
(11, 'Sandun Lakshitha', 'sandunlb2001@gmail.com', 'dsfsdfsd', '2024-04-25 09:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `paypal_email` varchar(100) DEFAULT NULL,
  `bank_details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `payment_method`, `card_number`, `expiry`, `cvv`, `paypal_email`, `bank_details`, `created_at`, `total_price`) VALUES
(1, '', '', '', '', '', '', '', '', '', '2024-04-17 05:00:06', 0.00),
(2, '', '', '', '', '', '', '', '', '', '2024-04-17 05:00:48', 0.00),
(3, '', '', '', '', '', '', '', '', '', '2024-04-17 05:00:49', 0.00),
(4, 'efdsf', 'sdfsd@1212.fdg', '3242323', 'paypal', '', '', '', 'sdsd@121.dfd', '', '2024-04-17 05:06:41', 0.00),
(5, 'efdsf', 'sdfsd@1212.fdg', '3242323', 'paypal', '', '', '', 'sdsd@121.dfd', '', '2024-04-17 05:08:01', 0.00),
(6, 'efdsf', 'sdfsd@1212.fdg', '3242323', 'paypal', '', '', '', 'sdsd@121.dfd', '', '2024-04-17 05:08:10', 0.00),
(7, 'sdfsdf', 'sandunlb2001@gmail.com', '2323', 'credit_card', 'sddf', 'sdfsd', 'fdsf', '', '', '2024-04-25 08:42:27', 0.00),
(8, 'sdf', 'sdf@fgd.sdf', 'sdf', 'bank_transfer', '', '', '', '', 'sdfsdf', '2024-04-25 08:54:54', 0.00),
(9, 'pakaya rajapaksha', 'pakaya@gmail.com', '10101010', 'credit_card', '3434', '324234', '2342', '', '', '2024-04-25 09:17:31', 0.00),
(10, 'dsfdsf', 'sdf@fgd.sdf', 'sdf', 'credit_card', 'sdfsd', 'fsdfsd', 'f', '', '', '2024-04-25 09:21:07', 0.00),
(11, 'dsfdsf', 'sdf@fgd.sdf', 'sdf', 'credit_card', 'sdfsd', 'fsdfsd', 'f', '', '', '2024-04-25 09:21:50', 0.00),
(12, 'dsfdsf', 'sdf@fgd.sdf', 'sdf', 'credit_card', 'sdfsd', 'fsdfsd', 'f', '', '', '2024-04-25 09:21:56', 0.00),
(13, 'dsfdsf', 'sdf@fgd.sdf', 'sdf', 'credit_card', 'sdfsd', 'fsdfsd', 'f', '', '', '2024-04-25 09:23:23', 0.00),
(14, 'dsfdsf', 'sdf@fgd.sdf', 'sdf', 'credit_card', 'sdfsd', 'fsdfsd', 'f', '', '', '2024-04-25 09:23:30', 0.00),
(15, 'sdfsdf', 'sandunlb2001@gmail.com', 'sdfsd', 'paypal', '', '', '', 'sandunlb2001@gmail.com', '', '2024-04-25 09:23:45', 0.00),
(16, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'bank_transfer', '', '', '', '', 'sdf', '2024-04-25 09:25:32', 0.00),
(17, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'bank_transfer', '', '', '', '', 'sdf', '2024-04-25 09:25:43', 0.00),
(18, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'bank_transfer', '', '', '', '', 'sd', '2024-04-25 10:18:21', 0.00),
(19, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'paypal', '', '', '', 'sandunlb20021@gmail.com', '', '2024-04-25 10:19:02', 0.00),
(20, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'bank_transfer', '', '', '', '', 'sdf', '2024-04-25 10:20:17', 0.00),
(21, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'paypal', '', '', '', 'sandunlb2077@gmail.com', '', '2024-04-25 10:21:39', 0.00),
(22, 'sdfsdf', 'sandunlb2001@gmail.com', '1212', 'bank_transfer', '', '', '', '', 'asd', '2024-04-25 10:22:41', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_item` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(25, 'Cactus 1', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 1000.00, '../uploads/661f60bca915c.jpg', '2024-04-17 05:40:12', '2024-04-17 05:40:12'),
(26, 'Cactus 2', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 1500.00, '../uploads/661f611090a07.jpg', '2024-04-17 05:41:36', '2024-04-17 05:41:36'),
(27, 'Cactus 3 ', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 2000.00, '../uploads/661f614429be8.jpg', '2024-04-17 05:42:28', '2024-04-17 05:42:28'),
(28, 'Cactus 4', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 1600.00, '../uploads/661f615184631.jpg', '2024-04-17 05:42:41', '2024-04-17 05:42:41'),
(29, 'Cactus 5', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 7000.00, '../uploads/661f615b3b7bd.jpg', '2024-04-17 05:42:51', '2024-04-17 05:42:51'),
(31, 'Cactus 6', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 6000.00, '../uploads/661f61705413f.jpg', '2024-04-17 05:43:12', '2024-04-17 05:43:12'),
(32, 'Cactus 7', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 10000.00, '../uploads/661f617b13307.jpg', '2024-04-17 05:43:23', '2024-04-17 05:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `product_id`, `name`, `price`, `quantity`, `created_at`) VALUES
(1, NULL, 1, 'Product Name', 10.00, 1, '2024-04-25 10:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`, `phone_number`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 'sanudn', '$2y$10$yQNmlbiG8jCxZ7VqyZDn4efBjiTtW2aUBYAaQFbiT.uaOhTcWRr.a', 'sdfsd@1212.fdg', 'dfd', '232323', '32232', '2024-04-17 10:54:09', '2024-04-17 10:54:09'),
(2, 'nethmi', '$2y$10$WW5SgbN/7jMdny5UHAXMc.4RUBHcD8kSjCEJf.d5oaNRfLwCxmiX6', 'dsfs@2323.ghh', 'asd', '4323', '232', '2024-04-17 11:04:56', '2024-04-17 11:04:56'),
(3, 'pakaya', '$2y$10$5YzCjjJrknZQFUNkrer9fOw17Tnknyp4bPyPS0DcmGITwI4u3aab2', 'sandunlb20021@gmail.com', 'sdfsd', '121212', '21212', '2024-04-25 08:40:58', '2024-04-25 08:40:58'),
(4, 'nethmii', '$2y$10$MdTvQWLnOZ2.K8PvST6Njuy8PjrZ.lEYswLsPgStbVEf6kMwyZlvq', 'sandunlb3077@gmail.com', 'nnnn7', '3077', '77', '2024-04-25 10:52:12', '2024-04-25 10:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`) VALUES
(2, 26),
(2, 27),
(3, 27),
(3, 29),
(3, 32),
(4, 26),
(4, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
