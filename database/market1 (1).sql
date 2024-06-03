-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2024 at 08:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market1`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text,
  `uploaded_by` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `image_path`, `description`, `uploaded_by`, `category`) VALUES
(10, 'uploads/produk 1.png', 'sepatu ukuran 27\r\n', 'reza1', 'default'),
(11, 'uploads/produk 2.png', 'sepatu ukuran 27\r\n', 'reza1', 'default'),
(12, 'uploads/produk 3.png', 'sepatu ukuran 27\r\n', 'reza1', 'default'),
(13, 'uploads/produk 4.png', 'sepatu ukuran 27\r\n', 'reza1', 'default'),
(14, 'uploads/produk 1.png', 'sepatu bahan air\r\n', 'reza1', 'default'),
(16, 'uploads/produk 2.png', '', 'reza1', 'default'),
(17, 'uploads/produk 2.png', '', 'reza1', 'default'),
(18, 'uploads/produk 2.png', '', 'reza1', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone_number`, `address`, `role`, `profile_picture`) VALUES
(35, 'reza1', '$2y$10$qDBv.jW.jQQ20n1RtAN.6.iX.wA7H74FJWXeBHievn/0KXqSuJWAO', '081261646420', 'dumai', 'user', 'uploads/reza1_66103d5f7f912.jpg'),
(36, 'raka', '$2y$10$CET8w5x/bG1TtafMTcVN1OKItRYR.mesQCvgGH1ocg92AgFzu3Wl2', '9999', 'seturan', 'user', NULL),
(37, 'GILANG', '$2y$10$ZdIkpP6t/rKkBsZz6/D3JeotxF25qDgzIorI4Kqi3GAip93q5vYI.', '081266666', 'SETURAN', 'user', 'uploads/GILANG_66103e6f35614.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
