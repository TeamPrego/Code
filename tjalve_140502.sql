-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2014 at 03:26 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tjalve`
--

-- --------------------------------------------------------

--
-- Table structure for table `alldisciplines`
--

CREATE TABLE `alldisciplines` (
  `disciplineId` int(11) NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `alldisciplines`
--

INSERT INTO `alldisciplines` (`disciplineId`, `discipline`) VALUES
(1, '60 m'),
(2, '80 m'),
(3, '100 m'),
(4, '150 m'),
(5, '200 m'),
(6, '300 m'),
(7, '400 m'),
(8, '600 m'),
(9, '800 m'),
(10, '1000 m'),
(11, '1500 m'),
(12, '1 MILE'),
(13, '2000 m'),
(14, '3000 m'),
(15, '5000 m'),
(16, '10000 m'),
(17, '1500 m Hinder'),
(18, '2000 m Hinder'),
(19, '60 m Häck'),
(20, '80 m Häck'),
(21, '100 m Häck'),
(22, '110 m Häck'),
(23, '300 m Häck'),
(24, '400 m Häck'),
(25, 'Höjd'),
(26, 'Stav'),
(27, 'Längd'),
(28, 'Längd Zon'),
(29, 'Tresteg'),
(30, 'Tresteg Zon'),
(31, 'Kula'),
(32, 'Kula 6,0'),
(33, 'Kula 5,0'),
(34, 'Kula 4,0'),
(35, 'Kula 3,0'),
(36, 'Kula 2,0'),
(37, 'Diskus'),
(38, 'Diskus 1,75'),
(39, 'Diskus 1,5'),
(40, 'Diskus 1,0'),
(41, 'Diskus 0,6'),
(42, 'Slägga'),
(43, 'Slägga 6,0'),
(44, 'Slägga 5,0'),
(45, 'Slägga 4,0'),
(46, 'Slägga 3,0'),
(47, 'Slägga 2,0'),
(48, 'Spjut'),
(49, 'Spjut 700'),
(50, 'Spjut 600'),
(52, 'Spjut 400'),
(53, 'Bollkast'),
(54, 'Vikt'),
(55, '5x60 m'),
(56, '4x80 m'),
(57, '4x100 m'),
(58, 'Stafett 1000 m'),
(59, '4x400 m'),
(60, '3x600 m '),
(61, '3x800 m '),
(62, '4x800 m '),
(63, '3x1500 m '),
(64, '4x1500 m');

-- --------------------------------------------------------

--
-- Table structure for table `allyearclasses`
--

CREATE TABLE `allyearclasses` (
  `yearClassId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `allyearclasses`
--

INSERT INTO `allyearclasses` (`yearClassId`, `yearClass`) VALUES
(1, 'Män'),
(2, 'M22'),
(3, 'P19'),
(4, 'P17'),
(5, 'P16'),
(6, 'P15'),
(7, 'P14'),
(8, 'P13'),
(9, 'P12'),
(10, 'P11'),
(11, 'P10'),
(12, 'P9'),
(13, 'P8'),
(14, 'P7'),
(15, 'M35'),
(16, 'M40'),
(17, 'M45'),
(18, 'M50'),
(19, 'M55'),
(20, 'M60'),
(21, 'M65'),
(22, 'M70'),
(23, 'M75'),
(24, 'Kvinnor'),
(25, 'K22'),
(26, 'F19'),
(27, 'F19'),
(28, 'F17'),
(29, 'F16'),
(30, 'F15'),
(31, 'F14'),
(32, 'F13'),
(33, 'F12'),
(34, 'F11'),
(35, 'F10'),
(36, 'F9'),
(37, 'F8'),
(38, 'F7'),
(39, 'K35'),
(40, 'K40'),
(41, 'K45'),
(42, 'K50'),
(43, 'K55'),
(44, 'K60'),
(45, 'K65'),
(46, 'K70'),
(47, 'K75');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `clubId` int(11) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`clubId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`clubId`, `club`, `address`, `zip`, `phone`, `email`) VALUES
(1, 'Emmas Klubb', '', '', '', ''),
(2, 'Hannes IK', '', '', '', ''),
(3, 'Sebbes FK', '', '', '', ''),
(4, 'Gurras IFK', '', '', '', ''),
(5, 'Thereses Friidrott', '', '', '', ''),
(6, 'Tobbes Klubb', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `competitionId` int(255) NOT NULL AUTO_INCREMENT,
  `competitionName` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `lastDate` date NOT NULL,
  `organizer` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`competitionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`competitionId`, `competitionName`, `date`, `lastDate`, `organizer`, `logo`) VALUES
