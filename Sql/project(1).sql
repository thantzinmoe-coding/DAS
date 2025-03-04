-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2025 at 08:33 AM
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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int NOT NULL AUTO_INCREMENT,
  `adminName` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hospital_id` int DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `email` (`email`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `adminName`, `email`, `password`, `hospital_id`, `role`) VALUES
(77, 'Min Thant Zaw', 'admin31@gmail.com', '$2y$10$omDylGT2XgRvlDeVtx2v/uf5NF9nYgiamFxnOyMUnTwDIvjnxUm2G', 31, 'hospital'),
(76, 'Min Thant Zaw', 'admin30@gmail.com', '$2y$10$/ITqRPTbouiy8lUYUax5g.o3DNNuKmJA.1N.aanU0HQ1yGhfl58Km', 30, 'hospital'),
(75, 'Min Thant Zaw', 'admin29@gmail.com', '$2y$10$46u80msiW9Gy9TyOY4QH4..czcM464D9mTaichyU65971j3vI69ZS', 29, 'hospital'),
(74, 'Min Thant Zaw', 'admin28@gmail.com', '$2y$10$qTsWEmbnRkyZurNefTHfDu04pFu8IwyUA2I8Be14RDw0vEVciQJge', 28, 'hospital'),
(73, 'Min Thant Zaw', 'admin27@gmail.com', '$2y$10$osa94DGcysccQ2hfnrZIueovkx2iYSQ6tu5bZkppQyJFHYiuj7nYS', 27, 'hospital'),
(72, 'Min Thant Zaw', 'admin26@gmail.com', '$2y$10$83eDCbL7JSHWCLDsDTeik.HNhwjzAW1NcnGmzNh2DQ7t9ahitP2sy', 26, 'hospital'),
(71, 'Min Thant Zaw', 'admin25@gmail.com', '$2y$10$ixIXe9iSsawYQH9OiT6RaeMyQn98JRJ3sAYa5/z5SG1HbUK5Zdyo2', 25, 'hospital'),
(70, 'Min Thant Zaw', 'admin24@gmail.com', '$2y$10$/Ivn227SMB1tfgol4MqB/uBsG9HNeUvzB7bCX48TEJ7uy2TAa.Jau', 24, 'hospital'),
(69, 'Min Thant Zaw', 'admin23@gmail.com', '$2y$10$2bNm5TnjZKFagKqwSAd.KOzCvkg4YX5inIRxQLc6wloHEBrxhD5BS', 23, 'hospital'),
(68, 'Min Thant Zaw', 'admin22@gmail.com', '$2y$10$Vb8z6L35Rz9kTEkFiq9rmOXO6C9zKcLFghixrIwicWhxpdDmzfqRa', 22, 'hospital'),
(67, 'Min Thant Zaw', 'admin21@gmail.com', '$2y$10$eYqx2xW40qpLbHnYLG24MuvpXRWbyyJfHrE6YPW0L3MHH0NZUDtqy', 21, 'hospital'),
(66, 'Min Thant Zaw', 'admin20@gmail.com', '$2y$10$4LKiY.4gsVFw1wL.tNU9E.lAxhsgiCUHSaA.wDePTgWAEMpfX2Vcy', 20, 'hospital'),
(65, 'Min Thant Zaw', 'admin19@gmail.com', '$2y$10$x6Dh/E8N4OL.1H1sj4Ce6uDlTmaJFFiRw3gP8ZQckvP3aWBo7b.zC', 19, 'hospital'),
(64, 'Min Thant Zaw', 'admin18@gmail.com', '$2y$10$rB9ZsyTy/hRVnDbMCds7t.swdtoSN/WeVprnbTFK1hsIG9fNZvdZG', 18, 'hospital'),
(63, 'Min Thant Zaw', 'admin17@gmail.com', '$2y$10$3kG4IGSRzy4SwD1Bjt/5p.dA/f8roAFH/n1kvJzWjoulnlC2caiM6', 17, 'hospital'),
(62, 'Min Thant Zaw', 'admin16@gmail.com', '$2y$10$7EBEybUVvCA/XNVL5/WWgOYaxyRMdYNvICE0OBnqb7JOm7lpXh4eC', 16, 'hospital'),
(61, 'Min Thant Zaw', 'admin15@gmail.com', '$2y$10$IXpeEAByAteapJTV6KFIi.k.UiYepiaDgpw7A2XCAP55v1shmqkUu', 15, 'hospital'),
(60, 'Min Thant Zaw', 'admin14@gmail.com', '$2y$10$fAfHAJS7SoUPnVJQz5.j5undxOYggjaikmXl25l4lHOt.xmBtyst2', 14, 'hospital'),
(59, 'Min Thant Zaw', 'admin13@gmail.com', '$2y$10$wSLMX.vnua.i2uODkJsDBO7CuR5D7LcbR5RlEuTkNi1w.8UKxA/Ue', 13, 'hospital'),
(58, 'Min Thant Zaw', 'admin12@gmail.com', '$2y$10$f9vXbnjj32RvfpApbNjVSeR/FzJDthNsZKB5x9EP73hCimNyi3m4G', 12, 'hospital'),
(57, 'Min Thant Zaw', 'admin11@gmail.com', '$2y$10$IQZPL15Z8Qmla37e57X39eL3kGjMQYM9eKiWMCRsx7W92jdJBBbrK', 11, 'hospital'),
(56, 'Min Thant Zaw', 'admin10@gmail.com', '$2y$10$as2kqZtc3S4n0szToyh2luqJDbsStK47yqYGPo4W4dOfII37tkI1a', 10, 'hospital'),
(55, 'Min Thant Zaw', 'admin9@gmail.com', '$2y$10$hJxTiouf6ov.d90kje7f3OwjNSCAZho9eWMF2PkJPjuM.Mivc9hbK', 9, 'hospital'),
(54, 'Min Thant Zaw', 'admin8@gmail.com', '$2y$10$1ETPLnMIyD4rsYxjOAtDre9A/Be6xk4R1afnXxNx4PpFM8Q99Rs0G', 8, 'hospital'),
(53, 'Min Thant Zaw', 'admin7@gmail.com', '$2y$10$kazxBPC137cRRKQO5VN.YeDk3r/8oqOZaPFshhW5Jmc3yp6uTwPm2', 7, 'hospital'),
(52, 'Min Thant Zaw', 'admin6@gmail.com', '$2y$10$wvJpJyhhsTdFmqaFeHUXEeHYlfXI61V9sQ4FqqgDDlRvsKdGToet2', 6, 'hospital'),
(51, 'Min Thant Zaw', 'admin5@gmail.com', '$2y$10$M7qsHs/xu.jrfRja9V34oePRIqT/plIsiJ37aBQYTifq.9rAtJE5i', 5, 'hospital'),
(50, 'Min Thant Zaw', 'admin4@gmail.com', '$2y$10$FdiXHbxQfpddSwdGWoJCB.rWSytt0pvem/WFe5BA5X8Kk1.2kS09C', 4, 'hospital'),
(49, 'Min Thant Zaw', 'admin3@gmail.com', '$2y$10$2ymD8Vrm.Z2/E6I7kVSvRuBtWRsWp7Q7HcBFHaIaWVm4pgx41E7aS', 3, 'hospital'),
(48, 'Min Thant Zaw', 'admin2@gmail.com', '$2y$10$tajIElRxc11NkPutonSqmeO8M8rFRWOrXCWNi.AYaeLG6Ffer7Sea', 2, 'hospital'),
(47, 'Min Thant Zaw', 'admin1@gmail.com', '$2y$10$Xru/BdFhGBIfVMP7eJqsh.EiLjmSPHdJ/noO2btPsKN9Unw/qLqHW', 1, 'hospital'),
(46, 'Min Thant Zaw', 'minthantzaw218@gmail.com', '$2y$10$4eqSPGT9DAYqEF1u6UM.RO/z9ntUg9yRecRlP4EMy/OMwz.FrACR2', 0, 'system'),
(78, 'Min Thant Zaw', 'admin32@gmail.com', '$2y$10$OysDVB1dD7BTND5FI6OV/Ow4vAFu/emC386/InD5RdPbbwkRv4dkC', 32, 'hospital'),
(79, 'Min Thant Zaw', 'system-admin@gmail.com', '$2y$10$aQihzEYzTWbLMEqJSp/zn.O3FspvvoYK./1MGMHpYDTkBMDThngb.', 0, 'system');

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
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `doctor_id`, `hospital_id`, `useremail`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `patient_name`, `symptoms`, `token_number`) VALUES
(11, 1, 5, '', '2025-02-13', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0),
(12, 1, 7, '', '2025-02-13', '5PM', '7PM', 'Ye Nanda Htet', 'Mental Health', 0),
(13, 1, 7, '', '2025-02-17', '1PM', '3PM', 'Ye Nanda Htet', 'Mental Health', 0),
(15, 1, 5, '', '2025-02-20', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0),
(16, 1, 10, '', '2025-02-11', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0),
(17, 1, 7, '', '2025-02-20', '5PM', '7PM', 'Ye Nanda Htet', 'Heart Broken', 0),
(18, 1, 2, '', '2025-02-11', '3PM', '5PM', 'Thiha Zaw', 'simp Ma Ma', 0),
(19, 1, 5, '', '2025-03-06', '11AM', '1PM', 'Thiha Zaw', 'Mental Health', 0),
(20, 1, 2, '', '2025-02-22', '2PM', '4PM', 'Thiha Zaw', 'Falling in love with Ma Ma', 0),
(92, 54, 1, 'thantzinmoe893@gmail.com', '2025-03-05', '1PM', '3PM', 'မင်းတေဇ', 'ချောင်းခြောက်ဆိုးခြင်း', 1),
(38, 1, 2, 'thant@gmail.com', '2025-02-14', '2PM', '4PM', 'Thiha Zaw', 'Being crazy', 0),
(43, 1, 5, 'thantzinmoe893@gmail.com', '2025-02-27', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health', 0),
(94, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-01', '12PM', '2PM', 'Thant Zin Moe', 'Headache', 1),
(95, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-08', '12PM', '2PM', 'သီဟဇော်', 'ခေါင်းကိုက်', 2),
(96, 1, 5, 'thantzinmoe893@gmail.com', '2025-03-08', '12PM-2PM', '2PM', 'ရဲနန္ဒထက်', 'ခေါင်းကိုက်', 3),
(51, 4, 2, 'kohtet.ttan112@gmail.com', '2025-02-19', '10AM', '12PM', 'Ye Nanda Htet', 'Mental Health', 0),
(52, 2, 3, 'thantzinmoe@uit.edu.mm', '2025-02-18', '2PM', '4PM', 'Thant Zin Moe', 'Heart Attack', 0),
(53, 5, 1, 'kohtet.ttan112@gmail.com', '2025-02-19', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0),
(54, 4, 2, 'minthantzaw@uit.edu.mm', '2025-02-26', '10AM', '12PM', 'Min Thant Zaw', 'Mental Health', 0),
(56, 5, 1, 'kohtet.ttan112@gmail.com', '2025-02-23', '10AM', '12PM', 'Ye Nanda Htet', 'Mental Health', 0),
(57, 4, 2, 'thizazaw2@gmail.com', '2025-03-05', '10AM', '12PM', 'Thiha Zaw', 'Headache', 0),
(91, 58, 1, 'tmoe8123@gmail.com', '2025-03-07', '4PM', '6PM', 'သီဟဇော်', 'စော်မရ', 1),
(59, 5, 1, 'thantzinmoe893@gmail.com', '2025-02-26', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health', 0),
(61, 3, 2, 'yenandahtet@uit.edu.mm', '2025-02-24', '10AM', '12PM', 'ရဲန္ဒထက်', 'ဘေဘီပစ်ထားလို့', 0),
(62, 4, 6, 'thantzinmoe893@gmail.com', '2025-02-28', '9AM', '11AM', 'ရဲနန္ဒထက်', 'ဘေဘီပစ်ထားလို့', 0),
(97, 1, 5, 'ohmasan56@gmail.com', '2025-03-22', '12PM', '2PM', 'Kaung Myat Htet', 'Mental Health', 4),
(64, 5, 1, 'thantzinmoe893@gmail.com', '2025-02-28', '3PM', '5PM', 'Thant Zin Moe', 'Headache', 0),
(65, 5, 1, 'thantzinmoe893@gmail.com', '2025-03-03', '10AM', '12PM', 'သန့်ဇင်မိုး', 'ခေါင်းကိုက်', 0),
(66, 41, 5, 'thantzinmoe893@gmail.com', '2025-03-02', '1PM', '11PM', 'သန့်ဇင်မိုး', 'နှလုံးသားလေး ခံစားရ', 0),
(98, 36, 14, 'shwe104410441044@gmail.com', '2025-03-12', '4PM', '6PM', 'Shwe Shwe', 'nay ma kg', 1),
(99, 35, 2, 'shwe104410441044@gmail.com', '2025-03-27', '12PM', '2PM', 'hh', 'hh', 0),
(68, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Thiha Zaw', 'Mental Health', 1),
(69, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'Mental Health', 2),
(81, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'mental Health', 4),
(79, 2, 2, 'doctor@example.com', '2025-02-26', '4PM', '6PM', 'Kaung Myat Htet', 'Mental Health', 3),
(86, 41, 27, 'lwannuuwatt@gmail.com', '2025-03-02', '1PM', '3PM', 'ကောင်းမြတ်ထက်', 'နှလုံးသားလေး ခံစားရ', 0),
(88, 46, 20, 'zazawthz@gmail.com', '2025-03-02', '2PM', '4PM', 'ရဲနန္ဒထက်', 'စိတ်ဖောက်', 2),
(89, 41, 28, 'yenandahtet@uit.edu.mm', '2025-03-04', '3PM', '5PM', 'ရဲနန္ဒထက်', 'နှလုံးအမောဖောက်', 1),
(100, 18, 3, 'thantzinmoe893@gmail.com', '2025-03-07', '9AM', '11AM', 'သန့်ဇင်မိုး', 'ခေါင်းကိုက်', 0),
(101, 6, 23, 'thantzinmoe893@gmail.com', '2025-03-08', '10AM', '12PM', 'Thant Zin Moe', 'Headache', 1),
(104, 18, 3, 'yenandahtet@uit.edu.mm', '2025-03-07', '9AM', '11AM', 'Ye Nanda Htet', 'headache', 1),
(105, 67, 11, '86khinmarwai86@gmail.com', '2025-03-06', '2PM', '4PM', 'Daw Khin Mar Wai', 'Headache', 1),
(108, 67, 1, 'thantzinmoe893@gmail.com', '2025-03-05', '10AM', '12PM', 'Thant Zin Moe', 'Burn Out', 1),
(107, 65, 1, '86khinmarwai86@gmail.com', '2025-03-10', '9AM', '11AM', 'Daw Khin Mar Wai', 'Headache', 1),
(109, 68, 1, 'thantzinmoe893@gmail.com', '2025-03-06', '2PM', '4PM', 'Thant Zin Moe', 'Headache', 1),
(110, 70, 1, 'thantzinmoe893@gmail.com', '2025-03-10', '1PM', '3PM', 'Thant Zin Moe', 'Headache', 1),
(111, 69, 1, 'thantzinmoe893@gmail.com', '2025-03-07', '11AM', '1PM', 'Thant Zin Moe', 'Mental Health', 1),
(112, 93, 5, 'thantzinmoe@uit.edu.mm', '2025-03-10', '1PM', '3PM', 'မင်းသန့်ဇော်', 'ဆစ်ဂမာ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `job_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `credential` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('Male','Female','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `email`, `password`, `job_type`, `credential`, `gender`, `consultation_fee`, `profile`, `profile_image`, `experience`) VALUES
(65, 'ဒေါက်တာ ထွန်းမြင့်', 'htunmyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အထွေထွေရောဂါကု', 'MBBS, MD', 'Male', 30000.00, 'အထွေထွေရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-1.jpg', '15'),
(66, 'ဒေါက်တာ ကိုကို', 'koko-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နှလုံးဆရာဝန်', 'MBBS, MRCP', 'Male', 40000.00, 'နှလုံးရောဂါအထူးကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-2.jpg', '18'),
(67, 'ဒေါက်တာ မိုးဇင်', 'moezin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရိုးအကြောဆရာဝန်', 'MBBS, MS (Ortho)', 'Male', 44000.00, 'အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-3.jpg', '20'),
(68, 'ဒေါက်တာ နေထွန်း', 'naytun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Male', 32000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-4.jpg', '10'),
(69, 'ဒေါက်တာ မင်းသူ', 'minthu-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အသည်းနှင့်ဆေးပညာ', 'MBBS, MD (Gastro)', 'Male', 40000.00, 'အသည်းနှင့် အစာချေစနစ်ဆိုင်ရာ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-5.jpg', '17'),
(70, 'ဒေါက်တာ အောင်ကျော်', 'aungkyaw-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးချိုနှင့်သည်းနှလုံးဆရာဝန်', 'MBBS, MD (Endo)', 'Male', 30000.00, 'ဆီးချိုနှင့်သည်းနှလုံးရောဂါ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-6.jpg', '9'),
(71, 'ဒေါက်တာ ခင်မြင့်', 'khinmyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ပန်းနာအထူးကု', 'MBBS, DDV', 'Male', 32000.00, 'အရေပြားဆိုင်ရာပန်းနာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-7.jpg', '11'),
(72, 'ဒေါက်တာ ခင်မောင်', 'khinmaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးကြိတ်နှင့် ဆီးသွားစနစ်ဆရာဝန်', 'MBBS, MS (Uro)', 'Male', 35000.00, 'ဆီးကြိတ်နှင့် ဆီးသွားစနစ် အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-8.jpg', '13'),
(73, 'ဒေါက်တာ မိုးမိုး', 'moemoe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အသည်းနှင့် ဆေးပညာ', 'MBBS, DM (Hepato)', 'Male', 40000.00, 'အသည်းနှင့် ဆေးပညာဆိုင်ရာ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-9.jpg', '20'),
(74, 'ဒေါက်တာ တင်ထွန်း', 'tintun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'သွားနှင့် အမြှေးဆရာဝန်', 'BDS, MDS', 'Male', 44000.00, 'သွားနှင့် အမြှေးရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-10.jpg', '19'),
(75, 'ဒေါက်တာ ထွန်းအောင်', 'tunaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆရာဝန်', 'MBBS, MD (Pulmo)', 'Male', 35000.00, 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-11.jpg', '17'),
(76, 'ဒေါက်တာ ကိုထွန်း', 'kotun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရိုးအကြောဆရာဝန်', 'MBBS, MS (Ortho)', 'Male', 40000.00, 'အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-12.jpg', '25'),
(77, 'ဒေါက်တာ မိုးညို', 'moenyo-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရေးပေါ်ဆရာဝန်', 'MBBS, MD (Emerg)', 'Male', 30000.00, 'အရေးပေါ်ဆေးကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-13.jpg', '11'),
(78, 'ဒေါက်တာ စိုးမိုး', 'soemoe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ကင်ဆာဆရာဝန်', 'MBBS, DM (Onco)', 'Male', 40000.00, 'ကင်ဆာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-14.jpg', '15'),
(79, 'ဒေါက်တာ သန်းအောင်', 'thanaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'သွားနှင့် အမြှေးဆရာဝန်', 'BDS, MDS', 'Male', 35000.00, 'သွားနှင့် အမြှေးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-15.jpg', '10'),
(80, 'ဒေါက်တာ ခင်မောင်', 'khinmaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အမျိုးသမီးဆရာဝန်', 'MBBS, MD (Obst/Gyn)', 'Male', 32000.00, 'မီးယပ်နှင့် အမျိုးသမီးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-16.jpg', '12'),
(81, 'ဒေါက်တာ ထွန်းအောင်', 'tunaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးချိုနှင့်သည်းနှလုံးဆရာဝန်', 'MBBS, MD (Endo)', 'Male', 30000.00, 'ဆီးချိုနှင့်သည်းနှလုံးရောဂါ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-17.jpg', '9'),
(82, 'ဒေါက်တာ တင်ထွန်း', 'tintun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ပန်းနာအထူးကု', 'MBBS, DDV', 'Male', 40000.00, 'အရေပြားဆိုင်ရာပန်းနာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-18.jpg', '14'),
(83, 'ဒေါက်တာ မိုးသိင်္ဂ', 'moetheingi-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'စိတ်ကျန်းမာရေးဆရာဝန်', 'MBBS, MD (Psych)', 'Male', 32000.00, 'စိတ်ကျန်းမာရေးဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-19.jpg', '11'),
(84, 'ဒေါက်တာ မြင့်အောင်', 'myintaung-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နားနှင့် လျှာအထူးကု', 'MBBS, MS (ENT)', 'Male', 30000.00, 'နားနှင့် လျှာဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-20.jpg', '9'),
(85, 'ဒေါက်တာ ကိုကို', 'koko-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ကင်ဆာဆရာဝန်', 'MBBS, DM (Onco)', 'Male', 35000.00, 'ကင်ဆာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-21.jpg', '17'),
(86, 'ဒေါက်တာ သန်းထွန်း', 'thantun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အသည်းနှင့် ဆေးပညာ', 'MBBS, MD (Gastro)', 'Male', 44000.00, 'အသည်းနှင့် အစာချေစနစ်ဆိုင်ရာ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-22.jpg', '20'),
(87, 'ဒေါက်တာ မင်းထက်', 'minhtet-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရိုးအကြောဆရာဝန်', 'MBBS, MS (Ortho)', 'Male', 32000.00, 'အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-23.jpg', '12'),
(88, 'ဒေါက်တာ ခင်စိုး', 'khinsoe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'သွားနှင့် အမြှေးဆရာဝန်', 'BDS, MDS', 'Male', 30000.00, 'သွားနှင့် အမြှေးရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-24.jpg', '11'),
(89, 'ဒေါက်တာ ဇေယျာ', 'zeya-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Male', 40000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-25.jpg', '18'),
(90, 'ဒေါက်တာ ကိုသန်း', 'kothan-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆရာဝန်', 'MBBS, MD (Pulmo)', 'Male', 44000.00, 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-26.jpg', '22'),
(91, 'ဒေါက်တာ တင်စိုး', 'tinsoe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နားနှင့် လျှာအထူးကု', 'MBBS, MS (ENT)', 'Male', 30000.00, 'နားနှင့် လျှာဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-27.jpg', '9'),
(92, 'ဒေါက်တာ သူရိယရဲနိုင်', 'thuriya-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နှလုံးဆရာဝန်', 'MBBS, MRCP', 'Male', 40000.00, 'နှလုံးရောဂါအထူးကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-28.jpg', '18'),
(93, 'ဒေါက်တာ ဟန်သာထက်အောင်', 'hanthara-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရိုးအကြောဆရာဝန်', 'MBBS, MS (Ortho)', 'Male', 44000.00, 'အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-29.jpg', '20'),
(94, 'ဒေါက်တာ သန့်သီဟ', 'thantthiha-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Male', 35000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-30.jpg', '15'),
(95, 'ဒေါက်တာ ထက်ဝဏ္ဏ', 'htetwunna-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'မျက်စိအထူးကု', 'MBBS, MS (Ophthal)', 'Male', 30000.00, 'မျက်စိရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-31.jpg', '9'),
(96, 'ဒေါက်တာ သန့်ပြည့်စုံထူး', 'thantpyae-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အသည်းနှင့် ဆေးပညာ', 'MBBS, MD (Gastro)', 'Male', 40000.00, 'အသည်းနှင့် အစာချေစနစ်ဆိုင်ရာ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-32.jpg', '17'),
(97, 'ဒေါက်တာ သည်းနှင်းဇော်', 'theinnyunt-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးချိုနှင့်သည်းနှလုံးဆရာဝန်', 'MBBS, MD (Endo)', 'Male', 32000.00, 'ဆီးချိုနှင့်သည်းနှလုံးရောဂါ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-33.jpg', '10'),
(98, 'ဒေါက်တာ ဝင်းပြည့်သျှန်ထက်', 'winpyae-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ရုခိုးဆရာဝန်', 'MBBS, MD (Rehab)', 'Male', 35000.00, 'ရုခိုးဆေးပညာဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-34.jpg', '15'),
(99, 'ဒေါက်တာ ညွှန်းဝတီလွင်မြင့်', 'nyuntwati-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရေးပေါ်ဆရာဝန်', 'MBBS, MD (Emerg)', 'Male', 44000.00, 'အရေးပေါ်ဆေးကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor2-35.jpg', '21'),
(100, 'ဒေါက်တာ နန်းစန္ဒီ', 'nansandi-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ကလေးအထူးကု', 'MBBS, DCH', 'Female', 35000.00, 'ကလေးနဲ့ပတ်သက်သော ရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-1.jpg', '12'),
(101, 'ဒေါက်တာ သက်မြင့်', 'thetmyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'မျက်စိအထူးကု', 'MBBS, MS (Ophthal)', 'Female', 35000.00, 'မျက်စိရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-2.jpg', '8'),
(102, 'ဒေါက်တာ မေထွန်း', 'maytun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အမျိုးသမီးဆရာဝန်', 'MBBS, MD (Obst/Gyn)', 'Female', 44000.00, 'မီးယပ်နှင့် အမျိုးသမီးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-3.jpg', '22'),
(103, 'ဒေါက်တာ သန်းသန်း', 'thanthan-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'စိတ်ကျန်းမာရေးဆရာဝန်', 'MBBS, MD (Psych)', 'Female', 32000.00, 'စိတ်ကျန်းမာရေးကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-4.jpg', '15'),
(104, 'ဒေါက်တာ မြင့်မြင့်', 'myintmyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နားနှင့် လျှာအထူးကု', 'MBBS, MS (ENT)', 'Female', 30000.00, 'နားနှင့် လျှာဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-5.jpg', '12'),
(105, 'ဒေါက်တာ နန်းသက်', 'nanthet-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးချိုနှင့်သည်းနှလုံးဆရာဝန်', 'MBBS, MD (Endo)', 'Female', 44000.00, 'ဆီးချိုနှင့်သည်းနှလုံးရောဂါ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-6.jpg', '18'),
(106, 'ဒေါက်တာ ထင်ထင်', 'thinthin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ရုခိုးဆရာဝန်', 'MBBS, MD (Rehab)', 'Female', 32000.00, 'ရုခိုးဆေးပညာဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-7.jpg', '10'),
(107, 'ဒေါက်တာ နန်းမြင့်', 'nanmyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Female', 44000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-8.jpg', '22'),
(108, 'ဒေါက်တာ မေသန်း', 'maythan-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆရာဝန်', 'MBBS, MD (Pulmo)', 'Female', 35000.00, 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-9.jpg', '18'),
(109, 'ဒေါက်တာ နန်းထွေး', 'nantway-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ရုခိုးဆရာဝန်', 'MBBS, MD (Rehab)', 'Female', 44000.00, 'ရုခိုးဆေးပညာဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-10.jpg', '21'),
(110, 'ဒေါက်တာ မေမြင့်', 'maymyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'မျက်စိဆရာဝန်', 'MBBS, MS (Ophthal)', 'Female', 40000.00, 'မျက်စိရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-11.jpg', '15'),
(111, 'ဒေါက်တာ နွယ်နွယ်', 'nwenwe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အမျိုးသမီးဆရာဝန်', 'MBBS, MD (Obst/Gyn)', 'Female', 35000.00, 'မီးယပ်နှင့် အမျိုးသမီးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-12.jpg', '15'),
(112, 'ဒေါက်တာ မိုးမြင့်', 'moemyint-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'စိတ်ကျန်းမာရေးဆရာဝန်', 'MBBS, MD (Psych)', 'Female', 32000.00, 'စိတ်ကျန်းမာရေးကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-13.jpg', '10'),
(113, 'ဒေါက်တာ ဇွဲညီညာ', 'zweyinya-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အမျိုးသမီးဆရာဝန်', 'MBBS, MD (Obst/Gyn)', 'Female', 32000.00, 'မီးယပ်နှင့် အမျိုးသမီးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-14.jpg', '12'),
(114, 'ဒေါက်တာ ငယ်ရည်မွန်သွေး', 'ngaryimon-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရေပြားဆရာဝန်', 'MBBS, DDV', 'Female', 44000.00, 'အရေပြားဆိုင်ရာပန်းနာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-15.jpg', '22'),
(115, 'ဒေါက်တာ စောယွန်းနွယ်', 'sawyun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ပန်းနာအထူးကု', 'MBBS, DDV', 'Female', 40000.00, 'အရေပြားဆိုင်ရာပန်းနာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-16.jpg', '14'),
(116, 'ဒေါက်တာ ပြည့်မှူးရတီ', 'pyaemu-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'သွားနှင့် အမြှေးဆရာဝန်', 'BDS, MDS', 'Female', 30000.00, 'သွားနှင့် အမြှေးရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-17.jpg', '11'),
(117, 'ဒေါက်တာ အေးချမ်းမြေ့', 'ayechammyay-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'စိတ်ကျန်းမာရေးဆရာဝန်', 'MBBS, MD (Psych)', 'Female', 32000.00, 'စိတ်ကျန်းမာရေးကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-18.jpg', '10'),
(118, 'ဒေါက်တာ မိမိခိုင်', 'mimikhaing-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ကလေးအထူးကု', 'MBBS, DCH', 'Female', 35000.00, 'ကလေးနဲ့ပတ်သက်သော ရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-19.jpg', '12'),
(119, 'ဒေါက်တာ ခင်နှင်းဝေ', 'khinnwe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'မျက်စိအထူးကု', 'MBBS, MS (Ophthal)', 'Female', 40000.00, 'မျက်စိရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-20.jpg', '15'),
(120, 'ဒေါက်တာ စန္ဒာထွန်း', 'sandatun-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အမျိုးသမီးဆရာဝန်', 'MBBS, MD (Obst/Gyn)', 'Female', 44000.00, 'မီးယပ်နှင့် အမျိုးသမီးဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-21.jpg', '20'),
(121, 'ဒေါက်တာ နှင်းဝါဝင်း', 'nwewarwin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Female', 32000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-22.jpg', '10'),
(122, 'ဒေါက်တာ ဖြူဖြူသင်း', 'phyuphyuthin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နားနှင့် လျှာအထူးကု', 'MBBS, MS (ENT)', 'Female', 30000.00, 'နားနှင့် လျှာဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-23.jpg', '11'),
(123, 'ဒေါက်တာ မြတ်မွန်', 'myatmon-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ဆီးချိုနှင့်သည်းနှလုံးဆရာဝန်', 'MBBS, MD (Endo)', 'Female', 35000.00, 'ဆီးချိုနှင့်သည်းနှလုံးရောဂါ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-24.jpg', '14'),
(124, 'ဒေါက်တာ အိအိစန်', 'eieisan-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ရုခိုးဆရာဝန်', 'MBBS, MD (Rehab)', 'Female', 40000.00, 'ရုခိုးဆေးပညာဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-25.jpg', '16'),
(125, 'ဒေါက်တာ သဇင်နွယ်', 'thazin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆရာဝန်', 'MBBS, MD (Pulmo)', 'Female', 44000.00, 'လေဖြတ်ခြင်းနှင့် အဆုတ်ဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-26.jpg', '18'),
(126, 'ဒေါက်တာ ခင်မျိုးမြတ်', 'khinmyomyat-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ပန်းနာအထူးကု', 'MBBS, DDV', 'Female', 32000.00, 'အရေပြားဆိုင်ရာပန်းနာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-27.jpg', '12'),
(127, 'ဒေါက်တာ မြတ်နိုး', 'myatnoe-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'သွားနှင့် အမြှေးဆရာဝန်', 'BDS, MDS', 'Female', 30000.00, 'သွားနှင့် အမြှေးရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-28.jpg', '9'),
(128, 'ဒေါက်တာ ဝတ်မြတ်မွန်', 'watmyatmon-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရေးပေါ်ဆရာဝန်', 'MBBS, MD (Emerg)', 'Female', 35000.00, 'အရေးပေါ်ဆေးကု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-29.jpg', '13'),
(129, 'ဒေါက်တာ နှင်းဧဝရီ', 'nweeiwari-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'ကင်ဆာဆရာဝန်', 'MBBS, DM (Onco)', 'Female', 40000.00, 'ကင်ဆာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-30.jpg', '17'),
(130, 'ဒေါက်တာ မေသဥ္ဇာ', 'mayuizar-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အသည်းနှင့် ဆေးပညာ', 'MBBS, MD (Gastro)', 'Female', 44000.00, 'အသည်းနှင့် အစာချေစနစ်ဆိုင်ရာ အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-31.jpg', '20'),
(131, 'ဒေါက်တာ ခင်မြတ်မွန်', 'khinmyatmon-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အရိုးအကြောဆရာဝန်', 'MBBS, MS (Ortho)', 'Female', 32000.00, 'အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-32.jpg', '11'),
(132, 'ဒေါက်တာ သက်ထားဝေ', 'thettharway-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'အာရုံကြောဆရာဝန်', 'MBBS, DM (Neuro)', 'Female', 35000.00, 'အာရုံကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-33.jpg', '14'),
(133, 'ဒေါက်တာ ပြည့်ဖြိုးရှင်', 'pyaephyo-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'စိတ်ကျန်းမာရေးဆရာဝန်', 'MBBS, MD (Psych)', 'Female', 40000.00, 'စိတ်ကျန်းမာရေးကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-34.jpg', '16'),
(134, 'ဒေါက်တာ မြတ်သဇင်', 'myathazin-doctor@gmail.com', '$2y$10$zN5owSqNTjgFDIO9QwAMNeNhCLy/Gi.dRQ/bwHn8kDabF/JgE7XrO', 'နားနှင့် လျှာအထူးကု', 'MBBS, MS (ENT)', 'Female', 30000.00, 'နားနှင့် လျှာဆိုင်ရာ ကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်', 'doctor1-35.jpg', '12'),
(135, '‌ဒေါက်တာ ရဲနန္ဒထက်', 'yenanda-doctor@gmail.com', '$2y$10$5E2EYN5zc87zMrTj.WnUIubwKv27DSDbNCUCZYy3yb/K3LiEJZ4PK', 'နှလုံးဆရာဝန်', 'MBBS, MRCP', 'Male', 35000.00, 'နှလုံးရောဂါအထူးကု အတွေ့အကြုံရှိသော ဆရာဝန်', '/DAS/PHP/uploads/67c6b88a4f14f-doctor2-36.jpg', '6');

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
) ENGINE=InnoDB AUTO_INCREMENT=2523 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_hospital`
--

INSERT INTO `doctor_hospital` (`id`, `doctor_id`, `hospital_id`, `available_day`, `available_time`) VALUES
(2171, 65, 1, 'MON', '9AM-11AM'),
(2172, 66, 1, 'TUE', '1PM-3PM'),
(2173, 67, 1, 'WED', '10AM-12PM'),
(2174, 68, 1, 'THU', '2PM-4PM'),
(2175, 69, 1, 'FRI', '11AM-1PM'),
(2176, 70, 1, 'MON', '1PM-3PM'),
(2177, 71, 1, 'TUE', '9AM-11AM'),
(2178, 72, 2, 'MON', '2PM-4PM'),
(2179, 73, 2, 'TUE', '11AM-1PM'),
(2180, 74, 2, 'WED', '3PM-5PM'),
(2181, 75, 2, 'THU', '9AM-11AM'),
(2182, 76, 2, 'FRI', '1PM-3PM'),
(2183, 77, 2, 'MON', '11AM-1PM'),
(2184, 78, 2, 'TUE', '3PM-5PM'),
(2185, 79, 3, 'MON', '8AM-10AM'),
(2186, 80, 3, 'TUE', '12PM-2PM'),
(2187, 81, 3, 'WED', '2PM-4PM'),
(2188, 82, 3, 'THU', '10AM-12PM'),
(2189, 83, 3, 'FRI', '9AM-11AM'),
(2190, 84, 3, 'MON', '3PM-5PM'),
(2191, 85, 3, 'TUE', '8AM-10AM'),
(2192, 86, 4, 'MON', '12PM-2PM'),
(2193, 87, 4, 'TUE', '1PM-3PM'),
(2194, 88, 4, 'WED', '9AM-11AM'),
(2195, 89, 4, 'THU', '11AM-1PM'),
(2196, 90, 4, 'FRI', '2PM-4PM'),
(2197, 91, 4, 'MON', '10AM-12PM'),
(2198, 92, 4, 'TUE', '3PM-5PM'),
(2199, 93, 5, 'MON', '1PM-3PM'),
(2200, 94, 5, 'TUE', '9AM-11AM'),
(2201, 95, 5, 'WED', '8AM-10AM'),
(2202, 96, 5, 'THU', '12PM-2PM'),
(2203, 97, 5, 'FRI', '11AM-1PM'),
(2204, 98, 5, 'MON', '2PM-4PM'),
(2205, 99, 5, 'TUE', '10AM-12PM'),
(2206, 100, 6, 'MON', '9AM-11AM'),
(2207, 101, 6, 'TUE', '2PM-4PM'),
(2208, 102, 6, 'WED', '1PM-3PM'),
(2209, 103, 6, 'THU', '8AM-10AM'),
(2210, 104, 6, 'FRI', '3PM-5PM'),
(2211, 105, 6, 'MON', '11AM-1PM'),
(2212, 106, 6, 'TUE', '12PM-2PM'),
(2213, 107, 7, 'MON', '3PM-5PM'),
(2214, 108, 7, 'TUE', '11AM-1PM'),
(2215, 109, 7, 'WED', '9AM-11AM'),
(2216, 110, 7, 'THU', '1PM-3PM'),
(2217, 111, 7, 'FRI', '10AM-12PM'),
(2218, 112, 7, 'MON', '8AM-10AM'),
(2219, 113, 7, 'TUE', '2PM-4PM'),
(2220, 114, 8, 'MON', '12PM-2PM'),
(2221, 115, 8, 'TUE', '3PM-5PM'),
(2222, 116, 8, 'WED', '11AM-1PM'),
(2223, 117, 8, 'THU', '9AM-11AM'),
(2224, 118, 8, 'FRI', '1PM-3PM'),
(2225, 119, 8, 'MON', '1PM-3PM'),
(2226, 120, 8, 'TUE', '8AM-10AM'),
(2227, 121, 9, 'MON', '2PM-4PM'),
(2228, 122, 9, 'TUE', '10AM-12PM'),
(2229, 123, 9, 'WED', '3PM-5PM'),
(2230, 124, 9, 'THU', '11AM-1PM'),
(2231, 125, 9, 'FRI', '9AM-11AM'),
(2232, 126, 9, 'MON', '9AM-11AM'),
(2233, 127, 9, 'TUE', '1PM-3PM'),
(2234, 128, 10, 'MON', '11AM-1PM'),
(2235, 129, 10, 'TUE', '2PM-4PM'),
(2236, 130, 10, 'WED', '8AM-10AM'),
(2237, 131, 10, 'THU', '12PM-2PM'),
(2238, 132, 10, 'FRI', '3PM-5PM'),
(2239, 133, 10, 'MON', '10AM-12PM'),
(2240, 134, 10, 'TUE', '9AM-11AM'),
(2241, 65, 11, 'TUE', '1PM-3PM'),
(2242, 66, 11, 'WED', '10AM-12PM'),
(2243, 67, 11, 'THU', '2PM-4PM'),
(2244, 68, 11, 'FRI', '11AM-1PM'),
(2245, 69, 11, 'MON', '3PM-5PM'),
(2246, 70, 11, 'TUE', '8AM-10AM'),
(2247, 71, 11, 'WED', '2PM-4PM'),
(2248, 72, 12, 'TUE', '9AM-11AM'),
(2249, 73, 12, 'WED', '1PM-3PM'),
(2250, 74, 12, 'THU', '10AM-12PM'),
(2251, 75, 12, 'FRI', '2PM-4PM'),
(2252, 76, 12, 'MON', '8AM-10AM'),
(2253, 77, 12, 'TUE', '11AM-1PM'),
(2254, 78, 12, 'WED', '3PM-5PM'),
(2255, 79, 13, 'TUE', '12PM-2PM'),
(2256, 80, 13, 'WED', '9AM-11AM'),
(2257, 81, 13, 'THU', '1PM-3PM'),
(2258, 82, 13, 'FRI', '8AM-10AM'),
(2259, 83, 13, 'MON', '10AM-12PM'),
(2260, 84, 13, 'TUE', '2PM-4PM'),
(2261, 85, 13, 'WED', '11AM-1PM'),
(2262, 86, 14, 'TUE', '3PM-5PM'),
(2263, 87, 14, 'WED', '8AM-10AM'),
(2264, 88, 14, 'THU', '9AM-11AM'),
(2265, 89, 14, 'FRI', '1PM-3PM'),
(2266, 90, 14, 'MON', '11AM-1PM'),
(2267, 91, 14, 'TUE', '12PM-2PM'),
(2268, 92, 14, 'WED', '2PM-4PM'),
(2269, 93, 15, 'TUE', '10AM-12PM'),
(2270, 94, 15, 'WED', '1PM-3PM'),
(2271, 95, 15, 'THU', '11AM-1PM'),
(2272, 96, 15, 'FRI', '9AM-11AM'),
(2273, 97, 15, 'MON', '8AM-10AM'),
(2274, 98, 15, 'TUE', '3PM-5PM'),
(2275, 99, 15, 'WED', '12PM-2PM'),
(2276, 100, 16, 'TUE', '1PM-3PM'),
(2277, 101, 16, 'WED', '9AM-11AM'),
(2278, 102, 16, 'THU', '2PM-4PM'),
(2279, 103, 16, 'FRI', '10AM-12PM'),
(2280, 104, 16, 'MON', '12PM-2PM'),
(2281, 105, 16, 'TUE', '8AM-10AM'),
(2282, 106, 16, 'WED', '11AM-1PM'),
(2283, 107, 17, 'TUE', '9AM-11AM'),
(2284, 108, 17, 'WED', '3PM-5PM'),
(2285, 109, 17, 'THU', '8AM-10AM'),
(2286, 110, 17, 'FRI', '2PM-4PM'),
(2287, 111, 17, 'MON', '10AM-12PM'),
(2288, 112, 17, 'TUE', '1PM-3PM'),
(2289, 113, 17, 'WED', '12PM-2PM'),
(2290, 114, 18, 'TUE', '11AM-1PM'),
(2291, 115, 18, 'WED', '2PM-4PM'),
(2292, 116, 18, 'THU', '3PM-5PM'),
(2293, 117, 18, 'FRI', '8AM-10AM'),
(2294, 118, 18, 'MON', '9AM-11AM'),
(2295, 119, 18, 'TUE', '10AM-12PM'),
(2296, 120, 18, 'WED', '1PM-3PM'),
(2297, 121, 19, 'TUE', '12PM-2PM'),
(2298, 122, 19, 'WED', '8AM-10AM'),
(2299, 123, 19, 'THU', '1PM-3PM'),
(2300, 124, 19, 'FRI', '11AM-1PM'),
(2301, 125, 19, 'MON', '2PM-4PM'),
(2302, 126, 19, 'TUE', '3PM-5PM'),
(2303, 127, 19, 'WED', '9AM-11AM'),
(2304, 128, 20, 'TUE', '8AM-10AM'),
(2305, 129, 20, 'WED', '10AM-12PM'),
(2306, 130, 20, 'THU', '9AM-11AM'),
(2307, 131, 20, 'FRI', '1PM-3PM'),
(2308, 132, 20, 'MON', '11AM-1PM'),
(2309, 133, 20, 'TUE', '2PM-4PM'),
(2310, 134, 20, 'WED', '3PM-5PM'),
(2311, 65, 21, 'WED', '10AM-12PM'),
(2312, 66, 21, 'THU', '2PM-4PM'),
(2313, 67, 21, 'FRI', '11AM-1PM'),
(2314, 68, 21, 'MON', '1PM-3PM'),
(2315, 69, 21, 'TUE', '9AM-11AM'),
(2316, 70, 21, 'WED', '8AM-10AM'),
(2317, 71, 21, 'THU', '3PM-5PM'),
(2318, 72, 22, 'WED', '12PM-2PM'),
(2319, 73, 22, 'THU', '10AM-12PM'),
(2320, 74, 22, 'FRI', '9AM-11AM'),
(2321, 75, 22, 'MON', '2PM-4PM'),
(2322, 76, 22, 'TUE', '1PM-3PM'),
(2323, 77, 22, 'WED', '11AM-1PM'),
(2324, 78, 22, 'THU', '8AM-10AM'),
(2325, 79, 23, 'WED', '3PM-5PM'),
(2326, 80, 23, 'THU', '11AM-1PM'),
(2327, 81, 23, 'FRI', '2PM-4PM'),
(2328, 82, 23, 'MON', '9AM-11AM'),
(2329, 83, 23, 'TUE', '12PM-2PM'),
(2330, 84, 23, 'WED', '10AM-12PM'),
(2331, 85, 23, 'THU', '1PM-3PM'),
(2332, 86, 24, 'WED', '8AM-10AM'),
(2333, 87, 24, 'THU', '9AM-11AM'),
(2334, 88, 24, 'FRI', '3PM-5PM'),
(2335, 89, 24, 'MON', '12PM-2PM'),
(2336, 90, 24, 'TUE', '2PM-4PM'),
(2337, 91, 24, 'WED', '1PM-3PM'),
(2338, 92, 24, 'THU', '11AM-1PM'),
(2339, 93, 25, 'WED', '9AM-11AM'),
(2340, 94, 25, 'THU', '12PM-2PM'),
(2341, 95, 25, 'FRI', '10AM-12PM'),
(2342, 96, 25, 'MON', '1PM-3PM'),
(2343, 97, 25, 'TUE', '8AM-10AM'),
(2344, 98, 25, 'WED', '2PM-4PM'),
(2345, 99, 25, 'THU', '3PM-5PM'),
(2346, 100, 26, 'WED', '11AM-1PM'),
(2347, 101, 26, 'THU', '9AM-11AM'),
(2348, 102, 26, 'FRI', '1PM-3PM'),
(2349, 103, 26, 'MON', '2PM-4PM'),
(2350, 104, 26, 'TUE', '10AM-12PM'),
(2351, 105, 26, 'WED', '8AM-10AM'),
(2352, 106, 26, 'THU', '11AM-1PM'),
(2353, 107, 27, 'WED', '12PM-2PM'),
(2354, 108, 27, 'THU', '1PM-3PM'),
(2355, 109, 27, 'FRI', '9AM-11AM'),
(2356, 110, 27, 'MON', '3PM-5PM'),
(2357, 111, 27, 'TUE', '11AM-1PM'),
(2358, 112, 27, 'WED', '10AM-12PM'),
(2359, 113, 27, 'THU', '8AM-10AM'),
(2360, 114, 28, 'WED', '1PM-3PM'),
(2361, 115, 28, 'THU', '2PM-4PM'),
(2362, 116, 28, 'FRI', '11AM-1PM'),
(2363, 117, 28, 'MON', '8AM-10AM'),
(2364, 118, 28, 'TUE', '9AM-11AM'),
(2365, 119, 28, 'WED', '3PM-5PM'),
(2366, 120, 28, 'THU', '12PM-2PM'),
(2367, 121, 29, 'WED', '10AM-12PM'),
(2368, 122, 29, 'THU', '3PM-5PM'),
(2369, 123, 29, 'FRI', '2PM-4PM'),
(2370, 124, 29, 'MON', '1PM-3PM'),
(2371, 125, 29, 'TUE', '8AM-10AM'),
(2372, 126, 29, 'WED', '11AM-1PM'),
(2373, 127, 29, 'THU', '9AM-11AM'),
(2374, 128, 30, 'WED', '12PM-2PM'),
(2375, 129, 30, 'THU', '10AM-12PM'),
(2376, 130, 30, 'FRI', '8AM-10AM'),
(2377, 131, 30, 'MON', '9AM-11AM'),
(2378, 132, 30, 'TUE', '1PM-3PM'),
(2379, 133, 30, 'WED', '2PM-4PM'),
(2380, 134, 30, 'THU', '11AM-1PM'),
(2381, 65, 31, 'THU', '2PM-4PM'),
(2382, 66, 31, 'FRI', '11AM-1PM'),
(2383, 67, 31, 'MON', '8AM-10AM'),
(2384, 68, 31, 'TUE', '10AM-12PM'),
(2385, 69, 31, 'WED', '1PM-3PM'),
(2386, 70, 31, 'THU', '9AM-11AM'),
(2387, 71, 31, 'FRI', '3PM-5PM'),
(2388, 72, 32, 'THU', '1PM-3PM'),
(2389, 73, 32, 'FRI', '8AM-10AM'),
(2390, 74, 32, 'MON', '11AM-1PM'),
(2391, 75, 32, 'TUE', '12PM-2PM'),
(2392, 76, 32, 'WED', '9AM-11AM'),
(2393, 77, 32, 'THU', '3PM-5PM'),
(2394, 78, 32, 'FRI', '2PM-4PM'),
(2395, 79, 4, 'THU', '10AM-12PM'),
(2396, 80, 5, 'FRI', '11AM-1PM'),
(2397, 81, 6, 'MON', '2PM-4PM'),
(2398, 82, 7, 'TUE', '3PM-5PM'),
(2399, 83, 8, 'WED', '8AM-10AM'),
(2400, 84, 9, 'THU', '12PM-2PM'),
(2401, 85, 10, 'FRI', '1PM-3PM'),
(2402, 86, 11, 'MON', '9AM-11AM'),
(2403, 87, 12, 'TUE', '11AM-1PM'),
(2404, 88, 13, 'WED', '2PM-4PM'),
(2405, 89, 15, 'THU', '3PM-5PM'),
(2406, 90, 16, 'FRI', '8AM-10AM'),
(2407, 91, 17, 'MON', '1PM-3PM'),
(2408, 92, 18, 'TUE', '9AM-11AM'),
(2409, 93, 19, 'WED', '10AM-12PM'),
(2410, 94, 20, 'THU', '2PM-4PM'),
(2411, 95, 21, 'FRI', '9AM-11AM'),
(2412, 96, 22, 'MON', '11AM-1PM'),
(2413, 97, 23, 'TUE', '1PM-3PM'),
(2414, 98, 24, 'WED', '3PM-5PM'),
(2415, 99, 26, 'THU', '8AM-10AM'),
(2416, 100, 27, 'FRI', '2PM-4PM'),
(2417, 101, 28, 'MON', '10AM-12PM'),
(2418, 102, 29, 'TUE', '12PM-2PM'),
(2419, 103, 30, 'WED', '1PM-3PM'),
(2420, 104, 31, 'THU', '9AM-11AM'),
(2421, 105, 32, 'FRI', '11AM-1PM'),
(2422, 106, 1, 'MON', '3PM-5PM'),
(2423, 107, 2, 'TUE', '8AM-10AM'),
(2424, 108, 3, 'WED', '9AM-11AM'),
(2425, 109, 4, 'THU', '11AM-1PM'),
(2426, 110, 5, 'FRI', '1PM-3PM'),
(2427, 111, 6, 'MON', '12PM-2PM'),
(2428, 112, 8, 'TUE', '2PM-4PM'),
(2429, 113, 9, 'WED', '3PM-5PM'),
(2430, 114, 10, 'THU', '10AM-12PM'),
(2431, 115, 11, 'FRI', '9AM-11AM'),
(2432, 116, 12, 'MON', '1PM-3PM'),
(2433, 117, 13, 'TUE', '11AM-1PM'),
(2434, 118, 14, 'WED', '8AM-10AM'),
(2435, 119, 15, 'THU', '2PM-4PM'),
(2436, 120, 16, 'FRI', '3PM-5PM'),
(2437, 121, 17, 'MON', '9AM-11AM'),
(2438, 122, 18, 'TUE', '10AM-12PM'),
(2439, 123, 20, 'WED', '12PM-2PM'),
(2440, 124, 21, 'THU', '1PM-3PM'),
(2441, 125, 22, 'FRI', '8AM-10AM'),
(2442, 126, 23, 'MON', '11AM-1PM'),
(2443, 127, 24, 'TUE', '2PM-4PM'),
(2444, 128, 25, 'WED', '9AM-11AM'),
(2445, 129, 26, 'THU', '3PM-5PM'),
(2446, 130, 27, 'FRI', '11AM-1PM'),
(2447, 131, 28, 'MON', '2PM-4PM'),
(2448, 132, 29, 'TUE', '8AM-10AM'),
(2449, 133, 31, 'WED', '1PM-3PM'),
(2450, 134, 32, 'THU', '12PM-2PM'),
(2451, 65, 12, 'FRI', '3PM-5PM'),
(2452, 66, 13, 'MON', '11AM-1PM'),
(2453, 67, 14, 'TUE', '9AM-11AM'),
(2454, 68, 15, 'WED', '1PM-3PM'),
(2455, 69, 16, 'THU', '8AM-10AM'),
(2456, 70, 17, 'FRI', '2PM-4PM'),
(2457, 71, 18, 'MON', '12PM-2PM'),
(2458, 72, 19, 'TUE', '3PM-5PM'),
(2459, 73, 20, 'WED', '10AM-12PM'),
(2460, 74, 21, 'THU', '11AM-1PM'),
(2461, 75, 23, 'FRI', '1PM-3PM'),
(2462, 76, 24, 'MON', '9AM-11AM'),
(2463, 77, 25, 'TUE', '12PM-2PM'),
(2464, 78, 26, 'WED', '8AM-10AM'),
(2465, 79, 27, 'THU', '2PM-4PM'),
(2466, 80, 28, 'FRI', '9AM-11AM'),
(2467, 81, 29, 'MON', '10AM-12PM'),
(2468, 82, 30, 'TUE', '1PM-3PM'),
(2469, 83, 31, 'WED', '11AM-1PM'),
(2470, 84, 32, 'THU', '3PM-5PM'),
(2471, 85, 1, 'FRI', '2PM-4PM'),
(2472, 86, 2, 'MON', '8AM-10AM'),
(2473, 87, 3, 'TUE', '12PM-2PM'),
(2474, 88, 5, 'WED', '1PM-3PM'),
(2475, 89, 6, 'THU', '9AM-11AM'),
(2476, 90, 7, 'FRI', '10AM-12PM'),
(2477, 91, 8, 'MON', '2PM-4PM'),
(2478, 92, 9, 'TUE', '8AM-10AM'),
(2479, 93, 10, 'WED', '3PM-5PM'),
(2480, 94, 11, 'THU', '11AM-1PM'),
(2481, 95, 12, 'FRI', '1PM-3PM'),
(2482, 96, 13, 'MON', '9AM-11AM'),
(2483, 97, 14, 'TUE', '2PM-4PM'),
(2484, 98, 15, 'WED', '10AM-12PM'),
(2485, 99, 16, 'THU', '12PM-2PM'),
(2486, 100, 17, 'FRI', '8AM-10AM'),
(2487, 101, 18, 'MON', '1PM-3PM'),
(2488, 102, 19, 'TUE', '9AM-11AM'),
(2489, 103, 20, 'WED', '2PM-4PM'),
(2490, 104, 21, 'THU', '3PM-5PM'),
(2491, 105, 22, 'FRI', '11AM-1PM'),
(2492, 106, 23, 'MON', '10AM-12PM'),
(2493, 107, 24, 'TUE', '1PM-3PM'),
(2494, 108, 25, 'WED', '8AM-10AM'),
(2495, 109, 26, 'THU', '2PM-4PM'),
(2496, 110, 28, 'FRI', '9AM-11AM'),
(2497, 111, 29, 'MON', '11AM-1PM'),
(2498, 112, 30, 'TUE', '3PM-5PM'),
(2499, 113, 31, 'WED', '12PM-2PM'),
(2500, 114, 32, 'THU', '10AM-12PM'),
(2501, 115, 1, 'FRI', '1PM-3PM'),
(2502, 116, 2, 'MON', '9AM-11AM'),
(2503, 117, 3, 'TUE', '11AM-1PM'),
(2504, 118, 4, 'WED', '3PM-5PM'),
(2505, 119, 5, 'THU', '8AM-10AM'),
(2506, 120, 6, 'FRI', '2PM-4PM'),
(2507, 121, 7, 'MON', '10AM-12PM'),
(2508, 122, 8, 'TUE', '12PM-2PM'),
(2509, 123, 10, 'WED', '1PM-3PM'),
(2510, 124, 11, 'THU', '9AM-11AM'),
(2511, 125, 12, 'FRI', '3PM-5PM'),
(2512, 126, 13, 'MON', '11AM-1PM'),
(2513, 127, 14, 'TUE', '2PM-4PM'),
(2514, 128, 15, 'WED', '9AM-11AM'),
(2515, 129, 16, 'THU', '10AM-12PM'),
(2516, 130, 17, 'FRI', '1PM-3PM'),
(2517, 131, 18, 'MON', '8AM-10AM'),
(2518, 132, 19, 'TUE', '3PM-5PM'),
(2519, 133, 21, 'WED', '11AM-1PM'),
(2520, 134, 22, 'THU', '2PM-4PM'),
(2521, 135, 32, 'WED', '1PM-3PM'),
(2522, 135, 21, 'FRI', '3PM-5PM');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

DROP TABLE IF EXISTS `emergency_requests`;
CREATE TABLE IF NOT EXISTS `emergency_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `symptoms` text COLLATE utf8mb4_general_ci NOT NULL,
  `division` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `township` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `street` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hospital_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`id`, `patient_name`, `symptoms`, `division`, `township`, `street`, `latitude`, `longitude`, `submitted_at`, `hospital_id`) VALUES
(10, 'ngenge', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95930320, 96.13068040, '2025-03-03 14:24:50', 31),
(11, 'ngenge', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95930320, 96.13068040, '2025-03-03 14:27:19', 31),
(12, 'ngenge', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95930320, 96.13068040, '2025-03-03 14:27:28', 31),
(13, 'nge nge', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95929850, 96.13066960, '2025-03-03 14:28:08', 22),
(14, ' Ye Thiha Tun', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95929850, 96.13066960, '2025-03-03 14:28:55', 14),
(15, 'nge nge', 'Chest Pain', 'Yangon', 'Yangon City', 'Unknown Street', 16.95929850, 96.13066960, '2025-03-03 14:34:46', 32),
(16, 'Thant Zin Moe', 'chest pain', 'Yangon', 'Yangon City', 'Thamaing College Road', 16.85671088, 96.13044964, '2025-03-03 15:38:09', 26),
(17, 'Thant Zin Moe', 'Headache', 'Yangon', 'Yangon City', 'Parami Road', 16.85551491, 96.13518542, '2025-03-04 05:44:43', 1),
(18, 'Thant Zin Moe', 'Headache', 'Yangon', 'Yangon City', 'Parami Road', 16.85552352, 96.13518270, '2025-03-04 05:47:53', 32),
(19, 'Thant Zin Moe', 'chest pain', 'Yangon', 'Yangon City', 'Parami Road', 16.85551361, 96.13523590, '2025-03-04 07:18:26', 4),
(20, 'Kaung Myat Htet', 'chest pain', 'Yangon', 'Yangon City', 'Parami Road', 16.85552924, 96.13518557, '2025-03-04 07:19:13', 4);

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
  `profile_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `location`, `specialty`, `contact`, `rating`, `emergency_services`, `profile_image`) VALUES
(1, 'ရန်ကုန်အထွေထွေရောဂါကုဆေးရုံ', 'လသာ', 'အထွေထွေရောဂါကု', '၀၉-၁၂၃၄၅၆၇၈၉', 4.5, 1, 'hospital1.jpg'),
(2, 'သန်လျင်ဆေးရုံ', 'သန်လျင်', 'ကလေးအထူးကု', '၀၉-၉၈၇၆၅၄၃၂၁', 4.2, 1, 'hospital2.jpg'),
(3, 'ရွှေဂုံတိုင်အထူးကုဆေးရုံ', 'ဗဟန်', 'နှလုံးအထူးကု', '၀၉-၁၁၂၂၃၃၄၄၅၅', 4.7, 0, 'hospital3.jpg'),
(4, 'လှိုင်သာယာဆေးရုံ', 'လှိုင်သာယာ', 'အရိုးအကြောအထူးကု', '၀၉-၅၅၆၆၇၇၈၈၉၉', 4.3, 1, 'hospital4.jpg'),
(5, 'ဒဂုံဆေးရုံ', 'မြောက်ဒဂုံ', 'အာရုံကြောအထူးကု', '၀၉-၆၆၇၇၈၈၉၉၀၀', 4.6, 0, 'hospital5.jpg'),
(6, 'တောင်ဥက္ကလာဆေးရုံ', 'တောင်ဥက္ကလာ', 'မီးယပ်နှင့်မီးဖွားအထူးကု', '၀၉-၇၇၈၈၉၉၀၀၁၁', 4.1, 1, 'hospital6.jpg'),
(7, 'မြောက်ဥက္ကလာဆေးရုံ', 'မြောက်ဥက္ကလာ', 'အရေပြားအထူးကု', '၀၉-၈၈၉၉၀၀၁၁၂၂', 4.0, 0, 'hospital7.jpg'),
(8, 'အင်းစိန်ဆေးရုံ', 'အင်းစိန်', 'မျက်စိအထူးကု', '၀၉-၉၉၀၀၁၁၂၂၃၃', 4.8, 1, 'hospital8.jpg'),
(9, 'လသာဆေးရုံ', 'လသာ', 'စိတ်ရောဂါအထူးကု', '၀၉-၁၁၀၀၂၂၃၃၄၄', 4.2, 0, 'hospital9.jpg'),
(10, 'ဗဟန်းဆေးရုံ', 'ဗဟန်း', 'ဟော်မုန်းအထူးကု', '၀၉-၂၂၀၀၃၃၄၄၅၅', 4.5, 1, 'hospital10.jpg'),
(11, 'မင်္ဂလာဒုံဆေးရုံ', 'မင်္ဂလာဒုံ', 'ကျောက်ကပ်အထူးကု', '၀၉-၃၃၀၀၄၄၅၅၆၆', 4.1, 1, 'hospital11.jpg'),
(12, 'တောင်ဒဂုံဆေးရုံ', 'တောင်ဒဂုံ', 'အဆုတ်အထူးကု', '၀၉-၄၄၀၀၅၅၆၆၇၇', 4.3, 0, 'hospital12.jpg'),
(13, 'ဒဂုံမြို့သစ်ဆေးရုံ', 'အရှေ့ဒဂုံ', 'အဆစ်အမြစ်ရောင်ရောဂါအထူးကု', '၀၉-၅၅၀၀၆၆၇၇၈၈', 4.4, 1, 'hospital13.jpg'),
(14, 'ကျောက်တံတားဆေးရုံ', 'ကျောက်တံတား', 'သွေးအထူးကု', '၀၉-၆၆၀၀၇၇၈၈၉၉', 4.0, 1, 'hospital14.jpg'),
(15, 'မြောက်ဒဂုံဆေးရုံ', 'မြောက်ဒဂုံ', 'ကင်ဆာအထူးကု', '၀၉-၇၇၀၀၈၈၉၉၀၀', 4.7, 1, 'hospital15.jpg'),
(16, 'သင်္ဃန်းကျွန်းဆေးရုံ', 'သင်္ဃန်းကျွန်း', 'အစာအိမ်နှင့်အူလမ်းကြောင်းအထူးကု', '၀၉-၈၈၀၀၉၉၀၀၁၁', 4.6, 1, 'hospital16.jpg'),
(17, 'ပန်းဘဲတန်းဆေးရုံ', 'ပန်းဘဲတန်း', 'ပလတ်စတစ်ခွဲစိတ်ကု', '၀၉-၉၉၀၀၁၁၁၂၂', 4.5, 0, 'hospital17.jpg'),
(18, 'မရမ်းကုန်းဆေးရုံ', 'မရမ်းကုန်း', 'ကူးစက်ရောဂါအထူးကု', '၀၉-၁၀၁၁၂၂၂၃၃၃', 4.2, 1, 'hospital18.jpg'),
(19, 'ရန်ကင်းဆေးရုံ', 'ရန်ကင်း', 'ဆီးနှင့်မျိုးပွားအင်္ဂါအထူးကု', '၀၉-၁၁၂၂၃၃၄၄၄', 4.3, 0, 'hospital19.jpg'),
(20, 'လှိုင်ဆေးရုံ', 'လှိုင်', 'သက်ကြီးရွယ်အိုအထူးကု', '၀၉-၂၂၃၃၄၄၅၅၆၆', 4.0, 1, 'hospital20.jpg'),
(21, 'တောင်သူလယ်သမားဆေးရုံ', 'ဒလ', 'နာတာရှည်ရောဂါအထူးကု', '၀၉-၃၃၄၄၅၅၆၆၇၇', 4.1, 1, 'hospital21.jpg'),
(22, 'မင်္ဂလာတောင်ညွန့်ဆေးရုံ', 'မင်္ဂလာတောင်ညွန့်', 'ဓာတ်မတည့်ရောဂါနှင့်ကိုယ်ခံအားအထူးကု', '၀၉-၄၄၅၅၆၆၇၇၈၈', 4.4, 1, 'hospital22.jpg'),
(23, 'စမ်းချောင်းဆေးရုံ', 'စမ်းချောင်း', 'အားကစားဆိုင်ရာဆေးကု', '၀၉-၅၅၆၆၇၇၈၈၉၉', 4.2, 1, 'hospital23.jpg'),
(24, 'ဒေါပုံဆေးရုံ', 'ဒေါပုံ', 'နား၊ နှာခေါင်း၊ လည်ချောင်းအထူးကု', '၀၉-၆၆၇၇၈၈၉၉၀၀', 4.5, 0, 'hospital24.jpg'),
(25, 'သာကေတဆေးရုံ', 'သာကေတ', 'မေ့ဆေးအထူးကု', '၀၉-၇၇၈၈၉၉၀၀၁၁', 4.3, 1, 'hospital25.jpg'),
(26, 'လှိုင်မြို့သစ်ဆေးရုံ', 'လှိုင်မြို့သစ်', 'အရေးပေါ်ဆေးကု', '၀၉-၈၈၉၉၀၀၁၁၂၂', 4.6, 1, 'hospital26.jpg'),
(27, 'ရွှေပြည်သာဆေးရုံ', 'ရွှေပြည်သာ', 'ရောဂါဗေဒအထူးကု', '၀၉-၉၉၀၀၁၁၂၂၃၃', 4.0, 0, 'hospital27.jpg'),
(28, 'အလုံဆေးရုံ', 'အလုံ', 'ဓာတ်မှန်အထူးကု', '၀၉-၁၁၀၀၂၂၃၃၄၄', 4.7, 1, 'hospital28.jpg'),
(29, 'မင်္ဂလာတောင်ညွန့်ဆေးရုံ', 'မင်္ဂလာတောင်ညွန့်', 'သွားနှင့်ခံတွင်းအထူးကု', '၀၉-၂၂၀၀၃၃၄၄၅၅', 4.2, 0, 'hospital29.jpg'),
(30, 'ကမာရွတ်ဆေးရုံ', 'ကမာရွတ်', 'ကာယပြန်လည်သန်စွမ်းရေးအထူးကု', '၀၉-၃၃၀၀၄၄၅၅၆၆', 4.1, 1, 'hospital30.jpg'),
(31, 'Sakura', 'လသာ', 'အထွေထွေ', '၀၉-၁၂၃၄၅၆၇၈၉', 4.5, 1, 'hospital31.jpg'),
(32, 'စူးရှသစ်', 'လှိုင်မြို့နယ်', 'နှလုံးအထူးကု', '၀၉-၇၅၉၈၀၇၃၅၁', 4.0, 1, 'hospital32.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `doctor_id`, `hospital_id`, `useremail`, `appointment_date`, `appointment_start_time`, `appointment_end_time`, `patient_name`, `symptoms`) VALUES
(48, 1, 5, '', '2025-03-06', '11AM', '1PM', 'Thiha Zaw', 'Mental Health'),
(47, 1, 10, '', '2025-02-11', '3PM', '5PM', 'Ye Nanda Htet', 'Mental Health'),
(46, 1, 2, '', '2025-02-22', '2PM', '4PM', 'Thiha Zaw', 'Falling in love with Ma Ma'),
(45, 1, 2, '', '2025-02-15', '2PM', '4PM', 'Ye Nanda Htet', 'Plug Kyut'),
(44, 1, 5, '', '2025-02-20', '11AM', '1PM', 'Ye Nanda Htet', 'Mental Health'),
(43, 1, 7, '', '2025-02-17', '1PM', '3PM', 'Ye Nanda Htet', 'Mental Health'),
(41, 1, 7, '', '2025-02-13', '5PM', '7PM', 'Ye Nanda Htet', 'Mental Health'),
(42, 1, 5, '', '2025-02-27', '11AM', '1PM', 'Min Thant Zaw', 'Ma Ma lover'),
(49, 1, 2, '', '2025-02-15', '2PM', '4PM', 'Ye Nanda Htet', 'Plug Kyut'),
(50, 46, 20, '', '2025-03-02', '2PM', '4PM', 'သီဟဇော်', 'လိင်ပြောင်း'),
(51, 59, 32, '', '2025-03-06', '12PM', '2PM', 'Thant Zin Moe', 'အရိုးဆူး'),
(52, 59, 32, '', '2025-03-06', '12PM', '2PM', 'သန့်ဇင်မိုး', 'အရိုးစူး'),
(53, 41, 3, '', '2025-02-26', '2PM', '4PM', 'ကောင်းမြတ်ထက်', 'နှလုံးသားလေးနာကျင်');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `otp` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `profile_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `otp`, `status`, `date`, `profile_image`) VALUES
(86, 'Ye Thiha', 'yethihahtun1494@gmail.com', '$2y$10$uiNzHuwVNGiDKs/zZx6sB.Uhrrb7ARhhZK3sFsQHmq5PJZ1jVV0u.', 0, 'verified', '2025-02-24 14:42:13', '1740643896_1740404809_zay-yar-nang-khin-image.webp'),
(87, 'Ye Thiha', 'cookieplus69@gmail.com', '$2y$10$qf8UqdR004ndfeAhzmjyNel37KZdlDc/7Ypd85fa7fUAnoFbMWvrK', 0, 'verified', '2025-02-24 20:27:19', '1740640478_1740404790_Iconos gratuitos de Php diseñados por Freepik.jpg'),
(88, 'Nge Nge', 'ngeyeemon2005@gmail.com', '$2y$10$BxxZVdteHBbYwLUwREkGTuJnEOezcG1xY29T8H24JJN7cyRYj3Dc2', 866561, 'verified', '2025-02-25 10:08:53', '1740454933_photo_2025-02-25_10-12-02.jpg'),
(89, 'Kaung Myat Htet', 'thantzinmoe893@gmail.com', '$2y$10$nEK3OmcJtwAxImKyAOUj5uo4gTE1Px9IbgxvW/ZKuidnKxDSyP902', 0, 'verified', '2025-02-27 13:00:07', '1740891476_IMG_20250228_180845.jpg'),
(92, 'Thiha Zaw', 'zazawthz@gmail.com', '$2y$10$WfAGdK1dA/GSudAY3ZcimOYAma2Q.c79lCNF/sxWlBzx/gJVaISkS', 0, 'verified', '2025-02-27 23:07:11', NULL),
(93, 'Kaung Myat Htet', 'tmoe8123@gmail.com', '$2y$10$RsYKeWeyVXSKcO4.L1R5kuzRi9eq6YzC71HaRjTf8HGsELGXejUnG', 0, 'verified', '2025-02-28 17:50:42', '1740742739_IMG_20250228_180845.jpg'),
(94, 'Min Thant Zaw', 'thantzinmoe@uit.edu.mm', '$2y$10$a6Qa8iCQDKhY.JWOyErpB.5FgLzw7wy/cPKuP7tWka8cRZh/rp1Lm', 0, 'verified', '2025-02-28 22:24:07', '1740758636_photo_2025-02-28_22-33-28.jpg'),
(95, 'Khant Linn Htoo', 'ohmasan56@gmail.com', '$2y$10$9OJRm9/BPCm3WS5GivkZAOlP/SnjBgOKC5hkY69COLzzkEUH32.i6', 0, 'verified', '2025-02-28 22:35:11', '1740758831_photo_4_2025-02-27_21-09-27.jpg'),
(96, 'Thu Thu', 'thuzin1124@gmail.com', '$2y$10$9M7iyz29Bd8w7RYXVniwF.Q9ks7IP68u5zhSREHb/O4t2fH2a0xfG', 615513, 'unverified', '2025-03-03 09:36:20', NULL),
(97, 'Shwe Shwe', 'shwe104410441044@gmail.com', '$2y$10$zlUN0jGpdWMjEq3ULAZx8eF2FSgBTkeG6kYRqc8zgGXjWuf91zFZa', 0, 'verified', '2025-03-03 09:41:56', NULL),
(98, 'Ye Nanda Htet', 'yenandahtet@uit.edu.mm', '$2y$10$enwaTZ5rYfTcfenMm3QDZOeQCMFUz7lwSX5PHWQoHmNpk5lIgX.MO', 0, 'verified', '2025-03-04 02:02:39', '1741030644_IMG_20250227_145457_512.jpg'),
(99, 'Daw KhinMar Wai', '86khinmarwai86@gmail.com', '$2y$10$IrHnNHSQKGAJU.bkkMiCfe8Qi1e.hkQdO7inpbRk9DUM.1bEzikW2', 0, 'verified', '2025-03-04 12:22:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients` ADD FULLTEXT KEY `symptoms` (`symptoms`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD CONSTRAINT `emergency_requests_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
