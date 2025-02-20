-- MySQL dump 10.13  Distrib 8.1.0, for Linux (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `id_account` int NOT NULL AUTO_INCREMENT,
  `indirizzo_mail` varchar(50) NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipologia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_utente` varchar(50) NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (19,'jerekora@gmail.com','$2y$10$k7JWrYXIZg6vWUlXJyHa/.gl3m/59kF9ri4C00bcsR2nol1En2RFy','ricercatore','kora'),(20,'virgo@gmail.com','$2y$10$Pq94rS6sST.3NA6lnuK0wu/K7Nr1zjClJpr4NcwGKr2QYAUtAyHUC','ricercatore','Virginie korangi'),(21,'ergo@gmail.com','$2y$10$lhQgeUumWVqlDP8wGF7Rt.xXLAtv.gsQUD0jbeJCkTAWNiI91H.Na','Altri_enti','Er Go');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventi`
--

DROP TABLE IF EXISTS `eventi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventi` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `data_svolgimento` text NOT NULL,
  `luogo_svolgimento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `autore` varchar(50) NOT NULL,
  `data_creazione` date DEFAULT NULL,
  `immagine` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` text,
  `hashtag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventi`
--

LOCK TABLES `eventi` WRITE;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;
INSERT INTO `eventi` VALUES (13,'Università di parma','<p>Oggi vi presentiamo una delle migliore universit&agrave; del mondo, l\'universit&agrave; di parma, che offre molti corsi di laurea<br><br>@Unipr</p>','14-02-25 12:00','Parma - ','20','2025-02-08','Screenshot 2024-10-28 184302.png',NULL,'educazione'),(16,'GPS','<p>Oggi facciamo una piccola presentazione di funzionamento del gps che molte persone conoscono.<br><br>By @jeremie_korangi</p>','21-02-25 12:00','Kinshasa - CONGO','20','2025-02-08','Screenshot 2024-11-12 161255.png',NULL,'religione'),(18,'Noah','<p>Buongiorno<br><br>Volevo chiedere quando potevamo organizzare un inconto sul tema delle nascite per promuovere l\'integrit&agrave; delle bambine nel sistema scolasctio</p>','21-02-25 12:00','Gembloux -Belgique','20','2025-02-13','default.jpg',NULL,'Nascita'),(20,'Web-app','<p>Benvenuto in questa edizione di presentazione del mondo magico dello sviluppo web in cui parleremo delle sfide di questo settore nello sviluppo di nuove tecnologie sostenibili<br><br>Autore :<strong> J&eacute;r&eacute;mie Korangi</strong><br><br></p>','14-02-25 12:00','Namur - Belgique','19','2025-02-14','Screenshot 2024-11-18 160655.png',NULL,'Informatica');
/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iscrizione`
--

DROP TABLE IF EXISTS `iscrizione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iscrizione` (
  `id_iscrizione` int NOT NULL AUTO_INCREMENT,
  `data_iscrizione` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `account` varchar(255) NOT NULL,
  `evento` int NOT NULL,
  PRIMARY KEY (`id_iscrizione`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iscrizione`
--

LOCK TABLES `iscrizione` WRITE;
/*!40000 ALTER TABLE `iscrizione` DISABLE KEYS */;
INSERT INTO `iscrizione` VALUES (8,'2025-02-12',1,'jey@gmail.com',14),(9,'2025-02-12',1,'jey@gmail.com',14),(14,'2025-02-14',1,'19',18),(15,'2025-02-14',1,'19',20);
/*!40000 ALTER TABLE `iscrizione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifica` (
  `id_notifica` int NOT NULL AUTO_INCREMENT,
  `descrizione` text NOT NULL,
  `data_creazione` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `utente` int NOT NULL,
  `evento` int NOT NULL,
  PRIMARY KEY (`id_notifica`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifica` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-20 10:12:23
