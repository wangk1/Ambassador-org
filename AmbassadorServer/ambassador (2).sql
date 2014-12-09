-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2014 at 04:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ambassador`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(11) NOT NULL,
  `type` enum('student','company') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `type`) VALUES
(11, 'student'),
(12, 'company'),
(13, 'company'),
(14, 'student'),
(15, 'company'),
(16, 'company'),
(17, 'company'),
(18, 'company'),
(19, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `ID` int(11) DEFAULT NULL,
  `shortname` varchar(10) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`ID`, `shortname`, `city`, `country`, `state`, `website`, `name`) VALUES
(14, 'apple', 'Coupertino', 'USA', 'CA', 'www.apple.com', 'Apple Inc.');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `ID` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `email`, `password`) VALUES
(12, 'google@gogle.com', 'password'),
(11, 'kw1993oct@yahoo.com', 'sdfa32&dsfa');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
  `ID` int(11) DEFAULT NULL,
  `MID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `majortype`
--

CREATE TABLE IF NOT EXISTS `majortype` (
  `MID` int(11) NOT NULL,
  `MajorName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

CREATE TABLE IF NOT EXISTS `minor` (
  `ID` int(11) DEFAULT NULL,
  `MID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`pid` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `posteddate` date DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`pid`, `id`, `enddate`, `posteddate`, `sid`, `title`) VALUES
(1, 14, '2014-12-09', '2014-12-09', -1, 'Some great position'),
(2, 14, '2014-12-09', '2014-12-09', -1, 'Some great position'),
(3, 14, '2014-12-09', '2014-12-09', -1, 'Some great position');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
`SID` int(11) NOT NULL,
  `SchoolName` varchar(20) NOT NULL,
  `City` varchar(15) DEFAULT NULL,
  `State` varchar(15) DEFAULT NULL,
  `COUNTRY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`SID`, `SchoolName`, `City`, `State`, `COUNTRY`) VALUES
(-1, 'none', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL,
  `sid` int(11) DEFAULT '-1',
  `first` varchar(15) NOT NULL,
  `last` varchar(15) NOT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `sid`, `first`, `last`, `year`) VALUES
(11, -1, 'Kevin', 'Wang', NULL),
(12, -1, 'Kev', 'KK', 2018),
(14, -1, 'Kevin', 'Wang3', 2018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
 ADD KEY `CompanyIDFK` (`ID`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
 ADD KEY `id` (`id`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`email`), ADD KEY `LoginIDFK` (`ID`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
 ADD KEY `MajorIDFK` (`ID`), ADD KEY `MajorMIDFK` (`MID`);

--
-- Indexes for table `majortype`
--
ALTER TABLE `majortype`
 ADD PRIMARY KEY (`MID`);

--
-- Indexes for table `minor`
--
ALTER TABLE `minor`
 ADD KEY `MinorIDFK` (`ID`), ADD KEY `MinorMIDFK` (`MID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`pid`), ADD KEY `PostsIDFK` (`id`), ADD KEY `PostsSIDFK` (`sid`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
 ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD KEY `IDFK` (`ID`), ADD KEY `SIDFK` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
ADD CONSTRAINT `CompanyIDFK` FOREIGN KEY (`ID`) REFERENCES `account` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id`) REFERENCES `student` (`ID`),
ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `posts` (`pid`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
ADD CONSTRAINT `LoginIDFK` FOREIGN KEY (`ID`) REFERENCES `account` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `major`
--
ALTER TABLE `major`
ADD CONSTRAINT `MajorIDFK` FOREIGN KEY (`ID`) REFERENCES `student` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `MajorMIDFK` FOREIGN KEY (`MID`) REFERENCES `majortype` (`MID`) ON DELETE CASCADE;

--
-- Constraints for table `minor`
--
ALTER TABLE `minor`
ADD CONSTRAINT `MinorIDFK` FOREIGN KEY (`ID`) REFERENCES `student` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `MinorMIDFK` FOREIGN KEY (`MID`) REFERENCES `majortype` (`MID`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `PostsIDFK` FOREIGN KEY (`id`) REFERENCES `company` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `PostsSIDFK` FOREIGN KEY (`sid`) REFERENCES `school` (`SID`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `IDFK` FOREIGN KEY (`ID`) REFERENCES `account` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `SIDFK` FOREIGN KEY (`SID`) REFERENCES `school` (`SID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
