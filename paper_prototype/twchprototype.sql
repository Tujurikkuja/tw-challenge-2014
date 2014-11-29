-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Loomise aeg: Nov 29, 2014 kell 03:21 PL
-- Serveri versioon: 5.6.21
-- PHP versioon: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Andmebaas: `twchprototype`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `PersonID` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `iban` varchar(40) COLLATE utf8_estonian_ci DEFAULT NULL,
  `phonenr` varchar(40) COLLATE utf8_estonian_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Andmete tõmmistamine tabelile `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Order set up'),
(2, 'Money received'),
(3, 'Recipient notified'),
(4, 'Recipient accepted'),
(5, 'Currency converted'),
(6, 'Payment sent out');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(11) NOT NULL,
  `senderid` int(11) DEFAULT NULL,
  `receiverid` int(11) DEFAULT NULL,
  `amount_sent` double DEFAULT NULL,
  `currency_sent` varchar(3) COLLATE utf8_estonian_ci DEFAULT NULL,
  `country_sent` varchar(30) COLLATE utf8_estonian_ci DEFAULT NULL,
  `amount_received` double DEFAULT NULL,
  `currency_received` varchar(3) COLLATE utf8_estonian_ci DEFAULT NULL,
  `country_received` varchar(30) COLLATE utf8_estonian_ci DEFAULT NULL,
  `statusid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`PersonID`);

--
-- Indeksid tabelile `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indeksid tabelile `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`transaction_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
