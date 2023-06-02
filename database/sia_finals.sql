-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 07:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_finals`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(10, 13, 19, 11);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Wall Lights', 'wall'),
(2, 'Ceiling Lights', 'ceiling');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 2),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5),
(21, 11, 19, 1),
(22, 12, 19, 1),
(23, 13, 19, 1),
(24, 13, 2, 1),
(25, 14, 19, 1),
(26, 15, 2, 1),
(27, 16, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `counter`) VALUES
(2, 2, 'Classic Mini Ring Chandelier', '<p>The Classic Mini Ring Chandelier by Visual Comfort Signature, formerly known as Visual Comfort, features a unique blend of traditional and industrial design elements. Its body consists of a thick ringed base that runs through a series of stylized fixtures (with balled and rounded accents) with candelabra light sources and tapered Natural Paper shades. Once lit, this piece offers a warm, shimmering ambiance ideal for social settings. Support rods extend up to a decorative spherical accent.</p>', 'ceiling_lights', 5159, 'ceiling_lights.jpg', '2023-05-12', 9),
(19, 1, 'Go Lightly Wall Sconce', '<p>Stylish in its simplicity, the Go Lightly Wall Sconce by Visual Comfort Signature, formerly known as Visual Comfort, provides a generous amount of light without drawing attention to itself. Its design consists of a seamless Silk shade which sits atop a slim metal arm and low-profile wallplate. Once lit, a warm, soothing ambiance fills the surrounding space, giving your décor a sense of refinement and personality.</p>\n', 'wall_lights', 2500, 'wall_lights.jpg', '2023-05-12', 19);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10'),
(11, 16, 'PAYID-MRPFOPI5TY108418D3699233', '2023-05-12'),
(12, 16, 'PAYID-MRPFZOY3SK56269V28345037', '2023-05-12'),
(13, 16, 'PAYID-MRPGT2A20X56212BG762135R', '2023-05-12'),
(14, 16, 'PAYID-MRPG6RI6E3961357H764853U', '2023-05-12'),
(15, 16, 'PAYID-MRPHAZI5U496847SG991593K', '2023-05-12'),
(16, 16, 'PAYID-MRPHL7Q90W74031F84953538', '2023-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$0SHFfoWzz8WZpdu9Qw//E.tWamILbiNCX7bqhy3od0gvK5.kSJ8N2', 1, 'IT', 'SOURCECODE', '', '', 'logo.png', 1, '', '', '2020-12-30'),
(13, 'karylle@gmail.com', '$2y$10$THCiaipRqs51LgZNNSp7henK8SJ17r7abaH44slwjXavv/nVEw29e', 0, 'Karylle', 'Lopez', 'Angeles City', '09123456789', 'female3.jpg', 1, '', '', '2020-12-30'),
(14, 'asd@gmail.com', '$2y$10$SNAvbe7W0gsXW3ry6HQWCuhIp0knwWJKbQ8G.L2EinAlOZJ9ZoLJ2', 0, 'asd', 'asd', '', '', '', 1, 'p1TcPRrZCuLY', '', '2023-05-12'),
(15, 'asssd@gmail.com', '$2y$10$0wsOdOxCZx70g65Iudkzg.G/UvY6Vlw.4NfMYYs7GeOeKbZH8/YjW', 0, 'asd', 'asd', '', '', '', 0, 'IFx9RG1HTN5Z', '', '2023-05-12'),
(16, 'bangsil.ronrusselle@auf.edu.ph', '$2y$10$JalJw5Sl1xhJrAUzPZQg8OyxoZym6F8RzctQptzZ61.DIieh7JUGK', 0, 'Russ', 'Bangsil', 'Pandan, Angeles City', '09123456789', '9.jpg', 1, '', '', '2023-05-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
