-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 26. čen 2017, 12:04
-- Verze serveru: 10.1.22-MariaDB
-- Verze PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `crud`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `deadline` date NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 - casove omezeny, 1 - Continuous Integration',
  `webProject` tinyint(1) NOT NULL COMMENT '0 - false, 1 - true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Uchovava seznam projektu';

-- --------------------------------------------------------

--
-- Struktura tabulky `project_user`
--

CREATE TABLE `project_user` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users.id` (`user`),
  ADD KEY `projects.id` (`project`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pro tabulku `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `projects.id` FOREIGN KEY (`project`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `users.id` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
