-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 18 jun 2012 om 22:28
-- Serverversie: 5.5.16
-- PHP-Versie: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emerging_media`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) NOT NULL,
  `file_url` varchar(150) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_url`) VALUES
(1, 'groep 1', 'groep1.jpg'),
(2, 'groep 2', 'groep2.jpg'),
(3, 'groep 3', 'groep3.jpg'),
(4, 'groep 4', 'groep4.jpg'),
(5, 'groep 5', 'groep5.jpg'),
(6, 'groep 6', 'groep6.jpg'),
(7, 'groep 7', 'groep7.jpg'),
(8, 'groep 8', 'groep8.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `file_id` int(11) NOT NULL,
  `group_identifier` varchar(2) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `file_id`, `group_identifier`) VALUES
(1, 'Groep 1A', 1, '1A'),
(2, 'Groep 1B', 2, '1B'),
(3, 'Groep 2A', 3, '2A'),
(4, 'Groep 2B', 4, '2B'),
(5, 'Groep 3A', 5, '3A'),
(6, 'Groep 3B', 6, '3B'),
(7, 'Groep 4A', 7, '4A'),
(8, 'Groep 4B', 8, '4B'),
(9, 'Groep 5A', 9, '5A'),
(10, 'Groep 5B', 10, '5B'),
(11, 'Groep 6A', 11, '6A'),
(12, 'Groep 6B', 12, '6B'),
(13, 'Groep 7A', 13, '7A'),
(14, 'Groep 7B', 14, '7B'),
(15, 'Groep 8A', 15, '8A'),
(16, 'Groep 8B', 16, '8B');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_first_name` varchar(90) NOT NULL,
  `student_insertion` varchar(10) NOT NULL,
  `student_last_name` varchar(90) NOT NULL,
  `student_contact_mail` varchar(90) NOT NULL,
  `student_contact_mail_active` tinyint(1) NOT NULL,
  `student_contact_sms` varchar(90) NOT NULL,
  `student_contact_sms_active` tinyint(1) NOT NULL,
  `student_contact_phone` varchar(30) NOT NULL,
  `student_contact_phone_active` tinyint(1) NOT NULL,
  `group_identifier` varchar(2) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Gegevens worden uitgevoerd voor tabel `students`
--

INSERT INTO `students` (`student_id`, `student_first_name`, `student_insertion`, `student_last_name`, `student_contact_mail`, `student_contact_mail_active`, `student_contact_sms`, `student_contact_sms_active`, `student_contact_phone`, `student_contact_phone_active`, `group_identifier`, `file_id`) VALUES
(1, 'Maurice', '', 'Moret', 'mauricemoret@hotmail.com', 1, '0612345678', 1, '0612345678', 0, '4A', 0),
(2, 'Desiree', '', 'Klijn', 'desireeklijn@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(3, 'Cindy', 'van de', 'Berg', 'cindyvandeberg@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(4, 'Ahmet', '', 'Ata', 'ahmetata@hotmail.com', 1, '0612345678', 1, '0612345678', 0, '4A', 0),
(5, 'Aydin', '', 'Bilzuk', 'aydinbilzuk@hotmail.com', 1, '0612345678', 1, '0612345678', 0, '3A', 0),
(6, 'Azize', '', 'Bozkurt', 'azizebozkurt@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(7, 'Emel', '', 'Osman', 'emelosman@hotmail.com', 0, '0612345678', 1, '0612345678', 0, '3A', 0),
(8, 'Hassad', '', 'Osman', 'hassadosman@hotmail.com', 1, '0612345678', 1, '0612345678', 0, '4A', 0),
(9, 'Omer', '', 'Ozturk', 'omerozturk@hotmail.com', 0, '0612345678', 1, '0612345678', 1, '3A', 0),
(10, 'Onder', '', 'Parmak', 'onderparmak@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(11, 'Fatima', '', 'Morela', 'fatimamorela@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(12, 'Henk', 'van', 'Rooijen', 'henkvanrooijen@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(13, 'Murat', '', 'Pakier', 'muratpakier@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(14, 'Ali', '', 'Zigdrim', 'alizigdrim@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(15, 'Sebastiaan', '', 'Scheers', 'sebastiaanscheers@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(16, 'Sebastiaan', '', 'Mekes', 'sebastiaanmekes@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(17, 'Floor', '', 'Jansen', 'floorjansen@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(18, 'Ashley', 'van', 'Herwijnen', 'ashleyvanherwijnen@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(19, 'Bas', '', 'Boot', 'basboot@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(21, 'Abby', 'van', 'Tol', 'abbyvantol@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(22, 'Kyra', '', 'Tempelaar', 'kyratempelaar@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0),
(23, 'Patrick', '', 'Noordermeer', 'patricknoordermeer@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '4A', 0),
(24, 'Ricardo', '', 'Tan', 'ricardotan@hotmail.com', 1, '0612345678', 1, '0612345678', 1, '3A', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `students_presence`
--

CREATE TABLE IF NOT EXISTS `students_presence` (
  `student_presence_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_not_present_reason` text NOT NULL,
  `student_presence_datetime` datetime NOT NULL,
  PRIMARY KEY (`student_presence_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Gegevens worden uitgevoerd voor tabel `students_presence`
