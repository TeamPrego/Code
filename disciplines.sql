-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 17 mars 2014 kl 13:51
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

-- --------------------------------------------------------

--
-- Tabellstruktur `disciplines`
--

CREATE TABLE IF NOT EXISTS `disciplines` (
  `discipline` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `disciplines`
--

INSERT INTO `disciplines` (`discipline`) VALUES
('Flonk'),
('Bänkpress'),
('Strut'),
('100 m'),
('Böj'),
('Marklyft'),
('Knarklyft');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
