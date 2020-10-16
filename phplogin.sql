-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 02:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(1, 'test', 'test', 'test@messager.gr'),
(2, 'markos', 'aek', 'markos@messager.gr'),
(3, 'root', 'root', 'root@messager.gr');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `m_id` int(11) NOT NULL,
  `from_email` varchar(40) NOT NULL,
  `to_email` varchar(40) NOT NULL,
  `subject` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`m_id`, `from_email`, `to_email`, `subject`, `text`) VALUES
(1, 'markos@messager.gr', 'root@messager.gr', 'hello', 'is it me you re looking for?'),
(2, 'root@messager.gr', 'markos@messager.gr', 'hi', 'Yes it iz'),
(3, 'root@messager.gr', 'test@messager.gr', 'bye', 'goodbye blue sky'),
(27, 'test@messager.gr', 'markos@messager.gr', 'AEK', 'aek kupelo'),
(54, 'markos@messager.gr', 'test@messager.gr', 'AEK', 's'),
(57, 'markos@messager.gr', 'test@messager.gr', 'Προγραμματισμός Διαδικτύου', 's'),
(60, 'test@messager.gr', 'root@messager.gr', 'Ajax', 'Ajax jquery');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `p_id` int(11) NOT NULL,
  `p_from` varchar(40) NOT NULL,
  `p_to` varchar(40) NOT NULL,
  `p_subject` tinytext NOT NULL,
  `p_text` text NOT NULL,
  `p_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`p_id`, `p_from`, `p_to`, `p_subject`, `p_text`, `p_status`) VALUES
(14, 'test@messager.gr', 'test@messager.gr', 'AEK', 'aek', 0),
(16, 'test@messager.gr', 'markos@messager.gr', 'AEK', 'aek kupelo', 0),
(18, 'test@messager.gr', 'markos@messager.gr', 'AEK', 's', 0),
(19, 'root@messager.gr', 'markos@messager.gr', 'AEK', 's', 0),
(20, 'root@gmail.com', 'test@gmail.com', 'AEK', 's', 0),
(22, 'root@gmail.com', 'markos@gmail.com', 'asd', 'asd', 0),
(49, 'test@messager.gr', 'root@messager.gr', 'Ajax', 'Ajax jquery', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
