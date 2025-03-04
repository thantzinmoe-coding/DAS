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
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int DEFAULT NULL,
  `hospital_id` int DEFAULT NULL,
  `useremail` varchar(50) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_start_time` varchar(10) NOT NULL,
  `appointment_end_time` varchar(10) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `symptoms` text,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `doctor_id`, `hospital_id`, `useremail`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `patient_name`, `symptoms`) VALUES
(11, 1, 5, '', '2025-02-13', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health'),
(12, 1, 7, '', '2025-02-13', '5PM', '7PM', 'Ye Nanda Htet', 'Mental Health'),
(13, 1, 7, '', '2025-02-17', '1PM', '3PM', 'Ye Nanda Htet', 'Mental Health'),
(15, 1, 5, '', '2025-02-20', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health'),
(16, 1, 10, '', '2025-02-11', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health'),
(17, 1, 7, '', '2025-02-20', '5PM', '7PM', 'Ye Nanda Htet', 'Heart Broken'),
(18, 1, 2, '', '2025-02-11', '3PM', '5PM', 'Thiha Zaw', 'simp Ma Ma'),
(19, 1, 5, '', '2025-03-06', '11AM', '1PM', 'Thiha Zaw', 'Mental Health'),
(20, 1, 2, '', '2025-02-22', '2PM', '4PM', 'Thiha Zaw', 'Falling in love with Ma Ma'),
(21, 1, 2, '', '2025-02-15', '2PM', '4PM', 'Ye Nanda Htet', 'Plug Kyut'),
(22, 1, 5, '', '2025-02-27', '11AM', '1PM', 'Min Thant Zaw', 'Ma Ma lover'),
(23, 1, 10, '', '2025-02-18', '3PM', '5PM', 'Kaung Myat Htet', 'Mental Health'),
(24, 1, 5, '', '2025-03-13', '11AM', '1PM', 'Min Thant Zaw', 'Ma Ma simp'),
(25, 1, 10, '', '2025-02-25', '3PM', '5PM', 'Khant Lynn Htoo', 'Mental Health'),
(26, 1, 5, '', '2025-04-03', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health'),
(27, 1, 10, 'thantzinmoe893@gmail.com', '2025-03-11', '3PM', '5PM', 'Thant Zin Moe', 'Heart Attack');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
