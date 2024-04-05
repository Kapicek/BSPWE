-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 05. dub 2024, 13:25
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bspwe`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'TEST', '$2y$10$kKf8LvBrw4UFft9zSyHbsu9/2gSCWdtOHbPew1lp21e5wKGrcYra6'),
(2, 'afwaf', '$2y$10$Zoc95h9adaMTrSlFux2f4u0Oo6x6ewWZ6TD3RZIera7zmOR9.nLCu');

-- --------------------------------------------------------

--
-- Struktura tabulky `users_domains`
--

CREATE TABLE `users_domains` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users_domains`
--

INSERT INTO `users_domains` (`id`, `id_user`, `domain`, `path`) VALUES
(5, 1, 'TEST.cz', 'cesta/k/slozce/TEST.cz'),
(6, 1, 'asd.cz', 'zatimRandomJsemLinejLolasd.cz'),
(7, 1, 'xdfdddd.cz', '/var/www/html/ZatimRandomJsemLinejLol/xdfdddd.cz'),
(8, 1, 'yoMrWhite.cz', 'E:\\Xamp\\htdocs\\BSPWE/ZatimRandomJsemLinejLol/yoMrWhite.cz');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexy pro tabulku `users_domains`
--
ALTER TABLE `users_domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `users_domains`
--
ALTER TABLE `users_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `users_domains`
--
ALTER TABLE `users_domains`
  ADD CONSTRAINT `users_domains_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
