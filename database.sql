-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 feb 2023 om 16:03
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.1

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
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` varchar(50) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `isActivated` int(1) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `Naam`, `username`, `password`, `isActivated`, `role`) VALUES
('0', '', '', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `retros`
--

CREATE TABLE `retros` (
  `id` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `scrummasterId` varchar(50) NOT NULL,
  `coatchId` varchar(50) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `bijdrage` varchar(500) DEFAULT NULL,
  `meerwaarden` varchar(500) DEFAULT NULL,
  `tegenaan` varchar(500) DEFAULT NULL,
  `tips` varchar(100) DEFAULT NULL,
  `tops` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` varchar(50) NOT NULL,
  `scrummasterId` varchar(50) NOT NULL,
  `productownerId` varchar(50) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `backlogitems` varchar(50) DEFAULT NULL,
  `demonstreren` varchar(50) DEFAULT NULL,
  `uitwerkingen` varchar(50) DEFAULT NULL,
  `samenwerking` varchar(50) DEFAULT NULL,
  `todoitems` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scrumgroepen`
--

CREATE TABLE `scrumgroepen` (
  `id` varchar(50) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `projectNaam` varchar(50) NOT NULL,
  `userIds` varchar(500) NOT NULL,
  `scrummaster` varchar(50) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `standups`
--

CREATE TABLE `standups` (
  `id` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `taken`
--

CREATE TABLE `taken` (
  `id` varchar(50) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `isCompleted` int(1) NOT NULL DEFAULT 0,
  `scrumgroepId` varchar(50) NOT NULL,
  `productownerId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexen voor tabel `retros`
--
ALTER TABLE `retros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_retros_gebruikers` (`userId`),
  ADD KEY `FK_retros_gebruikers_2` (`scrummasterId`),
  ADD KEY `FK_retros_gebruikers_3` (`coatchId`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_scrumgroepen_gebruikers` (`userIds`),
  ADD KEY `FK_scrumgroepen_gebruikers_2` (`scrummaster`);

--
-- Indexen voor tabel `standups`
--
ALTER TABLE `standups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_standups_gebruikers` (`userId`);

--
-- Indexen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scrumgroepid` (`scrumgroepId`),
  ADD KEY `userid` (`userId`),
  ADD KEY `FK_taken_gebruikers` (`productownerId`) USING BTREE;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `retros`
--
ALTER TABLE `retros`
  ADD CONSTRAINT `FK_retros_gebruikers` FOREIGN KEY (`userId`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_retros_gebruikers_2` FOREIGN KEY (`scrummasterId`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_retros_gebruikers_3` FOREIGN KEY (`coatchId`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  ADD CONSTRAINT `FK_scrumgroepen_gebruikers` FOREIGN KEY (`userIds`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_scrumgroepen_gebruikers_2` FOREIGN KEY (`scrummaster`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `standups`
--
ALTER TABLE `standups`
  ADD CONSTRAINT `FK_standups_gebruikers` FOREIGN KEY (`userId`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD CONSTRAINT `FK_taken_gebruikers` FOREIGN KEY (`productownerid`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `scrumgroepid` FOREIGN KEY (`scrumgroepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userid` FOREIGN KEY (`userId`) REFERENCES `gebruikers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
