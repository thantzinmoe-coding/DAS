-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2025 at 08:00 PM
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
  `token_number` tinyint(1) NOT NULL,
  `doctor_hospital_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `hospital_id` (`hospital_id`),
  KEY `fk_doctor_hospital_id` (`doctor_hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `doctor_id`, `hospital_id`, `useremail`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `patient_name`, `symptoms`, `token_number`, `doctor_hospital_id`) VALUES
(11, 1, 5, '', '2025-02-13', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(12, 1, 7, '', '2025-02-13', '5PM', '7PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(13, 1, 7, '', '2025-02-17', '1PM', '3PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(15, 1, 5, '', '2025-02-20', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(16, 1, 10, '', '2025-02-11', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(17, 1, 7, '', '2025-02-20', '5PM', '7PM', 'Ye Nanda Htet', 'Heart Broken', 0, NULL),
(18, 1, 2, '', '2025-02-11', '3PM', '5PM', 'Thiha Zaw', 'simp Ma Ma', 0, NULL),
(19, 1, 5, '', '2025-03-06', '11AM', '1PM', 'Thiha Zaw', 'Mental Health', 0, NULL),
(20, 1, 2, '', '2025-02-22', '2PM', '4PM', 'Thiha Zaw', 'Falling in love with Ma Ma', 0, NULL),
(92, 54, 1, 'thantzinmoe893@gmail.com', '2025-03-05', '1PM', '3PM', 'မင်းတေဇ', 'ချောင်းခြောက်ဆိုးခြင်း', 1, NULL),
(38, 1, 2, 'thant@gmail.com', '2025-02-14', '2PM', '4PM', 'Thiha Zaw', 'Being crazy', 0, NULL),
(43, 1, 5, 'thantzinmoe893@gmail.com', '2025-02-27', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(94, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-01', '12PM', '2PM', 'Thant Zin Moe', 'Headache', 1, NULL),
(95, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-08', '12PM', '2PM', 'သီဟဇော်', 'ခေါင်းကိုက်', 2, NULL),
(96, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-08', '12PM-2PM', '2PM', 'ရဲနန္ဒထက်', 'ခေါင်းကိုက်', 3, NULL),
(51, 4, 2, 'kohtet.ttan112@gmail.com', '2025-02-19', '10AM', '12PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(52, 2, 3, 'thantzinmoe@uit.edu.mm', '2025-02-18', '2PM', '4PM', 'Thant Zin Moe', 'Heart Attack', 0, NULL),
(53, 5, 1, 'kohtet.ttan112@gmail.com', '2025-02-19', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(54, 4, 2, 'minthantzaw@uit.edu.mm', '2025-02-26', '10AM', '12PM', 'Min Thant Zaw', 'Mental Health', 0, NULL),
(56, 5, 1, 'kohtet.ttan112@gmail.com', '2025-02-23', '10AM', '12PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(57, 4, 2, 'thizazaw2@gmail.com', '2025-03-05', '10AM', '12PM', 'Thiha Zaw', 'Headache', 0, NULL),
(91, 58, 1, 'tmoe8123@gmail.com', '2025-03-07', '4PM', '6PM', 'သီဟဇော်', 'စော်မရ', 1, NULL),
(59, 5, 1, 'thantzinmoe893@gmail.com', '2025-02-26', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0, NULL),
(61, 3, 2, 'yenandahtet@uit.edu.mm', '2025-02-24', '10AM', '12PM', 'ရဲန္ဒထက်', 'ဘေဘီပစ်ထားလို့', 0, NULL),
(62, 4, 6, 'thantzinmoe893@gmail.com', '2025-02-28', '9AM', '11AM', 'ရဲနန္ဒထက်', 'ဘေဘီပစ်ထားလို့', 0, NULL),
(97, 1, 5, 'ohmasan56@gmail.com', '2025-03-22', '12PM', '2PM', 'Kaung Myat Htet', 'Mental Health', 4, NULL),
(64, 5, 1, 'thantzinmoe893@gmail.com', '2025-02-28', '3PM', '5PM', 'Thant Zin Moe', 'Headache', 0, NULL),
(65, 5, 1, 'thantzinmoe893@gmail.com', '2025-03-03', '10AM', '12PM', 'သန့်ဇင်မိုး', 'ခေါင်းကိုက်', 0, NULL),
(66, 41, 5, 'thantzinmoe893@gmail.com', '2025-03-02', '1PM', '11PM', 'သန့်ဇင်မိုး', 'နှလုံးသားလေး ခံစားရ', 0, NULL),
(98, 36, 14, 'shwe104410441044@gmail.com', '2025-03-12', '4PM', '6PM', 'Shwe Shwe', 'nay ma kg', 1, NULL),
(99, 35, 2, 'shwe104410441044@gmail.com', '2025-03-27', '12PM', '2PM', 'hh', 'hh', 0, NULL),
(68, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Thiha Zaw', 'Mental Health', 1, NULL),
(69, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'Mental Health', 2, NULL),
(81, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'mental Health', 4, NULL),
(79, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'Mental Health', 3, NULL),
(86, 41, 27, 'lwannuuwatt@gmail.com', '2025-03-02', '1PM', '3PM', 'ကောင်းမြတ်ထက်', 'နှလုံးသားလေး ခံစားရ', 0, NULL),
(88, 46, 20, 'zazawthz@gmail.com', '2025-03-02', '2PM', '4PM', 'ရဲနန္ဒထက်', 'စိတ်ဖောက်', 2, NULL),
(89, 41, 28, 'yenandahtet@uit.edu.mm', '2025-03-04', '3PM', '5PM', 'ရဲနန္ဒထက်', 'နှလုံးအမောဖောက်', 1, NULL),
(100, 18, 3, 'thantzinmoe893@gmail.com', '2025-03-07', '9AM', '11AM', 'သန့်ဇင်မိုး', 'ခေါင်းကိုက်', 0, NULL),
(101, 6, 23, 'thantzinmoe893@gmail.com', '2025-03-08', '10AM', '12PM', 'Thant Zin Moe', 'Headache', 1, NULL),
(104, 18, 3, 'yenandahtet@uit.edu.mm', '2025-03-07', '9AM', '11AM', 'Ye Nanda Htet', 'headache', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
