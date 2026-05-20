-- MySQL dump 10.13  Distrib 8.4.7, for Win64 (x86_64)
--
-- Host: localhost    Database: ma_banque
-- ------------------------------------------------------
-- Server version	8.4.7

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id_client`, `nom`, `email`) VALUES (1,'Aldo','aldo@example.com'),(2,'Jess','jess@example.com'),(3,'Cathy','cathy@example.com'),(4,'John','john@example.com'),(5,'Zack','zack@example.com'),(6,'Carl','carl@example.com'),(7,'Solveig','solveig@example.com');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commercial`
--

DROP TABLE IF EXISTS `commercial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commercial` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commercial`
--

LOCK TABLES `commercial` WRITE;
/*!40000 ALTER TABLE `commercial` DISABLE KEYS */;
INSERT INTO `commercial` (`id_com`, `nom`, `prenom`, `email`, `tel`) VALUES (1,'DURAND','Allister','adurand@bank.cash','0578790002'),(2,'NAMARA','Finan','fnamara@bank.cash','0578790018'),(3,'ARTLEY','Katheleen','kartley@bank.cash','0578790009'),(4,'AVOY','Maurine','mavoy@bank.cash','0578790016');
/*!40000 ALTER TABLE `commercial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mouvement` (
  `id_mvt` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `montant` int DEFAULT NULL,
  `date_mvt` date DEFAULT NULL,
  PRIMARY KEY (`id_mvt`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `mouvement_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mouvement`
--

LOCK TABLES `mouvement` WRITE;
/*!40000 ALTER TABLE `mouvement` DISABLE KEYS */;
INSERT INTO `mouvement` (`id_mvt`, `id_client`, `montant`, `date_mvt`) VALUES (1,1,1000,'2025-12-01'),(2,2,2500,'2025-12-01'),(3,3,4000,'2025-12-02'),(4,4,200,'2025-12-02'),(5,5,600,'2025-12-02'),(6,6,450,'2025-12-03'),(7,7,1300,'2025-12-05'),(8,3,-500,'2025-12-06'),(9,4,500,'2025-12-06'),(10,3,-250,'2025-12-08'),(11,6,250,'2025-12-08'),(12,5,-700,'2025-12-08');
/*!40000 ALTER TABLE `mouvement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif_mensuel` decimal(6,2) DEFAULT NULL,
  `nb_mois` int DEFAULT NULL,
  `tacite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` (`id_produit`, `libelle`, `tarif_mensuel`, `nb_mois`, `tacite`) VALUES (1,'AssurAuto',149.50,12,1),(2,'AssurVelo Kas&Vol',80.00,12,1),(3,'MoloConso 5200 EUR',99.90,60,0),(4,'MegaConso 13 KEUR',295.00,48,0);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposition`
--

DROP TABLE IF EXISTS `proposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposition` (
  `id_prop` int NOT NULL AUTO_INCREMENT,
  `id_prod` int DEFAULT NULL,
  `id_rdv` int DEFAULT NULL,
  `resultat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_prop`),
  KEY `id_rdv` (`id_rdv`),
  KEY `id_prod` (`id_prod`),
  CONSTRAINT `proposition_ibfk_1` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id_rdv`),
  CONSTRAINT `proposition_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposition`
--

LOCK TABLES `proposition` WRITE;
/*!40000 ALTER TABLE `proposition` DISABLE KEYS */;
INSERT INTO `proposition` (`id_prop`, `id_prod`, `id_rdv`, `resultat`) VALUES (1,1,2,1),(2,1,8,0),(3,2,8,0),(4,3,8,0),(5,1,1,1),(6,2,1,0),(7,4,3,1),(8,2,4,1),(9,1,4,0),(10,3,5,1),(11,2,6,1),(12,1,6,1),(13,3,6,1),(14,1,7,1),(15,2,7,0),(16,3,7,0),(17,4,7,1),(18,1,9,0),(19,3,9,0),(20,2,10,1),(21,4,10,0);
/*!40000 ALTER TABLE `proposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rdv` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `id_commercial` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `horaire_rdv` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `id_commercial` (`id_commercial`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`id_commercial`) REFERENCES `commercial` (`id_com`),
  CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rdv`
--

LOCK TABLES `rdv` WRITE;
/*!40000 ALTER TABLE `rdv` DISABLE KEYS */;
INSERT INTO `rdv` (`id_rdv`, `id_commercial`, `id_client`, `horaire_rdv`) VALUES (1,2,1,'2025-01-02 09:15:00'),(2,4,2,'2025-01-03 11:45:00'),(3,1,3,'2025-01-05 10:00:00'),(4,2,7,'2025-01-05 12:15:00'),(5,3,4,'2025-01-05 15:30:00'),(6,3,5,'2025-01-10 09:45:00'),(7,2,3,'2025-01-12 10:30:00'),(8,4,6,'2025-01-20 09:45:00'),(9,4,3,'2025-01-21 14:45:00'),(10,1,2,'2025-01-21 15:30:00');
/*!40000 ALTER TABLE `rdv` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-10 14:15:14
