-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Värd: mydb9.surf-town.net
-- Skapad: 19 maj 2014 kl 08:45
-- Serverversion: 5.1.49-log
-- PHP-version: 5.3.3-7+squeeze19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `Tjalve_prego`
--

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
  `yearClassId` int(11) NOT NULL AUTO_INCREMENT,
  `yearClass` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`yearClassId`),
  UNIQUE KEY `yearClassId` (`yearClassId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=50 ;

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
(47, 'K75'),
(48, 'K'),
(49, 'M');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=15 ;

--
-- Dumpning av Data i tabell `clubs`
--

INSERT INTO `clubs` (`clubId`, `club`, `address`, `zip`, `phone`, `email`) VALUES
(9, 'GoIF Tjalve', '', '', '011-133702', 'friidrott@tjalve.nu'),
(10, 'Linköpings GIF', '', '', '', 'kansli@lgif.se'),
(11, 'Upsala IF', '', '', '0707162439', 'richard@friidrottsgymnasiet.se'),
(12, 'Hammarby IF', 'Enskedevägen 95', '12263 Enskede ', '08-6480320 ', 'kansliet@hiffri.se'),
(13, 'Ullevi FK', 'Friidrottens Hus', '414 76Göteborg', '', 'vikingen@ullevi.nu'),
(14, 'Ullevi FK', '', '', '', 'vikingen@ullevi.nu');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=15 ;

--
-- Dumpning av Data i tabell `competition`
--

INSERT INTO `competition` (`competitionId`, `competitionName`, `dateFrom`, `dateTo`, `lastDate`, `organizer`, `logo`) VALUES
(14, 'East Sweden Games', '2014-05-31', '2014-06-01', '2014-05-25', 'LGIF och GOIF Tjalve', 'upload/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=154 ;

--
-- Dumpning av Data i tabell `competitiondisciplines`
--

INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `disciplineId`, `competitionDisciplineId`) VALUES
(14, 'F9', 10, 19),
(14, 'F9', 80, 20),
(14, 'F9', 270, 21),
(14, 'F9', 530, 22),
(14, 'F10', 10, 23),
(14, 'F10', 80, 24),
(14, 'F10', 270, 25),
(14, 'F10', 310, 26),
(14, 'F13', 80, 27),
(14, 'F13', 190, 28),
(14, 'F13', 250, 29),
(14, 'F13', 270, 30),
(14, 'F13', 310, 31),
(14, 'F13', 420, 32),
(14, 'F15', 90, 33),
(14, 'F15', 200, 34),
(14, 'F15', 230, 35),
(14, 'F15', 260, 36),
(14, 'F15', 290, 37),
(14, 'F15', 310, 38),
(14, 'F15', 420, 39),
(14, 'F17', 50, 40),
(14, 'F17', 90, 41),
(14, 'F17', 140, 42),
(14, 'F17', 210, 43),
(14, 'F17', 230, 44),
(14, 'F17', 260, 45),
(14, 'F17', 290, 46),
(14, 'F17', 420, 47),
(14, 'F17', 480, 48),
(14, 'K', 50, 49),
(14, 'K', 90, 50),
(14, 'K', 140, 51),
(14, 'K', 210, 52),
(14, 'K', 240, 53),
(14, 'K', 260, 54),
(14, 'K', 270, 55),
(14, 'K', 420, 56),
(14, 'K', 480, 57),
(14, 'P9', 10, 58),
(14, 'P9', 80, 59),
(14, 'P9', 270, 60),
(14, 'P9', 530, 61),
(14, 'P10', 10, 62),
(14, 'P10', 80, 63),
(14, 'P10', 270, 64),
(14, 'P10', 310, 65),
(14, 'P13', 80, 66),
(14, 'P13', 190, 67),
(14, 'P13', 250, 68),
(14, 'P13', 290, 69),
(14, 'P13', 310, 70),
(14, 'P13', 370, 71),
(14, 'P15', 90, 72),
(14, 'P15', 200, 73),
(14, 'P15', 260, 74),
(14, 'P15', 290, 75),
(14, 'P15', 310, 76),
(14, 'P15', 370, 77),
(14, 'P17', 50, 78),
(14, 'P17', 90, 79),
(14, 'P17', 220, 80),
(14, 'P17', 230, 81),
(14, 'P17', 260, 82),
(14, 'P17', 290, 83),
(14, 'P17', 310, 84),
(14, 'P17', 480, 85),
(14, 'M', 50, 86),
(14, 'M', 90, 87),
(14, 'M', 140, 88),
(14, 'M', 220, 89),
(14, 'M', 240, 90),
(14, 'M', 260, 91),
(14, 'M', 270, 92),
(14, 'M', 310, 93),
(14, 'M', 480, 94),
(14, 'F11', 10, 100),
(14, 'F11', 80, 101),
(14, 'F11', 250, 102),
(14, 'F11', 270, 103),
(14, 'F11', 310, 104),
(14, 'F13', 10, 105),
(14, 'F13', 50, 106),
(14, 'F13', 290, 107),
(14, 'F13', 370, 108),
(14, 'F13', 480, 109),
(14, 'F15', 20, 110),
(14, 'F15', 60, 111),
(14, 'F15', 130, 112),
(14, 'F15', 250, 113),
(14, 'F15', 270, 114),
(14, 'F15', 370, 115),
(14, 'F15', 480, 116),
(14, 'F17', 30, 117),
(14, 'F17', 70, 118),
(14, 'F17', 250, 119),
(14, 'F17', 270, 120),
(14, 'F17', 310, 121),
(14, 'F17', 370, 122),
(14, 'F17', 610, 123),
(14, 'K', 30, 124),
(14, 'K', 70, 125),
(14, 'K', 110, 126),
(14, 'K', 250, 127),
(14, 'K', 290, 128),
(14, 'K', 310, 129),
(14, 'K', 370, 130),
(14, 'P11', 10, 131),
(14, 'P11', 80, 132),
(14, 'P11', 250, 133),
(14, 'P11', 270, 134),
(14, 'P11', 310, 135),
(14, 'P13', 10, 136),
(14, 'P13', 50, 137),
(14, 'P13', 270, 138),
(14, 'P13', 420, 139),
(14, 'P13', 480, 140),
(14, 'P15', 20, 141),
(14, 'P15', 60, 142),
(14, 'P15', 130, 143),
(14, 'P15', 250, 144),
(14, 'P15', 270, 145),
(14, 'P15', 420, 146),
(14, 'P15', 480, 147),
(14, 'P17', 30, 148),
(14, 'P17', 70, 149),
(14, 'P17', 110, 150),
(14, 'P17', 250, 151),
(14, 'P17', 370, 152),
(14, 'P17', 420, 153);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=38 ;

--
-- Dumpning av Data i tabell `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`) VALUES
(14, 18, 10, 'Henrik Sjöberg', '013-474 25 03 ', 'kansli@lgif.se'),
(14, 19, 11, 'Richard Andersson', '0707162439', 'richard@friidrottsgymnasiet.se'),
(14, 20, 10, 'Tilde Jönsson ', '0703553092', 'jerry-jerry@hotmail.com'),
(14, 21, 10, 'Magnus grey', '46708428619', 'magnus.n.grey@gmail.com'),
(14, 22, 4, 'Magnus grey', '46708428619', 'magnus.n.grey@gmail.com'),
(14, 23, 9, 'Elisa Aapola', '0760187090', 'elisa@aapola.se'),
(14, 24, 11, '', '', ''),
(14, 25, 10, 'Thomas Karlsson', '0734184499', 'thomas.karlsson@boremail.com'),
(14, 26, 10, 'Mattias Johansson', '0738402004', 'mattias.k.johansson@live.se'),
(14, 27, 10, 'Mattias Johansson', '0738402004', 'mattias.k.johansson@live.se'),
(14, 28, 9, 'Elisa Aapola', '0760-187090', 'elisa@aapola.se'),
(14, 29, 10, 'Max Hrelja', '0727198989', 'max.hrelja@hotmail.com'),
(14, 30, 10, 'Lisa Svensson', '46709491605', 'jan1969@spray.se'),
(14, 31, 10, 'Peter Isacsson', '0730436443', 'peter.l.isacsson@ericsson.com'),
(14, 32, 9, 'Sara Söderberg', '0700432566', 's.soderberg_@hotmail.com'),
(14, 33, 10, 'Karin Hedberg', '0708-211740', 'karin@alemyr.se'),
(14, 34, 11, 'Richard Andersson', '0707162439', 'richard@friidrottsgymnasiet.se'),
(14, 35, 12, 'Marina Janhunen', '08-6480320', 'marinajcalderon@gmail.com'),
(14, 36, 10, 'Henrik Sjöberg', '013-474 25 03', 'kansli@lgif.se'),
(14, 37, 14, 'David Vendel', '011-133702', 'david.vendel@live.se');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=66 ;

--
-- Dumpning av Data i tabell `participant`
--

INSERT INTO `participant` (`participantId`, `firstName`, `lastName`, `birthYear`, `bib`, `contactId`) VALUES
(43, 'Rebecka', 'Sjöberg', 2002, 0, 18),
(44, 'Elias', 'Sköld', 2002, 0, 18),
(45, 'Ida', 'Ekroth', 1996, 0, 19),
(46, 'Matilde', 'Andersson', 1996, 0, 19),
(47, 'Sara', 'Erza', 1997, 0, 19),
(48, 'Elsa', 'Herlitz', 1997, 0, 19),
(49, 'Klara', 'Pedersen', 1997, 0, 19),
(50, 'Paulina', 'Toresäter', 1997, 0, 19),
(51, 'Hedvig', 'Engström Kindmark', 1997, 0, 19),
(52, 'Tilde', 'Jönsson', 2002, 0, 20),
(53, 'Amanda ', 'Jönsson ', 2004, 0, 20),
(54, 'Sebastian', 'Grey', 2001, 0, 21),
(55, 'Tim', 'Grey', 2004, 0, 21),
(56, 'Fabian ', 'Strömberg', 2004, 0, 28),
(57, 'Max ', 'Hrelja', 0, 0, 29),
(58, 'Lisa', 'Svensson', 1997, 0, 30),
(59, 'Hugo', 'Karlsson', 2003, 0, 25),
(60, 'Michael', 'Welspar', 1997, 0, 34),
(61, 'Filip', 'Björklund', 1998, 0, 34),
(62, 'Marina', 'Janhunen', 1998, 0, 35),
(63, 'Rebecka', 'Sjöberg', 2002, 0, 36),
(64, 'Melina', 'Holse', 1999, 0, 36),
(65, 'Dennis', 'Forsman', 1995, 0, 37);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=154 ;

--
-- Dumpning av Data i tabell `participantdisciplines`
--

INSERT INTO `participantdisciplines` (`participantId`, `pIndex`, `SB`, `PB`, `prio`, `competitionDisciplineId`) VALUES
(43, 112, '', '9,04', 1, 105),
(43, 113, '', '', 1, 106),
(44, 114, '', '', 1, 140),
(45, 115, '', '27,42', 1, 49),
(46, 116, '', 'U.T', 1, 46),
(47, 117, '', '', 1, 46),
(48, 118, '', '', 1, 46),
(49, 119, '', '', 1, 46),
(50, 120, '', '', 1, 46),
(51, 121, '', '', 1, 46),
(52, 122, '', '6,86', 1, 31),
(52, 123, '', '', 1, 32),
(52, 124, '', '', 1, 108),
(53, 125, '', '4,17', 1, 26),
(54, 126, '', '8,89', 1, 136),
(54, 127, '', '29,12', 1, 137),
(54, 128, '', '', 1, 140),
(55, 129, '', '', 1, 131),
(55, 130, '', '', 1, 134),
(56, 131, '', '', 1, 62),
(56, 132, '', '', 1, 63),
(56, 133, '', '', 1, 64),
(56, 134, '', '', 1, 65),
(57, 135, '', '', 1, 78),
(57, 136, '', '', 1, 80),
(57, 137, '', '', 1, 148),
(59, 138, '9,77', '9,77', 1, 131),
(59, 139, '1.59,35', '1.59,35', 1, 132),
(59, 140, '1,27', '1,27', 1, 133),
(59, 141, '3,58', '3,58', 1, 134),
(60, 142, '', '', 1, 83),
(61, 143, '', '', 1, 80),
(61, 144, '', '', 1, 81),
(62, 145, '', '', 1, 44),
(62, 146, '', '', 1, 118),
(63, 147, '', '', 1, 29),
(63, 148, '', '', 1, 30),
(63, 149, '', '', 1, 31),
(64, 150, '', '', 1, 37),
(64, 151, '', '', 1, 110),
(64, 152, '', '', 1, 114),
(65, 153, '', '21,52', 1, 86);

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
-- Restriktioner för tabell `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`contactId`) REFERENCES `contact` (`contactId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
