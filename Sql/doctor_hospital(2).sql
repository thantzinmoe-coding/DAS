-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 11, 2025 at 11:19 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

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
-- Table structure for table `doctor_hospital`
--

DROP TABLE IF EXISTS `doctor_hospital`;
CREATE TABLE IF NOT EXISTS `doctor_hospital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `hospital_id` int NOT NULL,
  `available_day` enum('MON','TUE','WED','THU','FRI','SAT','SUN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `available_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_hospital`
--

INSERT INTO `doctor_hospital` (`id`, `doctor_id`, `hospital_id`, `available_day`, `available_time`) VALUES
(1, 3, 2, 'MON', '10AM-12PM'),
(2, 5, 1, 'WED', '3PM-5PM'),
(3, 2, 3, 'TUE', '2PM-4PM'),
(4, 1, 5, 'THU', '11AM-1PM'),
(5, 4, 6, 'FRI', '9AM-11AM'),
(6, 3, 7, 'SAT', '4PM-6PM'),
(7, 2, 8, 'SUN', '1PM-3PM'),
(8, 5, 9, 'MON', '2PM-4PM'),
(9, 1, 10, 'TUE', '3PM-5PM'),
(10, 4, 2, 'WED', '10AM-12PM'),
(11, 2, 3, 'THU', '5PM-7PM'),
(12, 3, 4, 'FRI', '11AM-1PM'),
(13, 5, 5, 'SAT', '9AM-11AM'),
(14, 4, 6, 'SUN', '3PM-5PM'),
(15, 1, 7, 'MON', '1PM-3PM'),
(16, 2, 8, 'TUE', '2PM-4PM'),
(17, 3, 9, 'WED', '10AM-12PM'),
(18, 4, 10, 'THU', '4PM-6PM'),
(19, 5, 1, 'FRI', '3PM-5PM'),
(20, 1, 2, 'SAT', '2PM-4PM'),
(21, 2, 3, 'SUN', '10AM-12PM'),
(22, 3, 4, 'MON', '11AM-1PM'),
(23, 4, 5, 'TUE', '3PM-5PM'),
(24, 5, 6, 'WED', '9AM-11AM'),
(25, 1, 7, 'THU', '5PM-7PM'),
(26, 2, 8, 'FRI', '4PM-6PM'),
(27, 3, 9, 'SAT', '2PM-4PM'),
(28, 4, 10, 'SUN', '11AM-1PM'),
(29, 5, 1, 'MON', '10AM-12PM'),
(30, 1, 2, 'TUE', '3PM-5PM');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_hospital`
--
ALTER TABLE `doctor_hospital`
  ADD CONSTRAINT `doctor_hospital_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `doctor_hospital_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
