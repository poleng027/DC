-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 03:24 AM
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
-- Database: `phpoop_221`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `user` varchar(225) NOT NULL,
  `pass` varchar(225) NOT NULL,
  `user_profile_picture` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `birthday`, `sex`, `email`, `user`, `pass`, `user_profile_picture`) VALUES
(23, 'Ma. Paula', 'De Chavez', '2003-12-27', 'Female', 'mariapaulaarcoirezdechavez@gmail.com', 'poleng', '$2y$10$v7M4D8Vk496wwKdnExslnen.iKxwH5SMDSeQ3qomiFh27BKHBuGRW', 'uploads/OIP_1716163490.jpg'),
(28, 'KayeZel', 'Reyes', '2024-05-09', 'Female', 'kzel@gmail.com', 'kzel', '$2y$10$9OGdicPyj0EDkbZVtPd9.eM.l5CEkZ568PZMz961LtL5TwlQgbbD6', 'uploads/OIP_1716166331.jpg'),
(30, 'Princess Coleen', 'Roxas', '2024-05-04', 'Male', 'gab@gmail.com', 'Coleen', 'Coleen123$', 'uploads/drei_1716166705.jpg'),
(31, 'Andrei', 'Tallado', '2003-12-03', 'Male', 'tallad@gmail.com', 'drei', '$2y$10$bJAFaGYUff7XVCBwo79ZPeVI6mDl.Ntb7uAUatOJrG6z1dcKjSVuu', 'uploads/we.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_street` varchar(255) DEFAULT NULL,
  `user_barangay` varchar(255) DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_address_id`, `user_id`, `user_street`, `user_barangay`, `user_city`, `user_province`) VALUES
(19, 23, '123', 'San Agustin', 'Ibaan', 'Region IV-A (CALABARZON)'),
(24, 28, '1', 'Alangilan', 'Balete', 'Region IV-A (CALABARZON)'),
(26, 30, '46', 'Batia', 'Bocaue', 'Region III (Central Luzon)'),
(27, 31, 'q', 'Kaumbakan', 'Mahatao', 'Region II (Cagayan Valley)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
