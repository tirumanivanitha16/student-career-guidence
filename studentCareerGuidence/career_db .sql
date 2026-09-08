-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2026 at 12:02 PM
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
-- Database: `career_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `test_status` varchar(50) DEFAULT 'Pending',
  `skills` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `cgpa` varchar(10) DEFAULT NULL,
  `graduation_year` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `pass_year` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `college`, `branch`, `created_at`, `test_status`, `skills`, `interests`, `bio`, `cgpa`, `graduation_year`, `address`, `linkedin`, `pass_year`) VALUES
(1, 'JNANA SRI VIDYA VASAMSETTI', 'srividyavasamsetti4@gmail.com', '$2y$10$k2AV6YJb8EcPxYVYZHN4HOjfn38H53zpuyFPrpSglO9H6.SIFSxee', '8340915854', 'srkr', 'Computer Science (CSE)', '2026-09-06 07:21:53', 'Pending', 'java,python', NULL, NULL, '8.5', NULL, NULL, 'https://www.linkedin.com/in/jnana-sri-vidya-vasamsetti-076571380', '2018'),
(2, 'JNANA SRI VIDYA VASAMSETTI', 'srividyavasamsetti3@gmail.com', '$2y$10$htFqJ8MVhOoG1iZoHQpMnOXAmZIfN/MJ/hWSsLvfSPPDTLirgW3Qm', '8340915854', 'srkr', 'Computer Science (CSE)', '2026-09-06 07:42:48', 'Pending', 'quantum', NULL, NULL, '8.5', NULL, NULL, 'https://www.linkedin.com/in/jnana-sri-vidya-vasamsetti-076571380', '2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
