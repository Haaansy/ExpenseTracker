-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 07:14 AM
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
-- Database: `user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `owner` varchar(255) NOT NULL,
  `category` enum('Income','Expense') NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` int(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`owner`, `category`, `description`, `amount`, `id`) VALUES
('test', 'Expense', '123', 124, 3),
('test', 'Income', 'Allowance', 1000, 4),
('test', 'Expense', 'test', 125, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(10, 'test', '$2y$10$aXOMRyudaCmn.U91cJPTfe10/kf5GOjqP4tYisOShYKYmYXrYZ.Ie'),
(11, 'test1', '$2y$10$6i7AV5FYvFnz/fsEAbVXvuMz/zgjZoJ.lXJwra5KubfVK0TTznCti'),
(12, '1', '$2y$10$Q39H3T/3Sat/vmxL9Pfkauulr9OW5Far0CApiWWVIR/HrVtBAEpcq'),
(13, '2', '$2y$10$QLyxLNLmuAzInmfmVfuRv.FiTW7A8ju6ktQR9.T/TDUYqCO/Q.8ZK'),
(14, 'ianized', '$2y$10$1MJQAXljhvdM1bpaQrBmVOxbBpwXtGCU27eFolSs7z3JWAXw7mPmC'),
(15, '', '$2y$10$IEi6PtPzmyDWZGrdx2bx5ubHBCYuz9L37JV65/6jtNyDwdBUQWva6'),
(16, 'test', '$2y$10$7GM302K5xRN9OEhc0NJvEevGpWLbUGRiP9/mCsO06iY8ylmFx7ZOC'),
(17, 'test', '$2y$10$tCIMfqFvthhomVG1CUU3zuNsOyv/lA3qaoQu0QjRbQXQPI9AcLrga'),
(18, 'leiann', '$2y$10$yAJIGA1K9k5tydcJAgKyJe2sbc7eFwf7EixumQRrsslvAHkvtSPSS'),
(19, 'test', '$2y$10$Kd53.WF685tZwLLfGnc2F.KgRR9Zm.4GpSvV.z3Wunpk9ys4vaB/K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
