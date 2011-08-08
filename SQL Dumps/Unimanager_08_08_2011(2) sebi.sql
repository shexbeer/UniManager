-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. August 2011 um 19:33
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `unimanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fakultaet`
--

CREATE TABLE IF NOT EXISTS `fakultaet` (
  `fak_id` int(3) NOT NULL AUTO_INCREMENT,
  `fak_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`fak_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fakultaet`
--

INSERT INTO `fakultaet` (`fak_id`, `fak_name`) VALUES
(1, 'Informatik');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `fakultaetsrat`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `lehrbeauftragter`
--

INSERT INTO `lehrbeauftragter` (`lehrbeauftr_personenid`, `lehrbeauftr_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrende`
--

CREATE TABLE IF NOT EXISTS `lehrende` (
  `lehrende_personenid` int(5) DEFAULT NULL,
  `lehrende_id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`lehrende_id`),
  KEY `lehrende_personenid` (`lehrende_personenid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `lehrende`
--

INSERT INTO `lehrende` (`lehrende_personenid`, `lehrende_id`) VALUES
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungsnachweis`
--

CREATE TABLE IF NOT EXISTS `leistungsnachweis` (
  `ln_id` int(5) NOT NULL AUTO_INCREMENT,
  `ln_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ln_requirement` varchar(50) NOT NULL,
  `ln_examiner` int(5) NOT NULL,
  `ln_modul_id` int(5) NOT NULL,
  PRIMARY KEY (`ln_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `leistungsnachweis`
--

INSERT INTO `leistungsnachweis` (`ln_id`, `ln_date`, `ln_requirement`, `ln_examiner`, `ln_modul_id`) VALUES
(1, '2011-08-31 14:18:45', '', 1, 1),
(2, '2011-08-31 14:18:45', '', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistungsnachweisanmeldung`
--

CREATE TABLE IF NOT EXISTS `leistungsnachweisanmeldung` (
  `lna_id` int(7) NOT NULL AUTO_INCREMENT,
  `lna_registrationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lna_mark` decimal(1,0) NOT NULL,
  `lna_student_id` int(5) NOT NULL,
  `lna_modul_id` int(5) NOT NULL,
  PRIMARY KEY (`lna_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `leistungsnachweisanmeldung`
--

INSERT INTO `leistungsnachweisanmeldung` (`lna_id`, `lna_registrationdate`, `lna_mark`, `lna_student_id`, `lna_modul_id`) VALUES
(1, '2011-08-06 14:20:29', 1, 1, 1),
(2, '2011-08-06 14:22:24', 4, 2, 1);

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
  `modul_frequency` varchar(30) NOT NULL,
  `modul_usability` varchar(150) NOT NULL,
  `modul_lp` int(2) NOT NULL,
  `modul_conditionforln` varchar(200) NOT NULL,
  `modul_effort` varchar(600) NOT NULL,
  `modul_person_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`modul_id`),
  UNIQUE KEY `modul_name` (`modul_name`),
  KEY `modul_person_id` (`modul_person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `modul`
--

INSERT INTO `modul` (`modul_name`, `modul_id`, `modul_status`, `modul_last_cha`, `modul_institut`, `modul_duration`, `modul_qualifytarget`, `modul_content`, `modul_literature`, `modul_teachform`, `modul_required`, `modul_frequency`, `modul_usability`, `modul_lp`, `modul_conditionforln`, `modul_effort`, `modul_person_id`) VALUES
('Informationssysteme', 1, 'Genehmigt', '2011-07-04', 'Institut für Informatik', 2, ' Die Studierenden sollen die Prinzipien relationaler Datenbanksysteme  kennen und den Entwurfsprozess beherrschen sowie betriebliche Informationssysteme im Team konzipieren, entwerfen, realisieren und  einführen können', ' Datenmodellierung und Datenmanagement, insbesondere das relationale Datenmodell einschließlich Algebra und Kalkül und postrelationale  Datenmodelle. Datenbankdesign, vom Entity-Relationship-Modell über  Transformationen, logischem Design und Normalisierung zum physischen Design. Datenbankadministration, SQL und Metadaten. Integrität: logische und physische Integrität, Synchronisation und Transaktionen. Architektur, Schnittstellen und Funktionen von Datenbankmanagementsystemen. Im Praktikum ist  ein Datenbanksystem im Team zu  erstellen. Informationssysteme zur Unterstützung betrieblicher / organisatorischer Prozesse, Prozessmodellierung, Konzeption, Umsetzung in  UML, Skriptsprachen, Application-/Webserver, Konstruktion eines Webbasierten Informationssystems im Team', ' Kemper/Eickler: Datenbanksysteme, Oldenbourg; Elmasri/Navathe:  Grundlagen von Datenbanksystemen, Addison-Wesley: Connolly,  Begg, Database Systems, Addison-Wesley, Carl Steinweg: Management der Software-Entwicklung, Teubner', ' Vorlesungen (3 SWS), Übungen (1 SWS), Praktikum DBMS (1 SWS),  Praktikum Informationssysteme (1 SWS', ' Vorausgesetzt werden Kenntnisse entsprechend den Inhalten der Module Grundlagen der Informatik und Softwareentwicklung', 'Jährlich zum Wintersemester  ', ' Bachelorstudiengänge Network Computing und Engineering & Computin', 9, ' Die Modulprüfung besteht aus einer Klausurarbeit im Umfang von 90  Minuten (Datenbanksysteme), und einer alternativen Prüfungsleistung  (erfolgreiche Abnahme eines Informationssystems)', ' Der Zeitaufwand beträgt 270 h und setzt sich aus 90 h Präsenzzeit und  180 h Selbststudium zusammen. Letzteres umfasst die Vor- und Nachbereitung der Lehrveranstaltungen, die Einarbeitung in eine Skriptsprache und das Aufsetzen der IS-Infrastruktur, die Ausarbeitung der Praktikumsaufgaben im Team, die Vorbereitung auf die schriftliche und die  mündliche Prüfung sowie die Präsentation des Informationssystems', 2),
(' Mensch-Maschine-Kommunikation', 2, 'Bearbeitung', '2011-07-04', 'Institut für Informatik', 2, ' Erwerb grundlegender Kenntnisse der Interaktionsformen für die  Kommunikation mit Computern.   Fähigkeit zur Anwendung dieser Kenntnisse bei der Gestaltung von  Benutzungsschnittstellen.   Einblicke in das wissenschaftliche Gebiet der Mensch-MaschineKommunikation. ', ' - Kognitive Aspekte der MMK (Wahrnehmung, Gedächtnis, Handlungsprozesse)  - Interaktionsformen  - Grafische Dialogsysteme  - Unterstützung von Kommunikation und Kollaboration  - Affektive Benutzungsschnittstellen  - Neue Paradigmen der MMK (z.B. Virtual & Augmented Reality,  Ubiquitous Computing, Agenten-basierte Schnittstellen, Tangible  Media)', ' M. Dahm. Grundlagen der Mensch-Computer-Interaktion. Pearson  Studium. 2006.  Alan Dix, Janet E. Finlay, Gregory D. Abowd, Russell Beale. HumanComputer Interaction, 3rd Edition. Prentice Hall, 2004.  Jennifer Preece, Yvonne Rogers, Helen Sharp.  Interaction Design:  Beyond Human-Computer Interaction. John Wiley & Sons, 2002', ' Seminaristische Vorlesung (2 SWS), Projektseminar (2 SWS', ' Vorausgesetzt werden Kenntnisse entsprechend des Inhalts des  Moduls Grundlagen der Informati', 'Jährlich zum Wintersemester  ', ' Diplomstudiengang Angewandte Mathematik, Bachelorstudiengänge  Network Computing und Engineering & Computing', 6, ' Leistungspunkte werden nach bestandener mündlicher Prüfungsleistung im Umfang von 30 Minuten und bestandener alternativer Prü- fungsleistung (Bearbeitung eines Gruppenprojekts) vergeben. ', ' Der Zeitaufwand beträgt 180 h und setzt sich aus 60 h Präsenzzeit  und 120 h Selbststudium zusammen. Letzteres umfasst die Vor- und  Nachbereitung der Lehrveranstaltungen, die Arbeit an einem Gruppenprojekt sowie die Prüfungsvorbereitung', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modulangebot`
--

CREATE TABLE IF NOT EXISTS `modulangebot` (
  `ma_count` int(5) NOT NULL AUTO_INCREMENT,
  `ma_id` int(3) DEFAULT NULL,
  `ma_modul` int(5) DEFAULT NULL,
  `ma_sg` int(5) DEFAULT NULL,
  `ma_termin` varchar(40) DEFAULT NULL,
  `ma_lb` int(3) DEFAULT NULL,
  PRIMARY KEY (`ma_count`),
  KEY `ma_modul` (`ma_modul`),
  KEY `ma_sg` (`ma_sg`),
  KEY `ma_lb` (`ma_lb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `modulangebot`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `modulaufstellung`
--

INSERT INTO `modulaufstellung` (`mauf_rowid`, `mauf_modul_id`, `mauf_sg_id`, `mauf_plansemester`, `mauf_typ`) VALUES
(1, 1, 1, 1, 'Bachelor'),
(2, 2, 1, 4, 'Bachelor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_vorname` varchar(40) NOT NULL,
  `person_name` varchar(40) NOT NULL,
  `person_anschrift` varchar(100) NOT NULL,
  `person_email` varchar(40) NOT NULL,
  `person_gebdat` date NOT NULL,
  `person_fak` varchar(100) NOT NULL,
  `person_loginname` varchar(30) NOT NULL,
  `person_kennwort` varchar(40) NOT NULL,
  `person_zugriffsrecht` int(1) NOT NULL,
  `person_id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`person_vorname`, `person_name`, `person_anschrift`, `person_email`, `person_gebdat`, `person_fak`, `person_loginname`, `person_kennwort`, `person_zugriffsrecht`, `person_id`) VALUES
('Sebastian', 'Gasch', 'Winklerstr. 20', 'sebastiangasch@gmx.de', '1983-06-14', 'Fakultät 1', 'gaschs', '098f6bcd4621d373cade4e832627b4f6', 1, 1),
('test', 'kasper1', 'Schlossallee 1', 'test_casper1@bla.com', '1987-08-04', 'Fakultät 1', 'testk1', '098f6bcd4621d373cade4e832627b4f6', 1, 2),
('test', 'kasper2', 'Schlossallee 2', 'test_casper2@bla.com', '1985-08-04', 'Fakultät 1', 'testk2', '098f6bcd4621d373cade4e832627b4f6', 1, 3);

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
-- Tabellenstruktur für Tabelle `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_personenid` int(5) DEFAULT NULL,
  `student_matnr` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_matnr`),
  KEY `student_personenid` (`student_personenid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `student`
--

INSERT INTO `student` (`student_personenid`, `student_matnr`) VALUES
(1, 47742);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiendekan`
--

CREATE TABLE IF NOT EXISTS `studiendekan` (
  `studiendekan_persid` int(5) DEFAULT NULL,
  `studiendekan_id` int(2) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`studiendekan_id`),
  KEY `studiendekan_persid` (`studiendekan_persid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `studiendekan`
--

INSERT INTO `studiendekan` (`studiendekan_persid`, `studiendekan_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiengang`
--

CREATE TABLE IF NOT EXISTS `studiengang` (
  `sg_id` int(5) NOT NULL AUTO_INCREMENT,
  `sg_name` varchar(100) NOT NULL,
  `sg_po` text NOT NULL,
  `sg_so` text NOT NULL,
  `sg_createdate` date NOT NULL,
  `sg_modulhandbuch` text NOT NULL,
  `sg_dekan` int(2) DEFAULT NULL,
  PRIMARY KEY (`sg_id`),
  KEY `sg_dekan` (`sg_dekan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `studiengang`
--

INSERT INTO `studiengang` (`sg_id`, `sg_name`, `sg_po`, `sg_so`, `sg_createdate`, `sg_modulhandbuch`, `sg_dekan`) VALUES
(1, 'Bachelor Network Computing', 'Inhalt nicht verfügbar', 'Inhalt nicht verfügbar', '1999-10-01', 'Inhalt nicht verfügbar', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_loginname`, `user_passwort`, `user_vorname`, `user_nachname`, `user_accesslvl`, `user_lastlogin`) VALUES
(1, 'shexbeer', '098f6bcd4621d373cade4e832627b4f6', 'Christian', 'Seidel', 100, '1308593834'),
(2, 'sebi', '4fc477a3636c998c46817ac7534f0c48', 'Sebastian', 'Gasch', 100, '1309779230'),
(3, 'sid', '709218c83dcb3d5597e6bf31e2eb1054', 'Daniel', 'Rzehak', 100, '1312540819');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fakultaetsrat`
--
ALTER TABLE `fakultaetsrat`
  ADD CONSTRAINT `fakultaetsrat_ibfk_3` FOREIGN KEY (`rat_personid`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fakultaetsrat_ibfk_2` FOREIGN KEY (`rat_fak`) REFERENCES `fakultaet` (`fak_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `modulangebot_ibfk_5` FOREIGN KEY (`ma_lb`) REFERENCES `lehrbeauftragter` (`lehrbeauftr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modulangebot_ibfk_3` FOREIGN KEY (`ma_modul`) REFERENCES `modul` (`modul_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulangebot_ibfk_4` FOREIGN KEY (`ma_sg`) REFERENCES `studiengang` (`sg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
