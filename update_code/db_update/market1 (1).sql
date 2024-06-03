-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2024 at 08:17 PM
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
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image_path`, `alt_text`, `is_active`) VALUES
(1, 'assets/img/new/banner1.png', 'Banner 1', 1),
(2, 'assets/img/new/banner2.png', 'Banner 2', 1),
(3, 'assets/img/new/banner3.png', 'Banner 3', 1),
(4, 'assets/img/new/banner3.png', 'Banner 4', 1),
(5, 'assets/img/new/banner3.png', 'Banner 5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` decimal(10,2) NOT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `kondisi` text,
  `deskripsi_barang` text,
  `link_maps` varchar(255) DEFAULT NULL,
  `gambar_barang_1` varchar(255) DEFAULT NULL,
  `gambar_barang_2` varchar(255) DEFAULT NULL,
  `gambar_barang_3` varchar(255) DEFAULT NULL,
  `gambar_barang_4` varchar(255) DEFAULT NULL,
  `tanggal_masuk` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_like` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_barang`
--

INSERT INTO `detail_barang` (`id`, `username`, `nama_barang`, `harga_barang`, `nomor_telepon`, `kondisi`, `deskripsi_barang`, `link_maps`, `gambar_barang_1`, `gambar_barang_2`, `gambar_barang_3`, `gambar_barang_4`, `tanggal_masuk`, `jumlah_like`) VALUES
(33, 'sigiti', 'barang haram', '10000000.00', '081344843648', 'Product baru, Lecet dikit tak ngaruh', 'Sepatu lari Adidas Ultraboost 21 adalah kombinasi sempurna antara desain yang stylish, kinerja yang luar biasa, dan kenyamanan yang tak tertandingi. Didesain dengan teknologi mutakhir, sepatu ini dirancang untuk memberikan pengalaman lari yang superior kepada setiap pelari.\r\n\r\nFitur Utama:\r\n\r\nBoost Midsole: Ditenagai oleh teknologi Boost, sepatu ini menawarkan responsivitas dan energi yang tak tertandingi setiap kali kaki menyentuh tanah.\r\nPrimeknit Upper: Dibuat dengan teknologi Primeknit, sepatu ini memberikan kenyamanan seperti kaus kaki dan memastikan kaki tetap terkunci dalam tempatnya.\r\nTorsion System: Menawarkan stabilitas yang diperlukan saat melintasi setiap langkah, menjaga kaki Anda tetap seimbang dan aman.\r\nContinental Rubber Outsole: Memberikan cengkeraman yang luar biasa di berbagai jenis permukaan, sehingga Anda dapat menghadapi segala jenis kondisi lari dengan percaya diri.\r\nFitcounter Heel: Dirancang khusus untuk memberikan dukungan tambahan di bagian belakang kaki, mengurangi gesekan dan risiko cedera.\r\nDesain:\r\nSepatu ini memiliki desain yang futuristik dengan detail yang menarik. Logo Adidas yang ikonik terlihat jelas di sisi sepatu, menunjukkan keanggunan merek tersebut dalam industri olahraga.\r\n\r\nKegunaan:\r\nCocok digunakan untuk berbagai jenis lari, mulai dari lari santai hingga latihan intensif. Adidas Ultraboost 21 akan membantu Anda mencapai performa terbaik Anda dengan kenyamanan dan gaya yang tak tertandingi.\r\n\r\nKesimpulan:\r\nSepatu lari Adidas Ultraboost 21 adalah pilihan terbaik bagi para pelari yang mengutamakan kenyamanan, kinerja, dan gaya. Dengan teknologi canggih dan desain yang menawan, sepatu ini tidak hanya akan meningkatkan performa lari Anda, tetapi juga membuat Anda tampil stylish di jalur lari.', NULL, 'uploads/hehe (1).jpg', 'uploads/hehe (2).jpg', 'uploads/hehe (3).jpg', 'uploads/hehe (4).jpg', '2024-05-26 15:22:48', 3),
(36, 'feb', 'lonteh gurih', '1200000.00', '081344843648', 'Product baru, Lecet dikit tak ngaruh, Retak dikit', 'lonte gurihnya bang cocok sekali untuk menemani anda dalam ngentot, eh maksudnya ngencan total ya heheh :-)', NULL, 'uploads/hehe (1).jpg', 'uploads/hehe (2).jpg', 'uploads/hehe (3).jpg', 'uploads/hehe (4).jpg', '2024-05-26 15:40:52', 0),
(37, 'feb', 'bra all size', '159999.00', '081344843648', 'Hancur parah seperti bangkai', 'menjual bra berbagai ukuran bisa dibilang ini ngetrif bh ges yaa', NULL, 'uploads/hehe (1).jpg', NULL, NULL, NULL, '2024-05-26 15:41:51', 0),
(38, 'zakar', 'ganja berkualitas dewa', '1000000.00', '081244843648', 'Product baru, Bekas seperti baru, Retak dikit, Hancur parah seperti bangkai', 'harum bang sumpah enak banget di gunakan saat ngoding atau belajar di kelas', NULL, 'uploads/015744500-1607081345-Komisi-PBB-Anggap-Ganja-Tak-Berbahaya-Ini-Manfaat-Medisnya-shutterstock-1509063542.jpg', 'uploads/2038683000.jpg', 'uploads/images (2).jpg', 'uploads/jefrinicholtidakmerokoktetapipakaiganjalebihbahayamanahalodoc.jpg', '2024-05-26 15:44:55', 1),
(39, 'zakar', 'jual stik ps 5', '300000.00', '081234567890', 'Tidak terlalu sering digunakan, Lecet dikit tak ngaruh, Retak dikit', 'di jual stik ps 3 bikin nagis', NULL, 'uploads/gambar2.png', NULL, NULL, NULL, '2024-05-26 15:45:41', 0),
(40, 'king', 'gitar ibanez ori', '2000000.00', '08129876543', 'Bekas seperti baru, Tidak terlalu sering digunakan, Retak dikit, Hancur parah seperti bangkai', 'di jual gitar ibanez ori nih boss', 'https://www.google.com/maps/place/Yogyakarta,+Yogyakarta+City,+Special+Region+of+Yogyakarta/@-7.8032504,110.3748449,13z/data=!3m1!4b1!4m6!3m5!1s0x2e7a5787bd5b6bc5:0x21723fd4d3684f71!8m2!3d-7.8013672!4d110.3647568!16zL20vMGRnNnl4?entry=ttu', 'uploads/gambar3.png', NULL, NULL, NULL, '2024-05-26 15:47:46', 0),
(41, 'king', 'dijual lonte berbadan seksi', '10000000.00', '0878123412345', 'Product baru', 'product baru nih boss cocok menemani kalian saat sedang bekerja dan tidur heheh', NULL, 'uploads/hehe (2).jpg', 'uploads/hehe (3).jpg', 'uploads/hehe (4).jpg', NULL, '2024-05-26 15:49:54', 4),
(42, 'feb', 'Adidas Original Samba + Iblis', '1800000.00', '081344843648', 'Product baru', 'Bekas no minus pemakain baru 1 kali butuh uang banget untuk bayar kuliah', NULL, 'uploads/sepatu (1).png', 'uploads/sepatu (2).png', 'uploads/sepatu (3).png', 'uploads/sepatu-adinda (1).png', '2024-05-27 17:35:20', 0);

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
(18, 'uploads/produk 2.png', '', 'reza1', 'default'),
(19, 'uploads/banner5.png', 'awda', 'feb', 'default'),
(20, 'uploads/banner5.png', 'awda', 'feb', 'default');

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
(57, 'feb', '$2y$10$eaj4yOA/d8q4eiG9lX.Hc.8YStx4/YcxAejtxTQf23c01hsP6.M56', '081344843648', 'jalan swadaya3', 'user', NULL),
(58, 'zakar', '$2y$10$O85nteGh46wucfKUhE0oi.p7X73zN4PSK5lcsc1cOfCcw8I8K6oZm', '081234567890', 'jalan swadaya3', 'user', NULL),
(59, 'reza', '$2y$10$LV8dZiHd2ZcjBX6lGzdeyOujLkYbp996FrRH50D31FTx2Ot9P/rJm', '081324567890', 'jalan seturan', 'user', NULL),
(60, 'raka', '$2y$10$uFjHEfB2kITddspGZAF.l.JzdFlzoQavBP3SmIOWEwCTQ2Ds5khK2', '081234560987', 'kost hammer', 'user', NULL),
(61, 'gilang gilung', '$2y$10$JzC680cW/XWBn7PMVTa4ZeQBzpPAvODpeJJ.DkxZY.j1IwK60tvEq', '0897878654321', 'kost hammer', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `like_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`id`, `username`, `product_id`, `like_time`) VALUES
(3, 'sigiti', 41, '2024-05-27 19:40:16'),
(8, 'feb', 38, '2024-05-27 20:11:05'),
(11, 'feb', 33, '2024-05-27 20:12:24'),
(12, 'sigiti', 33, '2024-05-27 20:12:54'),
(13, 'zakar', 33, '2024-05-27 20:13:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_barang`
--
ALTER TABLE `detail_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `detail_barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
