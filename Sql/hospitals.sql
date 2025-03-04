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
-- Table structure for table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
CREATE TABLE IF NOT EXISTS `hospitals` (
  `hospital_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `specialty` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `emergency_services` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `location`, `specialty`, `contact`, `rating`, `emergency_services`) VALUES
(1, 'Yangon General Hospital', 'Yangon', 'Cardiology', '01-123456', 4.5, 1),
(2, 'Mandalay Children\'s Hospital', 'Mandalay', 'Pediatrics', '02-654321', 4.8, 1),
(3, 'Naypyidaw Neurology Center', 'Naypyidaw', 'Neurology', '03-987654', 4.3, 0),
(4, 'Insein Hospital', 'Yangon', 'Orthopedics', '01-987321', 4.0, 1),
(5, 'Pathein General Hospital', 'Pathein', 'Dermatology', '04-112233', 4.6, 0),
(6, 'Bago Regional Hospital', 'Bago', 'Gastroenterology', '05-445566', 4.2, 1),
(7, 'Taunggyi Heart Center', 'Taunggyi', 'Cardiology', '06-778899', 4.7, 1),
(8, 'Mawlamyine Medical Center', 'Mawlamyine', 'Neurology', '07-334455', 4.4, 0),
(9, 'Magway General Hospital', 'Magway', 'Pediatrics', '08-998877', 4.1, 1),
(10, 'Sittwe Medical Institute', 'Sittwe', 'Oncology', '09-556677', 4.9, 0),
(11, 'Hpa-An General Hospital', 'Hpa-An', 'Orthopedics', '10-123456', 4.2, 1),
(12, 'Myeik Regional Medical Center', 'Myeik', 'Dermatology', '11-654321', 4.0, 0),
(13, 'Dawei Heart Institute', 'Dawei', 'Cardiology', '12-987654', 4.7, 1),
(14, 'Pyay Medical Center', 'Pyay', 'Gastroenterology', '13-111222', 4.1, 1),
(15, 'Sagaing Health Clinic', 'Sagaing', 'Pediatrics', '14-333444', 4.5, 0),
(16, 'Meiktila Central Hospital', 'Meiktila', 'Neurology', '15-555666', 4.3, 1),
(17, 'Monywa City Hospital', 'Monywa', 'Oncology', '16-777888', 4.6, 0),
(18, 'Myitkyina Medical Institute', 'Myitkyina', 'Ophthalmology', '17-999000', 4.4, 1),
(19, 'Lashio General Hospital', 'Lashio', 'Cardiology', '18-121212', 4.8, 1),
(20, 'Loikaw Regional Hospital', 'Loikaw', 'Dermatology', '19-343434', 4.0, 0),
(21, 'Bhamo Health Center', 'Bhamo', 'Orthopedics', '20-565656', 4.1, 1),
(22, 'Hinthada Medical Center', 'Hinthada', 'Pediatrics', '21-787878', 4.9, 0),
(23, 'Kyaukpyu General Hospital', 'Kyaukpyu', 'Neurology', '22-909090', 4.3, 1),
(24, 'Tachileik Regional Medical Center', 'Tachileik', 'Oncology', '23-232323', 4.7, 1),
(25, 'Kyaingtong Central Hospital', 'Kyaingtong', 'Ophthalmology', '24-454545', 4.2, 0),
(26, 'Pakkoku Medical Institute', 'Pakkoku', 'Cardiology', '25-676767', 4.5, 1),
(27, 'Sittwe Regional Hospital', 'Sittwe', 'Gastroenterology', '26-898989', 4.6, 1),
(28, 'Thandwe General Hospital', 'Thandwe', 'Pediatrics', '27-010101', 4.4, 0),
(29, 'Yenangyaung Medical Center', 'Yenangyaung', 'Orthopedics', '28-232425', 4.3, 1),
(30, 'Magway Heart Institute', 'Magway', 'Cardiology', '29-454647', 4.7, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
