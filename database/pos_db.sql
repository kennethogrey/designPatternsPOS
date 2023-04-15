-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 06:57 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `category` varchar(255) NOT NULL,
  `bonus_feature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pname` varchar(25) NOT NULL,
  `cost` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bonus_feature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `cost`, `category`, `quantity`, `bonus_feature`) VALUES
(42, 'iphone 14', '10000', 'Electronics', 80, 'Express Shipping, Gift Wrapping'),
(43, 'Tomatoes', '200', 'Groceries', 1971, 'Express Shipping'),
(44, 'Gucci sweater', '1000', 'Clothing', 181, 'Gift Wrapping'),
(45, 'Sweater', '400', 'Clothing', 995, 'Gift Wrapping'),
(46, 'nike sneakers', '2333', 'Clothing', 198, 'Express Shipping,Gift Wrapping'),
(47, 'samsung tv', '50000', 'Electronics', 2000, 'Gift Wrapping'),
(48, 'Onions', '100', 'Groceries', 30000, 'Express Shipping'),
(49, 'carrots', '200', 'Groceries', 800, 'Express Shipping,Gift Wrapping'),
(50, 'Samsung S23 ultra', '23000', 'Electronics', 9999, 'Express Shipping,Gift Wrapping');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `pname`, `cost`, `quantity`, `category`, `payment_method`, `seller`) VALUES
(9, 'iphone 14', 10000, 1, 'Electronics', 'Cash', ''),
(10, 'Tomatoes', 200, 1, 'Electronics', 'Cash', ''),
(11, 'Gucci sweater', 1000, 1, 'Electronics', 'Cash', ''),
(12, 'iphone 14', 10000, 1, 'Electronics', 'Credit Card', ''),
(13, 'Tomatoes', 200, 1, 'Electronics', 'Credit Card', ''),
(14, 'Gucci sweater', 1000, 1, 'Electronics', 'Credit Card', ''),
(15, 'Tomatoes', 400, 2, 'Electronics', 'Cash', ''),
(17, 'iphone 14', 30000, 3, 'Electronics', 'Cash', ''),
(18, 'Sweater', 1600, 4, 'Clothing', 'Cash', ''),
(19, 'iphone 14', 10000, 1, 'Electronics', 'Credit Card', ''),
(20, 'Tomatoes', 2000, 10, 'Groceries', 'Credit Card', ''),
(21, 'Gucci sweater', 1000, 1, 'Clothing', 'Credit Card', ''),
(22, 'Sweater', 400, 1, 'Clothing', 'Credit Card', ''),
(23, 'iphone 14', 10000, 1, 'Electronics', 'Cash', 'user1@gmail.com'),
(24, 'Tomatoes', 200, 1, 'Groceries', 'Credit Card', 'user1@gmail.com'),
(25, 'Gucci sweater', 1000, 1, 'Clothing', 'Credit Card', 'user1@gmail.com'),
(26, 'nike sneakers', 2333, 1, 'Clothing', 'Credit Card', 'linda@email.com'),
(27, 'Samsung S23 ultra', 23000, 1, 'Electronics', 'Credit Card', 'linda@email.com'),
(28, 'Tomatoes', 200, 1, 'Groceries', 'Credit Card', 'linda@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `user_role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin'),
(5, 'linda@gmail.com', 'linda', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
