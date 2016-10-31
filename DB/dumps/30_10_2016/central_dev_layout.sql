CREATE DATABASE  IF NOT EXISTS `central_dev` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `central_dev`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: central_dev
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `layout`
--

DROP TABLE IF EXISTS `layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor` int(11) NOT NULL,
  `maxRows` int(11) NOT NULL,
  `maxCols` int(11) NOT NULL,
  `parkinglot_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_layout_parkinglot1_idx` (`parkinglot_id`),
  CONSTRAINT `fk_layout_parkinglot1` FOREIGN KEY (`parkinglot_id`) REFERENCES `parkinglot` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layout`
--

LOCK TABLES `layout` WRITE;
/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
INSERT INTO `layout` VALUES (14,1,10,10,4),(16,1,20,20,6),(35,1,9,7,5),(37,1,6,6,8),(40,1,7,6,7),(41,1,9,10,1),(43,1,11,10,2),(46,1,6,7,3),(47,2,11,12,3),(48,1,5,5,9),(49,1,5,5,10),(50,1,5,5,11),(51,1,5,5,12),(52,1,5,5,13),(53,1,5,5,14),(54,1,5,5,15),(55,1,5,5,16),(56,1,5,5,17),(57,1,5,5,18),(58,1,5,5,19),(59,1,5,5,20),(60,1,5,5,21),(61,1,5,5,22),(62,1,5,5,23),(63,1,5,5,24),(64,1,5,5,25),(65,1,5,5,26),(66,1,5,5,27),(67,1,5,5,28),(68,1,5,5,29),(69,1,5,5,30),(70,1,5,5,31),(71,1,5,5,32),(72,1,5,5,33),(73,1,5,5,34),(74,1,5,5,35),(75,1,5,5,36),(76,1,5,5,37),(77,1,5,5,38),(78,1,5,5,39),(79,1,10,10,40),(80,1,10,10,41),(81,1,8,8,42),(82,1,8,3,43),(83,1,4,4,44),(84,1,4,4,45);
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-30 22:26:23
