-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 04:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(5) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `Email`, `Password`) VALUES
(0, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `num_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `test_paper_id` int(11) NOT NULL,
  `question_content` text NOT NULL,
  `right_answer` varchar(255) NOT NULL,
  `incorrect_answer1` varchar(255) NOT NULL,
  `incorrect_answer2` varchar(255) NOT NULL,
  `incorrect_answer3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `geo_quiz_results`
--

CREATE TABLE `geo_quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question1_answer` varchar(10) DEFAULT NULL,
  `question2_answer` varchar(10) DEFAULT NULL,
  `time_taken` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `geo_quiz_results`
--

INSERT INTO `geo_quiz_results` (`id`, `user_id`, `question1_answer`, `question2_answer`, `time_taken`, `created_at`) VALUES
(1, 90, 'Đà Nẵng', 'Biển Bắc', 3, '2024-10-20 11:33:54'),
(2, 90, 'Đà Nẵng', 'Biển Bắc', 3, '2024-10-20 11:33:57'),
(3, 90, 'Đà Nẵng', 'Biển Bắc', 3, '2024-10-20 11:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE `quest` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `change_type` varchar(255) NOT NULL,
  `request_time` datetime DEFAULT current_timestamp(),
  `appr` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`id`, `user_id`, `change_type`, `request_time`, `appr`) VALUES
(21, 92, 'Request QR Code Resend', '2024-10-26 14:30:12', 1),
(22, 92, 'Request QR Code Resend', '2024-10-26 14:42:01', 1),
(23, 92, 'Request QR Code Resend', '2024-10-26 14:42:21', 1),
(24, 92, 'Request QR Code Resend', '2024-10-26 14:42:34', 1),
(25, 93, 'Request QR Code Resend', '2024-10-26 14:48:20', 1),
(26, 93, 'Request QR Code Resend', '2024-10-26 14:48:22', 1),
(27, 93, 'Request QR Code Resend', '2024-10-26 14:49:26', 1),
(28, 93, 'Request QR Code Resend', '2024-10-26 18:22:18', 1),
(29, 93, 'Request QR Code Resend', '2024-10-26 18:22:55', 1),
(30, 93, 'Request QR Code Resend', '2024-10-26 18:23:53', 1),
(31, 93, 'Request QR Code Resend', '2024-10-26 18:23:59', 1),
(32, 93, 'Request QR Code Resend', '2024-10-26 18:24:18', 1),
(33, 93, 'Request QR Code Resend', '2024-10-26 18:40:21', 1),
(34, 93, 'Request QR Code Resend', '2024-10-26 18:44:12', 1),
(35, 93, 'Request QR Code Resend', '2024-10-26 18:44:53', 1),
(36, 93, 'Request QR Code Resend', '2024-10-26 18:50:57', 1),
(37, 93, 'Request QR Code Resend', '2024-10-26 18:51:11', 1),
(38, 93, 'Request QR Code Resend', '2024-10-26 19:08:06', 1),
(39, 93, 'Request QR Code Resend', '2024-10-26 19:09:15', 1),
(40, 93, 'Request QR Code Resend', '2024-10-26 19:09:18', 1),
(41, 93, 'Request QR Code Resend', '2024-10-26 19:15:55', 1),
(42, 93, 'Request QR Code Resend', '2024-10-26 19:16:06', 1),
(43, 93, 'Request QR Code Resend', '2024-10-26 19:16:57', 1),
(44, 93, 'Request QR Code Resend', '2024-10-26 19:22:05', 1),
(45, 93, 'Request QR Code Resend', '2024-10-26 19:27:53', 1),
(46, 93, 'Request QR Code Resend', '2024-10-26 20:02:24', 1),
(47, 93, 'Request QR Code Resend', '2024-10-26 20:05:30', 1),
(48, 93, 'Request QR Code Resend', '2024-10-26 20:09:08', 1),
(49, 93, 'Request QR Code Resend', '2024-10-26 20:11:14', 1),
(50, 93, 'Request QR Code Resend', '2024-10-26 20:50:54', 1),
(51, 93, 'Request QR Code Resend', '2024-10-26 20:52:23', 1),
(52, 93, 'Request QR Code Resend', '2024-10-26 21:06:24', 1),
(53, 93, 'Request QR Code Resend', '2024-10-26 21:07:34', 1),
(54, 93, 'Request QR Code Resend', '2024-10-27 00:28:19', 1),
(55, 93, 'Request QR Code Resend', '2024-10-27 01:25:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(6) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES
(11, '1+2=?', '3', '5', '6', '8', '1'),
(14, 'Ai là người đẹp trai nhất thế giới ?', 'Quân', 'Minh', 'Huy', 'Trung', '1'),
(18, '3+5=?', '123', '23', '8', '2', '3'),
(19, '10+5=?', '11', '12', '31', '15', '4'),
(20, '1=4', 's', 'd', 'y', 'n', '1');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_history`
--

CREATE TABLE `quiz_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `date_taken` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_history`
--

INSERT INTO `quiz_history` (`id`, `user_id`, `subject`, `score`, `date_taken`) VALUES
(1, 50, 'TOÁN', 3, '2024-10-08 13:30:45'),
(2, 50, 'TOÁN', 4, '2024-10-08 13:34:46'),
(3, 47, 'TOÁN', 2, '2024-10-08 13:50:58'),
(4, 47, 'TOÁN', 2, '2024-10-08 13:51:17'),
(5, 51, 'TOÁN', 0, '2024-10-08 14:05:41'),
(6, 51, 'TOÁN', 3, '2024-10-08 14:11:47'),
(7, 52, 'TOÁN', 3, '2024-10-11 03:06:15'),
(8, 52, 'TOÁN', 3, '2024-10-11 03:12:43'),
(9, 53, 'TOÁN', 2, '2024-10-11 07:39:46'),
(10, 51, 'TOÁN', 5, '2024-10-11 09:09:06'),
(11, 51, 'TOÁN', 5, '2024-10-11 09:11:08'),
(12, 50, 'TOÁN', 2, '2024-10-11 09:12:48'),
(13, 63, 'TOÁN', 4, '2024-10-11 09:54:51'),
(14, 65, 'TOÁN', 3, '2024-10-11 10:48:36'),
(15, 50, 'TOÁN', 4, '2024-10-13 06:29:59'),
(16, 73, 'TOÁN', 3, '2024-10-17 13:30:09'),
(17, 89, 'TOÁN', 3, '2024-10-18 07:21:52'),
(18, 90, 'TOÁN', 0, '2024-10-20 13:11:34'),
(19, 90, 'TOÁN', 2, '2024-10-20 13:38:23'),
(20, 90, 'TOÁN', 3, '2024-10-20 13:38:56'),
(21, 90, 'TOÁN', 1, '2024-10-21 10:33:27'),
(22, 93, 'TOÁN', 2, '2024-10-26 09:45:44'),
(23, 93, 'TOÁN', 3, '2024-10-26 16:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `test_papers`
--

CREATE TABLE `test_papers` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `total_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `CCCD` int(11) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `Req` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `CCCD`, `Age`, `Password`, `otp`, `Req`) VALUES
(47, 'Lux', '123123@gmail.com', 123, 23123, '$2y$10$fegyAtJlQmJZunM9M/f79OAw/YAXNCfQwSP4Qien62X/y98MVhKNS', '079203013976||ﾄ進nh Kh盻殃 Minh|14122003|Nam|27/34B, Đường Huỳnh Tịnh Của, TDP 35, Khu Phố 9, Võ Thị Sáu, Quận 3, TP. Hồ Chí Minh|11012023', 0),
(50, 'Quan@1236789000', '0000000@gmail.com', 123456789, 23, '$2y$10$7.TELA0EwFrz4mOK.uU4ku0KieeayyPQAi8PKSX.bDZl50N1evG1e', '', 0),
(51, 'Warwick123', '66@gmail.com', 123, 233, '$2y$10$mTTi3ksBSpHXkPswWy.w.OsS4Vua2ErTdbN5QZ2UArvMghD2knYo2', '', 0),
(52, 'MInh', '567@gmail.com', 1234, 23, '123', '', 0),
(53, 'Quan', '123@gmail.com', 23123123, 23, '123', '', 0),
(63, 'Sivir', '00000@gmail.com', 123, 23, '123', '', 0),
(65, 'QUan1234', '999@gmail.com', 123, 20, '123', '', 0),
(71, '12345', '1234@gmail.com', 123, 23, '$2y$10$m9boiE40Hq0BW3WX4xp2o.auuzVTaIXPSQHeUoqRKab.c8CX3A/0G', '', 0),
(73, 'asd', 'asd@gmail.com', 23123, 23, '$2y$10$.qQDOhFXKgLwFFZMjNGQ5OpbScshS6wzsm4M9/etcX1mK8G1EMPDC', '', 0),
(76, 'S123@gmail.com', 'S123@gmail.com', 12, 12, '$2y$10$n//5yTGKgy04JaDGC20FiuU3GhQjo0lI26yIIy55B2/W2Cm/JPhsy', '', 0),
(77, 'D123@gmail.com', 'D123@gmail.com', 12, 12, '$2y$10$pDKZ6cz78JXVfOVB2VM73Oy9k4jwnZi8eUwhOqMwq4KzplGIgx8ia', '', 0),
(78, 'tyu', 'tyu@gmail.com', 123, 23, '$2y$10$sgAx2awgq3OdaL6LGBRE.uoJYb7/k9VmF8zleHnxtOrVy/bUrLQMq', '', 0),
(79, 'Z123@gmail.com', 'Z123@gmail.com', 12, 12, '$2y$10$UkKxitbY6omdF2qW9t3KIetOtJpseUsD7Pueep1rsgNZ5/EKHZyAO', '', 0),
(85, 'R@gmail.com', 'R@gmail.com', 12, 12, '$2y$10$wQgQduDpoyrjjPfRHB9LUuWOF.ePVp2jk7eDFMVOwlmeeWgJpUURi', '903050', 0),
(86, 'jkl', 'jkl@gmail.com', 123, 23, '$2y$10$QIW2vV91v.Z4UO2wQK1fPu6RDqBELzxTOqjDW0dEXwsYCdFoCJ9Dq', '926693', 0),
(89, 'MInh12345', 'Minh123@gmail.com', 123, 23, '$2y$10$NBohIUwGCqozlv2jybvll.bSS3166WnEgRpmpfBtxHz0aFQT/vsqe', '191890', 0),
(90, 'cvb333e', 'cvb@gmail.com', 123124, 23455, '$2y$10$uCBAhWOJdVm/iyL51FsDdOdeNkqI75ZCO1zNxi5oznRqD0HCetycO', '178665', 0),
(91, 'fgh', 'fgh@gmail.com', 12345, 23, '$2y$10$ljdU4UEoORp9e8Exn9oFTe2VwEnh7IpiwfRrB4VCdpLfstimKUEvy', '829228', 0),
(92, 'Q123@gmail.com', 'Q123@gmail.com', 12, 13, '$2y$10$bgbCNsJAXd54Fl.K4WA0R.mWGBD1mRVPZJanAnrUJaobIYzEGcvBS', NULL, 0),
(93, 'O123@gmail.com', 'O123@gmail.com', 12, 12, '$2y$10$ebGlaAaXBqRN9alT6p9QpuJFrdf31hEMVvG2r1Kx/RRPdlrlDk9o2', 'c2JTbHAxUFpIS0JxdlZsakI1cjRtV2JJU0M1ZGdGU3hiTkwwWUlTK2M2WjNOcVB4bjFzWXM1c0M0ZmRKS1VWL3VkeCtFbWFVNzh3cXZKNDRSTlNaVzY2cHNONkZKZHNXYzhGck5EMVRuem1ZKzM3RDM3ZEhSYUlNWjZNUmxuTXpsMjRFMmc2M2pnakQxZVl5dlc5d3pQeGNMUEtBbVd1dzZ4YXNJc3kxU013b1liZE5hcmhidmVLQzhXcjA2Tzd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_changes`
--

CREATE TABLE `user_changes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `change_type` varchar(255) DEFAULT NULL,
  `old_value` varchar(255) DEFAULT NULL,
  `new_value` varchar(255) DEFAULT NULL,
  `change_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_changes`
--

INSERT INTO `user_changes` (`id`, `user_id`, `change_type`, `old_value`, `new_value`, `change_time`) VALUES
(1, 50, 'username', 'Lux123568', 'Lux1235689', '2024-10-13 04:41:11'),
(2, 50, 'email', 'ggggg@gmail.com', 'gggggg@gmail.com', '2024-10-13 04:41:11'),
(3, 50, 'cccd', '123', '1234444', '2024-10-13 04:41:33'),
(4, 50, 'age', '23', '23222', '2024-10-13 04:41:49'),
(5, 50, 'username', 'Lux1235689', 'Quan@123', '2024-10-13 04:43:46'),
(6, 50, 'email', 'gggggg@gmail.com', '0000000@gmail.com', '2024-10-13 04:43:46'),
(7, 50, 'age', '23222', '23', '2024-10-13 04:43:46'),
(8, 50, 'cccd', '1234444', '123456789', '2024-10-13 04:43:46'),
(9, 50, 'username', 'Quan@123', 'Quan@1236', '2024-10-13 04:44:54'),
(10, 50, 'username', 'Quan@1236', 'Quan@12367', '2024-10-13 04:46:06'),
(11, 50, 'username', 'Quan@12367', 'Quan@123678', '2024-10-13 04:46:31'),
(12, 50, 'username', 'Quan@123678', 'Quan@1236789', '2024-10-13 04:47:39'),
(13, 50, 'username', 'Quan@1236789', 'Quan@12367890', '2024-10-13 04:49:32'),
(14, 50, 'username', 'Quan@12367890', 'Quan@1236789000', '2024-10-13 04:50:03'),
(15, 51, 'age', '23', '233', '2024-10-14 05:12:06'),
(16, 71, 'username', '1234', '12345', '2024-10-14 14:09:38'),
(17, 89, 'username', 'MInh123', 'MInh12345', '2024-10-18 05:26:42'),
(18, 90, 'age', '23', '234', '2024-10-21 08:31:02'),
(19, 90, 'username', 'cvb', 'cvb333e', '2024-10-21 08:34:19'),
(20, 90, 'age', '234', '23455', '2024-10-21 08:34:19'),
(21, 92, 'age', '12', '13', '2024-10-26 01:33:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_paper_id` (`test_paper_id`);

--
-- Indexes for table `geo_quiz_results`
--
ALTER TABLE `geo_quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_history`
--
ALTER TABLE `quiz_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_papers`
--
ALTER TABLE `test_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_changes`
--
ALTER TABLE `user_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `geo_quiz_results`
--
ALTER TABLE `geo_quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quest`
--
ALTER TABLE `quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quiz_history`
--
ALTER TABLE `quiz_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `test_papers`
--
ALTER TABLE `test_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user_changes`
--
ALTER TABLE `user_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`test_paper_id`) REFERENCES `test_papers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `geo_quiz_results`
--
ALTER TABLE `geo_quiz_results`
  ADD CONSTRAINT `geo_quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `quiz_history`
--
ALTER TABLE `quiz_history`
  ADD CONSTRAINT `quiz_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `user_changes`
--
ALTER TABLE `user_changes`
  ADD CONSTRAINT `user_changes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
