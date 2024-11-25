-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sre
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrateur` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateur`
--

LOCK TABLES `administrateur` WRITE;
/*!40000 ALTER TABLE `administrateur` DISABLE KEYS */;
INSERT INTO `administrateur` VALUES ('felana','2905');
/*!40000 ALTER TABLE `administrateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caisse` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse`
--

LOCK TABLES `caisse` WRITE;
/*!40000 ALTER TABLE `caisse` DISABLE KEYS */;
INSERT INTO `caisse` VALUES ('006','SRE');
/*!40000 ALTER TABLE `caisse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contribuable`
--

DROP TABLE IF EXISTS `contribuable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contribuable` (
  `nif` int(30) NOT NULL,
  `raison` char(250) DEFAULT NULL,
  `adrs` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contribuable`
--

LOCK TABLES `contribuable` WRITE;
/*!40000 ALTER TABLE `contribuable` DISABLE KEYS */;
INSERT INTO `contribuable` VALUES (11223344,'kolo','tambohobe'),(44332211,'charlys','andrainjato'),(123456789,'noums','beravina'),(987654321,'fefe','ambalavato');
/*!40000 ALTER TABLE `contribuable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paiement` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `nif` int(30) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `mode` char(20) DEFAULT NULL,
  `montant` int(30) DEFAULT NULL,
  `datepaie` date DEFAULT NULL,
  PRIMARY KEY (`ref`),
  KEY `nif` (`nif`),
  KEY `code` (`code`),
  CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`nif`) REFERENCES `contribuable` (`nif`),
  CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paiement`
--

LOCK TABLES `paiement` WRITE;
/*!40000 ALTER TABLE `paiement` DISABLE KEYS */;
INSERT INTO `paiement` VALUES (21,11223344,'006','Espèce',200,'2024-03-25'),(25,11223344,'006','Espèce',2000,'2024-03-25'),(26,11223344,'006','Chèque',298000,'2024-03-25'),(27,11223344,'006','Espèce',3009993,'2024-03-25'),(28,11223344,'006','Espèce',3009993,'2024-03-25'),(29,11223344,'006','Espèce',289,'2024-03-29'),(30,11223344,'006','',111,'2024-04-01'),(37,11223344,'006','Espèce',200000,'2024-04-01');
/*!40000 ALTER TABLE `paiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recevoir`
--

DROP TABLE IF EXISTS `recevoir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recevoir` (
  `recep` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `ref` varchar(20) DEFAULT NULL,
  `dateregle` date DEFAULT NULL,
  PRIMARY KEY (`recep`),
  KEY `code` (`code`),
  KEY `ref` (`ref`),
  CONSTRAINT `recevoir_ibfk_1` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`),
  CONSTRAINT `recevoir_ibfk_2` FOREIGN KEY (`ref`) REFERENCES `virement` (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recevoir`
--

LOCK TABLES `recevoir` WRITE;
/*!40000 ALTER TABLE `recevoir` DISABLE KEYS */;
INSERT INTO `recevoir` VALUES (1,'006','12344','2023-08-13');
/*!40000 ALTER TABLE `recevoir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfert`
--

DROP TABLE IF EXISTS `transfert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfert` (
  `idtrans` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `codeser` varchar(10) NOT NULL,
  `typ` varchar(20) NOT NULL,
  `datedeb` date NOT NULL,
  `datefin` date DEFAULT NULL,
  `som` int(11) NOT NULL,
  PRIMARY KEY (`idtrans`),
  KEY `code` (`code`),
  KEY `codeser` (`codeser`),
  CONSTRAINT `transfert_ibfk_1` FOREIGN KEY (`code`) REFERENCES `caisse` (`code`),
  CONSTRAINT `transfert_ibfk_2` FOREIGN KEY (`codeser`) REFERENCES `tresorerie` (`codeser`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfert`
--

LOCK TABLES `transfert` WRITE;
/*!40000 ALTER TABLE `transfert` DISABLE KEYS */;
INSERT INTO `transfert` VALUES (3,'006','010','num','2024-01-04','2024-02-04',210000),(4,'006','010','vir','2024-01-04','2024-02-04',210000),(5,'006','010','che','2024-01-04','2024-02-04',210000),(6,'006','010','Espèce','2024-01-03','2024-04-29',6222475),(7,'006','010','Espèce','2024-01-01','2024-04-04',6222475),(8,'006','010','Chèque','2024-01-01','2024-04-04',298000),(9,'006','010','Espèce','2024-01-02','2024-04-29',6222475),(10,'006','010','Espèce','2022-02-28','2024-04-29',6222475),(11,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(12,'006','010','Virement','2024-01-01','2024-04-29',0),(13,'006','010','Virement','2024-01-01','2024-04-29',0),(14,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(15,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(16,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(17,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(18,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(19,'006','010','Espèce','2023-03-28','2025-04-28',6222475),(20,'006','010','Espèce','2023-03-28','2024-04-28',6222475),(21,'006','010','Espèce','2024-02-05','2024-04-29',6222475),(22,'006','010','Espèce','2024-02-05','2024-04-10',6222475),(23,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(24,'006','010','Chèque','2024-01-01','2024-04-29',298000),(25,'006','010','Espèce','2024-01-01','2024-04-29',6222475),(26,'006','010','Chèque','2024-01-29','2024-04-29',298000),(27,'006','010','Virement','2024-01-29','2024-04-29',0);
/*!40000 ALTER TABLE `transfert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tresorerie`
--

DROP TABLE IF EXISTS `tresorerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tresorerie` (
  `codeser` varchar(10) NOT NULL,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`codeser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tresorerie`
--

LOCK TABLES `tresorerie` WRITE;
/*!40000 ALTER TABLE `tresorerie` DISABLE KEYS */;
INSERT INTO `tresorerie` VALUES ('010','SRE');
/*!40000 ALTER TABLE `tresorerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virement`
--

DROP TABLE IF EXISTS `virement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `virement` (
  `ref` varchar(20) NOT NULL,
  `nif` int(30) NOT NULL,
  `sociale` varchar(200) DEFAULT NULL,
  `banky` varchar(5) DEFAULT NULL,
  `vola` int(20) DEFAULT NULL,
  `datevaleur` date NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virement`
--

LOCK TABLES `virement` WRITE;
/*!40000 ALTER TABLE `virement` DISABLE KEYS */;
INSERT INTO `virement` VALUES ('12344',123456789,'noums','BNI',2334,'2023-08-11');
/*!40000 ALTER TABLE `virement` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-29  3:43:14
