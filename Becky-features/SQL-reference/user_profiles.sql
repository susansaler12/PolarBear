-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 04:49 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `interests` varchar(100) DEFAULT NULL,
  `config_string` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `email`, `fname`, `lname`, `password`, `image`, `location`, `birthday`, `interests`, `config_string`) VALUES
(1, 'abc@abc.com', 'Sam', NULL, 'abc', NULL, NULL, NULL, NULL, NULL),
(2, 'yipiki@yahoo.com', 'Becky', NULL, 'cef0f6e921d097cbc2c0e67068601ffc', NULL, NULL, NULL, NULL, NULL),
(3, 'susan.saler@hotmail.com', 'Susan', NULL, 'testtest', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
