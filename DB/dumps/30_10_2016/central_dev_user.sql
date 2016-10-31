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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `loginCount` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastLogin` datetime DEFAULT NULL,
  `lastIp` varchar(255) DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_rol_idx` (`rol_id`),
  CONSTRAINT `fk_user_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ccappetto','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',74,'Cesar','Cappetto','cesarcappetto@gmail.com',1,'2016-08-09 01:23:00','2016-10-30 22:06:22','2016-10-30 23:06:22','::1',1),(2,'tlopez','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Tomas','Lopez','tom.lopez01@gmail.com',1,'2016-08-09 01:23:00','2016-08-09 01:23:00',NULL,NULL,1),(3,'flago','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Federico','Lago','fede333lago@gmail.com',1,'2016-08-09 01:23:00','2016-09-09 21:31:46','2016-09-09 23:31:46','::1',1),(4,'agariglio','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Alejo','Gariglio','gariglio.alejo@gmail.com',1,'2016-08-09 01:23:00','2016-08-09 01:23:00',NULL,NULL,1),(5,'ncarusso','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Nicolas','Carusso','ncarusso@gmail.com',1,'2016-08-09 01:23:00','2016-08-09 01:23:00',NULL,NULL,1),(6,'fpanela','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Federico','Panela','fpanela@gmail.com',1,'2016-08-09 22:18:17','2016-09-06 22:36:11','2016-09-07 00:36:11','::1',2),(7,'jmsoto','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',2,'Juan Manuel','Soto','jmsoto9@gmail.com',1,'2016-08-09 22:21:36','2016-09-09 21:43:11','2016-09-09 23:43:11','::1',2),(8,'aramognino','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',9,'Alfredo','Ramognino','alfredo_ramo@gmail.com',1,'2016-08-09 23:38:31','2016-09-10 14:26:05','2016-09-10 16:26:05','::1',2),(9,'icasanovas','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Ines','Casanovas','icasanovas@gmail.com',0,'2016-09-06 22:40:51','2016-09-09 18:46:24',NULL,NULL,2),(10,'nuevoUsuario','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Nuevo','Usuario','nusuario@gmail.com',1,'2016-09-09 18:59:44','2016-09-09 19:00:53','2016-09-09 21:00:53','::1',2),(11,'ealfaro','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Ezequiel','Alfaro','ealfaro@gmail.com',1,'2016-09-10 12:59:17','2016-09-10 12:59:17',NULL,NULL,2),(12,'hcappetto','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Hugo','Cappetto','hugocappetto@gmail.com',1,'2016-09-10 13:01:12','2016-09-10 13:01:12',NULL,NULL,2),(13,'afuster','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Alan','Fuster','afuster@gmail.com',1,'2016-09-10 13:03:45','2016-09-10 13:03:45',NULL,NULL,2),(14,'hsimpson','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Homero','Simpson','hsimpson@gmail.com',1,'2016-10-01 15:00:46','2016-10-01 15:00:46',NULL,NULL,2),(15,'hsimpson1','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson1@gmail.com',1,'2016-10-01 15:51:02','2016-10-01 15:51:02',NULL,NULL,2),(16,'hsimpson2','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson2@gmail.com',1,'2016-10-01 15:51:03','2016-10-01 15:51:03',NULL,NULL,2),(17,'hsimpson3','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson3@gmail.com',1,'2016-10-01 15:51:03','2016-10-01 15:51:03',NULL,NULL,2),(18,'hsimpson4','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson4@gmail.com',1,'2016-10-01 15:51:04','2016-10-01 15:51:04',NULL,NULL,2),(19,'hsimpson5','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson5@gmail.com',1,'2016-10-01 15:51:04','2016-10-01 15:51:04',NULL,NULL,2),(20,'hsimpson6','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson6@gmail.com',1,'2016-10-01 15:51:05','2016-10-01 15:51:05',NULL,NULL,2),(21,'hsimpson7','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson7@gmail.com',1,'2016-10-01 15:51:05','2016-10-01 15:51:05',NULL,NULL,2),(22,'hsimpson8','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson8@gmail.com',1,'2016-10-01 15:51:06','2016-10-01 15:51:06',NULL,NULL,2),(23,'hsimpson9','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson9@gmail.com',1,'2016-10-01 15:51:06','2016-10-01 15:51:06',NULL,NULL,2),(24,'hsimpson10','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson10@gmail.com',1,'2016-10-01 15:51:07','2016-10-01 15:51:07',NULL,NULL,2),(25,'hsimpson11','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson11@gmail.com',1,'2016-10-01 15:51:07','2016-10-01 15:51:07',NULL,NULL,2),(26,'hsimpson12','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson12@gmail.com',1,'2016-10-01 15:51:07','2016-10-01 15:51:07',NULL,NULL,2),(27,'hsimpson13','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson13@gmail.com',1,'2016-10-01 15:51:08','2016-10-01 15:51:08',NULL,NULL,2),(28,'hsimpson14','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson14@gmail.com',1,'2016-10-01 15:51:08','2016-10-01 15:51:08',NULL,NULL,2),(29,'hsimpson15','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson15@gmail.com',1,'2016-10-01 15:51:09','2016-10-01 15:51:09',NULL,NULL,2),(30,'hsimpson16','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson16@gmail.com',1,'2016-10-01 15:51:09','2016-10-01 15:51:09',NULL,NULL,2),(31,'hsimpson17','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson17@gmail.com',1,'2016-10-01 15:51:10','2016-10-01 15:51:10',NULL,NULL,2),(32,'hsimpson18','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson18@gmail.com',1,'2016-10-01 15:51:10','2016-10-01 15:51:10',NULL,NULL,2),(33,'hsimpson19','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson19@gmail.com',1,'2016-10-01 15:51:11','2016-10-01 15:51:11',NULL,NULL,2),(34,'hsimpson20','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson20@gmail.com',1,'2016-10-01 15:51:11','2016-10-01 15:51:11',NULL,NULL,2),(35,'hsimpson21','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson21@gmail.com',1,'2016-10-01 15:51:11','2016-10-01 15:51:11',NULL,NULL,2),(36,'hsimpson22','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson22@gmail.com',1,'2016-10-01 15:51:12','2016-10-01 15:51:12',NULL,NULL,2),(37,'hsimpson23','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson23@gmail.com',1,'2016-10-01 15:51:12','2016-10-01 15:51:12',NULL,NULL,2),(38,'hsimpson24','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson24@gmail.com',1,'2016-10-01 15:51:13','2016-10-01 15:51:13',NULL,NULL,2),(39,'hsimpson25','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson25@gmail.com',1,'2016-10-01 15:51:13','2016-10-01 15:51:13',NULL,NULL,2),(40,'hsimpson26','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson26@gmail.com',1,'2016-10-01 15:51:14','2016-10-01 15:51:14',NULL,NULL,2),(41,'hsimpson27','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson27@gmail.com',1,'2016-10-01 15:51:14','2016-10-01 15:51:14',NULL,NULL,2),(42,'hsimpson28','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson28@gmail.com',1,'2016-10-01 15:51:14','2016-10-01 15:51:14',NULL,NULL,2),(43,'hsimpson29','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson29@gmail.com',1,'2016-10-01 15:51:15','2016-10-01 15:51:15',NULL,NULL,2),(44,'hsimpson30','e10adc3949ba59abbe56e057f20f883e',0,'Homero','Simpson','hsimpson30@gmail.com',1,'2016-10-01 15:51:15','2016-10-01 15:51:15',NULL,NULL,2),(45,'malvarez','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',7,'Melina','Alvarez','malvarez@gmail.com',1,'2016-10-20 17:00:13','2016-10-30 17:41:13','2016-10-30 18:41:13','::1',2),(46,'demo3','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Demo 3','Demo 3','demo@gmail.com',1,'2016-10-20 18:55:22','2016-10-20 19:02:36','2016-10-20 21:02:36','::1',2),(47,'demo4','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Demo 4','Demo 4','demo4@gmail.com',1,'2016-10-20 18:58:32','2016-10-20 19:02:53','2016-10-20 21:02:53','::1',2),(48,'demo5','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Demo 5','Demo 5','demo5@gmail.com',1,'2016-10-20 19:01:20','2016-10-20 19:03:09','2016-10-20 21:03:09','::1',2),(49,'fake','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',0,'Juan','Perez','j.fake@gmail.com',1,'2016-10-21 22:06:45','2016-10-21 22:06:45',NULL,NULL,2),(50,'codymarc','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'Codymarc','S.A.','compras@codymarc.com.ar',1,'2016-10-30 22:14:18','2016-10-30 22:28:50','2016-10-30 23:28:50','::1',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
