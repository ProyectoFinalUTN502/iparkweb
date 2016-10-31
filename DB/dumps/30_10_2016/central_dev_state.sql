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
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_state_province1_idx` (`province_id`),
  CONSTRAINT `fk_state_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'No Disponible',1),(2,'Capital Federal',2),(3,'General San Martin',3),(4,'José C. Paz',3),(5,'Malvinas Argentinas',3),(6,'San Fernando',3),(7,'San Isidro',3),(8,'San Miguel',3),(9,'Tigre',3),(10,'Vicente Lopez',3),(11,'Almirante Brown',4),(12,'Avellaneda',4),(13,'Berazategui',4),(14,'Esteban Echeverría',4),(15,'Florencio Varela',4),(16,'Lanús',4),(17,'Lomas de Zamora',4),(18,'Quilmes',4),(19,'Hurlingham',5),(20,'Ituzaingó',5),(21,'La Matanza',5),(22,'Merlo',5),(23,'Moreno',5),(24,'Morón',5),(25,'Tres de Febrero',5),(26,'A. gonzalez chavez',6),(27,'Adolfo alsina',6),(28,'Alberti',6),(29,'Arrecifes',6),(30,'Ayacucho',6),(31,'Azul',6),(32,'Bahia blanca',6),(33,'Balcarce',6),(34,'Baradero',6),(35,'Benito juarez',6),(36,'Berisso',6),(37,'Bolivar',6),(38,'Bragado',6),(39,'Brandsen',6),(40,'Campana',6),(41,'Cañuelas',6),(42,'Capitan sarmiento',6),(43,'Carlos casares',6),(44,'Carlos tejedor',6),(45,'Carmen de areco',6),(46,'Castelli',6),(47,'Chacabuco',6),(48,'Chascomus',6),(49,'Chivilcoy',6),(50,'Colon',6),(51,'Coronel dorrego',6),(52,'Coronel pringles',6),(53,'Coronel rosales',6),(54,'Coronel suarez',6),(55,'Daireaux',6),(56,'De la costa',6),(57,'Dolores',6),(58,'Ensenada',6),(59,'Escobar',6),(60,'Exaltacion de la cruz',6),(61,'Ezeiza',6),(62,'Florentino ameghino',6),(63,'General alvarado',6),(64,'General alvear',6),(65,'General arenales',6),(66,'General belgrano',6),(67,'General guido',6),(68,'General lamadrid',6),(69,'General las heras',6),(70,'General lavalle',6),(71,'General madariaga',6),(72,'General paz',6),(73,'General pinto',6),(74,'General pueyrredon',6),(75,'General rodriguez',6),(76,'General viamonte',6),(77,'General villegas',6),(78,'Guamini',6),(79,'Hipolito yrigoyen',6),(80,'Junin',6),(81,'La plata',6),(82,'Laprida',6),(83,'Las flores',6),(84,'Leandro n. alem',6),(85,'Lincoln',6),(86,'Loberia',6),(87,'Lobos',6),(88,'Lujan',6),(89,'Magdalena',6),(90,'Maipu',6),(91,'Mar chiquita',6),(92,'Marcos paz',6),(93,'Mercedes',6),(94,'Monte',6),(95,'Monte hermoso',6),(96,'Navarro',6),(97,'Necochea',6),(98,'Nueve de julio',6),(99,'Olavarria',6),(100,'Patagones',6),(101,'Pehuajo',6),(102,'Pellegrini',6),(103,'Pergamino',6),(104,'Pila',6),(105,'Pilar',6),(106,'Pinamar',6),(107,'Presidente peron',6),(108,'Puan',6),(109,'Punta indio',6),(110,'Ramallo',6),(111,'Rauch',6),(112,'Rivadavia',6),(113,'Rojas',6),(114,'Roque perez',6),(115,'Saavedra',6),(116,'Saladillo',6),(117,'Salliquelo',6),(118,'Salto',6),(119,'San andres de giles',6),(120,'San antonio de areco',6),(121,'San cayetano',6),(122,'San nicolas',6),(123,'San pedro',6),(124,'San vicente',6),(125,'Suipacha',6),(126,'Tandil',6),(127,'Tapalque',6),(128,'Tordillo',6),(129,'Tornquist',6),(130,'Trenque lauquen',6),(131,'Tres arroyos',6),(132,'Tres lomas',6),(133,'Veinticinco de mayo',6),(134,'Villa gesell',6),(135,'Villarino',6),(136,'Zarate',6);
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-30 22:26:24
