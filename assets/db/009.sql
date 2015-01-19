-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2015 at 04:09 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student_id`, `standard_id`, `rating`, `date_updated`) VALUES
(187, 1, 16, 'm', '01-18-2015'),
(188, 2, 16, 'm', '01-18-2015'),
(189, 3, 16, 'm', '01-18-2015'),
(190, 7, 16, 'm', '01-18-2015'),
(191, 8, 16, 'm', '01-18-2015'),
(192, 9, 16, 'm', '01-18-2015'),
(193, 10, 16, 'm', '01-18-2015'),
(194, 11, 16, 'nm', '01-18-2015'),
(195, 14, 16, 'nm', '01-18-2015'),
(196, 15, 16, 'nm', '01-18-2015'),
(197, 16, 16, 'nm', '01-18-2015'),
(198, 17, 16, 'p', '01-18-2015'),
(199, 18, 16, 'p', '01-18-2015'),
(200, 19, 16, 'p', '01-18-2015'),
(201, 20, 16, 'nm', '01-18-2015'),
(202, 21, 16, 'p', '01-18-2015'),
(203, 22, 16, 'm', '01-18-2015'),
(204, 1, 17, 'm', '01-18-2015'),
(205, 2, 17, 'm', '01-18-2015'),
(206, 3, 17, 'm', '01-18-2015'),
(207, 7, 17, 'm', '01-18-2015'),
(208, 8, 17, 'm', '01-18-2015'),
(209, 9, 17, 'p', '01-18-2015'),
(210, 10, 17, 'p', '01-18-2015'),
(211, 11, 17, 'p', '01-18-2015'),
(212, 14, 17, 'p', '01-18-2015'),
(213, 15, 17, 'nm', '01-18-2015'),
(214, 16, 17, 'nm', '01-18-2015'),
(215, 17, 17, 'nm', '01-18-2015'),
(216, 18, 17, 'nm', '01-18-2015'),
(217, 19, 17, 'm', '01-18-2015'),
(218, 20, 17, 'm', '01-18-2015'),
(219, 21, 17, 'm', '01-18-2015'),
(220, 22, 17, 'p', '01-18-2015'),
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `title`, `user_id`) VALUES
(1, '2014-2015', 1),
(2, '2013-2014', 1),
(6, '2012-2013', 1),
(7, '2011-2012', 1),
(8, '2014-2015', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `title`, `description`, `date_given`, `schoolyear_id`) VALUES
(16, 'Test Standard', 'Hello, this is a description', '2015-01-23', 1),
(17, 'Test Standard 2', 'Description of test standard 2', '2015-01-29', 1),
(18, 'Free Throws', 'Free throws test', '2015-01-30', 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
(22, 'Mary', 'Young', 1, 'enabled'),
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
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `theme`) VALUES
(1, 'Hanna', 'Williams', 'hannawilliams', 'hannajowilliams@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'cerulean'),
(4, 'Nathan', 'Francy', 'nathanfrancy', 'nathanfrancy@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'united');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `student_id_2` (`student_id`,`standard_id`), ADD KEY `student_id` (`student_id`), ADD KEY `standard_id` (`standard_id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=231;
--
-- AUTO_INCREMENT for table `quarter`
--
ALTER TABLE `quarter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
