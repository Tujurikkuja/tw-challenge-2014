-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2014 at 06:38 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `twchprototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
`personID` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_estonian_ci DEFAULT NULL,
  `iban` varchar(40) COLLATE utf8_estonian_ci DEFAULT NULL,
  `phonenr` varchar(40) COLLATE utf8_estonian_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personID`, `firstname`, `lastname`, `iban`, `phonenr`, `email`) VALUES
(1, 'ASJA', NULL, 'BANKACCOUNT1234', '', 'PULK'),
(2, 'Kaali Kaalikas', NULL, 'ee123', '2345678', '');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) COLLATE utf8_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Order set up'),
(2, 'Money received'),
(3, 'Recipient notified'),
(4, 'Recipient accepted'),
(5, 'Currency converted'),
(6, 'Payment sent out'),
(7, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `senderid`, `receiverid`, `amount_sent`, `currency_sent`, `country_sent`, `amount_received`, `currency_received`, `country_received`, `statusid`) VALUES
(1, 1, 2, 1234, 'EUR', 'EE', 5678, 'EUR', 'LV', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`personID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `personID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
