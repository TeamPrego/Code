-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 14 mars 2014 kl 08:08
-- Serverversion: 5.6.12-log
-- PHP-version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `submission`
--
CREATE DATABASE IF NOT EXISTS `submission` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `submission`;

-- --------------------------------------------------------

--
-- Tabellstruktur `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Phonenumber` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Adress` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Zip` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `clubs`
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
-- Tabellstruktur `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `competitionId` int(5) DEFAULT NULL,
  `contactId` int(5) NOT NULL AUTO_INCREMENT,
  `club` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactPerson` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `contactPhone` int(14) DEFAULT NULL,
  PRIMARY KEY (`contactId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumpning av Data i tabell `contact`
--

INSERT INTO `contact` (`competitionId`, `contactId`, `club`, `contactPerson`, `contactEmail`, `contactPhone`) VALUES
(NULL, 11, '', 'Dagvall', 'dagvall@dagvall.dagvall', 123456),
(NULL, 12, '', 'Hannes', 'Ingelhag@sg.se', 356853),
(NULL, 13, 'Emmas YK', 'Emma', 'Rasmus270@hotmail.com', 467041),
(NULL, 14, 'Hannes FK', 'Hannes', 'hannesingelhag@hotmail.com', 16429),
(NULL, 15, 'Dagvalls IF', 'Tommy', 'tomas@hotmail.com', 736637722),
(NULL, 16, 'SebClub', 'Tobbe', 'Rasmus270@hotmail.com', 54545),
(NULL, 17, 'Annasklubb', 'Anna', 'anna@tjalve.nu', 73557722),
(NULL, 18, 'Philips egna', 'Philip', 'Rasmus270@hotmail.com', 1234);

-- --------------------------------------------------------

--
-- Tabellstruktur `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `contactId` int(5) NOT NULL,
  `participantId` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthYear` int(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  PRIMARY KEY (`participantId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumpning av Data i tabell `participant`
--

INSERT INTO `participant` (`contactId`, `participantId`, `firstName`, `lastName`, `birthYear`, `class`, `discipline`) VALUES
(11, 29, 'Johan', 'Dagvalk', 1988, 'P12', ''),
(14, 34, 'Hannes', 'Ingelhag', 1970, 'P14', ''),
(15, 35, 'Erik', 'Johansson', 1998, 'P13', ''),
(14, 36, 'Lovisa ', 'Dahl', 1991, 'P14', ''),
(17, 41, 'Emma', 'Ed', 1987, 'P12', ''),
(18, 42, 'Hannes', 'Ingelhag', 1990, 'P11', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
