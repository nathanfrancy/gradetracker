-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2015 at 06:30 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student_id`, `standard_id`, `rating`, `date_updated`) VALUES
(221, 23, 18, 'm', '01-18-2015'),
(222, 24, 18, 'm', '01-18-2015'),
(223, 25, 18, 'm', '01-18-2015'),
(224, 26, 18, 'm', '01-18-2015'),
(225, 27, 18, 'm', '01-18-2015'),
(226, 28, 18, 'm', '01-18-2015'),
(227, 29, 18, 'nm', '01-18-2015'),
(228, 30, 18, 'nm', '01-18-2015'),
(229, 31, 18, 'nm', '01-18-2015'),
(230, 32, 18, 'p', '01-18-2015');

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

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE IF NOT EXISTS `schoolyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `q1_start` varchar(255) NOT NULL,
  `q1_end` varchar(255) NOT NULL,
  `q2_start` varchar(255) NOT NULL,
  `q2_end` varchar(255) NOT NULL,
  `q3_start` varchar(255) NOT NULL,
  `q3_end` varchar(255) NOT NULL,
  `q4_start` varchar(255) NOT NULL,
  `q4_end` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`, `q1_start`, `q1_end`, `q2_start`, `q2_end`, `q3_start`, `q3_end`, `q4_start`, `q4_end`) VALUES
(8, '2014-2015', 4, '2014-08-16', '2014-10-15', '2014-10-16', '2014-12-12', '2015-01-06', '2015-03-15', '2015-03-16', '2015-05-14'),
(15, '2012-2013', 4, 's', 'e', 'e', 't', 'df', 'dfs', 'ds', 'dfs');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `title`, `description`, `date_given`, `schoolyear_id`) VALUES
(18, 'Free Throws', 'Free throws test', '2015-01-30', 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `schoolyear_id`, `status`) VALUES
(23, 'Michael', 'Jordan', 8, 'enabled'),
(24, 'Kobe', 'Bryant', 8, 'enabled'),
(25, 'Shabazz', 'Muhammed', 8, 'enabled'),
(26, 'Dwayne', 'Wade', 8, 'enabled'),
(27, 'LeBron', 'James', 8, 'enabled'),
(28, 'Earl', 'Thomas', 8, 'enabled'),
(29, 'Jamaal', 'Charles', 8, 'enabled'),
(30, 'Tiger', 'Woods', 8, 'enabled'),
(31, 'Eric', 'Hosmer', 8, 'enabled'),
(32, 'Tony', 'Kukoc', 8, 'enabled');

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
  `theme` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `theme`) VALUES
(1, 'Hanna', 'Williams', 'hannawilliams', 'hannajowilliams@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'cosmo'),
(4, 'Nathan', 'Francy', 'nathanfrancy', 'nathanfrancy@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'united');

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
