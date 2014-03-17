-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2014 at 08:27 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `age_class`
--

CREATE TABLE IF NOT EXISTS `age_class` (
  `compID` int(11) NOT NULL AUTO_INCREMENT,
  `ageClass` varchar(4) NOT NULL,
  `event` varchar(40) NOT NULL,
  PRIMARY KEY (`compID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `age_class`
--

INSERT INTO `age_class` (`compID`, `ageClass`, `event`) VALUES
(1, '', 'gfsg'),
(2, '', 'hopp'),
(3, '', 'hopp'),
(4, '', 'spriiing!'),
(5, '', 'springa'),
(6, 'hej', 'hej'),
(7, '', ''),
(8, '', ''),
(9, '', ''),
(10, 'F10', ''),
(11, 'P10', 'springa långt'),
(12, 'F15', 'hoppa högt');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
