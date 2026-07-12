-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.infinityfree.com
-- Generation Time: Jun 22, 2026 at 03:47 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41244839_portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `percentage` int(11) DEFAULT 0,
  `category` varchar(50) DEFAULT 'Technical',
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `percentage`, `category`, `icon`, `sort_order`) VALUES
(1, 'HTML & CSS', 95, 'Frontend', 'fa-html5', 1),
(2, 'JavaScript', 90, 'Frontend', 'fa-js', 2),
(3, 'PHP', 85, 'Backend', 'fa-php', 3),
(4, 'MySQL', 80, 'Backend', 'fa-database', 4),
(5, 'React', 85, 'Frontend', 'fa-react', 5),
(6, 'Node.js', 90, 'Backend', 'fa-node-js', 6),
(7, 'Python', 65, 'Backend', 'fa-python', 7),
(8, 'Git', 85, 'Tools', 'fa-git-alt', 8),
(9, 'Laravel', 85, 'Backend', 'fa-laravel', 9),
(10, 'linux', 60, 'Tools', 'fa-linux', 10),
(11, 'Security', 65, 'Backend', 'fa-shield-alt', 11),
(12, 'Terminal', 65, 'Tools', 'fa-terminal', 12),
(13, 'Web Design', 60, 'Frontend', 'fa-paint-brush', 13),
(14, 'CSS', 90, 'Frontend', 'fa-css3-alt', 14),
(15, 'BOOTSRAP', 35, 'Frontend', 'fa-bootstrap', 15),
(16, 'CODE', 70, 'Other', 'fa-code', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
