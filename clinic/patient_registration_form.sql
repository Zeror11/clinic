-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 02:22 AM
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
-- Database: `smile a lot dental clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient registration form`
--

CREATE TABLE `patient registration form` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `gender` text NOT NULL,
  `phone` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `allergic` varchar(255) NOT NULL,
  `medical_record` varchar(255) NOT NULL,
  `insurance_info` varchar(255) NOT NULL,
  `status` tinyint(255) NOT NULL,
  `read_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient registration form`
--

INSERT INTO `patient registration form` (`id`, `fullname`, `age`, `gender`, `phone`, `address`, `email`, `allergic`, `medical_record`, `insurance_info`, `status`, `read_status`) VALUES
(1, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1),
(2, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1),
(3, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1),
(4, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1),
(5, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1),
(6, 'BERMUDEZ, JOHN BENEDICT E.', 22, 'Other', '3456566', 'Cabuyao laguna', 'bermudezjohnbenedict76@gmail.com', 'yes', 't', 'tanga', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient registration form`
--
ALTER TABLE `patient registration form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient registration form`
--
ALTER TABLE `patient registration form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
