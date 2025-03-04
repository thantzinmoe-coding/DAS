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
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `job_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `credential` text COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_general_ci NOT NULL,
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profile` text COLLATE utf8mb4_general_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `job_type`, `credential`, `gender`, `consultation_fee`, `profile`, `experience`, `cost`) VALUES
(1, 'Dr. John Smith', 'Cardiologist', 'M.B.B.S, M.Med.Sc (Cardiology), Dr.Med.Sc (Cardiology), F.A.C.C', 'Male', 50000.00, 'Experienced cardiologist specializing in heart diseases', '10 years', 50000.00),
(2, 'Dr. Sarah Johnson', 'Neurologist', 'M.B.B.S, M.Med.Sc (Neurology), Dr.Med.Sc (Neurology), F.A.A.N', 'Female', 60000.00, 'Expert in brain and nervous system disorders', '12 years', 60000.00),
(3, 'Dr. Emily Davis', 'Pediatrician', 'M.B.B.S, M.Med.Sc (Pediatrics), Dr.Med.Sc (Pediatrics), F.A.A.P', 'Female', 40000.00, 'Pediatric specialist for children\'s health', '8 years', 40000.00),
(4, 'Dr. Michael Brown', 'Orthopedic Surgeon', 'M.B.B.S, M.Med.Sc (Orthopedics), Dr.Med.Sc (Orthopedics), F.R.C.S (Orth)', 'Male', 70000.00, 'Orthopedic surgery expert', '15 years', 70000.00),
(5, 'Dr. Rachel Wilson', 'Dermatologist', 'M.B.B.S, M.Med.Sc (Dermatology), Dr.Med.Sc (Dermatology), F.A.A.D', 'Female', 45000.00, 'Specialized in skin conditions and treatments', '7 years', 45000.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
