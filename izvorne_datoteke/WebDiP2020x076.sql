-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2021 at 03:14 AM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x076`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `tip_zapisa_tip_zapisa_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL,
  `radnja` text NOT NULL,
  `upit` text NOT NULL,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `tip_zapisa_tip_zapisa_id`, `korisnik_korisnik_id`, `radnja`, `upit`, `datum_vrijeme`) VALUES
(20, 1, 1, 'Prijava u sustav.', 'INSERT INTO dnevnik (...) VALUES (...);', '2021-05-02 00:00:00'),
(21, 2, 1, 'Odjava iz sustava.', 'INSERT INTO dnevnik (...) VALUES (...);', '2021-05-04 00:00:00'),
(22, 3, 1, 'Ažuriranje statusa korisnika.', 'UPDATE korisnik SET status_kor = 1 WHERE id = korisnik_korisnik_id;', '2021-05-03 00:00:00'),
(23, 1, 2, 'Prijava u sustav.', 'INSERT INTO dnevnik (...) VALUES (...);', '2021-04-28 00:00:00'),
(24, 3, 2, 'Dodavanje izleta za zaduženo skijalište.', 'INSERT INTO skijaliste (...) VALUES (...);', '2021-05-06 00:00:00'),
(25, 3, 4, 'Dodavanje skijališta za zaduženo skijaliste.', 'INSERT INTO skijaliste (...) VALUES (...);', '2021-05-11 00:00:00'),
(26, 3, 5, 'Dodavanje materijala za izlet.', 'INSERT INTO materijal (...) VALUES (...);', '2021-05-05 00:00:00'),
(27, 3, 7, 'Rezerviranje izleta.', 'INSERT INTO rezervacija (...) VALUES (...);', '2021-05-06 00:00:00'),
(28, 4, 10, 'Pregled izleta.', 'SELECT * FROM izlet;', '2021-05-11 00:00:00'),
(29, 4, 3, 'Pregled rezervacija za određeni izlet.', 'SELECT rezervacija_id FROM izlet WHERE id = izlet_id;', '2021-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_igra`
--

CREATE TABLE `DZ4_igra` (
  `igra_id` int(11) NOT NULL,
  `naziv_igre` varchar(60) NOT NULL,
  `naziv_proizv` varchar(60) NOT NULL,
  `naziv_engina` varchar(60) NOT NULL,
  `naziv_dizajnera` varchar(60) NOT NULL,
  `datum_izlaska` date NOT NULL,
  `vrijeme_odrzavanja` time NOT NULL,
  `DZ4_korisnik_korisnik_id` int(11) NOT NULL,
  `DZ4_platforma_platforma_id` int(11) NOT NULL,
  `DZ4_zanr_zanr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_igra`
--

INSERT INTO `DZ4_igra` (`igra_id`, `naziv_igre`, `naziv_proizv`, `naziv_engina`, `naziv_dizajnera`, `datum_izlaska`, `vrijeme_odrzavanja`, `DZ4_korisnik_korisnik_id`, `DZ4_platforma_platforma_id`, `DZ4_zanr_zanr_id`) VALUES
(1, 'Apex Legends', 'Respawn Entertainment', 'Source', 'Mackey McCanlish', '2019-04-02', '04:19:30', 3, 1, 1),
(2, 'Crash Bandicoot 4', 'Activision', 'Unreal Engine', 'Toys for Bob', '2020-09-16', '13:17:24', 4, 5, 3),
(3, 'Watch Dogs', 'Ubisoft', 'Disrupt', 'Clint Hocking', '2021-05-27', '18:11:48', 3, 4, 5),
(4, 'League of Legends', 'RIOT', 'Unity', 'Steve Feak', '2009-10-27', '23:36:09', 4, 1, 2),
(5, 'Rainbow Six Siege', 'Ubisoft Montreal', 'AnvilNext', 'Daniel Draqeau', '2015-04-07', '00:14:30', 3, 1, 1),
(13, 'test123', 'test123', 'test123', 'test123', '1999-09-12', '11:11:11', 2, 1, 4),
(14, 'Pirates', 'Jack', 'BoxStudios', 'Micky', '2015-04-26', '12:30:56', 2, 5, 5),
(21, 'test2', 'test2', 'test2', 'test2', '1999-09-12', '11:11:11', 4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_korisnik`
--

CREATE TABLE `DZ4_korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime_kor` varchar(45) NOT NULL,
  `prez_kor` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinkaSHA256` char(64) NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `DZ4_tip_korisnika_tip_kor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_korisnik`
--

INSERT INTO `DZ4_korisnik` (`korisnik_id`, `ime_kor`, `prez_kor`, `korisnicko_ime`, `email`, `lozinka`, `lozinkaSHA256`, `datum_vrijeme`, `DZ4_tip_korisnika_tip_kor_id`) VALUES
(2, 'Emanuel', 'Radotović', 'eradotovic', 'eradotovic@gmail.com', 'eradotovic123', '447e988738dadf2ae057faa2e794c8089560c984f7b1d14788f5128146c56ce0', '2021-05-04 00:00:00', 4),
(3, 'Lovro', 'Radotović', 'lradotovic', 'lradotovic@gmail.com', 'lradotovic123', 'ebfcd9b720cecabea1d86bcad11df5f7ea5a63af432a8d37abff0e265503151a', '2021-04-21 00:00:00', 3),
(4, 'Ivan', 'Kaić', 'ikaic', 'ikaic@gmail.com', 'ikaic123', '053b32a3f4a4bc313674ea71882d36445990f42a19b0923e201b3e65dfcbfa1c', '2021-05-03 00:00:00', 3),
(5, 'Tomislav', 'Ogrinec', 'togrinec', 'togrinec@gmail.com', 'togrinec123', '694fb228e90f9be34ae8abfc33d9e372a7554129414406c1badc2663b0b41620', '2021-05-07 00:00:00', 2),
(6, 'Eugen', 'Petošić', 'epetosic', 'epetosic@gmail.com', 'epetosic123', '1c3b0c36ea9ab5b9dc10de0f0d934ae6c55acf0bdccd043c489eb2162ff98c85', '2021-05-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_platforma`
--

CREATE TABLE `DZ4_platforma` (
  `platforma_id` int(11) NOT NULL,
  `naziv_platforme` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_platforma`
--

INSERT INTO `DZ4_platforma` (`platforma_id`, `naziv_platforme`) VALUES
(1, 'Windows'),
(2, 'Mac'),
(3, 'Linux'),
(4, 'PS3'),
(5, 'PS4'),
(6, 'xbox360'),
(7, 'xboxONE');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_tip_korisnika`
--

CREATE TABLE `DZ4_tip_korisnika` (
  `tip_kor_id` int(11) NOT NULL,
  `naziv_tipa_kor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_tip_korisnika`
--

INSERT INTO `DZ4_tip_korisnika` (`tip_kor_id`, `naziv_tipa_kor`) VALUES
(1, 'neregistrirani korisnik'),
(2, 'registrirani korisnik'),
(3, 'moderator'),
(4, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_zanr`
--

CREATE TABLE `DZ4_zanr` (
  `zanr_id` int(11) NOT NULL,
  `naziv_zanra` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_zanr`
--

INSERT INTO `DZ4_zanr` (`zanr_id`, `naziv_zanra`) VALUES
(1, 'FPS'),
(2, 'MOBA'),
(3, 'Platformer'),
(4, 'Soccer'),
(5, 'ActionAdventure'),
(6, 'Racing');

-- --------------------------------------------------------

--
-- Table structure for table `izlet`
--

CREATE TABLE `izlet` (
  `izlet_id` int(11) NOT NULL,
  `upravitelj_korisnik_korisnik_id` int(11) NOT NULL,
  `upravitelj_skijaliste_skijaliste_id` int(11) NOT NULL,
  `naziv_izleta` varchar(80) NOT NULL,
  `opis_izleta` text NOT NULL,
  `min_br_kor` int(11) NOT NULL,
  `max_br_kor` int(11) NOT NULL,
  `status_izleta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `izlet`
--

INSERT INTO `izlet` (`izlet_id`, `upravitelj_korisnik_korisnik_id`, `upravitelj_skijaliste_skijaliste_id`, `naziv_izleta`, `opis_izleta`, `min_br_kor`, `max_br_kor`, `status_izleta`) VALUES
(1, 2, 1, 'Izlet iz snova 1', 'Skijanje, harana, odmor uz predivan poglet. Posjetite životinje u obližnjoj šumi.', 7, 30, 1),
(2, 3, 2, 'Izlet iz snova 2', 'Skijanje, još malo skijanja, odmor uz predivan poglet. Posjetite životinje u obližnjoj šumi. Hrana je jako dobra.', 6, 25, 1),
(3, 4, 3, 'Izlet iz snova 3', 'Fina hrana, harana, odmor uz predivan poglet. Skijanje u obližnjoj šumi.', 10, 50, 0),
(4, 2, 4, 'Izlet iz snova 4', 'Odmor uz predivan poglet. Posjetite životinje u obližnjoj šumi. Skijanje zagarantirano.', 9, 32, 1),
(5, 3, 2, 'Izlet iz snova 5', 'Skijanje, harana, odmor uz predivan poglet. Posjetite životinje u obližnjoj šumi.', 7, 30, 1),
(6, 4, 9, 'Izlet iz snova 6', 'Skijanje, harana, odmor uz predivan poglet. Hrana domaća skijanje nije.', 5, 45, 1),
(7, 4, 9, 'Izlet iz snova 7', 'Harana, odmor uz predivan poglet. Planinarenje je zakon uz društvo i instruktore. Skijanje.', 12, 60, 1),
(8, 3, 5, 'Izlet iz snova 8', 'Skijanje, harana, odmor uz predivan poglet. Skijanje i natjevanje u skijanu uz odličnu muziku i zabavu.', 16, 30, 0),
(9, 2, 10, 'Izlet iz snova 9', 'Nauči skijati i okusi hranu zaviačaja. Odličan pogled sa vidikovca.', 15, 80, 0),
(10, 3, 8, 'Izlet na skijanje 10', 'Skijanje, harana, odmor uz predivan poglet. Posjetite životinje u obližnjoj šumi.', 6, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konfiguracija`
--

CREATE TABLE `konfiguracija` (
  `broj_redaka` int(11) DEFAULT NULL,
  `broj_pokusaja` int(11) DEFAULT NULL,
  `pomakVremena` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `konfiguracija`
--

INSERT INTO `konfiguracija` (`broj_redaka`, `broj_pokusaja`, `pomakVremena`) VALUES
(5, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `tip_korisnika_tip_kor_id` int(11) NOT NULL,
  `ime_kor` varchar(45) NOT NULL,
  `prez_kor` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinkaSHA256` char(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uvjeti` datetime DEFAULT NULL,
  `status_kor` tinyint(1) NOT NULL,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `tip_korisnika_tip_kor_id`, `ime_kor`, `prez_kor`, `korisnicko_ime`, `lozinka`, `lozinkaSHA256`, `email`, `uvjeti`, `status_kor`, `datum_vrijeme`) VALUES
(1, 1, 'Emanuel', 'Radotović', 'eradotovic', 'eradotovic123', '447e988738dadf2ae057faa2e794c8089560c984f7b1d14788f5128146c56ce0', 'eradotovic@gmail.com', '2021-05-05 00:00:00', 1, '2021-04-04 00:00:00'),
(2, 2, 'Lovro', 'Radotović', 'lradotovic', 'lradotovic123', 'ebfcd9b720cecabea1d86bcad11df5f7ea5a63af432a8d37abff0e265503151a', 'lradotovic@gmail.com', '2021-05-04 00:00:00', 1, '2021-03-10 00:00:00'),
(3, 2, 'Ivana', 'Šimunjak', 'isimunjak', 'isimunjak123', '54336acdb0a87c7049969201c42ddc3a34cfbebce2bdb28fc16db25b02305996', 'isimunjak@gmail.com', '2021-05-02 00:00:00', 1, '2021-04-18 00:00:00'),
(4, 2, 'Ivan', 'Kaić', 'ikaic', 'ikaic123', '053b32a3f4a4bc313674ea71882d36445990f42a19b0923e201b3e65dfcbfa1c', 'ikaic@gmail.com', '2021-05-02 00:00:00', 1, '2021-04-22 00:00:00'),
(5, 3, 'Luka', 'Harambašić', 'lharambasic', 'lharambasic123', '548bf1d21462947031f5b3294f38c07c5549a7650a82c5a589c5b8d363f09a24', 'lharambasic@gmail.com', '2021-05-04 00:00:00', 1, '2021-04-17 00:00:00'),
(6, 3, 'Tomislav', 'Ogrinec', 'togrinec', 'togrinec123', '694fb228e90f9be34ae8abfc33d9e372a7554129414406c1badc2663b0b41620', 'togrinec@gmail.com', '2021-04-09 00:00:00', 1, '2021-04-20 00:00:00'),
(7, 3, 'Eugen', 'Petošić', 'epetosic', 'epetosic123', '1c3b0c36ea9ab5b9dc10de0f0d934ae6c55acf0bdccd043c489eb2162ff98c85', 'epetosic@gmail.com', '2021-04-19 00:00:00', 1, '2021-04-13 00:00:00'),
(8, 3, 'Zvonimir', 'Šestak', 'zsestak', 'zsestak123', '722bb7a3ed423fdc136c793e639aa4514c56ac61a4d0c9e5b647e51d4b6b0e2f', 'zsestak@gmail.com', '2021-05-12 00:00:00', 1, '2021-05-13 00:00:00'),
(9, 4, 'Mateo', 'Radman', 'mradman', 'mradman123', '8b483afbb0e00a4443ac2b39aa4410d031d9626b40fb5a3bfab4237a0a5bc425', 'mradman@gmail.com', NULL, 1, '2021-05-03 00:00:00'),
(10, 4, 'Ana', 'Hitrec', 'ahitrec', 'ahitrec123', '5560b7911d0b6c9166e0eb7cffb0543b6d5f9f2725973ce48803d5e5f4c7bac0', 'ahitrec@gmail.com', NULL, 1, '2021-05-04 00:00:00'),
(12, 3, 'Branko', 'Brankic', 'bbrankic', 'bbrankic123', '7529f5d6752d7dc402801f45b07b33385c631cb849e060b3f387ccec21b220bb', 'bbrankic@gmail.com', NULL, 1, '2021-06-04 11:42:49'),
(14, 3, 'Emanul', 'Brankic', 'novo', 'novonovo123', '03528949d3f564c471a6c7216a35d80cb069f857de3778a22cbb30cffb9730c6', 'novo@gmail.com', NULL, 1, '2021-06-08 14:11:10'),
(16, 3, 'Kikam', 'Edmon', 'kedmon', 'AoPR4FGHL7', '64b5a83e99a67a8f4b5f19d3faa6cf3b31cd6edbd6c4c724f283da22bfc956cd', 'kikam42273@edmondpt.com', NULL, 1, '2021-06-10 17:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
  `materijal_id` int(11) NOT NULL,
  `vrsta_materijala_vrsta_materijala_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL,
  `izlet_izlet_id` int(11) NOT NULL,
  `naziv_materijala` varchar(80) NOT NULL,
  `poveznica_mat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materijal`
--

INSERT INTO `materijal` (`materijal_id`, `vrsta_materijala_vrsta_materijala_id`, `korisnik_korisnik_id`, `izlet_izlet_id`, `naziv_materijala`, `poveznica_mat`) VALUES
(1, 1, 5, 1, 'Slika najboljeg skijališta', 'https://www.skiportal.hr/wp/wp-content/uploads/2013/10/bad-gastein.jpg'),
(2, 1, 6, 2, 'Pogled iz snova', 'https://www.skiportal.hr/wp/wp-content/uploads/2013/10/Jahorina-istaknuta-600x450.jpg'),
(3, 2, 7, 1, 'Spidi gonzales na snjegu', 'https://www.youtube.com/watch?v=8lxBPukQ9jo'),
(4, 4, 5, 6, 'Kratki opis izleta', 'https://zavod.pgz.hr/PDF/2Gdio_platak%20-%20lipa.pdf'),
(5, 3, 7, 4, 'Zvuk snježne divljine', 'https://www.youtube.com/watch?v=CQ-osDcd9Ns'),
(6, 1, 6, 2, 'Snjeg i sunce', 'https://www.skiportal.hr/wp/wp-content/uploads/2013/11/zimovanje-zlatibor-skijanje-gal02-600x450.jpg'),
(7, 2, 7, 5, 'Prekrasna skijališta', 'https://www.youtube.com/watch?v=xsEMjWdgRdw'),
(8, 1, 6, 4, 'Apartmani skijališta', 'https://www.skiportal.hr/wp/wp-content/uploads/2013/10/Valmenier-istaknuta-600x450.jpg'),
(9, 1, 5, 2, 'Skijaška oprema', 'https://previews.123rf.com/images/skellos/skellos1701/skellos170100017/69806437-skiing-icons-set-of-complete-ski-and-snowboard-outfit-and-ski-resort-equipment-with-girl-on-skis-in-.jpg'),
(10, 1, 7, 3, 'Pogled u daljinu', 'https://www.skiportal.hr/wp/wp-content/uploads/2015/10/Monte-Bondone-istaknuta1-600x358.jpg'),
(14, 1, 5, 7, 'Prekrasan dan', 'https://i.pinimg.com/originals/9c/68/fc/9c68fc0fe155f07e256d08a08d9bddab.jpg'),
(15, 2, 5, 7, 'Planinski zavičaj', 'https://www.youtube.com/watch?v=wov1DA-Jtjc'),
(16, 4, 5, 7, 'Kako skijati', 'https://www.moveunitedsport.org/wp-content/uploads/2016/07/PSIA_AdaptiveFundamentals_Final_web.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `rezervacija_id` int(11) NOT NULL,
  `korisnik_korisnik_id` int(11) NOT NULL,
  `izlet_izlet_id` int(11) NOT NULL,
  `status_rez` tinyint(1) NOT NULL,
  `ime_rez` varchar(45) NOT NULL,
  `prez_rez` varchar(45) NOT NULL,
  `br_rez_mjesta` int(11) NOT NULL,
  `pristiglo_nakon_brmj` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`rezervacija_id`, `korisnik_korisnik_id`, `izlet_izlet_id`, `status_rez`, `ime_rez`, `prez_rez`, `br_rez_mjesta`, `pristiglo_nakon_brmj`) VALUES
(1, 5, 1, 1, 'Luka', 'Harambašić', 2, 0),
(2, 6, 5, 1, 'Tomislav', 'Ogrinec', 10, 0),
(3, 7, 1, 1, 'Eugen', 'Petošić', 3, 0),
(4, 5, 7, 1, 'Luka', 'Harambašić', 5, 0),
(5, 6, 2, 1, 'Tomislav', 'Ogrinec', 20, 0),
(6, 7, 7, 0, 'Eugen', 'Petošić', 6, 0),
(7, 5, 4, 0, 'Luka', 'Harambašić', 2, 0),
(8, 6, 1, 0, 'Tomislav', 'Ogrinec', 2, 0),
(9, 7, 6, 1, 'Eugen', 'Petošić', 2, 0),
(13, 5, 3, 0, 'Janko', 'Jankić', 13, 0),
(19, 5, 9, 0, 'Emi', 'Rade', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `skijaliste`
--

CREATE TABLE `skijaliste` (
  `skijaliste_id` int(11) NOT NULL,
  `naziv_skijalista` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skijaliste`
--

INSERT INTO `skijaliste` (`skijaliste_id`, `naziv_skijalista`) VALUES
(1, 'Platak'),
(2, 'Sljeme'),
(3, 'Gerlitzen'),
(4, 'Jahorina'),
(5, 'Vlašić'),
(6, 'Alpe d’Huez'),
(7, 'Bormio'),
(8, 'Popova Šapka'),
(9, 'Park City'),
(10, 'Zlatibor');

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE `tip_korisnika` (
  `tip_kor_id` int(11) NOT NULL,
  `naziv_tipa_kor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`tip_kor_id`, `naziv_tipa_kor`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik'),
(4, 'Neregistrirani korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `tip_zapisa`
--

CREATE TABLE `tip_zapisa` (
  `tip_zapisa_id` int(11) NOT NULL,
  `naziv_tipa_zapisa` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_zapisa`
--

INSERT INTO `tip_zapisa` (`tip_zapisa_id`, `naziv_tipa_zapisa`) VALUES
(1, 'prijava'),
(2, 'odjava'),
(3, 'rad s bazom'),
(4, 'ostale radnje');

-- --------------------------------------------------------

--
-- Table structure for table `upravitelj`
--

CREATE TABLE `upravitelj` (
  `korisnik_korisnik_id` int(11) NOT NULL,
  `skijaliste_skijaliste_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upravitelj`
--

INSERT INTO `upravitelj` (`korisnik_korisnik_id`, `skijaliste_skijaliste_id`) VALUES
(2, 1),
(3, 2),
(4, 3),
(2, 4),
(3, 5),
(4, 6),
(2, 7),
(3, 8),
(4, 9),
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_materijala`
--

CREATE TABLE `vrsta_materijala` (
  `vrsta_materijala_id` int(11) NOT NULL,
  `naziv_vrste_mat` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vrsta_materijala`
--

INSERT INTO `vrsta_materijala` (`vrsta_materijala_id`, `naziv_vrste_mat`) VALUES
(1, 'slika'),
(2, 'video'),
(3, 'audio'),
(4, 'pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`tip_zapisa_tip_zapisa_id`,`korisnik_korisnik_id`),
  ADD KEY `fk_dnevnik_tip_zapisa1_idx` (`tip_zapisa_tip_zapisa_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_korisnik_id`);

--
-- Indexes for table `DZ4_igra`
--
ALTER TABLE `DZ4_igra`
  ADD PRIMARY KEY (`igra_id`,`DZ4_korisnik_korisnik_id`,`DZ4_platforma_platforma_id`,`DZ4_zanr_zanr_id`),
  ADD KEY `fk_DZ4_igra_DZ4_korisnik1_idx` (`DZ4_korisnik_korisnik_id`),
  ADD KEY `fk_DZ4_igra_DZ4_platforma1_idx` (`DZ4_platforma_platforma_id`),
  ADD KEY `fk_DZ4_igra_DZ4_zanr1_idx` (`DZ4_zanr_zanr_id`);

--
-- Indexes for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_DZ4_korisnik_DZ4_tip_korisnika1_idx` (`DZ4_tip_korisnika_tip_kor_id`);

--
-- Indexes for table `DZ4_platforma`
--
ALTER TABLE `DZ4_platforma`
  ADD PRIMARY KEY (`platforma_id`);

--
-- Indexes for table `DZ4_tip_korisnika`
--
ALTER TABLE `DZ4_tip_korisnika`
  ADD PRIMARY KEY (`tip_kor_id`);

--
-- Indexes for table `DZ4_zanr`
--
ALTER TABLE `DZ4_zanr`
  ADD PRIMARY KEY (`zanr_id`);

--
-- Indexes for table `izlet`
--
ALTER TABLE `izlet`
  ADD PRIMARY KEY (`izlet_id`),
  ADD KEY `fk_izlet_upravitelj1_idx` (`upravitelj_korisnik_korisnik_id`,`upravitelj_skijaliste_skijaliste_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_korisnik_tip_korisnika1_idx` (`tip_korisnika_tip_kor_id`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`materijal_id`,`vrsta_materijala_vrsta_materijala_id`,`korisnik_korisnik_id`,`izlet_izlet_id`),
  ADD KEY `fk_materijal_vrsta_materijala1_idx` (`vrsta_materijala_vrsta_materijala_id`),
  ADD KEY `fk_materijal_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `fk_materijal_izlet1_idx` (`izlet_izlet_id`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`rezervacija_id`,`korisnik_korisnik_id`,`izlet_izlet_id`),
  ADD KEY `fk_rezervacija_korisnik1_idx` (`korisnik_korisnik_id`),
  ADD KEY `fk_rezervacija_izlet1_idx` (`izlet_izlet_id`);

--
-- Indexes for table `skijaliste`
--
ALTER TABLE `skijaliste`
  ADD PRIMARY KEY (`skijaliste_id`);

--
-- Indexes for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  ADD PRIMARY KEY (`tip_kor_id`);

--
-- Indexes for table `tip_zapisa`
--
ALTER TABLE `tip_zapisa`
  ADD PRIMARY KEY (`tip_zapisa_id`);

--
-- Indexes for table `upravitelj`
--
ALTER TABLE `upravitelj`
  ADD PRIMARY KEY (`korisnik_korisnik_id`,`skijaliste_skijaliste_id`),
  ADD KEY `fk_korisnik_has_skijaliste_skijaliste1_idx` (`skijaliste_skijaliste_id`),
  ADD KEY `fk_korisnik_has_skijaliste_korisnik_idx` (`korisnik_korisnik_id`);

--
-- Indexes for table `vrsta_materijala`
--
ALTER TABLE `vrsta_materijala`
  ADD PRIMARY KEY (`vrsta_materijala_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `DZ4_igra`
--
ALTER TABLE `DZ4_igra`
  MODIFY `igra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `DZ4_platforma`
--
ALTER TABLE `DZ4_platforma`
  MODIFY `platforma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `DZ4_tip_korisnika`
--
ALTER TABLE `DZ4_tip_korisnika`
  MODIFY `tip_kor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `DZ4_zanr`
--
ALTER TABLE `DZ4_zanr`
  MODIFY `zanr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `izlet`
--
ALTER TABLE `izlet`
  MODIFY `izlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `materijal`
--
ALTER TABLE `materijal`
  MODIFY `materijal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `rezervacija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `skijaliste`
--
ALTER TABLE `skijaliste`
  MODIFY `skijaliste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  MODIFY `tip_kor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tip_zapisa`
--
ALTER TABLE `tip_zapisa`
  MODIFY `tip_zapisa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vrsta_materijala`
--
ALTER TABLE `vrsta_materijala`
  MODIFY `vrsta_materijala_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_dnevnik_tip_zapisa1` FOREIGN KEY (`tip_zapisa_tip_zapisa_id`) REFERENCES `tip_zapisa` (`tip_zapisa_id`);

--
-- Constraints for table `DZ4_igra`
--
ALTER TABLE `DZ4_igra`
  ADD CONSTRAINT `fk_DZ4_igra_DZ4_korisnik1` FOREIGN KEY (`DZ4_korisnik_korisnik_id`) REFERENCES `DZ4_korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_DZ4_igra_DZ4_platforma1` FOREIGN KEY (`DZ4_platforma_platforma_id`) REFERENCES `DZ4_platforma` (`platforma_id`),
  ADD CONSTRAINT `fk_DZ4_igra_DZ4_zanr1` FOREIGN KEY (`DZ4_zanr_zanr_id`) REFERENCES `DZ4_zanr` (`zanr_id`);

--
-- Constraints for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  ADD CONSTRAINT `fk_DZ4_korisnik_DZ4_tip_korisnika1` FOREIGN KEY (`DZ4_tip_korisnika_tip_kor_id`) REFERENCES `DZ4_tip_korisnika` (`tip_kor_id`);

--
-- Constraints for table `izlet`
--
ALTER TABLE `izlet`
  ADD CONSTRAINT `fk_izlet_upravitelj1` FOREIGN KEY (`upravitelj_korisnik_korisnik_id`,`upravitelj_skijaliste_skijaliste_id`) REFERENCES `upravitelj` (`korisnik_korisnik_id`, `skijaliste_skijaliste_id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_tip_korisnika1` FOREIGN KEY (`tip_korisnika_tip_kor_id`) REFERENCES `tip_korisnika` (`tip_kor_id`);

--
-- Constraints for table `materijal`
--
ALTER TABLE `materijal`
  ADD CONSTRAINT `fk_materijal_izlet1` FOREIGN KEY (`izlet_izlet_id`) REFERENCES `izlet` (`izlet_id`),
  ADD CONSTRAINT `fk_materijal_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_materijal_vrsta_materijala1` FOREIGN KEY (`vrsta_materijala_vrsta_materijala_id`) REFERENCES `vrsta_materijala` (`vrsta_materijala_id`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_rezervacija_izlet1` FOREIGN KEY (`izlet_izlet_id`) REFERENCES `izlet` (`izlet_id`),
  ADD CONSTRAINT `fk_rezervacija_korisnik1` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`);

--
-- Constraints for table `upravitelj`
--
ALTER TABLE `upravitelj`
  ADD CONSTRAINT `fk_korisnik_has_skijaliste_korisnik` FOREIGN KEY (`korisnik_korisnik_id`) REFERENCES `korisnik` (`korisnik_id`),
  ADD CONSTRAINT `fk_korisnik_has_skijaliste_skijaliste1` FOREIGN KEY (`skijaliste_skijaliste_id`) REFERENCES `skijaliste` (`skijaliste_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
