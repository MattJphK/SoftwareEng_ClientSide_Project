CREATE DATABASE  IF NOT EXISTS `thedirectorsdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `thedirectorsdb`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: thedirectorsdb
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `bookingid` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `seating` varchar(5) DEFAULT NULL,
  `cardName` varchar(45) DEFAULT NULL,
  `cardNo` varchar(25) DEFAULT NULL,
  `eirCode` varchar(10) DEFAULT NULL,
  `cvc` int DEFAULT NULL,
  `movieid` int DEFAULT NULL,
  `userid` int DEFAULT NULL,
  PRIMARY KEY (`bookingid`),
  KEY `movieid` (`movieid`),
  KEY `userid` (`userid`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieid`) ON DELETE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (4,'2025-04-23','A1','Matt','222 2222 2222 222','D11 223',333,1,2),(5,'2025-04-24','B2','','1111 1111 111 1111','D13 4567',222,1,2),(6,'2025-04-24','B2','John','1111 1111 1111 111','D15 789',222,1,2),(7,'2025-04-24','A1','Matthew','1111 1111 111 1111','D11 223',111,1,2),(8,'2025-04-24','A1','Matthew','1111 1111 1111 111','D15 C878',222,3,2),(9,'2025-04-27','A1','Matthew','1111 1111 111 1111','DX XXXX',111,1,2),(10,'2025-04-27','B2','John','2222 2222 222 2222','D23 Cx54',678,1,2),(11,'2025-04-27','B2','Matthew','8888 8888 888 8888','D15 C3X4',846,3,2),(12,'2025-05-03','B1','Matthew JP','4444 444 4444 4441','D1 111',333,2,2);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `movieid` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `genre` varchar(45) DEFAULT NULL,
  `ticket_price` int DEFAULT NULL,
  PRIMARY KEY (`movieid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'Citizen Kane','Drama',19),(2,'Casablanca','Romance',12),(3,'The Godfather','Crime',15),(4,'Gone with the Wind','Epic',12),(5,'Lawrence of Arabia','Adventure',14),(6,'The Wizard of Oz','Fantasy',10),(7,'Psycho','Thriller',12),(8,'12 Angry Men','Drama',12),(9,'Sunset Boulevard','Drama',12),(10,'Schindler\'s List','Biography',15),(11,'Dune: Part Two','Sci-Fi',18),(12,'The Substance','Drama',16),(13,'Anora','Drama',14),(14,'Furiosa: A Mad Max Saga','Action',20),(15,'Challengers','Drama',15),(16,'The Wild Robot','Animation',12),(17,'A Real Pain','Drama',14),(18,'Sing Sing','Drama',13),(19,'Conclave','Drama',15),(20,'Nickel Boys','Drama',14);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `reviewid` int NOT NULL AUTO_INCREMENT,
  `review_text` varchar(200) DEFAULT NULL,
  `moviescore` int DEFAULT NULL,
  `movieid` int DEFAULT NULL,
  `userid` int DEFAULT NULL,
  PRIMARY KEY (`reviewid`),
  KEY `movieid` (`movieid`),
  KEY `userid` (`userid`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieid`) ON DELETE CASCADE,
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (6,'never watched',10,1,NULL),(7,'great',8,1,2);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `userscore` int DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'JohnDoe','johndoe@email.com','password123',21,100,0),(2,'Matthew','matthewkeenan2008@gmail.com','123',90,NULL,0),(4,'Robert','robkeenan1967@gmail.com','123',58,NULL,0),(5,'Liam','Liam@gmail.com','123',23,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-03 20:31:30
