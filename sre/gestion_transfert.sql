-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2023 at 11:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_transfert`
--

-- --------------------------------------------------------

--
-- Table structure for table `caisse`
--

CREATE TABLE `caisse` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caisse`
--

INSERT INTO `caisse` (`code`, `nom`) VALUES
('006', 'SRE');

-- --------------------------------------------------------

--
-- Table structure for table `contribuable`
--

CREATE TABLE `contribuable` (
  `nif` int(30) NOT NULL,
  `raison` char(250) DEFAULT NULL,
  `adrs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contribuable`
--

INSERT INTO `contribuable` (`nif`, `raison`, `adrs`) VALUES
(11223344, 'kolo', 'tambohobe'),
(44332211, 'charlys', 'andrainjato'),
(123456789, 'noums', 'beravina'),
(987654321, 'fefe', 'ambalavato');

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

CREATE TABLE `paiement` (
  `ref` int(11) NOT NULL,
  `nif` int(30) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `mode` char(20) DEFAULT NULL,
  `montant` int(30) DEFAULT NULL,
  `datepaie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`ref`, `nif`, `code`, `mode`, `montant`, `datepaie`) VALUES
(1, 11223344, '006', 'Chèque', 22000, '2023-08-12'),
(2, 11223344, '006', 'Espèce', 442000, '2023-08-12'),
(3, 987654321, '006', 'Espèce', 76000, '2023-08-12'),
(4, 987654321, '006', 'Chèque', 960000, '2023-08-12'),
(5, 11223344, '006', 'Chèque', 1200000, '2023-08-12'),
(6, 44332211, '006', 'Chèque', 450000, '2023-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `recevoir`
--

CREATE TABLE `recevoir` (
  `recep` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `ref` varchar(20) DEFAULT NULL,
  `dateregle` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recevoir`
--

INSERT INTO `recevoir` (`recep`, `code`, `ref`, `dateregle`) VALUES
(1, '006', '12344', '2023-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `transfert`
--

CREATE TABLE `transfert` (
  `idtrans` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `codeser` varchar(10) NOT NULL,
  `datedeb` date NOT NULL,
  `datefin` date NOT NULL,
  `datetrans` date NOT NULL,
  `som` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfert`
--

INSERT INTO `transfert` (`idtrans`, `code`, `codeser`, `datedeb`, `datefin`, `datetrans`, `som`) VALUES
(1, '006', '010', '2023-08-04', '2023-08-05', '2023-08-05', 0),
(3, '006', '010', '2023-08-05', '2023-08-17', '2023-08-17', 3152334),
(4, '006', '010', '2023-08-05', '2023-08-17', '2023-08-17', 3152334),
(5, '006', '34121', '2023-08-05', '2023-08-17', '2023-08-17', 3152334);

-- --------------------------------------------------------

--
-- Table structure for table `tresorerie`
--

CREATE TABLE `tresorerie` (
  `codeser` varchar(10) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `lib` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tresorerie`
--

INSERT INTO `tresorerie` (`codeser`, `nom`, `lib`) VALUES
('010', 'Tresorerie General de FIANARANTSOA', 'TGFTS'),
('10123', 'Tresorerie General d\'ANTANANARIVO\r\n', 'TGTN'),
('21021', 'Tresorerie General de TOLIARA', 'TGTL'),
('31134', 'BANQUE CENTRALE FIANARANTSOA', 'BCF'),
('34121', 'Tresorerie General d\'AMBOSITRA\r\n', 'TGAMB');

-- --------------------------------------------------------

--
-- Table structure for table `virement`
--

CREATE TABLE `virement` (
  `ref` varchar(20) NOT NULL,
  `nif` int(30) NOT NULL,
  `sociale` varchar(200) DEFAULT NULL,
  `banky` varchar(5) DEFAULT NULL,
  `vola` int(20) DEFAULT NULL,
  `datevaleur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `virement`
--

INSERT INTO `virement` (`ref`, `nif`, `sociale`, `banky`, `vola`, `datevaleur`) VALUES
('12344', 123456789, 'noums', 'BNI', 2334, '2023-08-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caisse`
--
ALTER TABLE `caisse`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `contribuable`
--
ALTER TABLE `contribuable`
  ADD PRIMARY KEY (`nif`);

--
-- Indexes for table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `nif` (`nif`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `recevoir`
--
ALTER TABLE `recevoir`
  ADD PRIMARY KEY (`recep`),
  ADD KEY `code` (`code`),
  ADD KEY `ref` (`ref`);

--
-- Indexes for table `transfert`
--
ALTER TABLE `transfert`
  ADD PRIMARY KEY (`idtrans`),
  ADD KEY `code` (`code`),
  ADD KEY `codeser` (`codeser`);

--
-- Indexes for table `tresorerie`
--
ALTER TABLE `tresorerie`
  ADD PRIMARY KEY (`codeser`);

--
-- Indexes for table `virement`
--
ALTER TABLE `virement`
  ADD PRIMARY KEY (`ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recevoir`
--
ALTER TABLE `recevoir`
  MODIFY `recep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfert`
--
ALTER TABLE `transfert`
  MODIFY `idtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`nif`) REFERENCES `contribuable` (`nif`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`);

--
-- Constraints for table `recevoir`
--
ALTER TABLE `recevoir`
  ADD CONSTRAINT `recevoir_ibfk_1` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`),
  ADD CONSTRAINT `recevoir_ibfk_2` FOREIGN KEY (`ref`) REFERENCES `virement` (`ref`);

--
-- Constraints for table `transfert`
--
ALTER TABLE `transfert`
  ADD CONSTRAINT `transfert_ibfk_1` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`),
  ADD CONSTRAINT `transfert_ibfk_2` FOREIGN KEY (`codeser`) REFERENCES `tresorerie` (`codeser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
