-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2014 at 06:55 PM
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
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `date_updated` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id_2` (`student_id`,`standard_id`),
  KEY `student_id` (`student_id`),
  KEY `standard_id` (`standard_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student_id`, `standard_id`, `rating`, `date_updated`) VALUES
(58, 1, 5, 'm', '12-29-2014'),
(59, 2, 5, 'p', '12-29-2014'),
(60, 3, 5, 'nm', '12-29-2014'),
(61, 1, 6, 'p', '12-29-2014'),
(62, 2, 6, 'm', '12-29-2014'),
(63, 3, 6, 'nm', '12-29-2014'),
(67, 7, 5, 'p', '12-29-2014'),
(68, 8, 5, 'm', '12-29-2014'),
(69, 9, 5, 'nm', '12-29-2014'),
(70, 10, 5, 'p', '12-29-2014'),
(71, 11, 5, 'm', '12-29-2014'),
(72, 14, 5, 'm', '12-29-2014'),
(73, 15, 5, 'm', '12-29-2014'),
(74, 16, 5, 'm', '12-29-2014'),
(75, 17, 5, 'p', '12-29-2014'),
(76, 18, 5, 'p', '12-29-2014'),
(77, 19, 5, 'p', '12-29-2014'),
(78, 20, 5, 'nm', '12-29-2014'),
(79, 21, 5, 'nm', '12-29-2014'),
(80, 22, 5, 'm', '12-29-2014'),
(101, 7, 6, 'nm', '12-29-2014'),
(102, 8, 6, 'p', '12-29-2014'),
(103, 9, 6, 'm', '12-29-2014'),
(104, 10, 6, 'm', '12-29-2014'),
(105, 11, 6, 'm', '12-29-2014'),
(106, 14, 6, 'p', '12-29-2014'),
(107, 15, 6, 'p', '12-29-2014'),
(108, 16, 6, 'nm', '12-29-2014'),
(109, 17, 6, 'p', '12-29-2014'),
(110, 18, 6, 'nm', '12-29-2014'),
(111, 19, 6, 'p', '12-29-2014'),
(112, 20, 6, 'p', '12-29-2014'),
(113, 21, 6, 'm', '12-29-2014'),
(114, 22, 6, 'm', '12-29-2014');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`) VALUES
(1, '2014-2015', 1),
(2, '2013-2014', 1),
(6, '2012-2013', 1),
(7, '2011-2012', 1);

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE IF NOT EXISTS `standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_given` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schoolyear_id` (`schoolyear_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `title`, `description`, `date_given`, `schoolyear_id`) VALUES
(1, 'Final Standard', 'Comprehensive math, science, reading', '2014-12-22', 1),
(2, 'Early December Standard', 'Science final standard', '2014-12-01', 1),
(3, 'Early November Standard', 'Reading final standard', '2014-11-10', 1),
(5, 'Second Standard of New Year', 'Test Description', '2015-02-04', 1),
(6, 'First Standard of the Year', 'Test', '2015-01-11', 1),
(9, 'Tester', 'A test near Christmas, for some reason', '2014-12-22', 1),
(14, 'Math Standard', 'Addition and subtraction', '2014-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`id`),
  KEY `schoolyear_id` (`schoolyear_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `schoolyear_id`, `status`) VALUES
(1, 'Patience', 'Bentley', 1, 'enabled'),
(2, 'Braden', 'Chapman', 1, 'enabled'),
(3, 'Landon', 'Willis', 1, 'enabled'),
(4, 'Blake', 'Griffin', 2, 'enabled'),
(5, 'Julius', 'Randle', 2, 'enabled'),
(6, 'Derrick', 'Rose', 2, 'enabled'),
(7, 'Aydan', 'Frerking', 1, 'enabled'),
(8, 'Emma', 'Gillilan', 1, 'enabled'),
(9, 'Madisen', 'Hatfield', 1, 'enabled'),
(10, 'Harley', 'Holcomb', 1, 'enabled'),
(11, 'Jackson', 'Iles', 1, 'enabled'),
(12, 'Andrew', 'Wiggins', 6, 'enabled'),
(13, 'Anthony', 'Davis', 6, 'enabled'),
(14, 'Ezekiel', 'Montgomery', 1, 'enabled'),
(15, 'Violet', 'Myrick', 1, 'enabled'),
(16, 'Addie', 'Pilcher', 1, 'enabled'),
(17, 'Caleb', 'Ratliff', 1, 'enabled'),
(18, 'Theo', 'Simpson', 1, 'enabled'),
(19, 'Ashtyn', 'Sims', 1, 'enabled'),
(20, 'Leeland', 'Sullins', 1, 'enabled'),
(21, 'Lake', 'Wentland', 1, 'enabled'),
(22, 'Mary', 'Young', 1, 'enabled');

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
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `student_grade_fk_cstrnt` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_grade_std_fk_cstrnt` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
