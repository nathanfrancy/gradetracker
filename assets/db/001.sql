-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 05:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gradetracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `quarter`
--

CREATE TABLE IF NOT EXISTS `quarter` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter`
--

INSERT INTO `quarter` (`id`, `title`, `schoolyear_id`) VALUES
(1, '1st', 1),
(2, '2nd', 1),
(3, '3rd', 1),
(4, '4th', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE IF NOT EXISTS `schoolyear` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`) VALUES
(1, '2014/2015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'Hanna', 'Williams', 'hannawilliams', 'hannajowilliams@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quarter`
--
ALTER TABLE `quarter`
 ADD PRIMARY KEY (`id`), ADD KEY `schoolyear_id` (`schoolyear_id`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quarter`
--
ALTER TABLE `quarter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `quarter`
--
ALTER TABLE `quarter`
ADD CONSTRAINT `schoolyear_id_quarter_fk` FOREIGN KEY (`schoolyear_id`) REFERENCES `schoolyear` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schoolyear`
--
ALTER TABLE `schoolyear`
ADD CONSTRAINT `user_gradetracker_fk_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
