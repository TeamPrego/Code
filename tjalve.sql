-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
<<<<<<< HEAD
-- Host: localhost
-- Generation Time: May 05, 2014 at 01:13 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12
=======
-- Värd: localhost
-- Skapad: 13 maj 2014 kl 10:39
-- Serverversion: 5.6.12-log
-- PHP-version: 5.4.12
>>>>>>> d9bac53153d34c664ac0af21ca60fd27f68542ef

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
  PRIMARY KEY (`disciplineId`),
  KEY `disciplineId` (`disciplineId`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `clubs`
--

INSERT INTO `clubs` (`clubId`, `club`, `address`, `zip`, `phone`, `email`) VALUES
(4, 'Tjalve IK', '', '', '', '');

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
<<<<<<< HEAD
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=10 ;
=======
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=13 ;
>>>>>>> d9bac53153d34c664ac0af21ca60fd27f68542ef

--
-- Dumpning av Data i tabell `competition`
--

INSERT INTO `competition` (`competitionId`, `competitionName`, `dateFrom`, `dateTo`, `lastDate`, `organizer`, `logo`) VALUES
<<<<<<< HEAD
(1, 'HannesTävling', '2014-05-23', '0000-00-00', '2014-05-15', 'TjalveAB', ''),
(2, 'EmmasTävling', '2014-05-17', '0000-00-00', '2014-03-21', 'Rolf', ''),
(3, 'hejeeee', '2014-12-12', '2014-12-15', '2011-10-09', 'din jävel', 'upload/tjalve_t.png'),
(4, 'funkar allt nu', '2014-12-12', '2014-12-15', '2011-10-09', 'snälla', 'upload/tjalve_logga.png'),
(5, 'funkar allt', '2014-12-12', '2014-12-15', '2011-10-09', 'din jävel', 'upload/tjalve_t.png'),
(6, 'test', '2014-12-12', '2014-12-15', '2011-10-09', 'jag', 'upload/tjalve_t.png'),
(7, 'ja men de ', '2014-12-12', '2014-12-15', '2011-10-09', 'funkar ju', 'upload/taskig_copy.jpg'),
(8, 'bänkartävlingen', '2014-12-12', '2014-12-15', '2011-10-09', 'din jävel', 'upload/tjalve_t.png'),
(9, 'funkar', '2014-12-12', '2014-12-15', '2011-10-09', 'fortfarande', 'upload/tjalve_t.png');
=======
(12, 'Tjalve-open', '2014-06-03', '2014-06-02', '2014-05-21', 'Tjalve IK', 'upload/');
>>>>>>> d9bac53153d34c664ac0af21ca60fd27f68542ef

-- --------------------------------------------------------

--
-- Tabellstruktur `competitiondisciplines`
--

CREATE TABLE IF NOT EXISTS `competitiondisciplines` (
  `competitionId` int(11) NOT NULL,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `disciplineId` int(4) NOT NULL,
  `competitionDisciplineId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`competitionDisciplineId`),
  KEY `competitionId` (`competitionId`),
  KEY `disciplineId` (`disciplineId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `competitiondisciplines`
--

<<<<<<< HEAD
INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `disciplineId`) VALUES
(1, 'P17', 0),
(1, 'P17', 0),
(1, 'P15', 0),
(1, 'P15', 0),
(2, 'P15', 0),
(2, 'P15', 0),
(1, 'F12', 0),
(2, 'F12', 0),
(2, 'F12', 0),
(2, 'F13', 0),
(2, 'F13', 0),
(2, 'P19', 0),
(3, 'P12', 100),
(3, 'P7', 100),
(3, 'P7', 110),
(3, 'P7', 120),
(3, 'P7', 150),
(3, 'P7', 170),
(3, 'P7', 180),
(3, 'P7', 160),
(3, 'P7', 250),
(4, 'P7', 40),
(4, 'P7', 50),
(4, 'P7', 60),
(4, 'P7', 70),
(4, 'P7', 80),
(4, 'P7', 90),
(4, 'K22', 590),
(4, 'K22', 600),
(4, 'K22', 610),
(4, 'K22', 620),
(4, 'K22', 630),
(4, 'K22', 640),
(6, 'P17', 20),
(6, 'P17', 30),
(6, 'P9', 30),
(6, 'P9', 70),
(6, 'P9', 80),
(6, 'P9', 210),
(6, 'P9', 330),
(6, 'P9', 620),
(8, 'P16', 20),
(8, 'P16', 30),
(8, 'P16', 40),
(8, 'P16', 50),
(8, 'P16', 60),
(8, 'P16', 70),
(8, 'P16', 80),
(8, 'P16', 90),
(8, 'P16', 100),
(8, 'P16', 110),
(8, 'P16', 120),
(8, 'P16', 130),
(8, 'P16', 140),
(8, 'P16', 150),
(8, 'P16', 160),
(8, 'P16', 170),
(8, 'P16', 180),
(8, 'P16', 190),
(8, 'P16', 200),
(8, 'P16', 210),
(8, 'P16', 220),
(8, 'P16', 230),
(8, 'P16', 240),
(8, 'P16', 250),
(8, 'P16', 260),
(8, 'P16', 270),
(8, 'P16', 280),
(8, 'P16', 290),
(8, 'P16', 300),
(8, 'P16', 310),
(8, 'P16', 320),
(8, 'P16', 330),
(8, 'P16', 340),
(8, 'P16', 350),
(8, 'P16', 360),
(8, 'P16', 370),
(8, 'P16', 380),
(8, 'P16', 390),
(8, 'P16', 400),
(8, 'P16', 410),
(8, 'P16', 420),
(8, 'P16', 430),
(8, 'P16', 440),
(8, 'P16', 450),
(8, 'P16', 460),
(8, 'P16', 470),
(8, 'P16', 480),
(8, 'P16', 490),
(8, 'P16', 500),
(8, 'P16', 520),
(8, 'P16', 530),
(8, 'P16', 540),
(8, 'P16', 550),
(8, 'P16', 560),
(8, 'P16', 570),
(8, 'P16', 580),
(8, 'P16', 590),
(8, 'P16', 600),
(8, 'P16', 610),
(8, 'P16', 620),
(8, 'P16', 630),
(8, 'P16', 640),
(9, 'P12', 10),
(9, 'P12', 20),
(9, 'P12', 30),
(9, 'P12', 40),
(9, 'P12', 50),
(9, 'P15', 20);
=======
INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `disciplineId`, `competitionDisciplineId`) VALUES
(12, 'P7', 10, 1),
(12, 'P7', 20, 2),
(12, 'P7', 30, 3),
(12, 'P8', 10, 4),
(12, 'P8', 20, 5),
(12, 'P8', 30, 6),
(12, 'P9', 10, 7),
(12, 'P9', 20, 8),
(12, 'P9', 30, 9);
>>>>>>> d9bac53153d34c664ac0af21ca60fd27f68542ef

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=14 ;

