-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 06:29 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `otp`, `status`, `date`) VALUES
(11, 'Kaung', 'kaung123@gmail.com', '$2y$10$mcrIJAfoPEh1gGzYVOZppOIsGgieATmucS/MXCb7MkjLqhApuLte.', 0, '', '0000-00-00 00:00:00'),
(17, 'MIn Thant Zaw', 'min@gmail.com', '$2y$10$lzu5j4JdVs0sBOBxYj/4fecpUB2821SCNVc3r87WvoNmBAiFjCY66', 0, '', '0000-00-00 00:00:00'),
(21, 'mintayza', 'mintayza@gmail.com', '$2y$10$S5DJ4xtAeWXWK5DyCqum1eGpNkjwUBJUmKbcd6cEyNZV90BOya1xS', 0, '', '0000-00-00 00:00:00'),
(49, 'Mg Kaung', 'kaung@gmail.com', '$2y$10$vJb.MnfkluS4dqCHcGaoFuphrHOI16rfsfOjzFxoS6EIG0i.fUhh6', 0, 'verified', '2025-01-29 16:29:47'),
(50, 'Thant Zin Moe', 'thant@gmail.com', '$2y$10$2VqsIudknG3Gtqpp/pyRnePq00DaYRDrO/dU7b/zMd86bEMaYcHuK', 0, 'verified', '2025-01-29 16:30:54'),
(71, 'Thant Zin Moe', 'thantzinmoe@uit.edu.mm', '$2y$10$MmCuopUqByvS7tVOIWotWe0p4IfnFgIDrxdYfc0z8YvKrEBQTcLfe', 0, 'verified', '2025-01-29 23:24:57'),
(72, 'Ye Ye', 'kohtet.ttan112@gmail.com', '$2y$10$822MVm/tFa0/wSkJ6xBwquHeHedkp6hWvQhBENHl4UQQUdipgt8Aa', 0, 'verified', '2025-01-29 23:27:07'),
(77, 'Mg Zaw', 'zazawthz@gmail.com', '$2y$10$ocrAvKC0u1DcsslK3atcuOUsi1RVu2i73pf4oFpvDbR9l7kkzZsL6', 0, 'verified', '2025-02-01 23:25:52'),
(82, 'Thant Zin Moe', 'thantzinmoe893@gmail.com', '$2y$10$pT9hWbklOHzcqbrJKOkdjOgaffZfGbnPhpRdnpaoEA1TtkuZHClX2', 0, 'verified', '2025-02-01 23:03:59'),
(83, 'Ohma San', 'ohmasan56@gmail.com', '$2y$10$9GXlCrGZXX37l0G2gp3Ea.VjXh7VjKuBWD2nXedUtuwXv1w6JhaIu', 0, 'verified', '2025-02-01 23:28:43'),
(84, 'Thant Zin Moe', 'uitstudent03@gmail.com', '$2y$10$D2jhF64laDu2IhA9385Tgew6byRKgE6f4vtqN/oDrlZE4VItmQuhW', 0, 'verified', '2025-02-01 23:35:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
