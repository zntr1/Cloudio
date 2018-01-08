-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jan 2018 um 09:12
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cloudia`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_city`
--

CREATE TABLE `tab_city` (
  `postalcode` varchar(20) NOT NULL,
  `city` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_city`
--

INSERT INTO `tab_city` (`postalcode`, `city`) VALUES
('44379', 'Dortmund'),
('48143', 'Münster'),
('48301', 'Nottuln');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_file`
--

CREATE TABLE `tab_file` (
  `fileId` int(11) NOT NULL,
  `filename` varchar(45) DEFAULT NULL,
  `parentfolderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_file`
--

INSERT INTO `tab_file` (`fileId`, `filename`, `parentfolderId`) VALUES
(1, 'Datei1', 4),
(2, 'DateiX', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_file_has_tab_user`
--

CREATE TABLE `tab_file_has_tab_user` (
  `tab_file_fileId` int(11) NOT NULL,
  `tab_user_userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_file_has_tab_user`
--

INSERT INTO `tab_file_has_tab_user` (`tab_file_fileId`, `tab_user_userId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_folder`
--

CREATE TABLE `tab_folder` (
  `folderId` int(11) NOT NULL,
  `foldername` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_folder`
--

INSERT INTO `tab_folder` (`folderId`, `foldername`) VALUES
(2, 'Testfolder'),
(3, 'folder1'),
(4, 'Testfolder');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_folder_has_tab_user`
--

CREATE TABLE `tab_folder_has_tab_user` (
  `tab_folder_folderId` int(11) NOT NULL,
  `tab_user_userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_folder_has_tab_user`
--

INSERT INTO `tab_folder_has_tab_user` (`tab_folder_folderId`, `tab_user_userId`) VALUES
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_gender`
--

CREATE TABLE `tab_gender` (
  `genderId` int(11) NOT NULL,
  `gender` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_gender`
--

INSERT INTO `tab_gender` (`genderId`, `gender`) VALUES
(1, 'Mann'),
(2, 'Frau'),
(3, 'Apache-Helikopter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tab_user`
--

CREATE TABLE `tab_user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(45) DEFAULT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `genderId` int(11) DEFAULT NULL,
  `postalcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tab_user`
--

INSERT INTO `tab_user` (`userId`, `userName`, `firstName`, `lastname`, `password`, `email`, `address`, `birthday`, `genderId`, `postalcode`) VALUES
(1, 'testUser', 'max', 'mustermann', '12345', 'test@test.de', 'testStraße 8', '2012-07-14', 1, '48301'),
(2, 'q', 'q', 'qq', 'qqqqqq', 'q@q.de', 'qstreet', '2001-11-28', 3, '48143');

--
-- Trigger `tab_user`
--
DELIMITER $$
CREATE TRIGGER `trig_user_insert` BEFORE INSERT ON `tab_user` FOR EACH ROW INSERT INTO tab_folder (foldername) values (NEW.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `users_files`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `users_files` (
`tab_user_userId` int(11)
,`filename` varchar(45)
,`parentfolderName` varchar(45)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `user_overview`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `user_overview` (
`userId` int(11)
,`username` varchar(45)
,`firstname` varchar(45)
,`lastname` varchar(45)
,`password` varchar(45)
,`u.e-mail` varchar(255)
,`address` varchar(150)
,`birthday` date
,`gender` varchar(45)
,`city` varchar(45)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ztab_usersfolder`
--

CREATE TABLE `ztab_usersfolder` (
  `folderId` int(11) NOT NULL,
  `userId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur des Views `users_files`
--
DROP TABLE IF EXISTS `users_files`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_files`  AS  select `z`.`tab_user_userId` AS `tab_user_userId`,`f`.`filename` AS `filename`,`fd`.`foldername` AS `parentfolderName` from ((`tab_file` `f` join `tab_file_has_tab_user` `z` on((`z`.`tab_file_fileId` = `f`.`fileId`))) join `tab_folder` `fd` on((`fd`.`folderId` = `f`.`parentfolderId`))) ;

-- --------------------------------------------------------

--
-- Struktur des Views `user_overview`
--
DROP TABLE IF EXISTS `user_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_overview`  AS  select `u`.`userId` AS `userId`,`u`.`userName` AS `username`,`u`.`firstName` AS `firstname`,`u`.`lastname` AS `lastname`,`u`.`password` AS `password`,`u`.`email` AS `u.e-mail`,`u`.`address` AS `address`,`u`.`birthday` AS `birthday`,`g`.`gender` AS `gender`,`c`.`city` AS `city` from ((`tab_user` `u` join `tab_gender` `g` on((`g`.`genderId` = `u`.`genderId`))) join `tab_city` `c` on((`c`.`postalcode` = `u`.`postalcode`))) ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tab_city`
--
ALTER TABLE `tab_city`
  ADD PRIMARY KEY (`postalcode`);

--
-- Indizes für die Tabelle `tab_file`
--
ALTER TABLE `tab_file`
  ADD PRIMARY KEY (`fileId`),
  ADD KEY `parentfolderId` (`parentfolderId`);

--
-- Indizes für die Tabelle `tab_file_has_tab_user`
--
ALTER TABLE `tab_file_has_tab_user`
  ADD PRIMARY KEY (`tab_file_fileId`,`tab_user_userId`),
  ADD KEY `fk_tab_file_has_tab_user_tab_user1_idx` (`tab_user_userId`),
  ADD KEY `fk_tab_file_has_tab_user_tab_file1_idx` (`tab_file_fileId`);

--
-- Indizes für die Tabelle `tab_folder`
--
ALTER TABLE `tab_folder`
  ADD PRIMARY KEY (`folderId`);

--
-- Indizes für die Tabelle `tab_folder_has_tab_user`
--
ALTER TABLE `tab_folder_has_tab_user`
  ADD PRIMARY KEY (`tab_folder_folderId`,`tab_user_userId`),
  ADD KEY `fk_tab_folder_has_tab_user_tab_user1_idx` (`tab_user_userId`),
  ADD KEY `fk_tab_folder_has_tab_user_tab_folder1_idx` (`tab_folder_folderId`);

--
-- Indizes für die Tabelle `tab_gender`
--
ALTER TABLE `tab_gender`
  ADD PRIMARY KEY (`genderId`);

--
-- Indizes für die Tabelle `tab_user`
--
ALTER TABLE `tab_user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `genderId_idx` (`genderId`),
  ADD KEY `postalcode_idx` (`postalcode`);

--
-- Indizes für die Tabelle `ztab_usersfolder`
--
ALTER TABLE `ztab_usersfolder`
  ADD PRIMARY KEY (`folderId`,`userId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tab_file`
--
ALTER TABLE `tab_file`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tab_folder`
--
ALTER TABLE `tab_folder`
  MODIFY `folderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `tab_gender`
--
ALTER TABLE `tab_gender`
  MODIFY `genderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tab_user`
--
ALTER TABLE `tab_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tab_file`
--
ALTER TABLE `tab_file`
  ADD CONSTRAINT `tab_file_ibfk_1` FOREIGN KEY (`parentfolderId`) REFERENCES `tab_folder` (`folderId`);

--
-- Constraints der Tabelle `tab_file_has_tab_user`
--
ALTER TABLE `tab_file_has_tab_user`
  ADD CONSTRAINT `fk_tab_file_has_tab_user_tab_file1` FOREIGN KEY (`tab_file_fileId`) REFERENCES `tab_file` (`fileId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_file_has_tab_user_tab_user1` FOREIGN KEY (`tab_user_userId`) REFERENCES `tab_user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tab_folder_has_tab_user`
--
ALTER TABLE `tab_folder_has_tab_user`
  ADD CONSTRAINT `fk_tab_folder_has_tab_user_tab_folder1` FOREIGN KEY (`tab_folder_folderId`) REFERENCES `tab_folder` (`folderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_folder_has_tab_user_tab_user1` FOREIGN KEY (`tab_user_userId`) REFERENCES `tab_user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tab_user`
--
ALTER TABLE `tab_user`
  ADD CONSTRAINT `genderId` FOREIGN KEY (`genderId`) REFERENCES `tab_gender` (`genderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `postalcode` FOREIGN KEY (`postalcode`) REFERENCES `tab_city` (`postalcode`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
