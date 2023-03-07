-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 mrt 2023 om 13:59
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

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
-- Tabelstructuur voor tabel `koppelusergroep`
--

CREATE TABLE `koppelusergroep` (
  `userId` int(11) NOT NULL,
  `groepid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `datum` datetime DEFAULT NULL,
  `backlogitems` varchar(50) DEFAULT NULL,
  `demonstreren` varchar(50) DEFAULT NULL,
  `samenwerking` varchar(50) DEFAULT NULL,
  `todoitems` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `standups`
--

CREATE TABLE `standups` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `groepId` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `taken` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `taken`
--

CREATE TABLE `taken` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `isCompleted` int(1) NOT NULL DEFAULT 0,
  `groepId` int(11) NOT NULL DEFAULT 0,
  `productownerId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

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
  ADD KEY `FK_standups_users` (`userId`),
  ADD KEY `FK_standups_scrumgroepen` (`groepId`);

--
-- Indexen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_taken_gebruikers` (`productownerId`) USING BTREE,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `scrumgroepen`
--
ALTER TABLE `scrumgroepen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `standups`
--
ALTER TABLE `standups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `taken`
--
ALTER TABLE `taken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

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
  ADD CONSTRAINT `FK_standups_scrumgroepen` FOREIGN KEY (`groepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_standups_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `taken`
--
ALTER TABLE `taken`
  ADD CONSTRAINT `FK_taken_scrumgroepen` FOREIGN KEY (`groepId`) REFERENCES `scrumgroepen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_taken_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_taken_users_2` FOREIGN KEY (`productownerId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
