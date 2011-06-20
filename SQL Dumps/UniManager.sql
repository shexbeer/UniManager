-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 20. Juni 2011 um 18:24
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `UniManager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_loginname` varchar(20) NOT NULL,
  `user_passwort` varchar(50) NOT NULL,
  `user_vorname` varchar(20) NOT NULL,
  `user_nachname` varchar(30) NOT NULL,
  `user_accesslvl` int(11) NOT NULL,
  `user_lastlogin` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_loginname`, `user_passwort`, `user_vorname`, `user_nachname`, `user_accesslvl`, `user_lastlogin`) VALUES
(1, 'shexbeer', '098f6bcd4621d373cade4e832627b4f6', 'Christian', 'Seidel', 100, '1308593834');
