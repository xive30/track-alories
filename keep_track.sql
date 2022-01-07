-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 05, 2022 at 04:20 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keep_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `meal` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `calories` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `meal`, `userid`, `calories`, `created`) VALUES
(1, '1', 1, 480, '2021-12-30 16:06:17'),
(2, '2', 1, 1000, '2021-12-30 16:07:46'),
(3, '1', 3, 200, '2021-12-30 16:07:46'),
(4, '3', 4, 250, '2021-12-25 19:28:12'),
(5, '1', 4, 420, '2021-12-26 19:28:02'),
(6, '2', 4, 500, '2021-12-27 19:27:55'),
(7, '1', 4, 250, '2021-12-28 13:05:34'),
(8, '2', 4, 500, '2021-12-29 13:09:06'),
(9, '2', 4, 500, '2021-12-30 13:09:12'),
(10, '3', 4, 750, '2021-12-31 18:12:42'),
(11, '4', 4, 50, '2022-01-03 19:25:25'),
(12, '3', 4, 379, '2022-01-02 06:46:16'),
(13, '1', 4, 500, '2022-01-03 08:10:07'),
(14, '2', 4, 500, '2022-01-03 18:48:08'),
(15, '3', 7, 750, '2022-01-03 19:58:34'),
(16, '3', 4, 1200, '2022-01-04 16:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `gender` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `activity` float NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `gender`, `birthday`, `height`, `weight`, `activity`, `userPass`) VALUES
(3, 'toto', 0, '1111-11-11', 111, 111, 1.725, 'toto'),
(4, 'tata', 0, '1955-05-05', 165, 75, 1.55, '$2y$10$C9vyFOnOeAjdpsKJlQDo4uQhAtkyGbiKdJvXEI/eRjy/F.3j6CCh.'),
(5, 'tota', 1, '2222-02-22', 180, 80, 1.2, '$2y$10$NiFIcOLtybIDjzCcaUnsJe4UozMcUHDry1xppDceS8C7egbEUhalS'),
(6, 'florent', 1, '1988-10-14', 180, 99.5, 1.2, '$2y$10$JuZM7wsN.IndcvyZ7GV.Du62aye57Y7WYHUe4TVroVbSceBNhOerK'),
(7, 'ben', 1, '1999-09-09', 160, 75, 1.725, '$2y$10$fuavfrvlKba91ZeUFRjmeeSZ6x7EyQ39vsIClOqxLPbYmisp2cRum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
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
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
