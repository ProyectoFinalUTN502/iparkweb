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
-- Table structure for table `parkinglot`
--

DROP TABLE IF EXISTS `parkinglot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parkinglot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ssid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `isCovered` int(11) NOT NULL DEFAULT '0',
  `latMap` double NOT NULL,
  `longMap` double NOT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parkinglot_user1_idx` (`user_id`),
  KEY `fk_parkinglot_city1_idx` (`city_id`),
  CONSTRAINT `fk_parkinglot_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parkinglot_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parkinglot`
--

LOCK TABLES `parkinglot` WRITE;
/*!40000 ALTER TABLE `parkinglot` DISABLE KEYS */;
INSERT INTO `parkinglot` VALUES (1,'Atomo','Establecimiento','Estes asdfasdf','Moreno 2426',1,0,-34.5382279,-58.5632156,'21:00:00','21:00:00','2016-08-09 22:18:17','2016-09-10 12:56:59',6,66),(2,'SWN','SW','asdfasdf','Triunvirato 2810',1,1,-34.5383128,-58.5410367,'08:00:00','21:00:00','2016-08-09 22:21:36','2016-08-09 22:21:36',7,130),(3,'ALFREDOS','Alfredo &#39; s Parkinglot','Esto es un ejemplo de Descripcion modificada','Zapiola 670',1,1,-34.5762099,-58.4479895,'08:00:00','22:00:00','2016-08-09 23:38:31','2016-08-16 01:08:42',8,25),(4,'casanovasParking','Estacionamiento Proyecto Final','Ejemplo de Carga','Medrano 950',0,0,-34.5985317,-58.4203123,'08:00:00','08:00:00','2016-09-06 22:40:51','2016-09-09 18:46:43',9,16),(5,'Est','Establecimiento','Descripcion','Medrano 950',1,0,-34.5985317,-58.4203123,'08:00:00','22:00:00','2016-09-09 18:59:44','2016-09-09 18:59:44',10,16),(6,'Racing Club','Ezequiel Parking','Estacionamiento cerca de la casa de Ezequiel','E Marengo 4043',1,0,-34.5549061,-58.5493124,'08:00:00','08:00:00','2016-09-10 12:59:17','2016-09-10 12:59:17',11,66),(7,'codymarc','Codymarc','Estacionamientos Codymarc. Estacion de Chilavert','Campichuelo 2947',1,1,-34.5430435,-58.5671415,'08:00:00','18:00:00','2016-09-10 13:01:12','2016-09-10 13:01:12',12,66),(8,'Alans','Alan Fuster Parking','Estacionamiento sobre Emilio Zola, a una cuadra de Avenida Alcorta','Lavalle 1345',1,0,-34.5397021,-58.5450125,'08:00:00','23:00:00','2016-09-10 13:03:45','2016-09-10 13:03:45',13,66),(9,'HSIMPSON','The Simpsons','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,1,-34.5481148,-58.5639373,'06:00:00','06:00:00','2016-10-01 15:00:46','2016-10-01 16:17:03',14,66),(10,'HSIMPSON1','The Simpsons 1','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,1,-34.5481148,-58.5639373,'06:00:00','06:00:00','2016-10-01 15:51:02','2016-10-02 19:44:01',15,66),(11,'HSIMPSON2','The Simpsons 2','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,1,-34.5481148,-58.5639373,'12:00:00','12:00:00','2016-10-01 15:51:03','2016-10-01 16:18:50',16,66),(12,'HSIMPSON3','The Simpsons 3','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480848,-58.5639073,'06:00:00','00:00:00','2016-10-01 15:51:03','2016-10-01 15:51:03',17,66),(13,'HSIMPSON4','The Simpsons 4','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480748,-58.5638973,'06:00:00','00:00:00','2016-10-01 15:51:04','2016-10-01 15:51:04',18,66),(14,'HSIMPSON5','The Simpsons 5','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480648,-58.5638873,'06:00:00','00:00:00','2016-10-01 15:51:04','2016-10-01 15:51:04',19,66),(15,'HSIMPSON6','The Simpsons 6','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480548,-58.5638773,'06:00:00','00:00:00','2016-10-01 15:51:05','2016-10-01 15:51:05',20,66),(16,'HSIMPSON7','The Simpsons 7','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480448,-58.5638673,'06:00:00','00:00:00','2016-10-01 15:51:05','2016-10-01 15:51:05',21,66),(17,'HSIMPSON8','The Simpsons 8','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480348,-58.5638573,'06:00:00','00:00:00','2016-10-01 15:51:06','2016-10-01 15:51:06',22,66),(18,'HSIMPSON9','The Simpsons 9','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480248,-58.5638473,'06:00:00','00:00:00','2016-10-01 15:51:06','2016-10-01 15:51:06',23,66),(19,'HSIMPSON10','The Simpsons 10','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480148,-58.5638373,'06:00:00','00:00:00','2016-10-01 15:51:07','2016-10-01 15:51:07',24,66),(20,'HSIMPSON11','The Simpsons 11','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5480048,-58.5638273,'06:00:00','00:00:00','2016-10-01 15:51:07','2016-10-01 15:51:07',25,66),(21,'HSIMPSON12','The Simpsons 12','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479948,-58.5638173,'06:00:00','00:00:00','2016-10-01 15:51:07','2016-10-01 15:51:07',26,66),(22,'HSIMPSON13','The Simpsons 13','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479848,-58.5638073,'06:00:00','00:00:00','2016-10-01 15:51:08','2016-10-01 15:51:08',27,66),(23,'HSIMPSON14','The Simpsons 14','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479748,-58.5637973,'06:00:00','00:00:00','2016-10-01 15:51:08','2016-10-01 15:51:08',28,66),(24,'HSIMPSON15','The Simpsons 15','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479648,-58.5637873,'06:00:00','00:00:00','2016-10-01 15:51:09','2016-10-01 15:51:09',29,66),(25,'HSIMPSON16','The Simpsons 16','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479548,-58.5637773,'06:00:00','00:00:00','2016-10-01 15:51:09','2016-10-01 15:51:09',30,66),(26,'HSIMPSON17','The Simpsons 17','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479448,-58.5637673,'06:00:00','00:00:00','2016-10-01 15:51:10','2016-10-01 15:51:10',31,66),(27,'HSIMPSON18','The Simpsons 18','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479348,-58.5637573,'06:00:00','00:00:00','2016-10-01 15:51:10','2016-10-01 15:51:10',32,66),(28,'HSIMPSON19','The Simpsons 19','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479248,-58.5637473,'06:00:00','00:00:00','2016-10-01 15:51:11','2016-10-01 15:51:11',33,66),(29,'HSIMPSON20','The Simpsons 20','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479148,-58.5637373,'06:00:00','00:00:00','2016-10-01 15:51:11','2016-10-01 15:51:11',34,66),(30,'HSIMPSON21','The Simpsons 21','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5479048,-58.5637273,'06:00:00','00:00:00','2016-10-01 15:51:11','2016-10-01 15:51:11',35,66),(31,'HSIMPSON22','The Simpsons 22','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478948,-58.5637173,'06:00:00','00:00:00','2016-10-01 15:51:12','2016-10-01 15:51:12',36,66),(32,'HSIMPSON23','The Simpsons 23','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478848,-58.5637073,'06:00:00','00:00:00','2016-10-01 15:51:12','2016-10-01 15:51:12',37,66),(33,'HSIMPSON24','The Simpsons 24','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478748,-58.5636973,'06:00:00','00:00:00','2016-10-01 15:51:13','2016-10-01 15:51:13',38,66),(34,'HSIMPSON25','The Simpsons 25','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478648,-58.5636873,'06:00:00','00:00:00','2016-10-01 15:51:13','2016-10-01 15:51:13',39,66),(35,'HSIMPSON26','The Simpsons 26','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478548,-58.5636773,'06:00:00','00:00:00','2016-10-01 15:51:14','2016-10-01 15:51:14',40,66),(36,'HSIMPSON27','The Simpsons 27','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478448,-58.5636673,'06:00:00','00:00:00','2016-10-01 15:51:14','2016-10-01 15:51:14',41,66),(37,'HSIMPSON28','The Simpsons 28','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478348,-58.5636573,'06:00:00','00:00:00','2016-10-01 15:51:14','2016-10-01 15:51:14',42,66),(38,'HSIMPSON29','The Simpsons 29','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5478248,-58.5636473,'06:00:00','00:00:00','2016-10-01 15:51:15','2016-10-01 15:51:15',43,66),(39,'HSIMPSON30','The Simpsons 30','Establecimiento de Alta Calidad y Confianza','Artigas 1613',1,0,-34.5481148,-58.5639373,'08:00:00','08:00:00','2016-10-01 15:51:15','2016-10-02 19:43:44',44,66);
/*!40000 ALTER TABLE `parkinglot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03  8:21:19