--

INSERT INTO `students_presence` (`student_presence_id`, `student_id`, `student_not_present_reason`, `student_presence_datetime`) VALUES
(14, 3, 'Niet op komen dagen.', '2012-06-18 19:06:33'),
(15, 6, 'Niet op komen dagen.', '2012-06-18 19:06:33'),
(16, 17, 'Niet op komen dagen.', '2012-06-18 19:06:33'),
(17, 19, 'Niet op komen dagen.', '2012-06-18 19:06:33'),
(18, 3, 'Naar de dokter.', '2012-06-18 20:37:30'),
(19, 6, 'Niet op komen dagen.', '2012-06-18 20:37:30'),
(20, 17, 'Niet op komen dagen.', '2012-06-18 20:37:30'),
(21, 2, 'Niet op komen dagen.', '2012-06-18 20:48:45'),
(22, 5, 'Niet op komen dagen.', '2012-06-18 20:48:45'),
(23, 7, 'Niet op komen dagen.', '2012-06-18 20:48:45'),
(24, 9, 'Niet op komen dagen.', '2012-06-18 20:48:45'),
(25, 7, 'Niet op komen dagen.', '2012-06-18 20:48:54'),
(26, 9, 'Niet op komen dagen.', '2012-06-18 20:48:54'),
(27, 10, 'Niet op komen dagen.', '2012-06-18 20:48:54'),
(28, 12, 'Niet op komen dagen.', '2012-06-18 20:48:54'),
(29, 6, 'Niet op komen dagen.', '2012-06-18 20:50:41'),
(30, 8, 'Niet op komen dagen.', '2012-06-18 20:50:41'),
(31, 11, 'Niet op komen dagen.', '2012-06-18 20:50:41'),
(32, 13, 'Niet op komen dagen.', '2012-06-18 20:50:41'),
(33, 15, 'Niet op komen dagen.', '2012-06-18 20:50:41'),
(34, 1, 'Niet op komen dagen.', '2012-06-18 20:53:13'),
(35, 3, 'Komt een uurtje later.', '2012-06-18 20:53:13'),
(36, 3, 'Ziek', '2012-06-18 21:36:10');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_first_name` varchar(90) NOT NULL,
  `teacher_insertion` varchar(10) NOT NULL,
  `teacher_last_name` varchar(90) NOT NULL,
  `teacher_password` varchar(90) NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_first_name`, `teacher_insertion`, `teacher_last_name`, `teacher_password`, `teacher_email`) VALUES
(1, 'Cindy', 'van den', 'Berg', 'cvdb', 'cvdb@hotmail.com'),
(2, 'Mark', '', 'Bijl', 'mb', 'mb@hotmail.com'),
(5, 'Desiree', '', 'Klijn', 'dk', 'dk@hotmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teachers_has_groups`
--

CREATE TABLE IF NOT EXISTS `teachers_has_groups` (
  `teacher_id` int(11) NOT NULL,
  `group_identifier` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `teachers_has_groups`
--

INSERT INTO `teachers_has_groups` (`teacher_id`, `group_identifier`) VALUES
(2, '3A'),
(2, '4A'),
(1, '2A'),
(1, '3A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
