-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2026 at 01:29 PM
-- Server version: 8.0.30
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pathfinderit`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `q1` int DEFAULT NULL,
  `q2` int DEFAULT NULL,
  `q3` int DEFAULT NULL,
  `q4` int DEFAULT NULL,
  `q5` int DEFAULT NULL,
  `q6` int DEFAULT NULL,
  `q7` int DEFAULT NULL,
  `q8` int DEFAULT NULL,
  `q9` int DEFAULT NULL,
  `q10` int DEFAULT NULL,
  `q11` int DEFAULT NULL,
  `q12` int DEFAULT NULL,
  `ai_score` float DEFAULT NULL,
  `se_score` float DEFAULT NULL,
  `ds_score` float DEFAULT NULL,
  `cn_score` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `name`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `ai_score`, `se_score`, `ds_score`, `cn_score`, `created_at`) VALUES
(1, NULL, 4, 5, 2, 3, 2, 5, 3, 3, 4, 4, 2, 3, 0.7, 0.95, 0.55, 0.3, '2026-04-09 08:38:04'),
(2, NULL, 4, 5, 2, 3, 2, 5, 3, 3, 4, 4, 2, 3, 0.7, 0.95, 0.45, 0.3, '2026-04-09 08:44:56'),
(3, NULL, 4, 5, 5, 1, 5, 5, 2, 5, 5, 1, 1, 1, 0.9, 1, 0.3, 0.8, '2026-04-09 09:30:55'),
(4, NULL, 5, 1, 3, 5, 5, 1, 3, 4, 5, 4, 5, 3, 0.9, 0, 0.65, 0.65, '2026-04-09 09:35:20'),
(5, NULL, 3, 3, 1, 2, 1, 5, 4, 3, 5, 5, 4, 3, 0.7, 0.65, 0.4, 0.1, '2026-04-10 06:52:35'),
(6, NULL, 3, 1, 5, 3, 1, 2, 1, 1, 3, 2, 2, 4, 0.45, 0.25, 0.35, 0.6, '2026-04-10 06:54:00'),
(7, 'tes', 3, 1, 5, 3, 1, 2, 1, 1, 3, 2, 2, 4, 0.45, 0.25, 0.35, 0.6, '2026-04-10 12:42:05'),
(8, 'Sett', 5, 1, 4, 3, 4, 1, 3, 4, 3, 4, 4, 3, 0.7, 0.05, 0.45, 0.65, '2026-04-10 12:57:37'),
(9, 'John Doe', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0.2, 0.2, 0.2, 0.2, '2026-04-10 13:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin', 'f709ba08e636e8d40a0f48b1465ab141', 'admin', '2026-04-09 08:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
