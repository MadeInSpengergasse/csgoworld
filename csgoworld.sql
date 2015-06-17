-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Jun 2015 um 15:08
-- Server Version: 5.6.24-0ubuntu2
-- PHP-Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `csgoworld`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL,
  `item_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon_url` varchar(2083) NOT NULL,
  `item_exterior` text NOT NULL,
  `item_rarity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trades`
--

CREATE TABLE IF NOT EXISTS `trades` (
  `trade_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `last_bump` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trades_have`
--

CREATE TABLE IF NOT EXISTS `trades_have` (
`t_i_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `trade_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trades_want`
--

CREATE TABLE IF NOT EXISTS `trades_want` (
`t_i_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `trade_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `steam_id` bigint(20) NOT NULL,
  `user_name` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `steam_trade_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
 ADD UNIQUE KEY `item_id` (`item_id`);

--
-- Indizes für die Tabelle `trades`
--
ALTER TABLE `trades`
 ADD UNIQUE KEY `trade_id` (`trade_id`);

--
-- Indizes für die Tabelle `trades_have`
--
ALTER TABLE `trades_have`
 ADD PRIMARY KEY (`t_i_id`), ADD UNIQUE KEY `t_i_id` (`t_i_id`);

--
-- Indizes für die Tabelle `trades_want`
--
ALTER TABLE `trades_want`
 ADD PRIMARY KEY (`t_i_id`), ADD UNIQUE KEY `t_i_id` (`t_i_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
 ADD UNIQUE KEY `steam_id` (`steam_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `trades_have`
--
ALTER TABLE `trades_have`
MODIFY `t_i_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT für Tabelle `trades_want`
--
ALTER TABLE `trades_want`
MODIFY `t_i_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
