-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: itthink
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `categories`
--



DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'test'),(2,'food'),(3,'pass'),(4,'music'),(5,'RANDOM');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelance`
--

DROP TABLE IF EXISTS `freelance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelance` (
  `id_freelance` int NOT NULL AUTO_INCREMENT,
  `nom_freelance` varchar(50) DEFAULT NULL,
  `competence` varchar(200) DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_freelance`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `freelance_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelance`
--

LOCK TABLES `freelance` WRITE;
/*!40000 ALTER TABLE `freelance` DISABLE KEYS */;
INSERT INTO `freelance` VALUES (1,'mdx','HTML CSS JS',1),(2,'help','C++ Js Css Html',2),(3,'test','Html CSS JS PHP',3),(4,'hacker','Error cant display',4),(5,'new','HTML JS CSS',5);
/*!40000 ALTER TABLE `freelance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offre`
--

DROP TABLE IF EXISTS `offre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offre` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `montant` int DEFAULT NULL,
  `delai` date DEFAULT NULL,
  `id_freelance` int DEFAULT NULL,
  `id_projet` int DEFAULT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `id_freelance` (`id_freelance`),
  KEY `id_projet` (`id_projet`),
  CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`id_freelance`) REFERENCES `freelance` (`id_freelance`),
  CONSTRAINT `offre_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offre`
--

LOCK TABLES `offre` WRITE;
/*!40000 ALTER TABLE `offre` DISABLE KEYS */;
INSERT INTO `offre` VALUES (1,100,'2024-12-11',1,1),(2,200,'2024-12-12',2,2),(3,300,'2024-12-13',3,3),(4,400,'2024-12-14',4,4),(5,500,'2024-12-15',5,5);
/*!40000 ALTER TABLE `offre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projet`
--

DROP TABLE IF EXISTS `projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projet` (
  `id_projet` int NOT NULL AUTO_INCREMENT,
  `titre_projet` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  `id_sous_categorie` int DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_projet`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_sous_categorie` (`id_sous_categorie`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`),
  CONSTRAINT `projet_ibfk_2` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id_Sous_categorie`),
  CONSTRAINT `projet_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projet`
--

LOCK TABLES `projet` WRITE;
/*!40000 ALTER TABLE `projet` DISABLE KEYS */;
INSERT INTO `projet` VALUES (1,'projet 1','random words: zefkgvFUGEFOUvoeufvozevfouEV',1,1,1,'2024-12-11 16:04:52'),(2,'projet 2','random words: zefkgvFUGEFOUvoeufvozevfouEV',2,2,2,'2024-12-11 16:04:52'),(3,'projet 3','random words: zefkgvFUGEFOUvoeufvozevfouEV',3,3,3,'2024-12-11 16:04:52'),(4,'projet 4','random words: zefkgvFUGEFOUvoeufvozevfouEV',4,4,4,'2024-12-11 16:04:52'),(5,'projet 5','random words: zefkgvFUGEFOUvoeufvozevfouEV',5,5,5,'2024-12-11 16:04:52');
/*!40000 ALTER TABLE `projet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sous_categories` (
  `id_Sous_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_Sous_categorie` varchar(50) DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  PRIMARY KEY (`id_Sous_categorie`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `sous_categories_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_categories`
--

LOCK TABLES `sous_categories` WRITE;
/*!40000 ALTER TABLE `sous_categories` DISABLE KEYS */;
INSERT INTO `sous_categories` VALUES (1,'sub_test',1),(2,'apple',2),(3,'free',3),(4,'guitar',4),(5,'something',5);
/*!40000 ALTER TABLE `sous_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temoignages`
--

DROP TABLE IF EXISTS `temoignages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temoignages` (
  `id_temoignages` int NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(200) DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_temoignages`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `temoignages_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temoignages`
--

LOCK TABLES `temoignages` WRITE;
/*!40000 ALTER TABLE `temoignages` DISABLE KEYS */;
INSERT INTO `temoignages` VALUES (1,'the best',1),(2,'good',2),(3,'not bad',3),(4,'bad',4),(5,'the worst',5);
/*!40000 ALTER TABLE `temoignages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_pass` varchar(64) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'younes','password','test@gmail.com'),(2,'mohamed','mot de pass','secret@gmail.com'),(3,'ayoub','pass','testing@gmail.com'),(4,'karim','admin123','fake@gmail.com'),(5,'omar','word','123@gmail.com');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11 17:12:01
