-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2014 at 08:39 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schoolyear_id` (`schoolyear_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`) VALUES
(1, '2014-2015', 1),
(2, '2013-2014', 1);

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE IF NOT EXISTS `standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_given` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schoolyear_id` (`schoolyear_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `title`, `date_given`, `schoolyear_id`) VALUES
(1, 'Final Standard', '2014-12-23', 1),
(2, 'Early December Standard', '2014-12-02', 1),
(3, 'Early November Standard', '2014-11-11', 1),
(4, 'First Standard', '2014-08-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schoolyear_id` (`schoolyear_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `schoolyear_id`) VALUES
(1, 'Nathan', 'Francy', 1),
(2, 'Andrew', 'Ross', 1),
(3, 'Patricia', 'Matthews', 1),
(4, 'Parker', 'Schnell', 2),
(5, 'Hannah', 'Eckley', 2),
(6, 'Tyler', 'Murphy', 2),
(7, 'Zachary', 'Reever', 1),
(8, 'Emily', 'Dillon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'Hanna', 'Williams', 'hannawilliams', 'hannajowilliams@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

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

--
-- Constraints for table `standard`
--
ALTER TABLE `standard`
  ADD CONSTRAINT `skoolyear_fk_cstrnt_standard` FOREIGN KEY (`schoolyear_id`) REFERENCES `schoolyear` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `schoolyear_student_fk_id` FOREIGN KEY (`schoolyear_id`) REFERENCES `schoolyear` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
