-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 01:27 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_list`
--
ALTER TABLE `permission_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_list`
--
ALTER TABLE `permission_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
