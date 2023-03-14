-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 mrt 2023 om 15:54
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrumapp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `koppelstanduptaken`
--

CREATE TABLE `koppelstanduptaken` (
  `StandupId` int(11) NOT NULL,
  `TakenId` int(11) NOT NULL,
  `Afgerond` date NOT NULL,
  `NietAfgerond` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `koppelusergroep`
--

CREATE TABLE `koppelusergroep` (
  `userId` int(11) NOT NULL,
  `groepid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `koppelusergroep`
--

INSERT INTO `koppelusergroep` (`userId`, `groepid`) VALUES
(1, 3),
(3, 3),
(2, 3),
(4, 3),
(14, 7),
(15, 7),
(13, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `retros`
--

CREATE TABLE `retros` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `groepId` int(11) NOT NULL,
  `scrummasterId` int(11) NOT NULL DEFAULT 0,
  `coatchId` int(11) DEFAULT 0,
  `datum` int(11) DEFAULT NULL,
  `bijdrage` varchar(500) DEFAULT NULL,
  `meerwaarden` varchar(500) DEFAULT NULL,
  `tegenaan` varchar(500) DEFAULT NULL,
  `tips` varchar(100) DEFAULT NULL,
  `tops` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `retros`
--

INSERT INTO `retros` (`id`, `userId`, `groepId`, `scrummasterId`, `coatchId`, `datum`, `bijdrage`, `meerwaarden`, `tegenaan`, `tips`, `tops`) VALUES
(19, 1, 3, 1, NULL, 3, 'B', 'f', 'f', 'f| f| f', 'f| f| f'),
(20, 1, 3, 1, NULL, 2, 'Goed', 'Veel', 'niks', 'tip voor tim| tip remon| tip martijn ', 'top tim| top remon| top martijn'),
(21, 1, 3, 1, NULL, 4, 'Bijdrage was goed', 'Meerwaarden ook', 'Helemaal nothing', 'tip voor tim| tip remon| tip martijn ', 'top tim| top remon| top martijn'),
(22, 1, 3, 1, NULL, 4, NULL, NULL, 'Niks', '| | ', '| | '),
(23, 1, 3, 1, NULL, 4, NULL, NULL, 'Tegen de muur', '| | ', '| | ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `groepId` int(11) NOT NULL,
  `scrummasterId` int(11) NOT NULL,
  `productownerId` int(11) DEFAULT NULL,
  `datum` int(11) DEFAULT NULL,
  `backlogitems` varchar(50) DEFAULT NULL,
  `demonstreren` varchar(50) DEFAULT NULL,
  `samenwerking` varchar(50) DEFAULT NULL,
  `todoitems` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `userId`, `groepId`, `scrummasterId`, `productownerId`, `datum`, `backlogitems`, `demonstreren`, `samenwerking`, `todoitems`) VALUES
(9, 1, 3, 1, NULL, 3, 'b', 'b', 'b', 'b'),
(10, 1, 3, 1, NULL, 2, 'Veel', 'Niks', 'goedd', 'ook veel'),
(11, 1, 3, 1, NULL, 4, 'f', 'f', 'f', 'f');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scrumgroepen`
--

CREATE TABLE `scrumgroepen` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `projectNaam` varchar(50) NOT NULL,
  `scrummaster` int(11) NOT NULL DEFAULT 0,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `archived` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `scrumgroepen`
--

INSERT INTO `scrumgroepen` (`id`, `naam`, `projectNaam`, `scrummaster`, `startDate`, `endDate`, `archived`) VALUES
(3, 'P7.1 T2', 'ScrumApp', 1, '2023-02-06 09:00:00', '2023-03-17 16:30:00', 0),
(7, 'P7.1 T1', 'ScrumApp', 14, '2023-02-06 09:00:00', '2023-03-17 16:30:00', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `standups`
--

CREATE TABLE `standups` (
  `id` int(11) NOT NULL,
  `groepId` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `taken`
--

CREATE TABLE `taken` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `groepId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `taken`
--

INSERT INTO `taken` (`id`, `naam`, `userId`, `groepId`) VALUES
(6, 'Side bar maken', 1, 3),
(7, 'Login pagina maken', 1, 3),
(8, 'Review pagina maken', 15, 3),
(9, 'Login pagina maken', 15, 3),
(10, 'Retro opslaan in database', 3, 3),
(11, 'Account activeren functie', 3, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `isActivated` int(1) NOT NULL DEFAULT 0,
  `role` int(1) NOT NULL,
  `activationCode` varchar(50) NOT NULL,
  `activatedOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `naam`, `email`, `password`, `isActivated`, `role`, `activationCode`, `activatedOn`) VALUES
(1, 'Maarten', 'maartenvannimwegen@hotmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '64882f24-43fb-417a-9c3a-a450312fd016', '2023-03-08 17:35:14'),
(2, 'Richard Kingma', 'rkingma@rocfriesepoort.nl', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 1, '64882f25-43fb-417a-9c3a-a450312fd016', '2023-03-06 12:50:02'),
(3, 'Tim', 'timhammer@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '64882f26-43fb-417a-9c3a-a450312fd016', '2023-03-01 17:05:09'),
(4, 'Martijn', 'martijngraafsma@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '64882f27-43fb-417a-9c3a-a450312fd016', '2023-03-01 17:05:23'),
(13, 'Christian', 'c.f.koopman2905@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '640861a4c7963', '2023-03-08 17:27:03'),
(14, 'Arwin', 'arwinwalsweer@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '640861f84048d', '2023-03-08 17:27:04'),
(15, 'Remon', 'remondollenkamp@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 0, '640861f84048gg', '2023-03-08 17:27:04');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `koppelstanduptaken`
--
ALTER TABLE `koppelstanduptaken`
  ADD KEY `StandupId` (`StandupId`),
  ADD KEY `TakenId` (`TakenId`);

--
-- Indexen voor tabel `koppelusergroep`
--
ALTER TABLE `koppelusergroep`
  ADD KEY `FK_koppelusergroep_gebruikers` (`userId`),
  ADD KEY `FK_koppelusergroep_scrumgroepen` (`groepid`);

--
-- Indexen voor tabel `retros`
--
ALTER TABLE `retros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_retros_users` (`userId`),
  ADD KEY `FK_retros_users_2` (`scrummasterId`),
  ADD KEY `FK_retros_users_3` (`coatchId`),
  ADD KEY `FK_retros_users_4` (`groepId`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reviews_users` (`userId`),
  ADD KEY `FK_reviews_users_2` (`scrummasterId`),
  ADD KEY `FK_reviews_users_3` (`productownerId`),
  ADD KEY `FK_reviews_scrumgroepen` (`groepId`);

--
-- Indexen voor tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_scrumgroepen_users` (`scrummaster`);

--
-- Indexen voor tabel `standups`
--
ALTER TABLE `standups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_standups_scrumgroepen` (`groepId`);

--
-- Indexen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_taken_users` (`userId`),
  ADD KEY `FK_taken_scrumgroepen` (`groepId`) USING BTREE;

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `retros`
--
ALTER TABLE `retros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `standups`
--
ALTER TABLE `standups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `taken`
--
ALTER TABLE `taken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `koppelstanduptaken`
--
ALTER TABLE `koppelstanduptaken`
  ADD CONSTRAINT `StandupId` FOREIGN KEY (`StandupId`) REFERENCES `standups` (`id`),
  ADD CONSTRAINT `TakenId` FOREIGN KEY (`TakenId`) REFERENCES `taken` (`id`);

--
-- Beperkingen voor tabel `koppelusergroep`
--
ALTER TABLE `koppelusergroep`
  ADD CONSTRAINT `FK_koppelusergroep_gebruikers` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_koppelusergroep_scrumgroepen` FOREIGN KEY (`groepid`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `retros`
--
ALTER TABLE `retros`
  ADD CONSTRAINT `FK_retros_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_retros_users_2` FOREIGN KEY (`scrummasterId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_retros_users_3` FOREIGN KEY (`coatchId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_retros_users_4` FOREIGN KEY (`groepId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_scrumgroepen` FOREIGN KEY (`groepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_reviews_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_reviews_users_2` FOREIGN KEY (`scrummasterId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_reviews_users_3` FOREIGN KEY (`productownerId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  ADD CONSTRAINT `FK_scrumgroepen_users` FOREIGN KEY (`scrummaster`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `standups`
--
ALTER TABLE `standups`
  ADD CONSTRAINT `FK_standups_scrumgroepen` FOREIGN KEY (`groepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD CONSTRAINT `FK_taken_scrumgroepen` FOREIGN KEY (`groepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
scrumapp