--
-- Dumpning av Data i tabell `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`) VALUES
(12, 12, 4, 'Anna', '07322112', 'anna@mail.com'),
(12, 13, 4, 'Fredrik Johnson', '082716239', 'fredrik@fredrik.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=25 ;

--
-- Dumpning av Data i tabell `participant`
--

INSERT INTO `participant` (`participantId`, `firstName`, `lastName`, `birthYear`, `bib`, `contactId`) VALUES
(21, 'hannes', 'Ingelhag', 1990, 0, 12),
(22, 'Emma', 'Arvidsson', 1990, 0, 13),
(23, 'Peter', 'Niklas', 1989, 0, 13),
(24, 'Hitler', 'Adolf', 1990, 0, 13);

-- --------------------------------------------------------

--
-- Tabellstruktur `participantdisciplines`
--

CREATE TABLE IF NOT EXISTS `participantdisciplines` (
  `participantId` int(11) NOT NULL,
  `pIndex` int(11) NOT NULL AUTO_INCREMENT,
  `SB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `PB` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `prio` int(1) NOT NULL,
  `competitionDisciplineId` int(255) NOT NULL,
  PRIMARY KEY (`pIndex`),
  KEY `participantId` (`participantId`),
  KEY `competitionDisciplineId` (`competitionDisciplineId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=71 ;

--
-- Dumpning av Data i tabell `participantdisciplines`
--

INSERT INTO `participantdisciplines` (`participantId`, `pIndex`, `SB`, `PB`, `prio`, `competitionDisciplineId`) VALUES
(21, 61, '11', '10', 1, 1),
(21, 62, '13', '12', 1, 2),
(21, 63, '18', '16', 1, 6),
(22, 64, '21', '20', 1, 4),
(22, 65, '23', '22', 1, 5),
(22, 66, '25', '24', 1, 6),
(23, 67, '89', '88', 1, 1),
(23, 68, '91', '90', 1, 2),
(24, 69, '8989', '898', 1, 7),
(24, 70, '686432', '8998', 1, 8);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `competitiondisciplines`
--
ALTER TABLE `competitiondisciplines`
  ADD CONSTRAINT `competitiondisciplines_ibfk_2` FOREIGN KEY (`disciplineId`) REFERENCES `alldisciplines` (`disciplineId`),
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
  ADD CONSTRAINT `participantdisciplines_ibfk_1` FOREIGN KEY (`participantId`) REFERENCES `participant` (`participantId`),
  ADD CONSTRAINT `participantdisciplines_ibfk_2` FOREIGN KEY (`competitionDisciplineId`) REFERENCES `competitiondisciplines` (`competitionDisciplineId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
