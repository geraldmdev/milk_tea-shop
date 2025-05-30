-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 03:48 AM
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
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `usertype`, `password`, `registered_at`) VALUES
(1, 'Magdaraog, Gerald L.', 'Gerald', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2024-09-08 11:37:38'),
(5, 'Blic Claire', 'blic', 'user', '81dc9bdb52d04dc20036dbd8313ed055', '2024-10-06 06:40:20'),
(6, 'Juan Dela Cruz', 'juan', 'user', '81dc9bdb52d04dc20036dbd8313ed055', '2024-10-06 13:36:45'),
(7, 'Jessa', 'jessa', 'user', 'a5b85dcc021937f1fb0148939ede8cf3', '2025-05-07 01:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `name`, `price`, `image`, `qty`) VALUES
(108, 'Greataste', '29.00', 'Food-Name-77.png', 1),
(110, 'Crisp Apple', '39.00', 'Food-Name-6494.png', 1),
(111, 'BINI Dream Frappe', '49.00', 'Food-Name-6293.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(17, 'Featured Brew', 'Food_Category_908.png', 'Yes', 'Yes'),
(21, 'BINI Frappe', 'Food_Category_542.png', 'Yes', 'Yes'),
(22, 'Fruit Tea', 'Food_Category_541.png', 'Yes', 'Yes'),
(24, 'Milk Tea', 'Food_Category_872.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(37, 'Crisp Apple', '', 39.00, 'Food-Name-6494.png', 19, 'Yes', 'Yes'),
(38, 'Greataste', '', 29.00, 'Food-Name-77.png', 17, 'Yes', 'Yes'),
(39, 'Boba Caramel', '', 39.00, 'Food-Name-6396.png', 16, 'Yes', 'Yes'),
(41, 'BINI Dream Frappe', '', 49.00, 'Food-Name-6293.png', 21, 'Yes', 'Yes'),
(42, 'Thai Milk Tea', '', 39.00, 'Food-Name-2384.png', 16, 'Yes', 'Yes'),
(44, 'BINI Bliss', 'Best Seller', 40.00, 'Food-Name-9752.png', 21, 'Yes', 'Yes'),
(46, 'Wild Blue', 'Masarap ito!', 50.00, 'Food-Name-1946.png', 22, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Greataste', 29.00, 1, 29.00, '2024-09-08 01:26:12', 'Ordered', 'baliclic', '6545565', 'test@gmail.com', 'Tondo, Manila'),
(2, 'Citrus Chill', 39.00, 2, 78.00, '2024-10-06 04:03:51', 'Delivered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Recto, Manila'),
(3, 'BINI Dream Frappe', 49.00, 3, 147.00, '2024-10-06 04:13:39', 'Cancelled', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Manila'),
(4, 'Citrus Chill', 39.00, 1, 39.00, '2024-10-06 04:15:07', 'Delivered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Manila'),
(5, 'Thai Milk Tea', 39.00, 1, 39.00, '2024-10-06 04:15:07', 'Delivered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Manila'),
(6, 'Boba Caramel', 39.00, 1, 39.00, '2024-10-06 04:15:07', 'Delivered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Manila'),
(7, 'Thai Milk Tea', 39.00, 1, 39.00, '2024-10-06 04:44:00', 'Delivered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Tondo'),
(8, 'BINI Dream Frappe', 49.00, 1, 49.00, '2024-10-06 05:18:56', 'Ordered', 'Juan Dela Cruz', '123456', 'juan@gmail.com', 'Batangas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
