-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 03:28 PM
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
-- Database: `neosantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_tokens`
--

CREATE TABLE `student_tokens` (
  `id` int(11) NOT NULL,
  `token_value` varchar(30) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tokens`
--

INSERT INTO `student_tokens` (`id`, `token_value`, `generated_at`) VALUES
(1, '6387', '2023-12-28 07:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tokens`
--

CREATE TABLE `teacher_tokens` (
  `id` int(11) NOT NULL,
  `token_value` varchar(30) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_tokens`
--

INSERT INTO `teacher_tokens` (`id`, `token_value`, `generated_at`) VALUES
(1, '8623', '2023-12-28 07:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `_absent`
--

CREATE TABLE `_absent` (
  `pkabsent` int(11) NOT NULL,
  `_pkstu` int(11) DEFAULT NULL,
  `_pkcls` int(11) DEFAULT NULL,
  `_date` date DEFAULT NULL,
  `_timeIn` time DEFAULT NULL,
  `_timeOut` time DEFAULT NULL,
  `_pict` blob DEFAULT NULL,
  `_infoIn` varchar(255) DEFAULT NULL,
  `_infoOut` varchar(255) DEFAULT NULL,
  `_latitude` varchar(25) DEFAULT NULL,
  `_longitude` varchar(25) DEFAULT NULL,
  `_imgIn` varchar(255) DEFAULT NULL,
  `_imgOut` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_absent`
--

INSERT INTO `_absent` (`pkabsent`, `_pkstu`, `_pkcls`, `_date`, `_timeIn`, `_timeOut`, `_pict`, `_infoIn`, `_infoOut`, `_latitude`, `_longitude`, `_imgIn`, `_imgOut`) VALUES
(120, 3, 1, '2024-05-03', '14:38:20', '14:40:00', NULL, 'I', 'I', '-6.2062592', '106.8302336', '../assets/absent/img_in/absent_yusya_1714721900.png', '../assets/absent/img_out/absent_yusya_1714722000.png'),
(121, 3, 1, '2024-05-04', '00:04:40', '00:05:00', NULL, 'M', 'M', '-6.2521344', '106.7122688', '../assets/absent/img_in/absent_yusya_1714755880.png', '../assets/absent/img_out/absent_yusya_1714755900.png'),
(122, 2, 1, '2024-05-04', '00:45:36', '00:47:00', NULL, 'B', 'B', '-6.2521344', '106.7122688', '../assets/absent/img_in/absent_gif_1714758336.png', '../assets/absent/img_out/absent_gif_1714758420.png'),
(123, 5, 1, '2024-05-04', '00:57:19', '00:57:48', NULL, 'I', 'I', '-6.0727393', '106.0922215', '../assets/absent/img_in/absent_nafil_1714759039.png', '../assets/absent/img_out/absent_nafil_1714759068.png'),
(124, 6, 1, '2024-05-04', '18:57:29', '18:59:23', NULL, 'P', 'I', '-6.2521344', '106.7122688', '../assets/absent/img_in/absent_exa mendoza_1714823849.png', '../assets/absent/img_out/absent_exa mendoza_1714823963.png'),
(125, 3, 1, '2024-05-05', '06:14:35', '06:14:50', NULL, 'B', 'B', '-6.1701796', '106.6403236', '../assets/absent/img_in/absent_yusya_1714864475.png', '../assets/absent/img_out/absent_yusya_1714864490.png'),
(126, 2, 1, '2024-05-07', '09:44:03', '09:44:21', NULL, 'B', 'B', '-6.2205084', '106.9384127', '../assets/absent/img_in/absent_gif_1715049843.png', '../assets/absent/img_out/absent_gif_1715049861.png'),
(127, 3, 1, '2024-05-07', '10:38:36', '10:38:57', NULL, 'I', 'I', '-6.2203548', '106.9384506', '../assets/absent/img_in/absent_yusya_1715053116.png', '../assets/absent/img_out/absent_yusya_1715053137.png'),
(128, 7, 1, '2024-05-08', '08:15:01', '08:15:16', NULL, 'M', 'M', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_kyy_1715130901.png', '../assets/absent/img_out/absent_kyy_1715130916.png'),
(129, 2, 1, '2024-05-08', '08:54:36', '08:54:50', NULL, 'B', 'B', '-6.2203548', '106.9384488', '../assets/absent/img_in/absent_gif_1715133276.png', '../assets/absent/img_out/absent_gif_1715133290.png'),
(130, 3, 1, '2024-05-08', '08:55:25', '08:57:00', NULL, 'C', 'C', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1715133325.png', '../assets/absent/img_out/absent_yusya_1715133420.png'),
(131, 5, 1, '2024-05-08', '08:58:19', '08:58:34', NULL, 'F', 'F', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_nafil_1715133499.png', '../assets/absent/img_out/absent_nafil_1715133514.png'),
(132, 1, 1, '2024-05-08', '08:59:44', '08:59:56', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_dev_1715133584.png', '../assets/absent/img_out/absent_dev_1715133596.png'),
(133, 4, 1, '2024-05-08', '09:00:30', '09:00:44', NULL, 'S', 'S', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_sulthony_1715133630.png', '../assets/absent/img_out/absent_sulthony_1715133644.png'),
(134, 6, 1, '2024-05-08', '09:01:39', '09:01:48', NULL, 'P', 'P', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_exa mendoza_1715133699.png', '../assets/absent/img_out/absent_exa mendoza_1715133708.png'),
(135, 3, 1, '2024-05-09', '22:15:10', '22:15:20', NULL, 'I', 'I', '-6.2062592', '106.8302336', '../assets/absent/img_in/absent_yusya_1715267710.png', '../assets/absent/img_out/absent_yusya_1715267720.png'),
(136, 3, 1, '2024-05-14', '11:16:19', '11:16:29', NULL, 'I', 'I', '-6.22592', '106.8761088', '../assets/absent/img_in/absent_yusya_1715660179.png', '../assets/absent/img_out/absent_yusya_1715660189.png'),
(137, 3, 1, '2024-05-15', '07:09:30', '07:09:50', NULL, 'I', 'I', '-6.2234748', '106.9476776', '../assets/absent/img_in/absent_yusya_1715731770.png', '../assets/absent/img_out/absent_yusya_1715731790.png'),
(138, 3, 1, '2024-05-16', '18:42:36', '18:42:44', NULL, 'I', 'I', '-6.209536', '106.8302336', '../assets/absent/img_in/absent_yusya_1715859756.png', '../assets/absent/img_out/absent_yusya_1715859764.png'),
(139, 3, 1, '2024-05-21', '12:38:33', '12:38:47', NULL, 'I', 'I', '-6.22592', '106.8302336', '../assets/absent/img_in/absent_yusya_1716269913.png', '../assets/absent/img_out/absent_yusya_1716269927.png'),
(140, 3, 1, '2024-05-25', '23:10:20', '23:13:16', NULL, 'I', 'I', '-6.1701796', '106.6403236', '../assets/absent/img_in/absent_yusya_1716653420.png', '../assets/absent/img_out/absent_yusya_1716653596.png'),
(141, 2, 1, '2024-05-25', '23:12:36', '23:12:53', NULL, 'I', 'I', '-6.2132363', '106.9225286', '../assets/absent/img_in/absent_gif_1716653556.png', '../assets/absent/img_out/absent_gif_1716653573.png'),
(142, 3, 1, '2024-05-27', '08:54:54', '08:55:16', NULL, 'I', 'I', '-6.2062592', '106.8531712', '../assets/absent/img_in/absent_yusya_1716774894.png', '../assets/absent/img_out/absent_yusya_1716774916.png'),
(143, 3, 1, '2024-05-28', '17:24:44', '17:24:52', NULL, 'I', 'I', '-6.2062592', '106.8302336', '../assets/absent/img_in/absent_yusya_1716891884.png', '../assets/absent/img_out/absent_yusya_1716891892.png'),
(144, 3, 1, '2024-05-30', '16:27:08', '16:27:18', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717061228.png', '../assets/absent/img_out/absent_yusya_1717061238.png'),
(145, 3, 1, '2024-05-01', '10:25:38', '10:25:58', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717212338.png', '../assets/absent/img_out/absent_yusya_1717212358.png'),
(146, 3, 1, '2024-06-01', '10:29:54', '10:30:03', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717212594.png', '../assets/absent/img_out/absent_yusya_1717212603.png'),
(147, 3, 1, '2024-06-03', '22:23:05', '22:23:25', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717428185.png', '../assets/absent/img_out/absent_yusya_1717428205.png'),
(148, 3, 1, '2024-06-03', '12:35:45', '12:36:14', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717479345.png', '../assets/absent/img_out/absent_yusya_1717479374.png'),
(149, 3, 1, '2024-06-04', '13:10:19', '13:10:35', NULL, 'I', 'I', '-6.22592', '106.8531712', '../assets/absent/img_in/absent_yusya_1717481419.png', '../assets/absent/img_out/absent_yusya_1717481435.png'),
(150, 1, 1, '2024-06-06', '13:01:49', '13:01:57', NULL, 'I', 'I', '-6.22592', '106.8302336', '../assets/absent/img_in/absent_dev_1717653709.png', '../assets/absent/img_out/absent_dev_1717653717.png'),
(151, 1, 1, '2024-06-07', '21:55:39', '21:56:00', NULL, 'I', 'I', '-6.2062592', '106.8531712', '../assets/absent/img_in/absent_dev_1717772139.png', '../assets/absent/img_out/absent_dev_1717772160.png'),
(152, 1, 1, '2024-06-08', '21:41:32', '21:41:40', NULL, 'I', 'I', '-6.2062592', '106.8531712', '../assets/absent/img_in/absent_dev_1717857692.png', '../assets/absent/img_out/absent_dev_1717857700.png'),
(153, 1, 1, '2024-06-09', '10:13:53', '10:14:01', NULL, 'I', 'I', '-6.2554112', '106.889216', '../assets/absent/img_in/absent_dev_1717902833.png', '../assets/absent/img_out/absent_dev_1717902841.png'),
(154, 2, 1, '2024-06-09', '10:14:35', '10:14:42', NULL, 'I', 'I', '-6.2554112', '106.889216', '../assets/absent/img_in/absent_gif_1717902875.png', '../assets/absent/img_out/absent_gif_1717902882.png'),
(156, 4, 1, '2024-06-09', '10:17:30', '10:17:38', NULL, 'I', 'I', '-6.2554112', '106.889216', '../assets/absent/img_in/absent_sulthony_1717903050.png', '../assets/absent/img_out/absent_sulthony_1717903058.png'),
(157, 3, 1, '2024-06-09', '10:20:36', '10:20:45', NULL, 'I', 'I', '-6.2554112', '106.889216', '../assets/absent/img_in/absent_yusya_1717903236.png', '../assets/absent/img_out/absent_yusya_1717903245.png'),
(158, 3, 1, '2024-06-15', '08:10:43', '08:10:55', NULL, 'I', 'I', '-6.1701796', '106.6403236', '../assets/absent/img_in/absent_yusya_1718413843.png', '../assets/absent/img_out/absent_yusya_1718413855.png'),
(159, 1, 1, '2024-06-21', '22:59:30', '23:33:29', NULL, 'I', 'I', '-6.2132059', '106.9225022', '../assets/absent/img_in/absent_dev_1718985570.png', '../assets/absent/img_out/absent_dev_1718987609.png'),
(162, 1, 1, '2024-06-22', '22:25:40', '22:25:49', NULL, 'I', 'I', '-6.8067845', '105.8855021', '../assets/absent/img_in/absent_dev_1719069940.png', '../assets/absent/img_out/absent_dev_1719069949.png'),
(163, 1, 1, '2024-09-30', '10:30:37', NULL, NULL, 'S', NULL, '-6.2204886', '106.938357', '../assets/absent/img_in/absent_Dev_1727667037.png', NULL),
(164, 9, 1, '2024-10-18', '10:32:39', NULL, NULL, 'S', NULL, '-6.2234748', '106.9476776', '../assets/absent/img_in/absent_khajar_1729222359.png', NULL),
(165, 1, 1, '2025-02-27', '10:29:08', NULL, NULL, 'S', NULL, '-6.2219707', '106.9327516', '../assets/absent/img_in/absent_dev_1740626948.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_admin`
--

CREATE TABLE `_admin` (
  `pkadmin` int(11) NOT NULL,
  `_fullname` varchar(255) DEFAULT NULL,
  `_email` varchar(255) DEFAULT NULL,
  `_password` varchar(255) NOT NULL,
  `_mobno` varchar(255) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_admin`
--

INSERT INTO `_admin` (`pkadmin`, `_fullname`, `_email`, `_password`, `_mobno`, `_user`, `join_date`) VALUES
(1, 'Zia Mustofa', NULL, '123123', NULL, 'ziamus', '2023-12-28 07:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `_class`
--

CREATE TABLE `_class` (
  `pkcls` int(11) NOT NULL,
  `cls_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_class`
--

INSERT INTO `_class` (`pkcls`, `cls_name`) VALUES
(1, 'X PPL');

-- --------------------------------------------------------

--
-- Table structure for table `_student`
--

CREATE TABLE `_student` (
  `pkstudent` int(11) NOT NULL,
  `_uid` varchar(20) DEFAULT NULL,
  `_fullname` varchar(50) DEFAULT NULL,
  `_email` varchar(30) DEFAULT NULL,
  `_password` varchar(255) DEFAULT NULL,
  `_mobno` varchar(255) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `join_date` date DEFAULT curdate(),
  `_pkcls` int(11) DEFAULT NULL,
  `_structure` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_student`
--

INSERT INTO `_student` (`pkstudent`, `_uid`, `_fullname`, `_email`, `_password`, `_mobno`, `_user`, `join_date`, `_pkcls`, `_structure`) VALUES
(1, '123123', 'Neosantara Dev', NULL, '123', NULL, 'dev', '2023-12-28', 1, 'ketua_kelas'),
(3, '123123', 'Abdullah Yusya Jihad', NULL, '123123', NULL, 'yusya', '2024-03-31', 1, 'ketua_kelas'),
(4, NULL, 'Sulthony', NULL, '123123', NULL, 'sulthony', '2024-03-31', 1, 'siswa_biasa'),
(5, NULL, 'Nafil Habibi Mulyadi', NULL, 'qwerty', NULL, 'nafil', '2024-04-06', 1, 'sekertaris_kelas'),
(6, NULL, 'Muhammmad Exa Al Kahfi', NULL, '123123', NULL, 'exa mendoza', '2024-05-04', 1, 'sekertaris_kelas'),
(7, NULL, 'Hengky Gusatrio', NULL, '123123', NULL, 'kyy', '2024-05-07', 1, 'siswa_biasa'),
(8, NULL, 'Muhammad Ghifari Fauzi', NULL, '123123', NULL, 'gifri', '2024-09-26', 1, 'siswa_biasa');

-- --------------------------------------------------------

--
-- Table structure for table `_teacher`
--

CREATE TABLE `_teacher` (
  `pkteacher` int(11) NOT NULL,
  `_fullname` varchar(255) DEFAULT NULL,
  `_email` varchar(255) DEFAULT NULL,
  `_password` varchar(255) DEFAULT NULL,
  `_mobno` varchar(255) DEFAULT NULL,
  `_user` varchar(50) DEFAULT NULL,
  `join_date` date DEFAULT curdate(),
  `_level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_teacher`
--

INSERT INTO `_teacher` (`pkteacher`, `_fullname`, `_email`, `_password`, `_mobno`, `_user`, `join_date`, `_level`) VALUES
(1, 'Dian Purnamasari', NULL, '123123', NULL, 'dyan', '2024-01-01', 'guru_mapel'),
(2, 'Dawati', NULL, '123123', NULL, 'with', '2024-01-01', 'guru_mapel');

-- --------------------------------------------------------

--
-- Table structure for table `_tmpuid`
--

CREATE TABLE `_tmpuid` (
  `pktmpuid` int(11) NOT NULL,
  `_uid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_tmpuid`
--

INSERT INTO `_tmpuid` (`pktmpuid`, `_uid`) VALUES
(1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_tokens`
--
ALTER TABLE `student_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_tokens`
--
ALTER TABLE `teacher_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_absent`
--
ALTER TABLE `_absent`
  ADD PRIMARY KEY (`pkabsent`);

--
-- Indexes for table `_admin`
--
ALTER TABLE `_admin`
  ADD PRIMARY KEY (`pkadmin`),
  ADD UNIQUE KEY `_user` (`_user`);

--
-- Indexes for table `_class`
--
ALTER TABLE `_class`
  ADD PRIMARY KEY (`pkcls`);

--
-- Indexes for table `_student`
--
ALTER TABLE `_student`
  ADD PRIMARY KEY (`pkstudent`);

--
-- Indexes for table `_teacher`
--
ALTER TABLE `_teacher`
  ADD PRIMARY KEY (`pkteacher`),
  ADD UNIQUE KEY `_user` (`_user`);

--
-- Indexes for table `_tmpuid`
--
ALTER TABLE `_tmpuid`
  ADD PRIMARY KEY (`pktmpuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_tokens`
--
ALTER TABLE `student_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_tokens`
--
ALTER TABLE `teacher_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_absent`
--
ALTER TABLE `_absent`
  MODIFY `pkabsent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `_admin`
--
ALTER TABLE `_admin`
  MODIFY `pkadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_class`
--
ALTER TABLE `_class`
  MODIFY `pkcls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_student`
--
ALTER TABLE `_student`
  MODIFY `pkstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `_teacher`
--
ALTER TABLE `_teacher`
  MODIFY `pkteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_tmpuid`
--
ALTER TABLE `_tmpuid`
  MODIFY `pktmpuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
