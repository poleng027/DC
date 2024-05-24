-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 03:35 AM
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
-- Database: `phpoop221`
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
  `user_profile_picture` varchar(225) NOT NULL,
  `account_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `birthday`, `sex`, `email`, `user`, `pass`, `user_profile_picture`, `account_type`) VALUES
(28, 'KayeZel', 'Reyes', '2024-05-09', 'Female', 'kzel@gmail.com', 'kzel', '$2y$10$9OGdicPyj0EDkbZVtPd9.eM.l5CEkZ568PZMz961LtL5TwlQgbbD6', 'uploads/OIP_1716166331.jpg', 1),
(30, 'Princess Coleen', 'Roxas', '2024-05-04', 'Male', 'gab@gmail.com', 'Coleen', 'Coleen123$', 'uploads/drei_1716166705.jpg', 1),
(31, 'Andrei', 'Tallado', '2003-12-03', 'Male', 'tallad@gmail.com', 'drei', '$2y$10$l0t..Csj16TNiLjOqRFswO.S8QPULBd19MVnO8aaxHyVgawvArUBa', 'uploads/we.jpg', 1),
(32, 'Ma. Paula', 'De Chavez', '2003-12-27', 'Female', 'paula@gmail.com', 'poleng', '$2y$10$4Q6QmiJe.Plz77rGB4EEYecaVy2FnqAcZCveAoOF4iPvgvh6k777.', 'uploads/OIP_1716510108.jpg', 0);

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
(24, 28, '1', 'Alangilan', 'Balete', 'Region IV-A (CALABARZON)'),
(26, 30, '46', 'Batia', 'Bocaue', 'Region III (Central Luzon)'),
(27, 31, 'q', 'Kaumbakan', 'Mahatao', 'Region II (Cagayan Valley)'),
(28, 32, '30', 'San Agustin', 'Ibaan', 'Region IV-A (CALABARZON)');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
