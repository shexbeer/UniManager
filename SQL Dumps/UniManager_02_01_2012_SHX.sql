-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 02. Januar 2012 um 16:58
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
-- Tabellenstruktur für Tabelle `aenderungen`
--

CREATE TABLE IF NOT EXISTS `aenderungen` (
  `aenderung_id` int(5) NOT NULL AUTO_INCREMENT,
  `aenderung_pid` int(5) NOT NULL,
  `aenderung_mid` int(5) NOT NULL,
  `aenderung_last_cha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aenderung_startsem` varchar(15) NOT NULL,
  `aenderung_mname` varchar(40) NOT NULL,
  `aenderung_institut` varchar(50) NOT NULL,
  `aenderung_duration` int(3) NOT NULL,
  `aenderung_qualifytarget` varchar(400) NOT NULL,
  `aenderung_content` varchar(1500) NOT NULL,
  `aenderung_literature` varchar(500) NOT NULL,
  `aenderung_teachform` varchar(200) NOT NULL,
  `aenderung_required` varchar(200) NOT NULL,
  `aenderung_usability` varchar(150) NOT NULL,
  `aenderung_frequency` varchar(30) NOT NULL,
  `aenderung_lp` int(2) NOT NULL,
  `aenderung_conditionforln` varchar(200) NOT NULL,
  `aenderung_effort` varchar(600) NOT NULL,
  `aenderung_status` set('Bearbeitung','Erstellt','Genehmigt') DEFAULT NULL,
  PRIMARY KEY (`aenderung_id`),
  KEY `aenderung_pid` (`aenderung_pid`),
  KEY `aenderung_mid` (`aenderung_mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `aenderungen`
--

INSERT INTO `aenderungen` (`aenderung_id`, `aenderung_pid`, `aenderung_mid`, `aenderung_last_cha`, `aenderung_startsem`, `aenderung_mname`, `aenderung_institut`, `aenderung_duration`, `aenderung_qualifytarget`, `aenderung_content`, `aenderung_literature`, `aenderung_teachform`, `aenderung_required`, `aenderung_usability`, `aenderung_frequency`, `aenderung_lp`, `aenderung_conditionforln`, `aenderung_effort`, `aenderung_status`) VALUES
(2, 1, 2, '2012-01-02 14:54:31', '', 'Mensch-Maschine-Kommunikation', 'Institut für Informatik', 5, '               		  Erwerb grundlegender Kenntnisse der Interaktionsformen für die  Kommunikation mit Computern.   Fähigkeit zur Anwendung dieser Kenntnisse bei der Gestaltung von  Benutzungsschnittstellen.   Einblicke in das wissenschaftliche Gebiet der Mensch-MaschineKommunikation. \r\n                ', '                	 - Kognitive Aspekte der MMK (Wahrnehmung, Gedächtnis, Handlungsprozesse)  - Interaktionsformen  - Grafische Dialogsysteme  - Unterstützung von Kommunikation und Kollaboration  - Affektive Benutzungsschnittstellen  - Neue Paradigmen der MMK (z.B. Virtual & Augmented Reality,  Ubiquitous Computing, Agenten-basierte Schnittstellen, Tangible  Media)\r\n                ', '                	 M. Dahm. Grundlagen der Mensch-Computer-Interaktion. Pearson  Studium. 2006.  Alan Dix, Janet E. Finlay, Gregory D. Abowd, Russell Beale. HumanComputer Interaction, 3rd Edition. Prentice Hall, 2004.  Jennifer Preece, Yvonne Rogers, Helen Sharp.  Interaction Design:  Beyond Human-Computer Interaction. John Wiley & Sons, 2002\r\n                ', '                	 Seminaristische Vorlesung (2 SWS), Projektseminar (2 SWS\r\n                ', '	                 Vorausgesetzt werden Kenntnisse entsprechend des Inhalts des  Moduls Grundlagen der Informati\r\n                ', ' Diplomstudiengang Angewandte Mathematik, Bachelorstudiengänge  Network Computing und Engineering & Computing', 'im Wintersemester', 6, '                	 Leistungspunkte werden nach bestandener mündlicher Prüfungsleistung im Umfang von 30 Minuten und bestandener alternativer Prü- fungsleistung (Bearbeitung eines Gruppenprojekts) verge', '                	 Der Zeitaufwand beträgt 180 h und setzt sich aus 60 h Präsenzzeit  und 120 h Selbststudium zusammen. Letzteres umfasst die Vor- und  Nachbereitung der Lehrveranstaltungen, die Arbeit an einem Gruppenprojekt sowie die Prüfungsvorbereitung\r\n                ', 'Bearbeitung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fakultaet`
--

CREATE TABLE IF NOT EXISTS `fakultaet` (
  `fak_id` int(3) NOT NULL AUTO_INCREMENT,
  `fak_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fak_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fakultaet`
--

INSERT INTO `fakultaet` (`fak_id`, `fak_name`) VALUES
(1, 'Mathematik und Informatik');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fakultaetsrat`
--

CREATE TABLE IF NOT EXISTS `fakultaetsrat` (
  `count` int(6) NOT NULL AUTO_INCREMENT,
  `rat_id` int(5) DEFAULT NULL,
  `rat_personid` int(5) DEFAULT NULL,
  `rat_fak` int(3) DEFAULT NULL,
  PRIMARY KEY (`count`),
  KEY `rat_fak` (`rat_fak`),
  KEY `rat_personid` (`rat_personid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fakultaetsrat`
--

INSERT INTO `fakultaetsrat` (`count`, `rat_id`, `rat_personid`, `rat_fak`) VALUES
(1, NULL, 8, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gebaeude`
--

CREATE TABLE IF NOT EXISTS `gebaeude` (
  `gebaeude_name` varchar(75) NOT NULL,
  `gebaeude_anschrift` varchar(150) NOT NULL,
  `gebaeude_latitude` float NOT NULL,
  `gebaeude_longitude` float NOT NULL,
  `gebaeude_id` int(2) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`gebaeude_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `gebaeude`
--

INSERT INTO `gebaeude` (`gebaeude_name`, `gebaeude_anschrift`, `gebaeude_latitude`, `gebaeude_longitude`, `gebaeude_id`) VALUES
('Clemens-Winkler-Bau', 'Leipziger Straße 29 09599 Freiberg', 50.9255, 13.3334, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrbeauftragter`
--

CREATE TABLE IF NOT EXISTS `lehrbeauftragter` (
  `lehrbeauftr_personenid` int(5) NOT NULL,
  `lehrbeauftr_id` int(2) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`lehrbeauftr_id`),
  KEY `lehrbeauftr_personenid` (`lehrbeauftr_personenid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `lehrbeauftragter`
--

INSERT INTO `lehrbeauftragter` (`lehrbeauftr_personenid`, `lehrbeauftr_id`) VALUES
(2, 1),
(3, 2),
(9, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrende`
--

CREATE TABLE IF NOT EXISTS `lehrende` (
  `lehrende_personenid` int(5) DEFAULT NULL,
  `lehrende_id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`lehrende_id`),
  KEY `lehrende_personenid` (`lehrende_personenid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `lehrende`
--

INSERT INTO `lehrende` (`lehrende_personenid`, `lehrende_id`) VALUES
(2, 1),
(3, 2),
(10, 3),
(11, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungsnachweis`
--

CREATE TABLE IF NOT EXISTS `leistungsnachweis` (
  `ln_id` int(10) NOT NULL AUTO_INCREMENT,
  `ln_name` varchar(50) NOT NULL DEFAULT 'schriftliche Prüfung',
  `ln_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ln_requirement` varchar(50) NOT NULL DEFAULT 'keine',
  `ln_examiner_pid` int(5) NOT NULL,
  `ln_modul_id` int(10) NOT NULL,
  PRIMARY KEY (`ln_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `leistungsnachweis`
--

INSERT INTO `leistungsnachweis` (`ln_id`, `ln_name`, `ln_date`, `ln_requirement`, `ln_examiner_pid`, `ln_modul_id`) VALUES
(1, 'praktische Prüfung Informationssysteme', '2011-09-16 14:43:33', 'keine', 1, 1),
(2, 'mündliche Prüfung M-M-K', '2011-09-16 14:45:33', 'erfolgreiches Teilnehmen an den Übungen', 2, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungsnachweisanmeldung`
--

CREATE TABLE IF NOT EXISTS `leistungsnachweisanmeldung` (
  `lna_id` int(7) NOT NULL AUTO_INCREMENT,
  `lna_registrationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lna_mark` float DEFAULT NULL,
  `lna_person_id` int(5) NOT NULL,
  `lna_ln_id` int(5) NOT NULL,
  PRIMARY KEY (`lna_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `leistungsnachweisanmeldung`
--

INSERT INTO `leistungsnachweisanmeldung` (`lna_id`, `lna_registrationdate`, `lna_mark`, `lna_person_id`, `lna_ln_id`) VALUES
(1, '2011-08-06 14:20:29', 1, 1, 1),
(2, '2011-08-10 18:39:31', 3.7, 2, 1),
(5, '2011-10-28 19:47:45', 2, 3, 1),
(7, '2011-10-28 19:48:01', 1, 4, 2),
(8, '2011-10-28 19:47:45', 2, 5, 1),
(9, '2011-09-20 22:47:10', 2, 1, 2),
(10, '2011-12-27 18:14:14', 5, 4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `modul_name` varchar(40) NOT NULL,
  `modul_id` int(5) NOT NULL AUTO_INCREMENT,
  `modul_status` set('Bearbeitung','Erstellt','Genehmigt') NOT NULL DEFAULT 'Bearbeitung',
  `modul_last_cha` date NOT NULL,
  `modul_institut` varchar(50) NOT NULL,
  `modul_duration` int(3) NOT NULL,
  `modul_qualifytarget` varchar(400) NOT NULL,
  `modul_content` varchar(1500) NOT NULL,
  `modul_literature` varchar(500) NOT NULL,
  `modul_teachform` varchar(200) NOT NULL,
  `modul_required` varchar(200) NOT NULL,
  `modul_frequency` set('im Wintersemester','im Sommersemester','jedes Semester') NOT NULL DEFAULT 'im Wintersemester',
  `modul_usability` varchar(150) NOT NULL,
  `modul_lp` int(2) NOT NULL,
  `modul_conditionforln` varchar(200) NOT NULL,
  `modul_effort` varchar(600) NOT NULL,
  `modul_person_id` int(5) DEFAULT NULL,
  `modul_note` varchar(600) NOT NULL,
  PRIMARY KEY (`modul_id`),
  UNIQUE KEY `modul_name` (`modul_name`),
  KEY `modul_person_id` (`modul_person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `modul`
--

INSERT INTO `modul` (`modul_name`, `modul_id`, `modul_status`, `modul_last_cha`, `modul_institut`, `modul_duration`, `modul_qualifytarget`, `modul_content`, `modul_literature`, `modul_teachform`, `modul_required`, `modul_frequency`, `modul_usability`, `modul_lp`, `modul_conditionforln`, `modul_effort`, `modul_person_id`, `modul_note`) VALUES
('Informationssysteme', 1, 'Genehmigt', '2011-07-04', 'Institut für Informatik', 2, ' Die Studierenden sollen die Prinzipien relationaler Datenbanksysteme  kennen und den Entwurfsprozess beherrschen sowie betriebliche Informationssysteme im Team konzipieren, entwerfen, realisieren und  einführen können', ' Datenmodellierung und Datenmanagement, insbesondere das relationale Datenmodell einschließlich Algebra und Kalkül und postrelationale  Datenmodelle. Datenbankdesign, vom Entity-Relationship-Modell über  Transformationen, logischem Design und Normalisierung zum physischen Design. Datenbankadministration, SQL und Metadaten. Integrität: logische und physische Integrität, Synchronisation und Transaktionen. Architektur, Schnittstellen und Funktionen von Datenbankmanagementsystemen. Im Praktikum ist  ein Datenbanksystem im Team zu  erstellen. Informationssysteme zur Unterstützung betrieblicher / organisatorischer Prozesse, Prozessmodellierung, Konzeption, Umsetzung in  UML, Skriptsprachen, Application-/Webserver, Konstruktion eines Webbasierten Informationssystems im Team', ' Kemper/Eickler: Datenbanksysteme, Oldenbourg; Elmasri/Navathe:  Grundlagen von Datenbanksystemen, Addison-Wesley: Connolly,  Begg, Database Systems, Addison-Wesley, Carl Steinweg: Management der Software-Entwicklung, Teubner', ' Vorlesungen (3 SWS), Übungen (1 SWS), Praktikum DBMS (1 SWS),  Praktikum Informationssysteme (1 SWS', ' Vorausgesetzt werden Kenntnisse entsprechend den Inhalten der Module Grundlagen der Informatik und Softwareentwicklung', 'im Wintersemester', ' Bachelorstudiengänge Network Computing und Engineering & Computin', 9, ' Die Modulprüfung besteht aus einer Klausurarbeit im Umfang von 90  Minuten (Datenbanksysteme), und einer alternativen Prüfungsleistung  (erfolgreiche Abnahme eines Informationssystems)', ' Der Zeitaufwand beträgt 270 h und setzt sich aus 90 h Präsenzzeit und  180 h Selbststudium zusammen. Letzteres umfasst die Vor- und Nachbereitung der Lehrveranstaltungen, die Einarbeitung in eine Skriptsprache und das Aufsetzen der IS-Infrastruktur, die Ausarbeitung der Praktikumsaufgaben im Team, die Vorbereitung auf die schriftliche und die  mündliche Prüfung sowie die Präsentation des Informationssystems', 2, 'Die Modulnote ergibt sich aus dem arithmetischen Mittel der Note für \r\ndie Klausurarbeit und der Note der alternativen Prüfungsleistung'),
('Mensch-Maschine-Kommunikation', 2, 'Bearbeitung', '2011-07-04', 'Institut für Informatik', 2, ' Erwerb grundlegender Kenntnisse der Interaktionsformen für die  Kommunikation mit Computern.   Fähigkeit zur Anwendung dieser Kenntnisse bei der Gestaltung von  Benutzungsschnittstellen.   Einblicke in das wissenschaftliche Gebiet der Mensch-MaschineKommunikation. ', ' - Kognitive Aspekte der MMK (Wahrnehmung, Gedächtnis, Handlungsprozesse)  - Interaktionsformen  - Grafische Dialogsysteme  - Unterstützung von Kommunikation und Kollaboration  - Affektive Benutzungsschnittstellen  - Neue Paradigmen der MMK (z.B. Virtual & Augmented Reality,  Ubiquitous Computing, Agenten-basierte Schnittstellen, Tangible  Media)', ' M. Dahm. Grundlagen der Mensch-Computer-Interaktion. Pearson  Studium. 2006.  Alan Dix, Janet E. Finlay, Gregory D. Abowd, Russell Beale. HumanComputer Interaction, 3rd Edition. Prentice Hall, 2004.  Jennifer Preece, Yvonne Rogers, Helen Sharp.  Interaction Design:  Beyond Human-Computer Interaction. John Wiley & Sons, 2002', ' Seminaristische Vorlesung (2 SWS), Projektseminar (2 SWS', ' Vorausgesetzt werden Kenntnisse entsprechend des Inhalts des  Moduls Grundlagen der Informati', 'im Wintersemester', ' Diplomstudiengang Angewandte Mathematik, Bachelorstudiengänge  Network Computing und Engineering & Computing', 6, ' Leistungspunkte werden nach bestandener mündlicher Prüfungsleistung im Umfang von 30 Minuten und bestandener alternativer Prü- fungsleistung (Bearbeitung eines Gruppenprojekts) vergeben. ', ' Der Zeitaufwand beträgt 180 h und setzt sich aus 60 h Präsenzzeit  und 120 h Selbststudium zusammen. Letzteres umfasst die Vor- und  Nachbereitung der Lehrveranstaltungen, die Arbeit an einem Gruppenprojekt sowie die Prüfungsvorbereitung', 1, 'Die Modulnote ergibt sich aus dem arithmetischen Mittel der Noten  der mündlichen Prüfungsleistung und der alternativen Prüfungsleistung.'),
('Testmodul 1', 3, 'Bearbeitung', '2011-12-31', '', 2, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, ''),
('Testmodul 2', 5, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, ''),
('Testmodul 3', 7, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, ''),
('Testmodul 4', 8, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, ''),
('Testmodul 5', 9, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, ''),
('Testmodul 6', 10, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'im Sommersemester', '', 3, '', '', 2, ''),
('Testmodul 7', 11, 'Bearbeitung', '2011-12-31', '', 1, '', '', '', '', '', 'jedes Semester', '', 3, '', '', 2, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modulangebot`
--

CREATE TABLE IF NOT EXISTS `modulangebot` (
  `ma_count` int(5) NOT NULL AUTO_INCREMENT,
  `ma_id` int(3) DEFAULT NULL,
  `ma_modul` int(5) DEFAULT NULL,
  `ma_sg` int(5) DEFAULT NULL,
  `ma_time` time NOT NULL,
  `ma_weekday` set('Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag','Sonntag') NOT NULL,
  `ma_week` set('jede','gerade','ungerade') NOT NULL,
  `ma_lb` int(3) DEFAULT NULL,
  `ma_semester` varchar(8) NOT NULL,
  `ma_status` enum('erstellt','geprüft','gültig') NOT NULL,
  PRIMARY KEY (`ma_count`),
  KEY `ma_modul` (`ma_modul`),
  KEY `ma_sg` (`ma_sg`),
  KEY `ma_lb` (`ma_lb`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=285 ;

--
-- Daten für Tabelle `modulangebot`
--

INSERT INTO `modulangebot` (`ma_count`, `ma_id`, `ma_modul`, `ma_sg`, `ma_time`, `ma_weekday`, `ma_week`, `ma_lb`, `ma_semester`, `ma_status`) VALUES
(64, NULL, 2, 2, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'gültig'),
(259, NULL, 2, 1, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(260, NULL, 1, 1, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(267, NULL, 1, 4, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(268, NULL, 3, 4, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(269, NULL, 10, 4, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(270, NULL, 2, 4, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(271, NULL, 9, 4, '07:30:00', 'Montag', 'jede', 1, 'WS2011', 'gültig'),
(276, NULL, 8, 1, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'gültig'),
(277, NULL, 9, 1, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'gültig'),
(278, NULL, 10, 1, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'gültig'),
(279, NULL, 1, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt'),
(280, NULL, 5, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt'),
(281, NULL, 8, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt'),
(282, NULL, 11, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt'),
(283, NULL, 2, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt'),
(284, NULL, 7, 4, '07:30:00', 'Montag', 'jede', 1, 'SS2012', 'erstellt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modulaufstellung`
--

CREATE TABLE IF NOT EXISTS `modulaufstellung` (
  `mauf_rowid` int(11) NOT NULL AUTO_INCREMENT,
  `mauf_modul_id` int(11) NOT NULL,
  `mauf_sg_id` int(11) NOT NULL,
  `mauf_plansemester` int(2) NOT NULL,
  `mauf_typ` varchar(20) NOT NULL,
  PRIMARY KEY (`mauf_rowid`),
  KEY `mauf_sg_id` (`mauf_sg_id`),
  KEY `mauf_modul_id` (`mauf_modul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Daten für Tabelle `modulaufstellung`
--

INSERT INTO `modulaufstellung` (`mauf_rowid`, `mauf_modul_id`, `mauf_sg_id`, `mauf_plansemester`, `mauf_typ`) VALUES
(49, 2, 2, 1, 'Diplom'),
(50, 1, 4, 1, 'Master'),
(51, 2, 4, 3, 'Master'),
(52, 3, 4, 2, 'Master'),
(53, 5, 4, 1, 'Master'),
(54, 7, 4, 3, 'Master'),
(55, 8, 4, 1, 'Master'),
(56, 9, 4, 4, 'Master'),
(57, 10, 4, 2, 'Master'),
(58, 11, 4, 1, 'Master'),
(104, 1, 1, 6, 'Bachelor'),
(105, 2, 1, 4, 'Bachelor'),
(106, 3, 1, 1, 'Bachelor'),
(107, 5, 1, 5, 'Bachelor'),
(108, 7, 1, 1, 'Bachelor'),
(109, 8, 1, 3, 'Bachelor'),
(110, 9, 1, 2, 'Bachelor'),
(111, 10, 1, 3, 'Bachelor'),
(112, 11, 1, 6, 'Bachelor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_vorname` varchar(40) NOT NULL,
  `person_name` varchar(40) NOT NULL,
  `person_anschrift_strasse` varchar(100) NOT NULL,
  `person_anschrift_plz` int(5) unsigned zerofill NOT NULL,
  `person_anschrift_stadt` varchar(40) NOT NULL,
  `person_anschrift_hausnummer` varchar(50) NOT NULL,
  `person_email` varchar(40) NOT NULL,
  `person_gebdat` date NOT NULL,
  `person_fak` varchar(100) NOT NULL,
  `person_loginname` varchar(30) NOT NULL,
  `person_kennwort` varchar(40) NOT NULL,
  `person_zugriffsrecht` int(3) NOT NULL,
  `person_id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`person_vorname`, `person_name`, `person_anschrift_strasse`, `person_anschrift_plz`, `person_anschrift_stadt`, `person_anschrift_hausnummer`, `person_email`, `person_gebdat`, `person_fak`, `person_loginname`, `person_kennwort`, `person_zugriffsrecht`, `person_id`) VALUES
('Sebastian', 'Gasch', 'Winklerstrasse', 09599, 'Freiberg', '20', 'sebastiangasch@gmx.de', '1983-06-14', '1', 'gaschs', '098f6bcd4621d373cade4e832627b4f6', 100, 1),
('test', 'kasper1', 'Schlossallee', 12345, 'Teststadt', '1', 'test_casper1@bla.com', '1987-08-04', '1', 'testk1', '098f6bcd4621d373cade4e832627b4f6', 100, 2),
('test', 'kasper2', 'Schlossallee', 12345, 'Teststadt', '2', 'test_casper2@bla.com', '1985-08-04', '1', 'testk2', '098f6bcd4621d373cade4e832627b4f6', 100, 3),
('Christian', 'Seidel', 'Winkler Strasse', 09599, 'Freiberg', '12', 'sh3xbeer@gmail.com', '1985-12-16', '1', 'shexbeer', '098f6bcd4621d373cade4e832627b4f6', 100, 4),
('', '', '', 00000, '', '', '', '1989-04-03', '1', 'krellner', '098f6bcd4621d373cade4e832627b4f6', 100, 5),
('Student', 'Nummer1', '', 12345, 'Nostadt', 'Karlsbader Str 10', '', '2012-01-02', '1', 'student', '098f6bcd4621d373cade4e832627b4f6', 0, 6),
('Dekan', 'Dekan1', '', 12345, '', '', '', '2012-01-02', '', 'dekan', '098f6bcd4621d373cade4e832627b4f6', 0, 7),
('fakrat', 'fakrat 1', '', 11111, '', '', '', '2012-01-02', '', 'fakrat', '098f6bcd4621d373cade4e832627b4f6', 0, 8),
('lehrbeauftragter', 'Nummer 1', '', 11111, '', '', '', '2012-01-02', '', 'lehrbeauftragter', '098f6bcd4621d373cade4e832627b4f6', 0, 9),
('lehrende', 'Nummer 1', '', 11111, '', '', '', '2012-01-02', '', 'lehrende', '098f6bcd4621d373cade4e832627b4f6', 0, 10),
('rektorat', 'Nummer 1', '', 11111, '', '', '', '2012-01-02', '', 'rektorat', '098f6bcd4621d373cade4e832627b4f6', 0, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `raum`
--

CREATE TABLE IF NOT EXISTS `raum` (
  `raum_gebaeude` int(2) DEFAULT NULL,
  `raum_nr` int(5) DEFAULT NULL,
  `raum_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`raum_id`),
  KEY `raum_gebaeude` (`raum_gebaeude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `raum`
--

INSERT INTO `raum` (`raum_gebaeude`, `raum_nr`, `raum_id`) VALUES
(1, 1005, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rektorat`
--

CREATE TABLE IF NOT EXISTS `rektorat` (
  `rektorat_id` int(3) NOT NULL AUTO_INCREMENT,
  `rektorat_l_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`rektorat_id`),
  KEY `rektorat_l_id` (`rektorat_l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `rektorat`
--

INSERT INTO `rektorat` (`rektorat_id`, `rektorat_l_id`) VALUES
(1, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_personenid` int(5) DEFAULT NULL,
  `student_matnr` int(5) NOT NULL DEFAULT '0',
  `student_sg_id` int(5) NOT NULL,
  `student_fakrat` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`student_matnr`),
  KEY `student_personenid` (`student_personenid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `student`
--

INSERT INTO `student` (`student_personenid`, `student_matnr`, `student_sg_id`, `student_fakrat`) VALUES
(1, 47742, 1, ''),
(2, 48888, 1, '\0'),
(3, 49999, 2, '\0'),
(4, 50000, 2, '\0'),
(5, 51283, 2, ''),
(6, 56373, 2, '\0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiendekan`
--

CREATE TABLE IF NOT EXISTS `studiendekan` (
  `studiendekan_persid` int(5) DEFAULT NULL,
  `studiendekan_id` int(2) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`studiendekan_id`),
  KEY `studiendekan_persid` (`studiendekan_persid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `studiendekan`
--

INSERT INTO `studiendekan` (`studiendekan_persid`, `studiendekan_id`) VALUES
(3, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiengang`
--

CREATE TABLE IF NOT EXISTS `studiengang` (
  `sg_id` int(5) NOT NULL AUTO_INCREMENT,
  `sg_name` varchar(100) NOT NULL,
  `sg_po` text,
  `sg_so` text,
  `sg_createdate` date NOT NULL,
  `sg_modulhandbuch` text NOT NULL,
  `sg_dekan` int(5) DEFAULT NULL,
  `sg_status` set('kreiert','konstruiert','beschlossen','abgestimmt','bestaetigt') NOT NULL,
  `sg_typ` set('Bachelor','Master','Diplom') NOT NULL DEFAULT 'Bachelor',
  PRIMARY KEY (`sg_id`),
  KEY `sg_dekan` (`sg_dekan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `studiengang`
--

INSERT INTO `studiengang` (`sg_id`, `sg_name`, `sg_po`, `sg_so`, `sg_createdate`, `sg_modulhandbuch`, `sg_dekan`, `sg_status`, `sg_typ`) VALUES
(1, 'Network Computing', 'POSO_1.pdf', 'POSO_1.pdf', '1999-10-01', 'Modul_1.pdf', 1, 'bestaetigt', 'Bachelor'),
(2, 'Maschinenbau', 'POSO_2.pdf', 'POSO_2.pdf', '2011-08-01', 'Modul_2.pdf', 1, 'bestaetigt', 'Diplom'),
(4, 'Test 111', NULL, NULL, '2011-12-27', 'Modul_4.pdf', 1, 'konstruiert', 'Master');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `aenderungen`
--
ALTER TABLE `aenderungen`
  ADD CONSTRAINT `aenderungen_ibfk_3` FOREIGN KEY (`aenderung_pid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aenderungen_ibfk_4` FOREIGN KEY (`aenderung_mid`) REFERENCES `modul` (`modul_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `fakultaetsrat`
--
ALTER TABLE `fakultaetsrat`
  ADD CONSTRAINT `fakultaetsrat_ibfk_2` FOREIGN KEY (`rat_fak`) REFERENCES `fakultaet` (`fak_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fakultaetsrat_ibfk_3` FOREIGN KEY (`rat_personid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lehrbeauftragter`
--
ALTER TABLE `lehrbeauftragter`
  ADD CONSTRAINT `lehrbeauftragter_ibfk_1` FOREIGN KEY (`lehrbeauftr_personenid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lehrende`
--
ALTER TABLE `lehrende`
  ADD CONSTRAINT `lehrende_ibfk_1` FOREIGN KEY (`lehrende_personenid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`modul_person_id`) REFERENCES `lehrende` (`lehrende_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `modulangebot`
--
ALTER TABLE `modulangebot`
  ADD CONSTRAINT `modulangebot_ibfk_3` FOREIGN KEY (`ma_modul`) REFERENCES `modul` (`modul_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulangebot_ibfk_4` FOREIGN KEY (`ma_sg`) REFERENCES `studiengang` (`sg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulangebot_ibfk_5` FOREIGN KEY (`ma_lb`) REFERENCES `lehrbeauftragter` (`lehrbeauftr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `modulaufstellung`
--
ALTER TABLE `modulaufstellung`
  ADD CONSTRAINT `modulaufstellung_ibfk_1` FOREIGN KEY (`mauf_sg_id`) REFERENCES `studiengang` (`sg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulaufstellung_ibfk_2` FOREIGN KEY (`mauf_sg_id`) REFERENCES `studiengang` (`sg_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modulaufstellung_ibfk_3` FOREIGN KEY (`mauf_modul_id`) REFERENCES `modul` (`modul_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `raum`
--
ALTER TABLE `raum`
  ADD CONSTRAINT `raum_ibfk_1` FOREIGN KEY (`raum_gebaeude`) REFERENCES `gebaeude` (`gebaeude_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `rektorat`
--
ALTER TABLE `rektorat`
  ADD CONSTRAINT `rektorat_ibfk_1` FOREIGN KEY (`rektorat_l_id`) REFERENCES `lehrende` (`lehrende_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`student_personenid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `studiendekan`
--
ALTER TABLE `studiendekan`
  ADD CONSTRAINT `studiendekan_ibfk_1` FOREIGN KEY (`studiendekan_persid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `studiengang`
--
ALTER TABLE `studiengang`
  ADD CONSTRAINT `studiengang_ibfk_1` FOREIGN KEY (`sg_dekan`) REFERENCES `studiendekan` (`studiendekan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
