-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bluebirds
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `emp_number` int(4) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `job_title` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,11,'Ola','AlSaif','Recruiter','$2y$12$MrSw5HDKnyBhTmevvAPx.Ob.tI6JBFi32TI5XpZqFjZAkF3bAEYem'),(2,17,'Majed','AlGhamdi','Supervisor','$2y$12$MrSw5HDKnyBhTmevvAPx.Ob.tI6JBFi32TI5XpZqFjZAkF3bAEYem'),(3,20,'Layan','AlZabn','Developer','$2y$12$MrSw5HDKnyBhTmevvAPx.Ob.tI6JBFi32TI5XpZqFjZAkF3bAEYem'),(7,15,'Sarah','Ahmad','Recruiter','$2y$12$7T9sdGB8kQ.nHrNFupuw2e89pm80K6EgHnrR9Z2BfKyhAroC7hi9q'),(8,22,'Sami','AlQahtani','Supervisor','$2y$12$AueGl7Vmj9/K0sUD5t4X6ejRLGvC7qe4qRNeIasYmSwe6QzbOjTfC'),(10,42,'Shikhah','binAteeq','Teacher','$2y$12$Mu1zgJiHi.vd27e/ZSRu3O6nGZyDSZyZ3zAPQTkGvyRHHe/cBJXMW'),(11,83,'Rahaf','AlZahrani','Supervisor','$2y$12$IPFmcHwd8DwuPwrBlxzr7eR6zL/lX/bJ16ZIRKzoislABeFR/5qj.');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (1,'Alaa','AlShareef','demo','$2y$12$MrSw5HDKnyBhTmevvAPx.Ob.tI6JBFi32TI5XpZqFjZAkF3bAEYem');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `emp_id` int(4) NOT NULL,
  `service_id` int(4) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `attachment1` varchar(1000) NOT NULL,
  `attachment2` varchar(1000) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (1,1,1,'I am writing to you to formally request that I am taken into consideration for the open position.','./upload_files/ 1/Lab 6.pptx','./upload_files/ 1/Lab 6.pptx','Approved'),(2,2,2,'I want to request that I am taken into consideration for the open position.','./upload_files/ 1/Lab 6.pptx','./upload_files/ 1/Lab 6.pptx','Declined'),(3,3,3,'I am writing to you to formally request that I am taken into consideration for the open position.','./upload_files/ 1/Lab 6.pptx','./upload_files/ 1/Lab 6.pptx','Declined'),(18,10,2,'I want to request that I am taken into consideration for the open position.','./upload_files/ 1/Lab 6.pptx','./upload_files/ 1/Lab 6.pptx','Approved'),(19,7,5,'I want Health Insurance this week, files are attached ','./upload_files/19/IT329 Project - Phase 1 DRAFT.pdf','./upload_files/19/IT329 Project - Phase 3.pdf','In progress'),(20,11,4,'Hello manager, I want allowance due to...','./upload_files/20/IT329 Project - Phase 1 DRAFT.pdf','./upload_files/20/IT329 Project - Phase 3.pdf','Approved'),(21,10,1,'I am writing to you to formally request that I am taken into consideration for the open position.','./upload_files/21/IT329 Project - Phase 1 DRAFT.pdf','./upload_files/21/IT329 Project - Phase 3.pdf','In progress'),(22,11,2,'I am writing to you to formally request that I am taken into consideration for the open position.','./upload_files/22/IT329 Project - Phase 1 DRAFT.pdf','./upload_files/22/IT329 Project - Phase 3.pdf','In progress');
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Promotion'),(2,'Leave'),(3,'Resignation'),(4,'Allowance'),(5,'Health Insurance');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-21 21:33:12
