-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 05 maj 2014 kl 15:17
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
  `discipline` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`disciplineId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `alldisciplines`
--

INSERT INTO `alldisciplines` (`disciplineId`, `discipline`) VALUES
(10, '60 m'),
(20, '80 m'),
(30, '100 m'),
(40, '150 m'),
(50, '200 m'),
(60, '300 m'),
(70, '400 m'),
(80, '600 m'),
(90, '800 m'),
(100, '1000 m'),
(110, '1500 m'),
(120, '1 MILE'),
(130, '2000 m'),
(140, '3000 m'),
(150, '5000 m'),
(160, '10000 m'),
(170, '1500 m Hinder'),
(180, '2000 m Hinder'),
(190, '60 m Häck'),
(200, '80 m Häck'),
(210, '100 m Häck'),
(220, '110 m Häck'),
(230, '300 m Häck'),
(240, '400 m Häck'),
(250, 'Höjd'),
(260, 'Stav'),
(270, 'Längd'),
(280, 'Längd Zon'),
(290, 'Tresteg'),
(300, 'Tresteg Zon'),
(310, 'Kula'),
(320, 'Kula 6,0'),
(330, 'Kula 5,0'),
(340, 'Kula 4,0'),
(350, 'Kula 3,0'),
(360, 'Kula 2,0'),
(370, 'Diskus'),
(380, 'Diskus 1,75'),
(390, 'Diskus 1,5'),
(400, 'Diskus 1,0'),
(410, 'Diskus 0,6'),
(420, 'Slägga'),
(430, 'Slägga 6,0'),
(440, 'Slägga 5,0'),
(450, 'Slägga 4,0'),
(460, 'Slägga 3,0'),
(470, 'Slägga 2,0'),
(480, 'Spjut'),
(490, 'Spjut 700'),
(500, 'Spjut 600'),
(520, 'Spjut 400'),
(530, 'Bollkast'),
(540, 'Vikt'),
(550, '5x60 m'),
(560, '4x80 m'),
(570, '4x100 m'),
(580, 'Stafett 1000 m'),
(590, '4x400 m'),
(600, '3x600 m '),
(610, '3x800 m '),
(620, '4x800 m '),
(630, '3x1500 m '),
(640, '4x1500 m');

-- --------------------------------------------------------

--
-- Tabellstruktur `allyearclasses`
--

CREATE TABLE IF NOT EXISTS `allyearclasses` (
  `yearClassId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`yearClassId`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `clubs`
--

INSERT INTO `clubs` (`clubId`, `club`, `address`, `zip`, `phone`, `email`) VALUES
(1, 'Tjalve IK', 'Villagatan 18', '60247 Norrköping', '07366221', 'kontakt@tjalve.se'),
(3, 'Nynäshamnn HK', '97162916', 'Villagatan 18', 'Villagatan 18', 'ny@nas.se');

-- --------------------------------------------------------

--
-- Tabellstruktur `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
  `competitionId` int(255) NOT NULL AUTO_INCREMENT,
  `competitionName` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `lastDate` date NOT NULL,
  `organizer` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`competitionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `competition`
--

INSERT INTO `competition` (`competitionId`, `competitionName`, `dateFrom`, `dateTo`, `lastDate`, `organizer`, `logo`) VALUES
(10, 'Tjalve-open', '2014-07-05', '2014-07-06', '2014-05-20', 'Tjalve IK', 'upload/');

-- --------------------------------------------------------

--
-- Tabellstruktur `competitiondisciplines`
--

CREATE TABLE IF NOT EXISTS `competitiondisciplines` (
  `competitionId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `disciplineId` int(4) NOT NULL,
  KEY `competitionId` (`competitionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `competitiondisciplines`
--

INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `disciplineId`) VALUES
(10, 'P11', 150),
(10, 'P11', 160),
(10, 'P11', 170),
(10, 'M22', 30),
(10, 'M22', 40),
(10, 'M22', 50);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`) VALUES
(10, 8, 3, 'Lars Ohly', '1337', 'lars@ohly.riksdagen.se'),
(10, 9, 1, 'Nico', '7766551', 'Nico@hotmail.com'),
(10, 10, 1, 'Captial Captain', '4433225', 'CaptialCaptain@gmail.com');

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
  `contactId` int(11) NOT NULL,
  PRIMARY KEY (`participantId`),
  KEY `contactId` (`contactId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=18 ;

--
-- Dumpning av Data i tabell `participant`
--

INSERT INTO `participant` (`participantId`, `firstName`, `lastName`, `birthYear`, `bib`, `contactId`) VALUES
(17, 'Frasse', 'Frisse', 1989, 11, 10);

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
  `prio` int(1) NOT NULL,
  PRIMARY KEY (`pIndex`),
  KEY `participantId` (`participantId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=49 ;

--
-- Dumpning av Data i tabell `participantdisciplines`
--

INSERT INTO `participantdisciplines` (`participantId`, `pIndex`, `yearClass`, `discipline`, `SB`, `PB`, `prio`) VALUES
(17, 47, 'P11', '5000 m', '', '', 1),
(17, 48, 'P11', '10000 m', '', '', 2);

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
