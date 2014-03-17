-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2014 at 09:48 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

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

CREATE TABLE `age_class` (
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

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Phonenumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Adress` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Zip` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`Name`, `Phonenumber`, `Email`, `Adress`, `Zip`) VALUES
('Annasklubb', '03879438946', '', '', ''),
('Dagvalls IF', '1233456', '', 'Hemma', '14424 Hemma'),
('Emmas YK', '0735511822', '', '', ''),
('Hannes FK', 'soas', 'hannes@het.com', 'iosdhiosdioh', 'dsdship'),
('Hannes Nya Klubb', '073552211', '', '', ''),
('Philips egna', '073555 5 555 ', 'philip@hej.com', '', ''),
('SebClub', '012862', '', '', ''),
('Thereseesesesese', '98253810', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `competitionId` int(5) DEFAULT NULL,
  `contactId` int(5) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactPerson` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactPhone` int(14) DEFAULT NULL,
  PRIMARY KEY (`contactId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `club`, `contactPerson`, `contactEmail`, `contactPhone`) VALUES
(NULL, 11, '', 'Dagvall', 'dagvall@dagvall.dagvall', 123456),
(NULL, 12, '', 'Hannes', 'Ingelhag@sg.se', 356853),
(NULL, 13, 'Emmas YK', 'Emma', 'Rasmus270@hotmail.com', 467041),
(NULL, 14, 'Hannes FK', 'Hannes', 'hannesingelhag@hotmail.com', 16429),
(NULL, 15, 'Dagvalls IF', 'Tommy', 'tomas@hotmail.com', 736637722),
(NULL, 16, 'SebClub', 'Tobbe', 'Rasmus270@hotmail.com', 54545),
(NULL, 17, 'Annasklubb', 'Anna', 'anna@tjalve.nu', 73557722),
(NULL, 18, 'Philips egna', 'Philip', 'Rasmus270@hotmail.com', 1234),
(NULL, 19, 'Hannes FK', 'Hannes', 'hannesingelhag@hotmail.com', 1234),
(NULL, 20, 'Annasklubb', 'Hannes', 'hannesingelhag@hotmail.com', 73663772);

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `participantId` int(255) NOT NULL,
  `class` varchar(10) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `discipline` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `SB` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `PB` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`participantId`, `class`, `discipline`, `SB`, `PB`) VALUES
(69, 'P14', 'Höjdhopp', '', ''),
(69, 'P14', 'Längdhopp', '', ''),
(70, 'P11', 'Höjdhopp', '', ''),
(71, 'P14', 'Höjdhopp', '', ''),
(71, 'P14', 'Längdhopp', '', ''),
(72, 'P11', 'Höjdhopp', 'SB.Höjdhopp', 'PB.Höjdhopp'),
(72, 'P11', 'Längdhopp', 'SB.Längdhopp', 'PB.Längdhopp'),
(73, 'P12', 'Höjdhopp', 'b', 'a'),
(73, 'P12', 'Längdhopp', 'd', 'c'),
(74, 'P12', 'Höjdhopp', '', ''),
(74, 'P12', 'Längdhopp', '', ''),
(75, 'P11', 'Höjdhopp', '', ''),
(75, 'P11', 'Längdhopp', '', ''),
(76, 'P12', 'Höjdhopp', '', ''),
(76, 'P12', 'Längdhopp', '', ''),
(77, 'P11', 'Höjdhopp', '', ''),
(78, 'P11', 'Höjdhopp', '', ''),
(79, 'P12', 'Höjdhopp', '', ''),
(79, 'P12', 'Längdhopp', '', ''),
(80, 'P12', 'Höjdhopp', '', ''),
(80, 'P12', 'Längdhopp', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `contactId` int(5) NOT NULL,
  `participantId` int(5) NOT NULL AUTO_INCREMENT,
  `bib` int(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthYear` int(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  PRIMARY KEY (`participantId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`contactId`, `participantId`, `bib`, `firstName`, `lastName`, `birthYear`, `class`, `discipline`) VALUES
(11, 29, 0, 'Johan', 'Dagvalk', 1988, 'P12', ''),
(14, 34, 0, 'Hannes', 'Ingelhag', 1970, 'P14', ''),
(15, 35, 0, 'Erik', 'Johansson', 1998, 'P13', ''),
(14, 36, 0, 'Lovisa ', 'Dahl', 1991, 'P14', ''),
(17, 41, 0, 'Emma', 'Ed', 1987, 'P12', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
