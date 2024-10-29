-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 07:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicio`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `appoint_date` date NOT NULL,
  `appoint_time` time NOT NULL,
  `message` text DEFAULT NULL,
  `category_n` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousel_items`
--

CREATE TABLE `carousel_items` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel_items`
--

INSERT INTO `carousel_items` (`id`, `image`, `caption`) VALUES
(1, 'uploads/medicare.PNG', 'helo world'),
(2, 'uploads/doctorindex.png', 'jkxdas');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `email`, `password`, `status`, `created_at`) VALUES
(12, 'Student1523056', 'Cardiology', 'student@student.com', '', 'approved', '2024-10-03 03:44:57'),
(17, 'Student1523056', 'Neurology', 'gogo@gmail.com', '', 'approved', '2024-10-03 21:14:40'),
(30, 'Student1523056', 'Orthopedics', 'kamanger@user.com', '', 'approved', '2024-10-04 04:05:22'),
(31, 'MUHAMMAD ZAID', '', 'xoxo@gmail.com', '$2y$10$d6CIX234S661c.J3tyBp8OEw/dt364J3Ndp8ur5aMKbbQSeBvQbW2', 'approved', '2024-10-07 05:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'headache', 'dnksvlnvls', 'uploads/medicare.PNG', '2024-10-07 04:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role_id`, `status`, `created_at`, `profile_pic`, `city`) VALUES
(1, 'zaiddefew', 'doctor2@gmail.com', 'doctor123', 2, 'approved', '2024-10-02 14:31:53', NULL, 'karachiss'),
(2, 'Admin User', 'admin@admin.com', 'admin123', 1, 'approved', '2024-10-02 14:35:07', NULL, NULL),
(3, 'MUHAMMAD ZAID', 'kamanger@gmail.com', 'user321', 3, 'approved', '2024-10-02 14:56:29', NULL, 'karachi'),
(8, 'rafay', 'rafay@gmail.com', 'rafay123', 2, 'approved', '2024-10-02 20:13:32', NULL, NULL),
(10, 'zozo', 'zozo@gmail.com', 'zozo123', 2, 'approved', '2024-10-03 02:31:59', NULL, NULL),
(11, 'ibrar', 'ibrar@gmail.com', 'ibrar123', 2, 'approved', '2024-10-03 02:39:11', NULL, NULL),
(12, 'Student1523056', 'student@student.com', 'stu123', 2, 'pending', '2024-10-03 03:44:57', NULL, NULL),
(16, 'muhammad zaid', 'sqwd2@hma.com', 'wdjfef', 0, 'approved', '2024-10-03 18:51:23', NULL, 'karachi'),
(17, 'Student1523056', 'gogo@gmail.com', '123', 2, 'approved', '2024-10-03 21:14:40', 'uploads/signup.png', 'karachi'),
(26, 'kamanger', 'soso@gmail.com', 'user321', 2, 'pending', '2024-10-04 04:00:31', NULL, NULL),
(30, 'Student1523056', 'kamanger@user.com', 'user321', 2, 'pending', '2024-10-04 04:05:22', NULL, NULL),
(33, 'MUHAMMAD ZAID', 'xoxo@gmail.com', '$2y$10$d6CIX234S661c.J3tyBp8OEw/dt364J3Ndp8ur5aMKbbQSeBvQbW2', 2, 'approved', '2024-10-07 05:42:23', NULL, 'karachi'),
(34, 'kamanger', 'klfne@gmail.com', '$2y$10$nqbHAjHlguBwPCzZ21dLCeb35M0oSZvPSuk9amCBWWCkoAKEEbFe.', 2, 'approved', '2024-10-07 05:47:21', NULL, 'karachi'),
(35, 'zohaub', 'zohaib@gmail.com', '$2y$10$zhP1QuBRXA18/NZpDGWoy.HB62K0dlavIeZQiqrTM5cZCti5lWy7W', 2, 'approved', '2024-10-07 05:49:07', NULL, 'sukkur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `carousel_items`
--
ALTER TABLE `carousel_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carousel_items`
--
ALTER TABLE `carousel_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
