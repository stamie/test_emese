-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2021. Már 16. 17:06
-- Kiszolgáló verziója: 10.3.25-MariaDB-0ubuntu1
-- PHP verzió: 7.3.24-2+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tredency_emese`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `furniture`
--

CREATE TABLE `furniture` (
  `id` int(11) NOT NULL,
  `inventory_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `modell_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `furniture`
--

INSERT INTO `furniture` (`id`, `inventory_number`, `modell_id`, `price`, `count`) VALUES
(2, 'dwerwer', NULL, 200, 1000),
(3, 'dwerwer', NULL, 200, 1000),
(8, 'dwerwer2', 0, 2020, 2020);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `modell`
--

CREATE TABLE `modell` (
  `id` int(11) NOT NULL,
  `type` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `material` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `modell`
--

INSERT INTO `modell` (`id`, `type`, `description`, `material`, `color`) VALUES
(1, 'Próba1', 'Ez egy próba típus', 'Fa', 'Piros'),
(2, 'Próba2', 'Ez egy próba típus', 'Fa', 'Fehér');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(16, 18, 'JPB7GEnCrQZFgxvJH9X8', 'xHZGNI4v+151402Q/S452EG9f3FOSTBEw0e1EgJa8CI=', '2021-03-16 15:18:44', '2021-03-16 16:18:44');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_active`) VALUES
(17, 'estampel@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=16384,t=3,p=1$WTPFyU1n4gRfSGzKUt0JtA$maT4hvmprxLTpbxjtkEY0Z9aFdjwDDiL/qwX+A79GhQ', 1),
(18, 'banyus53@gmail.com', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$argon2id$v=19$m=16384,t=3,p=1$wooxyxP0zLoI3SFbe58Aag$pD7rZ3JWynFwTD2/9jUBGkUGNei6vPC3XI2VCUn6yMM', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- A tábla indexei `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `modell`
--
ALTER TABLE `modell`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- A tábla indexei `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `furniture`
--
ALTER TABLE `furniture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `modell`
--
ALTER TABLE `modell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