(1, 'Emmas tävling', '2014-05-01', '2014-06-16', '', ''),
(2, 'Hannes påsktävling', '2014-04-25', '2014-06-20', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `competitiondisciplines`
--

CREATE TABLE `competitiondisciplines` (
  `competitionId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  KEY `competitionId` (`competitionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `competitiondisciplines`
--

INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `discipline`) VALUES
(1, 'F10', 'Höjdhopp'),
(1, 'F10', 'Kula'),
(1, 'P10', 'Höjdhopp'),
(1, 'P10', 'Kula'),
(1, 'P12', 'Höjdhopp'),
(1, 'P12', 'Kula'),
(1, 'F12', 'Kula'),
(1, 'F12', 'Spjut'),
(1, 'F12', 'Höjdhopp'),
(1, 'F10', 'Spjut'),
(1, 'P10', 'Spjut'),
(1, 'P12', 'Spjut'),
(2, 'P10', 'Spjut'),
(2, 'P10', 'Höjdhopp'),
(2, 'P10', 'Kula'),
(2, 'F10', 'Höjdhopp'),
(2, 'F10', 'Kula'),
(2, 'F10', 'Spjut'),
(2, 'F12', 'Höjdhopp'),
(2, 'F12', 'Kula'),
(2, 'F12', 'Spjut'),
(2, 'P12', 'Höjdhopp'),
(2, 'P12', 'Kula'),
(2, 'P12', 'Spjut'),
(2, 'F12', 'Kullerbytta');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `competitionId` int(11) NOT NULL,
  `contactId` int(11) NOT NULL AUTO_INCREMENT,
  `clubId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `phone` text COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`contactId`),
  KEY `competitionId` (`competitionId`),
  KEY `clubId` (`clubId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`) VALUES
(2, 1, 2, 'Anna Palmerius', '', ''),
(2, 2, 4, 'Maria Nygren', '', ''),
(1, 3, 1, 'Karin Salander', '', ''),
(1, 4, 4, 'Malin Abrahamsson', '', ''),
(2, 5, 3, 'Svea Jönsson', '', ''),
(1, 6, 5, 'Eva Albrektsdotter', '', ''),
(1, 7, 2, 'Jonas Unger', '090909', 'j.u@mail.se'),
(1, 8, 1, 'Mary Nygreen', '073123', 'mn@mn.se'),
(1, 9, 1, 'Emmis', '000009', 'emsi@emsi.se');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `participantId` int(255) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `birthYear` int(4) NOT NULL,
  `bib` int(11) NOT NULL,
  `prio` tinyint(1) NOT NULL,
  `contactId` int(11) NOT NULL,
  PRIMARY KEY (`participantId`),
  KEY `contactId` (`contactId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participantId`, `firstName`, `lastName`, `birthYear`, `bib`, `prio`, `contactId`) VALUES
(3, 'Emma', 'Edvardsson', 1989, 1, 1, 3),
(4, 'Hannes', 'Ingelhag', 1998, 2, 1, 4),
(6, 'Sebastian', 'Alfredsson', 1987, 3, 1, 6),
(7, 'Gustav', 'Hallström', 1994, 5, 1, 2),
(8, 'Tobias', 'Erlandsson', 1997, 4, 1, 1),
(9, 'Therese', 'Ramböl', 2005, 6, 1, 5),
(10, 'Lena', 'Karlsson', 1955, 0, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `participantdisciplines`
--

CREATE TABLE `participantdisciplines` (
  `participantId` int(11) NOT NULL,
  `pIndex` int(11) NOT NULL AUTO_INCREMENT,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `SB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `PB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`pIndex`),
  KEY `participantId` (`participantId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `participantdisciplines`
--

INSERT INTO `participantdisciplines` (`participantId`, `pIndex`, `yearClass`, `discipline`, `SB`, `PB`) VALUES
(3, 1, 'P12', 'Höjdhopp', '', ''),
(3, 2, 'P10', '200 m', '', ''),
(4, 4, 'F12', 'Spjut', '', ''),
(6, 5, 'P12', 'Spjut', '', ''),
(7, 6, 'P10', 'Kula', '', ''),
(8, 7, 'F12', 'Höjdhopp', '', ''),
(8, 8, 'F12', 'Kula', '', ''),
(9, 10, 'P10', 'Spjut', '', ''),
(9, 11, 'P10', 'Kula', '', ''),
(10, 12, 'F12', 'Kula', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competitiondisciplines`
--
ALTER TABLE `competitiondisciplines`
  ADD CONSTRAINT `competitiondisciplines_ibfk_1` FOREIGN KEY (`competitionId`) REFERENCES `competition` (`competitionId`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`competitionId`) REFERENCES `competition` (`competitionId`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`clubId`) REFERENCES `clubs` (`clubId`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`contactId`) REFERENCES `contact` (`contactId`);

--
-- Constraints for table `participantdisciplines`
--
ALTER TABLE `participantdisciplines`
  ADD CONSTRAINT `participantdisciplines_ibfk_1` FOREIGN KEY (`participantId`) REFERENCES `participant` (`participantId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
