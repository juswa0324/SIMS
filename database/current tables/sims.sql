-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 08:24 AM
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
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission_list`
--

CREATE TABLE `permission_list` (
  `id` int(11) NOT NULL,
  `parentID` int(11) DEFAULT NULL,
  `Permission` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `icon` varchar(1000) DEFAULT NULL,
  `sortOrder` int(11) DEFAULT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_list`
--

INSERT INTO `permission_list` (`id`, `parentID`, `Permission`, `link`, `icon`, `sortOrder`, `Deleted`) VALUES
(1, NULL, 'Dashboard', 'home.php', 'fa fa-dashboard', 1, 0),
(2, NULL, 'My Account', NULL, 'fa fa-user', 2, 0),
(3, 2, 'Profile', 'profile.php', 'fa fa-circle', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `Role` varchar(1000) DEFAULT NULL,
  `Permission` text NOT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `Role`, `Permission`, `Deleted`) VALUES
(1, 'Developer', '1,2,3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `Permission` int(11) NOT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `RoleID`, `Permission`, `Deleted`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(1000) NOT NULL,
  `Lastname` varchar(1000) NOT NULL,
  `Email` varchar(1000) NOT NULL,
  `Username` varchar(1000) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT 0,
  `Department` varchar(1000) DEFAULT NULL,
  `Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Firstname`, `Lastname`, `Email`, `Username`, `Password`, `RoleID`, `Department`, `Deleted`) VALUES
(1, 'Joshua', 'De Leon', 'd.joshua0324@gmail.com', 'Admin', '$2y$10$mGsZ1/gPcO3j4BBkSCAlUOEK1zmd22YK/fhzQmrpBiFlFts3ScLCm', 1, 'Developer', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_list`
--
ALTER TABLE `permission_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_list`
--
ALTER TABLE `permission_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
