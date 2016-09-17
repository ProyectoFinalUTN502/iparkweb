-- --------------------------------------------------------------------------------------------------
-- Nombre	: sp_search_parkinglot.sql
-- Autor	: Grupo 502
-- Fecha		: Septiembre 2016
-- Descripcion	: Store Procedure para Busqueda de Establecimiento 
-- Notras	: Ref. CU0005 Busqueda de Establecimiento Durante el Manejo
-- 		: Depende de Vista vw_layout
-- --------------------------------------------------------------------------------------------------
DELIMITER $$

CREATE PROCEDURE `searchParkinglot` (IN clientID INT, IN vehicleTypeID INT, IN lat DOUBLE, IN lng DOUBLE)
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
		plot.id, 
		plot.ssid, 
		plot.name, 
		plot.description, 
		plot.address,
		plot.latMap, 
		plot.longMap, 
		plot.openTime, 
		plot.closeTime,
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
				vw_layout 
			WHERE 
				parkinglot_id = plot.id AND
				vehicle_type_id = vehicleTypeID 
		) AS positions
	FROM
		parkinglot plot; 
	
	/*WHERE 
		isCovered = profileIsCovered 
		AND openTime = closeTime
	HAVING 
		distance <= profileRange 
	ORDER BY distance ASC ;*/

END