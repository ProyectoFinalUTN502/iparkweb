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
-- Temporary table structure for view `vw_layout`
--

DROP TABLE IF EXISTS `vw_layout`;
/*!50001 DROP VIEW IF EXISTS `vw_layout`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_layout` (
  `id` tinyint NOT NULL,
  `xPoint` tinyint NOT NULL,
  `yPoint` tinyint NOT NULL,
  `valid` tinyint NOT NULL,
  `circulationValue` tinyint NOT NULL,
  `state` tinyint NOT NULL,
  `vehicle_type_id` tinyint NOT NULL,
  `layout_id` tinyint NOT NULL,
  `floor` tinyint NOT NULL,
  `maxRows` tinyint NOT NULL,
  `maxCols` tinyint NOT NULL,
  `parkinglot_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_layout`
--

/*!50001 DROP TABLE IF EXISTS `vw_layout`*/;
/*!50001 DROP VIEW IF EXISTS `vw_layout`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_layout` AS select `lp`.`id` AS `id`,`lp`.`xPoint` AS `xPoint`,`lp`.`yPoint` AS `yPoint`,`lp`.`valid` AS `valid`,`lp`.`circulationValue` AS `circulationValue`,`lp`.`state` AS `state`,`lp`.`vehicle_type_id` AS `vehicle_type_id`,`lp`.`layout_id` AS `layout_id`,`l`.`floor` AS `floor`,`l`.`maxRows` AS `maxRows`,`l`.`maxCols` AS `maxCols`,`plot`.`id` AS `parkinglot_id` from ((`layout_position` `lp` left join `layout` `l` on((`lp`.`layout_id` = `l`.`id`))) left join `parkinglot` `plot` on((`l`.`parkinglot_id` = `plot`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Dumping routines for database 'central_dev'
--
/*!50003 DROP PROCEDURE IF EXISTS `searchParkinglot` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchParkinglot`(IN clientID INT, IN vehicleTypeID INT, IN lat DOUBLE, IN lng DOUBLE)
BEGIN
	
	DECLARE profileRange INT;
	DECLARE profileMaxPrice DOUBLE;
	DECLARE profileIs24 INT;
	DECLARE profileIsCovered INT;

	SELECT 
		cp.range, cp.maxPrice, cp.is24, cp.isCovered INTO 
		profileRange, profileMaxPrice, profileIs24, profileIsCovered 
	FROM 
		client_profile cp
	WHERE 
		client_id = clientID 
	LIMIT 1;

	SELECT 
		* 
	FROM 
		(
			SELECT
				plot.id, 
				plot.ssid, 
				plot.name, 
				plot.description, 
				plot.address,
				plot.latMap AS lat, 
				plot.longMap AS lng, 
				plot.openTime, 
				plot.closeTime,
				plot.isCovered,
				(
					CASE WHEN plot.openTime = plot.closeTime THEN 1
					ELSE 0
					END
				) AS is24,
				(
					6371 *
					ACOS(
						COS( RADIANS( lat ) ) *
						COS( RADIANS( latMap ) ) *
						COS(
							RADIANS( longMap ) - RADIANS( lng )
						) +
						SIN( RADIANS( lat ) ) *
						SIN( RADIANS( latMap ) )
					)
				) AS distance,
				(
					SELECT 
						TRUNCATE( IFNULL( price , 0 ), 0 ) 
					FROM 
						price 
					WHERE 
						parkinglot_id = plot.id AND 
						vehicle_type_id = vehicleTypeID
				) AS price,
				(
					SELECT 
						COUNT(*) 
					FROM 
						vw_layout vw
					WHERE 
						vw.parkinglot_id = plot.id AND
						vw.vehicle_type_id = vehicleTypeID AND
						vw.state = 'LIBRE'
				) AS positions
			FROM
				parkinglot plot 
		) t  
	WHERE 
		t.isCovered = profileIsCovered AND 
		t.is24 = profileIs24 AND 
		t.price <= profileMaxPrice AND 
		t.distance <= profileRange AND 
		t.positions > 0 
	ORDER BY t.distance ASC; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `searchParkinglotBy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchParkinglotBy`(
	IN vehicleTypeID INT, 
	IN lat DOUBLE, 
	IN lng DOUBLE, 
	IN maxRange INT, 
	IN maxPrice DOUBLE, 
	IN is24 INT, 
	IN isCovered INT
)
BEGIN
	
	SELECT 
		* 
	FROM 
		(
			SELECT
				plot.id, 
				plot.ssid, 
				plot.name, 
				plot.description, 
				plot.address,
				plot.latMap AS lat, 
				plot.longMap AS lng, 
				plot.openTime, 
				plot.closeTime,
				plot.isCovered,
				(
					CASE WHEN plot.openTime = plot.closeTime THEN 1
					ELSE 0
					END
				) AS is24,
				(
					6371 *
					ACOS(
						COS( RADIANS( lat ) ) *
						COS( RADIANS( latMap ) ) *
						COS(
							RADIANS( longMap ) - RADIANS( lng )
						) +
						SIN( RADIANS( lat ) ) *
						SIN( RADIANS( latMap ) )
					)
				) AS distance,
				(
					SELECT 
						TRUNCATE( IFNULL( price , 0 ), 0 ) 
					FROM 
						price 
					WHERE 
						parkinglot_id = plot.id AND 
						vehicle_type_id = vehicleTypeID
				) AS price,
				(
					SELECT 
						COUNT(*) 
					FROM 
						vw_layout vw
					WHERE 
						vw.parkinglot_id = plot.id AND
						vw.vehicle_type_id = vehicleTypeID AND
						vw.state = 'LIBRE'
				) AS positions
			FROM
				parkinglot plot 
		) t  
	WHERE 
		t.isCovered = isCovered AND 
		t.is24 = is24 AND 
		t.price <= maxPrice AND 
		t.distance <= maxRange AND 
		t.positions > 0  
	ORDER BY t.distance ASC; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03  8:21:22
