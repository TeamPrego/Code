-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 09 apr 2014 kl 08:15
-- Serverversion: 5.6.12-log
-- PHP-version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `tjalve`
--
CREATE DATABASE IF NOT EXISTS `tjalve` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `tjalve`;

-- --------------------------------------------------------

--
-- Tabellstruktur `alldisciplines`
--

CREATE TABLE IF NOT EXISTS `alldisciplines` (
  `disciplineId` int(11) NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `alldisciplines`
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
-- Tabellstruktur `allyearclasses`
--

CREATE TABLE IF NOT EXISTS `allyearclasses` (
  `yearClassId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `allyearclasses`
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
-- Tabellstruktur `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `clubId` int(11) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`clubId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `clubs`
--

INSERT INTO `clubs` (`clubId`, `club`, `address`, `zip`, `phone`, `email`) VALUES
(1, 'Tjalve IK', 'Villagatan 18', '60247 Norrköping', '07366221', 'kontakt@tjalve.se'),
(2, 'LinnéaKlubb', '', '', '8739734973', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
  `competitionId` int(255) NOT NULL AUTO_INCREMENT,
  `competitionName` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `lastDate` date NOT NULL,
  `organizer` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`competitionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `competition`
--

INSERT INTO `competition` (`competitionId`, `competitionName`, `date`, `lastDate`, `organizer`, `logo`) VALUES
(1, 'HannesTävling', '2014-04-16', '2014-04-04', 'TjalveAB', ''),
(2, 'EmmasTävling', '2014-04-02', '2014-03-28', 'Rolf', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `competitiondisciplines`
--

CREATE TABLE IF NOT EXISTS `competitiondisciplines` (
  `competitionId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  KEY `competitionId` (`competitionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `competitiondisciplines`
--

INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `discipline`) VALUES
(1, 'P17', 'Spjut'),
(1, 'P17', 'Kula'),
(1, 'P15', '100 m'),
(1, 'P15', '200 m'),
(2, 'P15', 'SpringHopp'),
(2, 'P15', '1000 m'),
(1, 'F12', 'Höjdhopp');

-- --------------------------------------------------------

--
-- Tabellstruktur `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `competitionId` int(11) NOT NULL,
  `contactId` int(11) NOT NULL AUTO_INCREMENT,
  `clubId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `phone` text COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`contactId`),
  KEY `competitionId` (`competitionId`),
  KEY `clubId` (`clubId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`) VALUES
(1, 2, 1, 'Maria Montazami', '07163871', 'Maria@mail.com'),
(2, 3, 1, 'Yngve Malmsten', '5472615', 'Malmsten@hopp.se'),
(1, 4, 2, 'Linnéa', '73737', 'lin@mail.com'),
(1, 5, 1, 'Hannes', '82726', 'hannesingelhag@hotmail.com');

-- --------------------------------------------------------

--
-- Tabellstruktur `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `participantId` int(255) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `birthYear` int(4) NOT NULL,
  `bib` int(11) NOT NULL,
  `prio` tinyint(1) NOT NULL,
  `contactId` int(11) NOT NULL,
  PRIMARY KEY (`participantId`),
  KEY `contactId` (`contactId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `participant`
--

INSERT INTO `participant` (`participantId`, `firstName`, `lastName`, `birthYear`, `bib`, `prio`, `contactId`) VALUES
(1, 'Hannes', 'Ingelhag', 1990, 0, 1, 2),
(5, 'Fredrik', 'Johnson', 1990, 0, 0, 3),
(6, 'Linnéa', 'NÅ', 1990, 0, 1, 4),
(7, 'Erik', 'Broberg', 1987, 0, 1, 4),
(8, 'Emma', 'Korv', 1987, 0, 0, 5),
(11, 'Emma', 'Pemma', 1901, 0, 0, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `participantdisciplines`
--

CREATE TABLE IF NOT EXISTS `participantdisciplines` (
  `participantId` int(11) NOT NULL,
  `pIndex` int(11) NOT NULL AUTO_INCREMENT,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `SB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `PB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`pIndex`),
  KEY `participantId` (`participantId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=35 ;

--
-- Dumpning av Data i tabell `participantdisciplines`
--

INSERT INTO `participantdisciplines` (`participantId`, `pIndex`, `yearClass`, `discipline`, `SB`, `PB`) VALUES
(1, 1, 'P15', '100 m', '', ''),
(1, 2, 'P15', '200 m', '', ''),
(5, 8, 'P15', '100 m', '', ''),
(5, 9, 'P15', '200 m', '', ''),
(6, 10, 'P17', 'Spjut', '25', '30'),
(6, 11, 'P17', 'Kula', '', ''),
(7, 12, 'P15', '100 m', '', ''),
(7, 13, 'P15', '200 m', '', ''),
(8, 14, 'P17', 'Spjut', '', ''),
(8, 15, 'P17', 'Kula', '', ''),
(8, 28, 'F12', 'Höjdhopp', '', ''),
(11, 29, 'P17', 'Spjut', '', ''),
(11, 30, 'F12', 'Höjdhopp', '', ''),
(8, 31, 'P15', '200 m', '', '');

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `competitiondisciplines`
--
ALTER TABLE `competitiondisciplines`
  ADD CONSTRAINT `competitiondisciplines_ibfk_1` FOREIGN KEY (`competitionId`) REFERENCES `competition` (`competitionId`);

--
-- Restriktioner för tabell `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`competitionId`) REFERENCES `competition` (`competitionId`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`clubId`) REFERENCES `clubs` (`clubId`);

--
-- Restriktioner för tabell `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`contactId`) REFERENCES `contact` (`contactId`);

--
-- Restriktioner för tabell `participantdisciplines`
--
ALTER TABLE `participantdisciplines`
  ADD CONSTRAINT `participantdisciplines_ibfk_1` FOREIGN KEY (`participantId`) REFERENCES `participant` (`participantId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
