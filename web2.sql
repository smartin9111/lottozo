-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 14. 23:02
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(10) UNSIGNED NOT NULL,
  `csaladi_nev` varchar(45) NOT NULL DEFAULT '',
  `utonev` varchar(45) NOT NULL DEFAULT '',
  `bejelentkezes` varchar(12) NOT NULL DEFAULT '',
  `jelszo` varchar(40) NOT NULL DEFAULT '',
  `jogosultsag` varchar(3) NOT NULL DEFAULT '_1_'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `csaladi_nev`, `utonev`, `bejelentkezes`, `jelszo`, `jogosultsag`) VALUES
(1, 'Rendszer', 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '__1'),
(2, 'Családi_2', 'Utónév_2', 'Login2', '6cf8efacae19431476020c1e2ebd2d8acca8f5c0', '_1_'),
(3, 'Családi_3', 'Utónév_3', 'Login3', 'df4d8ad070f0d1585e172a2150038df5cc6c891a', '_1_'),
(4, 'Családi_4', 'Utónév_4', 'Login4', 'b020c308c155d6bbd7eb7d27bd30c0573acbba5b', '_1_'),
(5, 'Családi_5', 'Utónév_5', 'Login5', '9ab1a4743b30b5e9c037e6a645f0cfee80fb41d4', '_1_'),
(6, 'Családi_6', 'Utónév_6', 'Login6', '7ca01f28594b1a06239b1d96fc716477d198470b', '_1_'),
(7, 'Családi_7', 'Utónév_7', 'Login7', '41ad7e5406d8f1af2deef2ade4753009976328f8', '_1_'),
(8, 'Családi_8', 'Utónév_8', 'Login8', '3a340fe3599746234ef89591e372d4dd8b590053', '_1_'),
(9, 'Családi_9', 'Utónév_9', 'Login9', 'c0298f7d314ecbc5651da5679a0a240833a88238', '_1_'),
(10, 'Családi_10', 'Utónév_10', 'Login10', 'a477427c183664b57f977661ac3167b64823f366', '_1_'),
(11, 'aaa', 'aaa', 'aaa', '7e240de74fb1ed08fa08d38063f6a6a91462a815', '_1_'),
(12, 'valmi2', 'valmi2', 'valmi2', 'f3ce5b271a90f2ac9fd6cd2a9b49212606bc380b', '_1_');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hirek`
--

CREATE TABLE `hirek` (
  `id` int(11) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `tartalom` varchar(255) NOT NULL,
  `felhasznaloId` int(11) NOT NULL,
  `letrehozva` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `hirek`
--

INSERT INTO `hirek` (`id`, `cim`, `tartalom`, `felhasznaloId`, `letrehozva`) VALUES
(10, 'asdasdasdasdasd', 'asssssssssss', 2, '0000-00-00 00:00:00'),
(11, 'xxx', 'xxxxx', 2, '0000-00-00 00:00:00'),
(12, 'xxx', 'xxxxx', 2, '0000-00-00 00:00:00'),
(13, 'asdasd', 'asasadsa', 2, '0000-00-00 00:00:00'),
(14, '', '', 2, '0000-00-00 00:00:00'),
(15, '', '', 2, '0000-00-00 00:00:00'),
(16, '', 'ssssssssssssssss', 2, '0000-00-00 00:00:00'),
(17, '', 'ssssssssssssssss', 2, '2021-11-14 21:58:57'),
(18, '', 'ez a tartalom', 2, '2021-11-14 21:59:04'),
(19, '', 'lecsp', 2, '2021-11-14 22:01:52'),
(20, '', 'lecsp', 2, '2021-11-14 22:03:33'),
(21, '', 'lecso2', 2, '2021-11-14 22:03:39'),
(22, '', 'lecso2', 2, '2021-11-14 22:10:54'),
(23, '', 'lecso2', 2, '2021-11-14 22:12:43'),
(24, '', '', 2, '2021-11-14 22:12:53');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `url` varchar(30) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `szulo` varchar(30) NOT NULL,
  `jogosultsag` varchar(3) NOT NULL,
  `sorrend` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`url`, `nev`, `szulo`, `jogosultsag`, `sorrend`) VALUES
('admin', 'Admin', '', '001', 80),
('belepes', 'Belépés', '', '100', 60),
('hirek', 'Hírek', '', '011', 20),
('kilepes', 'Kilépés', '', '011', 70),
('mnblekerdez', 'Árfolyam kijelzés', '', '111', 30),
('nyitolap', 'Nyitólap', '', '111', 10),
('regisztracio', 'Regisztráció', '', '100', 40),
('soap', 'SOAP', '', '011', 50);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hirek`
--
ALTER TABLE `hirek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`url`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `hirek`
--
ALTER TABLE `hirek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
