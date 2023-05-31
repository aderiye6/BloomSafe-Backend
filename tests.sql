-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 01:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `image` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `score` varchar(255) NOT NULL,
  `longitude` decimal(11,9) NOT NULL,
  `latitude` decimal(11,9) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`metadata`)),
  `record_time` time NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `user_id`, `image`, `result`, `score`, `longitude`, `latitude`, `comment`, `metadata`, `record_time`, `date`) VALUES
(1, 2, 'Public/images/photos/2023/05/BhoIKRg5KqdpTKCHwX7N_full.jpg', '0.65', '', '3.352166400', '6.576537600', 'Slightly Bad', '{\"file\":{\"name\":\"edited.jpg\",\"type\":\"image\\/jpeg\",\"tmp_name\":\"C:\\\\xampp\\\\tmp\\\\phpE8E.tmp\",\"error\":0,\"size\":34499},\"score\":6.5,\"result\":0.65,\"standard\":10}', '00:00:00', '2023-05-11 12:24:27.984692'),
(3, 2, 'Public/images/photos/2023/05/mc2fy7tybFVv6DSPuTi4_full.jpeg', '1', '', '3.352166400', '6.576537600', 'Really Bad', '{\"file\":{\"name\":\"use.jpeg\",\"type\":\"image\\/jpeg\",\"tmp_name\":\"C:\\\\xampp\\\\tmp\\\\php2314.tmp\",\"error\":0,\"size\":24411},\"score\":10,\"result\":1,\"standard\":10}', '00:00:00', '2023-05-11 12:24:43.755657'),
(4, 2, 'Public/images/photos/2023/05/k8H6BaOorGMmN1Ph3RmM_full.jpeg', '1', '10', '3.352166400', '6.576537600', 'Really Bad', '{\"file\":{\"name\":\"use.jpeg\",\"type\":\"image\\/jpeg\",\"tmp_name\":\"C:\\\\xampp\\\\tmp\\\\phpCC93.tmp\",\"error\":0,\"size\":24411},\"score\":10,\"result\":1,\"standard\":10}', '838:59:59', '2023-05-11 12:25:27.120811'),
(5, 2, 'Public/images/photos/2023/05/yUWFrHLo2hiHKFOHdvJ7_full.jpeg', '1', '', '3.352166400', '6.576537600', 'Really Bad', '{\"file\":{\"name\":\"use.jpeg\",\"type\":\"image\\/jpeg\",\"tmp_name\":\"C:\\\\xampp\\\\tmp\\\\php4E78.tmp\",\"error\":0,\"size\":24411},\"score\":10,\"result\":1,\"standard\":10}', '838:59:59', '2023-05-11 12:29:16.987190');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
