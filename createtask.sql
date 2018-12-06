-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 09:23 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `procrastination`
--

-- --------------------------------------------------------

--
-- Table structure for table `createtask`
--

CREATE TABLE `createtask` (
  `taskID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `taskTitle` varchar(30) NOT NULL,
  `taskDescription` text NOT NULL,
  `listTitle` varchar(30) NOT NULL,
  `Visibility` char(3) NOT NULL,
  `Frequency` char(1) NOT NULL,
  `dueDate` date NOT NULL,
  `priorityLVL` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `createtask`
--

INSERT INTO `createtask` (`taskID`, `username`, `taskTitle`, `taskDescription`, `listTitle`, `Visibility`, `Frequency`, `dueDate`, `priorityLVL`) VALUES
(1, '', 'testing', 'jnnjk', 'Kendo ', 'pub', 'o', '2018-12-26', 'l'),
(2, '', 'Biol 303 Midterm', '30 %\r\nImportant', 'Biology ', 'pub', 'o', '2018-12-16', 'h'),
(3, '', 'Tournament', 'Grading', 'Kendo ', 'pub', 'o', '2019-01-05', 'm'),
(4, '', 'Biol 306 Final', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(5, '', 'Biol 306 Final 2', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(6, '', 'Biol 306 Final 4', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(7, '', 'Biol 306 Final 10', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(8, '', 'Biol 306 Final 12', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(9, '', 'Biol 306 Final 100', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(10, '', 'Biol 306 Final 107', 'TT', 'Biology ', 'pub', 'o', '2018-12-10', 'h'),
(11, '', 'Drawing class', 'yay', 'Arts ', 'pub', 'o', '2018-12-17', 'l'),
(12, '', 'Painting class', 'yay', 'Arts ', 'pub', 'o', '2018-12-17', 'l');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `createtask`
--
ALTER TABLE `createtask`
  ADD PRIMARY KEY (`taskID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `createtask`
--
ALTER TABLE `createtask`
  MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
