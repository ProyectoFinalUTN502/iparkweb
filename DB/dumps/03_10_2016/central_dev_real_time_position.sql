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
-- Table structure for table `real_time_position`
--

DROP TABLE IF EXISTS `real_time_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `real_time_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xPoint` double NOT NULL,
  `yPoint` double NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_real_time_position_client1_idx` (`client_id`),
  CONSTRAINT `fk_real_time_position_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `real_time_position`
--

LOCK TABLES `real_time_position` WRITE;
/*!40000 ALTER TABLE `real_time_position` DISABLE KEYS */;
INSERT INTO `real_time_position` VALUES (1,2.39,2.13,'2016-09-18 22:09:31',1),(2,2.8,1.29,'2016-09-18 22:09:36',1),(3,2.49,0.5,'2016-09-18 22:09:42',1),(4,2.49,0.5,'2016-09-18 22:09:47',1),(5,2.5,0.5,'2016-09-18 22:09:53',1),(6,2.49,0.5,'2016-09-18 22:09:59',1),(7,2.49,0.5,'2016-09-18 22:09:59',1),(8,2.5,0.5,'2016-09-18 22:10:05',1),(9,2.49,0.5,'2016-09-18 22:10:16',1),(10,2.49,0.5,'2016-09-18 22:10:22',1),(11,2.5,0.5,'2016-09-18 22:10:27',1),(12,2.49,0.5,'2016-09-18 22:10:33',1),(13,2.5,0.5,'2016-09-18 22:10:38',1),(14,2.5,0.5,'2016-09-18 22:10:44',1),(15,2.5,0.5,'2016-09-18 22:10:50',1),(16,2.49,0.5,'2016-09-18 22:10:55',1),(17,2.49,0.5,'2016-09-18 22:11:01',1),(18,2.49,0.5,'2016-09-18 22:11:06',1),(19,2.49,0.5,'2016-09-18 22:11:12',1),(20,2.49,0.5,'2016-09-18 22:11:18',1),(21,2.49,0.5,'2016-09-18 22:11:23',1),(22,2.49,0.5,'2016-09-18 22:11:29',1),(23,2.49,0.5,'2016-09-18 22:11:34',1),(24,2.49,0.5,'2016-09-18 22:11:40',1),(25,2.5,0.5,'2016-09-18 22:11:47',1),(26,2.5,0.5,'2016-09-18 22:11:53',1),(27,2.49,0.5,'2016-09-18 22:11:58',1),(28,2.5,0.5,'2016-09-18 22:12:04',1),(29,2.49,0.5,'2016-09-18 22:12:09',1),(30,2.5,0.5,'2016-09-18 22:12:15',1),(31,2.49,0.5,'2016-09-18 22:12:21',1),(32,2.49,0.5,'2016-09-18 22:12:26',1),(33,2.5,0.5,'2016-09-18 22:12:32',1),(34,2.5,0.5,'2016-09-18 22:12:38',1),(35,2.49,0.5,'2016-09-18 22:12:43',1),(36,2.5,0.5,'2016-09-18 22:12:49',1),(37,2.49,0.5,'2016-09-18 22:12:54',1),(38,2.5,0.5,'2016-09-18 22:13:00',1),(39,2.49,0.5,'2016-09-18 22:13:06',1),(40,2.5,0.5,'2016-09-18 22:13:11',1),(41,2.5,0.5,'2016-09-18 22:13:17',1),(42,2.5,0.5,'2016-09-18 22:13:25',1),(43,2.5,0.5,'2016-09-18 22:13:31',1),(44,2.49,0.5,'2016-09-18 22:13:37',1),(45,2.49,0.5,'2016-09-18 22:13:42',1),(46,2.49,0.5,'2016-09-18 22:13:48',1),(47,2.49,0.5,'2016-09-18 22:13:53',1),(48,2.49,0.5,'2016-09-18 22:13:59',1),(49,2.49,0.5,'2016-09-18 22:14:05',1),(50,2.49,0.5,'2016-09-18 22:14:10',1),(51,2.49,0.5,'2016-09-18 22:14:16',1),(52,2.49,0.5,'2016-09-18 22:14:21',1),(53,2.49,0.5,'2016-09-18 22:14:27',1),(54,2.49,0.5,'2016-09-18 22:14:33',1),(55,2.23,0.5,'2016-09-18 22:14:38',1),(56,2.33,0.5,'2016-09-18 22:14:44',1),(57,2.29,0.5,'2016-09-18 22:14:50',1),(58,4.95,0.5,'2016-09-18 22:14:55',1),(59,5,0.5,'2016-09-18 22:15:01',1),(60,4.87,0.5,'2016-09-18 22:15:07',1),(61,4.95,0.5,'2016-09-18 22:15:12',1),(62,5,0.5,'2016-09-18 22:15:18',1),(63,5,0.5,'2016-09-18 22:15:26',1),(64,5,0.5,'2016-09-18 22:15:32',1),(65,5,0.5,'2016-09-18 22:15:37',1),(66,5,0.5,'2016-09-18 22:15:43',1),(67,5,0.5,'2016-09-18 22:15:49',1),(68,5,0.5,'2016-09-18 22:15:55',1),(69,5,0.5,'2016-09-18 22:16:01',1),(70,4.92,0.5,'2016-09-18 22:16:07',1),(71,5,0.5,'2016-09-18 22:16:13',1),(72,5,0.5,'2016-09-18 22:16:19',1),(73,5,0.5,'2016-09-18 22:16:25',1),(74,5,0.5,'2016-09-18 22:16:32',1),(75,4.93,0.5,'2016-09-18 22:16:38',1),(76,4.93,0.5,'2016-09-18 22:16:43',1),(77,4.93,0.5,'2016-09-18 22:16:49',1),(78,4.93,0.5,'2016-09-18 22:16:54',1),(79,4.93,0.5,'2016-09-18 22:17:00',1),(80,5,0.5,'2016-09-18 22:17:06',1),(81,5,0.5,'2016-09-18 22:17:13',1),(82,3.32,1.15,'2016-09-18 22:17:19',1),(83,5,0.5,'2016-09-18 22:17:24',1),(84,4.32,0.5,'2016-09-18 22:17:30',1),(85,2.6,1.29,'2016-09-18 22:17:36',1),(86,2.96,0.61,'2016-09-18 22:17:41',1),(87,2.78,0.55,'2016-09-18 22:17:47',1),(88,3.41,1.38,'2016-09-18 22:17:53',1),(89,4.73,1.09,'2016-09-18 22:17:59',1),(90,4.41,0.64,'2016-09-18 22:18:05',1),(91,2.68,1.44,'2016-09-18 22:18:11',1),(92,5,0.5,'2016-09-18 22:18:16',1),(93,2.7,0.7,'2016-09-18 22:18:22',1),(94,4.42,3.98,'2016-09-18 22:18:28',1),(95,5,0.5,'2016-09-18 22:18:34',1),(96,4.49,2.44,'2016-09-18 22:18:40',1),(97,5,0.5,'2016-09-18 22:18:47',1),(98,5,0.5,'2016-09-18 22:18:52',1),(99,4.71,1.63,'2016-09-18 22:18:58',1),(100,5,0.5,'2016-09-18 22:19:04',1),(101,5,0.5,'2016-09-18 22:19:09',1),(102,3.99,0.88,'2016-09-18 22:19:15',1),(103,4.69,1.09,'2016-09-18 22:19:20',1),(104,4.69,1.09,'2016-09-18 22:19:26',1),(105,4.69,1.09,'2016-09-18 22:19:32',1),(106,5,0.5,'2016-09-18 22:19:37',1),(107,5,0.5,'2016-09-18 22:19:43',1),(108,3.6,0.5,'2016-09-18 22:19:53',1),(109,3.22,0.5,'2016-09-18 22:19:58',1),(110,3.09,0.5,'2016-09-18 22:20:04',1),(111,3.27,0.5,'2016-09-18 22:20:10',1),(112,3.42,0.5,'2016-09-18 22:20:17',1),(113,3.2,0.5,'2016-09-18 22:20:22',1),(114,3.28,0.5,'2016-09-18 22:20:29',1),(115,4.13,0.5,'2016-09-18 22:20:34',1),(116,3.58,0.5,'2016-09-18 22:20:40',1),(117,3.52,0.5,'2016-09-18 22:20:46',1),(118,3.35,0.5,'2016-09-18 22:20:54',1),(119,3.33,0.5,'2016-09-18 22:21:00',1),(120,3.83,0.5,'2016-09-18 22:21:06',1),(121,3.63,0.5,'2016-09-18 22:21:11',1),(122,3.55,0.5,'2016-09-18 22:21:17',1),(123,3.51,0.5,'2016-09-18 22:21:23',1),(124,3.35,0.5,'2016-09-18 22:21:28',1),(125,3.35,0.5,'2016-09-18 22:21:34',1),(126,3.35,0.5,'2016-09-18 22:21:40',1),(127,3.35,0.5,'2016-09-18 22:21:45',1),(128,3.35,0.5,'2016-09-18 22:21:51',1),(129,3.35,0.5,'2016-09-18 22:21:56',1),(130,3.35,0.5,'2016-09-18 22:22:03',1),(131,3.35,0.5,'2016-09-18 22:22:09',1),(132,3.35,0.5,'2016-09-18 22:22:14',1),(133,3.35,0.5,'2016-09-18 22:22:21',1),(134,3.35,0.5,'2016-09-18 22:22:26',1),(135,3.35,0.5,'2016-09-18 22:22:32',1),(136,3.35,0.5,'2016-09-18 22:22:38',1),(137,3.35,0.5,'2016-09-18 22:22:43',1),(138,3.35,0.5,'2016-09-18 22:22:50',1),(139,3.35,0.5,'2016-09-18 22:22:55',1),(140,2.53,0.5,'2016-09-18 22:23:01',1),(141,2.54,0.5,'2016-09-18 22:23:07',1),(142,2.45,0.5,'2016-09-18 22:23:12',1),(143,2.6,0.5,'2016-09-18 22:23:18',1),(144,2.6,0.5,'2016-09-18 22:23:25',1),(145,2.48,0.5,'2016-09-18 22:23:30',1),(146,2.52,0.5,'2016-09-18 22:23:36',1),(147,2.68,0.5,'2016-09-18 22:23:41',1),(148,2.7,0.5,'2016-09-18 22:23:47',1),(149,2.84,0.5,'2016-09-18 22:23:53',1),(150,2.49,0.5,'2016-09-18 22:23:59',1),(151,2.5,0.5,'2016-09-18 22:24:05',1),(152,1,1.28,'2016-09-18 22:24:10',1),(153,2.57,0.5,'2016-09-18 22:24:16',1),(154,2.62,0.5,'2016-09-18 22:24:22',1),(155,2.49,0.5,'2016-09-18 22:24:27',1),(156,2.43,0.5,'2016-09-18 22:24:33',1),(157,2.41,0.5,'2016-09-18 22:24:38',1),(158,2.55,0.5,'2016-09-18 22:24:47',1),(159,2.57,0.5,'2016-09-18 22:24:53',1),(160,2.53,0.5,'2016-09-18 22:24:58',1),(161,2.41,0.5,'2016-09-18 22:25:04',1),(162,2.75,0.5,'2016-09-18 22:25:10',1),(163,2.54,0.5,'2016-09-18 22:25:15',1),(164,2.43,0.5,'2016-09-18 22:25:23',1),(165,2.51,0.5,'2016-09-18 22:25:29',1),(166,2.5,0.5,'2016-09-18 22:25:35',1),(167,2.39,0.5,'2016-09-18 22:25:40',1),(168,2.39,0.5,'2016-09-18 22:25:46',1),(169,2.39,0.5,'2016-09-18 22:25:53',1),(170,2.39,0.5,'2016-09-18 22:26:01',1),(171,2.39,0.5,'2016-09-18 22:26:08',1),(172,2.39,0.5,'2016-09-18 22:26:14',1),(173,2.39,0.5,'2016-09-18 22:26:20',1),(174,2.39,0.5,'2016-09-18 22:26:25',1),(175,2.39,0.5,'2016-09-18 22:26:31',1),(176,2.39,0.5,'2016-09-18 22:26:40',1),(177,2.39,0.5,'2016-09-18 22:26:45',1),(178,2.39,0.5,'2016-09-18 22:26:51',1),(179,2.39,0.5,'2016-09-18 22:26:57',1),(180,2.39,0.5,'2016-09-18 22:27:03',1),(181,2.39,0.5,'2016-09-18 22:27:08',1),(182,2.39,0.5,'2016-09-18 22:27:14',1),(183,2.39,0.5,'2016-09-18 22:27:20',1),(184,2.39,0.5,'2016-09-18 22:27:25',1),(185,2.39,0.5,'2016-09-18 22:27:31',1),(186,2.39,0.5,'2016-09-18 22:29:05',1),(187,2.39,0.5,'2016-09-18 22:29:11',1),(188,2.39,0.5,'2016-09-18 22:29:16',1),(189,2.39,0.5,'2016-09-18 22:29:22',1),(190,2.39,0.5,'2016-09-18 22:29:27',1),(191,2.39,0.5,'2016-09-18 22:29:33',1),(192,2.39,0.5,'2016-09-18 22:29:39',1),(193,2.39,0.5,'2016-09-18 22:29:44',1),(194,2.39,0.5,'2016-09-18 22:29:50',1),(195,2.39,0.5,'2016-09-18 22:29:55',1),(196,2.39,0.5,'2016-09-18 22:30:01',1),(197,2.39,0.5,'2016-09-18 22:30:07',1),(198,2.39,0.5,'2016-09-18 22:30:13',1),(199,2.39,0.5,'2016-09-18 22:30:19',1),(200,2.39,0.5,'2016-09-18 22:30:24',1),(201,2.39,0.5,'2016-09-18 22:30:30',1),(202,2.39,0.5,'2016-09-18 22:30:36',1),(203,2.39,0.5,'2016-09-18 22:30:41',1),(204,2.39,0.5,'2016-09-18 22:30:47',1),(205,2.39,0.5,'2016-09-18 22:30:52',1),(206,2.39,0.5,'2016-09-18 22:30:58',1),(207,2.39,0.5,'2016-09-18 22:31:04',1),(208,2.39,0.5,'2016-09-18 22:31:09',1),(209,2.39,0.5,'2016-09-18 22:31:15',1),(210,2.18,0.5,'2016-09-18 22:31:20',1),(211,2.18,0.5,'2016-09-18 22:31:26',1),(212,2.5,0.5,'2016-09-18 22:31:35',1),(213,2.5,0.5,'2016-09-18 22:31:40',1),(214,2.5,0.5,'2016-09-18 22:31:46',1),(215,2.5,0.5,'2016-09-18 22:31:54',1),(216,2.5,0.5,'2016-09-18 22:32:00',1),(217,2.5,0.5,'2016-09-18 22:32:06',1),(218,2.5,0.5,'2016-09-18 22:32:11',1),(219,2.5,0.5,'2016-09-18 22:32:17',1),(220,5,0.5,'2016-09-18 22:32:22',1),(221,5,3.51,'2016-09-18 22:32:28',1),(222,4.01,3.58,'2016-09-18 22:32:34',1),(223,3.7,4,'2016-09-18 22:32:39',1),(224,3.56,4,'2016-09-18 22:32:45',1),(225,5,0.5,'2016-09-18 22:32:51',1),(226,3.45,4,'2016-09-18 22:32:56',1),(227,5,3.1,'2016-09-18 22:33:02',1),(228,5,3.34,'2016-09-18 22:33:07',1),(229,5,3.34,'2016-09-18 22:33:13',1),(230,5,3.34,'2016-09-18 22:33:19',1),(231,5,3.34,'2016-09-18 22:33:24',1),(232,2.5,0.5,'2016-09-18 22:33:30',1),(233,2.57,0.5,'2016-09-18 22:33:35',1),(234,2.7,0.5,'2016-09-18 22:33:41',1),(235,2.15,1.15,'2016-09-18 22:33:47',1),(236,2.45,0.86,'2016-09-18 22:33:52',1),(237,2.87,0.5,'2016-09-18 22:33:58',1),(238,2.89,0.5,'2016-09-18 22:34:04',1),(239,3.01,0.5,'2016-09-18 22:34:09',1),(240,2.64,0.5,'2016-09-18 22:34:15',1),(241,2.59,0.5,'2016-09-18 22:34:20',1),(242,2.59,0.5,'2016-09-18 22:34:26',1),(243,2.59,0.5,'2016-09-18 22:34:32',1),(244,2.68,0.5,'2016-09-18 22:34:40',1),(245,2.71,0.5,'2016-09-18 22:34:46',1),(246,2.48,0.5,'2016-09-18 22:34:52',1),(247,2.54,0.5,'2016-09-18 22:34:57',1),(248,2.54,0.5,'2016-09-18 22:35:03',1),(249,2.64,0.5,'2016-09-18 22:35:08',1),(250,1.81,0.5,'2016-09-18 22:35:14',1),(251,1.15,1.77,'2016-09-18 22:35:20',1),(252,2.4,0.5,'2016-09-18 22:35:25',1),(253,2.89,0.74,'2016-09-18 22:35:31',1),(254,1.65,0.81,'2016-09-18 22:35:37',1),(255,2.5,0.5,'2016-09-18 22:35:42',1),(256,2.66,0.5,'2016-09-18 22:35:48',1),(257,2.77,0.5,'2016-09-18 22:35:53',1),(258,2.72,0.5,'2016-09-18 22:35:59',1),(259,2.49,0.5,'2016-09-18 22:36:05',1),(260,2.48,0.5,'2016-09-18 22:36:10',1),(261,2.51,0.5,'2016-09-18 22:36:16',1),(262,3.09,0.5,'2016-09-18 22:36:21',1),(263,2.45,0.5,'2016-09-18 22:36:27',1),(264,2.53,0.5,'2016-09-18 22:36:33',1),(265,2.85,0.5,'2016-09-18 22:36:38',1),(266,3.1,0.5,'2016-09-18 22:36:44',1),(267,3.22,0.5,'2016-09-18 22:36:49',1),(268,3.16,0.5,'2016-09-18 22:36:55',1),(269,3.09,0.5,'2016-09-18 22:37:01',1),(270,3.25,0.5,'2016-09-18 22:37:06',1),(271,3.25,0.5,'2016-09-18 22:37:12',1),(272,3.25,0.5,'2016-09-18 22:37:17',1),(273,3.25,0.5,'2016-09-18 22:37:23',1),(274,2.5,0.5,'2016-09-18 22:37:29',1),(275,5,0.5,'2016-09-18 22:37:34',1),(276,5,4,'2016-09-18 22:37:40',1),(277,5,0.5,'2016-09-18 22:37:45',1),(278,5,0.5,'2016-09-18 22:37:51',1),(279,5,0.5,'2016-09-18 22:37:57',1),(280,5,0.5,'2016-09-18 22:38:02',1),(281,5,0.5,'2016-09-18 22:38:08',1),(282,2.5,0.5,'2016-09-18 22:38:14',1),(283,2.5,0.5,'2016-09-18 22:38:19',1),(284,2.49,0.5,'2016-09-18 22:38:25',1),(285,2.49,0.5,'2016-09-18 22:38:30',1),(286,3.52,0.5,'2016-09-18 22:38:36',1),(287,3.66,0.8,'2016-09-18 22:38:42',1),(288,3.96,0.88,'2016-09-18 22:38:47',1),(289,5,0.5,'2016-09-18 22:38:53',1),(290,4.68,1.38,'2016-09-18 22:38:58',1),(291,3.4,0.5,'2016-09-18 22:39:04',1),(292,5,0.64,'2016-09-18 22:39:10',1),(293,4.23,0.5,'2016-09-18 22:39:15',1),(294,4.04,0.5,'2016-09-18 22:39:21',1),(295,3.99,0.57,'2016-09-18 22:39:27',1),(296,4.06,0.5,'2016-09-18 22:39:32',1),(297,5,0.57,'2016-09-18 22:39:38',1),(298,5,0.64,'2016-09-18 22:39:43',1),(299,4.23,0.64,'2016-09-18 22:39:49',1),(300,4.44,0.64,'2016-09-18 22:39:55',1),(301,5,0.9,'2016-09-18 22:40:00',1),(302,4.5,0.5,'2016-09-18 22:40:06',1),(303,4.5,0.5,'2016-09-18 22:40:12',1),(304,3.1,0.5,'2016-09-18 22:40:17',1),(305,2.27,0.5,'2016-09-18 22:40:23',1),(306,0.5,2.91,'2016-09-18 22:40:28',1),(307,1.07,0.78,'2016-09-18 22:40:34',1),(308,2.44,0.5,'2016-09-18 22:40:40',1),(309,1.09,2.04,'2016-09-18 22:40:45',1),(310,1.12,1.75,'2016-09-18 22:40:51',1),(311,1.18,1.75,'2016-09-18 22:40:57',1),(312,1.05,2.49,'2016-09-18 22:41:02',1),(313,2.51,0.69,'2016-09-18 22:41:08',1),(314,2.44,0.5,'2016-09-18 22:41:13',1),(315,2.51,0.69,'2016-09-18 22:41:19',1),(316,2.35,0.5,'2016-09-18 22:41:25',1),(317,2.44,0.5,'2016-09-18 22:41:30',1),(318,2.57,0.5,'2016-09-18 22:41:36',1),(319,2.35,0.5,'2016-09-18 22:41:41',1),(320,1.12,1.75,'2016-09-18 22:41:47',1),(321,2.38,0.5,'2016-09-18 22:41:53',1),(322,2.51,0.5,'2016-09-18 22:41:58',1),(323,1.25,2.24,'2016-09-18 22:42:04',1),(324,2.43,0.5,'2016-09-18 22:42:10',1),(325,2.26,1.01,'2016-09-18 22:42:15',1),(326,2.18,0.87,'2016-09-18 22:42:21',1),(327,2.26,1.01,'2016-09-18 22:42:26',1),(328,1.25,2.07,'2016-09-18 22:42:32',1),(329,1.18,1.84,'2016-09-18 22:42:38',1),(330,0.73,1.84,'2016-09-18 22:42:43',1),(331,1.57,1.82,'2016-09-18 22:42:49',1),(332,1.4,2.15,'2016-09-18 22:42:55',1),(333,2.81,0.5,'2016-09-18 22:43:00',1),(334,2.5,0.5,'2016-09-18 22:43:06',1),(335,2.3,0.5,'2016-09-18 22:43:11',1),(336,2.3,0.5,'2016-09-18 22:43:17',1),(337,2.57,0.5,'2016-09-18 22:43:23',1),(338,2.38,0.5,'2016-09-18 22:43:28',1),(339,2.38,0.5,'2016-09-18 22:43:34',1),(340,2.38,0.5,'2016-09-18 22:43:40',1),(341,2.38,0.5,'2016-09-18 22:43:45',1),(342,2.38,0.5,'2016-09-18 22:43:51',1),(343,2.38,0.5,'2016-09-18 22:43:56',1),(344,2.38,0.5,'2016-09-18 22:44:02',1),(345,2.38,0.5,'2016-09-18 22:44:08',1),(346,2.38,0.5,'2016-09-18 22:44:13',1),(347,2.38,0.5,'2016-09-18 22:44:19',1),(348,2.38,0.5,'2016-09-18 22:44:24',1),(349,2.38,0.5,'2016-09-18 22:44:30',1),(350,2.17,0.5,'2016-09-18 22:44:36',1),(351,2.83,0.5,'2016-09-18 22:44:41',1),(352,2.57,0.52,'2016-09-18 22:44:47',1),(353,2.5,0.69,'2016-09-18 22:44:52',1),(354,1.85,0.5,'2016-09-18 22:44:58',1),(355,1.85,0.69,'2016-09-18 22:45:04',1),(356,2.42,0.51,'2016-09-18 22:45:09',1),(357,2.42,0.51,'2016-09-18 22:45:15',1),(358,2.5,0.69,'2016-09-18 22:45:21',1),(359,2.5,0.69,'2016-09-18 22:45:26',1),(360,1.77,0.51,'2016-09-18 22:45:32',1),(361,2,0.5,'2016-09-18 22:45:37',1),(362,1.94,0.55,'2016-09-18 22:45:43',1),(363,2.04,0.7,'2016-09-18 22:45:49',1),(364,2.04,0.7,'2016-09-18 22:45:54',1),(365,1.79,0.86,'2016-09-18 22:46:00',1),(366,2.75,0.55,'2016-09-18 22:46:06',1),(367,2.76,0.55,'2016-09-18 22:46:11',1),(368,2.57,0.5,'2016-09-18 22:46:17',1),(369,2.57,0.5,'2016-09-18 22:46:22',1),(370,2.57,0.5,'2016-09-18 22:46:28',1),(371,2.43,0.5,'2016-09-18 22:50:17',1),(372,2.43,0.5,'2016-09-18 22:50:22',1),(373,2.43,0.5,'2016-09-18 22:50:28',1),(374,2.43,0.5,'2016-09-18 22:50:33',1),(375,2.43,0.5,'2016-09-18 22:50:39',1),(376,2.8,1.59,'2016-09-18 22:50:45',1),(377,2.21,0.5,'2016-09-18 22:50:50',1),(378,1.63,0.5,'2016-09-18 22:50:56',1),(379,1.09,1.87,'2016-09-18 22:51:02',1),(380,1.19,1.87,'2016-09-18 22:51:07',1),(381,1.25,1.89,'2016-09-18 22:51:13',1),(382,1.16,1.87,'2016-09-18 22:51:18',1),(383,1.17,1.87,'2016-09-18 22:51:24',1),(384,1.14,1.87,'2016-09-18 22:51:30',1),(385,1.14,1.87,'2016-09-18 22:51:35',1),(386,0.81,1.89,'2016-09-18 22:51:41',1),(387,0.92,1.89,'2016-09-18 22:51:46',1),(388,1.05,1.87,'2016-09-18 22:51:52',1),(389,1.05,1.87,'2016-09-18 22:51:58',1),(390,0.97,1.87,'2016-09-18 22:52:03',1),(391,1.17,1.89,'2016-09-18 22:52:09',1),(392,1.17,1.89,'2016-09-18 22:52:15',1),(393,1.17,1.89,'2016-09-18 22:52:20',1),(394,1.17,1.89,'2016-09-18 22:52:26',1),(395,1.17,1.89,'2016-09-18 22:52:31',1),(396,1.17,1.89,'2016-09-18 22:52:37',1),(397,1.17,1.89,'2016-09-18 22:52:43',1),(398,1.17,1.89,'2016-09-18 22:52:48',1),(399,1.17,1.89,'2016-09-18 22:52:54',1),(400,1.17,1.89,'2016-09-18 22:52:59',1),(401,1.17,1.89,'2016-09-18 22:53:05',1),(402,1.17,1.89,'2016-09-18 22:53:11',1),(403,1.17,1.89,'2016-09-18 22:53:16',1),(404,1.17,1.89,'2016-09-18 22:53:22',1),(405,1.17,1.89,'2016-09-18 22:53:27',1),(406,1.17,1.89,'2016-09-18 22:53:33',1),(407,1.17,1.89,'2016-09-18 22:53:39',1),(408,1.17,1.89,'2016-09-18 22:53:44',1),(409,1.17,1.89,'2016-09-18 22:53:50',1),(410,1.17,1.89,'2016-09-18 22:53:56',1),(411,1.17,1.89,'2016-09-18 22:54:01',1),(412,1.17,1.89,'2016-09-18 22:54:07',1),(413,1.17,1.89,'2016-09-18 22:54:12',1),(414,1.17,1.89,'2016-09-18 22:54:18',1),(415,1.17,1.89,'2016-09-18 22:54:24',1),(416,1.17,1.89,'2016-09-18 22:54:29',1),(417,1.17,1.89,'2016-09-18 22:54:35',1),(418,1.17,1.89,'2016-09-18 22:54:40',1),(419,1.17,1.89,'2016-09-18 22:54:46',1),(420,1.17,1.89,'2016-09-18 22:54:52',1),(421,1.17,1.89,'2016-09-18 22:54:57',1),(422,1.17,1.89,'2016-09-18 22:55:03',1),(423,1.17,1.89,'2016-09-18 22:55:08',1),(424,1.17,1.89,'2016-09-18 22:55:14',1),(425,1.17,1.89,'2016-09-18 22:55:20',1),(426,1.17,1.89,'2016-09-18 22:55:25',1),(427,1.17,1.89,'2016-09-18 22:55:31',1),(428,1.17,1.89,'2016-09-18 22:55:36',1),(429,1.17,1.89,'2016-09-18 22:55:42',1),(430,1.17,1.89,'2016-09-18 22:55:48',1),(431,1.17,1.89,'2016-09-18 22:55:53',1),(432,1.17,1.89,'2016-09-18 22:55:59',1),(433,1.17,1.89,'2016-09-18 22:56:05',1),(434,1.17,1.89,'2016-09-18 22:56:10',1),(435,1.17,1.89,'2016-09-18 22:56:16',1),(436,1.17,1.89,'2016-09-18 22:56:21',1),(437,1.17,1.89,'2016-09-18 22:56:27',1),(438,1.17,1.89,'2016-09-18 22:56:33',1),(439,1.17,1.89,'2016-09-18 22:56:38',1),(440,1.17,1.89,'2016-09-18 22:56:44',1),(441,1.17,1.89,'2016-09-18 22:56:49',1),(442,1.17,1.89,'2016-09-18 22:56:55',1),(443,1.17,1.89,'2016-09-18 22:57:01',1),(444,1.17,1.89,'2016-09-18 22:57:06',1),(445,1.17,1.89,'2016-09-18 22:57:12',1),(446,1.17,1.89,'2016-09-18 22:57:17',1),(447,1.17,1.89,'2016-09-18 22:57:23',1),(448,1.17,1.89,'2016-09-18 22:57:29',1),(449,1.17,1.89,'2016-09-18 22:57:34',1),(450,1.17,1.89,'2016-09-18 22:57:40',1),(451,1.17,1.89,'2016-09-18 22:57:45',1),(452,1.17,1.89,'2016-09-18 22:57:51',1),(453,1.17,1.89,'2016-09-18 22:57:57',1),(454,1.17,1.89,'2016-09-18 22:58:02',1),(455,1.17,1.89,'2016-09-18 22:58:08',1),(456,1.17,1.89,'2016-09-18 22:58:14',1),(457,1.17,1.89,'2016-09-18 22:58:19',1),(458,1.17,1.89,'2016-09-18 22:58:25',1),(459,2.5,0.5,'2016-09-18 22:58:30',1),(460,1.25,1.43,'2016-09-18 22:58:36',1),(461,1.25,1.43,'2016-09-18 22:58:42',1),(462,1.25,1.43,'2016-09-18 22:58:47',1),(463,1.25,2.26,'2016-09-18 22:58:53',1),(464,2.8,0.5,'2016-09-18 22:58:59',1),(465,5,0.5,'2016-09-18 22:59:04',1),(466,4.39,0.64,'2016-09-18 22:59:10',1),(467,2.71,0.7,'2016-09-18 22:59:15',1),(468,1.83,2.7,'2016-09-18 22:59:21',1),(469,1.8,2.79,'2016-09-18 22:59:27',1),(470,2.25,0.5,'2016-09-18 22:59:32',1),(471,2.14,0.5,'2016-09-18 22:59:38',1),(472,2.11,0.5,'2016-09-18 22:59:44',1),(473,2.27,0.5,'2016-09-18 22:59:49',1),(474,2.11,0.5,'2016-09-18 22:59:55',1),(475,2.29,0.5,'2016-09-18 23:00:00',1),(476,2.26,0.5,'2016-09-18 23:00:06',1),(477,2.19,0.5,'2016-09-18 23:00:12',1),(478,2.1,0.5,'2016-09-18 23:00:17',1),(479,2.42,0.5,'2016-09-18 23:00:23',1),(480,2.31,0.5,'2016-09-18 23:00:29',1),(481,2.27,0.5,'2016-09-18 23:00:34',1),(482,2.47,0.5,'2016-09-18 23:00:40',1),(483,2.47,0.5,'2016-09-18 23:00:45',1),(484,2.44,0.5,'2016-09-18 23:00:51',1),(485,2.59,0.5,'2016-09-18 23:00:57',1),(486,2.33,0.5,'2016-09-18 23:01:02',1),(487,2.35,0.5,'2016-09-18 23:01:08',1),(488,2.43,0.5,'2016-09-18 23:01:13',1),(489,2.37,0.5,'2016-09-18 23:01:19',1),(490,2.4,0.5,'2016-09-18 23:01:25',1),(491,2.35,0.5,'2016-09-18 23:01:30',1),(492,2.43,0.5,'2016-09-18 23:01:36',1),(493,2.28,0.5,'2016-09-18 23:01:42',1),(494,2.25,0.5,'2016-09-18 23:01:48',1),(495,2.42,0.5,'2016-09-18 23:01:53',1),(496,2.32,0.5,'2016-09-18 23:01:59',1),(497,2.1,0.5,'2016-09-18 23:02:04',1),(498,2.26,0.5,'2016-09-18 23:02:10',1),(499,0.5,0.5,'2016-09-18 23:05:59',1),(500,0.5,0.5,'2016-09-18 23:06:05',1),(501,2.4,0.5,'2016-09-18 23:07:04',1),(502,3.19,1.03,'2016-09-18 23:07:10',1),(503,1.59,0.74,'2016-09-18 23:07:15',1),(504,2.53,0.5,'2016-09-18 23:07:21',1),(505,1.24,0.99,'2016-09-18 23:07:27',1),(506,1.04,1.01,'2016-09-18 23:07:32',1),(507,1.65,0.57,'2016-09-18 23:07:41',1),(508,1.64,0.67,'2016-09-18 23:07:46',1),(509,1.04,0.9,'2016-09-18 23:07:52',1),(510,1.04,0.9,'2016-09-18 23:07:58',1),(511,1.04,0.9,'2016-09-18 23:08:03',1),(512,1.09,0.63,'2016-09-18 23:09:41',1),(513,1.09,0.71,'2016-09-18 23:09:48',1),(514,4,9,'2016-09-18 23:09:54',1);
/*!40000 ALTER TABLE `real_time_position` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03  8:21:21