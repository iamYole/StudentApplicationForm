-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2011 at 09:33 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studentinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `educational_info`
--

CREATE TABLE IF NOT EXISTS `educational_info` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `RegNo` int(10) unsigned NOT NULL,
  `PrimarySchool` varchar(70) NOT NULL,
  `LastSchool` varchar(70) NOT NULL,
  `LastClass` varchar(20) NOT NULL,
  `PresentClass` varchar(20) NOT NULL,
  `Category` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`,`RegNo`),
  KEY `FK_P_INFO` (`RegNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `educational_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `familiy_info`
--

CREATE TABLE IF NOT EXISTS `familiy_info` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `RegNo` int(10) unsigned NOT NULL,
  `FattherName` varchar(50) NOT NULL,
  `FPhone` decimal(18,0) NOT NULL,
  `FJob` varchar(30) NOT NULL,
  `Mothername` varchar(50) NOT NULL,
  `MPhone` decimal(18,0) default NULL,
  `MJob` varchar(50) NOT NULL,
  `SponsorName` varchar(50) NOT NULL,
  `SPhone` decimal(18,0) NOT NULL,
  `Doctor` varchar(45) NOT NULL,
  `Phone` decimal(18,0) NOT NULL,
  `Illness` varchar(70) default NULL,
  PRIMARY KEY  (`id`,`RegNo`),
  KEY `FK_F_INFO` (`RegNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `familiy_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `optionlists`
--

CREATE TABLE IF NOT EXISTS `optionlists` (
  `Category` varchar(20) NOT NULL,
  `Classes` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `optionlists`
--

INSERT INTO `optionlists` (`Category`, `Classes`) VALUES
('Nursery', 'Nursery'),
('Primary', 'Primary One'),
('Primary', 'Primary Two'),
('Primary', 'Primary Three'),
('Primary', 'Primary Four'),
('Primary', 'Primary Five'),
('Primary', 'Primary Six'),
('Secondary', 'JSS One'),
('Secondary', 'JSS Two'),
('Secondary', 'JSS Three'),
('Secondary', 'SSS One'),
('Secondary', 'SSS Two'),
('Secondary', 'SSS Three');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE IF NOT EXISTS `personal_info` (
  `RegNo` int(10) unsigned NOT NULL auto_increment,
  `Surname` varchar(45) NOT NULL,
  `MiddleName` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` decimal(18,0) default NULL,
  `DOB` date NOT NULL,
  `PlaceOfBirth` varchar(45) NOT NULL,
  `StateOfOrigin` varchar(45) NOT NULL,
  `Nationality` varchar(45) NOT NULL,
  `Religion` varchar(45) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `AdmissionStatus` varchar(15) NOT NULL default 'PENDING',
  `DateApplied` date NOT NULL,
  `DateAdmitted` date default NULL,
  PRIMARY KEY  (`RegNo`,`Surname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `personal_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `stafflogin`
--

CREATE TABLE IF NOT EXISTS `stafflogin` (
  `UserID` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Position` varchar(45) NOT NULL,
  PRIMARY KEY  (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafflogin`
--

INSERT INTO `stafflogin` (`UserID`, `Password`, `FirstName`, `LastName`, `Position`) VALUES
('Administrator', 'admin12345', 'Admin', 'Admin', 'System Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `student_image`
--

CREATE TABLE IF NOT EXISTS `student_image` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `RegNo` int(10) unsigned NOT NULL,
  `IMG_NAME` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`,`RegNo`),
  KEY `FK_S_Img` (`RegNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_image`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `educational_info`
--
ALTER TABLE `educational_info`
  ADD CONSTRAINT `FK_P_INFO` FOREIGN KEY (`RegNo`) REFERENCES `personal_info` (`RegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `familiy_info`
--
ALTER TABLE `familiy_info`
  ADD CONSTRAINT `FK_F_INFO` FOREIGN KEY (`RegNo`) REFERENCES `personal_info` (`RegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_image`
--
ALTER TABLE `student_image`
  ADD CONSTRAINT `FK_S_Img` FOREIGN KEY (`RegNo`) REFERENCES `personal_info` (`RegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
