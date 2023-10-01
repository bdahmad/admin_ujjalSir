-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2023 at 09:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Author'),
(4, 'Editor'),
(5, 'Subscriber');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `role_id` int(5) NOT NULL,
  `user_photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_username`, `user_password`, `role_id`, `user_photo`) VALUES
(12, 'Sabbir Ahmed', '019354842325', 'sabbir@gmail.com', 'sabbir', 'c20ad4d76fe97759aa27a0c99bff6710', 2, 'users_1695288403_90386715.jpg'),
(13, 'Reja Kazi', '01632547894', 'reja@gmail.com', 'reja', 'c20ad4d76fe97759aa27a0c99bff6710', 3, 'users_1695289883_3172468.png'),
(14, 'Tanbir Ahmed', '01521364789', 'tanbir@gmail.com', 'tanbir', 'c20ad4d76fe97759aa27a0c99bff6710', 4, 'users_1695288516_84913916.jpg'),
(15, 'Toasin al Mahmud', '01515369874', 'toasinad@gmail.com', 'toasin', 'c20ad4d76fe97759aa27a0c99bff6710', 5, 'users_1695288590_93017031.jpg'),
(16, 'Ahmad Ali', '01935056526', 'ahmad@gmail.com', 'ahmad', '6512bd43d9caa6e02c990b0a82652dca', 1, 'users_1695634020_71141933.png'),
(17, 'aliq', '345313213', 'ali@gmail.com', 'ali', 'c20ad4d76fe97759aa27a0c99bff6710', 3, ''),
(18, 'test', '526465', 'test@gmail.com', 'test', 'c20ad4d76fe97759aa27a0c99bff6710', 5, 'users_1695634696_74265517.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
