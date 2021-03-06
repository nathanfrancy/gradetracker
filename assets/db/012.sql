-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2015 at 05:14 AM
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
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `date_updated` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student_id`, `standard_id`, `rating`, `date_updated`) VALUES
(221, 23, 18, 'm', '01-19-2015'),
(222, 24, 18, 'm', '01-19-2015'),
(223, 25, 18, 'm', '01-19-2015'),
(224, 26, 18, 'm', '01-19-2015'),
(225, 27, 18, 'm', '01-19-2015'),
(226, 28, 18, 'm', '01-19-2015'),
(227, 29, 18, 'nm', '01-19-2015'),
(228, 30, 18, 'm', '01-19-2015'),
(229, 31, 18, 'nm', '01-19-2015'),
(230, 32, 18, 'p', '01-19-2015'),
(271, 33, 18, 'nm', '01-19-2015'),
(283, 23, 20, 'm', '01-19-2015'),
(285, 24, 20, 'p', '01-19-2015'),
(286, 25, 20, 'nm', '01-19-2015'),
(290, 26, 20, 'm', '01-19-2015'),
(291, 27, 20, 'nm', '01-19-2015'),
(292, 28, 20, 'p', '01-19-2015'),
(293, 29, 20, 'm', '01-19-2015'),
(294, 30, 20, 'm', '01-19-2015'),
(295, 31, 20, 'm', '01-19-2015'),
(296, 32, 20, 'nm', '01-19-2015'),
(297, 33, 20, 'p', '01-19-2015');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt`
--

CREATE TABLE IF NOT EXISTS `login_attempt` (
`id` int(11) NOT NULL,
  `date_tried` varchar(255) NOT NULL,
  `username_tried` varchar(255) NOT NULL,
  `ip_address_forwarded` varchar(255) NOT NULL,
  `ip_address_remote` varchar(255) NOT NULL,
  `outcome` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempt`
--

INSERT INTO `login_attempt` (`id`, `date_tried`, `username_tried`, `ip_address_forwarded`, `ip_address_remote`, `outcome`, `user_id`) VALUES
(2, '2015-01-30 23:02:48', 'nathanfrancy', '127.0.0.1', '127.0.0.1', 'success', 4),
(3, '2015-01-30 23:03:49', 'nathanfrancy', '127.0.0.1', '127.0.0.1', 'success', 4),
(4, '2015-01-30 23:04:37', 'nathanfrancy', '127.0.0.1', '127.0.0.1', 'fail', 100),
(5, '2015-01-30 23:07:01', 'williamsh', '127.0.0.1', '127.0.0.1', 'fail', 100),
(6, '2015-01-30 23:09:38', 'williamsh', 'not provided', '127.0.0.1', 'fail', 100),
(7, '2015-01-30 23:11:13', 'williamsh', 'not provided', '127.0.0.1', 'fail', 100),
(8, '2015-01-30 23:11:16', 'williamsh', 'not provided', '127.0.0.1', 'success', 5),
(9, '2015-01-30 23:11:54', 'nathanfrancy', 'not provided', '127.0.0.1', 'success', 4);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `prop_key` varchar(255) NOT NULL,
  `prop_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE IF NOT EXISTS `schoolyear` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `q1_start` varchar(255) NOT NULL,
  `q1_end` varchar(255) NOT NULL,
  `q2_start` varchar(255) NOT NULL,
  `q2_end` varchar(255) NOT NULL,
  `q3_start` varchar(255) NOT NULL,
  `q3_end` varchar(255) NOT NULL,
  `q4_start` varchar(255) NOT NULL,
  `q4_end` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`, `q1_start`, `q1_end`, `q2_start`, `q2_end`, `q3_start`, `q3_end`, `q4_start`, `q4_end`) VALUES
(8, '2014-2015', 4, '2014-08-16', '2014-10-15', '2014-10-16', '2014-12-12', '2015-01-06', '2015-03-15', '2015-03-16', '2015-05-14'),
(15, '2012-2013', 4, '2012-08-12', '2012-10-16', '2012-10-17', '2012-12-07', '2013-01-06', '2013-03-02', '2013-03-03', '2013-05-15'),
(16, '2014-2015', 5, '2014-08-16', '2014-10-21', '2014-10-22', '2014-12-13', '2015-01-04', '2015-03-14', '2015-03-15', '2015-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE IF NOT EXISTS `standard` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_given` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `title`, `description`, `date_given`, `schoolyear_id`) VALUES
(18, 'Free Throws', 'Free throws test', '2015-01-27', 8),
(20, 'Three Pointers', 'Ability to shoot three pointers', '2015-02-06', 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

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
(32, 'Tony', 'Kukoc', 8, 'enabled'),
(33, 'Cody', 'Williams', 8, 'enabled');

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
  `password` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'regular'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `theme`, `token`, `type`) VALUES
(4, 'Nathan', 'Francy', 'nathanfrancy', 'nathanfrancy@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'cyborg', '2IXVKcXwNYSZVbGuhHdpUFZXDMML6tsZUmV9RNY7YGO3dSIpMv', 'admin'),
(5, 'Hanna', 'Williams', 'williamsh', 'hannajowilliams@gmail.com', '924c63f6da566008a76d5d4a18ea0471c7d88c57', 'yeti', 'G6Xu4zarh6Tk18Gk9N4F4CR9gXP0MYVfRR9WkTRZ7Y62HH8i09', 'regular'),
(7, 'Kelvin', 'Francy', 'kfrancy', 'kfrancy@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'yeti', '3W6amyE73ZA8JFgvuqMVSzIFa2VVc2uGyUrapvdZHIeWAZTFeP', 'regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `student_id_2` (`student_id`,`standard_id`), ADD KEY `student_id` (`student_id`), ADD KEY `standard_id` (`standard_id`);

--
-- Indexes for table `login_attempt`
--
ALTER TABLE `login_attempt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
 ADD PRIMARY KEY (`prop_key`), ADD UNIQUE KEY `key` (`prop_key`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `standard`
--
ALTER TABLE `standard`
 ADD PRIMARY KEY (`id`), ADD KEY `schoolyear_id` (`schoolyear_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD KEY `schoolyear_id` (`schoolyear_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=298;
--
-- AUTO_INCREMENT for table `login_attempt`
--
ALTER TABLE `login_attempt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
