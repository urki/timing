-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Gostitelj: localhost
-- Čas nastanka: 19 Jun 2010 ob 01:48 PM
-- Različica strežnika: 5.1.41
-- Različica PHP: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Podatkovna baza: `timming`
--
DROP DATABASE `timming`;
CREATE DATABASE `timming` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `timming`;

-- --------------------------------------------------------

--
-- Struktura tabele `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Odloži podatke za tabelo `events`
--

INSERT INTO `events` (`event_id`, `name`) VALUES
(2, 'Tek na 10 km'),
(6, 'Tek na 300m'),
(5, 'Tek na 21 km'),
(7, 'Tek na 600m'),
(8, 'Tek na 1500m');

-- --------------------------------------------------------

--
-- Struktura tabele `klub`
--

DROP TABLE IF EXISTS `klub`;
CREATE TABLE IF NOT EXISTS `klub` (
  `klub_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`klub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Odloži podatke za tabelo `klub`
--


-- --------------------------------------------------------

--
-- Struktura tabele `start_number`
--

DROP TABLE IF EXISTS `start_number`;
CREATE TABLE IF NOT EXISTS `start_number` (
  `autoNum` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`autoNum`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Odloži podatke za tabelo `start_number`
--

INSERT INTO `start_number` (`autoNum`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50);

-- --------------------------------------------------------

--
-- Struktura tabele `tekma`
--

DROP TABLE IF EXISTS `tekma`;
CREATE TABLE IF NOT EXISTS `tekma` (
  `tekma_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`tekma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Odloži podatke za tabelo `tekma`
--

INSERT INTO `tekma` (`tekma_id`, `name`) VALUES
(5, '1 tek');

-- --------------------------------------------------------

--
-- Struktura tabele `timming`
--

DROP TABLE IF EXISTS `timming`;
CREATE TABLE IF NOT EXISTS `timming` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start` double NOT NULL,
  `stop` double NOT NULL,
  `event_id` int(11) NOT NULL,
  `tekma_id` int(11) NOT NULL,
  PRIMARY KEY (`time_id`),
  KEY `user_id` (`user_id`,`start`,`stop`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Odloži podatke za tabelo `timming`
--

INSERT INTO `timming` (`time_id`, `user_id`, `start`, `stop`, `event_id`, `tekma_id`) VALUES
(97, 24, 1276945678.5104, 1276945709.1289, 2, 5),
(96, 27, 1276945678.5104, 1276945713.0572, 2, 5),
(95, 25, 1276945678.5104, 1276945707.2362, 2, 5),
(94, 23, 1276945678.5104, 1276945710.5638, 2, 5),
(93, 26, 1276945678.5104, 1276945714.2684, 2, 5);

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(1) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `club` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `number` varchar(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  KEY `birthdate` (`birthdate`,`sex`,`city`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `birthdate`, `sex`, `city`, `club`, `event_id`, `number`) VALUES
(28, 'Tekmovalce 1', '1903-01-01', 'M', 'fsf', 'fasd', 2, ''),
(27, 'en drug', '1900-01-01', 'M', 'fasddsfa', 'fdsafd', 2, '7'),
(26, 'samo gabrovec', '1900-01-01', 'M', 'mesto', 'fasfdas', 2, '1'),
(24, 'utrewqf', '1990-01-01', 'F', 'ewrttwer', 'wgg', 2, '9'),
(25, 'uros gabrovec', '1900-01-01', 'M', 'tekmovalec', 'fdasfas', 2, '17'),
(23, 'NataÅ¡a Krenkar', '1981-01-01', 'M', 'velenje', 'fadfasd', 2, '15');
