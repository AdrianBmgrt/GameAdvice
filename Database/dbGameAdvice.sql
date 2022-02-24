-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: GameAdvice
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.32-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categorie`
--

DROP TABLE IF EXISTS `Categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorie`
--

LOCK TABLES `Categorie` WRITE;
/*!40000 ALTER TABLE `Categorie` DISABLE KEYS */;
INSERT INTO `Categorie` VALUES (1,'FPS'),(2,'RPG'),(3,'MMORPG'),(4,'MOBA'),(5,'Battle Royal'),(6,'Aventure'),(7,'Survival Horror');
/*!40000 ALTER TABLE `Categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Games`
--

DROP TABLE IF EXISTS `Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Games` (
  `idGame` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text DEFAULT NULL,
  `dateDeSortie` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  PRIMARY KEY (`idGame`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Games`
--

LOCK TABLES `Games` WRITE;
/*!40000 ALTER TABLE `Games` DISABLE KEYS */;
INSERT INTO `Games` VALUES (1,'Halo Infinite','2021-07-31 22:00:00','Halo Infinite est un FPS développé par 343 Industries. L\'épisode fait la suite directe de Halo 5. ',49,'haloInfinite.jpg'),(2,'Légendes Pokémon : Arceus','2024-03-31 22:00:00','Légendes Pokémon : Arceus est un jeu vidéo de rôle de la série Pokémon développé par Game Freak et édité par The Pokémon Company et Nintendo.',44,'PokemonLegendsArceus.jpg'),(3,'League of Legends','2011-03-09 23:00:00','League of Legends est un jeu vidéo sorti en 2009 de type arène de bataille en ligne, free-to-play,',0,'LeagueOfLegends.jpg'),(4,'Apex Legends','2019-04-01 22:00:00','Apex Legends est un jeu vidéo de type battle royale développé par Respawn Entertainment et édité par Electronic Arts.',0,'apex.jpg'),(5,'Tales of Arise','2021-09-08 22:00:00','ales of Arise est un jeu vidéo d\'action-RPG développé et édité par Bandai Namco Entertainment.',72,'TaleOfArise.jpg'),(6,'Eve Online','2003-06-04 22:00:00','Eve Online est un jeu en ligne massivement multijoueur persistant se déroulant dans l\'espace, développé par la société islandaise CCP',0,'eveOnline.jpg'),(7,'The Evil Within 2','2018-01-08 23:00:00','The Evil Within 2 est un jeu vidéo de tir à la troisième personne de type survival horror développé par Tango Gameworks ',50,'theEvilWithing.jpg');
/*!40000 ALTER TABLE `Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LiaisonGameCategorie`
--

DROP TABLE IF EXISTS `LiaisonGameCategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LiaisonGameCategorie` (
  `idGame` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  KEY `LiaisonGameCategorie_FK` (`idCategorie`),
  KEY `LiaisonGameCategorie_FK_1` (`idGame`),
  CONSTRAINT `LiaisonGameCategorie_FK` FOREIGN KEY (`idCategorie`) REFERENCES `Categorie` (`idCategorie`),
  CONSTRAINT `LiaisonGameCategorie_FK_1` FOREIGN KEY (`idGame`) REFERENCES `Games` (`idGame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LiaisonGameCategorie`
--

LOCK TABLES `LiaisonGameCategorie` WRITE;
/*!40000 ALTER TABLE `LiaisonGameCategorie` DISABLE KEYS */;
INSERT INTO `LiaisonGameCategorie` VALUES (1,1),(2,6),(3,4),(4,5),(5,2),(6,3),(7,7);
/*!40000 ALTER TABLE `LiaisonGameCategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Posts` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idGame` int(11) NOT NULL,
  `messsage` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `image` text DEFAULT NULL,
  PRIMARY KEY (`idPost`),
  KEY `Posts_FK` (`idUser`),
  KEY `Posts_FK_1` (`idGame`),
  CONSTRAINT `Posts_FK` FOREIGN KEY (`idUser`) REFERENCES `Users` (`idUser`),
  CONSTRAINT `Posts_FK_1` FOREIGN KEY (`idGame`) REFERENCES `Games` (`idGame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Replies`
--

DROP TABLE IF EXISTS `Replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Replies` (
  `idReplie` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idReplie`),
  KEY `Replies_FK` (`idUser`),
  KEY `Replies_FK_1` (`idPost`),
  CONSTRAINT `Replies_FK` FOREIGN KEY (`idUser`) REFERENCES `Users` (`idUser`),
  CONSTRAINT `Replies_FK_1` FOREIGN KEY (`idPost`) REFERENCES `Posts` (`idPost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Replies`
--

LOCK TABLES `Replies` WRITE;
/*!40000 ALTER TABLE `Replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `Replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `mdp` text DEFAULT NULL,
  `photoProfil` text DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'GameAdvice'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-24  8:34:19
